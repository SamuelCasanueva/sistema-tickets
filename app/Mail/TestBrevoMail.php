<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestBrevoMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('📩 Notificación desde UTN')
            ->view('emails.test-brevo')
            ->with([
                'mensaje' => null,
            ]);
    }
}
