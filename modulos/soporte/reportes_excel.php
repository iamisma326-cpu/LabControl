<?php
// Pantalla para descargar reportes en Excel. Es 100% independiente, sin includes visuales.

require_once __DIR__ . '/../../data/usuario_sim.php';

sim_iniciar_sesion('jefe_soporte');
$usuario = sim_usuario_actual();
$nombre_jefe_soporte = $usuario['nombre'];
$iniciales = $usuario['iniciales'];

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
                <?php
                if (isset($pagina_actual)) { $pag = $pagina_actual; } else { $pag = ''; }
                ?>
                <a href="dashboard_jefe_soporte.php" class="nav-lateral<?php if ($pag === 'dashboard_jefe_soporte.php') { echo ' activo'; } ?>">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>
                <a href="asistencia_facial.php" class="nav-lateral<?php if ($pag === 'asistencia_facial.php') { echo ' activo'; } ?>">
                    <i data-lucide="camera" class="w-4 h-4"></i>
                    <span>Tomar Asistencia</span>
                </a>
                <a href="gestion_practicantes.php" class="nav-lateral<?php if ($pag === 'gestion_practicantes.php') { echo ' activo'; } ?>">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <span>Gestión de Practicantes</span>
                </a>
                <a href="gestion_asistencias.php" class="nav-lateral<?php if ($pag === 'gestion_asistencias.php') { echo ' activo'; } ?>">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <span>Gestión de Asistencias</span>
                </a>
                <a href="solicitudes_reservas.php" class="nav-lateral<?php if ($pag === 'solicitudes_reservas.php') { echo ' activo'; } ?>">
                    <i data-lucide="laptop" class="w-4 h-4"></i>
                    <span>Solicitudes de Reservas</span>
                </a>
                <a href="solicitudes_incidencias.php" class="nav-lateral<?php if ($pag === 'solicitudes_incidencias.php') { echo ' activo'; } ?>">
                    <i data-lucide="wrench" class="w-4 h-4"></i>
                    <span>Solicitudes de Incidencias</span>
                </a>
                <a href="gestion_laboratorios.php" class="nav-lateral<?php if ($pag === 'gestion_laboratorios.php') { echo ' activo'; } ?>">
                    <i data-lucide="database" class="w-4 h-4"></i>
                    <span>Inventario</span>
                </a>
                <a href="reportes_excel.php" class="nav-lateral<?php if ($pag === 'reportes_excel.php') { echo ' activo'; } ?>">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    <span>Reportes</span>
                </a>
                <a href="configuracion.php" class="nav-lateral<?php if ($pag === 'configuracion.php') { echo ' activo'; } ?>">
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

            <?php encabezado('Generación de Reportes', 'Exportación de Datos', 'Configura y exporta datos consolidados de asistencia, inventario operativo y métricas de rendimiento.'); ?>

            <!-- Configuración -->
            <div class="max-w-2xl mx-auto w-full">

                <!-- Opciones de configuración -->
                <section class="panel-cristal p-6 space-y-6">
                    <h3 class="text-lg font-semibold text-white border-b border-neutral-900/60 pb-3">Parámetros del Reporte</h3>

                    <form action="#" method="post" class="space-y-6">

                        <!-- Tipo de reporte -->
                        <div class="space-y-3">
                            <label class="block text-sm font-medium text-neutral-300">Tipo de Reporte</label>
                            <input type="hidden" name="tipo_reporte" value="inventario">
                        </div>

                        <!-- Rango de fechas -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-neutral-300">Rango de Fechas</label>
                            <div class="space-y-3">
                                <input type="date" id="fecha_desde" name="fecha_desde" class="campo-form-alumno w-full" value="2026-05-01">
                                <input type="date" id="fecha_hasta" name="fecha_hasta" class="campo-form-alumno w-full" value="2026-05-31">
                            </div>
                        </div>

                        <!-- Estado del equipo -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-neutral-300" for="estado_eq">Estado del Equipo</label>
                            <select id="estado_eq" name="estado_eq" class="campo-form-alumno w-full">
                                <option>Todos los estados</option>
                                <option>Operativo</option>
                                <option>En Mantenimiento</option>
                                <option>Dañado / Fuera de uso</option>
                                <option>De baja</option>
                            </select>
                        </div>

                        <!-- Laboratorio -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-neutral-300" for="lab">Laboratorio / Aula</label>
                            <select id="lab" name="lab" class="campo-form-alumno w-full">
                                <option>Todos los laboratorios</option>
                                <option>Laboratorio de Cómputo 1</option>
                                <option>Laboratorio de Cómputo 2</option>
                                <option>Laboratorio de Cómputo 5</option>
                            </select>
                        </div>

                        <!-- Componente -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-neutral-300" for="componente">Componente (opcional)</label>
                            <select id="componente" name="componente" class="campo-form-alumno w-full">
                                <option>Equipo completo</option>
                                <option>Memoria RAM</option>
                                <option>Disco duro / SSD</option>
                                <option>Procesador (CPU)</option>
                                <option>Tarjeta de video (GPU)</option>
                                <option>Fuente de poder</option>
                                <option>Placa madre</option>
                                <option>Monitor</option>
                                <option>Teclado / Mouse</option>
                            </select>
                        </div>

                        <div class="pt-4 border-t border-neutral-900/60">
                            <div class="grid grid-cols-2 gap-3">
                                <button type="submit" class="btn-alumno-primario w-full">
                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                    Exportar PDF
                                </button>
                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-2 px-4 rounded-lg transition-colors w-full">
                                    <i data-lucide="file-spreadsheet" class="w-4 h-4 mr-2"></i>
                                    Exportar Excel
                                </button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

        </main>

    </div>

    <!-- Pie de página -->
    <?php require_once __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
