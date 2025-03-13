<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPass extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;

    /**
     * Create a new message instance.
     *
     * @param string $token
     * @param string $email
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = User::where('email', $this->email)->first();

        return $this->subject('Atur Ulang Kata Sandi Anda')
            ->view('mail.auth.reset-password')
            ->with([
                'token' => $this->token,
                'email' => $this->email,
                'user' => $user,
                'title' => 'Atur Ulang Kata Sandi Anda',
            ]);
    }
}
