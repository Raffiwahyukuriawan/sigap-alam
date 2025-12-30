<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DisasterCategory;
use App\Models\PreventionTip;
use Illuminate\Http\Request;

class AdminPreventionController extends Controller
{
    // CRUD tips pencegahan
    public function index()
    {
        return view('admin.tips', [
            'tips' => PreventionTip::with('category')->latest()->get(),
            'categories' => DisasterCategory::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'disaster_category_id' => 'required|exists:disaster_categories,id',
            'title'                => 'required|string|max:255',
            'content'              => 'required|string',
        ]);

        PreventionTip::create($data);

        return back()->with('success', 'Tips pencegahan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $tip = PreventionTip::findOrFail($id);

        $data = $request->validate([
            'disaster_category_id' => 'required|exists:disaster_categories,id',
            'title'                => 'required|string|max:255',
            'content'              => 'required|string',
        ]);

        $tip->update($data);

        return back()->with('success', 'Tips pencegahan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $tip = PreventionTip::findOrFail($id);
        $tip->delete();

        return back()->with('success', 'Tips pencegahan berhasil dihapus');
    }
}
