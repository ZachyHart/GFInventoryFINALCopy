<?php
require_once '../libraries/CustomerDatabase.php';

class CustomerResetPassword{
    private $db;

    public function __construct(){
        $this->db = new CustomerDatabase;
    }

    public function deleteEmail($email){
        $this->db->query('DELETE FROM customerpwdreset WHERE cpwdResetEmail=:email');
        $this->db->bind(':email',$email);
        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function insertToken($email, $selector, $hashedToken, $expires){
        $this->db->query('INSERT INTO customerpwdreset (cpwdResetEmail, cpwdResetSelector, cpwdResetToken, 
        cpwdResetExpires) VALUES (:email, :selector, :token, :expires)');
        $this->db->bind(':email', $email);
        $this->db->bind(':selector', $selector);
        $this->db->bind(':token', $hashedToken);
        $this->db->bind(':expires', $expires);
        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function resetPassword($selector, $currentDate){
        $this->db->query('SELECT * FROM customerpwdreset WHERE  cpwdResetSelector=:selector AND cpwdResetExpires >= :currentDate');
        $this->db->bind(':selector',$selector);
        $this->db->bind(':currentDate',$currentDate);
        //Execute
        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }
}