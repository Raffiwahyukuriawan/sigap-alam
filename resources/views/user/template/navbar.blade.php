    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <div class="logo-icon">SA</div>
                SIGAP ALAM
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <div class="nav-link beranda {{ request()->routeIs('/') ? 'active' : '' }}">
                            Beranda
                        </div>
                    </li>

                    <li class="nav-item">
                        <div class="nav-link jenis-bencana {{ request()->routeIs('jenis-bencana') ? 'active' : '' }}">
                            Jenis Bencana
                        </div>
                    </li>

                    <li class="nav-item">
                        <div class="nav-link artikel {{ request()->routeIs('artikel*') ? 'active' : '' }}">
                            Artikel
                        </div>
                    </li>

                    <li class="nav-item ms-2 mt-2">
                        <div class="btn btn-custom-primary btn-sm mb-3 loginn">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Login
                        </div>
                    </li>
                    <li class="nav-item role-switcher ms-2">
                        <button class="role-switcher-btn">
                            <i class="bi bi-person-circle"></i>
                            <span>Demo Role</span>
                            <i class="bi bi-chevron-down" style="font-size: 0.75rem;"></i>
                        </button>
                        <div class="role-dropdown">
                            <div class="role-dropdown-header">
                                <h6>Pilih Role Demo</h6>
                            </div>
                            <a href="/" class="role-option" data-role="user">
                                <div class="role-icon user">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div class="role-info">
                                    <div class="role-name">User</div>
                                    <p class="role-description">Masyarakat umum - Baca artikel & komentar</p>
                                </div>
                            </a>
                            <a href="{{ route('contributor.dashboard') }}" class="role-option" data-role="contributor">
                                <div class="role-icon contributor">
                                    <i class="bi bi-pencil-square"></i>
                                </div>
                                <div class="role-info">
                                    <div class="role-name">Kontributor</div>
                                    <p class="role-description">Penulis artikel - Kelola konten edukasi</p>
                                </div>
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="role-option" data-role="admin">
                                <div class="role-icon admin">
                                    <i class="bi bi-shield-fill-check"></i>
                                </div>
                                <div class="role-info">
                                    <div class="role-name">Admin</div>
                                    <p class="role-description">Administrator - Kelola sistem lengkap</p>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
