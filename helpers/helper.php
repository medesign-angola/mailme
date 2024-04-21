<?php

class Helper{

    public const ACCEPTED_REQUEST = 200;
    public const INVALID_REQUEST = 405;
    public const UNAUTHORIZED = 401;
    public const INTERNAL_ERROR = 500;
    public const NOT_FOUND = 404;

    public static function response($status, $code, $message){
        
        http_response_code($code);
        $response = [
            'estado' => $status,
            'code' => $code,
            'mensagem' => $message
        ];
        echo json_encode($response);
        die();
    }

}