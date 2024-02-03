<?php 

class Note {
    private $id;
    private $title;
    private $discription;
    private $datetime;
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
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of discription
     */
    public function getDescription()
    {
        return $this->discription;
    }

    /**
     * Set the value of discription
     */
    public function setDescription($discription): self
    {
        $this->discription = $discription;

        return $this;
    }

    /**
     * Get the value of idUser
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     */
    public function setIdUser($idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of datetime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set the value of datetime
     */
    public function setDatetime($datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }



    /**
     * Convert the Note object to an associative array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->discription, // Corrected the spelling mistake in the property name
            'idUser' => $this->idUser,
            'datetime' => $this->datetime,
        ];
    }
}