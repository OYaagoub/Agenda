<?php 

class User {
    private $id;
    private $email;
    private $password;
    private $photo;
    private $sid;
    

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
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of photo
     */
    public function getphoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     */
    public function setphoto($photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of sid
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * Set the value of sid
     */
    public function setSid($sid): self
    {
        $this->sid = $sid;

        return $this;
    }
}