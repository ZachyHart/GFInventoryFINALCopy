<?php
require_once '../libraries/CustomerDatabase.php';

class CustomerUser
{

    private $db;

    public function __construct()
    {
        $this->db = new CustomerDatabase;
    }
    //Find user by email or username
    public function findUserByEmailOrUsername($email, $username, $role)
    {
        
            $this->db->query('SELECT * FROM customerusers WHERE usersUid = :username OR usersEmail = :email');
            $this->db->bind(':username', $username);
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            //Check row
            if ($this->db->rowCount() > 0) {
                return $row;
            } else {
                return false;
            }
       
    }

    //Register User
    public function register($data)
    {
        $this->db->query('INSERT INTO Customerusers (usersName, usersEmail, usersUid, usersPwd, confirmToken) 
        VALUES (:name, :email, :Uid, :password, :token)');
        //Bind values
        $this->db->bind(':name', $data['usersName']);
        $this->db->bind(':email', $data['usersEmail']);
        $this->db->bind(':Uid', $data['usersUid']);
        $this->db->bind(':password', $data['usersPwd']);
        $this->db->bind(':token', $data['confirmToken']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Login user
    public function login($nameOrEmail, $password, $role)
    {
        $row = $this->findUserByEmailOrUsername($nameOrEmail, $nameOrEmail, $role);

        if ($row == false)
            return false;

        $hashedPassword = $row->usersPwd;
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function isConfirmed($nameOrEmail)
    {
        $row = $this->findUserByEmailOrUsername($nameOrEmail, $nameOrEmail, $role);

        if ($row == false)
            return false;

        $confirmToken = $row->confirmToken;
        if ($confirmToken == 'confirmed') {
            return true;
        } else {
            return false;
        }
    }

    //Reset Password
    public function resetPassword($newPwdHash, $tokenEmail)
    {
        $this->db->query('UPDATE Customerusers SET usersPwd=:pwd WHERE usersEmail=:email');
        $this->db->bind(':pwd', $newPwdHash);
        $this->db->bind(':email', $tokenEmail);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function confirm($token)
    {
        $this->db->query('SELECT * FROM customerusers WHERE confirmToken = :token');
        $this->db->bind(':token', $token);

        $row = $this->db->single();

        //Check row
        if ($this->db->rowCount() > 0) {
            $this->db->query('UPDATE customerusers SET confirmToken = "confirmed" WHERE confirmToken = :token');
            $this->db->bind(':token', $token);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}