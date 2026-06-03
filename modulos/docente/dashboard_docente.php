<?php
// Panel principal del docente. Es 100% independiente, sin includes visuales.

require_once __DIR__ . '/../../data/usuario_sim.php';

sim_iniciar_sesion('docente');
$usuario = sim_usuario_actual();
$nombre_docente = $usuario['nombre'];
$iniciales = $usuario['iniciales'];

$fondo = 'color';
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="pagina-contenedor-compacto">

    <?php $rol_actual = 'Docente'; ?>
    <header class="panel-cristal barra-panel">
        <div class="flex items-center gap-3">
            <div class="icono-tarjeta">
                <i data-lucide="box" class="w-5 h-5 text-[#7da2ce]"></i>
            </div>
            <span class="titulo-panel">LabControl <span class="text-xs font-mono font-normal text-neutral-500">// <?php echo $rol_actual; ?></span></span>
        </div>
        <div class="flex items-center gap-3">
            <div class="avatar-pulsante">
                <div class="avatar-iniciales"><?php echo $iniciales; ?></div>
            </div>
        </div>
    </header>

    <div class="disposicion-alumno">

        <aside class="flex flex-col gap-6">
            <section class="panel-cristal tarjeta-stat-suave">
                <p class="kicker-azul">Portal del Docente</p>
                <h3 class="valor-stat-sm">Gestión de Soporte Técnico</h3>
                <p class="texto-descripcion-mt">Accede y administra las solicitudes de soporte para los laboratorios.</p>
            </section>
            <a href="formulario_soporte.php" class="btn-alumno-primario w-full text-center justify-center">
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                <span>Solicitar Soporte</span>
            </a>
            <nav class="panel-cristal contenedor-nav" aria-label="Navegación del docente">
                <a href="dashboard_docente.php" class="nav-lateral <?php if ($pagina_actual == 'dashboard_docente.php') { echo 'activo'; } ?>">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Panel Principal</span>
                </a>
                <a href="reservar_laptop_docente.php" class="nav-lateral <?php if ($pagina_actual == 'reservar_laptop_docente.php') { echo 'activo'; } ?>">
                    <i data-lucide="laptop" class="w-4 h-4"></i>
                    <span>Reservar Laptop</span>
                </a>
                <a href="formulario_soporte.php" class="nav-lateral <?php if ($pagina_actual == 'formulario_soporte.php') { echo 'activo'; } ?>">
                    <i data-lucide="wrench" class="w-4 h-4"></i>
                    <span>Solicitar Soporte</span>
                </a>
                <a href="configuracion_docente.php" class="nav-lateral <?php if ($pagina_actual == 'configuracion_docente.php') { echo 'activo'; } ?>">
                    <i data-lucide="settings" class="w-4 h-4"></i>
                    <span>Configuración</span>
                </a>
                <div class="divisor"></div>
                <a href="<?php echo $base; ?>public/index.php" class="nav-lateral hover:text-rose-400">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </nav>
        </aside>

        <main class="flex flex-col gap-8">

            <section class="panel-cristal p-6 sm:p-8 bg-gradient-to-r from-neutral-950/80 via-neutral-950/40 to-neutral-950/10">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border border-neutral-900 bg-neutral-950/80 text-[10px] font-mono text-[#7da2ce] mb-4">
                    <span class="w-1.5 h-1.5 bg-sky-400 rounded-full animate-pulse"></span>
                    Sesión Iniciada Correctamente
                </span>
                <h2 class="text-3xl sm:text-4xl font-semibold tracking-tight text-white mb-3">¡Hola, Prof. <?php echo $nombre_docente; ?>!</h2>
                <p class="text-sm text-neutral-400 leading-relaxed max-w-2xl">Bienvenido a tu panel de control docente. Desde aquí puedes realizar solicitudes de préstamos de laptops para tus clases, solicitar soporte técnico para cualquier aula o laboratorio, y gestionar tus datos personales.</p>
            </section>

            <!-- Accesos rápidos -->
            <section class="flex flex-col gap-4">
                <h3 class="text-lg font-semibold tracking-wide text-neutral-200">Acciones Rápidas</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Acceso 1: Reservar Laptop -->
                    <a href="reservar_laptop_docente.php" class="panel-cristal tarjeta-bento select-none group">
                        <div class="space-y-4">
                            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-[#7da2ce]/15 to-neutral-900 border border-neutral-800 flex items-center justify-center text-sm font-bold text-[#7da2ce] transition-transform duration-300 group-hover:scale-105 group-hover:border-[#7da2ce]/40">
                                <i data-lucide="laptop" class="w-5 h-5 text-[#7da2ce]"></i>
                            </div>
                            <h4 class="text-lg font-bold text-white tracking-wide">Reservar Laptops</h4>
                            <p class="texto-descripcion">Solicita equipos portátiles del centro de cómputo para el uso de tus alumnos en clase.</p>
                        </div>
                        <div class="mt-6 flex items-center gap-2 text-[11px] font-mono tracking-wider uppercase text-[#7da2ce] group-hover:text-white transition-colors">
                            <span>Crear Solicitud</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </a>

                    <!-- Acceso 2: Solicitar Soporte -->
                    <a href="formulario_soporte.php" class="panel-cristal tarjeta-bento select-none group">
                        <div class="space-y-4">
                            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-indigo-950/20 to-neutral-900 border border-neutral-800 flex items-center justify-center text-sm font-bold text-[#7da2ce] transition-transform duration-300 group-hover:scale-105 group-hover:border-[#7da2ce]/40">
                                <i data-lucide="wrench" class="w-5 h-5 text-[#7da2ce]"></i>
                            </div>
                            <h4 class="text-lg font-bold text-white tracking-wide">Solicitar Soporte</h4>
                            <p class="texto-descripcion">Reporta fallas técnicas o solicita asistencia en los laboratorios de cómputo.</p>
                        </div>
                        <div class="mt-6 flex items-center gap-2 text-[11px] font-mono tracking-wider uppercase text-[#7da2ce] group-hover:text-white transition-colors">
                            <span>Enviar Reporte</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </a>

                </div>
            </section>

            <!-- Estado actual y avisos -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Reserva activa -->
                <div class="panel-cristal p-6 flex flex-col justify-between lg:col-span-2 space-y-6">
                    <div class="flex justify-between items-center pb-4 border-b border-neutral-900/60">
                        <h4 class="text-base font-semibold tracking-wide text-neutral-200">Estado Actual de Reserva</h4>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-400">
                            <span class="punto-estado punto-verde animate-ping"></span>
                            Aprobado
                        </span>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-5 items-start sm:items-center py-2">
                        <div class="w-14 h-14 rounded-2xl bg-neutral-900 border border-neutral-800 flex items-center justify-center text-base font-semibold text-[#7da2ce]">
                            <i data-lucide="laptop" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-xs font-mono tracking-wider text-[#7da2ce] uppercase">Reserva Registrada</p>
                            <h5 class="text-xl font-bold text-white mt-0.5">Dell Latitude 5420</h5>
                            <p class="text-xs text-neutral-400 mt-1 flex items-center gap-1.5">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                Distribución a coordinar con Soporte Técnico
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 py-4 border-t border-b border-neutral-900/60 text-center sm:text-left">
                        <div>
                            <span class="text-[10px] font-mono text-neutral-500 uppercase">Fecha</span>
                            <p class="text-xs font-semibold text-white mt-1">Lunes, 18 de Mayo</p>
                        </div>
                        <div>
                            <span class="text-[10px] font-mono text-neutral-500 uppercase">Horario</span>
                            <p class="text-xs font-semibold text-white mt-1">10:00 AM - 12:00 PM</p>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] font-mono text-neutral-500 uppercase">Equipos</span>
                            <p class="text-xs font-bold text-[#7da2ce] mt-1">1 Laptop</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-xs">
                        <span class="text-neutral-500 font-mono">Código de solicitud: <strong class="text-white font-semibold">RES-0042</strong></span>
                        <a href="confirmacion_reserva_docente.php?id=RES-0042" class="btn-alumno-secundario btn-sm py-2 px-4 text-xs font-semibold">
                            <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                            Ver Detalle
                        </a>
                    </div>
                </div>

                <!-- Aviso de un lado -->
                <div class="panel-acento p-6 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center gap-2">
                            <span class="p-1 rounded bg-[#7da2ce]/10 border border-[#7da2ce]/20">
                                <i data-lucide="info" class="w-4 h-4 text-[#7da2ce]"></i>
                            </span>
                            <span class="text-xs font-mono tracking-wider text-[#7da2ce] uppercase">Entrega en Aulas</span>
                        </div>

                        <h4 class="text-base font-bold text-white tracking-wide">Distribución de Laptops</h4>
                        <p class="texto-descripcion">Recuerda que el soporte técnico entregará las laptops solicitadas directamente en el aula o laboratorio indicado en tu reserva. No es necesario recogerlas en persona.</p>
                    </div>

                    <a href="configuracion_docente.php" class="btn-alumno-primario text-xs tracking-wider py-2.5 px-4 rounded-xl font-bold justify-center mt-6">
                        <span>Mi Perfil Docente</span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>

            </div>

        </main>

    </div>

    <!-- Pie de página -->
    <?php include __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
