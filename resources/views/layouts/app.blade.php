<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- JS App -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Tipografía Google Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilos CSS App -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- ESTILOS PERSONALIZADOS DEL NAVBAR Y SISTEMA -->
    <style>
        :root {
            --brand-gradient: linear-gradient(135deg, #1b365d 0%, #0f2342 100%);
            --brand-primary: #1f4e78;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Nunito', sans-serif;
            color: #334155;
        }

        /* Navbar con superposición corregida (z-index superior) */
        .navbar-custom {
            background: var(--brand-gradient) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: relative;
            z-index: 1050 !important;
            /* Prioridad por encima de contenido sticky */
        }

        /* Isotipo de la marca */
        .navbar-brand-logo {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .navbar-brand:hover .navbar-brand-logo {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.22);
            box-shadow: 0 0 12px rgba(255, 255, 255, 0.2);
        }

        /* Enlaces de navegación */
        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.88) !important;
            font-weight: 600;
            font-size: 0.92rem;
            padding: 0.5rem 0.9rem !important;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .navbar-dark .navbar-nav .nav-link:hover,
        .navbar-dark .navbar-nav .nav-link:focus,
        .navbar-dark .navbar-nav .show>.nav-link {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.12);
        }

        /* Menú Desplegable flotante en la capa superior */
        .dropdown-menu {
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 14px !important;
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.2);
            padding: 0.5rem;
            animation: dropdownFade 0.22s cubic-bezier(0.16, 1, 0.3, 1);
            margin-top: 8px !important;
            z-index: 1060 !important;
            /* Prioridad absoluta */
        }

        @keyframes dropdownFade {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 0.55rem 0.9rem;
            font-weight: 600;
            font-size: 0.88rem;
            color: #475569;
            transition: all 0.15s ease;
            display: flex;
            align-items: center;
        }

        .dropdown-item:hover {
            background-color: #f1f5f9;
            color: #0f172a;
            transform: translateX(3px);
        }

        .dropdown-item.text-danger:hover {
            background-color: #fef2f2;
            color: #dc2626;
        }

        /* Cápsula de Usuario */
        .user-profile-pill {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 50px;
            padding: 4px 14px 4px 8px !important;
            transition: all 0.2s ease;
        }

        .user-profile-pill:hover,
        .show>.user-profile-pill {
            background: rgba(255, 255, 255, 0.18) !important;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.15);
        }

        /* Badges corporativos */
        .badge-rol {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 20px;
            letter-spacing: 0.3px;
        }

        .btn-primary {
            background-color: var(--brand-primary) !important;
            border-color: var(--brand-primary) !important;
            box-shadow: 0 2px 6px rgba(31, 78, 120, 0.2);
        }

        .btn-primary:hover {
            background-color: #163a59 !important;
            border-color: #163a59 !important;
        }

        /* Ancho máximo optimizado */
        @media (min-width: 1400px) {
            .container-fluid.px-lg-4 {
                padding-left: 2rem !important;
                padding-right: 2rem !important;
            }

            .container {
                max-width: 1520px;
            }
        }
    </style>
</head>

<body>
    <div id="app">

        @if (!isset($hideNavbar))
            <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm sticky-top">
                <div class="container-fluid px-lg-4">

                    {{-- LOGO DE LA MARCA --}}
                    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ url('/') }}">
                        <div class="navbar-brand-logo text-white">
                            <i class="bi bi-grid-fill fs-5"></i>
                        </div>
                        <span class="fs-5 tracking-tight">{{ config('app.name', 'Laravel') }}</span>
                    </a>

                    {{-- BOTÓN HAMBURGUESA MÓVIL --}}
                    <button class="navbar-toggler border-0 shadow-none p-1" type="button" data-bs-toggle="collapse"
                        data-bs-target="#mainNavbar">
                        <i class="bi bi-list fs-1 text-white"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="mainNavbar">

                        @auth
                            <ul class="navbar-nav me-auto mt-3 mt-lg-0 gap-lg-1">

                                {{-- CHECK-OUT DROPDOWN --}}
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                        <i class="bi bi-box-seam fs-6 text-info"></i> Check-Out
                                    </a>

                                    <ul class="dropdown-menu shadow-sm">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('checkouts.index') }}">
                                                <i class="bi bi-clipboard-check me-2 text-primary"></i> Check-Outs
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="{{ route('checkouts.cerrados') }}">
                                                <i class="bi bi-check-circle me-2 text-success"></i> Finalizados
                                            </a>
                                        </li>

                                        {{-- Exclusivo Admin --}}
                                        @if (Auth::user()->rol === 'admin')
                                            <li>
                                                <a href="{{ route('checkouts.papelera') }}"
                                                    class="dropdown-item text-danger">
                                                    <i class="bi bi-trash3 me-2"></i> Papelera
                                                    <span
                                                        class="badge bg-danger-subtle text-danger ms-auto rounded-pill fs-7">
                                                        {{ \App\Models\Checkout::onlyTrashed()->count() }}
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider opacity-50">
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('articulos.index') }}">
                                                    <i class="bi bi-tags me-2 text-warning"></i> Artículos
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('tecnicos.index') }}">
                                                    <i class="bi bi-person-gear me-2 text-secondary"></i> Técnicos
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('usuarios.index') }}">
                                                    <i class="bi bi-people me-2 text-primary"></i> Mantenedor Usuarios
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>

                                @if (Auth::user()->rol === 'admin')
                                    {{-- GESTIÓN DROPDOWN --}}
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                            <i class="bi bi-folder2-open fs-6 text-warning"></i> Gestión
                                        </a>
                                        <ul class="dropdown-menu shadow-sm">
                                            <li>
                                                <a class="dropdown-item" href="/gestiones">
                                                    <i class="bi bi-list-ul me-2"></i> Todas
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="/gestiones/pendientes">
                                                    <i class="bi bi-hourglass-split me-2 text-warning"></i> En proceso
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="/gestiones/resueltas">
                                                    <i class="bi bi-check2-circle me-2 text-success"></i> Finalizadas
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    {{-- EDIFICIOS --}}
                                    <li class="nav-item">
                                        <a class="nav-link" href="/edificios">
                                            <i class="bi bi-building fs-6 text-info"></i> Edificios
                                        </a>
                                    </li>

                                    {{-- REPORTES --}}
                                    <li class="nav-item">
                                        <a href="{{ route('reportes.index') }}" class="nav-link">
                                            <i class="bi bi-bar-chart-line fs-6 text-success"></i> Reportes
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        @endauth

                        {{-- SECCIÓN DERECHA: USUARIO & LOGIN --}}
                        <ul class="navbar-nav ms-auto align-items-lg-center">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link fw-bold px-3 btn btn-outline-light btn-sm text-white border-0"
                                        href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión
                                    </a>
                                </li>
                            @else
                                <li class="nav-item dropdown mt-2 mt-lg-0">
                                    <a class="nav-link dropdown-toggle user-profile-pill d-flex align-items-center gap-2"
                                        href="#" data-bs-toggle="dropdown">
                                        <div class="bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 28px; height: 28px;">
                                            <i class="bi bi-person-fill text-white fs-6"></i>
                                        </div>
                                        <span>{{ Auth::user()->name }}</span>

                                        {{-- BADGE ROL --}}
                                        @if (Auth::user()->rol === 'admin')
                                            <span class="badge bg-warning text-dark badge-rol ms-1">
                                                <i class="bi bi-shield-check me-1"></i>Admin
                                            </span>
                                        @else
                                            <span class="badge bg-info text-dark badge-rol ms-1">
                                                <i class="bi bi-person-badge me-1"></i>Supervisor(a)
                                            </span>
                                        @endif
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li class="px-3 py-2 text-muted small border-bottom mb-1 bg-light rounded-top-3">
                                            Rol de cuenta:<br>
                                            <strong
                                                class="text-dark">{{ Auth::user()->rol === 'admin' ? 'Administrador' : 'Supervisor(a)' }}</strong>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2" href="{{ route('usuarios.password.edit') }}">
                                                <i class="bi bi-key me-2 text-primary"></i> Cambiar contraseña
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider opacity-50 my-1">
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                                            </a>
                                        </li>
                                    </ul>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @endif

        {{-- CONTENIDO PRINCIPAL --}}
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- DATATABLES GLOBAL SCRIPT --}}
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
                order: false,
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
