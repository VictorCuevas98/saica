<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class activarCuentaAdmin extends Mailable
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
    public $subject = 'Activación de cuenta:';
    public $data;
    public $urlRecordar;
/*     public $datos;
    public $idCrne; */
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$urlRecordar/* , $datos, $idCrne */)
    {
        /* $this->datos = $datos; */
        $this->data = $data;
        $this->urlRecordar = $urlRecordar;
        /* $this->idCrne = $idCrne; */
    }


    public function build()
    {
        return $this->markdown('mail.activarUsuario');
    }
}
