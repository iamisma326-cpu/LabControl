<?php
// Pantalla de login del docente. Es 100% independiente, sin includes visuales.

// Configuración propia de este login (antes vivía en _login_config.php compartido).
$cfg = [
    'badge'             => 'DOC',
    'badge_color'       => 'blue',
    'titulo'            => 'Portal Docente',
    'descripcion'       => 'Ingresa tus credenciales para reportar incidencias en las PCs de los laboratorios de cómputo.',
    'campo_label'       => 'Correo Institucional o DNI',
    'campo_nombre'      => 'identifier',
    'campo_icono'       => 'mail',
    'campo_placeholder' => 'jperez@istpargentina.edu.pe',
    'campo_pattern'     => null,
    'campo_title'       => null,
    'submit_texto'      => 'Acceder al Sistema',
    'submit_color'      => 'blue',
    'separador'         => 'Sistema de Cómputo',
    'pie'               => '[ ACCESO SEGURO ACTIVADO ]',
    'destino'           => 'modulos/docente/dashboard_docente.php',
    'mostrar_errores'   => false,
];

// Color del recuadro del badge (azul normal, rojo para soporte).
if ($cfg['badge_color'] == 'rose') {
    $badge_class = 'from-rose-950/30 to-rose-900/10 border-rose-900/40 text-rose-400';
} else {
    $badge_class = 'from-[#7da2ce]/20 to-neutral-900 border-neutral-800 text-[#7da2ce]';
}

// Color del botón de enviar.
if ($cfg['submit_color'] == 'rose') {
    $submit_class = 'bg-rose-600 hover:bg-rose-500 text-white shadow-[0_4px_20px_rgba(225,29,72,0.15)] hover:shadow-[0_4px_25px_rgba(225,29,72,0.3)]';
} else {
    $submit_class = 'bg-[#7da2ce] hover:bg-white text-black shadow-[0_4px_20px_rgba(125,162,206,0.15)] hover:shadow-[0_4px_25px_rgba(255,255,255,0.2)]';
}

$fondo = 'color';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="relative z-25 w-full max-w-7xl mx-auto px-6 py-12 md:py-20 flex-grow flex flex-col justify-center items-center">

    <div class="w-full max-w-[460px] mb-8">
        <a href="<?php echo $base; ?>public/selector_roles.php" class="enlace-retorno">
            <i data-lucide="arrow-left" class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform"></i>
            <span>Volver a Roles</span>
        </a>
    </div>

    <div class="tarjeta-ingreso">

        <div class="text-center space-y-4">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br <?php echo $badge_class; ?> border rounded-2xl select-none">
                <span class="text-xs font-mono font-bold tracking-widest"><?php echo $cfg['badge']; ?></span>
            </div>
            <div class="space-y-1.5">
                <h1 class="text-2xl font-medium tracking-tight text-white font-sans">
                    <?php echo $cfg['titulo']; ?>
                </h1>
                <p class="texto-descripcion font-light">
                    <?php echo $cfg['descripcion']; ?>
                </p>
            </div>
        </div>

        <?php if ($cfg['mostrar_errores'] && isset($_GET['error'])): ?>
        <?php
            $mensajes = [
                'credenciales' => 'DNI o contraseña incorrectos.',
                'campos'       => 'Completa todos los campos obligatorios.',
                'metodo'       => 'Método de envío inválido.',
            ];
            if (isset($mensajes[$_GET['error']])) {
                $msg_alerta = $mensajes[$_GET['error']];
            } else {
                $msg_alerta = 'Error al iniciar sesión.';
            }
        ?>
        <div class="bg-rose-950/40 border border-rose-900/60 text-rose-300 p-4 rounded-xl text-xs text-center">
            <?php echo $msg_alerta; ?>
        </div>
        <?php endif; ?>

        <form action="<?php echo $base; ?><?php echo $cfg['destino']; ?>" method="get" class="space-y-5" novalidate>

            <div class="grupo-formulario">
                <label class="etiqueta-formulario" for="<?php echo $cfg['campo_nombre']; ?>"><?php echo $cfg['campo_label']; ?></label>
                <div class="contenedor-entrada-icono">
                    <i data-lucide="<?php echo $cfg['campo_icono']; ?>" class="icono-formulario"></i>
                    <input
                        type="text"
                        id="<?php echo $cfg['campo_nombre']; ?>"
                        name="<?php echo $cfg['campo_nombre']; ?>"
                        class="campo-entrada campo-entrada-icono"
                        placeholder="<?php echo $cfg['campo_placeholder']; ?>"
                        <?php if ($cfg['campo_pattern'] != ''): ?>pattern="<?php echo $cfg['campo_pattern']; ?>"<?php endif; ?>
                        <?php if ($cfg['campo_title'] != ''): ?>title="<?php echo $cfg['campo_title']; ?>"<?php endif; ?>
                        required
                    />
                </div>
            </div>

            <div class="grupo-formulario">
                <div class="flex items-center justify-between pb-1">
                    <label class="etiqueta-formulario" for="password">Contraseña</label>
                    <a href="#" class="text-[10px] font-mono uppercase tracking-wider text-neutral-500 hover:text-white transition-colors">
                        ¿La olvidaste?
                    </a>
                </div>
                <div class="contenedor-entrada-icono">
                    <i data-lucide="lock" class="icono-formulario"></i>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="campo-entrada campo-entrada-icono"
                        placeholder="••••••••"
                        required
                    />
                </div>
            </div>

            <div class="flex items-center gap-3 py-1">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    class="casilla-verificacion"
                />
                <label for="remember" class="text-[11.5px] font-sans font-light text-neutral-400 select-none cursor-pointer">
                    Mantener sesión iniciada
                </label>
            </div>

            <button
                type="submit"
                class="w-full <?php echo $submit_class; ?> font-semibold text-[12px] tracking-widest uppercase py-3.5 rounded-xl transition-all duration-300 transform active:scale-95 mt-2"
            >
                <?php echo $cfg['submit_texto']; ?>
            </button>

        </form>

        <div class="relative flex py-2 items-center">
            <div class="flex-grow border-t border-neutral-900/60"></div>
            <span class="flex-shrink mx-4 text-[9px] font-mono tracking-widest text-neutral-600 uppercase"><?php echo $cfg['separador']; ?></span>
            <div class="flex-grow border-t border-neutral-900/60"></div>
        </div>

        <div class="text-center">
            <p class="text-[10px] font-mono text-neutral-600 tracking-widest uppercase">
                <?php echo $cfg['pie']; ?>
            </p>
        </div>

    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
