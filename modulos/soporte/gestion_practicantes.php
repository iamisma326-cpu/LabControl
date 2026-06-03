<?php
// Listado de practicantes con opción de activarlos/desactivarlos. Es 100% independiente.

require_once __DIR__ . '/../../data/practicantes_sim.php';
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

$practicantes = sim_practicantes();
sim_iniciar_sesion('jefe_soporte');
$usuario = sim_usuario_actual();
$nombre_jefe_soporte = $usuario['nombre'];
$iniciales = $usuario['iniciales'];

if (isset($_POST['accion'])) { $accion = $_POST['accion']; } else { $accion = ''; }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion == 'toggle_practicante') {
    if (isset($_POST['id']))     { $id_post = (int)$_POST['id']; }         else { $id_post = 0; }
    if (isset($_POST['activo'])) { $activo_post = (int)$_POST['activo']; } else { $activo_post = 0; }

    sim_toggle_practicante($id_post, $activo_post);
    flash_set('ok', 'Estado del practicante actualizado.');
    header('Location: gestion_practicantes.php');
    exit;
}

// Contamos activos e inactivos para las tarjetas de resumen.
$total_practicantes = count($practicantes);
$activos = 0;
$inactivos = 0;
foreach ($practicantes as $p) {
    if (!empty($p['activo'])) {
        $activos = $activos + 1;
    } else {
        $inactivos = $inactivos + 1;
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
                <a href="dashboard_jefe_soporte.php" class="nav-lateral <?php if ($pagina_actual == 'dashboard_jefe_soporte.php') { echo 'activo'; } ?>">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>
                <a href="asistencia_facial.php" class="nav-lateral <?php if ($pagina_actual == 'asistencia_facial.php') { echo 'activo'; } ?>">
                    <i data-lucide="camera" class="w-4 h-4"></i>
                    <span>Tomar Asistencia</span>
                </a>
                <a href="gestion_practicantes.php" class="nav-lateral <?php if ($pagina_actual == 'gestion_practicantes.php') { echo 'activo'; } ?>">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <span>Gestión de Practicantes</span>
                </a>
                <a href="gestion_asistencias.php" class="nav-lateral <?php if ($pagina_actual == 'gestion_asistencias.php') { echo 'activo'; } ?>">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <span>Gestión de Asistencias</span>
                </a>
                <a href="solicitudes_reservas.php" class="nav-lateral <?php if ($pagina_actual == 'solicitudes_reservas.php') { echo 'activo'; } ?>">
                    <i data-lucide="laptop" class="w-4 h-4"></i>
                    <span>Solicitudes de Reservas</span>
                </a>
                <a href="solicitudes_incidencias.php" class="nav-lateral <?php if ($pagina_actual == 'solicitudes_incidencias.php') { echo 'activo'; } ?>">
                    <i data-lucide="wrench" class="w-4 h-4"></i>
                    <span>Solicitudes de Incidencias</span>
                </a>
                <a href="gestion_laboratorios.php" class="nav-lateral <?php if ($pagina_actual == 'gestion_laboratorios.php') { echo 'activo'; } ?>">
                    <i data-lucide="database" class="w-4 h-4"></i>
                    <span>Inventario</span>
                </a>
                <a href="reportes_excel.php" class="nav-lateral <?php if ($pagina_actual == 'reportes_excel.php') { echo 'activo'; } ?>">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    <span>Reportes</span>
                </a>
                <a href="configuracion.php" class="nav-lateral <?php if ($pagina_actual == 'configuracion.php') { echo 'activo'; } ?>">
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

            <?php
                $descripcion_practicantes = 'Total: ' . $total_practicantes . ' · Activos: ' . $activos;
                encabezado('Sede Central · Practicantes', 'Gestión de Practicantes', $descripcion_practicantes);
            ?>

            <!-- Resumen de cifras -->
            <section class="grid grid-cols-2 lg:grid-cols-3 gap-4">

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Total de practicantes</span>
                    <p class="valor-stat"><?php echo $total_practicantes; ?></p>
                    <span class="etiqueta-mini etiqueta-mini-azul">Registro completo</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Practicantes activos</span>
                    <p class="valor-stat"><?php echo $activos; ?></p>
                    <span class="etiqueta-mini etiqueta-mini-verde">Disponibles</span>
                </div>

                <div class="panel-cristal tarjeta-stat">
                    <span class="kicker-gris">Practicantes inactivos</span>
                    <p class="valor-stat"><?php echo $inactivos; ?></p>
                    <span class="etiqueta-mini etiqueta-mini-ambar">Suspendidos</span>
                </div>

            </section>

            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div></div>
                <div>
                    <a href="nuevo_practicante.php" class="btn-alumno-primario">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                        <span>+ Nuevo Practicante</span>
                    </a>
                </div>
            </div>

            <?php echo flash_render(); ?>

            <!-- Lista de practicantes -->
            <section class="panel-cristal panel-tabla">

                <div class="cabecera-panel-tabla">
                    <div class="flex items-center gap-2">
                        <i data-lucide="users" class="icono-azul"></i>
                        <h3 class="titulo-seccion">Lista de Practicantes</h3>
                    </div>
                </div>

                <!-- Lista de practicantes -->
                <div class="tabla-moderna">

                    <div class="fila-moderna fila-cabecera fila-tabla-cabecera">
                        <div class="col-span-3">Nombre Completo</div>
                        <div class="col-span-3">DNI</div>
                        <div class="col-span-3">Horario</div>
                        <div class="col-span-1">Estado</div>
                        <div class="col-span-2 text-right">Acciones</div>
                    </div>

                    <?php if (empty($practicantes)): ?>
                    <div class="p-8 text-center text-neutral-400">
                        <p class="mb-4">Sin practicantes registrados.</p>
                        <a href="nuevo_practicante.php" class="btn-alumno-primario">
                            <i data-lucide="plus-circle" class="w-4 h-4"></i>
                            <span>+ Registrar el primero</span>
                        </a>
                    </div>
                    <?php else: foreach ($practicantes as $p): ?>
                    <div class="fila-moderna fila-tabla" data-id="<?php echo (int)$p['id']; ?>">
                        <div class="col-span-2 md:col-span-3 celda-cabecera pr-2">
                            <span class="etiqueta-celda-movil">Nombre: </span>
                            <?php echo $p['apellidos']; ?>, <?php echo $p['nombres']; ?>
                        </div>
                        <div class="md:col-span-3 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil-sm">DNI: </span>
                            <?php echo $p['dni']; ?>
                        </div>
                        <div class="md:col-span-3 celda-tabla celda-mono">
                            <span class="etiqueta-celda-movil-sm">Horario: </span>
                            <?php
                                if (isset($p['horario_entrada'])) {
                                    echo substr($p['horario_entrada'], 0, 5);
                                } else {
                                    echo '--:--';
                                }
                            ?> &mdash; <?php
                                if (isset($p['horario_salida'])) {
                                    echo substr($p['horario_salida'], 0, 5);
                                } else {
                                    echo '--:--';
                                }
                            ?>
                        </div>
                        <div class="md:col-span-1 flex items-center">
                            <span class="etiqueta-celda-movil-sm">Estado: </span>
                            <?php if (!empty($p['activo'])): ?>
                            <span class="celda-estado inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-emerald-500/10 text-sm text-emerald-400 border border-emerald-500/20">
                                <span class="punto-estado punto-verde"></span>
                                Activo
                            </span>
                            <?php else: ?>
                            <span class="celda-estado inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-neutral-800/40 text-sm text-neutral-300 border border-neutral-700/20">
                                <span class="punto-estado punto-neutral"></span>
                                Inactivo
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="md:col-span-2 celda-derecha gap-2">
                            <a href="editar_practicante.php?id=<?php echo (int)$p['id']; ?>" class="text-[#7da2ce] hover:text-white flex items-center gap-1 font-medium font-mono uppercase tracking-wider text-sm">
                                <i data-lucide="edit" class="w-4 h-4"></i>
                            </a>
                            <form method="POST" action="gestion_practicantes.php" class="inline">
                                <input type="hidden" name="accion" value="toggle_practicante">
                                <input type="hidden" name="id" value="<?php echo (int)$p['id']; ?>">
                                <?php
                                    if (!empty($p['activo'])) {
                                        $nuevo_estado = 0;
                                    } else {
                                        $nuevo_estado = 1;
                                    }
                                ?>
                                <input type="hidden" name="activo" value="<?php echo $nuevo_estado; ?>">
                                <?php
                                    if (!empty($p['activo'])) {
                                        $btn_color = 'text-amber-400';
                                        $btn_icon  = 'pause-circle';
                                    } else {
                                        $btn_color = 'text-emerald-400';
                                        $btn_icon  = 'play-circle';
                                    }
                                ?>
                                <button type="submit" class="<?php echo $btn_color; ?> hover:text-white flex items-center gap-1 font-medium font-mono uppercase tracking-wider text-sm">
                                    <i data-lucide="<?php echo $btn_icon; ?>" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>

                </div>

            </section>

        </main>

    </div>

    <!-- Pie de página -->
    <?php require_once __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
