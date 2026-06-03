<?php
// Formulario para registrar un equipo de laboratorio nuevo. Es 100% independiente.

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['codigo']))      { $codigo = $_POST['codigo']; }           else { $codigo = ''; }
    if (isset($_POST['nombre']))      { $nombre = $_POST['nombre']; }           else { $nombre = ''; }
    if (isset($_POST['laboratorio'])) { $laboratorio = $_POST['laboratorio']; } else { $laboratorio = ''; }
    if (isset($_POST['estado']))      { $estado = $_POST['estado']; }           else { $estado = ''; }

    $resultado = sim_crear_equipo([
        'codigo'      => $codigo,
        'nombre'      => $nombre,
        'laboratorio' => $laboratorio,
        'estado'      => $estado,
    ]);

    if ($resultado['ok']) {
        flash_set('ok', 'Equipo registrado correctamente.');
        header('Location: gestion_laboratorios.php');
        exit;
    } else {
        flash_set('err', $resultado['error']);
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

            <?php encabezado('Sede Central · Laboratorios', 'Registrar Nuevo Equipo', 'Da de alta un equipo en el inventario de los laboratorios.'); ?>

            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div></div>
                <div>
                    <a href="gestion_laboratorios.php" class="btn-alumno-secundario">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                        Volver
                    </a>
                </div>
            </div>

            <?php echo flash_render(); ?>

            <!-- Formulario -->
            <div class="grid grid-cols-1 gap-8 max-w-3xl w-full mx-auto">

                <section class="panel-cristal p-6 sm:p-8 space-y-6">
                    <div class="border-b border-neutral-900/60 pb-3 flex items-center gap-2">
                        <i data-lucide="monitor-plus" class="icono-azul"></i>
                        <h3 class="titulo-seccion">Datos del Equipo</h3>
                    </div>

                    <form method="POST" action="registrar_equipo.php" class="space-y-6">

                        <div class="space-y-2">
                            <label class="etiqueta-form-alumno" for="codigo">Código de Equipo</label>
                            <input type="text" id="codigo" name="codigo" class="campo-form-alumno font-mono"
                                placeholder="PC-LC1-01" required maxlength="20"
                                value="<?php
                                if (isset($_POST['codigo'])) { echo $_POST['codigo']; } else { echo ''; }
                                ?>">
                        </div>

                        <div class="space-y-2">
                            <label class="etiqueta-form-alumno" for="nombre">Nombre / Modelo</label>
                            <input type="text" id="nombre" name="nombre" class="campo-form-alumno"
                                placeholder="HP ProDesk 600 G6" required maxlength="120"
                                value="<?php
                                if (isset($_POST['nombre'])) { echo $_POST['nombre']; } else { echo ''; }
                                ?>">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="etiqueta-form-alumno" for="laboratorio">Laboratorio</label>
                                <select id="laboratorio" name="laboratorio" class="campo-form-alumno" required>
                                    <option value="">Seleccione…</option>
                                    <option value="lab1" <?php if (isset($_POST['laboratorio']) && $_POST['laboratorio'] === 'lab1') { echo 'selected'; } ?>>Laboratorio de Cómputo 1</option>
                                    <option value="lab2" <?php if (isset($_POST['laboratorio']) && $_POST['laboratorio'] === 'lab2') { echo 'selected'; } ?>>Laboratorio de Cómputo 2</option>
                                    <option value="lab5" <?php if (isset($_POST['laboratorio']) && $_POST['laboratorio'] === 'lab5') { echo 'selected'; } ?>>Laboratorio de Cómputo 5</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="etiqueta-form-alumno" for="estado">Estado</label>
                                <select id="estado" name="estado" class="campo-form-alumno" required>
                                    <option value="">Seleccione…</option>
                                    <option value="operativo"     <?php if (isset($_POST['estado']) && $_POST['estado'] === 'operativo') { echo 'selected'; } ?>>Operativo</option>
                                    <option value="mantenimiento" <?php if (isset($_POST['estado']) && $_POST['estado'] === 'mantenimiento') { echo 'selected'; } ?>>En Mantenimiento</option>
                                    <option value="danado"        <?php if (isset($_POST['estado']) && $_POST['estado'] === 'danado') { echo 'selected'; } ?>>Dañado</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-neutral-900/60 flex flex-col sm:flex-row gap-3">
                            <a href="gestion_laboratorios.php" class="btn-alumno-secundario sm:w-auto">
                                <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                                Cancelar
                            </a>
                            <button type="submit" class="btn-alumno-primario flex-1">
                                <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                                Guardar Equipo
                            </button>
                        </div>
                    </form>
                </section>

            </div>

        </main>

    </div>

    <?php require_once __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
