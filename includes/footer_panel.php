<?php
// Pie de página de los paneles. Muestra enlaces distintos según el rol
// de la página actual (alumno, docente o soporte).
$current_uri = $_SERVER['PHP_SELF'];
?>
<footer class="panel-cristal panel-footer">
    <div class="fila-footer">
        <div class="space-y-1.5 text-center sm:text-left">
            <span class="text-sm font-semibold tracking-wide text-white font-sans">LabControl</span>
            <p class="text-xs text-neutral-500">© <?php echo date('Y'); ?> LabControl · Gestión de Laboratorios de Cómputo.</p>
        </div>
        <div class="enlaces-footer">
            <?php if (strpos($current_uri, '/modulos/alumno') !== false): ?>
                <a href="dashboard_alumno.php" class="hover:text-white transition-colors duration-200">Panel Principal</a>
                <span class="text-neutral-800">·</span>
                <a href="reservar_laptop.php" class="hover:text-white transition-colors duration-200">Reservar Laptop</a>
                <span class="text-neutral-800">·</span>
                <a href="historial_reservas.php" class="hover:text-white transition-colors duration-200">Mis Reservas</a>
                <span class="text-neutral-800">·</span>
                <a href="configuracion_alumno.php" class="hover:text-white transition-colors duration-200">Configuración</a>

            <?php elseif (strpos($current_uri, '/modulos/docente') !== false): ?>
                <a href="dashboard_docente.php" class="hover:text-white transition-colors duration-200">Panel Principal</a>
                <span class="text-neutral-800">·</span>
                <a href="reservar_laptop_docente.php" class="hover:text-white transition-colors duration-200">Reservar Laptop</a>
                <span class="text-neutral-800">·</span>
                <a href="formulario_soporte.php" class="hover:text-white transition-colors duration-200">Solicitar Soporte</a>
                <span class="text-neutral-800">·</span>
                <a href="configuracion_docente.php" class="hover:text-white transition-colors duration-200">Configuración</a>

            <?php elseif (strpos($current_uri, '/modulos/soporte') !== false): ?>
                <a href="dashboard_jefe_soporte.php" class="hover:text-white transition-colors duration-200">Dashboard</a>
                <span class="text-neutral-800">·</span>
                <a href="solicitudes_reservas.php" class="hover:text-white transition-colors duration-200">Reservas</a>
                <span class="text-neutral-800">·</span>
                <a href="solicitudes_incidencias.php" class="hover:text-white transition-colors duration-200">Incidencias</a>
                <span class="text-neutral-800">·</span>
                <a href="gestion_practicantes.php" class="hover:text-white transition-colors duration-200">Practicantes</a>
                <span class="text-neutral-800">·</span>
                <a href="configuracion.php" class="hover:text-white transition-colors duration-200">Configuración</a>

            <?php else: ?>
                <a href="<?php echo $base; ?>public/index.php" class="hover:text-white transition-colors duration-200">Inicio</a>
            <?php endif; ?>
        </div>
    </div>
</footer>
