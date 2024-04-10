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
    <!-- Sweetalerts & Jquery --> 
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div id="form_container" class="col-md-6">
                <div id="form_header_container" class="text-center registration-page">
                    <div id="logo_container">
                        <img id="logo" src="img/CircularLogo.jpg" alt="Logo" class="img-fluid">
                    </div>
                    <h2 id="registration_form_header" class="mt-3">Register</h2>
                </div>
    
    

<form class="form" id="form" method="post" action="./controllers/Users.php">
<div id="form_content_container" class="bg-white p-4 rounded">
    <div id="form_content_inner_container">
    <input type="hidden" name="type" value="register">

    <input type="text" class="form-control mb-3" name="usersName" placeholder="Full name" required />

    <input type="text" class="form-control mb-3" name="usersEmail" placeholder="Email">

    <input type="text" class="form-control mb-3" name="usersUid" placeholder="Username">

    <input type="password" class="form-control mb-3" name="usersPwd" placeholder="Password">

    <input type="password" class="form-control mb-3" name="pwdRepeat" placeholder="Repeat password">

    <div id="button_container" class="text-center registration-page">
    <button type="submit"  value="Register" class="btn btn-primary text-center btn-submit" style="background-color: black; color: white;">SIGN UP</button>
    </div>
    
    <p id="create_account_text" class="text-center mt-3">Already have an account? <br> Click here to <a href="login.php"> login</a></p>

</form>
            </div>
            </div>

</body>
<script>
    // Function to show SweetAlert confirmation dialog
    function showConfirmation() {
        Swal.fire({
            title: "Are you sure?",
            text: "You are about to sign up.",
            icon: "warning",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            showCancelButton: true,
        })
        .then((result) => {
            console.log(result.isConfirmed);
            if (result.isConfirmed) {
                // If user clicks "Yes" in the confirmation dialog, submit the form
                $('#form').submit();
                console.log('submitted');
            }
        });
    }

    // jQuery code to handle form submission when clicking the button
    $(document).ready(function() {
        $('.btn-submit').click(function() {
            event.preventDefault(); 
            showConfirmation();
        });
    });
</script>
</html>