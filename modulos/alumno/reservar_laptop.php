<?php
// Formulario de nueva reserva de laptop (alumno). Es 100% independiente.

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

            <?php encabezado('Reservas · Nueva solicitud', 'Reserva de Laptop', 'Solicita un equipo portátil para tu jornada académica. Las reservas se aprueban automáticamente si hay disponibilidad.'); ?>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Formulario principal -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="panel-cristal p-6 sm:p-8 space-y-6">
                        <div class="border-b border-neutral-900/60 pb-3">
                            <h3 class="text-lg font-semibold text-neutral-200">Datos de la Reserva</h3>
                        </div>

                        <form action="confirmacion_reserva.php" method="get" class="space-y-6" novalidate>

                            <!-- Datos del alumno (no editables) -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="etiqueta-form-alumno" for="alumno_nombre">Alumno</label>
                                    <div class="relative">
                                        <i data-lucide="user" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-neutral-600 w-4 h-4"></i>
                                        <input type="text" id="alumno_nombre" class="campo-form-alumno pl-11" value="Alejandro Martínez Quispe" readonly>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="etiqueta-form-alumno" for="alumno_dni">DNI</label>
                                    <div class="relative">
                                        <i data-lucide="credit-card" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-neutral-600 w-4 h-4"></i>
                                        <input type="text" id="alumno_dni" class="campo-form-alumno pl-11" value="71234567" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Laptop a reservar -->
                            <div class="space-y-2">
                                <label class="etiqueta-form-alumno" for="equipo">Laptop disponible</label>
                                <div class="relative">
                                    <i data-lucide="hard-drive" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-[#7da2ce] w-4 h-4"></i>
                                    <select id="equipo" name="equipo" class="campo-form-alumno pl-11 bg-neutral-950" required>
                                        <option value="" disabled selected>Seleccione una laptop disponible...</option>
                                        <option value="DL-5420">Dell Latitude 5420 · LP-012</option>
                                        <option value="HP-450">HP ProBook 450 G9 · LP-008</option>
                                        <option value="LE-T14">Lenovo ThinkPad T14 · LP-004</option>
                                        <option value="MB-M2">MacBook Pro M2 · LP-002</option>
                                    </select>
                                </div>
                                <span class="text-[11px] text-neutral-500 block pl-1 font-sans">Listado de laptops disponibles en el centro de cómputo para préstamo.</span>
                            </div>

                            <!-- Fecha y horario -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <!-- Fecha -->
                                <div class="space-y-2">
                                    <label class="etiqueta-form-alumno" for="fecha">Fecha de uso</label>
                                    <div class="relative">
                                        <i data-lucide="calendar" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-neutral-500 w-4 h-4"></i>
                                        <input type="date" id="fecha" name="fecha" class="campo-form-alumno pl-11 font-mono" value="2026-05-18" required>
                                    </div>
                                </div>
                                <!-- Inicio -->
                                <div class="space-y-2">
                                    <label class="etiqueta-form-alumno" for="hora_inicio">Hora de inicio</label>
                                    <div class="relative">
                                        <i data-lucide="clock" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-neutral-500 w-4 h-4"></i>
                                        <select id="hora_inicio" name="hora_inicio" class="campo-form-alumno pl-11 bg-neutral-950 font-mono" required>
                                            <option value="08:00">08:00 AM</option>
                                            <option value="09:00">09:00 AM</option>
                                            <option value="10:00" selected>10:00 AM</option>
                                            <option value="11:00">11:00 AM</option>
                                            <option value="14:00">02:00 PM</option>
                                            <option value="15:00">03:00 PM</option>
                                            <option value="16:00">04:00 PM</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Fin -->
                                <div class="space-y-2">
                                    <label class="etiqueta-form-alumno" for="hora_fin">Hora de fin</label>
                                    <div class="relative">
                                        <i data-lucide="clock" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-[#7da2ce] w-4 h-4"></i>
                                        <select id="hora_fin" name="hora_fin" class="campo-form-alumno pl-11 bg-neutral-950 font-mono" required>
                                            <option value="10:00">10:00 AM</option>
                                            <option value="11:00">11:00 AM</option>
                                            <option value="12:00" selected>12:00 PM</option>
                                            <option value="13:00">01:00 PM</option>
                                            <option value="16:00">04:00 PM</option>
                                            <option value="17:00">05:00 PM</option>
                                            <option value="18:00">06:00 PM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Motivo -->
                            <div class="space-y-2">
                                <label class="etiqueta-form-alumno" for="motivo">Motivo del préstamo</label>
                                <textarea id="motivo" name="motivo" class="campo-form-alumno resize-none" rows="4" placeholder="Describe brevemente el uso académico de la laptop (trabajo de investigación, exposición, práctica académica, etc.)." maxlength="300"></textarea>
                                <span class="text-[11px] text-neutral-500 block pl-1">Máximo 300 caracteres. Esta información será revisada por soporte técnico al momento de la entrega.</span>
                            </div>

                            <!-- Condiciones -->
                            <div class="flex items-start gap-3 py-1">
                                <input type="checkbox" id="acepto" name="acepto" class="casilla-verificacion mt-1" required>
                                <label for="acepto" class="texto-descripcion font-light">
                                    Acepto el <a href="#" class="text-[#7da2ce] hover:underline font-normal">Reglamento de Préstamo de Laptops</a> y me responsabilizo por la laptop durante el período de reserva.
                                </label>
                            </div>

                            <div class="flex flex-col sm:flex-row justify-between items-center border-t border-neutral-900/60 pt-6 gap-4">
                                <a href="dashboard_alumno.php" class="btn-alumno-fantasma w-full sm:w-auto text-center justify-center">
                                    Cancelar
                                </a>
                                <div class="flex gap-3 w-full sm:w-auto">
                                    <button type="reset" class="btn-alumno-secundario w-full sm:w-auto text-center justify-center">
                                        Limpiar
                                    </button>
                                    <button type="submit" class="btn-alumno-primario w-full sm:w-auto text-center justify-center">
                                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                                        Confirmar Reserva
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Ayuda e información extra al lado -->
                <div class="space-y-6">

                    <!-- Aviso -->
                    <div class="panel-acento p-6 flex flex-col gap-4">
                        <div class="flex items-center gap-2">
                            <span class="p-1 rounded bg-[#7da2ce]/10">
                                <i data-lucide="info" class="icono-azul"></i>
                            </span>
                            <span class="text-xs font-mono tracking-wider text-[#7da2ce] uppercase">Recuerda</span>
                        </div>
                        <h4 class="text-sm font-bold text-white uppercase tracking-wide">Política de préstamo</h4>
                        <p class="texto-descripcion">Al reservar, debe dirigirse al área de Soporte Técnico para recoger la Laptop, llevar DNI de forma esencial.</p>
                    </div>

                </div>

            </div>

        </main>

    </div>

    <!-- Pie de página -->
    <?php include __DIR__ . '/../../includes/footer_panel.php'; ?>

</div>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
