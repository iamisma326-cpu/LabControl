<?php include __DIR__ . '/../includes/header.php'; ?>

<!-- Página para elegir el rol -->
<div class="w-full max-w-6xl mx-auto px-6 py-12 md:py-20 relative z-20 font-sans select-none flex flex-col justify-center flex-grow">
  
  <!-- Barra de arriba con botón para volver -->
  <div class="flex items-center justify-between mb-10 pb-5 border-b border-neutral-900">
    <a
      href="index.php"
      class="group inline-flex items-center gap-2 text-neutral-400 hover:text-white transition-colors text-xs font-mono uppercase tracking-wider bg-neutral-950/40 border border-neutral-900 hover:border-neutral-800 px-4.5 py-2.5 rounded-full"
    >
      <i data-lucide="arrow-left" class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform"></i>
      Volver al Inicio
    </a>
    <span class="text-xs uppercase font-mono tracking-widest text-[#7da2ce]">LabControl Hub</span>
  </div>

  <!-- Títulos principales -->
  <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
    <h2 class="text-3xl sm:text-4xl md:text-5xl font-medium tracking-tight text-white">
      Selector de Roles de Acceso
    </h2>
    <p class="text-sm sm:text-base text-neutral-400 leading-relaxed font-normal">
      Para poder ingresar al sistema web, por favor selecciona el perfil correspondiente.
    </p>
  </div>

  <!-- Tarjetas de los roles -->
  <div class="contenedor-roles">
    
    <!-- Tarjeta 1: alumno o practicante -->
    <a href="<?php echo $base; ?>auth/login_alumno.php" class="tarjeta-perfil block">
      <div class="space-y-6">
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-600/20 to-[#7da2ce]/15 border border-neutral-800 flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
          <i data-lucide="graduation-cap" class="w-6 h-6 text-[#7da2ce]"></i>
        </div>

        <div class="space-y-3">
          <h3 class="text-lg font-semibold text-white tracking-wide font-sans">
            Alumno 
          </h3>
           <p class="texto-descripcion min-h-[90px] font-light">
             Reservar laptops para tus clases académicas, ver el historial de tus reservas.
           </p>
        </div>
      </div>

      <div class="tarjeta-enlace">
        <span>Seleccionar rol</span>
        <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform"></i>
      </div>
    </a>

    <!-- Tarjeta 2: coordinador o docente -->
    <a href="<?php echo $base; ?>auth/login_docente.php" class="tarjeta-perfil block">
      <div class="space-y-6">
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-950/40 to-[#7da2ce]/10 border border-neutral-800 flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
          <i data-lucide="book-open" class="w-6 h-6 text-[#7da2ce]"></i>
        </div>

        <div class="space-y-3">
          <h3 class="text-lg font-semibold text-white tracking-wide font-sans">
           Docente
          </h3>
           <p class="texto-descripcion min-h-[90px] font-light">
             Reportar incidencias que pueden surgir en tus clases en laboratorios o aulas en el Instituto.
           </p>
        </div>
      </div>

      <div class="tarjeta-enlace">
        <span>Seleccionar rol</span>
        <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform"></i>
      </div>
    </a>

    <!-- Tarjeta 3: soporte técnico -->
    <a href="<?php echo $base; ?>auth/login_soporte.php" class="tarjeta-perfil block">
      <div class="space-y-6">
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-rose-950/40 to-[#7da2ce]/10 border border-neutral-800 flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
          <i data-lucide="wrench" class="w-6 h-6 text-rose-400"></i>
        </div>

        <div class="space-y-3">
          <h3 class="text-lg font-semibold text-white tracking-wide font-sans">
            Soporte Técnico Especializado
          </h3>
          <p class="texto-descripcion min-h-[90px] font-light">
            Atiende tickets de incidencias, gestiona los laboratorios de computo, y gestiona los practicantes de soporte técnico.
          </p>
        </div>
      </div>

      <div class="tarjeta-enlace-especial">
        <span>Seleccionar rol</span>
        <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform"></i>
      </div>
    </a>

  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
