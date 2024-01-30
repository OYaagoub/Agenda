<?php 
class Sesion{
    static public function getUser():User|false{
        if(isset($_SESSION['User'])){
            return unserialize($_SESSION['User']); 
        }else{
            return false;
        }
    }

    static public function iniciarSesion($User){
        $_SESSION['User'] = serialize($User);
    }

    static public function cerrarSesion(){
        unset($_SESSION['User']);
        
    }

    static public function existeSesion(){
        if(isset($_SESSION['User'])){
            return true;
        }else{
            return false;
        }
    }
}
/**
 * Para iniciar sesión: Sesion::iniciarSesion($User);
 * Para cerrar sesión: Sesion::cerrarSesion();
 * Para obtener el User: Sesion::getUser()
 * Para obener una propiedad del User: Sesion::getUser()->getFoto()
 * Para comprobar si se ha iniciado sesión: if(Sesion::getUser())...
 */