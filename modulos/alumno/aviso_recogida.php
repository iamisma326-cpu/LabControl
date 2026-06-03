<?php
// Aviso de equipo listo para recoger (alumno). Es 100% independiente.

require_once __DIR__ . '/../../data/usuario_sim.php';

sim_iniciar_sesion('alumno');
$usuario = sim_usuario_actual();
$nombre_alumno = $usuario['nombre'];
$iniciales = $usuario['iniciales'];

$fondo = 'color';
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="pagina-contenedor-compacto">

    <?php $rol_actual = 'Alumno'; ?>
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
                <p class="kicker-azul">Portal del Alumno</p>
                <h3 class="valor-stat-sm">Préstamo de Laptops</h3>
                <p class="texto-descripcion-mt">Accede y administra las solicitudes de préstamos del centro de cómputo.</p>
            </section>
            <a href="reservar_laptop.php" class="btn-alumno-primario w-full text-center justify-center">
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                <span>Reservar Laptop</span>
            </a>
            <nav class="panel-cristal contenedor-nav" aria-label="Navegación del alumno">
                <a href="dashboard_alumno.php" class="nav-lateral <?php if ($pagina_actual == 'dashboard_alumno.php') { echo 'activo'; } ?>">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Panel Principal</span>
                </a>
                <a href="reservar_laptop.php" class="nav-lateral <?php if ($pagina_actual == 'reservar_laptop.php') { echo 'activo'; } ?>">
                    <i data-lucide="laptop" class="w-4 h-4"></i>
                    <span>Reservar Laptop</span>
                </a>
                <a href="historial_reservas.php" class="nav-lateral <?php if ($pagina_actual == 'historial_reservas.php') { echo 'activo'; } ?>">
                    <i data-lucide="history" class="w-4 h-4"></i>
                    <span>Mis Reservas</span>
                </a>
                <a href="configuracion_alumno.php" class="nav-lateral <?php if ($pagina_actual == 'configuracion_alumno.php') { echo 'activo'; } ?>">
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

            <?php encabezado('Notificaciones · Avisos e Instrucciones', 'Aviso de Recepción de Equipo', null, [
                'color' => 'amber',
                'accion' => ['href' => 'dashboard_alumno.php', 'texto' => 'Volver al Panel', 'icono' => 'arrow-left'],
            ]); ?>

            <!-- Zona de avisos -->
            <div class="panel-acento p-6 sm:p-10 space-y-6">

                <div class="flex items-center gap-3 border-b border-white/5 pb-6">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center">
                        <i data-lucide="bell" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-mono uppercase text-amber-500">Notificación al Alumno</span>
                        <h3 class="text-xl font-bold text-white mt-0.5">Equipo listo para recogida</h3>
                    </div>
                </div>

                <div class="space-y-4 text-sm leading-relaxed text-neutral-300">
                    <p>Estimado estudiante, se ha procesado y programado con éxito tu requerimiento de hardware para las labores presenciales correspondientes al día de hoy.</p>

                    <div class="bg-neutral-950/65 p-5 border border-neutral-900/60 rounded-xl space-y-3 font-sans text-xs my-4">
                        <span class="text-[10px] uppercase font-mono tracking-wider font-semibold text-[#7da2ce]">Detalles de Entrega</span>
                        <ul class="space-y-2 text-neutral-400 list-disc list-inside">
                            <li>Equipo asignado: <strong class="text-white font-semibold">HP ProBook 450 G9</strong></li>
                            <li>Horario de atención límite: <strong class="text-white font-semibold">Antes de las 14:00 (02:00 PM)</strong></li>
                            <li>Área de entrega: <strong class="text-white font-semibold">Mesa de Soporte Técnico · Pabellón A</strong></li>
                        </ul>
                    </div>

                    <p>Por políticas esenciales de seguridad del instituto, te recordamos que debes poseer tu **DNI original o Carnet de estudiante vigente para validar el canje físico**.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 text-xs font-sans text-neutral-400">
                    <div class="p-4 rounded-xl border border-neutral-900 bg-neutral-950/25 space-y-1">
                        <span class="text-amber-500 font-bold font-mono text-[11px] uppercase tracking-wider block">Paso 1</span>
                        <p>Lleva tu DNI en físico al Pabellón A.</p>
                    </div>
                    <div class="p-4 rounded-xl border border-neutral-900 bg-neutral-950/25 space-y-1">
                        <span class="text-amber-500 font-bold font-mono text-[11px] uppercase tracking-wider block">Paso 2</span>
                        <p>Firma la conformidad del préstamo portátil.</p>
                    </div>
                    <div class="p-4 rounded-xl border border-neutral-900 bg-neutral-950/25 space-y-1">
                        <span class="text-amber-500 font-bold font-mono text-[11px] uppercase tracking-wider block">Paso 3</span>
                        <p>Devuelve el equipo completo antes de tu límite.</p>
                    </div>
                </div>

                <div class="flex justify-center pt-6 border-t border-white/5">
                    <a href="dashboard_alumno.php" class="btn-alumno-primario shadow-lg py-3 px-8 text-xs font-bold tracking-wider rounded-xl uppercase">
                        <span>Entendido</span>
                    </a>
                </div>

            </div>

        </main>

    </div>

    <!-- Pie de página -->
    <?php include __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
