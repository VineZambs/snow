<?php

namespace App;

class Mailer {

    private $mailer;

    public function __construct() {
        $transport = (new \Swift_SmtpTransport('smtp-mail.outlook.com', 587))
                ->setUsername('snowsystem@outlook.com.br')
                ->setPassword('pegasus25');
//                ->setStreamOptions(array('ssl' => array(
//                    'verify_peer' => false,
//                    'verify_peer_name' => false,
//                    'allow_self_signed' => true
//                )));

        $this->mailer = new \Swift_Mailer($transport);
    }

    public function send($cpd, $leitura) {
        $usuario = $cpd->empresa->usuario;

        $mensagem = "<p>O CPD $cpd->numero->serial está registrando medições inadequadas</p>"
                . "<p>Temperatura: $leitura->temperatura / Umidade: $leitura->umidade</p>";

        $mail = (new \Swift_Message('Atenção! Seu CPD está com medições inadequadas.'))
                ->setFrom(['noreply@snow.com' => 'Snow'])
                ->setTo([$usuario->email])
                ->setBody($mensagem);

        return $this->mailer->send($mail);
    }

}
