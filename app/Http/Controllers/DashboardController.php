<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Member;
use App\Models\Borrowing;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalMembers = Member::count();
        $totalBorrowed = Borrowing::whereIn('status', [
            'approved',
            'late',
            'return_requested'
        ])->count();

        $weekly = Borrowing::select(
            DB::raw('DATE(borrow_date) as date'),
            DB::raw('count(*) as total')
        )
            ->where('borrow_date', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $yearly = Borrowing::select(
            DB::raw('MONTH(borrow_date) as month'),
            DB::raw('count(*) as total')
        )
            ->whereYear('borrow_date', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $bookStatus = [
            'Tersedia' => Book::sum('stock'),
            'Dipinjam' => Borrowing::whereIn('status', [
                'approved',
                'late',
                'return_requested'
            ])->count(),
        ];

        $userStats = [
            'Admin' => User::where('role', 'admin')->count(),
            'Anggota' => User::where('role', 'member')->count(),
        ];

        return view('dashboard', compact(
            'totalBooks',
            'totalMembers',
            'totalBorrowed',
            'weekly',
            'yearly',
            'bookStatus',
            'userStats'
        ));
    }
}
