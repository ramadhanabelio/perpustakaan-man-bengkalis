<?php

namespace App\Models;

use App\Models\Borrowing;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'code',
        'title',
        'author',
        'published_year',
        'description',
        'category',
        'cover_image',
        'stock'
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
