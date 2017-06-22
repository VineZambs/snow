<?php

namespace App;

class Mailer {

    private $mailer;

    public function __construct() {
        $transport = (new \Swift_SmtpTransport('smtp-mail.outlook.com', 587, 'tls'))
                ->setUsername('snowsystem@outlook.com')
                ->setPassword('pegasus25');

        $this->mailer = new \Swift_Mailer($transport);
    }

    public function send($cpd, $leitura) {
        $usuario = $cpd->empresa->usuario;

        $mensagem = "O CPD $cpd->numero->serial está registrando medições inadequadas \r\n"
                . "Temperatura: $leitura->temperatura / Umidade: $leitura->umidade";

        $mail = (new \Swift_Message('Atenção! Seu CPD está com medições inadequadas.'))
                ->setFrom(['snowsystem@outlook.com' => 'Snow'])
                ->setTo([$usuario->email])
                ->setBody($mensagem);

        return $this->mailer->send($mail);
    }

}
