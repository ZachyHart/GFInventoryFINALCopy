<?php
include_once './helpers/session_helper.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Got Funko Collections</title>
    <!-- Cool Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Our stylesheet -->
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div id="form_container" class="col-md-6">
                <div id="form_header_container" class="text-center">
                    <div id="logo_container">
                        <img id="logo" src="img/CircularLogo.jpg" alt="Logo" class="img-fluid">
                    </div>
                    <h1 id="form_header" class="text-center mt-3">Customer Login</h1>
                </div>


                <form class="form" method="post" name="login" action="./controllers/CustomerUsers.php">
                    <div id="form_content_container" class="bg-white p-4 rounded">
                        <div id="form_content_inner_container">
                            <input type="hidden" name="type" value="login_user">
                            <input type="hidden" name="role" value="user"/>
                            <input type="text" class="form-control mb-3" name="name/email"
                                placeholder="Username/Email..." autofocus="true" />
                            <input type="password" class="form-control mb-3" name="usersPwd"
                                placeholder="Password..." />
                            <a href="./Customerreset-password.php" id="forgot_password"
                                data-target="#forgotPasswordModal" div class="form-sub-msg">Forgot Password?</a>

                            <div id="button_container" class="text-center mt-3" name="submit">
                                <button type="submit" button class="btn btn-primary">LOG IN</button>
                            </div>
                        </div>

                        <p id="create_account_text" class="text-center mt-3">Don't have an account? <br> Create a new
                            one <a href="Customersignup.php"> here</a></p>

                </form>


                <!-- Bootstrap and other scripts -->
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                <!-- ... (other scripts and closing tags) ... -->
</body>

</html>