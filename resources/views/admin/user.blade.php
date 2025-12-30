@include('admin.template.header')

<!-- Sidebar (same as admin pages) -->
@include('admin.template.sidebar')

<!-- Main Content -->
<main class="main-content">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-2">Kelola Pengguna</h1>
            <p class="text-muted mb-0">Manajemen semua pengguna sistem SIGAP ALAM</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-custom-primary d-lg-none" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <button type="button" class="btn btn-lg btn-custom-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                <i class="bi bi-plus-circle me-2"></i>Tambah Pengguna
            </button>
            <!-- Add -->
            <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content border-0 rounded-4">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userModalTitle">
                                Tambah Pengguna
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf
                            <input type="hidden" name="_method" id="methodField" value="POST">
                            <input type="hidden" name="user_id" id="userId">

                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" for="nama">Nama
                                            Lengkap</label>
                                        <input type="text" name="name" id="nama" class="form-control"
                                            required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="...">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Role</label>
                                        <select name="role" id="userRole" class="form-select" required>
                                            <option value="contributor">Kontributor</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-success" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mini Stats -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stats-mini">
                <div class="stats-mini-number">{{ $total }}</div>
                <div class="stats-mini-label">Total Pengguna</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stats-mini">
                <div class="stats-mini-number">{{ $contributorCount }}</div>
                <div class="stats-mini-label">Kontributor</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stats-mini">
                <div class="stats-mini-number">{{ $adminCount }}</div>
                <div class="stats-mini-label">Admin</div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <a href="{{ route('admin.users.index') }}" class="filter-tab {{ $currentRole == 'all' ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i>
            Semua ({{ $total }})
        </a>

        <a href="{{ route('admin.users.index', ['role' => 'contributor']) }}"
            class="filter-tab {{ $currentRole == 'contributor' ? 'active' : '' }}">
            <i class="bi bi-pencil me-2"></i>
            Kontributor ({{ $contributorCount }})
        </a>

        <a href="{{ route('admin.users.index', ['role' => 'admin']) }}"
            class="filter-tab {{ $currentRole == 'admin' ? 'active' : '' }}">
            <i class="bi bi-shield me-2"></i>
            Admin ({{ $adminCount }})
        </a>
    </div>

    <!-- Users Table -->
    <div class="table-container">
        <div class="table-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3 class="h5 mb-0">Daftar Pengguna</h3>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                    @foreach ($users as $u)
                        <tr class="user-row" data-role="{{ $u->role }}">
                            <td>
                                <div class="d-flex align-items-center ">
                                    <div class="bg-gradient-primary rounded-circle text-white d-flex align-items-center justify-content-center"
                                        style="width: 48px; height: 48px; font-weight: 700;">AU</div>
                                    <div>
                                        <div class="fw-semibold" style="margin-left: -3rem">{{ $u->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $u->email }}</td>
                            <td><span class="badge-role {{ $u->role }}">{{ ucfirst($u->role) }}</span></td>
                            <td><small class="text-muted">{{ $u->created_at->format('d M Y') }}</small></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn-icon btn-icon-green" data-bs-toggle="modal"
                                        data-bs-target="#userModal{{ $u->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-icon-red">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- Edit User Modal --}}
                        <div class="modal fade" id="userModal{{ $u->id }}" tabindex="-1" data-bs-backdrop="static">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content border-0 rounded-4">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Pengguna</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <form method="POST" action="{{ route('admin.users.update', $u->id) }}"
                                        id="editUserForm">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold" for="nama">Nama
                                                        Lengkap</label>
                                                    <input type="text" name="name" id="nama"
                                                        class="form-control" value="{{ $u->name }}" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold" for="email">Email</label>
                                                    <input type="email" name="email" id="email"
                                                        class="form-control" value="{{ $u->email }}" required>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label fw-semibold">Role</label>
                                                    <select name="role" id="editUserRole" class="form-select"
                                                        required>
                                                        <option value="contributor">Kontributor</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                            <button class="btn btn-success" type="submit">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

@include('alert')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/premium-script.js') }}"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

</body>

</html>
