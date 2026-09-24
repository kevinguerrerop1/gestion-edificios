<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios Globales RV | Detección Computarizada de Filtraciones & Check-Outs</title>

    {{-- Google Fonts & Bootstrap 5 --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --rv-navy: #1E3050;
            --rv-blue: #0284C7;
            --rv-blue-hover: #0369a1;
            --rv-cyan: #0ea5e9;
            --rv-dark: #0f172a;
            --rv-gray-light: #f8fafc;
            --rv-border: #e2e8f0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #334155;
            background-color: #ffffff;
            overflow-x: hidden;
        }

        /* NAVBAR */
        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 1px solid var(--rv-border);
            padding: 14px 0;
            transition: all 0.3s ease;
        }

        .navbar-brand img {
            max-height: 48px;
            width: auto;
        }

        .nav-link {
            font-weight: 600;
            font-size: 14px;
            color: var(--rv-navy);
            margin: 0 10px;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: var(--rv-blue);
        }

        /* ACCESO AL SISTEMA DISCRETO */
        .btn-acceso-oculto {
            color: #94a3b8 !important;
            opacity: 0.35;
            font-size: 14px;
            padding: 6px 10px;
            text-decoration: none;
            transition: opacity 0.25s ease, color 0.25s ease;
        }

        .btn-acceso-oculto:hover {
            opacity: 0.9;
            color: var(--rv-navy) !important;
        }

        /* HERO SECTION */
        .hero-section {
            background: linear-gradient(135deg, #1E3050 0%, #0b1528 100%);
            color: #ffffff;
            padding: 95px 0 85px;
            position: relative;
        }

        .badge-pill-custom {
            background-color: rgba(2, 132, 199, 0.2);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.4);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-rv-primary {
            background-color: var(--rv-blue);
            color: #ffffff;
            border: none;
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-rv-primary:hover {
            background-color: var(--rv-blue-hover);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(2, 132, 199, 0.3);
        }

        .btn-rv-outline {
            background: transparent;
            color: #ffffff;
            border: 1.5px solid rgba(255, 255, 255, 0.3);
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-rv-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-color: #ffffff;
        }

        /* TARJETAS TÉCNICAS CON IMAGEN */
        .service-card-tech {
            background: #ffffff;
            border: 1px solid var(--rv-border);
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .service-card-tech:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.1);
            border-color: #94a3b8;
        }

        .service-img-wrapper {
            position: relative;
            height: 200px;
            width: 100%;
            overflow: hidden;
            background: #0f172a;
        }

        .service-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .service-card-tech:hover .service-img-wrapper img {
            transform: scale(1.06);
        }

        .tech-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(15, 23, 42, 0.88);
            backdrop-filter: blur(4px);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.3);
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 2;
        }

        .service-card-tech .card-body {
            padding: 24px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .tech-specs-list {
            list-style: none;
            padding-left: 0;
            margin-top: auto;
            border-top: 1px dashed #e2e8f0;
            padding-top: 14px;
            font-size: 11.5px;
            color: #64748b;
        }

        .tech-specs-list li {
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* RADAR BOX */
        .radar-box {
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
            border: 1px solid rgba(56, 189, 248, 0.25);
            border-radius: 16px;
            padding: 35px;
            color: #ffffff;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        }

        .radar-pill {
            background: rgba(2, 132, 199, 0.15);
            border-left: 3.5px solid var(--rv-cyan);
            padding: 12px 16px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 12px;
        }

        /* STATS */
        .stats-bar {
            background-color: var(--rv-gray-light);
            border-bottom: 1px solid var(--rv-border);
            padding: 35px 0;
        }

        /* FOOTER */
        footer {
            background-color: #0b1324;
            color: #94a3b8;
            padding: 70px 0 30px;
            border-top: 4px solid var(--rv-blue);
        }
    </style>
</head>

<body>

    {{-- BARRA SUPERIOR DE CONTACTO --}}
    <div class="py-2 bg-light border-bottom d-none d-md-block text-secondary small">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex gap-4">
                <span><i class="bi bi-geo-alt text-primary me-1"></i> Comandante Whiteside N°4903, Of. 506, San
                    Miguel</span>
                <span><i class="bi bi-telephone text-primary me-1"></i> +56 9 9491 0577</span>
            </div>
            <div>
                <span><i class="bi bi-shield-check text-success me-1"></i> Ensayos No Destructivos (NDT) & Operaciones
                    Inmobiliarias</span>
            </div>
        </div>
    </div>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="{{ asset('img/logo-rv.jpeg') }}" alt="Servicios Globales RV"
                    onerror="this.style.display='none'">
                <div class="d-inline-block">
                    <span class="fw-bold fs-5 text-dark d-block leading-1">SERVICIOS GLOBALES RV</span>
                    <small class="text-muted d-block" style="font-size: 10px; letter-spacing: 0.8px;">DETECCIÓN
                        COMPUTARIZADA & CHECK-OUTS</small>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#deteccion">Detección Computarizada</a></li>
                    <li class="nav-item"><a class="nav-link" href="#servicios">Servicios Técnicos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#nosotros">Nosotros</a></li>
                    <li class="nav-item ms-lg-2">
                        <a href="#contacto" class="btn btn-sm btn-rv-primary px-3 py-2">
                            Cotizar Inspección
                        </a>
                    </li>
                    {{-- ACCESO AL SISTEMA DISCRETO (CANDADO SUTIL) --}}
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('login') }}" class="btn-acceso-oculto" title="Área Interna">
                            <i class="bi bi-lock-fill"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section class="hero-section" id="inicio">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-7">
                    <div class="badge-pill-custom mb-3">
                        <i class="bi bi-cpu"></i> Tecnología Electrónica No Invasiva
                    </div>
                    <h1 class="display-4 fw-extrabold mb-3 text-white" style="font-weight: 800; line-height: 1.15;">
                        Detección Computarizada de Filtraciones y Gestión Técnica de Check-Outs
                    </h1>
                    <p class="lead text-light mb-4" style="opacity: 0.9; font-size: 17.5px;">
                        Localizamos fugas ocultas bajo radier, losas y tabiques mediante geófonos espectrales y
                        termografía infrarroja sin picar a ciegas. Reparamos la red de inmediato y reacondicionamos
                        departamentos para entrega formal en comunidades y edificios.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#deteccion" class="btn btn-rv-primary btn-lg">
                            <i class="bi bi-radar me-1"></i> Ver Sistema de Detección
                        </a>
                        <a href="https://wa.me/56994910577?text=Hola,%20necesito%20coordinar%20una%20inspecci%C3%B3n%20por%20filtraciones"
                            target="_blank" class="btn btn-rv-outline btn-lg">
                            <i class="bi bi-whatsapp text-success me-1"></i> Contactar Especialista
                        </a>
                    </div>
                </div>

                {{-- CARD FLOTANTE CON RESUMEN TÉCNICO --}}
                <div class="col-lg-5">
                    <div class="bg-white p-4 rounded-4 shadow-lg text-dark border-top border-4 border-primary">
                        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                            <h5 class="fw-bold mb-0 text-dark">Diagnóstico No Destructivo</h5>
                            <span class="badge bg-primary text-white">Precisión Milimétrica</span>
                        </div>
                        <p class="small text-muted mb-3">
                            Localizamos el punto exacto de la rotura hidráulica mediante tres metodologías integradas:
                        </p>
                        <div class="d-flex flex-column gap-2 mb-3">
                            <div class="p-2 border rounded bg-light d-flex align-items-center gap-3">
                                <i class="bi bi-soundwave text-primary fs-3"></i>
                                <div class="small">
                                    <strong class="text-dark d-block">Geófono Electroacústico Digital</strong>
                                    <span class="text-muted">Aislamiento espectral del flujo turbulento bajo radier o
                                        shaft.</span>
                                </div>
                            </div>
                            <div class="p-2 border rounded bg-light d-flex align-items-center gap-3">
                                <i class="bi bi-thermometer-half text-danger fs-3"></i>
                                <div class="small">
                                    <strong class="text-dark d-block">Termografía Infrarroja Calibrada</strong>
                                    <span class="text-muted">Mapeo térmico de redes de agua caliente y humedad en
                                        losas.</span>
                                </div>
                            </div>
                            <div class="p-2 border rounded bg-light d-flex align-items-center gap-3">
                                <i class="bi bi-speedometer2 text-info fs-3"></i>
                                <div class="small">
                                    <strong class="text-dark d-block">Presurización con Gas Trazador</strong>
                                    <span class="text-muted">Mezcla inocua N₂/H₂ para detectar microfisuras
                                        imperceptibles.</span>
                                </div>
                            </div>
                        </div>
                        <a href="#contacto" class="btn btn-outline-dark btn-sm w-100 fw-semibold">
                            Solicitar Evaluación en Terreno
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STATS BAR --}}
    <section class="stats-bar">
        <div class="container">
            <div class="row text-center gy-4">
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold text-dark mb-0">Cero Roturas</h2>
                    <span class="text-muted small">Inspección No Invasiva</span>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold text-dark mb-0">± 5 cm</h2>
                    <span class="text-muted small">Precisión de Localización</span>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold text-dark mb-0">+500</h2>
                    <span class="text-muted small">Departamentos Auditados</span>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold text-dark mb-0">Informes Técnicos</h2>
                    <span class="text-muted small">Válidos para Seguros y Copropiedad</span>
                </div>
            </div>
        </div>
    </section>

    {{-- DETECCIÓN COMPUTARIZADA --}}
    <section class="py-5 bg-white" id="deteccion">
        <div class="container py-4">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <span class="text-primary fw-bold text-uppercase small tracking-wide">Tecnología de
                        Diagnóstico</span>
                    <h2 class="fw-bold text-dark mb-3">Sistema Electrónico Computarizado de Fugas</h2>
                    <p class="text-muted mb-4">
                        Picar cerámicas o pisos flotantes al azar incrementa los gastos y arruina los acabados del
                        departamento. En <strong>Servicios Globales RV</strong> identificamos el punto exacto de fuga
                        para intervenir de forma puntual y quirúrgica.
                    </p>

                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-start gap-3">
                            <div class="bg-primary-subtle text-primary p-2 rounded-3 fs-4 mt-1">
                                <i class="bi bi-soundwave"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Geofonía Digital Computarizada</h6>
                                <p class="small text-muted mb-0">
                                    Sensores de suelo piezoeléctricos con filtrado activo de ruido ambiente. Registra la
                                    frecuencia acústica específica del escape de agua presurizada bajo losa o loseta.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <div class="bg-danger-subtle text-danger p-2 rounded-3 fs-4 mt-1">
                                <i class="bi bi-camera-reels"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Cámaras Termográficas de Alta Sensibilidad</h6>
                                <p class="small text-muted mb-0">
                                    Inspección óptica de gradientes de temperatura en tuberías de agua caliente,
                                    radiadores de calefacción y humedad interna en muros sin contacto destructivo.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <div class="bg-info-subtle text-info p-2 rounded-3 fs-4 mt-1">
                                <i class="bi bi-shield-shaded"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Pruebas Hidrostáticas y Gas Trazador</h6>
                                <p class="small text-muted mb-0">
                                    Manómetros digitales de precisión para comprobar la caída de presión en circuitos
                                    PEX, Cobre o PPR, complementado con sensores electroquímicos de hidrógeno.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RADAR PANEL --}}
                <div class="col-lg-6">
                    <div class="radar-box">
                        <div
                            class="d-flex justify-content-between align-items-center mb-4 border-bottom border-secondary pb-3">
                            <div>
                                <span class="badge bg-info text-dark fw-bold mb-1">PROTOCOLO TÉCNICO</span>
                                <h5 class="fw-bold text-white mb-0">Procedimiento en Terreno</h5>
                            </div>
                            <i class="bi bi-radar text-info fs-1"></i>
                        </div>

                        <div class="radar-pill">
                            <strong class="d-block text-white small">1. Prueba Manométrica de Hermeticidad</strong>
                            <span class="text-light small" style="opacity: 0.85;">Aislamiento de la red para
                                certificar pérdidas de presión hidrostática.</span>
                        </div>

                        <div class="radar-pill">
                            <strong class="d-block text-white small">2. Barrido Acústico e Infrarrojo</strong>
                            <span class="text-light small" style="opacity: 0.85;">Escaneo superficial de pisos, shafts
                                y tabiques de baños y cocinas.</span>
                        </div>

                        <div class="radar-pill">
                            <strong class="d-block text-white small">3. Informe Técnico Pericial</strong>
                            <span class="text-light small" style="opacity: 0.85;">Marcaje exacto del punto de
                                apertura, fotografía térmica y cotización de reparación.</span>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="#contacto" class="btn btn-rv-primary w-100 py-2 fw-bold">
                                <i class="bi bi-search me-1"></i> Agendar Detección de Fuga
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SERVICIOS TÉCNICOS EN GRILLA SIMÉTRICA --}}
    <section class="py-5 bg-light" id="servicios">
        <div class="container py-4">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="text-primary fw-bold text-uppercase small tracking-wide">Ficha de Operaciones</span>
                <h2 class="fw-bold text-dark">Servicios Especializados para Edificios y Departamentos</h2>
                <p class="text-muted">Procedimientos estandarizados, mano de obra calificada en terreno y trazabilidad
                    digital.</p>
            </div>

            <div class="row g-4">
                {{-- 1. DETECCIÓN COMPUTARIZADA --}}
                <div class="col-md-6 col-lg-3">
                    <div class="service-card-tech h-100 d-flex flex-column">
                        <div class="service-img-wrapper">
                            <img src="https://images.pexels.com/photos/257736/pexels-photo-257736.jpeg?auto=compress&cs=tinysrgb&w=700"
                                alt="Detección de Filtraciones Termografía" loading="lazy">
                            <span class="tech-badge">NDT Acústico</span>
                        </div>
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-2">Detección de Fugas</h6>
                            <p class="text-muted small mb-3" style="min-height: 48px;">
                                Rastreo de fugas embutidas con geófono digital y termografía sin demolición innecesaria.
                            </p>
                            <ul class="tech-specs-list mt-auto mb-0">
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Equipo:</strong> Geófono + Cámara
                                    IR</li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Redes:</strong> Cobre, PPR y PEX
                                </li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Entrega:</strong> Informe
                                    pericial</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- 2. REPARACIÓN TOTAL --}}
                <div class="col-md-6 col-lg-3">
                    <div class="service-card-tech h-100 d-flex flex-column">
                        <div class="service-img-wrapper">
                            <img src="https://images.pexels.com/photos/6474471/pexels-photo-6474471.jpeg?auto=compress&cs=tinysrgb&w=700"
                                alt="Reparación Total de Inmuebles" loading="lazy">
                            <span class="tech-badge">Llave en Mano</span>
                        </div>
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-2">Reparación de Inmuebles</h6>
                            <p class="text-muted small mb-3" style="min-height: 48px;">
                                Rehabilitación integral post-arriendo o siniestro: pisos, tabiquería, molduras y cielos.
                            </p>
                            <ul class="tech-specs-list mt-auto mb-0">
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Alcance:</strong> Obra civil
                                    menor</li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Pisos:</strong> Flotante y
                                    porcelanato</li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Objetivo:</strong> Re-arriendo
                                    rápido</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- 3. CHECK-OUT Y ACTAS --}}
                <div class="col-md-6 col-lg-3">
                    <div class="service-card-tech h-100 d-flex flex-column">
                        <div class="service-img-wrapper">
                            <img src="https://images.pexels.com/photos/8293778/pexels-photo-8293778.jpeg?auto=compress&cs=tinysrgb&w=700"
                                alt="Check-Out y Entrega de Departamentos" loading="lazy">
                            <span class="tech-badge">Gestión Terreno</span>
                        </div>
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-2">Check-Out en Terreno</h6>
                            <p class="text-muted small mb-3" style="min-height: 48px;">
                                Auditoría de desocupación con inventario fotográfico y cálculo de garantía al instante.
                            </p>
                            <ul class="tech-specs-list mt-auto mb-0">
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Formato:</strong> Acta digital en
                                    PDF</li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Respaldo:</strong> Fotos fechadas
                                </li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Tiempos:</strong> Emisión en 24
                                    hrs</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- 4. GASFITERÍA Y REDES --}}
                <div class="col-md-6 col-lg-3">
                    <div class="service-card-tech h-100 d-flex flex-column">
                        <div class="service-img-wrapper">
                            <img src="https://images.pexels.com/photos/1249611/pexels-photo-1249611.jpeg?auto=compress&cs=tinysrgb&w=700"
                                alt="Gasfitería y Reparación de Cañerías" loading="lazy">
                            <span class="tech-badge">Redes Sanitarias</span>
                        </div>
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-2">Gasfitería & Matrices</h6>
                            <p class="text-muted small mb-3" style="min-height: 48px;">
                                Reparación de matrices, cambio de llaves de paso, sifonería, sanitarios y destapes.
                            </p>
                            <ul class="tech-specs-list mt-auto mb-0">
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Técnicos:</strong> Personal
                                    calificado</li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Prueba:</strong> Test de
                                    estanqueidad</li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Garantía:</strong> 100% mano de
                                    obra</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- 5. PINTURA TÉCNICA --}}
                <div class="col-md-6 col-lg-3">
                    <div class="service-card-tech h-100 d-flex flex-column">
                        <div class="service-img-wrapper">
                            <img src="https://images.pexels.com/photos/1669754/pexels-photo-1669754.jpeg?auto=compress&cs=tinysrgb&w=700"
                                alt="Pintura Técnica de Departamentos" loading="lazy">
                            <span class="tech-badge">Acabados</span>
                        </div>
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-2">Pintura & Terminaciones</h6>
                            <p class="text-muted small mb-3" style="min-height: 48px;">
                                Sellado de fisuras, tratamiento antihongos en baños y empastado fino lavable.
                            </p>
                            <ul class="tech-specs-list mt-auto mb-0">
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Pintura:</strong> Esmalte
                                    antihongos</li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Cuidado:</strong> Protección de
                                    pisos</li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Nivel:</strong> Sin marcas de
                                    brocha</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- 6. ELECTRICIDAD E ILUMINACIÓN --}}
                <div class="col-md-6 col-lg-3">
                    <div class="service-card-tech h-100 d-flex flex-column">
                        <div class="service-img-wrapper">
                            <img src="https://images.pexels.com/photos/257700/pexels-photo-257700.jpeg?auto=compress&cs=tinysrgb&w=700"
                                alt="Electricidad e Iluminación" loading="lazy">
                            <span class="tech-badge">Circuitos</span>
                        </div>
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-2">Electricidad & Focos LED</h6>
                            <p class="text-muted small mb-3" style="min-height: 48px;">
                                Normalización de tableros, reemplazo de automáticos, enchufes y luminarias quemadas.
                            </p>
                            <ul class="tech-specs-list mt-auto mb-0">
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Norma:</strong> Protocolos de
                                    seguridad</li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Insumos:</strong> Equipos
                                    certificados</li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Prueba:</strong> Chequeo
                                    diferencial</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- 7. CERRAJERÍA INTEGRAL --}}
                <div class="col-md-6 col-lg-3">
                    <div class="service-card-tech h-100 d-flex flex-column">
                        <div class="service-img-wrapper">
                            <img src="https://images.pexels.com/photos/279810/pexels-photo-279810.jpeg?auto=compress&cs=tinysrgb&w=700"
                                alt="Cerrajería y Quincallería" loading="lazy">
                            <span class="tech-badge">Seguridad</span>
                        </div>
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-2">Cerrajería & Quincallería</h6>
                            <p class="text-muted small mb-3" style="min-height: 48px;">
                                Cambio de cilindros multipunto, ajuste de puertas, rieles de clóset y ventanas.
                            </p>
                            <ul class="tech-specs-list mt-auto mb-0">
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Marcas:</strong> Odis y Scanavini
                                </li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Ajustes:</strong> Bisagras
                                    hidráulicas</li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Entrega:</strong> Llaves selladas
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- 8. ASEO TERMINAL --}}
                <div class="col-md-6 col-lg-3">
                    <div class="service-card-tech h-100 d-flex flex-column">
                        <div class="service-img-wrapper">
                            <img src="https://images.pexels.com/photos/4107284/pexels-photo-4107284.jpeg?auto=compress&cs=tinysrgb&w=700"
                                alt="Aseo Profundo y Desinfección" loading="lazy">
                            <span class="tech-badge">Higiene</span>
                        </div>
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-2">Aseo Terminal</h6>
                            <p class="text-muted small mb-3" style="min-height: 48px;">
                                Desengrase químico de cocinas, desincrustado de sarro en baños y lavado de ventanales.
                            </p>
                            <ul class="tech-specs-list mt-auto mb-0">
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Insumos:</strong> Grado
                                    industrial</li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Detalle:</strong> Interior de
                                    muebles</li>
                                <li><i class="bi bi-check2 text-primary"></i> <strong>Entrega:</strong> Listo para
                                    habitar</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- NOSOTROS / CONVENIOS --}}
    <section class="py-5 bg-white" id="nosotros">
        <div class="container py-4">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6">
                    <span class="text-primary fw-bold text-uppercase small tracking-wide">Alianzas Corporativas</span>
                    <h2 class="fw-bold text-dark mb-3">El Aliado Operativo para Administraciones y Condominios</h2>
                    <p class="text-muted mb-3">
                        En <strong>Servicios Globales RV Ltda.</strong> resolvemos emergencias de filtraciones y
                        desocupaciones de departamentos con total respaldo documental, evitando conflictos entre
                        comunidades, comités de administración y propietarios.
                    </p>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="border rounded p-3 bg-light">
                                <i class="bi bi-receipt text-primary fs-4 d-block mb-1"></i>
                                <strong class="d-block text-dark small">Facturación Centralizada</strong>
                                <span class="text-muted" style="font-size: 11.5px;">Cotizaciones detalladas, Órdenes
                                    de Compra y facturas emitidas por cada unidad habitacional intervenida.</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="border rounded p-3 bg-light">
                                <i class="bi bi-file-earmark-pdf text-primary fs-4 d-block mb-1"></i>
                                <strong class="d-block text-dark small">Trazabilidad en PDF</strong>
                                <span class="text-muted" style="font-size: 11.5px;">Informes con registro fotográfico
                                    fechado para responder ante compañías de seguros y asambleas.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 p-md-5 rounded-4"
                        style="background: linear-gradient(135deg, #1E3050 0%, #172554 100%); color: #ffffff;">
                        <span class="badge bg-primary-subtle text-primary mb-2">CONVENIOS PREFERENCIALES</span>
                        <h4 class="fw-bold mb-3 text-white">¿Administras comunidades o edificios habitacionales?</h4>
                        <p class="text-light mb-4" style="opacity: 0.9; font-size: 14.5px;">
                            Acordamos planes de atención prioritaria ante emergencias de filtraciones y tarifas
                            convenidas por volumen para Check-Outs y acondicionamiento mensual.
                        </p>
                        <a href="https://wa.me/56994910577?text=Hola,%20me%20interesa%20un%20convenio%20corporativo%20para%20administraci%C3%B3n%20de%20edificios"
                            target="_blank" class="btn btn-rv-primary w-100 py-3 fw-bold">
                            <i class="bi bi-briefcase me-2"></i> Solicitar Convenio Corporativo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CONTACTO --}}
    <section class="py-5 bg-light" id="contacto">
        <div class="container py-4">
            <div class="row gy-5">
                <div class="col-lg-5">
                    <span class="text-primary fw-bold text-uppercase small tracking-wide">Atención Inmediata</span>
                    <h2 class="fw-bold text-dark mb-3">Coordina una Inspección Técnica</h2>
                    <p class="text-muted mb-4">Disponibles para emergencias por filtración o programación de auditorías
                        de check-out.</p>

                    <div class="d-flex flex-column gap-3 mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-white p-2 rounded-circle border text-primary fs-5"
                                style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Oficina Central</small>
                                <span class="fw-semibold text-dark">Comandante Whiteside N°4903, Of. 506, San
                                    Miguel</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-white p-2 rounded-circle border text-primary fs-5"
                                style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Teléfono / WhatsApp Operaciones</small>
                                <a href="tel:+56994910577" class="fw-semibold text-dark text-decoration-none">+56 9
                                    9491 0577</a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-white p-2 rounded-circle border text-primary fs-5"
                                style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Correo Institucional</small>
                                <a href="mailto:contacto@serviciosglobalesrv.cl"
                                    class="fw-semibold text-dark text-decoration-none">contacto@serviciosglobalesrv.cl</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FORMULARIO --}}
                <div class="col-lg-7">
                    <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border">
                        <h4 class="fw-bold text-dark mb-3">Solicitud de Servicio o Cotización</h4>
                        <form action="mailto:contacto@serviciosglobalesrv.cl" method="post" enctype="text/plain">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Nombre o Razón Social</label>
                                    <input type="text" name="nombre" class="form-control"
                                        placeholder="Ej: Inmobiliaria / Admin. Edificio" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Teléfono de Contacto</label>
                                    <input type="tel" name="telefono" class="form-control"
                                        placeholder="+56 9 ..." required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Correo Electrónico</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="contacto@empresa.cl" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Tipo de Requerimiento</label>
                                    <select name="tipo_servicio" class="form-select" required>
                                        <option value="Detección de Filtración">Detección Computarizada de Filtración
                                        </option>
                                        <option value="Reparación Total de Inmueble">Reparación Total de Inmueble
                                            (Llave en mano)</option>
                                        <option value="Check-Out Completo">Check-Out y Restitución de Depto.</option>
                                        <option value="Reparación de Gasfitería">Reparación de Gasfitería / Matrices
                                        </option>
                                        <option value="Pintura y Reparaciones">Pintura y Aseo Terminal</option>
                                        <option value="Convenio Edificio">Convenio Integral para Edificio</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Edificio / Ubicación (Comuna y
                                        Dirección)</label>
                                    <input type="text" name="edificio" class="form-control"
                                        placeholder="Ej: Edificio Aviador Acevedo, San Miguel" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Detalle Técnico de la Solicitud</label>
                                    <textarea name="mensaje" rows="4" class="form-control"
                                        placeholder="Indique si hay caída de presión, mancha de humedad visible, filtración al piso inferior o estado del departamento..."
                                        required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-rv-primary w-100 py-3 fw-bold">
                                        Enviar Requerimiento a Operaciones
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer>
        <div class="container">
            <div class="row gy-4 mb-4">
                <div class="col-lg-5">
                    <h5 class="text-white fw-bold mb-2">SERVICIOS GLOBALES RV LTDA.</h5>
                    <p class="small text-secondary mb-3">
                        Especialistas en detección electrónica no destructiva de fugas de agua, acondicionamiento de
                        departamentos, peritajes técnicos y restitución de check-outs para edificios e inmobiliarias en
                        la Región Metropolitana.
                    </p>
                    <span class="badge bg-secondary-subtle text-secondary border border-secondary">RUT:
                        78.201.133-2</span>
                </div>
                <div class="col-lg-3 col-6">
                    <h6 class="text-white fw-semibold mb-3">Secciones</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="#inicio" class="text-secondary text-decoration-none">Inicio</a></li>
                        <li><a href="#deteccion" class="text-secondary text-decoration-none">Detección
                                Computarizada</a></li>
                        <li><a href="#servicios" class="text-secondary text-decoration-none">Ficha de Servicios</a>
                        </li>
                        <li><a href="#nosotros" class="text-secondary text-decoration-none">Convenios Edificios</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-6">
                    <h6 class="text-white fw-semibold mb-3">Contacto Directo</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 text-secondary">
                        <li><i class="bi bi-geo-alt me-2 text-primary"></i> San Miguel, Santiago de Chile</li>
                        <li><i class="bi bi-whatsapp me-2 text-success"></i> +56 9 9491 0577</li>
                        <li><i class="bi bi-envelope me-2 text-primary"></i> contacto@serviciosglobalesrv.cl</li>
                        <li><i class="bi bi-globe me-2 text-primary"></i> www.serviciosglobalesrv.cl</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary opacity-25 my-4">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-center small text-secondary">
                {{-- ENLACE DISCRETO AL LOGIN EN EL SÍMBOLO COPYRIGHT --}}
                <span><a href="{{ route('login') }}" class="text-secondary text-decoration-none"
                        title="Acceso Interno">&copy;</a> {{ date('Y') }} Servicios Globales RV Ltda. Todos los
                    derechos reservados.</span>
                <span class="mt-2 mt-md-0">Tecnología de Diagnóstico Hidráulico & Operaciones</span>
            </div>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
