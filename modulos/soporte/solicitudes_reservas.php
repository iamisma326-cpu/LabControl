<?php
// Listado de reservas de laptops que han hecho alumnos y docentes. Es 100% independiente.

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

            <?php encabezado('Sede Central · Reservas de Alumnos', 'Solicitudes de Reservas de Laptops', 'Gestión y seguimiento de reservas de laptops solicitadas por alumnos.'); ?>

            <!-- Resumen de cifras -->
            <section class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Total de reservas</span>
                    <p class="valor-stat">38</p>
                    <span class="etiqueta-mini etiqueta-mini-azul">Año académico 2026</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Reservas pendientes</span>
                    <p class="valor-stat">1</p>
                    <span class="etiqueta-mini etiqueta-mini-ambar">Requieren aprobación</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">En uso actualmente</span>
                    <p class="valor-stat">1</p>
                    <span class="etiqueta-mini etiqueta-mini-cyan">Activas</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Devueltas a tiempo</span>
                    <p class="valor-stat">2</p>
                    <span class="etiqueta-mini etiqueta-mini-verde">Cumplimiento 95%</span>
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
                        <input type="search" class="campo-form-alumno w-full" placeholder="Buscar por código o alumno...">
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
                            <option value="aprobada">Aprobada</option>
                            <option value="en-uso">En Uso</option>
                            <option value="devuelta">Devuelta</option>
                            <option value="rechazada">Rechazada</option>
                        </select>
                    </div>
                </div>

            </section>

            <!-- Lista de datos -->
            <section class="panel-cristal panel-tabla">

                <div class="cabecera-panel-tabla">
                    <div class="flex items-center gap-2">
                        <i data-lucide="list" class="icono-azul"></i>
                        <h3 class="titulo-seccion">Lista de Reservas</h3>
                    </div>

                    <div class="flex flex-wrap gap-1.5 self-stretch sm:self-auto justify-end">
                        <button type="button" class="btn-toolbar-activo">Todas</button>
                        <button type="button" class="btn-toolbar">Pendientes</button>
                        <button type="button" class="btn-toolbar">Aprobadas</button>
                        <button type="button" class="btn-toolbar">En Uso</button>
                        <button type="button" class="btn-toolbar">Devueltas</button>
                    </div>
                </div>

                <!-- Datos en forma de lista -->
                <div class="tabla-moderna">

                    <div class="fila-moderna fila-cabecera fila-tabla-cabecera">
                        <div class="col-span-3">Alumno</div>
                        <div class="col-span-2">Laptop</div>
                        <div class="col-span-2">Laboratorio</div>
                        <div class="col-span-1">Fecha</div>
                        <div class="col-span-1">Hora</div>
                        <div class="col-span-1">Estado</div>
                        <div class="col-span-2 text-right">Acciones</div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Alumno: </span>
                            Ana María Quispe Salas
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            HP EliteBook 840 G8
                        </div>
                        <div class="md:col-span-2 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Lab: </span>
                            Lab 2
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            17/05/2026
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Hora: </span>
                            09:00
                        </div>
                        <div class="md:col-span-1 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-neutral">
                                <span class="punto-estado punto-neutral"></span>
                                Pendiente
                            </span>
                        </div>
                        <div class="md:col-span-2 celda-derecha">
                            <a href="<?php echo $base; ?>modulos/alumno/confirmacion_reserva.php" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Alumno: </span>
                            Diego Fernández Romero
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            Dell Latitude 5420
                        </div>
                        <div class="md:col-span-2 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Lab: </span>
                            Lab 1
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            17/05/2026
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Hora: </span>
                            10:30
                        </div>
                        <div class="md:col-span-1 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-cyan">
                                <span class="punto-estado punto-cyan"></span>
                                Aprobada
                            </span>
                        </div>
                        <div class="md:col-span-2 celda-derecha">
                            <a href="<?php echo $base; ?>modulos/alumno/confirmacion_reserva.php" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Alumno: </span>
                            Lucía Vargas Huamán
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            Lenovo ThinkPad T14
                        </div>
                        <div class="md:col-span-2 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Lab: </span>
                            Lab 3
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            16/05/2026
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Hora: </span>
                            14:15
                        </div>
                        <div class="md:col-span-1 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-[#7da2ce]/10 text-[11px] text-[#7da2ce] border border-[#7da2ce]/20">
                                <span class="w-1.5 h-1.5 bg-[#7da2ce] rounded-full"></span>
                                En Uso
                            </span>
                        </div>
                        <div class="md:col-span-2 celda-derecha">
                            <a href="<?php echo $base; ?>modulos/alumno/confirmacion_reserva.php" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Alumno: </span>
                            Renzo Castillo Pérez
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            HP ProBook 450 G9
                        </div>
                        <div class="md:col-span-2 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Lab: </span>
                            Lab 5
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            16/05/2026
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Hora: </span>
                            11:00
                        </div>
                        <div class="md:col-span-1 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-verde">
                                <span class="punto-estado punto-verde"></span>
                                Devuelta
                            </span>
                        </div>
                        <div class="md:col-span-2 celda-derecha">
                            <a href="<?php echo $base; ?>modulos/alumno/confirmacion_reserva.php" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Alumno: </span>
                            Mariana Espinoza Rojas
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            Dell Inspiron 15
                        </div>
                        <div class="md:col-span-2 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Lab: </span>
                            Lab 4
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            16/05/2026
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Hora: </span>
                            08:45
                        </div>
                        <div class="md:col-span-1 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-rojo">
                                <span class="punto-estado punto-rojo"></span>
                                Rechazada
                            </span>
                        </div>
                        <div class="md:col-span-2 celda-derecha">
                            <a href="<?php echo $base; ?>modulos/alumno/confirmacion_reserva.php" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla border-b-0">
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Alumno: </span>
                            Sebastián Núñez Torres
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            Lenovo IdeaPad 5
                        </div>
                        <div class="md:col-span-2 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Lab: </span>
                            Lab 2
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            15/05/2026
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono pr-4">
                            <span class="etiqueta-celda-movil">Hora: </span>
                            16:20
                        </div>
                        <div class="md:col-span-1 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-verde">
                                <span class="punto-estado punto-verde"></span>
                                Devuelta
                            </span>
                        </div>
                        <div class="md:col-span-2 celda-derecha">
                            <a href="<?php echo $base; ?>modulos/alumno/confirmacion_reserva.php" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Paginación al final -->
                <div class="p-5 border-t border-neutral-900/80 bg-neutral-950/20 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs">
                    <p class="text-neutral-500 font-semibold">Mostrando 1 a 6 de 38 reservas</p>

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
