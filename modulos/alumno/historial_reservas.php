<?php
// Tabla con el historial de reservas del alumno. Es 100% independiente.

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

            <?php encabezado('Historial · Reservas', 'Mis Reservas', 'Consulta el estado de tus reservas de laptops del centro de cómputo.'); ?>

            <!-- Resumen de cifras -->
            <section class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Total de reservas</span>
                    <p class="valor-stat">24</p>
                    <span class="etiqueta-mini etiqueta-mini-azul">Año académico 2026</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Préstamos activos</span>
                    <p class="valor-stat">1</p>
                    <span class="etiqueta-mini etiqueta-mini-verde">En curso</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Devueltos a tiempo</span>
                    <p class="valor-stat">22</p>
                    <span class="etiqueta-mini etiqueta-mini-cyan">96% cumplimiento</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Devoluciones tardías</span>
                    <p class="valor-stat">1</p>
                    <span class="etiqueta-mini etiqueta-mini-ambar">1 retraso registrado</span>
                </div>

            </section>

            <!-- Lista de datos -->
            <section class="panel-cristal panel-tabla">

                <div class="cabecera-panel-tabla">
                    <div class="flex items-center gap-2">
                        <i data-lucide="list" class="icono-azul"></i>
                        <h3 class="titulo-seccion">Historial Completo</h3>
                    </div>

                    <!-- Filtros desplegables -->
                    <div class="flex flex-wrap gap-1.5 self-stretch sm:self-auto justify-end">
                        <button type="button" class="btn-toolbar-activo">Todas</button>
                        <button type="button" class="btn-toolbar">Activas</button>
                        <button type="button" class="btn-toolbar">Finalizadas</button>
                        <button type="button" class="btn-toolbar">Atrasadas</button>
                    </div>
                </div>

                <!-- Datos en forma de lista -->
                <div class="tabla-moderna">

                    <div class="fila-moderna fila-cabecera fila-tabla-cabecera">
                        <div class="col-span-2">ID Reserva</div>
                        <div class="col-span-3">Laptop</div>
                        <div class="col-span-2">Fecha</div>
                        <div class="col-span-2">Horario</div>
                        <div class="col-span-2">Estado</div>
                        <div class="col-span-1 text-right">Acción</div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="col-span-2 md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID Reserva: </span>
                            RES-0042
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            Dell Latitude 5420
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            17/05/2026
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Horario: </span>
                            10:00 - 12:00
                        </div>
                        <div class="col-span-2 md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-[#7da2ce]/10 text-[11px] text-[#7da2ce] border border-[#7da2ce]/20">
                                <span class="w-1.5 h-1.5 bg-[#7da2ce] rounded-full"></span>
                                En curso
                            </span>
                        </div>
                        <div class="col-span-2 md:col-span-1 celda-derecha">
                            <a href="confirmacion_reserva.php?id=RES-0042" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="col-span-2 md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            RES-0041
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            Lenovo ThinkPad T14
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            15/05/2026
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Horario: </span>
                            14:00 - 17:00
                        </div>
                        <div class="col-span-2 md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-verde">
                                <span class="punto-estado punto-verde"></span>
                                Devuelto
                            </span>
                        </div>
                        <div class="col-span-2 md:col-span-1 celda-derecha">
                            <a href="confirmacion_reserva.php?id=RES-0041" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="col-span-2 md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            RES-0040
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            HP ProBook 450 G9
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            12/05/2026
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Horario: </span>
                            09:00 - 11:00
                        </div>
                        <div class="col-span-2 md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-verde">
                                <span class="punto-estado punto-verde"></span>
                                Devuelto
                            </span>
                        </div>
                        <div class="col-span-2 md:col-span-1 celda-derecha">
                            <a href="confirmacion_reserva.php?id=RES-0040" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="col-span-2 md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            RES-0039
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            HP ProBook 450 G9
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            10/05/2026
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Horario: </span>
                            15:00 - 17:00
                        </div>
                        <div class="col-span-2 md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-verde">
                                <span class="punto-estado punto-verde"></span>
                                Devuelto
                            </span>
                        </div>
                        <div class="col-span-2 md:col-span-1 celda-derecha">
                            <a href="confirmacion_reserva.php?id=RES-0039" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="col-span-2 md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            RES-0038
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            MacBook Pro M2
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            08/05/2026
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Horario: </span>
                            10:00 - 13:00
                        </div>
                        <div class="col-span-2 md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-verde">
                                <span class="punto-estado punto-verde"></span>
                                Devuelto
                            </span>
                        </div>
                        <div class="col-span-2 md:col-span-1 celda-derecha">
                            <a href="confirmacion_reserva.php?id=RES-0038" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="col-span-2 md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            RES-0036
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            Lenovo ThinkPad T14
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            05/05/2026
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Horario: </span>
                            08:00 - 10:00
                        </div>
                        <div class="col-span-2 md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-ambar">
                                <span class="punto-estado punto-ambar"></span>
                                Devuelto con retraso
                            </span>
                        </div>
                        <div class="col-span-2 md:col-span-1 celda-derecha">
                            <a href="confirmacion_reserva.php?id=RES-0036" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla">
                        <div class="col-span-2 md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            RES-0035
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            MacBook Pro M2
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            02/05/2026
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Horario: </span>
                            14:00 - 18:00
                        </div>
                        <div class="col-span-2 md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-verde">
                                <span class="punto-estado punto-verde"></span>
                                Devuelto
                            </span>
                        </div>
                        <div class="col-span-2 md:col-span-1 celda-derecha">
                            <a href="confirmacion_reserva.php?id=RES-0035" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fila-moderna fila-tabla border-b-0">
                        <div class="col-span-2 md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            RES-0034
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Laptop: </span>
                            Dell Latitude 5420
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            28/04/2026
                        </div>
                        <div class="col-span-2 md:col-span-2 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Horario: </span>
                            10:00 - 12:00
                        </div>
                        <div class="col-span-2 md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado badge-rojo">
                                <span class="punto-estado punto-rojo"></span>
                                Cancelada
                            </span>
                        </div>
                        <div class="col-span-2 md:col-span-1 celda-derecha">
                            <a href="confirmacion_reserva.php?id=RES-0034" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Paginación al final -->
                <div class="p-5 border-t border-neutral-900/80 bg-neutral-950/20 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs">
                    <p class="text-neutral-500 font-semibold">Mostrando 8 de 24 reservas</p>

                    <div class="flex items-center gap-2">
                        <a href="#" class="px-3 py-2 rounded-lg bg-neutral-900 text-neutral-400 hover:text-white transition-all font-mono"><</a>
                        <a href="#" class="px-3.5 py-2 rounded-lg bg-[#7da2ce] text-black font-semibold transition-all select-none">1</a>
                        <a href="#" class="px-3.5 py-2 rounded-lg bg-neutral-900 text-neutral-400 hover:text-white transition-all">2</a>
                        <a href="#" class="px-3.5 py-2 rounded-lg bg-neutral-900 text-neutral-400 hover:text-white transition-all">3</a>
                        <a href="#" class="px-3 py-2 rounded-lg bg-neutral-900 text-neutral-400 hover:text-white transition-all font-mono">></a>
                    </div>
                </div>

            </section>

        </main>

    </div>

    <!-- Pie de página -->
    <?php include __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
