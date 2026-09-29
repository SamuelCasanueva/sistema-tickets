<!DOCTYPE html>
<html lang="es" class="bg-[#080603]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MESA DE AYUDA • ROBCO TERMLINK</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">

    <!-- Fuentes Retro Terminal Fallout -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --pip-amber: #ffb642;
            --pip-amber-bright: #ffd480;
            --pip-amber-dim: #996317;
            --pip-bg: #0a0703;
        }

        body {
            font-family: 'Share Tech Mono', monospace;
            background-color: var(--pip-bg);
            color: var(--pip-amber);
            text-shadow: 0 0 5px rgba(255, 182, 66, 0.65), 0 0 10px rgba(255, 150, 0, 0.3);
        }

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

        .crt-vignette {
            box-shadow: inset 0 0 100px rgba(0, 0, 0, 0.85), inset 0 0 30px rgba(20, 10, 0, 0.6);
            pointer-events: none;
        }

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

        .pip-input {
            background-color: rgba(10, 7, 3, 0.85);
            border: 1px solid var(--pip-amber-dim);
            color: var(--pip-amber-bright);
            font-family: 'Share Tech Mono', monospace;
            padding: 0.6rem 0.85rem;
            outline: none;
            transition: all 0.15s;
        }

        .pip-input:focus {
            border-color: var(--pip-amber);
            box-shadow: 0 0 10px rgba(255, 182, 66, 0.5);
            background-color: rgba(30, 20, 8, 0.95);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between relative selection:bg-[#ffb642] selection:text-[#0a0703] overflow-x-hidden">

    <!-- Efecto CRT Scanlines y Viñeta -->
    <div class="fixed inset-0 crt-scanlines z-30"></div>
    <div class="fixed inset-0 crt-vignette z-30"></div>

    <div class="min-h-screen flex items-center justify-center px-4 py-10 z-20">
        <div class="w-full max-w-2xl">
            
            <!-- Barra Superior de Navegación -->
            <div class="flex items-center justify-between mb-4 border-b border-pip-dim pb-3">
                <a href="{{ route('home') }}" onclick="playPipSound('click')" class="text-xs text-[#a67c33] hover:text-[#ffb642] transition flex items-center gap-1">
                    <span>&lt;&lt; [ VOLVER A LA TERMINAL PRINCIPAL ]</span>
                </a>
                <span class="text-xs text-[#a67c33]">SUB-RED MOJAVE // CANAL SEGURO</span>
            </div>

            <!-- Encabezado de la Terminal -->
            <div class="text-left mb-6 border-2 border-pip p-4 bg-[#0d0904]/90 relative">
                <div class="absolute -top-3 left-4 bg-[#0a0703] px-2 text-[10px] font-bold uppercase tracking-widest text-[#ffd480]">
                    ROBCO INDUSTRIES TERMLINK • MESA DE AYUDA
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold uppercase tracking-wider text-[#ffb642] amber-glow">
                    &gt; DESPACHO Y TRANSMISIÓN DE INCIDENCIAS
                </h1>
                <p class="text-xs text-[#cfa25f] mt-1">
                    PROTOCOLO SMTP BREVO CONECTADO. TODOS LOS MENSAJES QUEDAN REGISTRADOS EN LA RED CENTRAL.
                </p>
            </div>

            <!-- Mensaje Exitoso -->
            @if(session('success'))
                <div class="mb-5 border-2 border-emerald-500 bg-emerald-950/80 p-4 text-emerald-300 text-xs shadow-[0_0_15px_rgba(16,185,129,0.3)] flex items-start justify-between">
                    <div>
                        <p class="font-bold tracking-wider">[+] TRANSMISIÓN CONFIRMADA // DESPACHO ENVIADO</p>
                        <p class="mt-1 text-emerald-200/90">&gt; {{ session('success') }}</p>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white font-bold">[ X ]</button>
                </div>
            @endif

            <!-- Mensaje de Error -->
            @if(session('error'))
                <div class="mb-5 border-2 border-rose-500 bg-rose-950/80 p-4 text-rose-300 text-xs shadow-[0_0_15px_rgba(244,63,94,0.3)] flex items-start justify-between">
                    <div>
                        <p class="font-bold tracking-wider">[-] ERROR DE ENLACE CRÍTICO // FALLA DE SUB-RUTINA</p>
                        <p class="mt-1 text-rose-200/90">&gt; {{ session('error') }}</p>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-400 hover:text-white font-bold">[ X ]</button>
                </div>
            @endif

            <!-- Formulario Estilo RobCo -->
            <div class="border-2 border-pip p-6 sm:p-8 bg-[#0d0904]/95 shadow-[0_0_20px_rgba(255,182,66,0.25)]">
                <form action="{{ route('mail.enviar') }}" method="POST" class="space-y-5 text-xs">
                    @csrf

                    <!-- Correo Destinatario -->
                    <div>
                        <label for="destinatario" class="block font-bold uppercase mb-1 text-[#ffd480]">
                            &gt; CORREO DESTINATARIO (DIRECCIÓN DE ENLACE) *
                        </label>
                        <input
                            type="email"
                            id="destinatario"
                            name="destinatario"
                            value="{{ old('destinatario') }}"
                            required
                            placeholder="destinatario@mojave.com"
                            class="w-full pip-input text-xs">
                        @error('destinatario')
                            <p class="text-rose-400 text-xs mt-1">[!] {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Nombre -->
                        <div>
                            <label for="nombre" class="block font-bold uppercase mb-1 text-[#ffd480]">
                                &gt; NOMBRE DEL REMITENTE / OPERADOR *
                            </label>
                            <input
                                type="text"
                                id="nombre"
                                name="nombre"
                                value="{{ old('nombre') }}"
                                required
                                placeholder="EJ: COURIER 6"
                                class="w-full pip-input text-xs uppercase">
                            @error('nombre')
                                <p class="text-rose-400 text-xs mt-1">[!] {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teléfono (opcional) -->
                        <div>
                            <label for="telefono" class="block font-bold uppercase mb-1 text-[#ffd480]">
                                &gt; FRECUENCIA / TELÉFONO <span class="text-[#a67c33] font-normal">(OPCIONAL)</span>
                            </label>
                            <input
                                type="text"
                                id="telefono"
                                name="telefono"
                                value="{{ old('telefono') }}"
                                placeholder="EJ: 3704-123456"
                                class="w-full pip-input text-xs">
                            @error('telefono')
                                <p class="text-rose-400 text-xs mt-1">[!] {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Asunto -->
                    <div>
                        <label for="asunto" class="block font-bold uppercase mb-1 text-[#ffd480]">
                            &gt; ASUNTO DEL DESPACHO / TICKET *
                        </label>
                        <input
                            type="text"
                            id="asunto"
                            name="asunto"
                            value="{{ old('asunto') }}"
                            required
                            placeholder="INGRESE EL ASUNTO DE LA INCIDENCIA"
                            class="w-full pip-input text-xs uppercase">
                        @error('asunto')
                            <p class="text-rose-400 text-xs mt-1">[!] {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mensaje -->
                    <div>
                        <label for="mensaje" class="block font-bold uppercase mb-1 text-[#ffd480]">
                            &gt; REGISTRO DETALLADO DEL MENSAJE (LOG) *
                        </label>
                        <textarea
                            id="mensaje"
                            name="mensaje"
                            rows="6"
                            required
                            placeholder="ESCRIBA EL CONTENIDO COMPLETO DE LA TRANSMISIÓN AQUÍ..."
                            class="w-full pip-input text-xs resize-none">{{ old('mensaje') }}</textarea>
                        @error('mensaje')
                            <p class="text-rose-400 text-xs mt-1">[!] {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botón de Transmisión -->
                    <div class="pt-2">
                        <button
                            type="submit"
                            onclick="playPipSound('transmit')"
                            class="w-full pip-btn pip-btn-solid text-sm py-3.5 px-6 cursor-pointer">
                            &gt;&gt; [ EJECUTAR TRANSMISIÓN POR RELAY BREVO ]
                        </button>
                    </div>
                </form>
            </div>

            <!-- Pie de la Terminal -->
            <div class="text-center text-[#a67c33] text-[11px] mt-6 flex justify-between items-center">
                <span>&gt; ROBCO ENTERPRISES // CASANUEVA DESPATCH</span>
                <span>[ TERMINAL SEGURA • 256-BIT ]</span>
            </div>
        </div>
    </div>

    <!-- Generador de Sonido Web Audio API -->
    <script>
        let audioCtx = null;
        function getAudioContext() {
            if (!audioCtx) {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                if (AudioContext) audioCtx = new AudioContext();
            }
            if (audioCtx && audioCtx.state === 'suspended') audioCtx.resume();
            return audioCtx;
        }

        function playPipSound(type) {
            try {
                const ctx = getAudioContext();
                if (!ctx) return;
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.connect(gain);
                gain.connect(ctx.destination);
                const now = ctx.currentTime;

                if (type === 'click') {
                    osc.type = 'square';
                    osc.frequency.setValueAtTime(800, now);
                    gain.gain.setValueAtTime(0.04, now);
                    gain.gain.exponentialRampToValueAtTime(0.001, now + 0.04);
                    osc.start(now);
                    osc.stop(now + 0.04);
                } else if (type === 'transmit') {
                    osc.type = 'triangle';
                    osc.frequency.setValueAtTime(1100, now);
                    gain.gain.setValueAtTime(0.06, now);
                    gain.gain.exponentialRampToValueAtTime(0.001, now + 0.2);
                    osc.start(now);
                    osc.stop(now + 0.2);
                }
            } catch (e) {}
        }
    </script>

    <!-- Componente de Animación de Carga RobCo (60 FPS + ARIA) -->
    <x-terminal-loader />
</body>
</html>
