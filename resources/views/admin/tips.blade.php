@include('admin.template.header')
@include('admin.template.sidebar')

<main class="main-content">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-2">Kelola Tips Pencegahan</h1>
            <p class="text-muted mb-0">Manajemen konten tips mitigasi bencana</p>
        </div>

        <button class="btn btn-lg btn-custom-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="bi bi-plus-circle me-2"></i>Tambah Tips
        </button>
    </div>

    <!-- Table -->
    <div class="table-container">
        <div class="table-header">
            <h3 class="h5 mb-0">Daftar Tips Pencegahan</h3>
        </div>

        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Jenis Bencana</th>
                        <th>Judul Tips</th>
                        <th>Konten</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tips as $t)
                        <tr>
                            <td>{{ $t->category->name }}</td>
                            <td>{{ $t->title }}</td>
                            <td>{{ Str::limit(strip_tags($t->content), 60) }}</td>
                            <td>
                                <button class="btn-icon btn-icon-green" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $t->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('admin.tips.destroy', $t->id) }}" method="POST"
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
                        <div class="modal fade" id="editModal{{ $t->id }}" tabindex="-1"
                            data-bs-backdrop="static">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content border-0 rounded-4">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Tips Pencegahan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <form method="POST" action="{{ route('admin.tips.update', $t->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Jenis Bencana</label>
                                                <select name="disaster_category_id" class="form-select" required>
                                                    @foreach ($categories as $cat)
                                                        <option value="{{ $cat->id }}"
                                                            {{ $t->disaster_category_id == $cat->id ? 'selected' : '' }}>
                                                            {{ $cat->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Judul Tips</label>
                                                <input type="text" name="title" value="{{ $t->title }}"
                                                    class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Konten</label>
                                                <textarea name="content" rows="4" class="form-control">{{ $t->content }}</textarea>
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
{{-- Create Modal --}}
<div class="modal fade" id="createModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tips Pencegahan</h5> <button type="button" class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.tips.store') }}">
                @csrf <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Bencana</label> <select name="disaster_category_id"
                            class="form-select" required>
                            <option value="">-- Pilih --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Tips</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Konten</label>
                        <textarea name="content" rows="4" class="form-control"></textarea>
                    </div>"
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button> <button
                        class="btn btn-success" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('alert')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/premium-script.js') }}"></script>
</body>

</html>"
