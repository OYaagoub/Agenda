<?php 

require_once 'app/config/config.php';
require_once 'app/models/ConnexionDB.php';
require_once 'app/models/User.php';
require_once 'app/models/UsersDAO.php';
require_once 'app/models/Photo.php';
require_once 'app/models/PhotosDAO.php';
require_once 'app/models/Note.php';
require_once 'app/models/NotesDAO.php';
require_once 'app/controllers/ControllerDashboard.php';
require_once 'app/Controllers/ControllerNotes.php';
require_once 'app/Controllers/ControllerUsers.php';
require_once 'app/helpers/helper.php';
require_once 'app/models/Sesion.php';

//Uso de variables de sesión
session_start();

//Mapa de enrutamiento
$mapa = array(
    'inicio'=>array("Controller"=>'ControllerDashboard',
                    'metodo'=>'index',
                    'privada'=>false),
    'data'=>array("Controller"=>'ControllerNotes',
                    'metodo'=>'data',
                    'privada'=>true),
    'insert'=>array("Controller"=>'ControllerNotes',
                    'metodo'=>'insert',
                    'privada'=>true),
    'update'=>array("Controller"=>'ControllerNotes',
                    'metodo'=>'update',
                    'privada'=>true),
    'delete'=>array("Controller"=>'ControllerNotes',
                    'metodo'=>'delete',
                    'privada'=>true),
    'login'=>array("Controller"=>'ControllerUsers',
                    'metodo'=>'login',
                    'privada'=>false),
    'registrar'=>array("Controller"=>'ControllerUsers',
                    'metodo'=>'registrar',
                    'privada'=>false),
    'logout'=>array("Controller"=>'ControllerUsers',
                    'metodo'=>'logout',
                    'privada'=>true),
    'session'=>array("Controller"=>'ControllerUsers',
                    'metodo'=>'session',
                    'privada'=>true),
                    

             
);


if(isset($_GET['action'])){ 
    if(isset($mapa[$_GET['action']])){  
        $action = $_GET['action']; 
        
    }
    else{
        //La acción no existe
        header('Status: 404 Not found');
        echo 'Página no encontrada';
        die();
    }
}else{
    $action='inicio';   
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
// if(!isset($_SESSION['email']) && $mapa[$action]['privada']){
if(!Sesion::existeSesion() && $mapa[$action]['privada']){
    header('location: index.php');
    guardarMensaje("Debes iniciar sesión para acceder a $action");
    die();
}


//$acción ya tiene la acción a ejecutar, cogemos el Controller y metodo a ejecutar del mapa
$Controller = $mapa[$action]['Controller'];
$metodo = $mapa[$action]['metodo'];

//Ejecutamos el método de la clase Controller
$objeto = new $Controller();
$objeto->$metodo();