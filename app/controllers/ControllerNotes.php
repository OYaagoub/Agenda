<?php

class ControllerNotes 
{
    
    public function data() {
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();
        $idIdUser = Sesion::getUser()->getId();
        $NotesDAO = new NotesDAO($conn);
        print json_encode(['status'=>'ok','notes'=>$NotesDAO->getById($idIdUser)]);
        
       
    }
    public function insert(){
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();
        $idIdUser = Sesion::getUser()->getId();
        $NotesDAO = new NotesDAO($conn);
        $note = new Note();
        $note->setDatetime(cleanString($_POST['datetime']));
        $note->setTitle(cleanString($_POST['title']));
        $note->setDescription(cleanString($_POST['description']));
        $note->setIdUser($idIdUser);
        $NotesDAO->insert($note);
        print json_encode(['status'=>$NotesDAO->insert($note)]);
    }
    public function update(){
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();
        $NotesDAO = new NotesDAO($conn);
        $note = new Note();
        $note->setId(cleanId($_POST['id']));
        $note->setDatetime(cleanString($_POST['datetime']));
        $note->setTitle(cleanString($_POST['title']));
        $note->setDescription(cleanString($_POST['description']));
        $NotesDAO->update($note);
        print json_encode(['status'=>$NotesDAO->update($note)]);
    }
    public function delete(){
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();
        $NotesDAO = new NotesDAO($conn);

        $id=cleanId($_POST['id']);

        
        print json_encode(['status'=>$NotesDAO->delete($id)]);
    }

}