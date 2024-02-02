<?php

class ControllerDashboard 
{
    
    function index() {
        if (!Sesion::existeSesion()) {
            # code...
            require_once('app/resources/views/dashboard_auth.php');

        }else{

            require_once('app/resources/views/dashboard_auth.php');
        }
    }
}