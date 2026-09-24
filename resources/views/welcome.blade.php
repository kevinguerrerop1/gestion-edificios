<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios Globales RV | Gestión de Check-Outs & Mantención Integral de Edificios</title>

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

        /* HERO SECTION */
        .hero-section {
            background: linear-gradient(135deg, #1E3050 0%, #0f172a 100%);
            color: #ffffff;
            padding: 100px 0 90px;
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

        /* CARDS & SERVICIOS */
        .service-card {
            background: #ffffff;
            border: 1px solid var(--rv-border);
            border-radius: 12px;
            padding: 32px 24px;
            transition: all 0.3s ease;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }

        .service-icon-box {
            width: 54px;
            height: 54px;
            border-radius: 10px;
            background-color: rgba(2, 132, 199, 0.1);
            color: var(--rv-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* STATS COUNTER */
        .stats-bar {
            background-color: var(--rv-gray-light);
            border-bottom: 1px solid var(--rv-border);
            padding: 40px 0;
        }

        /* PROCESS / PASOS */
        .step-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: var(--rv-navy);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 16px;
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
                <span><i class="bi bi-envelope text-primary me-1"></i> contacto@serviciosglobalesrv.cl</span>
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
                    <small class="text-muted d-block" style="font-size: 10px; letter-spacing: 0.8px;">GESTIÓN &
                        OPERACIONES INMOBILIARIAS</small>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#servicios">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#metodologia">Operativa</a></li>
                    <li class="nav-item"><a class="nav-link" href="#nosotros">Nosotros</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-dark px-3 py-2 fw-semibold">
                            <i class="bi bi-person-lock me-1"></i> Acceso Sistema
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="#contacto" class="btn btn-sm btn-rv-primary px-3 py-2">
                            Cotizar Servicio
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
                        <i class="bi bi-shield-check"></i> Especialistas en Comunidades & Administraciones
                    </div>
                    <h1 class="display-4 fw-extrabold mb-3 text-white" style="font-weight: 800; line-height: 1.15;">
                        Gestión Técnica de Check-Outs y Mantención para Edificios
                    </h1>
                    <p class="lead text-light mb-4" style="opacity: 0.9; font-size: 18px;">
                        Agilizamos la restitución de departamentos, inspecciones en terreno, reparaciones y
                        acondicionamiento integral con reportes respaldados y trazabilidad digital.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#contacto" class="btn btn-rv-primary btn-lg">
                            <i class="bi bi-file-earmark-text me-1"></i> Solicitar Evaluación
                        </a>
                        <a href="https://wa.me/56994910577?text=Hola,%20me%20gustaría%20solicitar%20información%20sobre%20los%20servicios%20de%20Check-Out"
                            target="_blank" class="btn btn-rv-outline btn-lg">
                            <i class="bi bi-whatsapp text-success me-1"></i> Contactar por WhatsApp
                        </a>
                    </div>
                </div>

                {{-- CARD FLOTANTE CORPORATIVA --}}
                <div class="col-lg-5">
                    <div class="bg-white p-4 rounded-4 shadow-lg text-dark">
                        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                            <h5 class="fw-bold mb-0 text-dark">Servicio Destacado</h5>
                            <span class="badge bg-primary-subtle text-primary">Inmobiliario</span>
                        </div>
                        <ul class="list-unstyled mb-4">
                            <li class="d-flex align-items-start gap-2 mb-3">
                                <i class="bi bi-check2-circle text-primary fs-5 mt-n1"></i>
                                <div>
                                    <strong class="d-block text-dark">Inspección de Salida (Check-Out)</strong>
                                    <small class="text-muted">Levantamiento fotográfico, revisión de inventario y daños
                                        en terreno.</small>
                                </div>
                            </li>
                            <li class="d-flex align-items-start gap-2 mb-3">
                                <i class="bi bi-check2-circle text-primary fs-5 mt-n1"></i>
                                <div>
                                    <strong class="d-block text-dark">Cotizaciones Inmediatas</strong>
                                    <small class="text-muted">Presupuestos detallados de pintura, gasfitería y
                                        reparaciones por bloque.</small>
                                </div>
                            </li>
                            <li class="d-flex align-items-start gap-2 mb-3">
                                <i class="bi bi-check2-circle text-primary fs-5 mt-n1"></i>
                                <div>
                                    <strong class="d-block text-dark">Trazabilidad de Documentos</strong>
                                    <small class="text-muted">Emisión de actas de entrega, órdenes de compra y
                                        facturación centralizada.</small>
                                </div>
                            </li>
                        </ul>
                        <div class="bg-light p-3 rounded-3 text-center border">
                            <span class="d-block text-muted small mb-1">¿Necesitas coordinar un check-out
                                urgente?</span>
                            <span class="fw-bold text-dark fs-5">+56 9 9491 0577</span>
                        </div>
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
                    <h2 class="fw-bold text-dark mb-0">+500</h2>
                    <span class="text-muted small">Departamentos Reparados</span>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold text-dark mb-0">100%</h2>
                    <span class="text-muted small">Reportes en Terreno</span>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold text-dark mb-0">24/48 hrs</h2>
                    <span class="text-muted small">Tiempo de Respuesta</span>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold text-dark mb-0">Garantía</h2>
                    <span class="text-muted small">Calidad en cada Entrega</span>
                </div>
            </div>
        </div>
    </section>

    {{-- SERVICIOS --}}
    <section class="py-5" id="servicios">
        <div class="container py-4">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="text-primary fw-bold text-uppercase small tracking-wide">Nuestra Especialidad</span>
                <h2 class="fw-bold text-dark">Soluciones Operativas para Edificios y Administradores</h2>
                <p class="text-muted">Cubrimos cada etapa del proceso de desocupación, reacondicionamiento y entrega de
                    unidades habitacionales y comerciales.</p>
            </div>

            <div class="row g-4">
                {{-- SERVICIO 1 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <i class="bi bi-clipboard2-check"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Check-Out y Actas de Terreno</h5>
                        <p class="text-muted small mb-0">
                            Constatación detallada del estado de entrega del inmueble. Generación de informes técnicos
                            en terreno para determinar reparos y costos atribuibles.
                        </p>
                    </div>
                </div>

                {{-- SERVICIO 2 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <i class="bi bi-paint-bucket"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Pintura y Reparaciones Menores</h5>
                        <p class="text-muted small mb-0">
                            Reacondicionamiento estético de muros, cielos rasos, masillado de orificios, esmaltado de
                            puertas y marcos para dejar el departamento listo para habitar.
                        </p>
                    </div>
                </div>

                {{-- SERVICIO 3 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <i class="bi bi-wrench-adjustable"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Gasfitería y Electricidad</h5>
                        <p class="text-muted small mb-0">
                            Reparación y reemplazo de griferías, sifones, fittings de sanitarios, revisión de circuitos
                            de enchufes, luminarias e interruptores dañados.
                        </p>
                    </div>
                </div>

                {{-- SERVICIO 4 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <i class="bi bi-door-closed"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Cerrajería y Terminaciones</h5>
                        <p class="text-muted small mb-0">
                            Cambio y unificación de cilindros de seguridad, manillas, topes de puertas, ajuste de
                            bisagras y reparación de quincallería en muebles de cocina y clósets.
                        </p>
                    </div>
                </div>

                {{-- SERVICIO 5 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <i class="bi bi-sparkles"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Aseo Profundo de Entrega</h5>
                        <p class="text-muted small mb-0">
                            Desinfección integral de baños, desengrase profundo de campanas y encimeras, lavado de
                            vidrios y sanitización para entrega inmediata.
                        </p>
                    </div>
                </div>

                {{-- SERVICIO 6 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <i class="bi bi-file-earmark-pdf"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Presupuestos y Facturación Clara</h5>
                        <p class="text-muted small mb-0">
                            Cotizaciones estructuradas por partida, orden de compra y respaldo documental transparente
                            que facilita la rendición de cuentas a propietarios y administradores.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CÓMO TRABAJAMOS --}}
    <section class="py-5 bg-light border-top border-bottom" id="metodologia">
        <div class="container py-4">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="text-primary fw-bold text-uppercase small tracking-wide">Flujo de Trabajo</span>
                <h2 class="fw-bold text-dark">Simple, Transparente y Eficiente</h2>
            </div>

            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="d-flex flex-column align-items-center">
                        <div class="step-circle">1</div>
                        <h6 class="fw-bold text-dark">Recepción & Visita</h6>
                        <p class="text-muted small">Agendamos e inspeccionamos el departamento registrando cada partida
                            que requiera intervención.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex flex-column align-items-center">
                        <div class="step-circle">2</div>
                        <h6 class="fw-bold text-dark">Cotización Detallada</h6>
                        <p class="text-muted small">Emitimos un presupuesto formal con valores unitarios claros para
                            autorización inmediata.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex flex-column align-items-center">
                        <div class="step-circle">3</div>
                        <h6 class="fw-bold text-dark">Ejecución Rápida</h6>
                        <p class="text-muted small">Nuestros técnicos asignados realizan los trabajos con los más altos
                            estándares de calidad.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex flex-column align-items-center">
                        <div class="step-circle">4</div>
                        <h6 class="fw-bold text-dark">Cierre y Acta</h6>
                        <p class="text-muted small">Entrega formal del departamento con acta firmada y respaldo en PDF
                            para su archivo.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- NOSOTROS / VALOR AGREGADO --}}
    <section class="py-5" id="nosotros">
        <div class="container py-4">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6">
                    <span class="text-primary fw-bold text-uppercase small tracking-wide">Sobre Nosotros</span>
                    <h2 class="fw-bold text-dark mb-3">Aliados Estratégicos de Administradores y Propietarios</h2>
                    <p class="text-muted mb-3">
                        En <strong>Servicios Globales RV Ltda.</strong> comprendemos la importancia de disminuir los
                        tiempos de vacancia de las propiedades. Por ello, centralizamos la logística, mano de obra y
                        rendición contable para que la rotación de arrendatarios sea ordenada y sin complicaciones.
                    </p>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="border rounded p-3 bg-white">
                                <i class="bi bi-shield-check text-primary fs-4 d-block mb-1"></i>
                                <strong class="d-block text-dark small">Técnicos Certificados</strong>
                                <span class="text-muted" style="font-size: 11.5px;">Personal calificado y coordinado
                                    en terreno.</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="border rounded p-3 bg-white">
                                <i class="bi bi-clock-history text-primary fs-4 d-block mb-1"></i>
                                <strong class="d-block text-dark small">Cumplimiento en Plazos</strong>
                                <span class="text-muted" style="font-size: 11.5px;">Cronogramas de inicio y término
                                    respetados.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 p-md-5 rounded-4"
                        style="background: linear-gradient(135deg, #1E3050 0%, #172554 100%); color: #ffffff;">
                        <h4 class="fw-bold mb-3 text-white">¿Administras una comunidad o edificio?</h4>
                        <p class="text-light mb-4" style="opacity: 0.9;">
                            Podemos convenir acuerdos mensuales de mantención o atención preferente de check-outs para
                            tu cartera de propiedades.
                        </p>
                        <a href="https://wa.me/56994910577?text=Hola,%20me%20interesa%20un%20convenio%20para%20edificios"
                            target="_blank" class="btn btn-rv-primary w-100 py-3 fw-bold">
                            <i class="bi bi-briefcase me-2"></i> Solicitar Convenio Institucional
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
                    <span class="text-primary fw-bold text-uppercase small tracking-wide">Ponte en Contacto</span>
                    <h2 class="fw-bold text-dark mb-3">Conversemos sobre tus requerimientos</h2>
                    <p class="text-muted mb-4">Estamos listos para evaluar tus proyectos y ofrecerte la mejor solución
                        técnica.</p>

                    <div class="d-flex flex-column gap-3 mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="service-icon-box mb-0 flex-shrink-0"
                                style="width: 44px; height: 44px; font-size: 18px;">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Oficina Central</small>
                                <span class="fw-semibold text-dark">Comandante Whiteside N°4903, Of. 506, San
                                    Miguel</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="service-icon-box mb-0 flex-shrink-0"
                                style="width: 44px; height: 44px; font-size: 18px;">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Teléfono / WhatsApp</small>
                                <a href="tel:+56994910577" class="fw-semibold text-dark text-decoration-none">+56 9
                                    9491 0577</a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="service-icon-box mb-0 flex-shrink-0"
                                style="width: 44px; height: 44px; font-size: 18px;">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Correo Electrónico</small>
                                <a href="mailto:contacto@serviciosglobalesrv.cl"
                                    class="fw-semibold text-dark text-decoration-none">contacto@serviciosglobalesrv.cl</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FORMULARIO --}}
                <div class="col-lg-7">
                    <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border">
                        <h4 class="fw-bold text-dark mb-3">Solicitar Cotización o Inspección</h4>
                        <form action="mailto:contacto@serviciosglobalesrv.cl" method="post" enctype="text/plain">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Nombre o Razón Social</label>
                                    <input type="text" name="nombre" class="form-control"
                                        placeholder="Ej: Inmobiliaria / Juan Pérez" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Teléfono de Contacto</label>
                                    <input type="tel" name="telefono" class="form-control"
                                        placeholder="+56 9 ..." required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Correo Electrónico</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="nombre@correo.cl" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Edificio / Ubicación</label>
                                    <input type="text" name="edificio" class="form-control"
                                        placeholder="Ej: Edificio Aviador Acevedo" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Detalle del requerimiento</label>
                                    <textarea name="mensaje" rows="4" class="form-control"
                                        placeholder="Indícanos el tipo de servicio (Check-out, pintura, reparaciones menores, aseo, etc.)..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-rv-primary w-100 py-3 fw-bold">
                                        Enviar Requerimiento
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
                        Soluciones operativas, remodelación, acondicionamiento y gestión técnica de check-outs para
                        comunidades, inmobiliarias y administraciones en la Región Metropolitana.
                    </p>
                    <span class="badge bg-secondary-subtle text-secondary border border-secondary">RUT:
                        78.201.133-2</span>
                </div>
                <div class="col-lg-3 col-6">
                    <h6 class="text-white fw-semibold mb-3">Enlaces</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="#inicio" class="text-secondary text-decoration-none">Inicio</a></li>
                        <li><a href="#servicios" class="text-secondary text-decoration-none">Nuestros Servicios</a>
                        </li>
                        <li><a href="#metodologia" class="text-secondary text-decoration-none">Metodología</a></li>
                        <li><a href="{{ route('login') }}" class="text-secondary text-decoration-none">Panel
                                Administrador</a></li>
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
                <span>&copy; {{ date('Y') }} Servicios Globales RV Ltda. Todos los derechos reservados.</span>
                <span class="mt-2 mt-md-0">Plataforma de Operaciones y Mantenimiento</span>
            </div>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
