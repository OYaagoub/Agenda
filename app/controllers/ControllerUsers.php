<?php 

Class ControllerUsers{
    public function registrar(){
        $error='';

        if($_SERVER['REQUEST_METHOD']=='POST'){

            //Limpiamos los datos
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);
            $name = htmlentities($_POST['name']);
            

            //Validación 

            //Conectamos con la BD
            $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
            $conn = $connexionDB->getConnexion();

            //Compruebo que no haya un User registrado con el mismo email
            $UsersDAO = new UsersDAO($conn);
            if($UsersDAO->getByEmail($email) != null){
            $error = "Ya hay un User con ese email";
            }
            else{

            


                if($error == '')    //Si no hay error
                {
                    //Insertamos en la BD

                    $User = new User();
                    $User->setEmail($email);
                    //encriptamos el password
                    $passwordCifrado = password_hash($password,PASSWORD_DEFAULT);
                    $User->setPassword($passwordCifrado);
                    $User->setName($name);
                    $User->setSid(sha1(rand()+time()), true);

                    if($UsersDAO->insert($User)){
                        header("location: /");
                        die();
                    }else{
                        $error = "No se ha podido insertar el User";
                    }
                }
            }
    
        }   //Acaba if($_SERVER['REQUEST_METHOD']=='POST'){...}

        require 'app/resources/views/register.php';

    }   // Acaba function registrar()

    public function login(){

        if($_SERVER['REQUEST_METHOD']=='POST'){
            //Creamos la conexión utilizando la clase que hemos creado
            $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
            $conn = $connexionDB->getConnexion();

            //limpiamos los datos que vienen del User
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            //Validamos el User
            $UsersDAO = new UsersDAO($conn);
            if($User = $UsersDAO->getByEmail($email)){
                if(password_verify($password, $User->getPassword()))
                {
                    //email y password correctos. Inciamos sesión
                    Sesion::iniciarSesion($User);
            
                    //Creamos la cookie para que nos recuerde 1 semana
                    setcookie('sid',$User->getSid(),time()+24*60*60,'/');
                    
                    //Redirigimos a index.php
                    header('location: index.php');
                    die();
                }
            }
            //email o password incorrectos, redirigir a index.php
            guardarMensaje("Email o password incorrectos");
            header('location: index.php');
        }else{

            require_once 'app/resources/views/login.php';
        }
    }

    public function logout(){
        Sesion::cerrarSesion();
        setcookie('sid','',0,'/');
        header('location: index.php');
    }

}