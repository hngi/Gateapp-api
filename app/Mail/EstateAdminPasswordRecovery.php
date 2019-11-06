<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EstateAdminPasswordRecovery extends Mailable
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
                    ->subject('Estate Admin: Password Recovery')
                    ->view('recovery.estate_admin_recover_password')
                    ->with('password', $this->password);
    }
}
