<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MailController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

// Rutas para el flujo de envío de mail
Route::get('/mail', [MailController::class, 'formulario'])->name('mail.formulario');
Route::post('/mail/enviar', [MailController::class, 'enviar'])->name('mail.enviar');

// Rutas de prueba rápida
Route::get('/mail-preview', function () {
    return new \App\Mail\TestBrevoMail('Usuario de Prueba', 'Asunto de Prueba', 'Este es un mensaje de prueba.');
});

Route::get('/mail-test', function () {
    try {
        $destinatario = request('email', config('mail.from.address'));
        \Illuminate\Support\Facades\Mail::to($destinatario)->send(
            new \App\Mail\TestBrevoMail('Usuario', 'Prueba Brevo', 'Correo de prueba enviado con éxito.')
        );
        return "✅ Correo enviado con éxito a: <strong>{$destinatario}</strong>. Revisa tu bandeja de entrada o spam.";
    } catch (\Exception $e) {
        return "❌ Error al enviar correo: " . $e->getMessage();
    }
});
