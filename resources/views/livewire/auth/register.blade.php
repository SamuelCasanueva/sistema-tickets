<x-layouts::auth :title="__('Registro de Operador - RobCo')">
    <div class="flex flex-col gap-5">
        <x-auth-header :title="'> ALTA DE NUEVO OPERADOR'" :description="'REGISTRO DE IDENTIFICADOR EN LA BASE CENTRAL ROBCO'" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center text-xs text-amber-300" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-4">
            @csrf
            
            <!-- Name -->
            <flux:input
                name="name"
                :label="'> NOMBRE / ALIAS DEL OPERADOR'"
                :value="old('name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="'EJ: COURIER SIX'"
            />

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="'> FRECUENCIA / CORREO ELECTRÓNICO'"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                placeholder="operador@mojave.com"
            />

            <!-- Password -->
            <flux:input
                name="password"
                :label="'> CLAVE DE ACCESO'"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="'MÍNIMO 8 CARACTERES'"
                passwordrules="{{ \Illuminate\Validation\Rules\Password::defaults()->toPasswordRulesString() }}"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="'> CONFIRMAR CLAVE DE ACCESO'"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="'REPETIR CLAVE'"
                passwordrules="{{ \Illuminate\Validation\Rules\Password::defaults()->toPasswordRulesString() }}"
                viewable
            />

            <div class="flex items-center justify-end pt-2">
                <flux:button type="submit" variant="primary" class="w-full cursor-pointer" data-test="register-user-button">
                    &gt;&gt; [ ASIGNAR CREDENCIALES DE ACCESO ]
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 text-xs text-center text-[#a67c33] pt-2 border-t border-[#996317]/50">
            <span>¿YA CUENTA CON REGISTRO?</span>
            <flux:link :href="route('login')" wire:navigate class="font-bold underline text-[#ffb642]">[ INICIAR SESIÓN ]</flux:link>
        </div>
    </div>
</x-layouts::auth>
