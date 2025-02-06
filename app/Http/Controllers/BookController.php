<?php

namespace App\Http\Controllers;

use App\Notifications\NewBookNotification;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Notification;
use App\Models\Category;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
class BookController extends Controller
{

    /*public function index()
    {
        $books = Book::where('status', 'approved')->orderBy('created_at', 'asc')->get();
        return view('welcome', compact('books'));
    }*/

    public function index(Request $request)
    {
        $query = Book::where('status', 'approved');

        // Filtrar por título, se fornecido
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Filtrar por categoria, se fornecida
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->orderBy('created_at', 'asc')->paginate(9);
        $categories = Category::all(); // Para popular o select de categorias

        return view('welcome', compact('books', 'categories'));
    }


    public function create()
    {
        $categories = Category::all(); // Obter todas as categorias
        return view('books.create', compact('categories')); // Passar as categorias para a view
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'required|file|mimes:pdf,doc,docx',
            'category_id' => 'required|exists:categories,id',
        ]);

        $filePath = $request->file('file_path')->store('books', 'public');
        $coverImagePath = 'covers/default_cover.jpg'; // Caminho padrão da capa

        if ($request->file('file_path')->getClientOriginalExtension() === 'pdf') {
            $pdfPath = storage_path("app/public/{$filePath}");
            $imagePath = "covers/" . uniqid() . ".jpg";

            if (!Storage::disk('public')->exists('covers')) {
                Storage::disk('public')->makeDirectory('covers');
            }

            try {
                $imagick = new \Imagick();
                $imagick->setResolution(150, 150);
                $imagick->readImage($pdfPath . '[0]'); // Ler a primeira página do PDF
                $imagick->setImageFormat('jpg'); // Define o formato da imagem
                $imagick->writeImage(storage_path("app/public/{$imagePath}")); // Salva a imagem
                $imagick->clear();
                $imagick->destroy();

                $coverImagePath = $imagePath; // Atualizar o caminho da capa gerada
            } catch (\Exception $e) {
                Log::error('Erro ao gerar a imagem de capa: ' . $e->getMessage());
            }
        }
        

        // Criar o livro no banco de dados
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'cover_image' => $coverImagePath,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        // Carregar os relacionamentos necessários
        $book->load('user', 'category');
        $admins = User::where('is_admin', true)->get();  
        if ($admins->isEmpty()) {  
            return redirect()->route('books.create')->with('error', 'Nenhum administrador encontrado para notificação.');  
        }  

        Notification::send($admins, new NewBookNotification($book));  
        return redirect()->route('books.create')->with('success', 'Livro publicado com sucesso! Aguardando aprovação.');
    }


    public function download(Book $book)
    {
        $filePath = storage_path("app/public/{$book->file_path}");

        if (!file_exists($filePath)) {
            abort(404, 'Arquivo não encontrado.');
        }

        return response()->download($filePath, $book->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }

    public function read(Book $book)
    {
        $filePath = storage_path("app/public/{$book->file_path}");

        if (!file_exists($filePath)) {
            abort(404, 'Arquivo não encontrado.');
        }

        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

        // Verifique se o tipo de arquivo é suportado para leitura
        if ($fileExtension === 'pdf') {
            return response()->file($filePath);
        }

        // Caso não seja suportado, redirecione ou exiba uma mensagem
        return redirect()->route('books.review', $book->id)
                        ->with('error', 'Este tipo de arquivo não é suportado para leitura online.');
    }

    public function myBooks()
    {
        $books = auth()->user()->books()
            ->orderByRaw("FIELD(status, 'approved', 'pending', 'rejected')")
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('dashboard', compact('books'));
    }



}
