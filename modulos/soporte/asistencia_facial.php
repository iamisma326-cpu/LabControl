<?php
// Pantalla para registrar la entrada o salida de los practicantes. Es 100% independiente.

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

sim_iniciar_sesion('jefe_soporte');
$usuario = sim_usuario_actual();
$nombre_jefe_soporte = $usuario['nombre'];
$iniciales = $usuario['iniciales'];

if (isset($_POST['accion'])) { $accion = $_POST['accion']; } else { $accion = ''; }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion == 'marcar_asistencia') {
    if (isset($_POST['practicante_id'])) {
        $practicante_id = (int)$_POST['practicante_id'];
    } else {
        $practicante_id = 0;
    }

    $resultado = sim_marcar_asistencia($practicante_id);

    if ($resultado['ok']) {
        $hora_corta = substr($resultado['hora'], 0, 5);
        flash_set('ok', 'Asistencia registrada (' . $resultado['accion'] . ') del practicante '
            . $resultado['practicante']['nombres'] . ' ' . $resultado['practicante']['apellidos']
            . ' a las ' . $hora_corta . '.');
    } else {
        flash_set('err', $resultado['error']);
    }
    header('Location: asistencia_facial.php');
    exit;
}

// Solo los practicantes activos.
$practicantes_activos = [];
foreach (sim_practicantes() as $p) {
    if (!empty($p['activo'])) {
        $practicantes_activos[] = $p;
    }
}

$historial = [];
foreach (sim_asistencias() as $a) {
    $p = sim_practicante((int)$a['practicante_id']);
    if (!$p) {
        continue;
    }
    $historial[] = [
        'fecha'              => $a['fecha'],
        'hora_entrada'       => $a['hora_entrada'],
        'hora_salida'        => $a['hora_salida'],
        'estado'             => $a['estado'],
        'nombres'            => $p['nombres'],
        'apellidos'          => $p['apellidos'],
        'codigo_practicante' => $p['codigo'],
    ];
}
usort($historial, function ($x, $y) {
    if (!empty($x['hora_salida'])) {
        $rx_fecha = $x['hora_salida'];
    } else {
        $rx_fecha = $x['hora_entrada'];
    }
    $rx = $x['fecha'] . ' ' . $rx_fecha;
    if (!empty($y['hora_salida'])) {
        $ry_fecha = $y['hora_salida'];
    } else {
        $ry_fecha = $y['hora_entrada'];
    }
    $ry = $y['fecha'] . ' ' . $ry_fecha;
    return strcmp($ry, $rx);
});
$historial = array_slice($historial, 0, 5);

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

            <section class="panel-cristal p-6">
                <h2 class="text-2xl font-semibold text-white">Control de Asistencia de Practicantes</h2>
                <p class="text-xs text-neutral-400 mt-2">Registro de entrada y salida de practicantes.</p>
            </section>

            <?php echo flash_render(); ?>

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
                <section class="xl:col-span-7 panel-cristal p-5">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-sm font-semibold text-white">Registrar Asistencia</h3>
                        <span class="text-[10px] px-2 py-1 rounded-full border border-emerald-900/40 text-emerald-400 bg-emerald-950/20">Listo</span>
                    </div>

                    <p class="text-xs text-neutral-400 mb-4">
                        Selecciona el practicante y pulsa el botón para registrar su entrada o salida.
                    </p>

                    <form method="POST" action="asistencia_facial.php" class="space-y-4">
                        <div class="space-y-2">
                            <label class="etiqueta-form-alumno" for="practicante_id">Practicante</label>
                            <select id="practicante_id" name="practicante_id" class="campo-form-alumno" <?php if (empty($practicantes_activos)) { echo 'disabled'; } ?> required>
                                <?php if (empty($practicantes_activos)): ?>
                                    <option value="">No hay practicantes activos</option>
                                <?php else: ?>
                                    <?php foreach ($practicantes_activos as $p): ?>
                                        <option value="<?php echo (int)$p['id']; ?>">
                                            <?php echo $p['codigo'] . ' · ' . $p['nombres'] . ' ' . $p['apellidos']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <button type="submit" name="accion" value="marcar_asistencia"
                            class="boton-ingresar w-full justify-center"
                            <?php if (empty($practicantes_activos)) { echo 'disabled'; } ?>>
                            Registrar Asistencia
                        </button>
                    </form>
                </section>

                <section class="xl:col-span-5 space-y-6">
                    <div class="panel-cristal p-5">
                        <h3 class="text-sm font-semibold text-white mb-3">Historial Reciente</h3>
                        <div class="space-y-2">
                            <?php if (empty($historial)): ?>
                                <p class="text-xs text-neutral-500">Sin registros aún.</p>
                            <?php else: ?>
                                <?php foreach ($historial as $h):
                                    $esEntrada = $h['hora_salida'] === null;
                                    if ($esEntrada) {
                                        $hora = $h['hora_entrada'];
                                    } else {
                                        $hora = $h['hora_salida'];
                                    }
                                ?>
                                    <div class="border border-neutral-900 rounded-lg p-3 text-xs">
                                        <div class="flex items-center justify-between">
                                            <span class="text-neutral-500"><?php echo date('d/m/Y', strtotime($h['fecha'])); ?></span>
                                            <span class="<?php if ($esEntrada) { echo 'text-cyan-400'; } else { echo 'text-amber-400'; } ?>"><?php if ($esEntrada) { echo 'Entrada'; } else { echo 'Salida'; } ?></span>
                                        </div>
                                        <p class="text-white font-semibold mt-1"><?php echo $h['nombres'] . ' ' . $h['apellidos']; ?></p>
                                        <p class="text-neutral-500 font-mono"><?php echo $h['codigo_practicante']; ?> · <?php echo date('H:i', strtotime($hora)); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </div>

        </main>

    </div>

    <?php require_once __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
