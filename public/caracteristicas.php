<?php include __DIR__ . '/../includes/header.php'; ?>

<!-- Inicio de la página de características -->
<div class="pagina-contenedor">
  
  <!-- Botón para volver atrás -->
  <div class="mb-10">
    <a
      href="index.php"
      class="enlace-retorno"
    >
      <i data-lucide="arrow-left" class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform"></i>
      <span>Volver al Inicio</span>
    </a>
  </div>

  <div class="pagina-encabezado">
    <div class="max-w-3xl space-y-6">
      <p class="text-xs font-mono uppercase tracking-widest text-[#7da2ce]">
        Detalle del Proyecto // ISTP Argentina
      </p>
      
      <h2 class="text-3xl sm:text-4xl md:text-5xl font-sans font-medium text-white tracking-tight leading-[1.1]">
        Sistema Web de Gestión, Mantenimiento de Laboratorios e Incidencias
      </h2>

      <p class="text-neutral-400 text-sm sm:text-base leading-relaxed">
        Plataforma centralizada destinada a optimizar el parque tecnológico del Instituto, garantizando la operatividad de los laboratorios y coordinando las actividades del personal administrativo y formativo.
      </p>
    </div>
  </div>

  <div class="space-y-24">
    
    <!-- Parte 1: el jefe de soporte técnico -->
    <div class="grilla-editorial">
      <div class="columna-izquierda">
        <span class="text-xs font-mono text-[#7da2ce] uppercase tracking-wider block">
          Rol Principal y Supervisión
        </span>
        <h3 class="text-2xl font-sans font-semibold text-white tracking-tight">
          Gestión Integral del Jefe de Soporte
        </h3>
        <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
          El Jefe de Soporte Técnico tiene acceso absoluto al sistema para administrar y supervisar la infraestructura de laboratorios de cómputo y el personal a su cargo.
        </p>
      </div>
      
      <div class="columna-derecha">
        <div class="grilla-lista">
          <div class="item-lista">
            <div class="item-icono">
              <i data-lucide="shield-check" class="w-5 h-5"></i>
            </div>
            <div class="item-texto">
              <h4 class="text-sm font-semibold text-white">Consolidación de Inventario Final</h4>
              <p class="texto-descripcion">
                Controla, actualiza y aprueba el inventario técnico de todas las computadoras de escritorio asignadas físicamente en los laboratorios del Instituto.
              </p>
            </div>
          </div>

          <div class="item-lista">
            <div class="item-icono">
              <i data-lucide="file-text" class="w-5 h-5"></i>
            </div>
            <div class="item-texto">
              <h4 class="text-sm font-semibold text-white">Generación de Reportes de Asistencia</h4>
              <p class="texto-descripcion">
                Filtra y exporta reportes detallados en formatos descargables sobre la puntualidad, faltas de asistencia y horas cumplidas por los practicantes de soporte técnico.
              </p>
            </div>
          </div>

          <div class="item-lista">
            <div class="item-icono">
              <i data-lucide="check" class="w-5 h-5"></i>
            </div>
            <div class="item-texto">
              <h4 class="text-sm font-semibold text-white">Administración General de Incidencias y Préstamos</h4>
              <p class="texto-descripcion">
                Supervisa todas las solicitudes de mantenimiento de PCs de escritorio y asigna practicantes para resolverlas, además de aprobar las reservas de laptops.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Parte 2: mantenimiento y control de equipos fijos -->
    <div class="grilla-editorial border-t border-neutral-900/60 pt-16">
      <div class="columna-izquierda">
        <span class="text-xs font-mono text-[#7da2ce] uppercase tracking-wider block">
          Infraestructura Física
        </span>
        <h3 class="text-2xl font-sans font-semibold text-white tracking-tight">
          Mantenimiento de Computadoras de Escritorio
        </h3>
        <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
          El inventario y diagnóstico se enfoca de forma exclusiva en los equipos de escritorio fijos de los laboratorios para asegurar su correcto estado operativo en las sesiones diarias.
        </p>
      </div>

      <div class="columna-derecha">
        <div class="grilla-lista">
          <div class="item-lista">
            <div class="item-icono">
              <i data-lucide="cpu" class="w-5 h-5"></i>
            </div>
            <div class="item-texto">
              <h4 class="text-sm font-semibold text-white">Inventario Técnico Detallado</h4>
              <p class="texto-descripcion">
                Registro de componentes esenciales de cada computadora (procesador, memoria RAM, almacenamiento y sistema operativo) mapeados con su aula y número de PC exacto.
              </p>
            </div>
          </div>

          <div class="item-lista">
            <div class="item-icono">
              <i data-lucide="help-circle" class="w-5 h-5"></i>
            </div>
            <div class="item-texto">
              <h4 class="text-sm font-semibold text-white">Reporte de Incidencias Técnicas por Docentes</h4>
              <p class="texto-descripcion">
                Los docentes académicos pueden reportar averías físicas o lógicas de las computadoras mediante un formulario digital rápido, permitiendo programar el mantenimiento inmediato.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Parte 3: alumnos y reservas de laptops -->
    <div class="grilla-editorial border-t border-neutral-900/60 pt-16">
      <div class="columna-izquierda">
        <span class="text-xs font-mono text-[#7da2ce] uppercase tracking-wider block">
          Recursos para Alumnos
        </span>
        <h3 class="text-2xl font-sans font-semibold text-white tracking-tight">
          Préstamos y Reservas de Laptops
        </h3>
        <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
          Diferenciando el equipamiento físico permanente, los alumnos cuentan con un módulo específico para solicitar y reservar computadoras portátiles (laptops) para fines académicos.
        </p>
      </div>

      <div class="columna-derecha">
        <div class="grilla-lista">
          <div class="item-lista">
            <div class="item-icono">
              <i data-lucide="laptop" class="w-5 h-5"></i>
            </div>
            <div class="item-texto">
              <h4 class="text-sm font-semibold text-white">Solicitud de Reserva en Línea</h4>
              <p class="texto-descripcion">
                El alumno selecciona el horario deseado y solicita una laptop del stock disponible, sujeta a validación final por el jefe de soporte.
              </p>
            </div>
          </div>

          <div class="item-lista">
            <div class="item-icono">
              <i data-lucide="clock" class="w-5 h-5"></i>
            </div>
            <div class="item-texto">
              <h4 class="text-sm font-semibold text-white">Control de Tiempos y Devoluciones</h4>
              <p class="texto-descripcion">
                Información en tiempo real sobre límites de devolución, fecha de préstamo y estado de retención del equipamiento portátil.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Parte 4: control de horarios de practicantes -->
    <div class="grilla-editorial border-t border-neutral-900/60 pt-16 pb-12">
      <div class="columna-izquierda">
        <span class="text-xs font-mono text-[#7da2ce] uppercase tracking-wider block">
          Administración de Prácticas
        </span>
        <h3 class="text-2xl font-sans font-semibold text-white tracking-tight">
          Control e Ingreso de Practicantes
        </h3>
        <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
          Supervisión de las horas formativas de los alumnos practicantes que brindan soporte técnico, facilitando un registro veraz.
        </p>
      </div>

      <div class="columna-derecha">
        <div class="grilla-lista">
          <div class="item-lista">
            <div class="item-icono">
              <i data-lucide="user" class="w-5 h-5"></i>
            </div>
            <div class="item-texto">
              <h4 class="text-sm font-semibold text-white">Registro Diario de Asistencias</h4>
              <p class="texto-descripcion">
                Marcación exacta del horario de entrada y de salida de cada practicante asignado al departamento de soporte técnico de laboratorios.
              </p>
            </div>
          </div>

          <div class="item-lista">
            <div class="item-icono">
              <i data-lucide="check" class="w-5 h-5"></i>
            </div>
            <div class="item-texto">
              <h4 class="text-sm font-semibold text-white">Totalizador de Horas Realizadas</h4>
              <p class="texto-descripcion">
                Suma automatizada de las horas laborables acumuladas de manera mensual para simplificar la firma y entrega de actas oficiales.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
