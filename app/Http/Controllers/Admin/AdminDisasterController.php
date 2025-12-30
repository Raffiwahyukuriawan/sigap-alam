<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\DisasterCategory;
use App\Http\Controllers\Controller;

class AdminDisasterController extends Controller
{
    // CRUD jenis bencana
    public function index()
    {
        $categories = DisasterCategory::all();
        return view('admin.bencana', compact([
            'categories'
        ]));
    }

    // 🔹 CREATE (Store)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        DisasterCategory::create($request->all());

        return redirect()->back()->with('success', 'Jenis bencana berhasil ditambahkan');
    }

    // 🔹 UPDATE
    public function update(Request $request, $id)
    {
        $category = DisasterCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->back()->with('success', 'Jenis bencana berhasil diperbarui');
    }

    // 🔹 DELETE
    public function destroy($id)
    {
        DisasterCategory::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Jenis bencana berhasil dihapus');
    }
}
