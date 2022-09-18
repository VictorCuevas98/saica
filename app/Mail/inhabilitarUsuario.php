<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class inhabilitarUsuario extends Mailable
{
    use Queueable, SerializesModels;
    /* public $data; */
    /**
     * Create a new message instance.
     *
     * @return void
     */
/*     public function __construct($data)
    {
        $this->data = $data;
    } */

    /**
     * Build the message.
     *
     * @return $this
     */
/*     public function build()
    {
        return $this->view('mail.passRemember')
        ->subject('Notificación de recuperación de contraseña del sistema de RECONSTRUCCIÓN CDMX');
    } */
    public $subject = 'Desactivación de cuenta';

/*     public $datos;
    public $idCrne; */
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }


    public function build()
    {
        return $this->markdown('mail.inhabilitarUsuario');
    }
}
