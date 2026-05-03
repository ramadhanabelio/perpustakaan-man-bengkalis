<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member.user', 'book'])
            ->latest()
            ->get();

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $members = Member::with('user')->get();
        $books = Book::all();

        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'book_id' => 'required',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrow_date',
            'status' => 'required',
        ]);

        Borrowing::create($request->all());

        return redirect()->route('borrowings.index')->with('success', 'Data peminjaman berhasil ditambahkan');
    }

    public function edit(Borrowing $borrowing)
    {
        $members = Member::with('user')->get();
        $books = Book::all();

        return view('borrowings.edit', compact('borrowing', 'members', 'books'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'member_id' => 'required',
            'book_id' => 'required',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrow_date',
            'status' => 'required',
        ]);

        $borrowing->update($request->all());

        return redirect()->route('borrowings.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Borrowing $borrowing)
    {
        $borrowing->delete();

        return redirect()->route('borrowings.index')->with('success', 'Data berhasil dihapus');
    }

    public function approve($id)
    {
        $borrowing = Borrowing::with(['book', 'member.user'])->findOrFail($id);

        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Sudah diproses');
        }

        if ($borrowing->book->stock <= 0) {
            return back()->with('error', 'Stok buku habis');
        }

        DB::transaction(function () use ($borrowing) {
            $borrowing->book->decrement('stock');

            $borrowing->update([
                'status' => 'approved'
            ]);
        });

        $this->sendNotification(
            $borrowing->member->user,
            'approved',
            "Peminjaman buku '{$borrowing->book->title}' telah disetujui."
        );

        return back()->with('success', 'Peminjaman disetujui');
    }

    public function returnBook($id)
    {
        $borrowing = Borrowing::with(['book', 'member.user', 'returnData'])->findOrFail($id);

        // hanya bisa kalau member sudah request
        if ($borrowing->status !== 'return_requested') {
            return back()->with('error', 'Belum ada pengajuan pengembalian');
        }

        if ($borrowing->returnData) {
            return back()->with('error', 'Sudah diproses');
        }

        $today = Carbon::today();
        $due = Carbon::parse($borrowing->due_date);

        $isLate = $today->gt($due);
        $status = $isLate ? 'late' : 'returned';
        $fine = $isLate ? 5000 : 0;

        DB::transaction(function () use ($borrowing, $today, $status, $fine) {

            $borrowing->book->increment('stock');

            $borrowing->update([
                'status' => $status
            ]);

            $borrowing->returnData()->create([
                'return_date' => $today,
                'fine' => $fine
            ]);
        });

        $this->sendNotification(
            $borrowing->member->user,
            'return',
            $isLate
                ? "Pengembalian terlambat. Denda Rp{$fine}"
                : "Pengembalian buku berhasil diproses."
        );

        return back()->with('success', 'Pengembalian berhasil diproses');
    }

    public function rejectReturn($id)
    {
        $borrowing = Borrowing::with(['member.user'])->findOrFail($id);

        if ($borrowing->status !== 'return_requested') {
            return back()->with('error', 'Tidak bisa ditolak');
        }

        $borrowing->update([
            'status' => 'approved'
        ]);

        $this->sendNotification(
            $borrowing->member->user,
            'return_rejected',
            "Pengajuan pengembalian ditolak. Silakan hubungi admin."
        );

        return back()->with('success', 'Pengembalian ditolak');
    }

    public function reject($id)
    {
        $borrowing = Borrowing::with(['book', 'member.user'])->findOrFail($id);

        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Sudah diproses');
        }

        DB::transaction(function () use ($borrowing) {
            $borrowing->update([
                'status' => 'rejected'
            ]);
        });

        $admin = auth()->user();

        $this->sendNotification(
            $borrowing->member->user,
            'rejected',
            "Peminjaman buku '{$borrowing->book->title}' ditolak oleh {$admin?->name}."
        );

        return back()->with('success', 'Peminjaman ditolak');
    }

    private function sendNotification($user, $type, $message)
    {
        Notification::create([
            'user_id' => $user->id,
            'type' => $type,
            'message' => $message,
            'sent_at' => now(),
        ]);

        $target = $this->formatPhone($user->phone);

        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,
            ]);

            Log::info('WA SUCCESS', [
                'to' => $target,
                'response' => $response->json()
            ]);
        } catch (\Exception $e) {
            Log::error('WA FAILED', [
                'to' => $target,
                'error' => $e->getMessage()
            ]);
        }
    }

    private function formatPhone($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (substr($phone, 0, 1) == '0') {
            $phone = '62' . substr($phone, 1);
        }

        return $phone;
    }
}
