<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once '../models/CustomerUser.php';
require_once '../helpers/session_helper.php';
//Require PHP Mailer
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/SMTP.php';

class CustomerUsers
{

    private $userModel;

    public function __construct()
    {
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

    public function register()
    {
        //Process form

        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Will be used for confirmation once the database entry has been matched
        $randomBytes = random_bytes(32);
        $token = bin2hex($randomBytes);
        $url = 'http://localhost/GFInventoryFINAL/controllers/CustomerUsers.php?type=confirm&token=' . $token;

        //Init data
        $data = [
            'usersName' => trim($_POST['usersName']),
            'usersEmail' => trim($_POST['usersEmail']),
            'usersUid' => trim($_POST['usersUid']),
            'usersPwd' => trim($_POST['usersPwd']),
            'pwdRepeat' => trim($_POST['pwdRepeat']),
            'role' => 'user',
            'confirmToken' => $token
        ];

        //Validate inputs
        if (
            empty($data['usersName']) || empty($data['usersEmail']) || empty($data['usersUid']) ||
            empty($data['usersPwd']) || empty($data['pwdRepeat'])
        ) {
            echo '<script>
                alert("Please fill out all inputs");
                window.location.href = "../Customersignup.php";
              </script>';
        }

        if (!preg_match("/^[a-zA-Z0-9]*$/", $data['usersUid'])) {
            echo '<script>
                alert("Invalid username");
                window.location.href = "../Customersignup.php";
              </script>';
        }

        if (!filter_var($data['usersEmail'], FILTER_VALIDATE_EMAIL)) {
            echo '<script>
                alert("Invalid email");
                window.location.href = "../Customersignup.php";
              </script>';
        }

        if (strlen($data['usersPwd']) < 6) {
            echo '<script>
                alert("Invalid password");
                window.location.href = "../Customersignup.php";
              </script>';
        } else if ($data['usersPwd'] !== $data['pwdRepeat']) {
            echo '<script>
                alert("Passwords don\'t match");
                window.location.href = "../Customersignup.php";
              </script>';
        }

        //User with the same email or password already exists
        if ($this->userModel->findUserByEmailOrUsername($data['usersEmail'], $data['usersName'], $data['role'])) {
            echo '<script>
                alert("Username or email already taken");
                window.location.href = "../Customersignup.php";
              </script>';
        }

        //Passed all validation checks.
        //Now going to hash password
        $data['usersPwd'] = password_hash($data['usersPwd'], PASSWORD_DEFAULT);

        //Register User
        if ($this->userModel->register($data)) {
            //Can Send Email Now
            $subject = "Account creation confirmation";
            $message = "<p>We recieved an account creation request.</p>";
            $message .= "<p>Here is your account creation confirmation link: </p>";
            $message .= "<a href='" . $url . "'>" . $url . "</a>";

            $this->mail->setFrom('TheBoss@gmail.com');
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $message;
            $this->mail->addAddress(trim($_POST['usersEmail']));

            $this->mail->send();

            $_SESSION['flash-msg'] = 'success-creation';
            redirect("../customerinventory.php");
        } else {
            die("Something went wrong");
        }
    }

    public function login($role)
    {
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'name/email' => trim($_POST['name/email']),
            'usersPwd' => trim($_POST['usersPwd']),
            'role' => $role
        ];

        if (empty($data['name/email']) || empty($data['usersPwd'])) {
            echo '<script>
            alert("Please fill out all inputs");
            window.location.href = "../customerinventory.php";
          </script>';
            exit();
        }

        //Check for user/email
        if ($this->userModel->findUserByEmailOrUsername($data['name/email'], $data['name/email'], $data['role'])) {
            //User Found
            $loggedInUser = $this->userModel->login($data['name/email'], $data['usersPwd'], $data['role']);
            if ($loggedInUser) {
                //Create session
                if($this->userModel->isConfirmed($data['name/email'], $data['name/email'], $data['role'])){
                    $this->createUserSession($loggedInUser, $role);
                }else{
                    $_SESSION['flash-msg'] = 'account-unconfirmed';
                    redirect("../customerinventory.php");
                }
            } else {
                echo '<script>
                alert("Password Incorrect");
                window.location.href = "../customerinventory.php";
              </script>';
            }
        } else {
            if ($role === 'admin') {
                echo '<script>
                    alert("admin not found");
                    window.location.href = "../login.php";
                  </script>';
            } else {
                echo '<script>
                    alert("user not found");
                    window.location.href = "../customerinventory.php";
                  </script>';
            }
        }
    }

    public function confirmToken()
    {
        $token = trim($_GET['token']);

        if($this->userModel->confirm($token)){
            $_SESSION['flash-msg'] = 'confirmed-creation';
            redirect("../customerinventory.php");
        }else{
            $_SESSION['flash-msg'] = 'invalid-token';
            redirect("../customerinventory.php");
            die("Something went wrong");
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['usersId'] = $user->usersId;
        $_SESSION['usersName'] = $user->usersName;
        $_SESSION['usersEmail'] = $user->usersEmail;
        $_SESSION['role'] = 'user';
        redirect("../CustomerFeedback.php");
    }

    public function logout()
    {
        unset($_SESSION['usersId']);
        unset($_SESSION['usersName']);
        unset($_SESSION['usersEmail']);
        unset($_SESSION['role']);
        session_destroy();
        redirect("../CustomerFeedback.php");
    }
}

$init = new CustomerUsers;

//Ensure that user is sending a post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'register':
            $init->register();
            echo 'Hello';
            break;
        case 'login_admin':
            $init->login('admin');
            break;
        case 'login_user':
            $init->login('user');
            break;
        case 'logout':
            $init->logout();
            break;
        default:
            redirect("../customerinventory.php");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    switch ($_GET['type']) {
        case 'confirm':
            $init->confirmToken();
            break;
        default:
            redirect("../customerinventory.php");
    }
}