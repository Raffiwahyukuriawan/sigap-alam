<?php

namespace App\Http\Controllers\Contributor;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DisasterCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ContributorArticleController extends Controller
{
    // CRUD artikel kontributor
    // Status artikel otomatis
    public function storeShow()
    {
        $categories = DisasterCategory::all();
        return view('contributor.create', compact(
            'categories'
        ));
    }

    public function create() {}
    public function editShow($id)
    {
        $article = Article::where('id', $id)->first();
        $categories = DisasterCategory::all();
        return view('contributor.edit', compact(
            'article',
            'categories'
        ));
    }

    public function show($id)
    {
        $article = Article::where('id', $id)->first();

        $category = DisasterCategory::where('id', $article->disaster_category_id)->first();

        return view('contributor.artikel_show', compact(
            'article',
            'category'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'disaster_category_id' => 'required|exists:disaster_categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:draft,pending'
        ]);

        try {
            $coverPath = null;

            if ($request->hasFile('cover_image')) {
                $coverPath = $request->file('cover_image')
                    ->store('articles', 'public');
            }

            $user = Auth::user();

            Article::create([
                'user_id' => $user->id,
                'disaster_category_id' => $request->disaster_category_id,
                'title' => $request->title,
                'slug' => Str::slug($request->title) . '-' . time(),
                'content' => $request->content,
                'cover_image' => $coverPath,
                'status' => $request->status,
                'published_at' => null
            ]);

            return redirect()
                ->route('contributor.dashboard')
                ->with('success', 'Artikel berhasil disimpan');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menyimpan artikel. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
        $user_id = Auth::user();

        $article = Article::where('id', $id)
            ->where('user_id', $user_id->id)
            ->firstOrFail();

        $request->validate([
            'disaster_category_id' => 'required|exists:disaster_categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:draft,pending'
        ]);

        // upload cover baru
        if ($request->hasFile('cover_image')) {
            $article->cover_image = $request->file('cover_image')
                ->store('articles', 'public');
        }

        $article->update([
            'disaster_category_id' => $request->disaster_category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status,
            'published_at' => $request->status === 'published'
                ? now()
                : null
        ]);

        return redirect()
            ->route('contributor.dashboard')
            ->with('success', 'Artikel berhasil diperbarui');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Hapus file cover jika ada
        if ($article->cover_image && Storage::disk('public')->exists($article->cover_image)) {
            Storage::disk('public')->delete($article->cover_image);
        }

        $article->delete();

        return redirect()
            ->route('contributor.dashboard')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
