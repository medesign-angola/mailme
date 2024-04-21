<?php

/**
 * 
 * @var {$var} variable to be dumped
 */

function dd($var){
    echo "<pre>";
        var_dump($var);
    echo "<pre/>";
    http_response_code(200);

    die();
}