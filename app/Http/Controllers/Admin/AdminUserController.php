<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->role, function ($q) use ($request) {
                $q->where('role', $request->role);
            })
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('name', 'like', "%{$request->search}%")
                        ->orWhere('email', 'like', "%{$request->search}%");
                });
            })
            ->latest()
            ->get();

        return view('admin.user', [
            'users'        => $users,
            'total'        => User::count(),
            'userCount'    => User::where('role', 'user')->count(),
            'contributorCount' => User::where('role', 'contributor')->count(),
            'adminCount'   => User::where('role', 'admin')->count(),
            'currentRole'  => $request->role ?? 'all',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);

            return redirect()->back()
                ->with('success', 'User berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan user');
        }
    }

    public function update(Request $request, User $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id->id,
            'role' => 'required',
        ]);

        try {
            $data = $request->only('name', 'email', 'role');

            $id->update($data);

            return redirect()->back()
                ->with('success', 'User berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate user');
        }
    }

    public function destroy(User $id)
    {
        try {
            $id->delete();

            return redirect()->back()
                ->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus user');
        }
    }
}
