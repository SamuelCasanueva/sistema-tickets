<x-layouts::app :title="__('Terminal de Control - RobCo')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-2xl font-mono text-amber-400">
        
        <!-- Header de la Terminal -->
        <div class="border-2 border-amber-500/70 p-5 bg-[#0d0904] rounded-xl shadow-[0_0_15px_rgba(245,158,11,0.2)]">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                <div>
                    <p class="text-[10px] text-amber-600 uppercase tracking-widest">ROBCO ENTERPRISES // SISTEMA DE TICKETS DEL MOJAVE</p>
                    <h2 class="text-xl sm:text-2xl font-bold tracking-wider text-amber-300">
                        &gt; CONSOLA CENTRAL DE ADMINISTRACIÓN
                    </h2>
                    <p class="text-xs text-amber-500/80 mt-0.5">
                        OPERADOR: {{ auth()->user()->name ?? 'COURIER 6' }} &bull; FRECUENCIA: 87.5 MHz &bull; KERNEL: V2.28
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('mail.formulario') }}" class="px-4 py-2 border-2 border-amber-400 bg-amber-400 text-black font-bold text-xs hover:bg-amber-300 transition shadow-[0_0_10px_rgba(245,158,11,0.5)]">
                        &gt; [ EMITIR NUEVO TICKET ]
                    </a>
                </div>
            </div>
        </div>

        <!-- Métricas / Indicadores RobCo -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- Métrica 1 -->
            <div class="border border-amber-500/50 p-4 bg-[#120d06] rounded-xl">
                <div class="text-[11px] text-amber-600 uppercase font-bold">[ TRANSMISIONES ACTIVAS ]</div>
                <div class="text-3xl font-extrabold text-amber-300 mt-1">12</div>
                <div class="text-[10px] text-amber-500/70 mt-1">3 incidencias con prioridad alta</div>
            </div>

            <!-- Métrica 2 -->
            <div class="border border-amber-500/50 p-4 bg-[#120d06] rounded-xl">
                <div class="text-[11px] text-amber-600 uppercase font-bold">[ RELAY BREVO SMTP ]</div>
                <div class="text-3xl font-extrabold text-emerald-400 mt-1">ONLINE</div>
                <div class="text-[10px] text-emerald-500/80 mt-1">Puerto 587 autenticado &bull; TLS</div>
            </div>

            <!-- Métrica 3 -->
            <div class="border border-amber-500/50 p-4 bg-[#120d06] rounded-xl">
                <div class="text-[11px] text-amber-600 uppercase font-bold">[ TIEMPO DE RESPUESTA ]</div>
                <div class="text-3xl font-extrabold text-amber-300 mt-1">&lt; 14m</div>
                <div class="text-[10px] text-amber-500/70 mt-1">Promedio en las últimas 24 horas</div>
            </div>
        </div>

        <!-- Tabla de Registros / Log de Tickets Recientes -->
        <div class="border border-amber-500/60 p-5 bg-[#0d0904] rounded-xl flex-1 flex flex-col">
            <div class="border-b border-amber-500/40 pb-3 mb-4 flex items-center justify-between">
                <h3 class="text-sm font-bold uppercase tracking-wider text-amber-300">
                    &gt; [ REGISTRO RECIENTE DE DESPACHOS E INCIDENCIAS ]
                </h3>
                <span class="text-[11px] text-amber-600">CANAL: LOCAL-01</span>
            </div>

            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-amber-500/30 text-amber-500 font-bold uppercase">
                            <th class="py-2.5 px-3">CÓDIGO</th>
                            <th class="py-2.5 px-3">REMITENTE</th>
                            <th class="py-2.5 px-3">ASUNTO</th>
                            <th class="py-2.5 px-3">DESTINO</th>
                            <th class="py-2.5 px-3">ESTADO</th>
                            <th class="py-2.5 px-3 text-right">ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-500/20 text-amber-200/90">
                        <tr class="hover:bg-amber-500/10 transition">
                            <td class="py-3 px-3 font-bold text-amber-400">#TK-8021</td>
                            <td class="py-3 px-3">Courier Six</td>
                            <td class="py-3 px-3">Fallo de enlace en generador Helios One</td>
                            <td class="py-3 px-3 text-amber-500">soporte@mojave.com</td>
                            <td class="py-3 px-3">
                                <span class="px-2 py-0.5 border border-amber-500 bg-amber-500/20 text-amber-300 font-bold text-[10px]">
                                    [ EN REVISIÓN ]
                                </span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <a href="{{ route('mail.formulario') }}" class="text-amber-400 hover:underline font-bold">[ VER LOG ]</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-amber-500/10 transition">
                            <td class="py-3 px-3 font-bold text-amber-400">#TK-7994</td>
                            <td class="py-3 px-3">Victor / Securitron</td>
                            <td class="py-3 px-3">Actualización de firmware RobCo v2.3</td>
                            <td class="py-3 px-3 text-amber-500">lucky38@vegas.net</td>
                            <td class="py-3 px-3">
                                <span class="px-2 py-0.5 border border-emerald-500 bg-emerald-500/20 text-emerald-400 font-bold text-[10px]">
                                    [ RESUELTO ]
                                </span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <a href="{{ route('mail.formulario') }}" class="text-amber-400 hover:underline font-bold">[ VER LOG ]</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-amber-500/10 transition">
                            <td class="py-3 px-3 font-bold text-amber-400">#TK-7940</td>
                            <td class="py-3 px-3">Oficina Goodsprings</td>
                            <td class="py-3 px-3">Paquete extraviado en ruta 15</td>
                            <td class="py-3 px-3 text-amber-500">dispatch@mojave.com</td>
                            <td class="py-3 px-3">
                                <span class="px-2 py-0.5 border border-rose-500 bg-rose-500/20 text-rose-400 font-bold text-[10px]">
                                    [ URGENTE ]
                                </span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <a href="{{ route('mail.formulario') }}" class="text-amber-400 hover:underline font-bold">[ VER LOG ]</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="border-t border-amber-500/30 pt-3 mt-4 flex items-center justify-between text-[11px] text-amber-600">
                <span>&gt; MOSTRANDO 3 DE 12 INCIDENCIAS REGISTRADAS</span>
                <a href="{{ route('mail.formulario') }}" class="text-amber-400 hover:underline font-bold">
                    &gt; [ ABRIR FORMULARIO DE DESPACHO &rarr; ]
                </a>
            </div>
        </div>

    </div>
</x-layouts::app>
