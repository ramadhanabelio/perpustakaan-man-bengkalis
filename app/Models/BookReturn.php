<?php

namespace App\Models;

use App\Models\Borrowing;
use Illuminate\Database\Eloquent\Model;

class BookReturn extends Model
{
    protected $table = 'returns';

    protected $fillable = [
        'borrowing_id',
        'return_date',
        'fine'
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }
}
