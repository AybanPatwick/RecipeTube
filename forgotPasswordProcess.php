<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "connectLogin.php"; // Include your database connection file

    // Retrieve user input from the form
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];
    $securityQuestion = $_POST['securityQuestion'];
    $securityAnswer = $_POST['securityAnswer'];

    // Validate and sanitize user inputs (perform validation as needed)

    // Check if the email and security answer match a user in the database
    $check_stmt = $conn->prepare("SELECT * FROM users WHERE userName = :username AND security_question = :question AND security_answer = :answer");
    $check_stmt->bindParam(':username', $email);
    $check_stmt->bindParam(':question', $securityQuestion);
    $check_stmt->bindParam(':answer', $securityAnswer);
    $check_stmt->execute();

    if ($check_stmt->rowCount() > 0) {
        // Email, security question, and answer match, proceed with password reset
        // Hash the new password before updating in the database
        $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $update_stmt = $conn->prepare("UPDATE users SET userPassword = :password WHERE userName = :username");
        $update_stmt->bindParam(':password', $hashed_password);
        $update_stmt->bindParam(':username', $email);

        if ($update_stmt->execute()) {
            // Password reset successful
            $_SESSION['reset_success'] = "Password reset successful! You can now log in with your new password.";
            header("Location: login.php"); // Redirect to login page
            exit();
        } else {
            // Error updating password
            $_SESSION['reset_error'] = "Password reset failed. Please try again later.";
            header("Location: forgotpassword.php"); // Redirect back to the forgot password form
            exit();
        }
    } else {
        // Email, security question, or answer is incorrect
        $_SESSION['reset_error'] = "Email, security question, or answer is incorrect";
        header("Location: forgotpassword.php"); // Redirect back to the forgot password form
        exit();
    }
} else {
    // Redirect to forgot password page if accessed directly without form submission
    header("Location: forgotpassword.php");
    exit();
}
?>
