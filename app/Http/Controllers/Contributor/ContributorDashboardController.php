<?php

namespace App\Http\Controllers\Contributor;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContributorDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        $total = Article::where('user_id', $userId)->count();
        $published = Article::where('user_id', $userId)->where('status', 'published')->count();
        $pending = Article::where('user_id', $userId)->where('status', 'pending')->count();
        $draft = Article::where('user_id', $userId)->where('status', 'draft')->count();

        $articles = Article::with('category')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('contributor.index', compact(
            'total',
            'published',
            'pending',
            'draft',
            'articles'
        ));
    }
}
