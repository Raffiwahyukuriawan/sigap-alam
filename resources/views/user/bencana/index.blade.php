@include('user.template.header')

<!-- Navbar -->
@include('user.template.navbar')

<!-- Breadcrumb -->
<div class="breadcrumb-custom" style="height: 50px">
    <div class="container py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="">
                    <div class="beranda" data-url="{{ route('/') }}">
                        Beranda
                    </div>
                </li>
                <li class="breadcrumb-item active" aria-current="page"></li>
                <li class="breadcrumb-item active" aria-current="page"> Jenis Bencana</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Header -->
<section class="hero-section">
    <div class="container text-center hero-content">
        <div class="hero-badge">📚 Katalog Bencana</div>
        <h1 class="hero-title">Jenis-Jenis Bencana Alam</h1>
        <p class="hero-subtitle" style="max-width: 700px; margin: 0 auto;">
            Kenali berbagai jenis bencana alam yang sering terjadi di Indonesia.
            Pahami karakteristik, dampak, dan cara menghadapi setiap jenis bencana.
        </p>
    </div>
</section>

<!-- Disaster Grid -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">

            @forelse ($categories as $category)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card-custom h-100">

                        <div class="text-center mb-4 p-4 rounded-4 {{ $category->gradient_class }}">
                            <i class="bi {{ $category->icon ?? 'bi-exclamation-circle' }} text-white"
                                style="font-size: 4rem;"></i>
                        </div>

                        <h3 class="h5 mb-3">
                            {{ $category->name }}
                        </h3>

                        <p class="text-muted small mb-3">
                            {{ Str::limit($category->description, 50) }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <small class="text-muted">
                                <i class="bi bi-check-circle text-success me-1"></i>
                                {{ $category->articles_count }} Artikel
                            </small>
                            <div data-url="{{ route('bencana.show.article', $category->id) }}"
                                class="text-success small fw-semibold show-article">
                                Detail <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada data jenis bencana.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>

<!-- Info Section -->
<section class="py-5 bg-gradient-card">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold mb-3">Mengapa Penting Memahami Jenis Bencana?</h2>
            <p class="lead text-muted">Pengetahuan adalah kunci kesiapsiagaan</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-custom">
                    <div class="card-icon gradient-green mb-3">
                        <span class="text-white fw-bold" style="font-size: 1.5rem;">1</span>
                    </div>
                    <h3 class="h5 mb-3">Kesiapsiagaan</h3>
                    <p class="text-muted">
                        Memahami jenis bencana membantu kita lebih siap dan tahu apa yang harus dilakukan saat
                        bencana terjadi.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom animate-delay-1">
                    <div class="card-icon gradient-blue mb-3">
                        <span class="text-white fw-bold" style="font-size: 1.5rem;">2</span>
                    </div>
                    <h3 class="h5 mb-3">Mitigasi</h3>
                    <p class="text-muted">
                        Dengan pengetahuan yang tepat, kita dapat melakukan upaya pencegahan dan mengurangi dampak
                        bencana.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom animate-delay-2">
                    <div class="card-icon gradient-green mb-3">
                        <span class="text-white fw-bold" style="font-size: 1.5rem;">3</span>
                    </div>
                    <h3 class="h5 mb-3">Keselamatan</h3>
                    <p class="text-muted">
                        Pengetahuan tentang bencana dapat menyelamatkan nyawa Anda dan keluarga saat situasi
                        darurat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
@include('user.template.footer')
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
