<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pakar Jagung')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fffef8;
            color: #333;
            overflow-x: hidden;
        }

        nav.navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: #073B4C !important;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .navbar-brand:hover {
            color: #F2720C !important;
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin-left: 15px;
            transition: 0.3s;
            font-size: 1.05rem;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #F2720C !important;
        }

        .alert {
            margin-top: 20px;
            width: 90%;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        footer {
            background-color: #F2720C;
            color: white;
            text-align: center;
            padding: 20px 0;
            font-weight: 500;
            margin-top: 60px;
        }
    </style>
</head>
<body>


<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}" style="font-size:1.6rem;">
            🌽 JagungKu
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">

                <!-- MENU UMUM -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('diagnosis') ? 'active' : '' }}" href="{{ route('diagnosis') }}">Diagnosis</a>
                </li>

                <!-- <li class="nav-item"> -->
                    <!-- <a class="nav-link {{ request()->is('penyakit') ? 'active' : '' }}" href="{{ route('penyakit') }}">Informasi Penyakit</a> -->
                <!-- </li> -->

                <!-- MENU RIWAYAT (HANYA JIKA LOGIN) -->
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('riwayat') ? 'active' : '' }}" href="{{ route('riwayat') }}">Riwayat</a>
                </li>
                @endauth

                <!-- <li class="nav-item">
                    <a class="nav-link {{ request()->is('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang Kami</a>
                </li> -->

                <!-- AUTH SECTION -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown">
                            👤 {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>


<!-- NOTIFIKASI -->
<div class="container">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

<!-- KONTEN -->
<main class="container py-4">
    @yield('content')
</main>

<!-- FOOTER -->
<footer>
    © 2025 Wahyu Bagas Prastyo | Politeknik Negeri Jember
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
