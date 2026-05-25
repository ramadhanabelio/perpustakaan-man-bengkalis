<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        $member = null;

        if ($user->role == 'member') {
            $member = Member::where('user_id', $user->id)->first();
        }

        return view('profile.edit', compact('user', 'member'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable',
            'password' => 'nullable|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {

            if (
                $user->profile_picture &&
                Storage::disk('public')->exists($user->profile_picture)
            ) {

                Storage::disk('public')->delete($user->profile_picture);
            }

            $data['profile_picture'] = $request
                ->file('profile_picture')
                ->store('profiles', 'public');
        }

        $user->update($data);

        if ($user->role == 'member') {

            $member = Member::where('user_id', $user->id)->first();

            if ($member) {

                $member->update([
                    'nisn' => $request->nisn,
                    'class' => $request->class,
                    'address' => $request->address,
                    'gender' => $request->gender,
                ]);
            }
        }

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
