    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <div class="sidebar-logo-icon">SA</div>
                <div>
                    <strong class="d-block">SIGAP ALAM</strong>
                    <small class="text-muted">Kontributor</small>
                </div>
            </div>
        </div>

        <nav>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a href="{{ route('contributor.dashboard') }}"
                        class="sidebar-menu-link {{ Route::is('contributor.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="sidebar-menu-item">
                    <a href="{{ route('contributor.profile') }}"
                        class="sidebar-menu-link {{ request()->routeIs('contributor.profile') ? 'active' : '' }}">
                        <i class="bi bi-person-circle"></i><span>Profil Saya</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i><span>Logout</span>
                </button>
            </form>
        </div>
    </aside>
