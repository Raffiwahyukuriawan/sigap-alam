<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('admin.profile', compact(
            'user'
        ));
    }

    public function update(Request $request)
    {
        // ambil user dari session login
        $user = Auth::user(); // ← sesuai permintaan

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        // jika password diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id',$user->id)->update($data);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
