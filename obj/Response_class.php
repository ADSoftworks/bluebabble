<?php

/*
 * @author Bob Desaunois
 */
class Response {
    
    private $id;
    private $response_content;
    private $original_message;
    
    public function __construct() {
    }
    
    public function markAsReadById($id) {
    }
   
    private function getOneResponse() {
        
        global $link;
        
        $sql = "SELECT * FROM responses WHERE receiver = :username AND seen = 0 ORDER BY id LIMIT 1;";
        $statement = $link->prepare($sql);
        $statement->bindParam(":username", $_SESSION["username"], PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        
        return $result;
        
    }
    
    private function getAllResponses() {
        
        global $link;
        
        $sql = "SELECT * FROM responses WHERE receiver = :username AND seen = 0 ORDER BY id;";
        $statement = $link->prepare($sql);
        $statement->bindParam(":username", $_SESSION["username"], PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        
        return $result;
        
    }
    
    public function getNumberOfResponses() {
        
        global $link;
        
        $result = $this->getAllResponses();
        
        return sizeof($result);
        
    }
    
    public function ifNewResponses() {
    }
    
    public static function getInstance() {
        
        return new Response();
        
    }
    
}

?>