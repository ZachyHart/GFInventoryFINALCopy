<?php
require_once 'helpers/conn_helpers.php';
include_once './helpers/session_helper.php';

// check if user is logged in, and check if user is an admin
if (!isset($_SESSION["usersName"]) || $_SESSION["role"] !== "user") {
    header("Location: customerlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Got Funko Collections</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="customerlogin.css">
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
                    <a href="CustomerInventory.php" class="sidebar-link" title="Our Products">
                        <i class="lni lni-cart"></i>
                        <span><br>Our Products</span>
                    </a>
                </li>
                <!-- Second sidebar item for Feedback -->
                <li class="sidebar-item">
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] != ''){ ?>
                    <a href="CustomerFeedbacK.php" class="sidebar-link" title="Feedback">
                        <i class="lni lni-comments"></i>
                        <span>Feedback</span>
                    </a>
                    <?php }else{ ?>
                        <a href="" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="lni lni-comments"></i>
                            <span>Feedback</span>
                        </a>
                    <?php } ?>
                </li>
                <!-- Add more sidebar items here -->
            </ul>
            <div class="sidebar-footer">
                <form action="controllers/Customerusers.php" method="post" id="logout">
                    <input type="hidden" name="type" value="logout">
                    <a href="javascript:{}" onclick="document.getElementById('logout').submit();" class="sidebar-link" title="Logout" id="logout" type="submit">
                        <i class="lni lni-exit"></i>
                    </a>
                </form>
            </div>
        </aside>

        <div class="main p-3">
            <div class="text-center">
            <h1 class="inventory-title">PRODUCT LIST</h1>
            </div>
            <div class="row">
            <div class="col-md-6 mx-auto">
            <form method="GET" class="d-flex align-items-center">
                        <input type="text" class="form-control me-2" name="search" placeholder="Search products..."required>
                        <button type="submit" class="btn btn-search">Search</button>
                    </form>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 mt-3"> <!-- Updated to show 4 columns on large screens -->
                <?php
                $productsPerPage = 20;

                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                $offset = ($page - 1) * $productsPerPage;

                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $sql = "SELECT * FROM product_table WHERE product_name LIKE '%$search%' LIMIT $productsPerPage OFFSET $offset";
                } else {
                    $sql = "SELECT * FROM product_table LIMIT $productsPerPage OFFSET $offset";
                }
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col">
                    <div class="card product_card">
                        <div class="row justify-content-start">
                            
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <img src="img/products/<?php echo $row['product_image']; ?>"
                                    class="card-img-top product_image" alt="<?php echo $row['product_name']; ?>">
                            </div>
                            <div class="col-12">
                            <div class="card-body">
        <div class="product-details">
            <span class="product-category"><?php echo $row['product_category']; ?></span>
            <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
        </div>
        <div class="price_stock">
            <h1 class="price_text">₱ <?php echo $row['price']; ?></h1>
            <h1 class="stock_text">In stock x <?php echo $row['stock']; ?></h1>
        </div>
        
    </div>
</div> 
                                </div>
                               
                    </div>
                </div>
            
            <?php
                    }
                } else {
                    echo "0 results";
                }
                ?>
                <!-- Pagination buttons -->
                <div class="pagination d-flex justify-content-center w-100">
                    <?php
                    $sql_totalProducts = "SELECT COUNT(*) FROM product_table";
                    $result_totalProducts = $conn->query($sql_totalProducts);
                    $totalProducts = mysqli_fetch_array($result_totalProducts);

                    $totalPages = ceil($totalProducts['COUNT(*)'] / $productsPerPage);

                    if ($page > 1) {
                        echo '<a href="?page=' . ($page - 1) . '"><i class="lni lni-arrow-left-circle fs-3 px-3 text-dark"></i></a>';
                    }

                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<a href="?page=' . $i . '" class="px-3 text-dark">' . $i . '</a>';
                    }

                    if ($page < $totalPages) {
                        echo '<a href="?page=' . ($page + 1) . '"><i class="lni lni-arrow-right-circle fs-3 px-3 text-dark"></i></a>';
                    }
                    ?>
                </div>

            <!-- Login modal -->
            <div class="modal fade" id="loginModal" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title w-100" id="deleteProductModalLabel">Login</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
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
                                        <input type="text" class="form-control mb-3" name="name/email"
                                            placeholder="Username/Email..." autofocus="true" />
                                        <input type="password" class="form-control mb-3" name="usersPwd"
                                            placeholder="Password..." />
                                        <a href="./Customerreset-password.php" id="forgot_password"
                                        data-bs-toggle="modal" data-bs-target="#forgotPassModal" div class="form-sub-msg">Forgot Password?</a>

                                        <div id="button_container" class="text-center mt-3" name="submit">
                                            <button type="submit" button class="btn btn-primary">LOG IN</button>
                                        </div>
                                    </div>

                                    <p id="create_account_text" class="text-center mt-3">Don't have an account? <br> Create a new
                                        one <a href="" data-bs-toggle="modal" data-bs-target="#signupModal"> here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Signup modal -->
            <div class="modal fade" id="signupModal" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title w-100" id="deleteProductModalLabel">Sign Up</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div id="form_header_container" class="text-center registration-page">
                                <div id="logo_container">
                                    <img id="logo" src="img/CircularLogo.jpg" alt="Logo" class="img-fluid">
                                </div>
                                <h2 id="registration_form_header" class="mt-3">Register</h2>
                            </div>
                
                            <form class="form" id="form" method="post" action="./controllers/CustomerUsers.php" id="registrationForm">
                                <div id="form_content_container" class="bg-white p-4 rounded">
                                    <div id="form_content_inner_container">
                                        <input type="hidden" name="type" value="register">

                                        <input type="text" class="form-control mb-3" name="usersName" placeholder="Full name" required />

                                        <input type="text" class="form-control mb-3" name="usersEmail" placeholder="Email">

                                        <input type="text" class="form-control mb-3" name="usersUid" placeholder="Username">

                                        <input type="password" class="form-control mb-3" name="usersPwd" placeholder="Password">

                                        <input type="password" class="form-control mb-3" name="pwdRepeat" placeholder="Repeat password">

                                        <div id="button_container" class="text-center registration-page">
                                            <button type="submit" id="showConfirmationModal" class="btn btn-primary text-center btn-submit" style="background-color: black; color: white;">SIGN UP</button>
                                        </div>
                                        
                                        <p id="create_account_text" class="text-center mt-3">Already have an account? <br> Click here to <a href="" data-bs-toggle="modal" data-bs-target="#loginModal"> login</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Forgot Password modal -->
            <div class="modal fade" id="forgotPassModal" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title w-100" id="deleteProductModalLabel">Forgot Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                        <div id="form_header_container" class="text-center">
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
                        </div>
                    </div>
                </div>
            </div>

            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="WorkingSidebar.js"></script>
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
<?php
    if(isset($_SESSION['flash-msg'])){
        echo $msg = $_SESSION['flash-msg'];
        if($msg == 'invalid-token'){
            echo"
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Unable to verify account creation',
                })
            </script>
            ";
            unset($_SESSION['flash-msg']);
        }else if($msg == 'success-creation'){
            echo"
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Please check your email to verify account',
                })
            </script>
            ";
            unset($_SESSION['flash-msg']);
        }else if($msg == 'account-unconfirmed'){
            echo"
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Please verify your account before logging in',
                })
            </script>
            ";
            unset($_SESSION['flash-msg']);
        }else if($msg == 'confirmed-creation'){
            echo"
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Account Verified!',
                text: 'Account verification successful. You may now login',
                })
            </script>
            ";
            unset($_SESSION['flash-msg']);
        }
    }
?>
</html>