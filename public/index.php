<?php include __DIR__ . '/../includes/header.php'; ?>

<!-- Parte principal -->
<main class="relative z-10 w-full max-w-7xl mx-auto px-6 sm:px-12 flex-grow flex flex-col justify-center py-16 md:py-24">
    <div class="max-w-4xl text-left flex flex-col select-none">
        
        <!-- Insignia animada -->
        <div class="self-start mb-6">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-neutral-800/80 bg-neutral-950/60 text-[11px] font-mono tracking-wider text-[#7da2ce]">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                Plataforma Institucional de Soporte técnico // IESTP Argentina
            </span>
        </div>

        <!-- Título principal -->
        <h1 class="text-[44px] leading-[1.1] sm:text-[68px] sm:leading-[1.05] lg:text-[82px] lg:leading-[1.02] font-sans font-medium tracking-tight text-white flex flex-col gap-1.5">
            <span class="text-white">LabControl,</span>
            <span class="text-white text-opacity-90">el sistema para</span>
            <span class="text-[#7da2ce]">laboratorios y practicantes</span>
        </h1>

        <!-- Texto de descripción -->
        <p class="mt-7 sm:mt-9 text-neutral-400 text-sm sm:text-base md:text-lg max-w-md md:max-w-xl leading-[1.6] font-normal tracking-wide">
            Administra laboratorios de computación de escritorio, organiza incidentes técnicos reportados por el profesorado, controla la asistencia de practicantes del Instituto y coordina las solicitudes de reservas de laptops para alumnos de forma unificada.
        </p>

        <div class="mt-8 sm:mt-11 flex flex-wrap gap-4 items-center">
            <a 
                href="selector_roles.php"
                class="boton-ingresar"
            >
                Ingresar al Sistema
            </a>
            <a 
                href="https://res.cloudinary.com/dfsc2cv8f/raw/upload/v1779571894/Presentaci%C3%B3n_Portafolio_dise%C3%B1o_Elegante_Blanco_y_negro_vhmyk6.pptx"
                download="Presentacion_Portafolio.pptx"
                class="boton-descargar"
            >
                Descargar Documentación
            </a>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
