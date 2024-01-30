<?php

class PhotoDAO
{
    private mysqli $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insert($foto)
    {
        if (!$stmt = $this->conn->prepare("INSERT INTO photos (nombreArchivo, idUser) VALUES (?,?)")) {
            die("Error al preparar la consulta insert: " . $this->conn->error);
        }
        $nombreArchivo = $foto->getNombreArchivo();
        $idUser = $foto->getidUser();
        $stmt->bind_param('si', $nombreArchivo, $idUser);
        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    /**
     * 
     */
    public function delete($foto)
    {
        if (!$stmt = $this->conn->prepare("DELETE FROM photos WHERE id = ?")) {
            die("Error al preparar la consulta delete: " . $this->conn->error);
        }
        $id = $foto->getId();
        $stmt->bind_param('i', $id);
        $stmt->execute();
        if ($stmt->affected_rows >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllByidUser($idUser)
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM photos WHERE idUser=?")) {
            die("Error al preparar la consulta delete: " . $this->conn->error);
        }
        $stmt->bind_param('i', $idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        $Photo = array();
        while ($foto = $result->fetch_object(Photo::class)) {
            $Photo[] = $foto;
        }
        return $Photo;
    }
}
