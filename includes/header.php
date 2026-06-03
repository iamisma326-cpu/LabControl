<?php
require_once __DIR__ . '/encabezado_pagina.php';

// Detecta en qué página estamos.
$pagina_actual = basename($_SERVER['PHP_SELF']);

// Calcula la ruta relativa hacia la raíz del proyecto (donde está la carpeta assets/).
// Las páginas dentro de modulos/<rol>/ están a 2 carpetas de la raíz;
// las de public/ y auth/ están a 1 carpeta.
if (strpos($_SERVER['PHP_SELF'], '/modulos/') !== false) {
    $base = '../../';
} else {
    $base = '../';
}

// Fondo de la página: 'video' (páginas públicas) o 'color' (paneles).
// La página puede poner $fondo = 'color'; antes de incluir este header.
if (isset($fondo)) {
    // Se queda con el valor que puso la página.
} else {
    $fondo = 'video';
}
?>
<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabControl - Gestión de Laboratorios y Practicantes</title>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/tailwind.css?v=<?php echo @filemtime(__DIR__ . '/../assets/css/tailwind.css'); ?>">
    <!-- Iconos (desde internet) -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Estilos solo para los paneles de cada rol -->
    <!-- Se usan solo en los paneles de alumno, docente y soporte -->
    <?php
    $paginas_privadas = [
        'dashboard_alumno.php',
        'reservar_laptop.php',
        'historial_reservas.php',
        'configuracion_alumno.php',
        'confirmacion_reserva.php',
        'aviso_recogida.php',
        'dashboard_docente.php',
        'formulario_soporte.php',
        'configuracion_docente.php',
        'dashboard_jefe_soporte.php',
        'asistencia_facial.php',
        'configuracion.php',
        'gestion_asistencias.php',
        'nuevo_practicante.php',
        'editar_practicante.php',
        'reportes_excel.php',
        'solicitudes_incidencias.php',
        'solicitudes_reservas.php',
        'gestion_laboratorios.php',
        'registrar_equipo.php',
        'editar_equipo.php',
        'gestion_practicantes.php',
        'reservar_laptop_docente.php',
        'confirmacion_reserva_docente.php'
    ];
    if (in_array($pagina_actual, $paginas_privadas)):
    ?>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/app/styles.css">
    <?php endif; ?>
</head>
<?php if ($fondo === 'color'): ?>
<body class="min-h-screen text-white relative flex flex-col justify-between selection:bg-[#7da2ce]/30 selection:text-white overflow-x-hidden h-full" style="background-color: #0E0929 !important;">
<?php else: ?>
<body class="min-h-screen bg-black text-white relative flex flex-col justify-between selection:bg-[#7da2ce]/30 selection:text-white overflow-x-hidden h-full">

    <!-- Video de fondo -->
    <video
        autoplay
        loop
        muted
        playsinline
        class="fixed inset-0 w-screen h-screen h-[100dvh] object-cover object-center pointer-events-none z-0 opacity-80"
        style="mix-blend-mode: screen;"
    >
        <source src="https://res.cloudinary.com/dfsc2cv8f/video/upload/v1779569010/7ebac3f7-5656-4e06-b04a-62f4ac95b1d8_f3ggky.mp4" type="video/mp4" />
    </video>
<?php endif; ?>

    <!-- Detalles visuales del fondo -->
    <div class="fixed inset-0 bg-[linear-gradient(to_bottom,rgba(255,255,255,0.01)_1px,transparent_1px),linear-gradient(to_right,rgba(255,255,255,0.01)_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(circle_60%_at_50%_40%,#000_30%,transparent_100%)] pointer-events-none z-10 opacity-40"></div>
    <div class="fixed top-1/4 left-1/4 w-96 h-96 bg-[#7da2ce]/5 rounded-full blur-[140px] pointer-events-none z-10"></div>
    <div class="fixed bottom-1/4 right-1/4 w-[500px] h-[500px] bg-neutral-900/40 rounded-full blur-[160px] pointer-events-none z-10"></div>

    <?php
    // La barra de navegación solo aparece en las páginas públicas.
    $paginas_con_cabecera = ['index.php', 'nosotros.php', 'caracteristicas.php'];
    if (in_array($pagina_actual, $paginas_con_cabecera)):
    ?>
    <!-- Barra de navegación -->
    <header class="relative z-40 w-full max-w-7xl mx-auto px-6 sm:px-12 py-7 flex items-center justify-between">
        <!-- Logo -->
        <a href="<?php echo $base; ?>public/index.php" class="flex items-center gap-3.5 cursor-pointer group select-none">
            <div class="relative w-6 h-6 flex items-center justify-center">
                <svg class="w-5.5 h-5.5 text-white transform transition-transform duration-500 group-hover:rotate-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                    <path d="M3 16V4a1 1 0 0 1 1-1h12M8 21h12a1 1 0 0 0 1-1V8" stroke-linecap="round" stroke-linejoin="round" />
                    <line x1="3" y1="21" x2="21" y2="3" stroke-width="2.2" stroke-linecap="round" />
                </svg>
            </div>
            <span class="text-xl font-medium tracking-tight text-white font-sans">
                LabControl
            </span>
        </a>

        <nav class="flex items-center gap-5 sm:gap-9 lg:gap-11">
            <a
                href="<?php echo $base; ?>public/index.php"
                class="hidden sm:block text-xs sm:text-[13.5px] font-normal transition-colors duration-200 <?php echo ($pagina_actual == 'index.php' || $pagina_actual == '') ? 'text-white font-medium border-b border-white/20 pb-0.5' : 'text-neutral-400 hover:text-white'; ?>"
            >
                Inicio
            </a>

            <a
                href="<?php echo $base; ?>public/caracteristicas.php"
                class="text-xs sm:text-[13.5px] font-normal transition-colors duration-200 <?php echo ($pagina_actual == 'caracteristicas.php') ? 'text-white font-medium border-b border-white/20 pb-0.5' : 'text-neutral-400 hover:text-white'; ?>"
            >
                Características
            </a>

            <a
                href="<?php echo $base; ?>public/nosotros.php"
                class="text-xs sm:text-[13.5px] font-normal transition-colors duration-200 <?php echo ($pagina_actual == 'nosotros.php') ? 'text-white font-medium border-b border-white/20 pb-0.5' : 'text-neutral-400 hover:text-white'; ?>"
            >
                Nosotros
            </a>
        </nav>
    </header>
    <?php endif; ?>
