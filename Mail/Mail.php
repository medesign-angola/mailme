<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/vendor/autoload.php";

class Mail{

    protected $clientName;
    protected $clientUserEmail;
    protected $clientUserPassword;  
    protected $mailHost;
    protected $mailPort;
    protected $mailCharset;

    /**
     * 
     * @var {$mail} email informations
     */
    protected $mail;

    public function __construct($config)
    {
        $this->clientName = $config['clientName'];
        $this->clientUserEmail = $config['clientUserEmail'];
        $this->clientUserPassword = $config['clientUserPassword'];
        $this->mailHost = $config['mailHost'];
        $this->mailPort = $config['mailPort'];
        $this->mailCharset = $config['mailCharset'];

        $this->boot();
    }

    public function boot()
    {
        $this->mail = new PHPMailer();
        $this->mail->CharSet = $this->mailCharset;
        
        $this->mail->isSMTP();
        $this->mail->Host = $this->mailHost;
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Username = $this->clientUserEmail;
        $this->mail->Password = $this->clientUserPassword;
        $this->mail->Port = $this->mailPort;
    }

    public function run($data = [])
    {
        
        $user_name = $data['name'] ?? $data['nome'];
        $user_email = $data['email'];
        $message_subject = $data['subject'] ?? $data['assunto'];
        $message_body = $data['message'] ?? $data['mensagem'];
        

        if(!($user_name || $user_email || $message_subject || $message_body)){
            Helper::response('Erro', Helper::UNAUTHORIZED, 'Verifique os dados enviados'); 
        }
        
        if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
            Helper::response('Erro', Helper::UNAUTHORIZED, 'Email inválido');
        }

        $this->mail->setFrom($user_email, $user_name);
        $this->mail->addReplyTo($user_email);
        $this->mail->addAddress($this->clientUserEmail);

        $this->mail->isHTML(true);
        $this->mail->Subject = ($message_subject);
        $this->mail->Body    = ($message_body."<br><br><strong>Mensagem enviada apartir do website da {$this->clientName}</strong>");
        $this->mail->AltBody = 'Para visualizar essa mensagem acesse';

        if(!$this->mail->send()) {
            Helper::response('Erro', Helper::INTERNAL_ERROR,'Erro ao enviar esta mensagem. Tente novamente ou contacte o proprietário.');
        }

        Helper::response('Sucesso', Helper::ACCEPTED_REQUEST, 'Mensagem enviada com êxito!');

    }

}