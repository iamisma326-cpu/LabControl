<?php
// Inventario de equipos con sus estados y opción de activarlos/desactivarlos. Es 100% independiente.

require_once __DIR__ . '/../../data/equipos_sim.php';
require_once __DIR__ . '/../../data/usuario_sim.php';

// Guarda un mensaje (de éxito o de error) para mostrarlo en la página.
function flash_set($tipo, $msg)
{
    $_SESSION['flash'] = ['tipo' => $tipo, 'msg' => $msg];
}

// Devuelve el HTML del mensaje guardado (y lo borra para que no se repita).
function flash_render()
{
    if (!isset($_SESSION['flash'])) {
        return '';
    }
    $f = $_SESSION['flash'];
    unset($_SESSION['flash']);

    if ($f['tipo'] == 'ok') {
        $color = '#2e7d32';
        $icon  = 'check-circle';
    } else {
        $color = '#c62828';
        $icon  = 'alert-circle';
    }
    $msg = $f['msg'];

    return '<div class="panel-cristal p-4 mb-4 flex items-center gap-2" '
         . 'style="border-color:' . $color . ';">'
         . '<i data-lucide="' . $icon . '" class="w-5 h-5 flex-shrink-0" style="color:' . $color . ';"></i>'
         . '<span class="text-sm font-medium">' . $msg . '</span>'
         . '</div>';
}

sim_iniciar_sesion('jefe_soporte');
$usuario = sim_usuario_actual();
$nombre_jefe_soporte = $usuario['nombre'];
$iniciales = $usuario['iniciales'];

if (isset($_POST['accion'])) { $accion = $_POST['accion']; } else { $accion = ''; }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion == 'toggle_equipo') {
    if (isset($_POST['id']))     { $id_post = (int)$_POST['id']; }         else { $id_post = 0; }
    if (isset($_POST['activo'])) { $activo_post = (int)$_POST['activo']; } else { $activo_post = 0; }

    sim_toggle_equipo($id_post, $activo_post);
    flash_set('ok', 'Estado del equipo actualizado.');
    header('Location: gestion_laboratorios.php');
    exit;
}

$equipos  = sim_equipos();
$conteo   = sim_contar_por_estado();

$laboratorios = [
    'lab1' => 'Lab. Cómputo 1',
    'lab2' => 'Lab. Cómputo 2',
    'lab5' => 'Lab. Cómputo 5',
];

$estado_label = [
    'operativo'     => 'Operativo',
    'mantenimiento' => 'En Mantenimiento',
    'danado'        => 'Dañado',
];
$estado_badge = [
    'operativo'     => 'badge-verde',
    'mantenimiento' => 'badge-neutral',
    'danado'        => 'badge-rojo',
];
$estado_punto = [
    'operativo'     => 'punto-verde',
    'mantenimiento' => 'punto-neutral',
    'danado'        => 'punto-rojo',
];

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

            <?php encabezado('Sede Central · Laboratorios', 'Gestión de Inventario', 'Registro y control de equipos de cómputo en los laboratorios.'); ?>

            <!-- Resumen de cifras -->
            <section class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Total de equipos</span>
                    <p class="valor-stat"><?php echo (int)$conteo['total']; ?></p>
                    <span class="etiqueta-mini etiqueta-mini-azul">Inventario completo</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Equipos operativos</span>
                    <p class="valor-stat"><?php echo (int)$conteo['operativo']; ?></p>
                    <span class="etiqueta-mini etiqueta-mini-verde">
                        <?php
                        if ($conteo['total'] > 0) { $porc_operativo = round(($conteo['operativo'] / $conteo['total']) * 100); } else { $porc_operativo = 0; }
                        echo $porc_operativo;
                        ?>% disponibilidad
                    </span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">En mantenimiento</span>
                    <p class="valor-stat"><?php echo (int)$conteo['mantenimiento']; ?></p>
                    <span class="etiqueta-mini etiqueta-mini-ambar">
                        <?php
                        if ($conteo['total'] > 0) { $porc_mantenimiento = round(($conteo['mantenimiento'] / $conteo['total']) * 100); } else { $porc_mantenimiento = 0; }
                        echo $porc_mantenimiento;
                        ?>% en revisión
                    </span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Equipos dañados</span>
                    <p class="valor-stat"><?php echo (int)$conteo['danado']; ?></p>
                    <span class="etiqueta-mini etiqueta-mini-rojo">
                        <?php
                        if ($conteo['total'] > 0) { $porc_danado = round(($conteo['danado'] / $conteo['total']) * 100); } else { $porc_danado = 0; }
                        echo $porc_danado;
                        ?>% fuera de servicio
                    </span>
                </div>

            </section>

            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div></div>
                <div class="flex gap-3">
                    <a href="registrar_equipo.php" class="btn-alumno-primario">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                        <span>+ Registrar Equipo</span>
                    </a>
                </div>
            </div>

            <?php echo flash_render(); ?>

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
                        <input type="search" class="campo-form-alumno w-full" placeholder="Buscar por ID, nombre o IP...">
                    </div>
                    <div>
                        <select class="campo-form-alumno w-full">
                            <option value="">Todos los Laboratorios</option>
                            <?php foreach ($laboratorios as $key => $label): ?>
                                <option value="<?php echo $key; ?>"><?php echo $label; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <select class="campo-form-alumno w-full">
                            <option value="">Todos los Estados</option>
                            <?php foreach ($estado_label as $key => $label): ?>
                                <option value="<?php echo $key; ?>"><?php echo $label; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

            </section>

            <!-- Lista de datos -->
            <section class="panel-cristal panel-tabla">

                <div class="cabecera-panel-tabla">
                    <div class="flex items-center gap-2">
                        <i data-lucide="list" class="icono-azul"></i>
                        <h3 class="titulo-seccion">Inventario de Equipos</h3>
                    </div>

                    <div class="flex flex-wrap gap-1.5 self-stretch sm:self-auto justify-end">
                        <button type="button" class="btn-toolbar-activo">Todos</button>
                        <button type="button" class="btn-toolbar">Operativos</button>
                        <button type="button" class="btn-toolbar">En Mantenimiento</button>
                        <button type="button" class="btn-toolbar">Dañados</button>
                    </div>
                </div>

                <!-- Datos en forma de lista -->
                <div class="tabla-moderna">

                    <div class="fila-moderna fila-cabecera fila-tabla-cabecera">
                        <div class="col-span-2">ID Equipo</div>
                        <div class="col-span-3">Nombre / Modelo</div>
                        <div class="col-span-2">Laboratorio</div>
                        <div class="col-span-3">Estado</div>
                        <div class="col-span-2 text-right">Acciones</div>
                    </div>

                    <?php if (empty($equipos)): ?>
                    <div class="p-8 text-center text-neutral-400">
                        <p class="mb-4">Sin equipos registrados en el inventario.</p>
                        <a href="registrar_equipo.php" class="btn-alumno-primario">
                            <i data-lucide="plus-circle" class="w-4 h-4"></i>
                            <span>+ Registrar el primero</span>
                        </a>
                    </div>
                    <?php else: foreach ($equipos as $e):
                        if (isset($estado_badge[$e['estado']])) { $badge = $estado_badge[$e['estado']]; } else { $badge = 'badge-neutral'; }
                        if (isset($estado_punto[$e['estado']])) { $punto = $estado_punto[$e['estado']]; } else { $punto = 'punto-neutral'; }
                        if (isset($laboratorios[$e['laboratorio']])) { $lab = $laboratorios[$e['laboratorio']]; } else { $lab = $e['laboratorio']; }
                        if (isset($estado_label[$e['estado']])) { $label = $estado_label[$e['estado']]; } else { $label = $e['estado']; }
                    ?>
                    <div class="fila-moderna fila-tabla" data-id="<?php echo (int)$e['id']; ?>">
                        <div class="md:col-span-2 font-mono text-[#7da2ce] font-semibold flex items-center">
                            <span class="etiqueta-celda-movil">ID: </span>
                            #<?php echo $e['codigo']; ?>
                        </div>
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Modelo: </span>
                            <?php echo $e['nombre']; ?>
                        </div>
                        <div class="md:col-span-2 celda-tabla">
                            <span class="etiqueta-celda-movil">Laboratorio: </span>
                            <?php echo $lab; ?>
                        </div>
                        <div class="md:col-span-3 flex items-center">
                            <span class="etiqueta-celda-movil">Estado: </span>
                            <span class="badge-estado <?php echo $badge; ?>">
                                <span class="punto-estado <?php echo $punto; ?>"></span>
                                <?php echo $label; ?>
                            </span>
                        </div>
                        <div class="col-span-2 md:col-span-2 text-right flex items-center justify-end gap-2">
                            <a href="editar_equipo.php?id=<?php echo (int)$e['id']; ?>" class="enlace-accion">
                                <i data-lucide="edit-2" class="w-4 h-4"></i>
                            </a>
                            <form method="POST" action="gestion_laboratorios.php" class="inline">
                                <input type="hidden" name="accion" value="toggle_equipo">
                                <input type="hidden" name="id" value="<?php echo (int)$e['id']; ?>">
                                <input type="hidden" name="activo" value="<?php
                                if ($e['activo']) { echo 0; } else { echo 1; }
                                ?>">
                                <button type="submit" class="enlace-accion <?php
                                if ($e['activo']) { echo 'text-amber-400'; } else { echo 'text-emerald-400'; }
                                ?>">
                                    <i data-lucide="<?php
                                    if ($e['activo']) { echo 'pause-circle'; } else { echo 'play-circle'; }
                                    ?>" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>

                </div>

                <?php if (!empty($equipos)): ?>
                <div class="p-5 border-t border-neutral-900/80 bg-neutral-950/20 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs">
                    <p class="text-neutral-500 font-semibold">Mostrando <?php echo count($equipos); ?> de <?php echo count($equipos); ?> equipos</p>
                </div>
                <?php endif; ?>

            </section>

        </main>

    </div>

    <!-- Pie de página -->
    <?php require_once __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
