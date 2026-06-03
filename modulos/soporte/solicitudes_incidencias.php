<?php
// Listado de incidencias que los docentes han reportado. Es 100% independiente.

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

            <?php encabezado('Sede Central · Reportes de Docentes', 'Solicitudes de Incidencias', 'Gestión y seguimiento de incidencias reportadas por docentes en los laboratorios.'); ?>

            <!-- Resumen de cifras -->
            <section class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Total de incidencias</span>
                    <p class="valor-stat">27</p>
                    <span class="etiqueta-mini etiqueta-mini-azul">Año académico 2026</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Incidencias críticas</span>
                    <p class="valor-stat">1</p>
                    <span class="etiqueta-mini etiqueta-mini-rojo">Requiere atención</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">En proceso</span>
                    <p class="valor-stat">1</p>
                    <span class="etiqueta-mini etiqueta-mini-cyan">Siendo atendidas</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Resueltas</span>
                    <p class="valor-stat">2</p>
                    <span class="etiqueta-mini etiqueta-mini-verde">Solucionadas</span>
                </div>

            </section>

            <!-- Filtros -->
            <section class="panel-cristal panel-tabla">

                <div class="cabecera-panel-tabla">
                    <div class="flex items-center gap-2">
                        <i data-lucide="filter" class="icono-azul"></i>
                        <h3 class="titulo-seccion">Filtros de Búsqueda</h3>
                    </div>

                </div>

                <div class="p-5 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div class="md:col-span-2 lg:col-span-2">
                        <input type="search" class="campo-form-alumno w-full" placeholder="Buscar por ID o docente...">
                    </div>
                    <div>
                        <select class="campo-form-alumno w-full">
                            <option value="">Todos los Laboratorios</option>
                            <option value="lab1">Lab. Cómputo 1</option>
                            <option value="lab2">Lab. Cómputo 2</option>
                            <option value="lab3">Lab. Cómputo 3</option>
                            <option value="lab4">Lab. Cómputo 4</option>
                            <option value="lab5">Lab. Cómputo 5</option>
                        </select>
                    </div>
                    <div>
                        <select class="campo-form-alumno w-full">
                            <option value="">Todos los Estados</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="proceso">En Proceso</option>
                            <option value="critico">Falla Crítica</option>
                            <option value="espera">Esperando Repuesto</option>
                            <option value="resuelto">Resuelto</option>
                        </select>
                    </div>
                </div>

            </section>

            <!-- Lista de datos -->
            <section class="panel-cristal panel-tabla">

                <div class="cabecera-panel-tabla">
                    <div class="flex items-center gap-2">
                        <i data-lucide="list" class="icono-azul"></i>
                        <h3 class="titulo-seccion">Lista de Incidencias</h3>
                    </div>

                    <div class="flex flex-wrap gap-1.5 self-stretch sm:self-auto justify-end">
                        <button type="button" class="btn-toolbar-activo">Todas</button>
                        <button type="button" class="btn-toolbar">Pendientes</button>
                        <button type="button" class="btn-toolbar">En Proceso</button>
                        <button type="button" class="btn-toolbar">Resueltas</button>
                    </div>
                </div>

                <!-- Datos en forma de lista -->
                <div class="tabla-moderna">

                    <div class="fila-moderna fila-cabecera fila-tabla-cabecera">
                        <div class="col-span-2">ID Incidencia</div>
                        <div class="col-span-3">Docente</div>
                        <div class="col-span-2">Equipo / Sistema</div>
                        <div class="col-span-1">Laboratorio</div>
                        <div class="col-span-1">Fecha</div>
                        <div class="col-span-2">Estado</div>
                        <div class="col-span-1 text-right">Acciones</div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            INC-1042
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Docente: </span>
                            Dr. Daniel Vásquez Pinedo
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Equipo: </span>
                            HP EliteDesk 800 G5
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Lab: </span>
                            Lab 2
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            17/05/2026
                        </div>
                        <div class="md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-rojo">
                                <span class="punto-estado punto-rojo"></span>
                                Falla Crítica
                            </span>
                        </div>
                        <div class="md:col-span-1 celda-derecha">
                            <a href="<?php echo $base; ?>modulos/docente/formulario_soporte.php" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            INC-1041
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Docente: </span>
                            Mg. Patricia Saldaña León
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Equipo: </span>
                            Dell OptiPlex 7080
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Lab: </span>
                            Lab 1
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            17/05/2026
                        </div>
                        <div class="md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-cyan">
                                <span class="punto-estado punto-cyan"></span>
                                En Proceso
                            </span>
                        </div>
                        <div class="md:col-span-1 celda-derecha">
                            <a href="<?php echo $base; ?>modulos/docente/formulario_soporte.php" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            INC-1040
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Docente: </span>
                            Ing. Roberto Salinas Cruz
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Equipo: </span>
                            Lenovo IdeaCentre 3
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Lab: </span>
                            Lab 5
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            16/05/2026
                        </div>
                        <div class="md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-neutral">
                                <span class="punto-estado punto-neutral"></span>
                                Pendiente
                            </span>
                        </div>
                        <div class="md:col-span-1 celda-derecha">
                            <a href="<?php echo $base; ?>modulos/docente/formulario_soporte.php" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            INC-1039
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Docente: </span>
                            Dra. Carmen Vega Aliaga
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Equipo: </span>
                            HP ProDesk 600 G6
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Lab: </span>
                            Lab 1
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            16/05/2026
                        </div>
                        <div class="md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-verde">
                                <span class="punto-estado punto-verde"></span>
                                Resuelto
                            </span>
                        </div>
                        <div class="md:col-span-1 celda-derecha">
                            <a href="<?php echo $base; ?>modulos/docente/formulario_soporte.php" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            INC-1038
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Docente: </span>
                            Mg. Eduardo Ramos Cárdenas
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Equipo: </span>
                            Lenovo ThinkCentre M70q
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Lab: </span>
                            Lab 2
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            15/05/2026
                        </div>
                        <div class="md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-ambar">
                                <span class="punto-estado punto-ambar"></span>
                                Esperando Repuesto
                            </span>
                        </div>
                        <div class="md:col-span-1 celda-derecha">
                            <a href="<?php echo $base; ?>modulos/docente/formulario_soporte.php" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla border-b-0">
                        <div class="md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            INC-1037
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Docente: </span>
                            Ing. Lucía Bermúdez Acosta
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Equipo: </span>
                            Proyector Epson EB-X06
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Lab: </span>
                            Lab 3
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            15/05/2026
                        </div>
                        <div class="md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-verde">
                                <span class="punto-estado punto-verde"></span>
                                Resuelto
                            </span>
                        </div>
                        <div class="md:col-span-1 celda-derecha">
                            <a href="<?php echo $base; ?>modulos/docente/formulario_soporte.php" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Paginación al final -->
                <div class="p-5 border-t border-neutral-900/80 bg-neutral-950/20 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs">
                    <p class="text-neutral-500 font-semibold">Mostrando 1 a 6 de 27 incidencias</p>

                    <div class="flex items-center gap-2">
                        <a href="#" class="px-3 py-2 rounded-lg bg-neutral-900 text-neutral-400 hover:text-white transition-all font-mono">‹</a>
                        <a href="#" class="px-3.5 py-2 rounded-lg bg-[#7da2ce] text-black font-semibold transition-all select-none">1</a>
                        <a href="#" class="px-3.5 py-2 rounded-lg bg-neutral-900 text-neutral-400 hover:text-white transition-all">2</a>
                        <a href="#" class="px-3.5 py-2 rounded-lg bg-neutral-900 text-neutral-400 hover:text-white transition-all">3</a>
                        <a href="#" class="px-3 py-2 rounded-lg bg-neutral-900 text-neutral-400 hover:text-white transition-all font-mono">›</a>
                    </div>
                </div>

            </section>

        </main>

    </div>

    <!-- Pie de página -->
    <?php require_once __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
