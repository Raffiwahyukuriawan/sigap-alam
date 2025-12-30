<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\DisasterCategory;
use App\Http\Controllers\Controller;

class AdminArticleController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status ?? 'all';

        $articles = Article::with(['user', 'category'])
            ->when(
                $status !== 'all',
                fn($q) => $q->where('status', $status)
            )
            ->latest()
            ->get();

        // 👇 hitung jumlah per status
        $countAll = Article::count();
        $countPending = Article::where('status', 'pending')->count();
        $countPublished = Article::where('status', 'published')->count();

        return view('admin.artikel', compact(
            'articles',
            'status',
            'countAll',
            'countPending',
            'countPublished'
        ));
    }

    public function approve(Article $article)
    {
        $article->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Artikel berhasil di-approve');
    }

    public function reject(Request $request, Article $article)
    {
        $request->validate([
            'reason' => 'required'
        ]);

        $article->update([
            'status' => 'rejected',
            'reject_reason' => $request->reason
        ]);

        return redirect()->back()->with('success', 'Artikel berhasil ditolak');
    }

    public function unpublish(Article $article)
    {
        $article->update(['status' => 'draft']);
        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $article = Article::where('id', $id)->first();
       
        $category = DisasterCategory::where('id', $article->disaster_category_id)->first();

        return view('admin.artikel_show', compact(
            'article',
            'category'
        ));
    }
}
