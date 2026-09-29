<x-layouts::auth :title="__('Acceso a Terminal - RobCo')">
    <div class="flex flex-col gap-5">
        <x-auth-header :title="'> ACCESO DE OPERADOR'" :description="'INGRESE CREDENCIALES PARA DESBLOQUEAR TERMINAL'" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center text-xs text-amber-300" :status="session('status')" />

        <x-passkey-verify />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="'> CORREO DEL OPERADOR / ID'"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="operador@mojave.com"
            />

            <!-- Password -->
            <div class="relative">
                <flux:input
                    name="password"
                    :label="'> CLAVE DE ACCESO'"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="'********'"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-xs end-0 text-amber-500 hover:text-amber-300" :href="route('password.request')" wire:navigate>
                        [ ¿OLVIDÓ SU CLAVE? ]
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox name="remember" :label="'RECORDAR ESTA TERMINAL'" :checked="old('remember')" />

            <div class="flex items-center justify-end pt-1">
                <flux:button variant="primary" type="submit" class="w-full cursor-pointer" data-test="login-button">
                    &gt;&gt; [ AUTORIZAR ACCESO ]
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 text-xs text-center text-[#a67c33] pt-2 border-t border-[#996317]/50">
            <span>¿NO POSEE IDENTIFICADOR?</span>
            <flux:link :href="route('register')" wire:navigate class="font-bold underline text-[#ffb642]">[ REGISTRAR NUEVO OPERADOR ]</flux:link>
        </div>
    </div>
</x-layouts::auth>
