<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookExport implements FromCollection, WithHeadings
{
    protected $year;

    public function __construct($year = null)
    {
        $this->year = $year;
    }

    public function collection()
    {
        $query = Book::query();

        if ($this->year) {
            $query->whereYear('created_at', $this->year);
        }

        return $query->get([
            'code',
            'title',
            'author',
            'published_year',
            'category',
            'stock'
        ]);
    }

    public function headings(): array
    {
        return [
            'Kode',
            'Judul',
            'Penulis',
            'Tahun Terbit',
            'Kategori',
            'Stok'
        ];
    }
}
