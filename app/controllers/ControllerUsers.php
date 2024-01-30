<?php 

Class ControllerUsers{
    public function registrar(){
        $error='';

        if($_SERVER['REQUEST_METHOD']=='POST'){

            //Limpiamos los datos
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);
            $foto = '';

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

            //Copiamos la foto al disco
                if($_FILES['foto']['type'] != 'image/jpeg' &&
                $_FILES['foto']['type'] != 'image/webp' &&
                $_FILES['foto']['type'] != 'image/png')
                {
                    $error="la foto no tiene el formato admitido, debe ser jpg o webp";
                }
                else{
                    //Calculamos un hash para el nombre del archivo
                    $foto = generarNombreArchivo($_FILES['foto']['name']);

                    //Si existe un archivo con ese nombre volvemos a calcular el hash
                    while(file_exists("web/fotosUsers/$foto")){
                        $foto = generarNombreArchivo($_FILES['foto']['name']);
                    }

                    if(!move_uploaded_file($_FILES['foto']['tmp_name'], "web/fotosUsers/$foto")){
                        die("Error al copiar la foto a la carpeta fotosUsers");
                    }
                }


                if($error == '')    //Si no hay error
                {
                    //Insertamos en la BD

                    $User = new User();
                    $User->setEmail($email);
                    //encriptamos el password
                    $passwordCifrado = password_hash($password,PASSWORD_DEFAULT);
                    $User->setPassword($passwordCifrado);
                    $User->setphoto($foto);
                    $User->setSid(sha1(rand()+time()), true);

                    if($UsersDAO->insert($User)){
                        header("location: index.php");
                        die();
                    }else{
                        $error = "No se ha podido insertar el User";
                    }
                }
            }
    
        }   //Acaba if($_SERVER['REQUEST_METHOD']=='POST'){...}

        require 'app/vistas/registrar.php';

    }   // Acaba function registrar()

    public function login(){
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
    }

    public function logout(){
        Sesion::cerrarSesion();
        setcookie('sid','',0,'/');
        header('location: index.php');
    }

}