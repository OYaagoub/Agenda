<?php 

require_once 'app/config/config.php';
require_once 'app/models/ConnexionDB.php';
require_once 'app/models/User.php';
require_once 'app/models/UsersDAO.php';
require_once 'app/models/Photo.php';
require_once 'app/models/PhotosDAO.php';
require_once 'app/Controlleres/ControllerUsers.php';
require_once 'app/helpers/helper.php';
require_once 'app/models/Sesion.php';

//Uso de variables de sesión
session_start();

//Mapa de enrutamiento
$mapa = array(
    'inicio'=>array("Controller"=>'ControllerMensajes',
                    'metodo'=>'inicio',
                    'privada'=>false),
    'ver_mensaje'=>array("Controller"=>'ControllerMensajes',
                         'metodo'=>'ver', 
                         'privada'=>false),
    'insertar_mensaje'=>array('Controller'=>'ControllerMensajes',
                              'metodo'=>'insertar', 
                              'privada'=>true),
    'borrar_mensaje'=>array('Controller'=>'ControllerMensajes',
                            'metodo'=>'borrar', 
                            'privada'=>true),
    'editar_mensaje'=>array('Controller'=>'ControllerMensajes',
                            'metodo'=>'editar', 
                            'privada'=>true),
    'login'=>array('Controller'=>'ControllerUsers', 
                   'metodo'=>'login', 
                   'privada'=>false),
    'logout'=>array('Controller'=>'ControllerUsers', 
                    'metodo'=>'logout', 
                    'privada'=>true),
    'registrar'=>array('Controller'=>'ControllerUsers', 
                       'metodo'=>'registrar', 
                       'privada'=>false),
    'insertar_favorito'=>array('Controller'=>'ControllerFavoritos', 
                       'metodo'=>'insertar', 
                       'privada'=>false),                       
    'borrar_favorito'=>array('Controller'=>'ControllerFavoritos', 
                       'metodo'=>'borrar', 
                       'privada'=>false),
    'addImageMensaje'=>array('Controller'=>'ControllerMensajes', 
                       'metodo'=>'addImageMensaje', 
                       'privada'=>false),
    'deleteImageMensaje'=>array('Controller'=>'ControllerMensajes', 
                       'metodo'=>'deleteImageMensaje', 
                       'privada'=>false),                       
);


if(isset($_GET['accion'])){ 
    if(isset($mapa[$_GET['accion']])){  
        $accion = $_GET['accion']; 
    }
    else{
        //La acción no existe
        header('Status: 404 Not found');
        echo 'Página no encontrada';
        die();
    }
}else{
    $accion='inicio';   
}


if( !Sesion::existeSesion() && isset($_COOKIE['sid'])){
    //Conectamos con la bD
    $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
    $conn = $connexionDB->getConnexion();
    
    //Nos conectamos para obtener el id y la foto del User
    $UsersDAO = new UsersDAO($conn);
    if($User = $UsersDAO->getBySid($_COOKIE['sid'])){
        //$_SESSION['email']=$User->getEmail();
        //$_SESSION['id']=$User->getId();
        //$_SESSION['foto']=$User->getFoto();
        Sesion::iniciarSesion($User);
    }
    
}

//Si la acción es privada compruebo que ha iniciado sesión, sino, lo echamos a index
// if(!isset($_SESSION['email']) && $mapa[$accion]['privada']){
if(!Sesion::existeSesion() && $mapa[$accion]['privada']){
    header('location: index.php');
    guardarMensaje("Debes iniciar sesión para acceder a $accion");
    die();
}


//$acción ya tiene la acción a ejecutar, cogemos el Controller y metodo a ejecutar del mapa
$Controller = $mapa[$accion]['Controller'];
$metodo = $mapa[$accion]['metodo'];

//Ejecutamos el método de la clase Controller
$objeto = new $Controller();
$objeto->$metodo();