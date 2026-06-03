<?php
// Comprobante de la reserva del docente. Es 100% independiente.

require_once __DIR__ . '/../../data/usuario_sim.php';

sim_iniciar_sesion('docente');
$usuario = sim_usuario_actual();
$nombre_docente = $usuario['nombre'];
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

            <?php encabezado('Confirmación · Reservas', 'Detalle de la Solicitud', null, [
                'accion' => ['href' => 'reservar_laptop_docente.php', 'texto' => 'Volver al Formulario', 'icono' => 'arrow-left'],
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
                        Solicitud registrada
                    </span>
                </div>

                <!-- Datos de la reserva -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-2">

                    <div class="space-y-5">
                        <h4 class="text-xs font-mono uppercase tracking-widest text-[#7da2ce]">Información de Préstamo</h4>

                        <div class="space-y-4 font-sans text-xs">
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Docente</span>
                                <span class="text-white font-semibold">Diana Carolina Vargas Llanos</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Documento</span>
                                <span class="text-white font-mono">DNI 987321654</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Cantidad</span>
                                <span class="text-white font-semibold">1 laptop</span>
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
                        <h4 class="text-xs font-mono uppercase tracking-widest text-[#7da2ce]">Agenda y Entrega</h4>

                        <div class="space-y-4 font-sans text-xs">
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Fecha de uso académico</span>
                                <span class="text-white font-semibold">Lunes, 18 de Mayo, 2026</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Hora de inicio</span>
                                <span class="text-white font-semibold">10:00 AM</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Hora de fin</span>
                                <span class="text-white font-semibold">12:00 PM (Mediodía)</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-neutral-950">
                                <span class="text-neutral-500">Lugar de entrega</span>
                                <span class="text-white font-semibold">A coordinar con soporte técnico</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Aviso importante -->
                <div class="p-5 rounded-2xl border border-neutral-900 bg-neutral-950/60 text-xs leading-relaxed space-y-1">
                    <span class="text-[10px] font-mono uppercase tracking-wider text-[#7da2ce] font-semibold block">Coordinación con soporte</span>
                    <p class="text-neutral-400">El equipo de soporte técnico llevará las laptops al aula o laboratorio que indicaste al inicio del horario reservado. No necesitas recogerlas en persona. Si requieres cambiar la ubicación o el horario, contacta a soporte técnico con anticipación.</p>
                </div>

                <div class="flex justify-center pt-4 border-t border-neutral-950">
                    <a href="dashboard_docente.php" class="btn-alumno-primario shadow-lg py-3 px-8 text-xs font-bold tracking-wider rounded-xl uppercase">
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
