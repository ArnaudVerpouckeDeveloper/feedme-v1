<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class ConfirmEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $showManualSectionInEmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $showManualSectionInEmail)
    {
        $this->user = $user;
        $this->showManualSectionInEmail = $showManualSectionInEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@speedmeal.be')->subject("Emailverificatie")
                ->view('emails.confirmEmail');
    }
}
