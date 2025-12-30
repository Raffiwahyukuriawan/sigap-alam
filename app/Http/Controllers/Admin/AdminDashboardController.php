<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticleComment;
use App\Http\Controllers\Controller;
use App\Models\DisasterCategory;
use App\Models\PreventionTip;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total user
        $totalUsers = User::count();

        // Total artikel
        $totalArticles = Article::count();

        // Artikel pending
        $pendingArticles = Article::where('status', 'pending')->count();

        // Total views (sementara, dibahas di bawah)
        $totalViews = Article::sum('views'); // kalau field belum ada → lihat solusi poin 2

        // Artikel per hari (7 hari terakhir)
        $articlesPerDay = Article::where('status', 'published')
            ->whereBetween('published_at', [now()->subDays(6), now()])
            ->selectRaw('DATE(published_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->pluck('total', 'date');

        // Aktivitas terbaru (gabungan)
        $recentArticles = Article::latest()->take(3)->get();
        $recentUsers    = User::latest()->take(3)->get();
        $recentComments = ArticleComment::latest()->take(3)->get();

        $totalDisasterCategory = DisasterCategory::count();

        $totalTips = PreventionTip::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalArticles',
            'pendingArticles',
            'totalViews',
            'articlesPerDay',
            'recentArticles',
            'recentUsers',
            'recentComments',
            'totalDisasterCategory',
            'totalTips'
        ));
    }
}
