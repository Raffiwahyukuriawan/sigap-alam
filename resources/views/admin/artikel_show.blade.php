@include('admin.template.header')
@include('admin.template.sidebar')

<main class="main-content">

    <!-- Article Header -->
    <section class="py-5 bg-gradient-card">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <span class="badge bg-primary bg-opacity-10 text-primary mb-3">
                        {{ $category->name }}
                    </span>

                    <h1 class="display-6 fw-bold mb-3">
                        {{ $article->title }}
                    </h1>

                    <div class="article-meta mb-4 text-muted">
                        <span class="me-3">
                            <i class="bi bi-person me-1"></i>
                            {{ $article->user->name }}
                        </span>
                        <span class="me-3">
                            <i class="bi bi-calendar me-1"></i>
                            {{ $article->published_at?->translatedFormat('d F Y') ?? 'Belum dipublikasikan' }}
                        </span>
                        <span>
                            <i class="bi bi-eye me-1"></i>
                            {{ $article->views }} views
                        </span>
                    </div>

                    @if ($article->cover_image)
                        <div class="article-cover mb-4">
                            <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}"
                                class="img-fluid rounded-4 shadow-sm">
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <div class="article-body">
                        {!! $article->content !!}
                    </div>

                    <!-- Author Box -->
                    <div class="author-box mt-5">
                        <div class="d-flex align-items-center gap-3">
                            <div class="author-avatar">
                                {{ strtoupper(substr($article->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-semibold">{{ $article->user->name }}</div>
                                <small class="text-muted">
                                    Kontributor
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- ===== COMMENTS SECTION ===== -->
                    <div class="comments-section mt-5">

                        <h4 class="fw-bold mb-4">
                            <i class="bi bi-chat-dots me-1"></i>
                            Komentar ({{ $article->comments->count() }})
                        </h4>

                        <!-- List Komentar -->
                        <div class="comment-list mb-4">
                            @forelse ($article->comments as $comment)
                                <div class="comment-item">
                                    <div class="comment-avatar">
                                        {{ strtoupper(substr($comment->name ?? $comment->user->name, 0, 1)) }}
                                    </div>
                                    <div class="comment-content">
                                        <div class="comment-author">
                                            {{ $comment->name ?? $comment->user->name }}
                                            <span class="comment-date">
                                                • {{ $comment->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <div class="comment-text">
                                            {{ $comment->comment }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted fst-italic">Belum ada komentar.</p>
                            @endforelse
                        </div>

                        <!-- Form Komentar -->
                        <div class="comment-form">
                            <h5 class="fw-semibold mb-3">Tinggalkan Komentar</h5>

                            <form action="{{ route('artikel.comment.store', $article->id) }}" method="POST">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control mb-3"
                                            placeholder="Nama" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            required>
                                    </div>
                                </div>

                                <textarea name="comment" rows="4" class="form-control mb-3" placeholder="Tulis komentar..." required></textarea>
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <button class="btn btn-primary">
                                    <i class="bi bi-send me-1"></i> Kirim Komentar
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    </div>
    @include('alert')

    @include('admin.template.footer')

    <style>
        /* ===== ARTICLE DETAIL ===== */
        .article-body {
            font-size: 1.05rem;
            line-height: 1.9;
            color: #374151;
        }

        .article-body p {
            margin-bottom: 1.25rem;
        }

        .article-body h2,
        .article-body h3,
        .article-body h4 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .article-body img {
            max-width: 100%;
            border-radius: 1rem;
            margin: 1.5rem 0;
            box-shadow: var(--shadow-md);
        }

        .article-meta span {
            font-size: 0.875rem;
        }

        .article-cover img {
            width: 100%;
            object-fit: cover;
        }

        /* ===== AUTHOR BOX ===== */
        .author-box {
            padding: 1.5rem;
            border-radius: var(--radius-xl);
            background: linear-gradient(to right, #f9fafb, #ecfeff);
            border: 1px solid var(--gray-200);
        }

        .author-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: var(--gradient-primary);
            color: white;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ===== COMMENTS ===== */
        .comments-section {
            border-top: 1px solid #e5e7eb;
            padding-top: 2rem;
        }

        .comment-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .comment-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .comment-content {
            flex: 1;
        }

        .comment-author {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .comment-date {
            font-size: 0.8rem;
            color: #66bb77
        }

        .comment-text {
            font-size: 0.95rem;
            color: #374151;
            margin-top: 0.25rem;
        }

        .comment-form textarea {
            resize: none;
        }
    </style>
