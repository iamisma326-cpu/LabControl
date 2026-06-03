<?php
// Listado histórico de asistencias con buscador y resumen. Es 100% independiente.

// Datos de ejemplo que se guardan mientras dure la sesión.
require_once __DIR__ . '/../../data/practicantes_sim.php';
require_once __DIR__ . '/../../data/usuario_sim.php';

sim_iniciar_sesion('jefe_soporte');
$usuario = sim_usuario_actual();
$nombre_jefe_soporte = $usuario['nombre'];
$iniciales = $usuario['iniciales'];

// Arma las filas juntando cada asistencia con su practicante y calculando horas y estado.
$filas_asistencia = [];
foreach (sim_asistencias() as $a) {
    $p = sim_practicante((int)$a['practicante_id']);
    if (!$p) {
        continue;
    }

    // Horas trabajadas (si hay entrada y salida).
    $horas = null;
    if (!empty($a['hora_entrada']) && !empty($a['hora_salida'])) {
        $seg = strtotime($a['hora_salida']) - strtotime($a['hora_entrada']);
        if ($seg > 0) {
            $horas = round($seg / 3600, 2);
        }
    }

    // Texto y color según el estado.
    if (isset($a['estado'])) {
        $estado = $a['estado'];
    } else {
        $estado = 'presente';
    }

    if ($estado == 'completa') {
        $estado_txt = 'Completa';        $badge_cls = 'badge-verde';   $punto_cls = 'punto-verde';
    } elseif ($estado == 'tardanza') {
        $estado_txt = 'Tardanza';        $badge_cls = 'badge-ambar';   $punto_cls = 'punto-ambar';
    } elseif ($estado == 'ausente') {
        $estado_txt = 'Ausente';         $badge_cls = 'badge-rojo';    $punto_cls = 'punto-rojo';
    } elseif ($estado == 'salida') {
        $estado_txt = 'Salida Anticipada'; $badge_cls = 'badge-neutral'; $punto_cls = 'punto-neutral';
    } else {
        $estado_txt = 'Presente';        $badge_cls = 'badge-cyan';    $punto_cls = 'punto-cyan';
    }

    // Horas de entrada y salida en formato corto (o un guion si no hay).
    if (!empty($a['hora_entrada'])) {
        $entrada_txt = substr($a['hora_entrada'], 0, 5);
    } else {
        $entrada_txt = '—';
    }
    if (!empty($a['hora_salida'])) {
        $salida_txt = substr($a['hora_salida'], 0, 5);
    } else {
        $salida_txt = '—';
    }
    if ($horas !== null) {
        $horas_txt = number_format($horas, 2) . ' h';
    } else {
        $horas_txt = '—';
    }

    $filas_asistencia[] = [
        'dni'        => $p['dni'],
        'nombre'     => $p['nombres'] . ' ' . $p['apellidos'],
        'fecha'      => $a['fecha'],
        'entrada'    => $entrada_txt,
        'salida'     => $salida_txt,
        'horas'      => $horas_txt,
        'estado'     => $estado,
        'estado_txt' => $estado_txt,
        'badge_cls'  => $badge_cls,
        'punto_cls'  => $punto_cls,
    ];
}

// Ordena las filas: primero las de fecha más reciente.
// (Ordenamiento simple por intercambio, comparando las fechas como texto.)
$n = count($filas_asistencia);
for ($i = 0; $i < $n - 1; $i++) {
    for ($j = 0; $j < $n - 1 - $i; $j++) {
        if ($filas_asistencia[$j]['fecha'] < $filas_asistencia[$j + 1]['fecha']) {
            $temp = $filas_asistencia[$j];
            $filas_asistencia[$j] = $filas_asistencia[$j + 1];
            $filas_asistencia[$j + 1] = $temp;
        }
    }
}

// Cifras del resumen (contamos recorriendo las filas).
$kpi_total      = count($filas_asistencia);
$kpi_completas  = 0;
$kpi_incidencia = 0;
$kpi_ausencias  = 0;
foreach ($filas_asistencia as $f) {
    if ($f['estado'] == 'completa') {
        $kpi_completas = $kpi_completas + 1;
    }
    if ($f['estado'] == 'tardanza' || $f['estado'] == 'salida') {
        $kpi_incidencia = $kpi_incidencia + 1;
    }
    if ($f['estado'] == 'ausente') {
        $kpi_ausencias = $kpi_ausencias + 1;
    }
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

            <?php encabezado('Sede Central · Practicantes', 'Gestión de Asistencias', 'Registro y seguimiento de asistencias de practicantes de soporte técnico.'); ?>

            <!-- Resumen de cifras -->
            <section class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Total de registros</span>
                    <p class="valor-stat"><?php echo $kpi_total; ?></p>
                    <span class="etiqueta-mini etiqueta-mini-azul">Histórico completo</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Asistencias completas</span>
                    <p class="valor-stat"><?php echo $kpi_completas; ?></p>
                    <span class="etiqueta-mini etiqueta-mini-verde"><?php if ($kpi_total) { echo round($kpi_completas * 100 / $kpi_total); } else { echo 0; } ?>% cumplimiento</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Incidencias</span>
                    <p class="valor-stat"><?php echo $kpi_incidencia; ?></p>
                    <span class="etiqueta-mini etiqueta-mini-ambar">Con observaciones</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Ausencias</span>
                    <p class="valor-stat"><?php echo $kpi_ausencias; ?></p>
                    <span class="etiqueta-mini etiqueta-mini-rojo">Faltas</span>
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
                        <input type="search" class="campo-form-alumno w-full" placeholder="Buscar por DNI o nombre...">
                    </div>
                    <div>
                        <select class="campo-form-alumno w-full">
                            <option value="">Todos los Practicantes</option>
                            <?php foreach (sim_practicantes() as $pf): ?>
                            <option value="<?php echo (int)$pf['id']; ?>">
                                <?php echo $pf['nombres'] . ' ' . $pf['apellidos']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <select class="campo-form-alumno w-full">
                            <option value="">Todos los Estados</option>
                            <option value="presente">Presente</option>
                            <option value="tardanza">Tardanza</option>
                            <option value="ausente">Ausente</option>
                            <option value="salida-ant">Salida Anticipada</option>
                        </select>
                    </div>
                </div>

            </section>

            <!-- Lista de datos -->
            <section class="panel-cristal panel-tabla">

                <div class="cabecera-panel-tabla">
                    <div class="flex items-center gap-2">
                        <i data-lucide="list" class="icono-azul"></i>
                        <h3 class="titulo-seccion">Registro de Asistencias</h3>
                    </div>

                    <div class="flex flex-wrap gap-1.5 self-stretch sm:self-auto justify-end">
                        <button type="button" class="btn-toolbar-activo">Todas</button>
                        <button type="button" class="btn-toolbar">Presentes</button>
                        <button type="button" class="btn-toolbar">Con incidencias</button>
                        <button type="button" class="btn-toolbar">Ausentes</button>
                    </div>
                </div>

                <!-- Datos en forma de lista -->
                <div class="tabla-moderna">

                    <div class="fila-moderna fila-cabecera fila-tabla-cabecera">
                        <div class="col-span-2">DNI</div>
                        <div class="col-span-3">Practicante</div>
                        <div class="col-span-1">Fecha</div>
                        <div class="col-span-1">Entrada</div>
                        <div class="col-span-1">Salida</div>
                        <div class="col-span-1">Horas</div>
                        <div class="col-span-2">Estado</div>
                        <div class="col-span-1 text-right">Acciones</div>
                    </div>

                    <!-- Filas de asistencia (datos de ejemplo) -->
                    <?php if (empty($filas_asistencia)): ?>
                    <div class="p-8 text-center text-neutral-400">Sin registros de asistencia.</div>
                    <?php else: foreach ($filas_asistencia as $f): ?>
                    <div class="fila-moderna grid grid-cols-2 md:grid-cols-12 gap-4 text-sm font-sans">
                        <div class="md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">DNI: </span>
                            <?php echo $f['dni']; ?>
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Practicante: </span>
                            <?php echo $f['nombre']; ?>
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Fecha: </span>
                            <?php echo date('d/m/Y', strtotime($f['fecha'])); ?>
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Entrada: </span>
                            <?php echo $f['entrada']; ?>
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Salida: </span>
                            <?php echo $f['salida']; ?>
                        </div>
                        <div class="md:col-span-1 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil">Horas: </span>
                            <?php echo $f['horas']; ?>
                        </div>
                        <div class="md:col-span-2 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado <?php echo $f['badge_cls']; ?>">
                                <span class="punto-estado <?php echo $f['punto_cls']; ?>"></span>
                                <?php echo $f['estado_txt']; ?>
                            </span>
                        </div>
                        <div class="md:col-span-1 celda-derecha">
                            <a href="asistencia_facial.php" class="enlace-accion">
                                <span>Detalle</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>

                </div>

                <!-- Paginación al final -->
                <div class="p-5 border-t border-neutral-900/80 bg-neutral-950/20 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs">
                    <p class="text-neutral-500 font-semibold">Mostrando <?php if ($kpi_total) { echo 1; } else { echo 0; } ?> a <?php echo $kpi_total; ?> de <?php echo $kpi_total; ?> registros</p>

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
