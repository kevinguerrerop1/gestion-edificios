<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- Navbar + Brand -->
    <style>
        .bg-brand {
            background-color: #1f4e78 !important;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255, 255, 255, .9);
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

        /* Botones corporativos */
        .btn-primary {
            background-color: #1f4e78 !important;
            border-color: #1f4e78 !important;
        }

        .btn-primary:hover {
            background-color: #163a59 !important;
            border-color: #163a59 !important;
        }
    </style>
</head>

<body>
    <div id="app">

        @if (!isset($hideNavbar))
            <nav class="navbar navbar-expand-lg navbar-dark bg-brand shadow-sm">
                <div class="container-fluid px-lg-4">

                    <a class="navbar-brand fw-semibold d-flex align-items-center" href="{{ url('/') }}">
                        <i class="bi bi-grid-fill me-2"></i>
                        {{ config('app.name', 'Laravel') }}
                    </a>

                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#mainNavbar">
                        <i class="bi bi-list fs-2 text-white"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="mainNavbar">

                        @auth
                            <ul class="navbar-nav me-auto mt-3 mt-lg-0">

                                {{-- CHECK-OUT --}}
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                        <i class="bi bi-box-seam me-1"></i> Check-Out
                                    </a>
                                    <ul class="dropdown-menu shadow-sm">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('checkouts.index') }}">
                                                <i class="bi bi-clipboard-check me-2"></i> Check-Outs
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('articulos.index') }}">
                                                <i class="bi bi-tags me-2"></i> Artículos
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('tecnicos.index') }}">
                                                <i class="bi bi-person-gear me-2"></i> Técnicos
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- GESTIÓN --}}
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                        <i class="bi bi-folder2-open me-1"></i> Gestión
                                    </a>
                                    <ul class="dropdown-menu shadow-sm">
                                        <li><a class="dropdown-item" href="/gestiones"><i class="bi bi-list-ul me-2"></i>
                                                Todas</a></li>
                                        <li><a class="dropdown-item" href="/gestiones/pendientes"><i
                                                    class="bi bi-hourglass-split me-2"></i> En proceso</a></li>
                                        <li><a class="dropdown-item" href="/gestiones/resueltas"><i
                                                    class="bi bi-check2-circle me-2"></i> Finalizadas</a></li>
                                    </ul>
                                </li>

                                {{-- EDIFICIOS --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="/edificios">
                                        <i class="bi bi-building me-1"></i> Edificios
                                    </a>
                                </li>

                                {{-- REPORTES --}}
                                <li class="nav-item">
                                    <a href="{{ route('reportes.index') }}" class="nav-link">
                                        <i class="bi bi-bar-chart-line me-1"></i> Reportes
                                    </a>
                                </li>

                            </ul>
                        @endauth

                        <ul class="navbar-nav ms-auto align-items-lg-center">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                        {{ Auth::user()->name }}
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li>
                                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                                            </a>
                                        </li>
                                    </ul>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
        $(document).ready(function() {
            $('#tabla').DataTable({
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
</body>

</html>
