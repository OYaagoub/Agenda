<?php

class UsersDAO {
    private mysqli $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Obtiene un User de la BD en función del email
     * @return User Devuelve un Objeto de la clase User o null si no existe
     */
    public function getByEmail($email):User|null {
        if(!$stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Asociar las variables a las interrogaciones(parámetros)
        $stmt->bind_param('s',$email);
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        //Si ha encontrado algún resultado devolvemos un objeto de la clase Mensaje, sino null
        if($result->num_rows >= 1){
            $User = $result->fetch_object(User::class);
            return $User;
        }
        else{
            return null;
        }
    } 


    public function getBySid($sid):User|null {
        if(!$stmt = $this->conn->prepare("SELECT * FROM users WHERE sid = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Asociar las variables a las interrogaciones(parámetros)
        $stmt->bind_param('s',$sid);
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        //Si ha encontrado algún resultado devolvemos un objeto de la clase Mensaje, sino null
        if($result->num_rows >= 1){
            $User = $result->fetch_object(User::class);
            return $User;
        }
        else{
            return null;
        }
    } 

    public function getById($id):User|null {
        if(!$stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Asociar las variables a las interrogaciones(parámetros)
        $stmt->bind_param('s',$id);
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        //Si ha encontrado algún resultado devolvemos un objeto de la clase Mensaje, sino null
        if($result->num_rows >= 1){
            $User = $result->fetch_object(User::class);
            return $User;
        }
        else{
            return null;
        }
    } 

    /**
     * Obtiene todos los User de la tabla mensajes
     */
    public function getAll():array {
        if(!$stmt = $this->conn->prepare("SELECT * FROM users"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        $array_mensajes = array();
        
        while($User = $result->fetch_object(User::class)){
            $array_User[] = $User;
        }
        return $array_User;
    }


    /**
     * Inserta en la base de datos el User que recibe como parámetro
     * @return idUser Devuelve el id autonumérico que se le ha asignado al User o false en caso de error
     */
    function insert(User $User): int|bool{
        if(!$stmt = $this->conn->prepare("INSERT INTO users (email, password, name ,sid) VALUES (?,?,?)")){
            die("Error al preparar la consulta insert: " . $this->conn->error );
        }
        $email = $User->getEmail();
        $password = $User->getPassword();
        $name = $User->getName();
        $sid = $User->getSid();
        $stmt->bind_param('ssss',$email, $password, $name,$sid);
        if($stmt->execute()){
            return $stmt->insert_id;
        }
        else{
            return false;
        }
    }
}
?>
