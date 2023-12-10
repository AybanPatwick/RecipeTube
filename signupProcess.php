<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "connectLogin.php";

    // Retrieve user input from the signup form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $securityQuestion = $_POST['securityQuestion'];
    $securityAnswer = $_POST['securityAnswer'];

    // Check if the email already exists in the database
    $check_stmt = $conn->prepare("SELECT * FROM users WHERE userName = :username");
    $check_stmt->bindParam(':username', $email);
    $check_stmt->execute();

    if ($check_stmt->rowCount() > 0) {
        // Email already exists
        $_SESSION['signup_error'] = "This email is already in use";
        header("Location: signup.php");
        exit();
    } else {
        // Email is unique, proceed to create the new user

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user data into the database with security question and answer
        $insert_stmt = $conn->prepare("INSERT INTO users (userName, userPassword, security_question, security_answer) VALUES (:username, :password, :question, :answer)");
        $insert_stmt->bindParam(':username', $email);
        $insert_stmt->bindParam(':password', $hashed_password);
        $insert_stmt->bindParam(':question', $securityQuestion);
        $insert_stmt->bindParam(':answer', $securityAnswer);

        if ($insert_stmt->execute()) {
            // User registration successful
            $_SESSION['signup_success'] = "Registration successful! You can now log in.";
            header("Location: login.php");
            exit();
        } else {
            // Error in user registration
            $_SESSION['signup_error'] = "Registration failed. Please try again later.";
            header("Location: signup.php");
            exit();
        }
    }
} else {
    // Redirect to signup page if accessed directly without form submission
    header("Location: signup.php");
    exit();
}
?>
