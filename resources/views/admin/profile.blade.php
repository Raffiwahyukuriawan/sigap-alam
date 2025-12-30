@include('admin.template.header')

@include('admin.template.sidebar')

<main class="main-content">
    <!-- Header -->
    <div class="mb-4">
        <h1 class="h2 mb-1">Profil Saya</h1>
        <p class="text-muted mb-0">Informasi akun dan pengaturan pribadi</p>
    </div>

    <div class="row g-4">
        <!-- Profile Card -->
        <div class="col-lg-4">
            <div class="card-custom text-center">
                <div class="mb-3">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center text-white fw-bold"
                        style="
                            width: 120px;
                            height: 120px;
                            border-radius: 50%;
                            font-size: 2.5rem;
                            background: var(--gradient-primary);
                            box-shadow: var(--shadow-green);
                        ">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <h3 class="mb-1">{{ $user->name }}</h3>
                    <span class="badge-role {{ $user->role }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>

                <div class="d-flex justify-content-center gap-2 mt-4">
                    <button class="btn btn-custom-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil-square me-1"></i>
                        Edit Profil
                    </button>
                </div>
            </div>
        </div>

        <!-- Detail Info -->
        <div class="col-lg-8">
            <div class="card-custom">
                <h4 class="mb-4">Informasi Akun</h4>

                <div class="row mb-3">
                    <div class="col-md-4 text-muted">Nama Lengkap</div>
                    <div class="col-md-8 fw-semibold">{{ $user->name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 text-muted">Email</div>
                    <div class="col-md-8 fw-semibold">{{ $user->email }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 text-muted">Role</div>
                    <div class="col-md-8 fw-semibold">
                        {{ ucfirst($user->role) }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 text-muted">Bergabung</div>
                    <div class="col-md-8 fw-semibold">
                        {{ $user->created_at->translatedFormat('d F Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('admin.profile.update',$user->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ $user->name }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ $user->email }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password Baru</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Kosongkan jika tidak diubah">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Ulangi password">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('alert')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/premium-script.js') }}"></script>

</body>
</html>
