@include('admin.template.header')

<!-- Sidebar (same as admin pages) -->
@include('admin.template.sidebar')

<!-- Main Content -->
<main class="main-content">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-2">Kelola Jenis Bencana</h1>
            <p class="text-muted mb-0">Manajemen data jenis bencana alam</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-custom-primary d-lg-none" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <button type="button" class="btn btn-lg btn-custom-primary" data-bs-toggle="modal"
                data-bs-target="#userModal">
                <i class="bi bi-plus-circle me-2"></i>Tambah jenis Bencana
            </button>
            <!-- Add -->
            <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content border-0 rounded-4">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userModalTitle">
                                Tambah jenis Bencana
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form method="POST" action="{{ route('admin.disaster-categories.store') }}">
                            @csrf

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Bencana</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Contoh:Banjir" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Icon (Emoji)</label>
                                    <input type="text" name="icon" class="form-control"
                                        placeholder="Contoh:bi-droplet-fill">
                                    <p class="text-secondary text-sm">Opsional. Gunakan icon dari Bootstrap Icon untuk
                                        representasi visual.
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Deskripsi</label>
                                    <textarea name="description" class="form-control" rows="3"
                                        placeholder="Deskripsi singkat tentang jenis bencana..."></textarea>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-success" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                        <th>Nama Bencana</th>
                        <th>Icon</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                    @foreach ($categories as $c)
                        <tr>
                            <td>{{ $c->name }}</td>
                            <td><i class="bi {{ $c->icon ?? '-' }}"></i></td>
                            <td>{{ Str::limit($c->description, 50) }}</td>
                            <td>
                                <button class="btn-icon btn-icon-green" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $c->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <form action="{{ route('admin.disaster-categories.destroy', $c->id) }}" method="POST"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-icon btn-icon-red">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- Edit Modal --}}
                        <div class="modal fade" id="editModal{{ $c->id }}" tabindex="-1"
                            data-bs-backdrop="static">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content border-0 rounded-4">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Jenis Bencana</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <form method="POST"
                                        action="{{ route('admin.disaster-categories.update', $c->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Nama Bencana</label>
                                                <input type="text" name="name" value="{{ $c->name }}"
                                                    class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                <input type="text" name="icon" value="{{ $c->icon }}"
                                                    class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Deskripsi</label>
                                                <textarea name="description" class="form-control" rows="3">{{ $c->description }}</textarea>
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
