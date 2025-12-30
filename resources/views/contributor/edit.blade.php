<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kontributor - SIGAP ALAM</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .stats-icon {
            width: 60px;
            height: 60px;
            font-size: 32px;
            /* ukuran icon */
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            /* opsional, biar rounded */
        }

        .card {
            border-radius: 12px;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 12px;
        }

        .btn {
            border-radius: 8px;
            padding: 10px;
            font-weight: 500;
            font-weight: bold;
            color: white
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    @include('contributor.template.sidebar')

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="mb-4">
            <a href="{{ route('contributor.dashboard') }}" class="btn text-dark d-flex text-muted">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
            </a>
            <h1 class="h3 mb-2">Buat Artikel Baru</h1>
            <p class="text-muted">Tulis artikel edukasi tentang bencana alam</p>
        </div>
        <form action="{{ route('contributor.artikel.put', $article->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Kategori Bencana -->
            <div class="mb-3">
                <label class="form-label">Kategori Bencana</label>
                <select name="disaster_category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $article->disaster_category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Judul -->
            <div class="mb-3">
                <label class="form-label">Judul Artikel</label>
                <input type="text" name="title" class="form-control" value="{{ $article->title }}" required>
            </div>

            <!-- Konten (CKEditor) -->
            <div class="mb-3">
                <label class="form-label">Konten</label>
                <textarea name="content" id="editor" rows="10">{{ $article->content }}</textarea>
            </div>

            <!-- Cover Image -->
            <div class="mb-3">
                <label class="form-label">Gambar Sampul</label>
                @if ($article->cover_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $article->cover_image) }}" class="card-img-top"
                            alt="Cover Artikel">
                    </div>
                @endif
                <input type="file" name="cover_image" class="form-control" accept="image/*">
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="draft" {{ $article->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="pending" {{ $article->status == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>

            <button type="submit" class="btn w-100 font-bold" style="background-color: rgb(1, 228, 1)">
                <i class="bi bi-send-fill me-2"></i> Perbarui Artikel
            </button>
        </form>

        <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        </script>

    </main>
    @include('alert')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'lists link image table code',
            toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | code',
            height: 400,
        });
    </script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
