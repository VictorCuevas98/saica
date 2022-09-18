<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivacionMail extends Mailable
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
        
        return $this->view('mail.body_mail')
        ->subject('Notificación de alta de usuario sistema ACTA ENTREGA');
    } */
    public $subject = 'Estado de solicitud:';
    public $data;
    public $urlActivacion;
/*     public $datos;
    public $idCrne; */
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$urlActivacion/* , $datos, $idCrne */)
    {
        /* $this->datos = $datos; */
        $this->data = $data;
        $this->urlActivacion = $urlActivacion;
        /* $this->idCrne = $idCrne; */
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.mail_verificacion');
    }
}
