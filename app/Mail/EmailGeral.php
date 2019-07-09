<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class EmailGeral extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $titulo;
    public $mensagem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $titulo, $mensagem)
    {
        $this->user = $user;
        $this->titulo = $titulo;
        $this->mensagem = $mensagem;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email')
        ->subject($this->titulo)
        ->with(['titulo' => $this->titulo, 'mensagem' => $this->mensagem]);
    }
}
