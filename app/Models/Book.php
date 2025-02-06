<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'cover_image',
        'category_id',
        'user_id',
        'status',
    ];

    /**
     * Relação: Um livro pertence a uma categoria.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relação: Um livro pertence a um usuário.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
