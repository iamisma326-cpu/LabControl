<?php
// Dashboard del jefe de soporte. Es 100% independiente, sin includes visuales.

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

            <?php encabezado('Visión General Operativa', 'Dashboard de Control', 'Estado de los laboratorios, incidencias pendientes y asistencia de practicantes de soporte técnico.'); ?>

            <!-- Resumen de cifras -->
            <section class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Incidencias Activas</span>
                    <p class="valor-stat">14</p>
                    <span class="etiqueta-mini etiqueta-mini-rojo">Crítico</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Laptops en reserva</span>
                    <p class="valor-stat">14</p>
                    <span class="etiqueta-mini etiqueta-mini-ambar">Alto</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Practicantes activos</span>
                    <p class="valor-stat">4</p>
                    <span class="etiqueta-mini etiqueta-mini-verde">Óptimo</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Laboratorios operativos</span>
                    <p class="valor-stat">5/5</p>
                    <span class="etiqueta-mini etiqueta-mini-cyan">100%</span>
                </div>

            </section>

            <!-- Lista de practicantes -->
            <section class="panel-cristal panel-tabla">

                <div class="cabecera-panel-tabla">
                    <div class="flex items-center gap-2">
                        <i data-lucide="users" class="icono-azul"></i>
                        <h3 class="titulo-seccion">Horas de Practicantes</h3>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="asistencia_facial.php" class="btn-mini-azul">
                            <i data-lucide="external-link" class="w-4 h-4 mr-1"></i>
                            Ver Reporte Completo
                        </a>
                    </div>
                </div>

                <!-- Lista de practicantes -->
                <div class="tabla-moderna">

                    <div class="fila-moderna fila-cabecera fila-tabla-cabecera">
                        <div class="col-span-2">Practicante</div>
                        <div class="col-span-2">Rol</div>
                        <div class="col-span-2">Horas Registradas</div>
                        <div class="col-span-2">Estado</div>
                        <div class="col-span-2">Asignación</div>
                        <div class="col-span-2 text-right">Acciones</div>
                    </div>

                    <div class="fila-moderna grid grid-cols-2 md:grid-cols-12 gap-4 text-sm font-sans">
                        <div class="md:col-span-2 font-semibold text-white flex items-center gap-2">
                            <span class="etiqueta-celda-movil">Practicante: </span>
                            <div class="w-8 h-8 rounded-full bg-[#7da2ce]/15 border border-neutral-800 flex items-center justify-center text-xs font-bold text-[#7da2ce]">JP</div>
                            Julio Pérez
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Rol: </span>
                            Soporte Técnico
                        </div>
                        <div class="md:col-span-2 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Horas: </span>
                            82 h
                        </div>
                        <div class="md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-verde">
                                <span class="punto-estado punto-verde"></span>
                                Activo
                            </span>
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Asignación: </span>
                            Lab. Cómputo 1-2
                        </div>
                        <div class="md:col-span-2 celda-derecha">
                            <a href="gestion_practicantes.php" class="enlace-accion">
                                <span>Gestionar</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="md:col-span-2 font-semibold text-white flex items-center gap-2">
                            <span class="etiqueta-celda-movil">Practicante: </span>
                            <div class="w-8 h-8 rounded-full bg-[#7da2ce]/15 border border-neutral-800 flex items-center justify-center text-xs font-bold text-[#7da2ce]">MR</div>
                            María Rojas
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Rol: </span>
                            Soporte Técnico
                        </div>
                        <div class="md:col-span-2 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Horas: </span>
                            76 h
                        </div>
                        <div class="md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-verde">
                                <span class="punto-estado punto-verde"></span>
                                Activo
                            </span>
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Asignación: </span>
                            Lab. Cómputo 3-4
                        </div>
                        <div class="md:col-span-2 celda-derecha">
                            <a href="gestion_practicantes.php" class="enlace-accion">
                                <span>Gestionar</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="md:col-span-2 font-semibold text-white flex items-center gap-2">
                            <span class="etiqueta-celda-movil">Practicante: </span>
                            <div class="w-8 h-8 rounded-full bg-[#7da2ce]/15 border border-neutral-800 flex items-center justify-center text-xs font-bold text-[#7da2ce]">AL</div>
                            Andrés López
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Rol: </span>
                            Soporte Técnico
                        </div>
                        <div class="md:col-span-2 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Horas: </span>
                            58 h
                        </div>
                        <div class="md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-verde">
                                <span class="punto-estado punto-verde"></span>
                                Activo
                            </span>
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Asignación: </span>
                            Lab. Cómputo 5
                        </div>
                        <div class="md:col-span-2 celda-derecha">
                            <a href="gestion_practicantes.php" class="enlace-accion">
                                <span>Gestionar</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla border-b-0">
                        <div class="md:col-span-2 font-semibold text-white flex items-center gap-2">
                            <span class="etiqueta-celda-movil">Practicante: </span>
                            <div class="w-8 h-8 rounded-full bg-[#7da2ce]/15 border border-neutral-800 flex items-center justify-center text-xs font-bold text-[#7da2ce]">VR</div>
                            Valeria Ruiz
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Rol: </span>
                            Soporte Técnico
                        </div>
                        <div class="md:col-span-2 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Horas: </span>
                            42 h
                        </div>
                        <div class="md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-ambar">
                                <span class="punto-estado punto-ambar"></span>
                                En capacitación
                            </span>
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Asignación: </span>
                            Todos los laboratorios
                        </div>
                        <div class="md:col-span-2 celda-derecha">
                            <a href="gestion_practicantes.php" class="enlace-accion">
                                <span>Gestionar</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </section>

            <!-- Solicitudes recientes -->
            <section class="panel-cristal panel-tabla">

                <div class="cabecera-panel-tabla">
                    <div class="flex items-center gap-2">
                        <i data-lucide="list" class="icono-azul"></i>
                        <h3 class="titulo-seccion">Solicitudes Recientes</h3>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="solicitudes_incidencias.php" class="btn-mini-azul">
                            <i data-lucide="external-link" class="w-4 h-4 mr-1"></i>
                            Ver todas
                        </a>
                    </div>
                </div>

                <!-- Lista de solicitudes -->
                <div class="tabla-moderna">

                    <div class="fila-moderna fila-cabecera fila-tabla-cabecera">
                        <div class="col-span-3">Solicitante</div>
                        <div class="col-span-3">Equipo / Sistema</div>
                        <div class="col-span-3">Asignado a</div>
                        <div class="col-span-2">Estado</div>
                        <div class="col-span-1 text-right pr-4">Acción</div>
                    </div>

                     <div class="fila-moderna grid grid-cols-2 md:grid-cols-12 gap-4 text-sm font-sans">
                         <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                             <span class="etiqueta-celda-movil">Solicitante: </span>
                             Lab. Cómputo 2
                         </div>
                         <div class="md:col-span-3 celda-tabla">
                             <span class="etiqueta-celda-movil">Equipo: </span>
                             HP EliteDesk 800 G5 · Disco dañado
                         </div>
                         <div class="md:col-span-3 celda-tabla celda-mono">
                             <span class="etiqueta-celda-movil">Asignado: </span>
                             Julio Pérez
                         </div>
                         <div class="md:col-span-2 flex items-center">
                             <span class="etiqueta-celda-movil">Estado: </span>
                             <span class="badge-estado badge-rojo">
                                 <span class="punto-estado punto-rojo"></span>
                                 Crítica
                             </span>
                         </div>
                         <div class="md:col-span-1 celda-derecha pr-4">
                             <a href="<?php echo $base; ?>modulos/docente/formulario_soporte.php" class="enlace-accion">
                                 <span>Detalle</span>
                                 <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                             </a>
                         </div>
                     </div>

                     <div class="fila-moderna fila-tabla">
                         <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                             <span class="etiqueta-celda-movil">Solicitante: </span>
                             Lab. Cómputo 1
                         </div>
                         <div class="md:col-span-3 celda-tabla">
                             <span class="etiqueta-celda-movil">Equipo: </span>
                             Dell OptiPlex 7080 · Falla de SO
                         </div>
                         <div class="md:col-span-3 celda-tabla celda-mono">
                             <span class="etiqueta-celda-movil">Asignado: </span>
                             Andrés López
                         </div>
                         <div class="md:col-span-2 flex items-center">
                             <span class="etiqueta-celda-movil">Estado: </span>
                             <span class="badge-estado badge-cyan">
                                 <span class="punto-estado punto-cyan"></span>
                                 En Proceso
                             </span>
                         </div>
                         <div class="md:col-span-1 celda-derecha pr-4">
                             <a href="<?php echo $base; ?>modulos/docente/formulario_soporte.php" class="enlace-accion">
                                 <span>Detalle</span>
                                 <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                             </a>
                         </div>
                     </div>

                     <div class="fila-moderna fila-tabla">
                         <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                             <span class="etiqueta-celda-movil">Solicitante: </span>
                             Lab. Cómputo 5
                         </div>
                         <div class="md:col-span-3 celda-tabla">
                             <span class="etiqueta-celda-movil">Equipo: </span>
                             Lenovo IdeaCentre 3 · Mantenimiento
                         </div>
                         <div class="md:col-span-3 celda-tabla celda-mono">
                             <span class="etiqueta-celda-movil">Asignado: </span>
                             María Rojas
                         </div>
                         <div class="md:col-span-2 flex items-center">
                             <span class="etiqueta-celda-movil">Estado: </span>
                             <span class="badge-estado badge-neutral">
                                 <span class="punto-estado punto-neutral"></span>
                                 Pendiente
                             </span>
                         </div>
                         <div class="md:col-span-1 celda-derecha pr-4">
                             <a href="<?php echo $base; ?>modulos/docente/formulario_soporte.php" class="enlace-accion">
                                 <span>Detalle</span>
                                 <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                             </a>
                         </div>
                     </div>

                     <div class="fila-moderna fila-tabla">
                         <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                             <span class="etiqueta-celda-movil">Solicitante: </span>
                             Lab. Cómputo 1
                         </div>
                         <div class="md:col-span-3 celda-tabla">
                             <span class="etiqueta-celda-movil">Equipo: </span>
                             HP ProDesk 600 G6 · Cambio de RAM
                         </div>
                         <div class="md:col-span-3 celda-tabla celda-mono">
                             <span class="etiqueta-celda-movil">Asignado: </span>
                             Valeria Ruiz
                         </div>
                         <div class="md:col-span-2 flex items-center">
                             <span class="etiqueta-celda-movil">Estado: </span>
                             <span class="badge-estado badge-verde">
                                 <span class="punto-estado punto-verde"></span>
                                 Resuelto
                             </span>
                         </div>
                         <div class="md:col-span-1 celda-derecha pr-4">
                             <a href="<?php echo $base; ?>modulos/docente/formulario_soporte.php" class="enlace-accion">
                                 <span>Detalle</span>
                                 <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                             </a>
                         </div>
                     </div>

                     <div class="fila-moderna fila-tabla border-b-0">
                         <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                             <span class="etiqueta-celda-movil">Solicitante: </span>
                             Lab. Cómputo 2
                         </div>
                         <div class="md:col-span-3 celda-tabla">
                             <span class="etiqueta-celda-movil">Equipo: </span>
                             Lenovo ThinkCentre M70q · Falla de RAM
                         </div>
                         <div class="md:col-span-3 celda-tabla celda-mono">
                             <span class="etiqueta-celda-movil">Asignado: </span>
                             Julio Pérez
                         </div>
                         <div class="md:col-span-2 flex items-center">
                             <span class="etiqueta-celda-movil">Estado: </span>
                             <span class="badge-estado badge-ambar">
                                 <span class="punto-estado punto-ambar"></span>
                                 Esperando repuesto
                             </span>
                         </div>
                         <div class="md:col-span-1 celda-derecha pr-4">
                             <a href="<?php echo $base; ?>modulos/docente/formulario_soporte.php" class="enlace-accion">
                                 <span>Detalle</span>
                                 <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                             </a>
                         </div>
                     </div>

                </div>

            </section>

        </main>

    </div>

    <!-- Pie de página -->
    <?php require_once __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
