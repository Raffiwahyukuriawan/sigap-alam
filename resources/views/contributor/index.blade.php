<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kontributor - SIGAP ALAM</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .stats-icon {
            width: 60px;
            height: 60px;
            font-size: 32px;
            /* ukuran icon */
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            /* opsional, biar rounded */
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    @include('contributor.template.sidebar')

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="mb-4">
            <h1 class="h2 mb-2">Dashboard Kontributor</h1>
            <p class="text-muted">Kelola artikel edukasi Anda</p>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="stats-card">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stats-icon gradient-blue bg-primary">
                            <i class="bi bi-file-text text-white"></i>
                        </div>
                        <div class="text-end">
                            <p class="stats-label mb-0">Total Artikel</p>
                            <p class="stats-number mb-0">{{ $total }}</p>
                            </p>
                        </div>
                    </div>
                    <div class="stats-trend">
                        <i class="bi bi-graph-up"></i>
                        <span>Aktif menulis</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stats-card animate-delay-1">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stats-icon gradient-green bg-success">
                            <i class="bi bi-check-circle text-white"></i>
                        </div>
                        <div class="text-end">
                            <p class="stats-label mb-0">Published</p>
                            <p class="stats-number mb-0">{{ $published }}</p>
                            </p>
                        </div>
                    </div>
                    <div class="stats-trend">
                        <i class="bi bi-graph-up"></i>
                        <span>Diterbitkan</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stats-card animate-delay-2">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stats-icon gradient-yellow bg-warning">
                            <i class="bi bi-clock text-white"></i>
                        </div>
                        <div class="text-end">
                            <p class="stats-label mb-0">Pending</p>
                            <p class="stats-number mb-0">{{ $pending }}</p>
                            </p>
                        </div>
                    </div>
                    <div class="text-warning small">
                        <i class="bi bi-clock"></i>
                        <span>Menunggu review</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stats-card animate-delay-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stats-icon gradient-gray bg-secondary">
                            <i class="bi bi-x-circle text-white"></i>
                        </div>
                        <div class="text-end">
                            <p class="stats-label mb-0">Draft</p>
                            <p class="stats-number mb-0">{{ $draft }}</p>
                            </p>
                        </div>
                    </div>
                    <div class="text-muted small">
                        <i class="bi bi-file-earmark"></i>
                        <span>Belum selesai</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Articles Table -->
        <div class="table-custom">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                <h2 class="h5 mb-0">Artikel Saya</h2>
                <a href="{{ route('contributor.artikel.store.show') }}" class="btn btn-custom-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Buat Artikel Baru
                </a>
            </div>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Views</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                            <tr class="article-row" data-status="published">
                                <td class="article-title">{{ $article->title }}</td>
                                <td><span class="text-muted">{{ $article->category->name ?? '-' }}</span></td>
                                <td><span class="badge-custom badge-published">
                                        @if ($article->status == 'published')
                                            <span class="badge-custom badge-published">Published</span>
                                        @elseif ($article->status == 'pending')
                                            <span class="badge-custom badge-pending">Pending</span>
                                        @elseif ($article->status == 'draft')
                                            <span class="badge-custom badge-draft">Draft</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </span></td>
                                <td><span class="text-muted"> {{ $article->created_at->format('d F Y') }}
                                    </span></td>
                                <td><span class="text-muted">{{ $article->views }}</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('contributor.show.artikel',$article->id) }}" class="btn-icon btn-icon-blue" title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('contributor.artikel.edit.show', $article->id) }}"
                                            class="btn-icon btn-icon-green" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('contributor.artikel.destroy', $article->id) }}"
                                            method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-icon-red">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Belum ada artikel
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    @include('alert')
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
