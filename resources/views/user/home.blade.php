@include('user.template.header')

<!-- Navbar -->
@include('user.template.navbar')

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <div class="hero-badge">🌍 Platform Edukasi Bencana Terpercaya</div>
                <h1 class="hero-title">
                    Bersama Melindungi<br>
                    <span style="color: #fbbf24;">Lingkungan & Kehidupan</span>
                </h1>
                <p class="hero-subtitle">
                    SIGAP ALAM membantu masyarakat Indonesia memahami, mencegah, dan menghadapi
                    berbagai jenis bencana alam dengan pengetahuan yang tepat.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#jenis-bencana" class="btn btn-light text-success">
                        Mulai Belajar
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <a href="#artikel" class="btn btn-custom-secondary bg-white bg-opacity-10 text-white border-white">
                        Lihat Artikel
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="https://images.unsplash.com/photo-1591302299935-2ce91947afc1?w=800&q=80"
                    alt="Environmental Education" class="img-fluid hero-image">
            </div>
        </div>
    </div>

    <div class="hero-wave text-bg">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path d="M0,40
                   C120,80 240,120 360,110
                   480,100 600,40 720,40
                   840,40 960,100 1080,110
                   1200,120 1320,80 1440,40
                   L1440,120 L0,120 Z" fill="#ffffff" />
        </svg>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-custom text-center">
                    <div class="card-icon gradient-blue mx-auto mb-3">
                        <i class="bi bi-book text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="card-title">Edukasi Lengkap</h3>
                    <p class="card-description">Akses informasi lengkap tentang berbagai jenis bencana alam</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom text-center animate-delay-1">
                    <div class="card-icon gradient-green mx-auto mb-3">
                        <i class="bi bi-shield-check text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="card-title">Mitigasi Bencana</h3>
                    <p class="card-description">Pelajari cara mencegah dan mengurangi dampak bencana</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom text-center animate-delay-2">
                    <div class="card-icon gradient-blue mx-auto mb-3">
                        <i class="bi bi-people text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="card-title">Komunitas Peduli</h3>
                    <p class="card-description">Bergabung dengan komunitas yang peduli lingkungan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Disaster Categories -->
<section class="py-5 bg-white" id="jenis-bencana">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge badge-custom bg-success bg-opacity-10 text-success mb-3">Kategori Bencana</span>
            <h2 class="display-5 fw-bold mb-3">Jenis Bencana Alam</h2>
            <p class="lead text-muted">Pelajari berbagai jenis bencana dan cara menghadapinya</p>
        </div>

        <div class="row g-4">
            @foreach ($categories as $category)
                <div class="col-md-6 col-lg-4">
                    <div class="card-custom animate-delay-{{ $loop->index }}">
                        <div class="card-icon {{ $category->gradient_class ?? 'gradient-blue' }} mb-3">
                            <i class="bi {{ $category->icon }} text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h3 class="card-title">{{ $category->name }}</h3>
                        <p class="card-description">{{ Str::limit($category->description, 120) }}</p>
                        <div data-url="{{ route('bencana.show.article', $category->id) }}" class="card-link show-article">
                            Pelajari Lebih Lanjut
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('jenis-bencana') }}" class="text-success fw-semibold">
                Lihat Semua Jenis Bencana
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Latest Articles -->
<section class="py-5 bg-gradient-card" id="artikel">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge badge-custom bg-primary bg-opacity-10 text-primary mb-3">Konten Edukasi</span>
            <h2 class="display-5 fw-bold mb-3">Artikel Edukasi Terbaru</h2>
            <p class="lead text-muted">Baca artikel dan tips dari para ahli</p>
        </div>

        <div class="row g-4">
            @forelse ($articles as $index => $article)
                <div class="col-md-6 col-lg-4">
                    <div data-url="{{ route('show.artikel', $article->id) }}"
                        class="to-artikel {{ $index > 0 ? 'animate-delay-' . $index : '' }}">
                        <div class="article-image-container">
                            <img src="{{ $article->cover_image
                                ? asset('storage/' . $article->cover_image)
                                : 'https://via.placeholder.com/800x400?text=No+Image' }}"
                                alt="{{ $article->title }}" class="article-image">

                            <span class="article-category-badge">
                                {{ $article->category->name ?? '-' }}
                            </span>
                        </div>

                        <div class="article-content">
                            <h3 class="h5 mb-3">{{ $article->title }}</h3>

                            <p class="text-muted mb-3">
                                {{ Str::limit(strip_tags($article->content), 100, '...') }}
                            </p>

                            <div class="article-meta">
                                <span>
                                    <i class="bi bi-person me-1"></i>
                                    {{ $article->user->name ?? '-' }}
                                </span>

                                @if ($article->published_at)
                                    <span>
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ $article->published_at->translatedFormat('d M Y') }}
                                    </span>
                                @endif
                            </div>

                            <div data-url="{{ route('show.artikel', $article->id) }}"
                                class="card-link d-block mt-3 to-artikel">
                                Baca Selengkapnya
                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada artikel tersedia.</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('artikel.index') }}" class="text-primary fw-semibold">
                Lihat Semua Artikel
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="hero-section py-5 mb-5">
    <div class="container text-center hero-content">
        <h2 class="display-5 fw-bold text-white mb-4">Ingin Berkontribusi?</h2>
        <p class="lead text-white mb-4" style="max-width: 600px; margin: 0 auto;">
            Bergabunglah sebagai kontributor dan bagikan pengetahuan Anda untuk
            membantu masyarakat lebih siap menghadapi bencana.
        </p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 py-3 rounded-xl text-success">
            Daftar Sebagai Kontributor
        </a>
    </div>
</section>

<!-- Footer -->
@include('user.template.footer')
<script>
    document.querySelectorAll('.article-cardss').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.closest('a')) return;

            toast.info('Memuat...', 'Membuka artikel');
            setTimeout(() => {
                window.location.href = this.dataset.url;
            }, 500);
        });
    });
</script>

<script>
    document.querySelectorAll('.to-artikel').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.closest('a')) return;

            toast.info('Memuat...', 'Membuka halaman Artikel');
            setTimeout(() => {
                window.location.href = this.dataset.url;;
            }, 500);
        });
    });
</script>

<script>
    document.querySelectorAll('.show-article').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.closest('a')) return;

            toast.info('Memuat...', 'Membuka halaman Artikel');
            setTimeout(() => {
                window.location.href = this.dataset.url;
            }, 500);
        });
    });
</script>
