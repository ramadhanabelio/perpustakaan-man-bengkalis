<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MemberExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('user')->latest()->get();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable',
            'nisn' => 'required|unique:members',
            'class' => 'required',
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => 'member',
                'password' => 'password',
            ]);

            Member::create([
                'user_id' => $user->id,
                'nisn' => $request->nisn,
                'class' => $request->class,
                'address' => $request->address,
                'gender' => $request->gender,
            ]);
        });

        return redirect()->route('members.index')->with('success', 'Member berhasil ditambahkan');
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $member->user_id,
            'nisn' => 'required|unique:members,nisn,' . $member->id,
            'class' => 'required',
        ]);

        DB::transaction(function () use ($request, $member) {

            $member->user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            $member->update([
                'nisn' => $request->nisn,
                'class' => $request->class,
                'address' => $request->address,
                'gender' => $request->gender,
            ]);
        });

        return redirect()->route('members.index')->with('success', 'Member berhasil diupdate');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member berhasil dihapus');
    }

    public function exportPdf(Request $request)
    {
        $query = Member::with('user');

        if ($request->class) {
            $query->where('class', 'LIKE', $request->class . '%');
        }

        $members = $query->latest()->get();

        $pdf = Pdf::loadView(
            'members.pdf',
            compact('members')
        );

        return $pdf->download(
            'laporan-member.pdf'
        );
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new MemberExport($request->class),
            'laporan-member.xlsx'
        );
    }
}
