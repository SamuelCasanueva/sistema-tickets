<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth bg-[#080603]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ROBCO INDUSTRIES (TM) TERMLINK • SISTEMA DE TICKETS DEL MOJAVE</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">

    <!-- Fuentes Retro Terminal de Fallout -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=VT323&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --pip-amber: #ffb642;
            --pip-amber-bright: #ffd480;
            --pip-amber-dim: #996317;
            --pip-amber-dark: #331e04;
            --pip-bg: #0a0703;
        }

        body {
            font-family: 'Share Tech Mono', monospace;
            background-color: var(--pip-bg);
            color: var(--pip-amber);
            text-shadow: 0 0 5px rgba(255, 182, 66, 0.65), 0 0 10px rgba(255, 150, 0, 0.3);
        }

        /* Efecto Scanlines de monitor CRT de bulbos */
        .crt-scanlines {
            background: linear-gradient(
                rgba(18, 16, 16, 0) 50%, 
                rgba(0, 0, 0, 0.35) 50%
            ), 
            linear-gradient(
                90deg,
                rgba(255, 0, 0, 0.03),
                rgba(0, 255, 0, 0.01),
                rgba(0, 0, 255, 0.03)
            );
            background-size: 100% 3px, 4px 100%;
            pointer-events: none;
        }

        /* Resplandor ámbar característico de New Vegas */
        .amber-glow {
            text-shadow: 0 0 6px rgba(255, 182, 66, 0.8), 0 0 14px rgba(255, 140, 0, 0.4);
        }

        .border-pip {
            border-color: var(--pip-amber);
            box-shadow: 0 0 8px rgba(255, 182, 66, 0.3), inset 0 0 8px rgba(255, 182, 66, 0.1);
        }

        .border-pip-dim {
            border-color: var(--pip-amber-dim);
        }

        /* Botón de terminal interactivo */
        .pip-btn {
            background-color: transparent;
            color: var(--pip-amber);
            border: 1px solid var(--pip-amber);
            padding: 0.5rem 1.25rem;
            transition: all 0.1s ease-in-out;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            letter-spacing: 0.05em;
        }

        .pip-btn:hover {
            background-color: var(--pip-amber);
            color: #080603;
            text-shadow: none;
            box-shadow: 0 0 15px rgba(255, 182, 66, 0.8);
        }

        .pip-btn-solid {
            background-color: var(--pip-amber);
            color: #080603;
            text-shadow: none;
            border: 1px solid var(--pip-amber);
            font-weight: bold;
        }

        .pip-btn-solid:hover {
            background-color: var(--pip-amber-bright);
            box-shadow: 0 0 20px rgba(255, 200, 100, 0.9);
        }

        /* Input estilo terminal RobCo */
        .pip-input {
            background-color: rgba(10, 7, 3, 0.85);
            border: 1px solid var(--pip-amber-dim);
            color: var(--pip-amber-bright);
            font-family: 'Share Tech Mono', monospace;
            padding: 0.5rem 0.75rem;
            outline: none;
            transition: all 0.15s;
        }

        .pip-input:focus {
            border-color: var(--pip-amber);
            box-shadow: 0 0 10px rgba(255, 182, 66, 0.5);
            background-color: rgba(30, 20, 8, 0.95);
        }

        /* Parpadeo de cursor */
        @keyframes blink {
            0%, 49% { opacity: 1; }
            50%, 100% { opacity: 0; }
        }
        .cursor-blink {
            animation: blink 1s infinite;
        }

        /* Viñeta de pantalla curva CRT */
        .crt-vignette {
            box-shadow: inset 0 0 100px rgba(0, 0, 0, 0.85), inset 0 0 30px rgba(20, 10, 0, 0.6);
            pointer-events: none;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between relative selection:bg-[#ffb642] selection:text-[#0a0703] overflow-x-hidden">

    <!-- Efecto CRT Scanlines y Viñeta permanente -->
    <div class="fixed inset-0 crt-scanlines z-30"></div>
    <div class="fixed inset-0 crt-vignette z-30"></div>

    <!-- 1. ENCABEZADO ROBCO INDUSTRIES -->
    <header class="w-full max-w-6xl mx-auto pt-6 px-4 z-20">
        <!-- Banner ASCII superior -->
        <div class="border-b-2 border-pip pb-3 mb-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
            <div>
                <p class="text-xs uppercase tracking-widest text-[#a67c33]">ROBCO INDUSTRIES UNIFIED OPERATING SYSTEM</p>
                <h1 class="text-xl sm:text-2xl font-bold tracking-wider text-[#ffb642] amber-glow flex items-center gap-2">
                    <span>&gt; MOJAVE DESPATCH &amp; TICKETING NETWORK</span>
                    <span class="inline-block w-2.5 h-5 bg-[#ffb642] cursor-blink"></span>
                </h1>
                <p class="text-[11px] text-[#a67c33]">HOST: PR-TERMINAL-06 // RELAY: BREVO-SMTP-587 // RADS: 000 mSv</p>
            </div>

            <!-- Botón de Audio y Auth -->
            <div class="flex items-center gap-3">
                <button type="button" id="soundToggle" onclick="toggleSound()" class="text-xs border border-pip-dim px-2 py-1 hover:border-pip text-[#a67c33] hover:text-[#ffb642] transition">
                    [ AUDIO: <span id="soundStatus">ON</span> ]
                </button>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" onclick="playPipSound('confirm')" class="pip-btn text-xs py-1 px-3">
                            [ IR AL PANEL ]
                        </a>
                    @else
                        <a href="{{ route('login') }}" onclick="playPipSound('click')" class="text-xs px-2.5 py-1 text-[#ffb642] hover:underline">
                            [ LOG IN ]
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" onclick="playPipSound('confirm')" class="pip-btn text-xs py-1 px-3">
                                [ REGISTRARSE ]
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <!-- Barra de navegación Pip-Boy / Terminal -->
        <nav class="flex flex-wrap items-center justify-between border border-pip-dim p-2 bg-[#120d06]/60 text-xs sm:text-sm">
            <div class="flex flex-wrap gap-2 sm:gap-6 font-bold">
                <a href="#inicio" onclick="playPipSound('click')" class="hover:text-white transition">[ 01. TERMINAL ]</a>
                <a href="{{ route('mail.formulario') }}" onclick="playPipSound('click')" class="text-[#ffd480] hover:underline">[ 02. FORMULARIO DEDICADO ]</a>
            </div>
            <div class="text-[11px] text-[#a67c33] hidden md:block">
                <span>MEMORIA: 64KB OK // FREQ: 87.5 MHz</span>
            </div>
        </nav>
    </header>

    <!-- MENSAJES DE DIAGNÓSTICO DEL SISTEMA (ALERTAS DE SESIÓN) -->
    <div class="max-w-6xl mx-auto px-4 w-full mt-4 z-20">
        @if(session('success'))
            <div class="border-2 border-emerald-500 bg-emerald-950/80 p-4 text-emerald-300 text-sm shadow-[0_0_15px_rgba(16,185,129,0.3)] flex items-start justify-between">
                <div>
                    <p class="font-bold tracking-wider">[+] TRANSMISIÓN CONFIRMADA // DESPACHO ENVIADO</p>
                    <p class="text-xs mt-1 text-emerald-200/90">&gt; {{ session('success') }}</p>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white font-bold">[ X ]</button>
            </div>
        @endif

        @if(session('error'))
            <div class="border-2 border-rose-500 bg-rose-950/80 p-4 text-rose-300 text-sm shadow-[0_0_15px_rgba(244,63,94,0.3)] flex items-start justify-between">
                <div>
                    <p class="font-bold tracking-wider">[-] ERROR DE ENLACE CRÍTICO // FALLA DE SUB-RUTINA</p>
                    <p class="text-xs mt-1 text-rose-200/90">&gt; {{ session('error') }}</p>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-rose-400 hover:text-white font-bold">[ X ]</button>
            </div>
        @endif
    </div>

    <!-- 2. CONTENIDO PRINCIPAL DE LA TERMINAL -->
    <main class="w-full max-w-6xl mx-auto px-4 py-8 z-20 flex-1" id="inicio">
        
        <!-- SECCIÓN HERO DE LA TERMINAL -->
        <section class="border-2 border-pip p-6 sm:p-10 bg-[#0d0904]/90 mb-10 relative">
            <div class="absolute -top-3 left-4 bg-[#0a0703] px-2 text-xs font-bold uppercase tracking-widest text-[#ffd480]">
                TERMINAL DE COMUNICACIONES • MODELO 3000
            </div>

            <div class="flex flex-col lg:flex-row gap-8 items-start justify-between">
                <div class="flex-1 space-y-4">
                    <p class="text-xs text-[#a67c33]">C:\MOJAVE\EXPRESS\DISPATCH&gt; EXECUTE INITIATIVE_HELP.BAT</p>
                    
                    <h2 class="text-2xl sm:text-4xl font-extrabold tracking-wide uppercase amber-glow leading-snug">
                        SISTEMA DE GESTIÓN DE INCIDENCIAS Y MENSAJERÍA DEL YERMO
                    </h2>

                    <p class="text-sm sm:text-base leading-relaxed text-[#ffc56e]">
                        Centraliza reclamos, pedidos de soporte y reportes técnicos de toda la región de New Vegas. Los mensajes son transmitidos de forma segura mediante el protocolo de retransmisión Brevo SMTP.
                    </p>

                    <!-- Comando interactivo principal (CTA) -->
                    <div class="pt-4 flex">
                        <button type="button" onclick="openTerminalModal()" class="pip-btn pip-btn-solid text-sm sm:text-base py-3.5 px-8 cursor-pointer shadow-[0_0_15px_rgba(255,182,66,0.35)]">
                            &gt;&gt; [ EMITIR TICKET EXPRESS ]
                        </button>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER TERMINAL -->
    <footer class="w-full max-w-6xl mx-auto px-4 pb-8 z-20 text-xs border-t border-pip-dim pt-4 text-[#a67c33] flex flex-col sm:flex-row justify-between items-center gap-2">
        <p>&gt; INDUSTRIAS CASANUEVA // ROBCO ENTERPRISES // SISTEMA DE TICKETS (C) 2026</p>
        <p>[ ESTADO: SEÑAL ESTABLE • 300 BAUDIOS ]</p>
    </footer>

    <!-- ============================================================= -->
    <!-- 3. OVERLAY MODAL: SUB-RUTINA DE TRANSMISIÓN DE PRIORIDAD      -->
    <!-- ============================================================= -->
    <div id="pipModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <!-- Fondo CRT oscurecido con viñeta -->
        <div id="modalBackdrop" class="fixed inset-0 bg-black/85 backdrop-blur-xs transition-opacity duration-200 opacity-0"></div>

        <!-- Contenedor Centrado -->
        <div class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center p-4">
            <div id="modalCard" class="relative w-full max-w-xl bg-[#0d0904] border-2 border-pip p-6 sm:p-8 shadow-[0_0_25px_rgba(255,182,66,0.35)] transform scale-95 opacity-0 transition-all duration-200">
                
                <!-- Encabezado de la Sub-Rutina -->
                <div class="border-b-2 border-pip pb-3 mb-5 flex items-start justify-between">
                    <div>
                        <div class="text-[10px] text-[#a67c33] uppercase font-mono tracking-widest">** ROBCO TRANSMISSION INTERFACE **</div>
                        <h3 id="modalTitle" class="text-xl font-bold uppercase tracking-wider text-[#ffd480] amber-glow">
                            [ SUB-RUTINA: NUEVO DESPACHO ]
                        </h3>
                    </div>
                    <button type="button" onclick="closeTerminalModal()" aria-label="Abortar" class="text-xs border border-pip px-2 py-1 hover:bg-[#ffb642] hover:text-[#080603] transition font-bold cursor-pointer">
                        [ ABORTAR / ESC ]
                    </button>
                </div>

                <p class="text-xs text-[#cfa25f] mb-4">
                    INGRESE LOS PARÁMETROS DEL CASO. EL RELAY NOTIFICARÁ AUTOMÁTICAMENTE AL OPERADOR Y AL CORREO DEL REMITENTE.
                </p>

                <!-- Formulario conectado a MailController::enviar -->
                <form action="{{ route('mail.enviar') }}" method="POST" class="space-y-4 text-xs">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Nombre del Remitente -->
                        <div>
                            <label for="modal_nombre" class="block font-bold uppercase mb-1 text-[#ffd480]">
                                &gt; REMITENTE / NOMBRE *
                            </label>
                            <input type="text" id="modal_nombre" name="nombre" value="{{ old('nombre') }}" required placeholder="EJ: COURIER SIX" class="w-full pip-input text-xs uppercase">
                            @error('nombre') <p class="text-rose-400 mt-1">[!] {{ $message }}</p> @enderror
                        </div>

                        <!-- Teléfono Opcional -->
                        <div>
                            <label for="modal_telefono" class="block font-bold uppercase mb-1 text-[#ffd480]">
                                &gt; FRECUENCIA / TELÉFONO
                            </label>
                            <input type="tel" id="modal_telefono" name="telefono" value="{{ old('telefono') }}" placeholder="EJ: 3704-554433" class="w-full pip-input text-xs">
                        </div>
                    </div>

                    <!-- Correo Destinatario -->
                    <div>
                        <label for="modal_destinatario" class="block font-bold uppercase mb-1 text-[#ffd480]">
                            &gt; CORREO ELECTRÓNICO (DESTINO/RESPUESTA) *
                        </label>
                        <input type="email" id="modal_destinatario" name="destinatario" value="{{ old('destinatario') }}" required placeholder="usuario@mojave.com" class="w-full pip-input text-xs">
                        @error('destinatario') <p class="text-rose-400 mt-1">[!] {{ $message }}</p> @enderror
                    </div>

                    <!-- Asunto -->
                    <div>
                        <label for="modal_asunto" class="block font-bold uppercase mb-1 text-[#ffd480]">
                            &gt; ASUNTO DE LA INCIDENCIA *
                        </label>
                        <input type="text" id="modal_asunto" name="asunto" value="{{ old('asunto') }}" required placeholder="EJ: FALLO EN SUMINISTRO HELIOS ONE" class="w-full pip-input text-xs uppercase">
                        @error('asunto') <p class="text-rose-400 mt-1">[!] {{ $message }}</p> @enderror
                    </div>

                    <!-- Mensaje / Detalle -->
                    <div>
                        <label for="modal_mensaje" class="block font-bold uppercase mb-1 text-[#ffd480]">
                            &gt; REGISTRO DE LA INCIDENCIA (LOG) *
                        </label>
                        <textarea id="modal_mensaje" name="mensaje" rows="4" required placeholder="ESCRIBA EL REPORTE COMPLETO AQUÍ..." class="w-full pip-input text-xs resize-none">{{ old('mensaje') }}</textarea>
                        @error('mensaje') <p class="text-rose-400 mt-1">[!] {{ $message }}</p> @enderror
                    </div>

                    <!-- Botones de Acción -->
                    <div class="pt-2 border-t border-pip-dim/60 flex flex-col sm:flex-row gap-3 items-center justify-between">
                        <button type="submit" onclick="playPipSound('transmit')" class="w-full sm:w-auto pip-btn pip-btn-solid text-xs py-2.5 px-6 cursor-pointer">
                            &gt;&gt; [ EJECUTAR TRANSMISIÓN ]
                        </button>
                        <button type="button" onclick="closeTerminalModal()" class="w-full sm:w-auto text-xs py-2 px-4 border border-pip-dim text-[#a67c33] hover:text-[#ffb642] hover:border-pip transition">
                            [ CANCELAR ]
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- 4. GENERADOR DE AUDIO Y LÓGICA DE TERMINAL (WEB AUDIO API - 100% OFFLINE) -->
    <script>
        // Sistema de audio retro síntesis (Pip-Boy Bleeps)
        let audioEnabled = true;
        let audioCtx = null;

        function getAudioContext() {
            if (!audioCtx) {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                if (AudioContext) audioCtx = new AudioContext();
            }
            if (audioCtx && audioCtx.state === 'suspended') {
                audioCtx.resume();
            }
            return audioCtx;
        }

        function playPipSound(type) {
            if (!audioEnabled) return;
            try {
                const ctx = getAudioContext();
                if (!ctx) return;

                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.connect(gain);
                gain.connect(ctx.destination);

                const now = ctx.currentTime;

                if (type === 'click') {
                    // Clic mecánico agudo de terminal
                    osc.type = 'square';
                    osc.frequency.setValueAtTime(800, now);
                    gain.gain.setValueAtTime(0.04, now);
                    gain.gain.exponentialRampToValueAtTime(0.001, now + 0.04);
                    osc.start(now);
                    osc.stop(now + 0.04);
                } else if (type === 'open') {
                    // Doble tono RobCo de sub-menú (600Hz -> 900Hz)
                    osc.type = 'sawtooth';
                    osc.frequency.setValueAtTime(550, now);
                    osc.frequency.setValueAtTime(880, now + 0.06);
                    gain.gain.setValueAtTime(0.05, now);
                    gain.gain.exponentialRampToValueAtTime(0.001, now + 0.15);
                    osc.start(now);
                    osc.stop(now + 0.15);
                } else if (type === 'close') {
                    // Tono descendente
                    osc.type = 'sawtooth';
                    osc.frequency.setValueAtTime(750, now);
                    osc.frequency.setValueAtTime(400, now + 0.06);
                    gain.gain.setValueAtTime(0.04, now);
                    gain.gain.exponentialRampToValueAtTime(0.001, now + 0.12);
                    osc.start(now);
                    osc.stop(now + 0.12);
                } else if (type === 'transmit') {
                    // Teletipo de transmisión
                    osc.type = 'triangle';
                    osc.frequency.setValueAtTime(1100, now);
                    gain.gain.setValueAtTime(0.06, now);
                    gain.gain.exponentialRampToValueAtTime(0.001, now + 0.2);
                    osc.start(now);
                    osc.stop(now + 0.2);
                } else if (type === 'confirm') {
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(950, now);
                    gain.gain.setValueAtTime(0.05, now);
                    gain.gain.exponentialRampToValueAtTime(0.001, now + 0.08);
                    osc.start(now);
                    osc.stop(now + 0.08);
                }
            } catch (e) {
                // AudioContext bloqueado o no soportado
            }
        }

        function toggleSound() {
            audioEnabled = !audioEnabled;
            document.getElementById('soundStatus').innerText = audioEnabled ? 'ON' : 'OFF';
            if (audioEnabled) playPipSound('click');
        }

        // Control del Modal
        const modal = document.getElementById('pipModal');
        const backdrop = document.getElementById('modalBackdrop');
        const card = document.getElementById('modalCard');

        function openTerminalModal() {
            playPipSound('open');
            modal.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
                const firstInput = document.getElementById('modal_nombre');
                if (firstInput) firstInput.focus();
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeTerminalModal() {
            playPipSound('close');
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 200);
        }

        // Cierre al cliquear en el fondo
        backdrop.addEventListener('click', closeTerminalModal);

        // Tecla Escape para salir de la terminal
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeTerminalModal();
            }
        });

        // Trigger de Salida (Exit-Intent): se activa una sola vez
        let exitTriggered = sessionStorage.getItem('mojave_exit_triggered');
        document.addEventListener('mouseleave', (e) => {
            if (e.clientY <= 0 && !exitTriggered && modal.classList.contains('hidden')) {
                exitTriggered = 'true';
                sessionStorage.setItem('mojave_exit_triggered', 'true');
                openTerminalModal();
            }
        });

        // Reapertura si hubo fallos de validación
        @if($errors->any())
            window.addEventListener('DOMContentLoaded', () => {
                openTerminalModal();
            });
        @endif
    </script>

    <!-- Componente de Animación de Carga RobCo (60 FPS + ARIA) -->
    <x-terminal-loader />
</body>
</html>
