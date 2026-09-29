<!-- ================================================================= -->
<!-- COMPONENTE: TERMINAL LOADER ROBCO (60 FPS + ARIA WCAG 2.1 AA)      -->
<!-- ================================================================= -->
<div 
    id="terminalLoader" 
    class="fixed inset-0 z-50 hidden items-center justify-center bg-[#080603]/90 backdrop-blur-xs select-none opacity-0 transition-opacity duration-200"
    role="dialog"
    aria-modal="true"
    aria-labelledby="loaderTitle"
    aria-describedby="loaderDescription"
    aria-busy="true"
>
    <!-- Líneas Scanline CRT (Aisladas del árbol de accesibilidad) -->
    <div class="absolute inset-0 crt-scanlines pointer-events-none" aria-hidden="true"></div>
    <div class="absolute inset-0 crt-vignette pointer-events-none" aria-hidden="true"></div>

    <!-- Región para Lectores de Pantalla (Screen Readers) -->
    <div class="sr-only" role="status" aria-live="polite" id="srStatusText">
        Iniciando transmisión. Por favor espere.
    </div>

    <!-- Contenedor de la Tarjeta (Transform 60fps con escala GPU) -->
    <div 
        id="loaderCard" 
        class="relative z-10 border-2 border-[#ffb642] p-6 sm:p-8 max-w-md w-full mx-4 bg-[#0d0904] shadow-[0_0_30px_rgba(255,182,66,0.35)] text-center font-mono transform scale-95 transition-transform duration-200 will-change-transform"
    >
        <!-- Encabezado de la Terminal -->
        <div class="border-b border-[#996317] pb-2 mb-4 text-[10px] text-[#a67c33] uppercase tracking-widest flex justify-between items-center" aria-hidden="true">
            <span>ROBCO OS // TRANSMISSION BUFFER</span>
            <span class="text-[#ffb642]">[ EN PROCESO ]</span>
        </div>

        <!-- Radar V.A.T.S. / Señal Osciloscopio (Animado exclusivamente con transform) -->
        <div class="my-4 flex justify-center" aria-hidden="true">
            <div class="w-16 h-16 rounded-full border border-[#996317] relative flex items-center justify-center shadow-[inset_0_0_12px_rgba(255,182,66,0.25)]">
                <!-- Círculo interior segmentado -->
                <div class="w-8 h-8 rounded-full border border-dashed border-[#ffb642]/60 animate-radar-slow will-change-transform"></div>
                <!-- Barrido de radar acelerado por GPU -->
                <div class="absolute inset-0 rounded-full border-t-2 border-[#ffd480] animate-radar-fast will-change-transform"></div>
                <!-- Núcleo de fósforo -->
                <span class="w-2.5 h-2.5 rounded-full bg-[#ffb642] shadow-[0_0_10px_#ffb642]"></span>
            </div>
        </div>

        <!-- Título accesible -->
        <h4 id="loaderTitle" class="text-lg font-bold uppercase text-[#ffd480] tracking-wider mb-2 amber-glow">
            &gt; TRANSMITIENDO DESPACHO...
        </h4>

        <!-- Barra de Progreso Accesible (ARIA) -->
        <div class="bg-[#140e06] border border-[#996317] p-3 mb-3 text-left">
            <div class="flex justify-between text-xs text-[#a67c33] mb-1.5 font-bold">
                <span id="loaderDescription">BUFFER DE ENLACE SMTP:</span>
                <span id="loaderPercentText" class="text-[#ffd480]" aria-hidden="true">0%</span>
            </div>

            <!-- Contenedor nativo de progreso con role="progressbar" -->
            <div 
                class="w-full h-3.5 bg-[#0a0703] border border-[#996317]/80 overflow-hidden relative"
                role="progressbar" 
                id="loaderProgressBar"
                aria-valuemin="0" 
                aria-valuemax="100" 
                aria-valuenow="0"
                aria-label="Progreso de envío del ticket"
            >
                <!-- Relleno acelerado por GPU usando transform: scaleX -->
                <div 
                    id="loaderBarFill" 
                    class="h-full bg-gradient-to-r from-[#ffb642] to-[#ffd480] origin-left will-change-transform transition-transform duration-150 ease-out"
                    style="transform: scaleX(0);"
                ></div>
            </div>

            <!-- Patrón de bloques ASCII decorativos (Oculto a screen readers) -->
            <div id="asciiBarText" class="text-[#ffb642] text-[10px] tracking-widest mt-1 text-center font-mono opacity-80" aria-hidden="true">
                ░░░░░░░░░░░░░░░░░░░░
            </div>
        </div>

        <!-- Mensaje de estado dinámico -->
        <p id="loaderStatusMessage" class="text-[11px] text-[#cfa25f] tracking-wide" aria-hidden="true">
            Sincronizando paquetes con relay Brevo SMTP...
        </p>
    </div>
</div>

<style>
    /* Animaciones exclusivas de GPU (transform / opacity a 60fps) */
    @keyframes radarSpinSweep {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes radarSpinSlow {
        from { transform: rotate(0deg); }
        to { transform: rotate(-360deg); }
    }

    .animate-radar-fast {
        animation: radarSpinSweep 0.8s linear infinite;
        transform: translateZ(0); /* Forzar capa de composición GPU */
    }

    .animate-radar-slow {
        animation: radarSpinSlow 3s linear infinite;
        transform: translateZ(0);
    }

    /* Soporte de Accesibilidad: Reducción de Movimiento (prefers-reduced-motion) */
    @media (prefers-reduced-motion: reduce) {
        .animate-radar-fast,
        .animate-radar-slow {
            animation: none !important;
        }
        #loaderCard,
        #loaderBarFill,
        #terminalLoader {
            transition: none !important;
        }
    }
</style>

<script>
    // Controlador de Accesibilidad y Rendimiento del Loader RobCo
    const terminalLoader = document.getElementById('terminalLoader');
    const loaderCard = document.getElementById('loaderCard');
    const loaderProgressBar = document.getElementById('loaderProgressBar');
    const loaderBarFill = document.getElementById('loaderBarFill');
    const loaderPercentText = document.getElementById('loaderPercentText');
    const asciiBarText = document.getElementById('asciiBarText');
    const loaderStatusMessage = document.getElementById('loaderStatusMessage');
    const srStatusText = document.getElementById('srStatusText');
    
    let loaderInterval = null;
    let currentProgress = 0;

    const technicalPhases = [
        "Codificando señales en frecuencia 87.5 MHz...",
        "Autenticando credenciales TLS en puerto 587...",
        "Despachando paquete a través de Brevo SMTP...",
        "Esperando confirmación del receptor del Yermo...",
        "Transmisión en curso..."
    ];

    function openTerminalLoader(customTitle = '> TRANSMITIENDO DESPACHO...') {
        document.getElementById('loaderTitle').innerText = customTitle;
        currentProgress = 0;
        
        // Reset barra
        loaderBarFill.style.transform = 'scaleX(0)';
        loaderProgressBar.setAttribute('aria-valuenow', '0');
        loaderPercentText.innerText = '0%';
        asciiBarText.innerText = '░'.repeat(20);
        
        // Mensaje inicial para lector de pantalla
        srStatusText.innerText = "Iniciando transmisión. Por favor espere.";

        // Mostrar con transición de opacidad y escala (compositor 60fps)
        terminalLoader.classList.remove('hidden');
        terminalLoader.classList.add('flex');
        
        requestAnimationFrame(() => {
            terminalLoader.classList.remove('opacity-0');
            terminalLoader.classList.add('opacity-100');
            loaderCard.classList.remove('scale-95');
            loaderCard.classList.add('scale-100');
        });

        // Simulación progresiva suave
        loaderInterval = setInterval(() => {
            currentProgress += Math.floor(Math.random() * 7) + 5;
            if (currentProgress > 92) currentProgress = 92; // Espera final del servidor

            const ratio = currentProgress / 100;
            // 60fps GPU transform
            loaderBarFill.style.transform = `scaleX(${ratio})`;

            // Actualizar ARIA
            loaderProgressBar.setAttribute('aria-valuenow', currentProgress);
            loaderPercentText.innerText = `${currentProgress}%`;

            // Visual ASCII
            const filled = Math.round(ratio * 20);
            asciiBarText.innerText = '█'.repeat(filled) + '░'.repeat(20 - filled);

            // Actualizar texto de fase
            if (currentProgress % 20 < 7) {
                const phaseMsg = technicalPhases[Math.floor(Math.random() * technicalPhases.length)];
                loaderStatusMessage.innerText = phaseMsg;
                // Anuncio al lector de pantalla a intervalos razonables
                srStatusText.innerText = `Progreso: ${currentProgress} por ciento. ${phaseMsg}`;
            }
        }, 140);
    }

    function closeTerminalLoader() {
        if (loaderInterval) clearInterval(loaderInterval);
        
        // Completar a 100%
        loaderBarFill.style.transform = 'scaleX(1)';
        loaderProgressBar.setAttribute('aria-valuenow', '100');
        loaderPercentText.innerText = '100%';
        asciiBarText.innerText = '█'.repeat(20);
        srStatusText.innerText = "Transmisión completada con éxito.";

        setTimeout(() => {
            terminalLoader.classList.remove('opacity-100');
            terminalLoader.classList.add('opacity-0');
            loaderCard.classList.remove('scale-100');
            loaderCard.classList.add('scale-95');

            setTimeout(() => {
                terminalLoader.classList.add('hidden');
                terminalLoader.classList.remove('flex');
            }, 200);
        }, 300);
    }

    // Interceptar automáticamente todos los formularios para evitar clics dobles y activar el loader
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                openTerminalLoader('> EJECUTANDO TRANSMISIÓN...');
            });
        });
    });
</script>
