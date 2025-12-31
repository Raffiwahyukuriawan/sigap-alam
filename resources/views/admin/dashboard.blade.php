<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIGAP ALAM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/premium-style.css') }}">

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

        .stats-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-xl);
            padding: 1.75rem;
            transition: all var(--transition-base);
        }

        .stats-card:hover {
            box-shadow: var(--shadow-xl);
            transform: translateY(-4px);
        }

        .stats-icon {
            width: 56px;
            height: 56px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-lg);
            margin-bottom: 1rem;
        }

        .stats-number {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--gray-900);
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: var(--gray-600);
            font-size: 0.9375rem;
            font-weight: 500;
            margin-bottom: 0.75rem;
        }

        .stats-trend {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .stats-trend.up {
            color: var(--success);
        }

        .stats-trend.down {
            color: var(--danger);
        }

        .chart-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-xl);
            padding: 1.75rem;
        }

        .chart-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .recent-activities {
            max-height: 400px;
            overflow-y: auto;
        }

        .activity-item {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--gray-100);
            transition: background var(--transition-fast);
        }

        .activity-item:hover {
            background: var(--gray-50);
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 0.25rem;
        }

        .activity-desc {
            font-size: 0.875rem;
            color: var(--gray-600);
            margin-bottom: 0.25rem;
        }

        .activity-time {
            font-size: 0.75rem;
            color: var(--gray-400);
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
                <h1 class="h2 mb-2">Dashboard Administrator</h1>
                <p class="text-muted mb-0">Selamat datang kembali, Admin! 👋</p>
            </div>
            <button class="btn btn-custom-primary d-lg-none" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="card-custom animate-fade-in">
                    <div class="stats-icon gradient-blue">
                        <i class="bi bi-people-fill text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <div class="stats-number">{{ number_format($totalUsers) }}</div>
                    <div class="stats-label">Total Pengguna</div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card-custom animate-fade-in animate-delay-1">
                    <div class="stats-icon gradient-green">
                        <i class="bi bi-file-text-fill text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <div class="stats-number">{{ number_format($totalArticles) }}</div>
                    <div class="stats-label">Total Artikel</div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card-custom animate-fade-in animate-delay-2">
                    <div class="stats-icon gradient-yellow">
                        <i class="bi bi-clock-fill text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <div class="stats-number">{{ $pendingArticles }}</div>
                    <div class="stats-label">Pending Review</div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card-custom animate-fade-in animate-delay-3">
                    <div class="stats-icon gradient-purple">
                        <i class="bi bi-eye-fill text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <div class="stats-number">{{ number_format($totalViews) }}</div>
                    <div class="stats-label">Total Views</div>
                </div>
            </div>
        </div>

        <!-- Charts and Activity -->
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="chart-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="h5 mb-0">Statistik Artikel</h3>
                    </div>
                    <canvas id="articleChart" height="100"></canvas>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="chart-card">
                    <h3 class="h5 mb-4">Aktivitas Terbaru</h3>
                    <div class="recent-activities">

                        @foreach ($recentArticles as $a)
                            <div class="activity-item">
                                <div class="activity-icon" style="background:#dbeafe;color:#1e40af">
                                    <i class="bi bi-file-earmark-plus"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Artikel Baru</div>
                                    <div class="activity-desc">
                                        {{ $a->user->name }} menambahkan artikel "{{ $a->title }}"
                                    </div>
                                    <div class="activity-time">{{ $a->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        @endforeach

                        @foreach ($recentUsers as $u)
                            <div class="activity-item">
                                <div class="activity-icon" style="background:#d1fae5;color:#065f46">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Pengguna Baru</div>
                                    <div class="activity-desc">
                                        {{ $u->name }} bergabung sebagai {{ ucfirst($u->role) }}
                                    </div>
                                    <div class="activity-time">{{ $u->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card-custom text-center text-decoration-none">
                    <div class="card-icon gradient-blue mx-auto">
                        <i class="bi bi-file-earmark-check text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="h5 mb-2">Review Artikel</h3>
                    <p class="text-muted small mb-0">{{ $pendingArticles }} artikel menunggu persetujuan</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-custom text-center text-decoration-none animate-delay-1">
                    <div class="card-icon gradient-green mx-auto">
                        <i class="bi bi-people text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="h5 mb-2">Kelola Pengguna</h3>
                    <p class="text-muted small mb-0">{{ number_format($totalUsers) }} pengguna terdaftar</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-custom text-center text-decoration-none animate-delay-2">
                    <div class="card-icon gradient-orange mx-auto">
                        <i class="bi bi-exclamation-triangle text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="h5 mb-2">Jenis Bencana</h3>
                    <p class="text-muted small mb-0">{{ $totalDisasterCategory }} kategori bencana</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-custom text-center text-decoration-none animate-delay-2">
                    <div class="card-icon gradient-cyan mx-auto">
                        <i class="bi bi-lightbulb text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="h5 mb-2">Tips Pencegahan</h3>
                    <p class="text-muted small mb-0">{{ $totalTips }} tips tersedia</p>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="{{ asset('assets/js/premium-script.js') }}"></script>

    <script>
        const articleLabels = {!! json_encode($articlesPerDay->keys()) !!};
        const articleData = {!! json_encode($articlesPerDay->values()) !!};
    </script>

    <script>
        // Toggle sidebar on mobile
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('active');
        }

        // Chart.js - Article Statistics
        const ctx = document.getElementById('articleChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: articleLabels,
                    datasets: [{
                        label: 'Artikel Dipublikasi',
                        data: articleData,
                        borderColor: '#059669',
                        backgroundColor: 'rgba(5,150,105,.1)',
                        tension: .4,
                        fill: true
                    }]
                }
            });
        }
    </script>
</body>

</html>
