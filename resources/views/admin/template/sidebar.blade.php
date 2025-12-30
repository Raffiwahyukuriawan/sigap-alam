    <aside class="sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <div class="sidebar-logo-icon">SA</div>
                <div>
                    <strong class="d-block">SIGAP ALAM</strong>
                    <small class="text-muted">Administrator</small>
                </div>
            </div>
        </div>

        <nav>
            <ul class="sidebar-menu">

                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="sidebar-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-fill"></i><span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.artikel') }}"
                        class="sidebar-menu-link {{ request()->routeIs('admin.artikel') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text"></i><span>Kelola Artikel</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.disaster-categories') }}"
                        class="sidebar-menu-link {{ request()->routeIs('admin.disaster-categories') ? 'active' : '' }}">
                        <i class="bi bi-exclamation-triangle"></i><span>Jenis Bencana</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.tips') }}"
                        class="sidebar-menu-link {{ request()->routeIs('admin.tips') ? 'active' : '' }}">
                        <i class="bi bi-lightbulb"></i><span>Tips Pencegahan</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.users.index') }}"
                        class="sidebar-menu-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i><span>Kelola Pengguna</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.profile') }}"
                        class="sidebar-menu-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
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
