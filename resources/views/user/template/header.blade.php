<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SIGAP ALAM - Sistem Edukasi Lingkungan dan Kesadaran Bencana">
    <title>SIGAP ALAM - Edukasi Bencana untuk Indonesia</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Premium CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/premium-style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .icon-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            /* ukuran icon */
            line-height: 1;
        }

        .to-artikel {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp .6s ease forwards;
        }

        .animate-delay-1 {
            animation-delay: .2s;
        }

        .animate-delay-2 {
            animation-delay: .4s;
        }

        .animate-delay-3 {
            animation-delay: .6s;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
