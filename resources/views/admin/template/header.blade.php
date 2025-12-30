<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna - Admin SIGAP ALAM</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/premium-style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .sidebar { width: 260px; position: fixed; top: 0; left: 0; height: 100vh; background: white; border-right: 1px solid var(--gray-200); box-shadow: var(--shadow-md); z-index: 1000; }
        .sidebar-header { padding: 1.5rem; border-bottom: 1px solid var(--gray-200); }
        .sidebar-logo { display: flex; align-items: center; gap: 0.75rem; }
        .sidebar-logo-icon { width: 40px; height: 40px; background: var(--gradient-primary); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; box-shadow: var(--shadow-green); }
        .sidebar-menu { padding: 1rem; list-style: none; margin: 0; }
        .sidebar-menu-item { margin-bottom: 0.5rem; }
        .sidebar-menu-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.875rem 1rem; border-radius: var(--radius-lg); color: var(--gray-600); text-decoration: none; transition: all var(--transition-base); font-weight: 500; }
        .sidebar-menu-link:hover { background: linear-gradient(to right, var(--gray-50), rgba(5, 150, 105, 0.05)); color: var(--gray-900); }
        .sidebar-menu-link.active { background: var(--gradient-primary); color: white; box-shadow: var(--shadow-green); font-weight: 600; }
        .sidebar-menu-link i { font-size: 1.25rem; }
        .sidebar-footer { position: absolute; bottom: 0; width: 100%; padding: 1rem; border-top: 1px solid var(--gray-200); }
        .btn-logout { width: 100%; display: flex; align-items: center; gap: 0.75rem; padding: 0.875rem 1rem; border-radius: var(--radius-lg); color: var(--danger); text-decoration: none; transition: all var(--transition-base); background: transparent; border: none; font-weight: 500; }
        .btn-logout:hover { background: #fef2f2; color: #b91c1c; }
        .main-content { margin-left: 260px; padding: 2rem; min-height: 100vh; background: linear-gradient(to bottom right, var(--gray-50), #eff6ff); }
        
        .stats-mini {
            background: white;
            border-radius: var(--radius-lg);
            padding: 1.25rem;
            border: 1px solid var(--gray-200);
            transition: all var(--transition-base);
        }
        .stats-mini:hover { box-shadow: var(--shadow-lg); }
        .stats-mini-number { font-size: 1.75rem; font-weight: 800; color: var(--gray-900); }
        .stats-mini-label { color: var(--gray-600); font-size: 0.875rem; }
        
        .table-container { background: white; border-radius: var(--radius-xl); border: 1px solid var(--gray-200); box-shadow: var(--shadow-md); overflow: hidden; }
        .table-header { padding: 1.5rem; border-bottom: 1px solid var(--gray-200); background: linear-gradient(to right, var(--gray-50), #eff6ff); }
        .table thead th { background: var(--gray-50); color: var(--gray-700); font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em; padding: 1rem 1.5rem; border-bottom: 2px solid var(--gray-200); }
        .table tbody tr { border-bottom: 1px solid var(--gray-100); transition: background var(--transition-fast); }
        .table tbody tr:hover { background: var(--gray-50); }
        .table tbody td { padding: 1.25rem 1.5rem; vertical-align: middle; }
        
        .badge-role { padding: 0.4rem 0.875rem; border-radius: var(--radius-full); font-size: 0.75rem; font-weight: 600; }
        .badge-role.user { background: #dbeafe; color: #1e40af; }
        .badge-role.contributor { background: #d1fae5; color: #065f46; }
        .badge-role.admin { background: #f3e8ff; color: #6b21a8; }
        
        .status-badge { display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.375rem 0.875rem; border-radius: var(--radius-full); font-size: 0.75rem; font-weight: 600; }
        .status-badge.active { background: #d1fae5; color: #065f46; }
        .status-badge.inactive { background: #fee2e2; color: #991b1b; }
        .status-badge i { font-size: 0.625rem; }
        
        .filter-tabs { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
        .filter-tab { padding: 0.625rem 1.25rem; border-radius: var(--radius-lg); border: 2px solid var(--gray-200); background: white; color: var(--gray-600); font-weight: 500; cursor: pointer; transition: all var(--transition-base); }
        .filter-tab:hover { border-color: var(--primary-green); color: var(--primary-green); }
        .filter-tab.active { background: var(--gradient-primary); color: white; border-color: transparent; box-shadow: var(--shadow-green); }
        
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); transition: transform var(--transition-base); }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>