<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Member;
use App\Models\BookReturn;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'member_id',
        'book_id',
        'borrow_date',
        'due_date',
        'status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function returnData()
    {
        return $this->hasOne(BookReturn::class);
    }

    public function getStatusLabelAttribute()
    {
        return [
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Sedang Dipinjam',
            'returned' => 'Sudah Dikembalikan',
            'late' => 'Terlambat',
            'return_requested' => 'Menunggu Pengembalian',
            'rejected' => 'Ditolak',
        ][$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        return [
            'pending' => 'warning',
            'approved' => 'success',
            'returned' => 'primary',
            'late' => 'danger',
            'return_requested' => 'info',
            'rejected' => 'secondary',
        ][$this->status] ?? 'dark';
    }
}
