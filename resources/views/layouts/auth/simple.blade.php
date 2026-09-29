<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark bg-[#080603]">
    <head>
        @include('partials.head')

        <!-- Fuentes Retro Terminal Fallout -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">

        <style>
            :root {
                --pip-amber: #ffb642;
                --pip-amber-bright: #ffd480;
                --pip-amber-dim: #996317;
                --pip-bg: #080603;
            }

            body {
                font-family: 'Share Tech Mono', monospace !important;
                background-color: var(--pip-bg) !important;
                color: var(--pip-amber) !important;
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

            /* Estilización RobCo para componentes Flux de autenticación */
            [data-flux-control], input, textarea {
                background-color: rgba(10, 7, 3, 0.9) !important;
                border: 1px solid #996317 !important;
                color: #ffd480 !important;
                font-family: 'Share Tech Mono', monospace !important;
                border-radius: 4px !important;
            }

            [data-flux-control]:focus, input:focus {
                border-color: #ffb642 !important;
                box-shadow: 0 0 10px rgba(255, 182, 66, 0.5) !important;
            }

            [data-flux-label], label {
                color: #ffd480 !important;
                font-family: 'Share Tech Mono', monospace !important;
                font-weight: bold !important;
                font-size: 0.75rem !important;
                letter-spacing: 0.05em !important;
                text-transform: uppercase !important;
            }

            button[data-flux-button] {
                font-family: 'Share Tech Mono', monospace !important;
                border: 1px solid #ffb642 !important;
                background-color: #ffb642 !important;
                color: #080603 !important;
                font-weight: bold !important;
                border-radius: 4px !important;
                letter-spacing: 0.05em !important;
                text-transform: uppercase !important;
                transition: all 0.15s !important;
            }

            button[data-flux-button]:hover {
                background-color: #ffd480 !important;
                box-shadow: 0 0 15px rgba(255, 182, 66, 0.8) !important;
            }

            a, [data-flux-link] {
                color: #ffb642 !important;
                font-family: 'Share Tech Mono', monospace !important;
            }

            a:hover, [data-flux-link]:hover {
                color: #ffd480 !important;
                text-decoration: underline !important;
            }

            /* Headers */
            [data-flux-heading], h1, h2, h3 {
                color: #ffd480 !important;
                font-family: 'Share Tech Mono', monospace !important;
                letter-spacing: 0.05em !important;
                text-transform: uppercase !important;
            }

            [data-flux-subheading], p {
                color: #cfa25f !important;
                font-family: 'Share Tech Mono', monospace !important;
                font-size: 0.8rem !important;
            }
        </style>
    </head>
    <body class="min-h-screen bg-[#080603] antialiased relative selection:bg-[#ffb642] selection:text-[#080603] overflow-x-hidden">

        <!-- Efectos CRT Scanlines y Viñeta -->
        <div class="fixed inset-0 crt-scanlines z-30 pointer-events-none"></div>
        <div class="fixed inset-0 crt-vignette z-30 pointer-events-none"></div>

        <div class="relative z-20 flex min-h-svh flex-col items-center justify-center p-4 sm:p-8">
            <div class="flex w-full max-w-md flex-col gap-4">
                
                <!-- Encabezado RobCo con enlace a Home -->
                <div class="flex items-center justify-between border-b border-[#996317] pb-3 mb-2">
                    <a href="{{ route('home') }}" class="text-xs text-[#a67c33] hover:text-[#ffb642] transition flex items-center gap-1 font-mono">
                        <span>&lt;&lt; [ VOLVER A LA TERMINAL ]</span>
                    </a>
                    <span class="text-[10px] text-[#a67c33] font-mono">SEGURIDAD NIVEL 4</span>
                </div>

                <!-- Tarjeta de Autenticación de Terminal -->
                <div class="border-2 border-[#ffb642] p-6 sm:p-8 bg-[#0d0904]/95 shadow-[0_0_20px_rgba(255,182,66,0.25)] relative">
                    <div class="absolute -top-3 left-4 bg-[#080603] px-2 text-[10px] font-bold uppercase tracking-widest text-[#ffd480]">
                        ROBCO INDUSTRIES TERMLINK
                    </div>
                    
                    {{ $slot }}
                </div>

                <!-- Pie Informativo -->
                <div class="text-center text-[10px] text-[#a67c33] tracking-widest uppercase">
                    &gt; TRANSMISIÓN ENCRIPTADA // PROTOCOLO FORTIFY 256-BIT &lt;
                </div>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
