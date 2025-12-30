<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Artikel - Admin SIGAP ALAM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/premium-style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .sidebar {
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: white;
            border-right: 1px solid var(--gray-200);
            box-shadow: var(--shadow-md);
            z-index: 1000;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-logo-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            box-shadow: var(--shadow-green);
        }

        .sidebar-menu {
            padding: 1rem;
            list-style: none;
            margin: 0;
        }

        .sidebar-menu-item {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            border-radius: var(--radius-lg);
            color: var(--gray-600);
            text-decoration: none;
            transition: all var(--transition-base);
            font-weight: 500;
        }

        .sidebar-menu-link:hover {
            background: linear-gradient(to right, var(--gray-50), rgba(5, 150, 105, 0.05));
            color: var(--gray-900);
        }

        .sidebar-menu-link.active {
            background: var(--gradient-primary);
            color: white;
            box-shadow: var(--shadow-green);
            font-weight: 600;
        }

        .sidebar-menu-link i {
            font-size: 1.25rem;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        .btn-logout {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            border-radius: var(--radius-lg);
            color: var(--danger);
            text-decoration: none;
            transition: all var(--transition-base);
            background: transparent;
            border: none;
            font-weight: 500;
        }

        .btn-logout:hover {
            background: #fef2f2;
            color: #b91c1c;
        }

        .main-content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
            background: linear-gradient(to bottom right, var(--gray-50), #eff6ff);
        }

        .table-container {
            background: white;
            border-radius: var(--radius-xl);
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .table-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            background: linear-gradient(to right, var(--gray-50), #eff6ff);
        }

        .table thead th {
            background: var(--gray-50);
            color: var(--gray-700);
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem 1.5rem;
            border-bottom: 2px solid var(--gray-200);
        }

        .table tbody tr {
            border-bottom: 1px solid var(--gray-100);
            transition: background var(--transition-fast);
        }

        .table tbody tr:hover {
            background: var(--gray-50);
        }

        .table tbody td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
        }

        .badge-status {
            padding: 0.5rem 1rem;
            border-radius: var(--radius-full);
            font-size: 0.8125rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        .badge-published {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-draft {
            background: var(--gray-200);
            color: var(--gray-700);
        }

        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 0.625rem 1.25rem;
            border-radius: var(--radius-lg);
            border: 2px solid var(--gray-200);
            background: white;
            color: var(--gray-600);
            font-weight: 500;
            cursor: pointer;
            transition: all var(--transition-base);
        }

        .filter-tab:hover {
            border-color: var(--primary-green);
            color: var(--primary-green);
        }

        .filter-tab.active {
            background: var(--gradient-primary);
            color: white;
            border-color: transparent;
            box-shadow: var(--shadow-green);
        }

        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform var(--transition-base);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    @include('admin.template.sidebar')

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 mb-2">Kelola Artikel</h1>
                <p class="text-muted mb-0">Review dan kelola semua artikel yang dikirim kontributor</p>
            </div>
            <button class="btn btn-custom-primary d-lg-none" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <a href="{{ route('admin.artikel', ['status' => 'all']) }}"
                class="filter-tab {{ $status == 'all' || !$status ? 'active' : '' }}">
                Semua
                <span class="badge bg-secondary ms-1">{{ $countAll }}</span>
            </a>

            <a href="{{ route('admin.artikel', ['status' => 'pending']) }}"
                class="filter-tab {{ $status == 'pending' ? 'active' : '' }}">
                Pending
                <span class="badge bg-warning text-dark ms-1">{{ $countPending }}</span>
            </a>

            <a href="{{ route('admin.artikel', ['status' => 'published']) }}"
                class="filter-tab {{ $status == 'published' ? 'active' : '' }}">
                Published
                <span class="badge bg-success ms-1">{{ $countPublished }}</span>
            </a>
        </div>

        <!-- Articles Table -->
        <div class="table-container">
            <div class="table-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="h5 mb-0">Daftar Artikel</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Cari artikel..." id="searchInput"
                                onkeyup="searchArticles()">
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Judul Artikel</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Views</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="articlesTableBody">
                        @foreach ($articles as $a)
                            <tr class="article-row" data-title="{{ strtolower($a->title) }}"
                                data-author="{{ strtolower($a->user->name) }}"
                                data-category="{{ strtolower($a->category->name) }}"
                                data-status="{{ $a->status }}">
                                <td>
                                    <div class="fw-semibold text-gray-900">{{ $a->title }}
                                    </div>
                                    <small class="text-muted">{{ $a->slug }}</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-gradient-primary rounded-circle text-white d-flex align-items-center justify-content-center"
                                            style="width: 32px; height: 32px; font-size: 0.875rem; font-weight: 600;">
                                            {{ strtoupper(substr($a->user->name, 0, 2)) }}
                                        </div>
                                        <span>{{ $a->user->name }}</span>
                                    </div>
                                </td>
                                <td><span
                                        class="badge bg-primary bg-opacity-10 text-primary">{{ $a->category->name }}</span>
                                </td>
                                <td><span class="badge-status badge-{{ $a->status }}"><i
                                            class="bi bi-clock"></i>{{ ucfirst($a->status) }}</span>
                                </td>
                                <td><small class="text-muted">{{ $a->created_at->format('d M Y') }}</small></td>
                                <td><small class="text-muted">{{ $a->views }}</small></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.show.artikel',$a->id) }}" target="_blank" class="btn-icon btn-icon-blue">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        {{-- {{ route('artikel.show', $a->slug) }} --}}
                                        @if ($a->status === 'pending')
                                            <form action="{{ route('admin.artikel.approve', $a->id) }}" method="POST"
                                                class="form-approve" style="display:inline">
                                                @csrf
                                                <button type="submit" class="btn-icon btn-icon-green">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.artikel.reject', $a->id) }}" method="POST"
                                                class="form-reject" style="display:inline">
                                                @csrf
                                                <input type="hidden" name="reason">
                                                <button type="submit" class="btn-icon btn-icon-red">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: var(--radius-xl); border: none;">
                <div class="modal-header" style="border-bottom: 1px solid var(--gray-200);">
                    <h5 class="modal-title">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Setujui Artikel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menyetujui artikel ini untuk dipublikasikan?</p>
                    <div class="alert alert-success" style="border-radius: var(--radius-lg);">
                        <i class="bi bi-info-circle me-2"></i>
                        Artikel yang disetujui akan langsung tampil di halaman publik.
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--gray-200);">
                    <button type="button" class="btn btn-custom-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-custom-primary" onclick="confirmApprove()">
                        <i class="bi bi-check-lg me-2"></i>Ya, Setujui
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: var(--radius-xl); border: none;">
                <div class="modal-header" style="border-bottom: 1px solid var(--gray-200);">
                    <h5 class="modal-title">
                        <i class="bi bi-x-circle text-danger me-2"></i>
                        Tolak Artikel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Berikan alasan penolakan kepada penulis:</p>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alasan Penolakan</label>
                        <textarea class="form-control" id="rejectReason" rows="4"
                            placeholder="Contoh: Konten kurang lengkap, perlu ditambahkan referensi..."
                            style="border-radius: var(--radius-lg);"></textarea>
                    </div>
                    <div class="alert alert-warning" style="border-radius: var(--radius-lg);">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Penulis akan menerima notifikasi penolakan dengan catatan Anda.
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--gray-200);">
                    <button type="button" class="btn btn-custom-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn" style="background: var(--danger); color: white;"
                        onclick="confirmReject()">
                        <i class="bi bi-x-lg me-2"></i>Tolak Artikel
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('alert')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/premium-script.js') }}"></script>

    <script>
        let currentArticleId = null;

        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('active');
        }

        function logout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                toast.info('Logging out...', 'Mengalihkan ke halaman login');
                setTimeout(() => {
                    window.location.href = 'login.html';
                }, 1000);
            }
        }

        function filterArticles(status) {
            const rows = document.querySelectorAll('.article-row');
            const tabs = document.querySelectorAll('.filter-tab');

            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.closest('.filter-tab').classList.add('active');

            let count = 0;
            rows.forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                    count++;
                } else {
                    row.style.display = 'none';
                }
            });

            toast.info('Filter Diterapkan', `Menampilkan ${count} artikel`);
        }

        function searchArticles() {
            const keyword = document.getElementById('searchInput').value.toLowerCase();
            const activeStatus = document.querySelector('.filter-tab.active')?.dataset.status || 'all';
            const rows = document.querySelectorAll('.article-row');

            rows.forEach(row => {
                const matchText =
                    row.dataset.title.includes(keyword) ||
                    row.dataset.author.includes(keyword) ||
                    row.dataset.category.includes(keyword);

                const matchStatus =
                    activeStatus === 'all' || row.dataset.status === activeStatus;

                row.style.display = matchText && matchStatus ? '' : 'none';
            });
        }

        function viewArticle(id) {
            toast.info('Membuka Artikel', 'Memuat preview artikel...');
            setTimeout(() => {
                window.open('detail-artikel.html', '_blank');
            }, 500);
        }

        function openApproveModal(id) {
            currentArticleId = id;
            const modal = new bootstrap.Modal(document.getElementById('approveModal'));
            modal.show();
        }

        function rejectArticle(id) {
            const reason = prompt('Alasan penolakan:');
            if (!reason) return;

            fetch(`/admin/artikel/${id}/reject`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({
                    reason
                })
            }).then(() => location.reload());
        }

        function confirmApprove() {
            fetch(`/artikel/${currentArticleId}/approve`, {
                    method: 'POST',
                    credentials: 'same-origin', // ⬅️ INI PENTING
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status) {
                        location.reload();
                    }
                })
                .catch(err => {
                    alert('Gagal approve artikel');
                    console.error(err);
                });
        }


        function rejectArticleWithModal(id) {
            currentArticleId = id;
            document.getElementById('rejectReason').value = '';
            const modal = new bootstrap.Modal(document.getElementById('rejectModal'));
            modal.show();
        }

        function confirmReject() {
            const reason = document.getElementById('rejectReason').value;

            if (!reason.trim()) {
                toast.error('Error', 'Harap isi alasan penolakan');
                return;
            }

            const modal = bootstrap.Modal.getInstance(document.getElementById('rejectModal'));
            modal.hide();

            toast.info('Memproses...', 'Menolak artikel');

            setTimeout(() => {
                toast.warning('Ditolak', 'Artikel telah ditolak dengan catatan');
                // Update row status
                const row = document.querySelector(`[onclick*="rejectArticleWithModal(${currentArticleId})"]`)
                    .closest('tr');
                row.dataset.status = 'rejected';
                row.querySelector('.badge-status').outerHTML =
                    '<span class="badge-status badge-rejected"><i class="bi bi-x-circle"></i>Rejected</span>';
            }, 1000);
        }

        function unpublishArticle(id) {
            if (confirm('Apakah Anda yakin ingin unpublish artikel ini?')) {
                toast.info('Memproses...', 'Mengubah status artikel');

                setTimeout(() => {
                    toast.warning('Unpublished', 'Artikel tidak lagi tampil di publik');
                }, 1000);
            }
        }
    </script>
</body>

</html>
