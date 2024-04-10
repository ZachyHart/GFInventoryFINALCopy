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
                    <div class="w-100 d-flex">
                        <a href="./customerlogin.php"><button class="btn btn-primary mt-2 text">back</button></a>
                    </div>
                    <div id="logo_container">
                        <img id="logo" src="img/CircularLogo.jpg" alt="Logo" class="img-fluid">
                    </div>
                    <h1 id="form_header" class="text-center mt-3">Reset Password</h1>
                    </div>


    <form method="post" action="./controllers/CustomerResetPasswords.php">
        <div id="form_content_container" class="bg-white p-4 rounded">
        <div id="form_content_inner_container">
        <input type="hidden" name="type" value="send" />
        <input type="text" class="form-control mb-3" name="usersEmail" placeholder="Email" autofocus="true"/>
        <br><br>
        <div id="button_container" class="text-center mt-3" name="submit">
                            <button type="submit" button class="btn btn-primary">RECEIVE EMAIL</button>

    </form>





    <!-- Bootstrap and other scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- ... (other scripts and closing tags) ... -->
</body>
</html>
