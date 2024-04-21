<?php


require_once "routeSwitch.php";

class Router extends RouteSwitch{

    public function run( string $requestUri ){

        $route = substr($requestUri, 1);

        if($route === ""){

            $this->api_function();

        }else{
            $this->$route();
        }

    }

}