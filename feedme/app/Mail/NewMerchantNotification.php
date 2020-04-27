<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Merchant;

class NewMerchantNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $merchant;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->merchant = $user->merchant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@speedmeal.be')->subject("Nieuwe horecazaak geregistreerd")
                ->view('emails.newMerchantNotification');
    }
}
