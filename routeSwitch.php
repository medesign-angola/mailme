<?php

abstract class RouteSwitch{

    public function __call($name, $arguments)
    {
        http_response_code(404);
        require 'pages/not-found.php';
    }

    protected function api_function(){
        require "endpoints/home.php";
    }

}