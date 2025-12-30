@include('user.template.header')

@include('user.template.navbar')

<!-- Breadcrumb -->
<div class="breadcrumb-custom" style="height: 50px">
    <div class="container py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li>
                    <div class="kembali-jenis-bencana" data-url="{{ route('jenis-bencana') }}">
                        Jenis Bencana
                    </div>
                </li>
                <li class="breadcrumb-item active" aria-current="page"></li>
                <li class="breadcrumb-item active" aria-current="page"> Artikel Bencana</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Header -->
<section class="hero-section">
    <div class="container text-center hero-content">
        <div class="hero-badge">📚 Edukasi Bencana</div>
        <h1 class="hero-title">Artikel Edukasi Bencana Alam {{ $category->name }}</h1>
        <p class="hero-subtitle" style="max-width: 700px; margin: 0 auto;">
            Baca artikel dan tips dari para ahli.
        </p>
    </div>
</section>

<!-- Artikel Section -->
<section class="py-5 bg-gradient-card" id="artikel">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge badge-custom bg-primary bg-opacity-10 text-primary mb-3">
                Konten Edukasi
            </span>
            <h2 class="display-5 fw-bold mb-3">Artikel Tentang {{ $category->name }}</h2>
            <p class="lead text-muted">{{ $category->description }}</< /p>
        </div>

        <div class="mb-5">
            <div class="d-flex align-items-center mb-3">
                <div class="icon-circle bg-success text-white me-2">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h3 class="mb-0">Tips Pencegahan</h3>
            </div>

            <div class="row g-3">
                @forelse ($tips as $tip)
                    <div class="col-md-6">
                        <div class="card-custom h-100">
                            <h5 class="fw-semibold mb-2">
                                <i class="bi bi-check-circle text-success me-1"></i>
                                {{ $tip->title }}
                            </h5>
                            <p class="text-muted mb-0">
                                {{ $tip->content }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light border text-muted">
                            Belum ada tips pencegahan untuk bencana ini.
                        </div>
                    </div>
                @endforelse
            </div>
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

                            <div class="card-link d-block mt-3">
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
    </div>
</section>

@include('user.template.footer')
<script>
    document.querySelectorAll('.kembali-jenis-bencana').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.closest('a')) return;

            toast.info('Memuat...', 'Membuka halaman Jenis Bencana');
            setTimeout(() => {
                window.location.href = this.dataset.url;;
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
