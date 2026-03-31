<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin | Sistem Pakar Jagung')</title>

    <!-- Bootstrap -->
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
            gap: 6px;
            font-size: 1.4rem;
        }

        .navbar-brand:hover {
            color: #F2720C !important;
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin-left: 15px;
            transition: 0.3s;
            font-size: 1rem;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #F2720C !important;
        }

        footer {
            background-color: #F2720C;
            color: white;
            text-align: center;
            padding: 18px 0;
            font-weight: 500;
            margin-top: 60px;
        }
    </style>
</head>
<body>

<!-- NAVBAR ADMIN -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">

        <!-- BRAND -->
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            🛠️ Admin JagungKu
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="adminNav">
            <ul class="navbar-nav align-items-center">

                <!-- DASHBOARD -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>
                </li>

                <!-- PENYAKIT -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/penyakit*') ? 'active' : '' }}"
                       href="{{ route('admin.penyakit.index') }}">
                        Penyakit
                    </a>
                </li>

                <!-- GEJALA -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/gejala*') ? 'active' : '' }}"
                       href="{{ route('admin.gejala.index') }}">
                        Gejala
                    </a>
                </li>

                <!-- ATURAN (BELUM ADA HALAMAN → NONAKTIF) -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/aturan*') ? 'active' : '' }}"
                    href="{{ route('admin.aturan.index') }}">
                        Aturan
                    </a>
                </li>

                <!-- ADMIN DROPDOWN -->
                <li class="nav-item dropdown ms-3">
                    <a class="nav-link dropdown-toggle text-success"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">
                        👤 {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- KONTEN ADMIN -->
<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer>
    © 2025 Wahyu Bagas Prastyo | Politeknik Negeri Jember
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
