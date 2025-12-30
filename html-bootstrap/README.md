# SIGAP ALAM - Sistem Edukasi Lingkungan dan Kesadaran Bencana
## Versi HTML, CSS, JavaScript, Bootstrap 5

---

## 📋 Daftar Isi

1. [Struktur Proyek](#struktur-proyek)
2. [Struktur Database](#struktur-database)
3. [Alur Data Sistem](#alur-data-sistem)
4. [Panduan Implementasi Laravel](#panduan-implementasi-laravel)
5. [Teknologi yang Digunakan](#teknologi-yang-digunakan)
6. [Fitur Utama](#fitur-utama)

---

## 📁 Struktur Proyek

```
html-bootstrap/
├── assets/
│   ├── css/
│   │   └── style.css              # Custom CSS dengan Bootstrap 5
│   └── js/
│       └── script.js              # JavaScript untuk interaktivitas
├── database/
│   └── migrations.sql             # SQL Schema & Seeder
├── index.html                     # Landing Page (User)
├── jenis-bencana.html            # Halaman Jenis Bencana
├── detail-artikel.html           # Detail Artikel (Coming soon)
├── dashboard-contributor.html    # Dashboard Kontributor
├── form-artikel.html             # Form Create/Edit Artikel (Coming soon)
├── dashboard-admin.html          # Dashboard Admin (Coming soon)
├── kelola-bencana.html          # CRUD Jenis Bencana (Coming soon)
└── README.md                     # Dokumentasi
```

---

## 🗄️ Struktur Database

### 1. Tabel `users`
Menyimpan semua pengguna (user, kontributor, admin).

```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'contributor', 'admin') DEFAULT 'user',
    photo VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

**Keterangan:**
- `role`: Digunakan untuk role-based access control
- `photo`: Path foto profil (nullable)

---

### 2. Tabel `disaster_categories`
Menyimpan jenis-jenis bencana.

```sql
CREATE TABLE disaster_categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    icon VARCHAR(255) NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

**Contoh Data:**
- Banjir, Gempa Bumi, Tsunami, Kebakaran Hutan, Longsor, Badai, Kekeringan, Gunung Meletus

---

### 3. Tabel `articles`
Menyimpan artikel edukasi yang ditulis kontributor.

```sql
CREATE TABLE articles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    disaster_category_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    cover_image VARCHAR(255) NULL,
    status ENUM('draft', 'pending', 'published', 'rejected') DEFAULT 'draft',
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (disaster_category_id) REFERENCES disaster_categories(id) ON DELETE CASCADE
);
```

**Status Artikel:**
- `draft`: Masih draft, belum dikirim
- `pending`: Menunggu persetujuan admin
- `published`: Sudah dipublikasikan
- `rejected`: Ditolak oleh admin

---

### 4. Tabel `article_comments`
Menyimpan komentar pada artikel.

```sql
CREATE TABLE article_comments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    article_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE
);
```

**Keterangan:**
- Komentar dapat dilakukan tanpa login (guest)
- Email bersifat opsional

---

### 5. Tabel `prevention_tips`
Menyimpan tips pencegahan bencana.

```sql
CREATE TABLE prevention_tips (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    disaster_category_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (disaster_category_id) REFERENCES disaster_categories(id) ON DELETE CASCADE
);
```

---

### 6. Tabel `article_approvals`
Menyimpan riwayat persetujuan/penolakan artikel.

```sql
CREATE TABLE article_approvals (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    article_id BIGINT UNSIGNED NOT NULL,
    admin_id BIGINT UNSIGNED NOT NULL,
    status ENUM('approved', 'rejected') NOT NULL,
    note TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

## 🔄 Alur Data Sistem

### Workflow Artikel

```
1. Kontributor Login
   ↓
2. Membuat Artikel (status: draft)
   ↓
3. Simpan Draft / Kirim untuk Review
   ↓
4. Artikel berubah status (pending)
   ↓
5. Admin melihat di dashboard
   ↓
6. Admin Approve/Reject artikel
   ↓
7a. Jika Approved → status: published
7b. Jika Rejected → status: rejected (dengan catatan)
   ↓
8. Artikel published tampil di halaman user
   ↓
9. User dapat membaca dan memberikan komentar
```

### Relasi Database

```
users (1) ─── (N) articles
disaster_categories (1) ─── (N) articles
articles (1) ─── (N) article_comments
articles (1) ─── (N) article_approvals
disaster_categories (1) ─── (N) prevention_tips
users (admin) (1) ─── (N) article_approvals
```

---

## 🚀 Panduan Implementasi Laravel

### 1. Setup Project Laravel

```bash
# Install Laravel
composer create-project laravel/laravel sigap-alam

# Install dependencies
cd sigap-alam
composer require laravel/ui
php artisan ui bootstrap --auth
npm install && npm run build
```

### 2. Struktur Folder Laravel

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   ├── DisasterController.php
│   │   ├── ArticleController.php
│   │   ├── Contributor/
│   │   │   └── DashboardController.php
│   │   └── Admin/
│   │       ├── DashboardController.php
│   │       └── DisasterManagementController.php
│   └── Middleware/
│       ├── CheckRole.php
│       └── CheckContributor.php
├── Models/
│   ├── User.php
│   ├── DisasterCategory.php
│   ├── Article.php
│   ├── ArticleComment.php
│   ├── PreventionTip.php
│   └── ArticleApproval.php
└── ...

resources/
└── views/
    ├── layouts/
    │   ├── app.blade.php
    │   ├── navbar.blade.php
    │   ├── footer.blade.php
    │   └── sidebar.blade.php
    ├── home/
    │   ├── index.blade.php
    │   ├── disasters.blade.php
    │   └── article-detail.blade.php
    ├── contributor/
    │   ├── dashboard.blade.php
    │   └── article-form.blade.php
    └── admin/
        ├── dashboard.blade.php
        └── disaster-management.blade.php
```

### 3. Migrasi Database

Buat migration files:

```bash
php artisan make:migration create_users_table
php artisan make:migration create_disaster_categories_table
php artisan make:migration create_articles_table
php artisan make:migration create_article_comments_table
php artisan make:migration create_prevention_tips_table
php artisan make:migration create_article_approvals_table
```

Copy SQL schema dari `database/migrations.sql` ke migration files.

### 4. Buat Models

```bash
php artisan make:model DisasterCategory
php artisan make:model Article
php artisan make:model ArticleComment
php artisan make:model PreventionTip
php artisan make:model ArticleApproval
```

**Contoh Model Article.php:**

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'user_id', 'disaster_category_id', 'title', 'slug', 
        'content', 'cover_image', 'status', 'published_at'
    ];
    
    protected $casts = [
        'published_at' => 'datetime',
    ];
    
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function disasterCategory()
    {
        return $this->belongsTo(DisasterCategory::class);
    }
    
    public function comments()
    {
        return $this->hasMany(ArticleComment::class);
    }
    
    public function approvals()
    {
        return $this->hasMany(ArticleApproval::class);
    }
    
    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
    
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
```

### 5. Routes

**routes/web.php:**

```php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DisasterController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Contributor\DashboardController as ContributorDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jenis-bencana', [DisasterController::class, 'index'])->name('disasters.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/artikel/{article}/comment', [ArticleController::class, 'storeComment'])->name('articles.comment');

// Authentication routes
Auth::routes();

// Contributor routes
Route::middleware(['auth', 'role:contributor'])->prefix('contributor')->group(function () {
    Route::get('/dashboard', [ContributorDashboard::class, 'index'])->name('contributor.dashboard');
    Route::resource('articles', ArticleController::class)->except(['show']);
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    Route::resource('disasters', DisasterController::class);
    Route::post('/articles/{article}/approve', [ArticleController::class, 'approve'])->name('articles.approve');
    Route::post('/articles/{article}/reject', [ArticleController::class, 'reject'])->name('articles.reject');
});
```

### 6. Middleware untuk Role

**app/Http/Middleware/CheckRole.php:**

```php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Unauthorized action.');
        }
        
        return $next($request);
    }
}
```

**Register di Kernel.php:**

```php
protected $routeMiddleware = [
    // ...
    'role' => \App\Http\Middleware\CheckRole::class,
];
```

### 7. Controllers

**ContributorDashboardController.php:**

```php
namespace App\Http\Controllers\Contributor;

use App\Http\Controllers\Controller;
use App\Models\Article;

class DashboardController extends Controller
{
    public function index()
    {
        $articles = Article::where('user_id', auth()->id())
            ->latest()
            ->get();
            
        $stats = [
            'total' => $articles->count(),
            'published' => $articles->where('status', 'published')->count(),
            'pending' => $articles->where('status', 'pending')->count(),
            'draft' => $articles->where('status', 'draft')->count(),
        ];
        
        return view('contributor.dashboard', compact('articles', 'stats'));
    }
}
```

**ArticleController.php:**

```php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\DisasterCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function create()
    {
        $categories = DisasterCategory::all();
        return view('contributor.article-form', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'disaster_category_id' => 'required|exists:disaster_categories,id',
            'content' => 'required',
            'cover_image' => 'nullable|image|max:2048',
        ]);
        
        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title']);
        $validated['status'] = $request->has('publish') ? 'pending' : 'draft';
        
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('articles', 'public');
        }
        
        Article::create($validated);
        
        return redirect()->route('contributor.dashboard')
            ->with('success', 'Artikel berhasil disimpan!');
    }
    
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->with(['user', 'disasterCategory', 'comments'])
            ->published()
            ->firstOrFail();
            
        return view('home.article-detail', compact('article'));
    }
}
```

### 8. Views dengan Blade

**resources/views/layouts/app.blade.php:**

```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIGAP ALAM')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @stack('styles')
</head>
<body>
    @include('layouts.navbar')
    
    @yield('content')
    
    @include('layouts.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
```

**resources/views/contributor/dashboard.blade.php:**

```blade
@extends('layouts.app')

@section('title', 'Dashboard Kontributor')

@section('content')
<div class="d-flex">
    @include('layouts.sidebar')
    
    <main class="main-content">
        <h1 class="h2 mb-4">Dashboard Kontributor</h1>
        
        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-icon gradient-blue">
                        <i class="bi bi-file-text text-white"></i>
                    </div>
                    <p class="stats-number">{{ $stats['total'] }}</p>
                    <p class="stats-label">Total Artikel</p>
                </div>
            </div>
            <!-- More stats cards... -->
        </div>
        
        <!-- Articles Table -->
        <div class="table-custom">
            <div class="p-4 border-bottom d-flex justify-content-between">
                <h2 class="h5 mb-0">Artikel Saya</h2>
                <a href="{{ route('articles.create') }}" class="btn btn-custom-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Buat Artikel Baru
                </a>
            </div>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->disasterCategory->name }}</td>
                        <td>
                            <span class="badge-custom badge-{{ $article->status }}">
                                {{ ucfirst($article->status) }}
                            </span>
                        </td>
                        <td>{{ $article->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('articles.edit', $article) }}" class="btn-icon btn-icon-green">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-icon-red" onclick="return confirm('Hapus artikel?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
```

---

## 💻 Teknologi yang Digunakan

### Frontend
- **HTML5** - Struktur semantik
- **CSS3** - Custom styling
- **Bootstrap 5.3** - Framework CSS
- **Bootstrap Icons** - Icon library
- **JavaScript ES6+** - Interaktivitas

### Backend (untuk implementasi)
- **Laravel 10** - PHP Framework
- **MySQL** - Database
- **Blade** - Template engine

---

## ✨ Fitur Utama

### User (Masyarakat Umum)
- ✅ Lihat jenis-jenis bencana
- ✅ Baca artikel edukasi
- ✅ Komentar pada artikel (tanpa login)
- ✅ Filter artikel berdasarkan kategori

### Kontributor
- ✅ Dashboard dengan statistik artikel
- ✅ Create, Read, Update, Delete artikel
- ✅ Simpan sebagai draft atau kirim untuk review
- ✅ Upload cover image artikel
- ✅ Lihat status approval artikel

### Admin
- ✅ Dashboard overview sistem
- ✅ CRUD jenis bencana
- ✅ Approve/Reject artikel kontributor
- ✅ Manajemen user
- ✅ Lihat statistik keseluruhan

---

## 🎨 Design System

### Color Palette
- **Primary Green**: #16a34a (Tema lingkungan)
- **Primary Blue**: #2563eb (Tema air/bencana)
- **Emerald**: #10b981
- **Cyan**: #06b6d4

### Typography
- **Font Family**: Inter, system fonts
- **Heading**: 600 weight
- **Body**: 400 weight
- **Line Height**: 1.6 (body), 1.8 (artikel)

### Components
- **Rounded corners**: 1.5rem (card), 1rem (button)
- **Shadows**: Soft, layered
- **Hover effects**: translateY(-8px), scale(1.05)
- **Transitions**: 0.3s ease

---

## 📝 Catatan Implementasi

### Best Practices
1. **Validasi Form**: Gunakan Laravel validation
2. **Security**: CSRF protection, XSS prevention
3. **File Upload**: Validasi tipe dan ukuran file
4. **Slug Generation**: Auto-generate dari title
5. **Authorization**: Pastikan user hanya edit artikel sendiri
6. **Soft Deletes**: Consider soft delete untuk artikel

### Performance
1. **Eager Loading**: Gunakan `with()` untuk relasi
2. **Pagination**: Batasi artikel per halaman
3. **Image Optimization**: Resize dan compress gambar
4. **Caching**: Cache kategori bencana
5. **Indexing**: Index kolom yang sering di-query

---

## 🚀 Cara Menjalankan

### Versi HTML (Static)
```bash
# Buka file HTML di browser
open index.html
```

### Versi Laravel (Setelah implementasi)
```bash
# Copy file HTML ke Laravel views
# Setup database
php artisan migrate
php artisan db:seed

# Run server
php artisan serve

# Compile assets
npm run dev
```

---

## 📞 Support

Untuk pertanyaan atau bantuan implementasi:
- Email: dev@sigapalam.com
- Dokumentasi Laravel: https://laravel.com/docs

---

## 📄 License

MIT License - Free to use for educational purposes

---

**Developed with ❤️ for Indonesia**
