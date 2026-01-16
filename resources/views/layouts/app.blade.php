<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- DataTables CSS y JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <style>
        .bg-brand {
            background-color: #1f4e78 !important;
        }

        .avatar-circle {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #1f4e78, #163a59);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 15px;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255,255,255,.9);
        }

        .navbar-dark .navbar-nav .nav-link:hover,
        .navbar-dark .navbar-nav .nav-link:focus {
            color: #ffffff;
        }

        .navbar .dropdown-menu {
            border-radius: 12px;
            animation: dropdownFade .2s ease-in-out;
        }

        @keyframes dropdownFade {
            from {
                opacity: 0;
                transform: translateY(6px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (min-width: 1400px) {
            .container {
                max-width: 1500px;
            }
        }

    </style>

</head>
<body>
    <div id="app">
        @if (!isset($hideNavbar))
            <nav class="navbar navbar-expand-lg navbar-dark bg-brand shadow-sm">
                <div class="container-fluid px-lg-4">
                    {{-- Logo --}}
                    <a class="navbar-brand fw-semibold d-flex align-items-center" href="{{ url('/') }}">
                        <i class="bi bi-grid-fill me-2"></i>
                        {{ config('app.name', 'Laravel') }}
                    </a>

                    {{-- Mobile --}}
                    <button class="navbar-toggler border-0" type="button"
                            data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                        <i class="bi bi-list fs-2 text-white"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="mainNavbar">

                        {{-- Left --}}
                        <ul class="navbar-nav me-auto mt-3 mt-lg-0">

                            <li class="nav-item">
                                <a class="nav-link active" href="/gestiones">
                                    <i class="bi bi-house-door me-1"></i> Inicio
                                </a>
                            </li>

                            {{-- Gestiones --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center"
                                href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-folder2-open me-1"></i>
                                    Gestiones
                                </a>

                                <ul class="dropdown-menu shadow-sm">
                                    <li>
                                        <a class="dropdown-item" href="/gestiones">
                                            <i class="bi bi-list-task me-2"></i> Todas
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/gestiones/pendientes">
                                            <i class="bi bi-hourglass-split me-2 text-warning"></i> En proceso
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/gestiones/resueltas">
                                            <i class="bi bi-check-circle me-2 text-success"></i> Finalizadas
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            {{-- Edificios --}}
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" href="/edificios">
                                    <i class="bi bi-building me-1"></i>
                                    Edificios
                                </a>
                            </li>

                        </ul>

                        {{-- Right --}}
                        <ul class="navbar-nav ms-auto align-items-lg-center">

                            {{-- Usuario --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center"
                                href="#" role="button" data-bs-toggle="dropdown">

                                    <div class="avatar-circle me-2">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>

                                    <span class="d-lg-inline d-none">
                                        {{ Auth::user()->name }}
                                    </span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                    <li>
                                        <a class="dropdown-item text-danger"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                                        </a>
                                    </li>
                                </ul>

                                <form id="logout-form" action="{{ route('logout') }}"
                                    method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        @endif

        <main class="py-4">
            @yield('content')
        </main>

        <script>
            $(document).ready(function() {
                $('#tabla-gestiones').DataTable({
                    responsive: true,
                    autoWidth: false,

                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, 100],
                        [10, 25, 50, 100]
                    ],

                    order: false, // orden por fecha

                    language: {
                        lengthMenu: "Mostrar _MENU_ registros",
                        zeroRecords: "No se encontraron resultados",
                        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        infoEmpty: "Mostrando 0 a 0 de 0 registros",
                        infoFiltered: "(filtrado de _MAX_ registros totales)",
                        search: "Buscar:",
                        paginate: {
                            first: "Primero",
                            last: "Último",
                            next: "→",
                            previous: "←"
                        }
                    }
                });
            });
        </script>
    </div>
</body>
</html>
