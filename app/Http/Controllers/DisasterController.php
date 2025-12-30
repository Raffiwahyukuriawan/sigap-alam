<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\DisasterCategory;
use App\Models\PreventionTip;

class DisasterController extends Controller
{
    public function show(Article $article)
    {
        $article->increment('views'); // aman & atomic

        return view('articles.show', compact('article'));
    }

    // Daftar bencana
    public function index()
    {
        $categories = DisasterCategory::withCount([
            'articles as articles_count' => function ($query) {
                $query->where('status', 'published');
            }
        ])->get();

        return view('user.bencana.index', compact('categories'));
    }

    public function bencanaShowArticle($id)
    {
        $category = DisasterCategory::findOrFail($id);

        $articles = Article::where('disaster_category_id', $id)
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->get();

        $tips = PreventionTip::where('disaster_category_id', $id)->get();

        return view('user.bencana.article', compact(
            'articles',
            'category',
            'tips'
        ));
    }
}
