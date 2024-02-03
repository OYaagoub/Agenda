<?php

class ControllerNotes 
{
    
    public function data() {
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();
        $idIdUser = Sesion::getUser()->getId();
        $from = htmlspecialchars($_POST['from']);
        $to= htmlspecialchars($_POST['to']);
        $NotesDAO = new NotesDAO($conn);
        $notes = $NotesDAO->getAllByMonthYear($idIdUser, $from, $to);


        // Create the result array
        $result = ['status' => 'true', 'notes' => $notes];

        // Encode the array into JSON format
        $jsonResult = json_encode($result);

        // Print the JSON-encoded result
        echo $jsonResult;
        
       
    }
    public function insert(){
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();
        $idIdUser = Sesion::getUser()->getId();
        $NotesDAO = new NotesDAO($conn);
        $note = new Note();
        $note->setDatetime(cleanDateTime($_POST['datetime']));
        $note->setTitle(cleanString($_POST['title']));
        $note->setDescription(cleanString($_POST['description']));
        $note->setIdUser($idIdUser);
        $id=$NotesDAO->insert($note);
        
        if($id===false){
            echo json_encode(['status'=>'false']);
            
        }else{
            $result=['status'=>'true','id'=>$id,'note'=>$note->toArray()];
            // Encode the array into JSON format
            $jsonResult = json_encode($result);

            // Print the JSON-encoded result
            echo $jsonResult;
        }
        
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
        $note=$NotesDAO->getById($id);
        if($note==null){
            print json_encode(['status'=>'false','id'=>$id]);
        }else{
            $NotesDAO->delete($note);
            print json_encode(['status'=>'true','note'=>$note->toArray()]);
        }

        
    }

}