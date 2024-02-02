<?php

class ControllerDashboard 
{
    
    function index() {
        if (Sesion::existeSesion()) {
            # code...
            require_once('app/resources/views/dashboard_gust.php');

        }else{

            require_once('app/resources/views/dashboard_auth.php');
        }
    }
}