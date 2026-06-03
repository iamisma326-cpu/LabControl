<?php
// Pantalla de configuración del jefe de soporte. Es 100% independiente, sin includes visuales.

require_once __DIR__ . '/../../data/usuario_sim.php';

sim_iniciar_sesion('jefe_soporte');
$usuario = sim_usuario_actual();
$nombre_jefe_soporte = $usuario['nombre'];
$iniciales = $usuario['iniciales'];

// Pestaña abierta (como el menú de un lado del panel).
$pestanas_validas = ['perfil', 'usuarios'];
if (isset($_GET['tab'])) { $tab = $_GET['tab']; } else { $tab = 'perfil'; }
if (!in_array($tab, $pestanas_validas, true)) {
    $tab = 'perfil';
}

$fondo = 'color';
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="pagina-contenedor-compacto">

    <?php $rol_actual = 'Jefe de Soporte'; ?>
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
                <p class="kicker-azul">Centro de Control</p>
                <h3 class="valor-stat-sm">Jefe de Soporte Técnico</h3>
                <p class="texto-descripcion-mt">Gestión integral de laboratorios y soporte técnico.</p>
            </section>
            <a href="dashboard_jefe_soporte.php" class="btn-alumno-primario w-full text-center justify-center">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                <span>Dashboard</span>
            </a>
            <nav class="panel-cristal contenedor-nav" aria-label="Navegación del jefe de soporte">
                <a href="dashboard_jefe_soporte.php" class="nav-lateral <?php if ($pagina_actual === 'dashboard_jefe_soporte.php') { echo 'activo'; } ?>">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>
                <a href="asistencia_facial.php" class="nav-lateral <?php if ($pagina_actual === 'asistencia_facial.php') { echo 'activo'; } ?>">
                    <i data-lucide="camera" class="w-4 h-4"></i>
                    <span>Tomar Asistencia</span>
                </a>
                <a href="gestion_practicantes.php" class="nav-lateral <?php if ($pagina_actual === 'gestion_practicantes.php') { echo 'activo'; } ?>">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <span>Gestión de Practicantes</span>
                </a>
                <a href="gestion_asistencias.php" class="nav-lateral <?php if ($pagina_actual === 'gestion_asistencias.php') { echo 'activo'; } ?>">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <span>Gestión de Asistencias</span>
                </a>
                <a href="solicitudes_reservas.php" class="nav-lateral <?php if ($pagina_actual === 'solicitudes_reservas.php') { echo 'activo'; } ?>">
                    <i data-lucide="laptop" class="w-4 h-4"></i>
                    <span>Solicitudes de Reservas</span>
                </a>
                <a href="solicitudes_incidencias.php" class="nav-lateral <?php if ($pagina_actual === 'solicitudes_incidencias.php') { echo 'activo'; } ?>">
                    <i data-lucide="wrench" class="w-4 h-4"></i>
                    <span>Solicitudes de Incidencias</span>
                </a>
                <a href="gestion_laboratorios.php" class="nav-lateral <?php if ($pagina_actual === 'gestion_laboratorios.php') { echo 'activo'; } ?>">
                    <i data-lucide="database" class="w-4 h-4"></i>
                    <span>Inventario</span>
                </a>
                <a href="reportes_excel.php" class="nav-lateral <?php if ($pagina_actual === 'reportes_excel.php') { echo 'activo'; } ?>">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    <span>Reportes</span>
                </a>
                <a href="configuracion.php" class="nav-lateral <?php if ($pagina_actual === 'configuracion.php') { echo 'activo'; } ?>">
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

            <?php encabezado('Configuración del Sistema', 'Ajustes Generales', 'Gestione los parámetros operativos, la seguridad biométrica y los accesos del mantenimiento de los Laboratorios de Cómputo 1, 2 y 5.'); ?>

            <!-- Pestañas y su contenido -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Pestañas de la izquierda -->
                <nav class="lg:col-span-3 flex flex-row lg:flex-col gap-2 overflow-x-auto lg:overflow-visible pb-3 lg:pb-0 scrollbar-none self-start" aria-label="Configuración">
                    <a href="?tab=perfil" class="nav-lateral <?php if ($tab === 'perfil') { echo 'activo'; } ?> w-full text-center lg:text-left whitespace-nowrap lg:whitespace-normal">
                        <i data-lucide="user" class="w-4 h-4 hidden lg:inline-block"></i>
                        <span>Perfil General</span>
                    </a>

                </nav>

                <!-- Contenido de la derecha -->
                <div class="lg:col-span-9 space-y-8">

                    <!-- Datos del perfil -->
                    <section id="perfil" class="panel-cristal p-6 sm:p-8 space-y-6 <?php if ($tab !== 'perfil') { echo 'hidden'; } ?>">
                        <div class="border-b border-neutral-900/60 pb-3 flex items-center gap-2">
                            <i data-lucide="user" class="icono-azul"></i>
                            <h3 class="titulo-seccion">Información del Encargado</h3>
                        </div>

                        <form action="#" method="post" class="space-y-6">
                            <div class="flex flex-col sm:flex-row gap-6 items-start">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 rounded-2xl bg-[#7da2ce]/15 border border-neutral-800 flex items-center justify-center text-2xl font-bold text-[#7da2ce]">
                                        RS
                                    </div>
                                    <button type="button" class="text-[11px] font-mono uppercase tracking-wider text-[#7da2ce] hover:text-white mt-3 flex items-center gap-1.5 transition-colors">
                                        <i data-lucide="camera" class="w-3.5 h-3.5"></i>
                                        <span>Editar foto</span>
                                    </button>
                                </div>

                                <div class="flex-grow space-y-4 w-full">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <label class="etiqueta-form-alumno" for="nombre">Nombre Completo</label>
                                            <input type="text" id="nombre" name="nombre" class="campo-form-alumno" value="Ing. Roberto Salazar">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="etiqueta-form-alumno" for="cargo">Cargo</label>
                                            <input type="text" id="cargo" name="cargo" class="campo-form-alumno" value="Administrador · Jefe de Soporte Técnico" disabled>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="etiqueta-form-alumno" for="correo">Correo Electrónico</label>
                                        <input type="email" id="correo" name="correo" class="campo-form-alumno" value="rsalazar@istpargentina.edu.pe">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end gap-3 border-t border-neutral-900/60 pt-6">
                                <button type="reset" class="btn-alumno-secundario">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn-alumno-primario">
                                    <i data-lucide="save" class="w-4 h-4"></i>
                                    Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </section>



                </div>
            </div>

        </main>

    </div>

    <!-- Pie de página -->
    <?php require_once __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
