<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <a class="navbar-brand">
                    <div class="logo-icon">SA</div>SIGAP ALAM
                </a>
                <p style="color: #c5c5c5">Sistem informasi Edukasi Lingkungan dan Kesadaran Bencana untuk
                    meningkatkan kesiapsiagaan
                    masyarakat Indonesia dalam menghadapi berbagai jenis bencana alam.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">Link Cepat</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="mb-2"><a href="{{ route('jenis-bencana') }}">Jenis Bencana</a></li>
                    <li class="mb-2"><a href="{{ route('artikel.index') }}">Artikel</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">Kontak</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-envelope me-2"></i>
                        info@sigapalam.com
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-phone me-2"></i>
                        +62 21 1234 5678
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-geo-alt me-2"></i>
                        Jakarta, Indonesia
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="mb-0">&copy; 2025 SIGAP ALAM. All rights reserved.</p>
        </div>
    </div>
</footer>
@include('alert')
<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Premium JS -->
<script src="{{ asset('assets/js/premium-script.js') }}"></script>

<script>
    document.querySelectorAll('.beranda').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.closest('a')) return;

            toast.info('Memuat...', 'Membuka halaman Beranda');
            setTimeout(() => {
                window.location.href = '/';
            }, 500);
        });
    });
</script>

<script>
    document.querySelectorAll('.jenis-bencana').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.closest('a')) return;

            toast.info('Memuat...', 'Membuka halaman Jenis Bencana');
            setTimeout(() => {
                window.location.href = '/jenis-bencana';
            }, 500);
        });
    });
</script>

<script>
    document.querySelectorAll('.loginn').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.closest('a')) return;

            toast.info('Memuat...', 'Membuka halaman Login');
            setTimeout(() => {
                window.location.href = '/login';
            }, 500);
        });
    });
</script>

<script>
    document.querySelectorAll('.artikel').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.closest('a')) return;

            toast.info('Memuat...', 'Membuka halaman Artikel');
            setTimeout(() => {
                window.location.href = '/artikel';
            }, 500);
        });
    });
</script>
</body>

</html>
