<?php
// Comprobante de la reserva del alumno. Es 100% independiente.

require_once __DIR__ . '/../../data/usuario_sim.php';

sim_iniciar_sesion('alumno');
$usuario = sim_usuario_actual();
$nombre_alumno = $usuario['nombre'];
$iniciales = $usuario['iniciales'];
if (isset($_GET['id'])) {
    $id_reserva = $_GET['id'];
} else {
    $id_reserva = "RES-0042";
}

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

            <?php encabezado('Confirmación · Reservas', 'Detalle de la Solicitud', null, [
                'accion' => ['href' => 'historial_reservas.php', 'texto' => 'Volver al Historial', 'icono' => 'arrow-left'],
            ]); ?>

            <!-- Comprobante de la reserva -->
            <div class="panel-cristal p-6 sm:p-10 space-y-8 bg-gradient-to-br from-neutral-950/80 via-neutral-950/50 to-neutral-900/30">

                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 border-b border-neutral-950 pb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center">
                            <i data-lucide="check-circle2" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="kicker-gris">Número de identificación</span>
                            <p class="text-lg font-mono font-bold text-white"><?php echo $id_reserva; ?></p>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-4.5 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-xs font-semibold text-emerald-400">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                        Aprobado automáticamente
                    </span>
                </div>

                <!-- Datos de la reserva -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-2">

                    <div class="space-y-5">
                        <h4 class="text-xs font-mono uppercase tracking-widest text-[#7da2ce]">Información de Préstamo</h4>

                        <div class="space-y-4 font-sans text-xs">
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Beneficiario</span>
                                <span class="text-white font-semibold">Alejandro Martínez Quispe</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Documento</span>
                                <span class="text-white font-mono">DNI 71234567</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Equipo Reservado</span>
                                <span class="text-[#7da2ce] font-semibold">Dell Latitude 5420</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Identificador físico</span>
                                <span class="text-white font-mono font-semibold">LP-012</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <h4 class="text-xs font-mono uppercase tracking-widest text-[#7da2ce]">Agenda y Horarios</h4>

                        <div class="space-y-4 font-sans text-xs">
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Fecha de uso académico</span>
                                <span class="text-white font-semibold">Lunes, 18 de Mayo, 2026</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Hora de recogida</span>
                                <span class="text-white font-semibold">10:00 AM</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Límite de devolución</span>
                                <span class="text-white font-semibold">12:00 PM (Mediodía)</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Ubicación física</span>
                                <span class="text-white font-semibold">Soporte Técnico · Pabellón A</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Aviso importante -->
                <div class="p-5 rounded-2xl border border-neutral-900 bg-neutral-950/60 text-xs leading-relaxed space-y-1">
                    <span class="text-[10px] font-mono uppercase tracking-wider text-[#7da2ce] font-semibold block">Reglamento de Cómputo</span>
                    <p class="text-neutral-400">Es indispensable mostrar tu **DNI en físico** para que el soporte técnico valide y te entregue la laptop. Recuerda devolver el hardware dentro del horario establecido para evitar penalidades y suspensiones de cuenta.</p>
                </div>

                <div class="flex justify-center pt-4 border-t border-neutral-950">
                    <a href="dashboard_alumno.php" class="btn-alumno-primario shadow-lg py-3 px-8 text-xs font-bold tracking-wider rounded-xl uppercase">
                        <i data-lucide="check" class="w-4 h-4 text-black"></i>
                        Aceptar y Cerrar
                    </a>
                </div>

            </div>

        </main>

    </div>

    <!-- Pie de página -->
    <?php include __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
