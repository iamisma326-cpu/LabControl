<?php
// Formulario para que el docente reporte una incidencia. Es 100% independiente.

require_once __DIR__ . '/../../data/usuario_sim.php';

sim_iniciar_sesion('docente');
$usuario = sim_usuario_actual();
$nombre_docente = $usuario['nombre'];
$iniciales = $usuario['iniciales'];

$fondo = 'color';
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="pagina-contenedor-compacto">

    <?php $rol_actual = 'Docente'; ?>
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
                <p class="kicker-azul">Portal del Docente</p>
                <h3 class="valor-stat-sm">Gestión de Soporte Técnico</h3>
                <p class="texto-descripcion-mt">Accede y administra las solicitudes de soporte para los laboratorios.</p>
            </section>
            <a href="formulario_soporte.php" class="btn-alumno-primario w-full text-center justify-center">
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                <span>Solicitar Soporte</span>
            </a>
            <nav class="panel-cristal contenedor-nav" aria-label="Navegación del docente">
                <a href="dashboard_docente.php" class="nav-lateral <?php if ($pagina_actual == 'dashboard_docente.php') { echo 'activo'; } ?>">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Panel Principal</span>
                </a>
                <a href="reservar_laptop_docente.php" class="nav-lateral <?php if ($pagina_actual == 'reservar_laptop_docente.php') { echo 'activo'; } ?>">
                    <i data-lucide="laptop" class="w-4 h-4"></i>
                    <span>Reservar Laptop</span>
                </a>
                <a href="formulario_soporte.php" class="nav-lateral <?php if ($pagina_actual == 'formulario_soporte.php') { echo 'activo'; } ?>">
                    <i data-lucide="wrench" class="w-4 h-4"></i>
                    <span>Solicitar Soporte</span>
                </a>
                <a href="configuracion_docente.php" class="nav-lateral <?php if ($pagina_actual == 'configuracion_docente.php') { echo 'activo'; } ?>">
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

        <main class="space-y-6">
            <section class="panel-cristal p-6 bg-neutral-950/50">
                <p class="text-[11px] font-mono uppercase tracking-widest text-[#7da2ce]">Soporte Técnico · Nueva Incidencia</p>
                <h2 class="text-2xl font-semibold text-white mt-2">Solicitud de Soporte Técnico</h2>
                <p class="text-sm text-neutral-400 mt-2">Completa los siguientes campos para reportar una incidencia en los equipos del laboratorio. El equipo de soporte recibirá tu solicitud y la atenderá según prioridad.</p>
            </section>

            <section class="panel-cristal p-6 bg-neutral-950/50">
                <form method="post" action="formulario_soporte.php" class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-neutral-400 mb-1">Docente</label>
                            <input type="text" class="campo-entrada w-full" value="Prof. <?php echo $nombre_docente; ?>" readonly />
                        </div>
                        <div>
                            <label class="block text-xs text-neutral-400 mb-1">Fecha</label>
                            <input type="text" class="campo-entrada w-full" value="<?php echo date('d/m/Y'); ?>" readonly />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-neutral-400 mb-1">Laboratorio</label>
                            <select name="laboratorio" class="campo-entrada w-full" required>
                                <option value="">Selecciona un laboratorio</option>
                                <option value="lab1">Lab. Cómputo 1</option>
                                <option value="lab2">Lab. Cómputo 2</option>
                                <option value="lab3">Lab. Cómputo 3</option>
                                <option value="lab4">Lab. Cómputo 4</option>
                                <option value="lab5">Lab. Cómputo 5</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs text-neutral-400 mb-1">Equipo / Activo</label>
                            <input type="text" name="equipo" class="campo-entrada w-full" placeholder="Ej. PC-12, Proyector Epson, Switch principal" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-neutral-400 mb-1">Tipo de Incidencia</label>
                            <select name="tipo" class="campo-entrada w-full" required>
                                <option value="">Selecciona un tipo</option>
                                <option value="hardware">Falla de Hardware</option>
                                <option value="software">Falla de Software</option>
                                <option value="red">Conectividad / Red</option>
                                <option value="proyector">Proyector / Audio</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs text-neutral-400 mb-1">Prioridad</label>
                            <select name="prioridad" class="campo-entrada w-full" required>
                                <option value="baja">Baja</option>
                                <option value="media" selected>Media</option>
                                <option value="alta">Alta</option>
                                <option value="critica">Crítica</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs text-neutral-400 mb-1">Asunto</label>
                        <input type="text" name="asunto" class="campo-entrada w-full" placeholder="Resumen breve del problema" required />
                    </div>

                    <div>
                        <label class="block text-xs text-neutral-400 mb-1">Descripción detallada</label>
                        <textarea name="descripcion" rows="5" class="campo-entrada w-full" placeholder="Describe lo ocurrido, cuándo se presentó la falla y los pasos para reproducirla." required></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <a href="dashboard_docente.php" class="px-4 py-2 text-xs text-neutral-400 hover:text-white border border-neutral-800 rounded">Cancelar</a>
                        <button type="submit" class="px-4 py-2 text-xs font-semibold text-black bg-[#7da2ce] hover:bg-white rounded">Enviar Solicitud</button>
                    </div>
                </form>
            </section>
        </main>

    </div>

</div>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
