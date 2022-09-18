<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailRecordatorioCompletarPerfil extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
/*     public function __construct()
    {
        //
    } */

    /**
     * Build the message.
     *
     * @return $this
     */
/*     public function build()
    {
        return $this->markdown('mail.email_recordatorio_completar_perfil');
    } */
    public $subject = 'Completar registro';
    public $usuario;
    public $urlRegistros;
    public $mensaje;
/*     public $datos;
    public $idCrne; */
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usuario,$urlRegistros/* , $datos, $idCrne */,$mensaje)
    {
        /* $this->datos = $datos; */
        $this->usuario = $usuario;
        $this->urlRegistros = $urlRegistros;
        /* $this->idCrne = $idCrne; */
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.email_recordatorio_completar_perfil'/* 'mail.mensaje_persona' */);
    }
}
