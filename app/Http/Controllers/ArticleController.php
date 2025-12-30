<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleComment;
use Illuminate\Http\Request;
use App\Models\DisasterCategory;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // List artikel publik
    public function index()
    {
        $articles = Article::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->get();

        return view('user.artikel.index', compact('articles'));
    }

    // Detail artikel + komentar
    public function show($id)
    {
        $article = Article::where('id', $id)->firstOrFail();

        // tambah 1 ke kolom views
        $article->increment('views');

        $category = DisasterCategory::where('id', $article->disaster_category_id)->first();

        return view('user.artikel.show', compact(
            'article',
            'category'
        ));
    }

    public function comment(Request $request, Article $article)
    {
        $data = $request->validate([
            'comment' => 'required|string|max:1000',
            'name'    => 'nullable|string|max:100',
            'email'   => 'nullable|email',
            'article_id'   => 'nullable|numeric'
        ]);

        // dd($data);
        // $user_id = $user->id;

        ArticleComment::create($data);

        return back()->with('success', 'Komentar berhasil dikirim');
    }
}
