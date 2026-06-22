<?php

namespace App\Exports;

use App\Models\Borrowing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BorrowingExport implements FromCollection, WithHeadings
{
    protected $month;
    protected $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function collection()
    {
        $query = Borrowing::with(['member.user', 'book']);

        if ($this->month) {
            $query->whereMonth('borrow_date', $this->month);
        }

        if ($this->year) {
            $query->whereYear('borrow_date', $this->year);
        }

        return $query->get()->map(function ($b) {
            return [
                'Peminjam' => $b->member?->user?->name ?? $b->guest_name,
                'NISN' => $b->guest_nisn,
                'Buku' => $b->book->title,
                'Tanggal Pinjam' => $b->borrow_date,
                'Jatuh Tempo' => $b->due_date,
                'Status' => $b->status_label,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Peminjam',
            'NISN',
            'Buku',
            'Tanggal Pinjam',
            'Jatuh Tempo',
            'Status'
        ];
    }
}
