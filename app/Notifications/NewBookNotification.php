<?php

namespace App\Notifications;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Log; 
use App\Models\Book;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class NewBookNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $book;

    /**
     * Create a new notification instance.
     *
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Determine the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

     /* Notificação com view padronizada do laravel*/
    /*public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Novo livro publicado: ' . $this->book->title)
            ->line('Um novo livro foi publicado por ' . $this->book->user->name . '.')
            ->line('Título: ' . $this->book->title)
            ->action('Revisar Livro', route('books.review', $this->book->id))
            ->line('Caro administrador, tome as devidas decisões acessando o link!');
    }*/

     /* Notificação com view personalizada pelo desenvolvedor*/
    public function toMail($notifiable)  
    {  
        return (new MailMessage)  
            ->subject('Novo livro publicado: ' . $this->book->title)  
            ->view('emails.livro_publicado', [  
                'book' => $this->book,  
            ]);  
    }



}
