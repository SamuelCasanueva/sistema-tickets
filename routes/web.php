<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

// Rutas de prueba de correo
Route::get('/mail-preview', function () {
    return new \App\Mail\TestBrevoMail();
});

Route::get('/mail-test', function () {
    try {
        $destinatario = request('email', config('mail.from.address'));
        \Illuminate\Support\Facades\Mail::to($destinatario)->send(new \App\Mail\TestBrevoMail());
        return "✅ Correo enviado con éxito a: <strong>{$destinatario}</strong>. Revisa tu bandeja de entrada o spam.";
    } catch (\Exception $e) {
        return "❌ Error al enviar correo: " . $e->getMessage();
    }
});
