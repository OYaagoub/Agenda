<?php

class Photo{

    private $id;
    private $nombreArchivo;
    private $idUser;

    

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombreArchivo
     */
    public function getNombreArchivo()
    {
        return $this->nombreArchivo;
    }

    /**
     * Set the value of nombreArchivo
     */
    public function setNombreArchivo($nombreArchivo): self
    {
        $this->nombreArchivo = $nombreArchivo;

        return $this;
    }

    /**
     * Get the value of idUser
     */
    public function getidUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     */
    public function setidUser($idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
}