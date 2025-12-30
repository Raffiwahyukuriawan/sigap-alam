<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\DisasterCategory;

class HomeController extends Controller
{
    // Menampilkan landing page (bencana + artikel terbaru)
    public function index()
    {
        // Ambil artikel terbaru
        $articles = Article::with(['user', 'category'])
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();
        
        // Ambil semua kategori bencana
        $categories = DisasterCategory::take(6)
            ->get();

        return view('user.home', compact('articles', 'categories'));
    }
}
