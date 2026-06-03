<?php
// Pinta el encabezado (kicker + título) arriba de las páginas del panel.
// Se puede usar de 3 formas:
//   encabezado('Kicker', 'Título')                                  // solo kicker y título
//   encabezado('Kicker', 'Título', 'Una descripción')              // con descripción
//   encabezado('Kicker', 'Título', null, ['accion' => [...]])      // con botón a la derecha
//   encabezado('Kicker', 'Título', '...', ['color' => 'amber'])    // color del kicker
// Colores del kicker: 'blue' (default), 'amber', 'rose'.

function encabezado($kicker, $titulo, $descripcion = null, $opciones = [])
{
    // Color del kicker.
    if (isset($opciones['color'])) {
        $color = $opciones['color'];
    } else {
        $color = 'blue';
    }

    if ($color == 'amber') {
        $color_class = 'text-amber-500';
    } elseif ($color == 'rose') {
        $color_class = 'text-rose-400';
    } else {
        $color_class = 'text-[#7da2ce]';
    }

    // ¿La página pidió un botón de acción a la derecha?
    if (isset($opciones['accion'])) {
        $accion = $opciones['accion'];
    } else {
        $accion = null;
    }

    if ($accion != null):

        // Datos del botón (con valores por defecto si faltan).
        if (isset($accion['href'])) {
            $accion_href = $accion['href'];
        } else {
            $accion_href = '#';
        }
        if (isset($accion['texto'])) {
            $accion_texto = $accion['texto'];
        } else {
            $accion_texto = 'Volver';
        }
?>
            <section class="border-b border-neutral-900 pb-3 flex justify-between items-center flex-wrap gap-4">
                <div>
                    <p class="text-[11px] font-mono uppercase tracking-widest <?php echo $color_class; ?>"><?php echo $kicker; ?></p>
                    <h2 class="text-3xl font-semibold tracking-tight text-white mt-2"><?php echo $titulo; ?></h2>
                </div>
                <a href="<?php echo $accion_href; ?>" class="btn-alumno-secundario text-xs">
                    <?php if (isset($accion['icono']) && $accion['icono'] != ''): ?><i data-lucide="<?php echo $accion['icono']; ?>" class="w-4 h-4"></i><?php endif; ?>
                    <span><?php echo $accion_texto; ?></span>
                </a>
            </section>
<?php
    else:
?>
            <section class="border-b border-neutral-900 pb-6">
                <p class="text-[11px] font-mono uppercase tracking-widest <?php echo $color_class; ?>"><?php echo $kicker; ?></p>
                <h2 class="text-3xl font-semibold tracking-tight text-white mt-2"><?php echo $titulo; ?></h2>
                <?php if ($descripcion != null): ?>
                <p class="text-sm text-neutral-400 mt-2 leading-relaxed max-w-2xl"><?php echo $descripcion; ?></p>
                <?php endif; ?>
            </section>
<?php
    endif;
}
