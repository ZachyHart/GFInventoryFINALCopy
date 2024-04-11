<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once '../models/CustomerResetPassword.php';
require_once '../helpers/session_helper.php';
require_once '../models/CustomerUser.php';
//Require PHP Mailer
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/SMTP.php';

class CustomerResetPasswords{
    private $resetModel;
    private $userModel;
    private $mail;
    
    public function __construct(){
        $this->resetModel = new CustomerResetPassword;
        $this->userModel = new CustomerUser;
        //Setup PHPMailer
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Port = 587;
        $this->mail->Username = 'lgaforpeople@gmail.com';
        $this->mail->Password = 'idewfsnhmfrzwzsx';
    }

    public function sendEmail(){
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $usersEmail = trim($_POST['usersEmail']);

        if(empty($usersEmail)){
            echo '<script>
            alert("Please input email");
            window.location.href = "../Customerreset-password.php";
          </script>';
        }

        if(!filter_var($usersEmail, FILTER_VALIDATE_EMAIL)){
            echo '<script>
            alert("Invalid email");
            window.location.href = "../Customerreset-password.php";
          </script>';
        }
        //Will be used to query the user from the database
        $selector = bin2hex(random_bytes(8));
        //Will be used for confirmation once the database entry has been matched
        $token = random_bytes(32);
        //URL will vary depending on where the website is being hosted from
        $url = 'http://localhost/GFInventoryFINAL/Customercreate-new-password.php?selector='.$selector.'&validator='.bin2hex($token);
        //Expiration date will last for half an hour
        $expires = date("U") + 1800;
        if(!$this->resetModel->deleteEmail($usersEmail)){
            die("There was an error");
        }
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        if(!$this->resetModel->insertToken($usersEmail, $selector, $hashedToken, $expires)){
            die("There was an error");
        }
        //Can Send Email Now
        $subject = "Reset your password";
        $message = "<p>We recieved a password reset request.</p>";
        $message .= "<p>Here is your password reset link: </p>";
        $message .= "<a href='".$url."'>".$url."</a>";

        $this->mail->setFrom('TheBoss@gmail.com');
        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        $this->mail->addAddress($usersEmail);

        $this->mail->send();

        echo '<script>
        alert("Check your email");
        window.location.href = "../Customerreset-password.php";
      </script>';
    }

    public function resetPassword(){
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'selector' => trim($_POST['selector']),
            'validator' => trim($_POST['validator']),
            'pwd' => trim($_POST['pwd']),
            'pwd-repeat' => trim($_POST['pwd-repeat'])
        ];
        $url = '../Customercreate-new-password.php?selector='.$data['selector'].'&validator='.$data['validator'];
    
        if(empty($_POST['pwd'] || $_POST['pwd-repeat'])){
            echo '<script>
                    alert("Please fill out all fields");
                    window.location.href = "'.$url.'";
                  </script>';
            exit;
        } else if($data['pwd'] != $data['pwd-repeat']){
            echo '<script>
                    alert("Passwords do not match");
                    window.location.href = "'.$url.'";
                  </script>';
            exit;
        } else if(strlen($data['pwd']) < 6){
            echo '<script>
                    alert("Invalid password");
                    window.location.href = "'.$url.'";
                  </script>';
        }
    
        $currentDate = date("U");
        if (!$row = $this->resetModel->resetPassword($data['selector'], $currentDate)) {
            echo '<script>
                    alert("Sorry. The link is no longer valid");
                    window.location.href = "' . $url . '";
                  </script>';
            exit;
        }
    
        $tokenBin = hex2bin($data['validator']);
        $tokenCheck = password_verify($tokenBin, $row->cpwdResetToken);
        if (!$tokenCheck) {
            echo '<script>
                    alert("You need to re-submit your reset request");
                    window.location.href = "' . $url . '";
                  </script>';
            exit;
        }
    
        $tokenEmail = $row->cpwdResetEmail;
        $role = $_POST['role'];
        if (!$this->userModel->findUserByEmailOrUsername($tokenEmail, $tokenEmail, $role)) {
            echo '<script>
                    alert("There was an error");
                    window.location.href = "' . $url . '";
                  </script>';
            exit;
        }
    
        $newPwdHash = password_hash($data['pwd'], PASSWORD_DEFAULT);
        if (!$this->userModel->resetPassword($newPwdHash, $tokenEmail)) {
            echo '<script>
                    alert("There was an error");
                    window.location.href = "' . $url . '";
                  </script>';
            exit;
        }
    
        if (!$this->resetModel->deleteEmail($tokenEmail)) {
            echo '<script>
                    alert("There was an error");
                    window.location.href = "' . $url . '";
                  </script>';
            exit;
        }
    
        echo '<script>
                alert("Password Updated");
                window.location.href = "../CustomerInventory.php";
              </script>';
        exit;
    }
}

$init = new CustomerResetPasswords;

//Ensure that user is sending a post request
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    switch($_POST['type']){
        case 'send':
            $init->sendEmail();
            break;
        case 'reset':
            $init->resetPassword();
            break;
        default:
        header("location: ../index.php");
    }
}else{
    header("location: ../index.php");
}