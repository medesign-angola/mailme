<?php

require('Mail/Mail.php');


if(!($_SERVER['REQUEST_METHOD'] == "POST")){
    Helper::response('Erro', Helper::INVALID_REQUEST, 'Requisição inválida.');
}

$request = $_REQUEST;

$config = require('config.php');

$mail = new Mail($config['mailer']);
$mail->run($request);