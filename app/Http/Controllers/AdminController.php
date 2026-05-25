<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->latest()->get();

        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        $data['password'] = Hash::make($request->password);

        $data['role'] = 'admin';

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')
                ->store('admins', 'public');
        }

        User::create($data);

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit(User $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('profile_picture')) {

            if (
                $admin->profile_picture &&
                Storage::disk('public')->exists($admin->profile_picture)
            ) {

                Storage::disk('public')->delete($admin->profile_picture);
            }

            $data['profile_picture'] = $request->file('profile_picture')
                ->store('admins', 'public');
        }

        $admin->update($data);

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin berhasil diupdate');
    }

    public function destroy(User $admin)
    {
        if (
            $admin->profile_picture &&
            Storage::disk('public')->exists($admin->profile_picture)
        ) {

            Storage::disk('public')->delete($admin->profile_picture);
        }

        $admin->delete();

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin berhasil dihapus');
    }
}
