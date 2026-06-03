    <!-- Pie de página -->
    <?php if (basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == ''): ?>
    <footer class="relative z-10 w-full max-w-7xl mx-auto px-6 pb-12 flex flex-col items-center justify-end gap-5 mt-auto">
        <div class="flex flex-col items-center justify-center gap-4 w-full text-center">
            <!-- Texto del patrocinador -->
            <span class="text-[13px] sm:text-[15px] tracking-[0.15em] font-medium text-neutral-400 select-none font-sans">
                Un Sistema Web para el IESTP Argentina
            </span>

            <!-- Logo del patrocinador -->
            <div class="flex flex-wrap items-center justify-center mt-2">
                <img 
                    src="https://res.cloudinary.com/dfsc2cv8f/image/upload/v1779574558/1630615591279_1_kqhyka.png" 
                    alt="Logo Patrocinador" 
                    referrerpolicy="no-referrer"
                    class="h-20 md:h-24 w-auto opacity-80 hover:opacity-100 transition-opacity duration-300 cursor-pointer"
                />
            </div>

            <!-- Texto legal -->
            <span class="text-[10px] sm:text-[11px] tracking-wider font-normal text-neutral-600 select-none font-sans mt-3 max-w-xs sm:max-w-2xl px-4 leading-relaxed">
                © <?php echo date('Y'); ?> LabControl · Gestión de Laboratorios de Cómputo · Instituto Superior Tecnológico Argentina
            </span>
        </div>
    </footer>
    <?php else: ?>
    <!-- Pie de página sencillo -->
    <footer class="relative z-10 w-full max-w-7xl mx-auto px-6 py-8 border-t border-neutral-900/40 flex flex-col sm:flex-row items-center justify-between gap-4 mt-auto">
        <span class="text-[10px] font-mono tracking-wider text-neutral-600 uppercase">
            SISTEMA DE GESTIÓN // LABCONTROL
        </span>
        <span class="text-[10px] font-mono tracking-wider text-neutral-600 uppercase">
            © <?php echo date('Y'); ?> IESTP ARGENTINA // TODOS LOS DERECHOS RESERVADOS
        </span>
    </footer>
    <?php endif; ?>

    <!-- Cargar los iconos -->
    <script>
      lucide.createIcons();
    </script>
</body>
</html>
