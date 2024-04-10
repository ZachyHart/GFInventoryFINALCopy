<?php
// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'login_system');
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

$feedbackID = $_POST['feedback_id'];
$reply = $_POST['reply'];

// if request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // check if the reply is not empty
    $sql = "SELECT reply FROM customerfeedbacks WHERE FeedbackID = $feedbackID";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // if there is no reply yet, insert the reply, else update the reply
    if (empty($row['reply'])) {
        $sql = "UPDATE customerfeedbacks SET reply = '$reply' WHERE FeedbackID = $feedbackID";
    } else {
        $sql = "UPDATE customerfeedbacks SET reply = '$reply' WHERE FeedbackID = $feedbackID";
    }

    if (mysqli_query($conn, $sql)) {
        // add parameter to the URL to indicate success
        header("Location: AdminFeedback.php?reply=success");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}

mysqli_close($conn);