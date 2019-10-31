<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EstateAdminVerify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;
    public $password;
    public $estate;
    
    public function __construct($user, $password, $estate)
    {
        $this->user     = $user;
        $this->password = $password;
        $this->estate   = $estate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@gateguard.co')
                    ->subject('New Estate Admin')
                    ->view('recovery.estate_admin_verify')
                    ->with('password', $this->password);
    }
}
