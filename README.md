# SIGAP ALAM - Sistem Edukasi Lingkungan dan Kesadaran Bencana

## Deskripsi
SIGAP ALAM adalah platform web untuk edukasi lingkungan dan kesadaran bencana yang dirancang untuk membantu masyarakat Indonesia memahami, mencegah, dan menghadapi berbagai jenis bencana alam.

## ✨ Fitur Visual yang Diterapkan

### Desain System
- **Rounded Corners & Soft Shadows** - Semua card menggunakan rounded-2xl dengan shadow-lg
- **Gradient Background** - Hero section dengan gradient hijau-biru yang eye-catching
- **Hover Effects** - Scale transform, shadow enhancement, dan color transitions
- **Consistent Icons** - Lucide React outline style icons di seluruh aplikasi
- **Whitespace** - Spacing yang generous untuk keterbacaan optimal

### Animasi & Interaksi
- **Scroll Animations** - Fade-in dan slide-up menggunakan Motion/React
- **Stagger Children** - Card grid dengan staggered animation
- **Smooth Transitions** - Hover states dengan transisi 300ms
- **Button Hover** - Scale 1.05 dan shadow enhancement
- **Table Row Hover** - Gradient background highlight

### Tipografi
- **Heading Hierarchy** - Text-3xl hingga text-6xl dengan clear hierarchy
- **Line Height** - Leading-relaxed untuk konten artikel (1.8)
- **Font Weight** - Medium (500) untuk headings, normal (400) untuk body

### Dashboard Modern
- **Card Statistics** - Gradient icon backgrounds dengan shadow
- **Zebra Rows** - Alternating table backgrounds dengan hover gradient
- **Sidebar Active State** - Gradient button dengan white indicator bar
- **Modern Table** - Gradient header dan smooth hover effects

### Color Palette
- **Primary Green** - #16a34a, #22c55e (Environmental theme)
- **Primary Blue** - #2563eb, #3b82f6 (Water/disaster theme)
- **Gradients** - from-green-600 via-emerald-600 to-blue-600
- **Status Colors** - Green (success), Yellow (pending), Gray (draft), Red (danger)

## Target Pengguna
1. **User/Masyarakat Umum** - Mengakses informasi dan artikel edukasi
2. **Kontributor** - Membuat dan mengelola artikel edukasi
3. **Admin** - Mengelola sistem, data bencana, dan artikel

## Halaman yang Tersedia

### User - Landing Page
- Navbar dengan menu navigasi
- Hero section dengan informasi utama
- Section kategori bencana (grid card)
- Section artikel edukasi terbaru
- Footer dengan informasi sistem

### User - Jenis Bencana
- Daftar lengkap jenis bencana dalam grid card
- Breadcrumb navigation
- Setiap card memiliki ikon, nama, deskripsi, dan tombol detail

### User - Detail Artikel
- Judul artikel dan gambar sampul
- Informasi penulis dan tanggal publikasi
- Konten artikel lengkap
- Section komentar interaktif

### Kontributor - Dashboard
- Sidebar navigasi (Dashboard, Artikel Saya, Buat Artikel, Profil, Logout)
- Card statistik artikel (total, published, pending, draft)
- Tabel daftar artikel dengan status dan aksi (view, edit, delete)

### Kontributor - Form Artikel
- Form input: Judul, Kategori, Konten, Upload Gambar
- Editor konten dengan format markdown
- Tombol: Simpan Draft dan Kirim untuk Review
- Validasi form

### Admin - Dashboard
- Sidebar navigasi (Dashboard, Kelola Bencana, Artikel, Tips, Pengguna)
- Card statistik sistem (jenis bencana, artikel, pengguna, views)
- Aksi cepat untuk kelola berbagai modul
- Tabel artikel menunggu persetujuan dengan aksi approve/reject

### Admin - Kelola Bencana
- Tabel CRUD untuk jenis bencana
- Modal form untuk tambah dan edit data
- Tombol aksi: Tambah, Edit, Hapus
- Validasi form

## Desain & Teknologi

### Palet Warna
- Hijau (#16a34a, #22c55e) - Tema lingkungan
- Biru (#2563eb, #3b82f6) - Tema air/bencana
- Abu-abu untuk elemen netral

### Teknologi (Current Implementation)
- **Frontend Framework**: React + TypeScript
- **Styling**: Tailwind CSS
- **Icons**: Lucide React
- **State Management**: React Hooks (useState)

### Adaptasi ke Laravel + Bootstrap
Struktur komponen dirancang agar mudah diadaptasi ke:
- **Backend**: Laravel (Blade templates)
- **Styling**: Bootstrap 5
- **JavaScript**: Vanilla JS

## Struktur Komponen

```
/src/app/
├── App.tsx                          # Main app dengan routing
├── components/
│   ├── Navbar.tsx                   # Komponen navbar untuk user
│   ├── Footer.tsx                   # Komponen footer
│   ├── Sidebar.tsx                  # Sidebar untuk dashboard (kontributor/admin)
│   ├── LandingPage.tsx             # Halaman utama user
│   ├── JenisBencana.tsx            # Halaman daftar bencana
│   ├── DetailArtikel.tsx           # Halaman detail artikel
│   ├── DashboardKontributor.tsx    # Dashboard kontributor
│   ├── FormArtikel.tsx             # Form create/edit artikel
│   ├── DashboardAdmin.tsx          # Dashboard admin
│   └── KelolaBencana.tsx           # CRUD jenis bencana
```

## Fitur Utama

### User
- ✅ Browse jenis bencana
- ✅ Baca artikel edukasi
- ✅ Lihat tips pencegahan
- ✅ Komentar pada artikel

### Kontributor
- ✅ Dashboard dengan statistik artikel
- ✅ Create artikel dengan editor
- ✅ Edit dan delete artikel sendiri
- ✅ Upload gambar artikel
- ✅ Simpan draft atau kirim untuk review

### Admin
- ✅ Dashboard dengan overview sistem
- ✅ CRUD jenis bencana
- ✅ Approve/reject artikel kontributor
- ✅ Manajemen pengguna
- ✅ Statistik dan monitoring

## Role Switching (Demo)
Aplikasi memiliki role switcher di pojok kanan atas untuk demo:
- **User** - Akses halaman publik
- **Kontributor** - Akses dashboard kontributor
- **Admin** - Akses dashboard admin

## Panduan Adaptasi ke Laravel

### 1. Struktur Folder Laravel
```
resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php          # Layout utama
│   │   ├── navbar.blade.php       # Component navbar
│   │   ├── footer.blade.php       # Component footer
│   │   └── sidebar.blade.php      # Component sidebar
│   ├── user/
│   │   ├── landing.blade.php      # Landing page
│   │   ├── jenis-bencana.blade.php
│   │   └── detail-artikel.blade.php
│   ├── contributor/
│   │   ├── dashboard.blade.php
│   │   └── form-artikel.blade.php
│   └── admin/
│       ├── dashboard.blade.php
│       └── kelola-bencana.blade.php
```

### 2. Migrasi Database
```php
// migrations/create_disasters_table.php
Schema::create('disasters', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description');
    $table->string('icon')->nullable();
    $table->timestamps();
});

// migrations/create_articles_table.php
Schema::create('articles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->foreignId('disaster_id')->constrained();
    $table->string('title');
    $table->text('content');
    $table->string('image')->nullable();
    $table->enum('status', ['draft', 'pending', 'published', 'rejected']);
    $table->timestamps();
});
```

### 3. Controllers
- `HomeController` - Landing page
- `DisasterController` - Jenis bencana
- `ArticleController` - Artikel (dengan middleware role)
- `DashboardController` - Dashboard kontributor & admin

### 4. Middleware
- `auth` - Autentikasi
- `role:contributor` - Akses kontributor
- `role:admin` - Akses admin

### 5. Routes
```php
// Public routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/jenis-bencana', [DisasterController::class, 'index']);
Route::get('/artikel/{id}', [ArticleController::class, 'show']);

// Contributor routes
Route::middleware(['auth', 'role:contributor'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'contributor']);
    Route::resource('artikel', ArticleController::class);
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'admin']);
    Route::resource('admin/bencana', DisasterController::class);
});
```

## Catatan Penting

- Desain mengutamakan kesederhanaan dan kemudahan dibaca
- UI bersih dan edukatif dengan palet hijau-biru
- Komponen reusable dan mudah di-maintain
- Responsive untuk mobile dan desktop
- Form memiliki validasi
- CRUD operations dengan modal/form standar

## License
MIT License - Free to use for educational purposes