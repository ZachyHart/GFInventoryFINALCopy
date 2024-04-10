<?php
// check the parameters if the reply is successful
if (isset($_GET['reply'])) {
    if ($_GET['reply'] == 'success') {
        echo "<script>alert('Reply sent successfully!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <!-- Sweetalerts & Jquery --> 
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">

            <div class="sidebar-logo">
                <img src="img/CircularLogo.jpg" alt="Logo"
                    style="width: 100%; max-width: 120px; display: block; margin: 0 auto;">
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="AdminInventory.php" class="sidebar-link" title="Our Products">
                        <i class="lni lni-cart"></i>
                        <span><br>Our Products</span>
                    </a>
                </li>
                <!-- Second sidebar item for Feedback -->
                <li class="sidebar-item">
                    <a href="AdminFeedback.php" class="sidebar-link" title="Feedback">
                        <i class="lni lni-comments"></i>
                        <span>Feedback</span>
                    </a>
                </li>
                <!-- Add more sidebar items here -->
            </ul>
            <div class="sidebar-footer">
                <a href="login.php" class="sidebar-link" title="Logout">
                    <i class="lni lni-exit"></i>
                </a>
            </div>
        </aside>

        <div class="main p-3">
            <div class="text-center">
                <h1 class="inventory-title">Admin Feedback</h1>
            </div>

            <div class="container">
                <?php
                // Connect to database
                $conn = mysqli_connect('localhost', 'root', '', 'login_system');

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Retrieve feedbacks from the database
                $sql = "SELECT * FROM customerfeedbacks";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="card mb-3">
                            <div class="card-header">
                                Feedback from
                                <?php echo $row['Email']; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><strong>
                                        <?php echo $row['FeedbackTitle']; ?>
                                    </strong></h5>
                                <p class="card-text">
                                    <?php echo $row['FeedbackContent']; ?>
                                </p>
                                <!-- Add form for reply here -->
                                <form method="post" class="reply-form" action="reply_handler.php">
                                    <input type="hidden" name="feedback_id" value="<?php echo $row['FeedbackID']; ?>">
                                    <div class="form-group">
                                        <label for="reply">Reply:</label>
                                        <textarea class="form-control" id="reply" name="reply" rows="3"><?php echo $row['reply']; ?></textarea>
                                    </div>
                                    <button type="button" onclick="showConfirmation(this.form)" class="btn btn-primary">REPLY</button>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No feedbacks found.";
                }

                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <script src="AdminInventory.js"></script>
</body>
<script>
    // Function to show SweetAlert confirmation dialog
    function showConfirmation(form) {
        event.preventDefault();

        let replyValue = form.reply.value.trim();

        if (replyValue === '') {
            Swal.fire({
                title: "Error!",
                text: "Reply cannot be empty",
                icon: "error",
            });
        } else {
            Swal.fire({
                title: "Are you sure?",
                text: "You are about to send a reply",
                icon: "warning",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    console.log('submitted');
                }
            });
        }
    }

    // jQuery code to handle form submission when clicking the button
    // $(document).ready(function() {
    //     $('.btn-submit').click(function() {
    //         event.preventDefault(); 
            
    //         // Check if textarea is empty
    //         let replyValue = $(this).closest('form').find('.form-control').val().trim();
    //         console.log(replyValue)
    //         if (replyValue == '') {
    //             Swal.fire({
    //                 title: "Error!",
    //                 text: "Reply cannot be empty",
    //                 icon: "error",
    //             });
    //         } else {
    //             // Show confirmation dialog if textarea is not empty
    //             let formToSubmit = $(this).closest('form');
    //             showConfirmation(formToSubmit);
    //         }
    //     });
    // });
</script>
</html>