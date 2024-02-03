<?php

class NotesDAO {
    private mysqli $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Obtiene un note de la BD en función del id
     * @return note Devuelve un Objeto de la clase note o null si no existe
     */
    public function getById($id):Note|null {
        if(!$stmt = $this->conn->prepare("SELECT * FROM notes WHERE id = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Asociar las variables a las interrogaciones(parámetros)
        $stmt->bind_param('i',$id);
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        //Si ha encontrado algún resultado devolvemos un objeto de la clase Mensaje, sino null
        if($result->num_rows >= 1){
            $note = $result->fetch_object(Note::class);
            return $note;
        }
        else{
            return null;
        }
    } 



 

    /**
     * Obtiene todos los note de la tabla mensajes
     */
    public function getAllByMonthYear($idUser,$from,$to):array {
        if(!$stmt = $this->conn->prepare("SELECT * FROM notes WHERE idUser=? AND datetime BETWEEN ? AND ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Ejecutamos la SQL
        $stmt->bind_param('iss', $idUser,$from,$to);
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        $array_note = array();
        
        while($note = $result->fetch_object(Note::class)){
            $array_note[] = $note;
        }
        return $array_note;
    }


    /**
     * Inserta en la base de datos el note que recibe como parámetro
     * @return idNote Devuelve el id autonumérico que se le ha asignado al note o false en caso de error
     */
    function insert(Note $note): int|bool{
        if(!$stmt = $this->conn->prepare("INSERT INTO notes (datetime , title , description , idUser) VALUES (?,?,?,?)")){
            die("Error al preparar la consulta insert: " . $this->conn->error );
        }
        $idUser = $note->getIdUser();
        $datetime = $note->getDatetime();
        $title = $note->getTitle();
        $description = $note->getDescription();
 
        $stmt->bind_param('sssi',$datetime, $title, $description, $idUser);
        if($stmt->execute()){
            return $stmt->insert_id;
        }
        else{
            return false;
        }
    }
    function update(Note $note): bool {
        if (!$stmt = $this->conn->prepare("UPDATE notes SET datetime=?, title=?, description=? WHERE id=?")) {
            die("Error al preparar la consulta update: " . $this->conn->error);
        }
    
        $idUser = $note->getIdUser();
        $datetime = $note->getDatetime();
        $title = $note->getTitle();
        $description = $note->getDescription();
        $id = $note->getId(); // Assuming there is a method getId() in your Note class to get the note ID.
    
        $stmt->bind_param('sssi', $datetime, $title, $description, $id);
    
        return $stmt->execute();
    }
    function delete(Note $note): bool {
    if (!$stmt = $this->conn->prepare("DELETE FROM notes WHERE id=?")) {
        die("Error al preparar la consulta delete: " . $this->conn->error);
    }

    $id = $note->getId(); // Assuming there is a method getId() in your Note class to get the note ID.

    $stmt->bind_param('i', $id);

    return $stmt->execute();
}

    
}
?>
