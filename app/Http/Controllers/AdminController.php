<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function pendingBooks()
    {
        // Carrega todos os livros com status 'pending' ordenados por data
        $books = Book::where('status', 'pending')->orderBy('created_at', 'desc')->paginate(9);
        
        // Carrega todas as categorias
        $categories = Category::all();
        
        // Passa as variáveis $books e $categories para a view
        return view('admin.pending-books', compact('books', 'categories'));
    }

    public function review(Book $book)
    {
        $categories = Category::all();
        return view('books.review', compact('book', 'categories'));
    }


    // Método para aprovar o livro
    public function approve(Request $request, Book $book)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id', // Verifica se a categoria é válida
        ]);

        // Atualiza o status para 'approved' e a categoria
        $book->update([
            'status' => 'approved',
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.pending-books', $book->id)->with('success', 'Livro aprovado com sucesso!');
    }

    public function reject(Book $book)
    {
        // Verifica se o arquivo do livro existe no sistema de arquivos
        if (Storage::disk('public')->exists($book->file_path)) {
            // Remove o arquivo do storage
            Storage::disk('public')->delete($book->file_path);
        }

        // Verifica se a capa gerada (se não for a padrão) existe e a remove
        if ($book->cover_image !== 'covers/default_cover.jpg' && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        // Atualiza o status para 'rejected' no banco de dados
        $book->update(['status' => 'rejected']);

          // Exclui o livro do banco de dados
            $book->delete();

        return redirect()->route('admin.pending-books', $book->id)->with('success', 'Livro rejeitado e arquivo excluído com sucesso!');
    }


    public function listUsers(Request $request)
    {
        // Verifica se há um termo de pesquisa
        $search = $request->query('search');

        // Busca os usuários com base no termo de pesquisa (nome ou e-mail)
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10); // Paginação com 10 usuários por página

        return view('admin.index', compact('users', 'search'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        // Validação do campo is_admin
        $request->validate([
            'is_admin' => 'required|boolean',
        ]);

        // Atualiza o papel do usuário
        $user->update([
            'is_admin' => $request->is_admin,
        ]);

        return redirect()->route('admin.users.list')->with('success', 'Papel do usuário atualizado com sucesso!');
    }
}