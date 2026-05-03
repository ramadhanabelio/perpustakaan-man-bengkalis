<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('home', compact('books'));
    }

    public function create($book_id)
    {
        $book = Book::findOrFail($book_id);
        return view('borrow.create', compact('book'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrow_date',
        ]);

        $user = Auth::user();

        $member = $user->member;

        Borrowing::create([
            'member_id' => $member->id,
            'book_id' => $request->book_id,
            'borrow_date' => $request->borrow_date,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Pengajuan peminjaman berhasil!');
    }

    public function myBorrowings()
    {
        $user = auth()->user();
        $member = $user->member;

        $borrowings = Borrowing::with('book')
            ->where('member_id', $member->id)
            ->latest()
            ->get();

        return view('borrow.my', compact('borrowings'));
    }

    public function requestReturn($id)
    {
        $borrowing = Borrowing::where('id', $id)
            ->where('member_id', auth()->user()->member->id)
            ->firstOrFail();

        if (!in_array($borrowing->status, ['approved', 'late'])) {
            return back()->with('error', 'Tidak bisa mengajukan pengembalian');
        }

        $borrowing->update([
            'status' => 'return_requested'
        ]);

        return back()->with('success', 'Pengajuan pengembalian dikirim');
    }
}
