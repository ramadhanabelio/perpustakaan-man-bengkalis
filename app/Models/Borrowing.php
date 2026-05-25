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
        'status',

        'guest_name',
        'guest_phone',
        'guest_nisn',
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
        return match ($this->status) {
            'pending' => 'Menunggu',
            'approved' => 'Dipinjam',
            'returned' => 'Dikembalikan',
            'late' => 'Terlambat',
            'rejected' => 'Ditolak',
            'return_requested' => 'Pengajuan Pengembalian',
            'extend_requested' => 'Pengajuan Perpanjangan',
            default => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'approved' => 'success',
            'returned' => 'primary',
            'late' => 'danger',
            'rejected' => 'secondary',
            'return_requested' => 'info',
            'extend_requested' => 'warning',
            default => 'warning',
        };
    }
}
