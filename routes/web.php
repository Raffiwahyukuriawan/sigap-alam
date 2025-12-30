<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DisasterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PreventionController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminDisasterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPreventionController;
use App\Http\Controllers\Contributor\ContributorProfileController;
use App\Http\Controllers\Contributor\ContributorArticleController;
use App\Http\Controllers\Contributor\ContributorDashboardController;

Route::get('/', [HomeController::class, 'index'])->name('/');

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/jenis-bencana', [DisasterController::class, 'index'])->name('jenis-bencana');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::middleware(['auth', 'role:contributor'])
    ->group(function () {

        Route::resource('/artikel', ContributorArticleController::class);
        Route::get('/contributor/dashboard', [ContributorDashboardController::class, 'index'])
            ->name('contributor.dashboard');
        Route::get('contributor/show/artikel/{id}', [ContributorArticleController::class, 'show'])
            ->name('contributor.show.artikel');
        Route::get('/contributor/artikel/store/show', [ContributorArticleController::class, 'storeShow'])
            ->name('contributor.artikel.store.show');
        Route::post('/contributor/artikel/store', [ContributorArticleController::class, 'store'])
            ->name('contributor.artikel.store');
        Route::get('/contributor/artikel/edit/show/{id}', [ContributorArticleController::class, 'editShow'])
            ->name('contributor.artikel.edit.show');
        Route::put('/contributor/artikel/put/{id}', [ContributorArticleController::class, 'update'])
            ->name('contributor.artikel.put');
        Route::delete('/contributor/artikel/delete/{id}', [ContributorArticleController::class, 'destroy'])
            ->name('contributor.artikel.destroy');

        Route::get('contributor/profile', [ContributorProfileController::class, 'index'])
            ->name('contributor.profile');
        Route::put('contributor/profile/update/{id}', [ContributorProfileController::class, 'update'])
            ->name('contributor.profile.update');
    });

Route::middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('admin/user', [AdminUserController::class, 'index'])
            ->name('admin.users.index');

        Route::get('/admin/disaster-categories', [AdminDisasterController::class, 'index'])->name('admin.disaster-categories');
        Route::post('/admin/disaster-categories/store', [AdminDisasterController::class, 'store'])->name('admin.disaster-categories.store');
        Route::put('/admin/disaster-categories/update/{id}', [AdminDisasterController::class, 'update'])->name('admin.disaster-categories.update');
        Route::delete('/admin/disaster-categories/delete/{id}', [AdminDisasterController::class, 'destroy'])->name('admin.disaster-categories.destroy');

        Route::get('/admin/artikel', [AdminArticleController::class, 'index'])
            ->name('admin.artikel');
        Route::get('admin/show/artikel/{id}', [AdminArticleController::class, 'show'])->name('admin.show.artikel');
        Route::post('/admin/artikel/{article}/approve', [AdminArticleController::class, 'approve'])
            ->name('admin.artikel.approve');
        Route::post('/admin/artikel/reject/{article}', [AdminArticleController::class, 'reject'])
            ->name('admin.artikel.reject');

        Route::get('/admin/tips', [AdminPreventionController::class, 'index'])
            ->name('admin.tips');
        Route::post('/admin/tips/store', [AdminPreventionController::class, 'store'])
            ->name('admin.tips.store');
        Route::put('/admin/tips/update/{id}', [AdminPreventionController::class, 'update'])
            ->name('admin.tips.update');
        Route::delete('/admin/tips/delete/{id}', [AdminPreventionController::class, 'destroy'])
            ->name('admin.tips.destroy');

        Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // GET  /admin/user
        Route::post('admin/user', [AdminUserController::class, 'store'])
            ->name('admin.users.store');
        Route::put('admin/user/update/{id}', [AdminUserController::class, 'update'])
            ->name('admin.users.update');
        Route::delete('admin/user/{id}', [AdminUserController::class, 'destroy'])
            ->name('admin.users.destroy');

        Route::get('admin/profile', [AdminProfileController::class, 'index'])
            ->name('admin.profile');
        Route::put('admin/profile/update/{id}', [AdminProfileController::class, 'update'])
            ->name('admin.profile.update');
    });

Route::get('/bencana', [DisasterController::class, 'index']);
Route::get('/bencana/article/{id}', [DisasterController::class, 'bencanaShowArticle'])->name('bencana.show.article');

Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel.index');
Route::get('/show/artikel/{id}', [ArticleController::class, 'show'])->name('show.artikel');
Route::post('/artikel/{article}/comment', [ArticleController::class, 'comment'])
    ->name('artikel.comment.store');

Route::post('/komentar', [CommentController::class, 'store']);

Route::get('/tips/{bencana}', [PreventionController::class, 'show']);
