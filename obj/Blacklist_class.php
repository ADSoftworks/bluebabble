<?php

/*
 * @author Bob Desaunois
 */
class Blacklist {
    
    public static function getInstance() {
        
        return new Blacklist();
        
    }
    
    public function get() {
        
        global $link;
        
        $sql = "SELECT words "
             . "FROM blacklists "
             . "WHERE username = :username "
             . "LIMIT 1;";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(":username", User::getName(), PDO::PARAM_STR); //OOPify this
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result ? $result["words"] : false;
        
    }
    
    public function getAsArray() {
        
        $words = $this->get();
        
        $words_array = explode(" ", $words);
        
        return $words_array ? $words_array : false;
        
    }
    
    public function removeWord($inputted_word) {
        
        $words = $this->get();
        
        $words_array    = explode(" ", $words);
        
        //remove a word that's already in there.
        $count = 0;
        foreach($words_array as &$value) {
            
            if($value == $inputted_word) {
                unset($words_array[$count]);
            }
            
        }
                
            $words = implode(" ", $words_array);
                
            die(var_dump($words));
            
            global $link;
            $sql = "UPDATE backlists "
                    . "SET words = :newwords "
                    . "WHERE username = :username;";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(":newwords", $words, PDO::PARAM_STR);
            $stmt->bindParam(":username", User::getName(), PDO::PARAM_STR); //OOPify this
            $stmt->execute();
            $stmt->closeCursor();
        
    }
    
    public function wordIsOnBlacklist($word) {
        
        $words = $this->get();
        $words_array = explode(" ", $words);
        
        foreach($words_array as &$value) if($value == $word) return true;
        
    }
    
    public function add($word) {
        
        $words = $this->get();
        
//        if word already is in list, remove it.
          if($this->wordIsOnBlacklist($word)) {
              
            $this->removeWord($word);
            
          } else {
        
            if($words)
                $new_words = $words . " " . $word;
            else
                $new_words = $word;

            global $link;

            if($words) {
                $sql = "UPDATE blacklists "
                     . "SET words = :newwords "
                     . "WHERE username = :username;";
            } else {

//                die("Tried to do an insert."); //TESTING

                $sql = "INSERT INTO blacklists(words, username) "
                     . "VALUES(:newwords, :username);";
            }

            $stmt = $link->prepare($sql);
            $stmt->bindParam(":newwords", $new_words, PDO::PARAM_STR);
            $stmt->bindParam(":username", User::getName(), PDO::PARAM_STR); //OOPify this
            $stmt->execute();
            $stmt->closeCursor();    
        
        }
    
    }

}

?>