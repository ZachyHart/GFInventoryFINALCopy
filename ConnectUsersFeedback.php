<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $feedbacktitle = $_POST['feedbackTitle'];
    $feedbackcontent = $_POST['feedbackContent'];

    // Database Connection
    $conn = new mysqli('localhost', 'root', '', 'login_system');
    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO customerfeedbacks (Email, FeedbackTitle, FeedbackContent) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $feedbacktitle, $feedbackcontent);
        $stmt->execute();

        echo "<script>
                    $('#confirmationModal').modal('hide'); // Hide the confirmation modal
                    $('#successModal').modal('show'); // Show success modal
                    $('#feedbackForm')[0].reset(); // Reset form fields
                  </script>";
        // Close prepared statement
        $stmt->close();
        // Close database connection
        $conn->close();


    }
}
?>