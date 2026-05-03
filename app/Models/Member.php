<?php

namespace App\Models;

use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'user_id',
        'nisn',
        'class',
        'address',
        'gender'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
