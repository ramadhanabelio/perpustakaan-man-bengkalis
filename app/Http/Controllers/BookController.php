<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookExport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:books',
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'nullable|digits:4',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')
                ->store('books', 'public');
        }

        Book::create($data);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'code' => 'required|unique:books,code,' . $book->id,
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'nullable|digits:4',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {

            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $data['cover_image'] = $request->file('cover_image')
                ->store('books', 'public');
        }

        $book->update($data);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        if (
            $book->cover_image &&
            Storage::disk('public')->exists($book->cover_image)
        ) {

            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil dihapus');
    }

    public function exportPdf(Request $request)
    {
        $query = Book::query();

        if ($request->year) {
            $query->whereYear('created_at', $request->year);
        }

        $books = $query->latest()->get();

        $pdf = Pdf::loadView(
            'books.pdf',
            compact('books')
        );

        return $pdf->download('laporan-buku.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new BookExport($request->year),
            'laporan-buku.xlsx'
        );
    }
}
