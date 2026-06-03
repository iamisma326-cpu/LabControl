<?php
// Página de "Mi cuenta" del Alumno. 
require_once __DIR__ . '/../../data/usuario_sim.php';
sim_iniciar_sesion('alumno');

$rol_actual = 'Alumno';
$usuario    = sim_usuario_actual();

// Tabs permitidas. La activa viene de la URL (?tab=perfil|seguridad); si no, "perfil".
$pestanas_validas = ['perfil', 'seguridad'];
if (isset($_GET['tab'])) {
    $tab = $_GET['tab'];
} else {
    $tab = 'perfil';
}
if (!in_array($tab, $pestanas_validas, true)) {
    $tab = 'perfil';
}

$fondo         = 'color';
if (isset($usuario['iniciales'])) {
    $iniciales = $usuario['iniciales'];
} else {
    $iniciales = '';
}
$portal_nombre = 'Portal del Alumno';
$sustantivo    = 'Alumno';

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="pagina-contenedor-compacto">

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

            <?php encabezado('Mi cuenta · Preferencias', 'Configuración de mi Cuenta', 'Administra tus datos personales, credenciales de acceso y preferencias del ' . $portal_nombre . '.'); ?>

            <!-- Pestañas y los formularios -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Pestañas de la izquierda -->
                <nav class="lg:col-span-3 flex flex-row lg:flex-col gap-2 overflow-x-auto lg:overflow-visible pb-3 lg:pb-0 scrollbar-none self-start" aria-label="Preferencias de cuenta">
                    <a href="?tab=perfil" class="nav-lateral <?php if ($tab == 'perfil') { echo 'activo'; } ?> w-full text-center lg:text-left whitespace-nowrap lg:whitespace-normal">
                        <i data-lucide="user" class="w-4 h-4 hidden lg:inline-block"></i>
                        <span>Perfil del <?php echo $sustantivo; ?></span>
                    </a>
                    <a href="?tab=seguridad" class="nav-lateral <?php if ($tab == 'seguridad') { echo 'activo'; } ?> w-full text-center lg:text-left whitespace-nowrap lg:whitespace-normal">
                        <i data-lucide="shield-check" class="w-4 h-4 hidden lg:inline-block"></i>
                        <span>Seguridad y Acceso</span>
                    </a>
                </nav>

                <!-- Formularios de la derecha -->
                <div class="lg:col-span-9 space-y-8">

                    <!-- Datos personales -->
                    <section id="perfil" class="panel-cristal p-6 sm:p-8 space-y-6 <?php if ($tab == 'perfil') { echo ''; } else { echo 'hidden'; } ?>">
                        <div class="border-b border-neutral-900/60 pb-3 flex items-center gap-2">
                            <i data-lucide="user" class="icono-azul"></i>
                            <h3 class="titulo-seccion">Información Personal</h3>
                        </div>

                        <form action="#" method="post" class="space-y-6">

                            <!-- Foto de perfil -->
                            <div class="flex flex-col sm:flex-row gap-6 items-center sm:items-start">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 rounded-2xl bg-[#7da2ce]/15 border border-neutral-800 flex items-center justify-center text-2xl font-bold text-[#7da2ce]">
                                        <?php echo $iniciales; ?>
                                    </div>
                                    <button type="button" class="text-[11px] font-mono uppercase tracking-wider text-[#7da2ce] hover:text-white mt-3 flex items-center gap-1.5 transition-colors">
                                        <i data-lucide="camera" class="w-3.5 h-3.5"></i>
                                        <span>Cambiar foto</span>
                                    </button>
                                </div>

                                <div class="flex-grow space-y-4 w-full">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <label class="etiqueta-form-alumno" for="nombres">Nombres</label>
                                            <input type="text" id="nombres" name="nombres" class="campo-form-alumno" value="<?php if (isset($usuario['nombres'])) { echo $usuario['nombres']; } ?>">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="etiqueta-form-alumno" for="apellidos">Apellidos</label>
                                            <input type="text" id="apellidos" name="apellidos" class="campo-form-alumno" value="<?php if (isset($usuario['apellidos'])) { echo $usuario['apellidos']; } ?>">
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="etiqueta-form-alumno" for="dni">DNI</label>
                                        <input type="text" id="dni" name="dni" class="campo-form-alumno" value="<?php if (isset($usuario['dni'])) { echo $usuario['dni']; } ?>" readonly>
                                        <span class="text-[10px] text-neutral-500 block pl-1 font-mono">El DNI no puede ser modificado. Contacta a soporte si requieres cambios.</span>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="etiqueta-form-alumno" for="correo">Correo institucional</label>
                                        <input type="email" id="correo" name="correo" class="campo-form-alumno" value="<?php if (isset($usuario['correo'])) { echo $usuario['correo']; } ?>" readonly>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="etiqueta-form-alumno" for="telefono">Teléfono</label>
                                        <input type="tel" id="telefono" name="telefono" class="campo-form-alumno" value="<?php if (isset($usuario['telefono'])) { echo $usuario['telefono']; } ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end gap-3 border-t border-neutral-900/60 pt-6">
                                <button type="reset" class="btn-alumno-secundario">
                                    Descartar
                                </button>
                                <button type="submit" class="btn-alumno-primario">
                                    <i data-lucide="save" class="w-4 h-4"></i>
                                    Guardar Cambios
                                </button>
                            </div>

                        </form>
                    </section>

                    <!-- Seguridad y acceso -->
                    <section id="seguridad" class="panel-cristal p-6 sm:p-8 space-y-6 <?php if ($tab == 'seguridad') { echo ''; } else { echo 'hidden'; } ?>">
                        <div class="border-b border-neutral-900/60 pb-3 flex items-center gap-2">
                            <i data-lucide="key-round" class="icono-azul"></i>
                            <h3 class="titulo-seccion font-sans">Seguridad y Acceso</h3>
                        </div>

                        <form action="#" method="post" class="space-y-5">

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="etiqueta-form-alumno" for="actual">Contraseña actual</label>
                                    <input type="password" id="actual" name="actual" class="campo-form-alumno font-mono" placeholder="........">
                                </div>
                                <div></div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="etiqueta-form-alumno" for="nueva">Nueva contraseña</label>
                                    <input type="password" id="nueva" name="nueva" class="campo-form-alumno font-mono" placeholder="Mínimo 8 caracteres">
                                    <span class="text-[10px] text-neutral-500 block pl-1">Incluye al menos una mayúscula, un número y un símbolo.</span>
                                </div>
                                <div class="space-y-2">
                                    <label class="etiqueta-form-alumno" for="repetir">Repetir nueva contraseña</label>
                                    <input type="password" id="repetir" name="repetir" class="campo-form-alumno font-mono" placeholder="........">
                                </div>
                            </div>

                            <div class="flex justify-end border-t border-neutral-900/60 pt-6">
                                <button type="submit" class="btn-alumno-primario">
                                    <i data-lucide="lock" class="w-4 h-4"></i>
                                    Actualizar Credenciales
                                </button>
                            </div>

                        </form>
                    </section>

                </div>

            </div>

        </main>

    </div>

    <?php include __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
