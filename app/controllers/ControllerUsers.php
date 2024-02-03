<?php 

Class ControllerUsers{
    public function registrar(){
        $error='';
        header('Content-Type: application/json');
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
            
            echo json_encode(['status' => 'false', 'message' => 'Ya hay un User con ese email']);
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
                        
                        echo json_encode(['status' => 'true', 'message' => 'User registrado']);

                        
                    }else{
                        
                        echo json_encode(['status'=>'false','message'=>'No se ha podido insertar el User']);
                    }
                }
            }
    
        }else{
            
            echo json_encode(['status' => 'false', 'message' => 'just post method']);
        }

        

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
                    
                    
                    //Redirigimos a index.php
                    echo json_encode(['status' => 'true', 'message' => 'login done succesffuly','sid'=>$User->getSid()]);
                }
            }else{

                echo json_encode(['status' => 'false', 'message' => 'email or password incorrect']);
            }
            
        }else{

            echo json_encode(['status' => 'false', 'message' => 'requierd post method']);

        }
    }

    public function logout(){
        if(Sesion::existeSesion()){

            Sesion::cerrarSesion();
            echo json_encode(['status' => 'true', 'message' => 'logout  done succesffuly']);
        }else{
            echo json_encode(['status' => 'false', 'message' => 'requierd logined in ']);
        }
        
    }
    public function session(){
            if(Sesion::existeSesion()){
                echo json_encode(['status' => 'true', 'message' => 'session done succesffuly','userName'=>Sesion::getUser()->getName()]);
            }
            
        }
    

}