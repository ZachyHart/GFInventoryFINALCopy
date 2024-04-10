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
                <div id="form_header_container" class="text-center registration-page">
                    <div id="logo_container">
                        <img id="logo" src="img/CircularLogo.jpg" alt="Logo" class="img-fluid">
                    </div>
                    <h2 id="registration_form_header" class="mt-3">Register</h2>
                </div>
    
                <form class="form" form method="post" action="./controllers/CustomerUsers.php" id="registrationForm">
                    <div id="form_content_container" class="bg-white p-4 rounded">
                        <div id="form_content_inner_container">
                            <input type="hidden" name="type" value="register">

                            <input type="text" class="form-control mb-3" name="usersName" placeholder="Full name" required />

                            <input type="text" class="form-control mb-3" name="usersEmail" placeholder="Email">

                            <input type="text" class="form-control mb-3" name="usersUid" placeholder="Username">

                            <input type="password" class="form-control mb-3" name="usersPwd" placeholder="Password">

                            <input type="password" class="form-control mb-3" name="pwdRepeat" placeholder="Repeat password">

                            <div id="button_container" class="text-center registration-page">
                                <button type="button" id="showConfirmationModal" class="btn btn-primary text-center" style="background-color: black; color: white;">SIGN UP</button>
                            </div>
                            
                            <p id="create_account_text" class="text-center mt-3">Already have an account? <br> Click here to <a href="CustomerLogin.php"> login</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to register?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="confirmRegister">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Show the modal when the form is submitted
            $('#showConfirmationModal').click(function() {
                $('#confirmationModal').modal('show');
            });

            // Handle the register confirmation
            $('#confirmRegister').click(function() {
                // Submit the form when the user clicks "Yes"
                $('#registrationForm').submit();
            });
        });
    </script>
</body>
</html>
