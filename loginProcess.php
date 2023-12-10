<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "connectLogin.php";

    $username = $_POST['username']; // Assuming the input field is named 'username'
    $password = $_POST['password'];

    // Fetch user data based on the provided username
    $stmt = $conn->prepare("SELECT * FROM users WHERE userName = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Check if a user with the given username exists
    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        if (password_verify($password, $user['userPassword'])) {
            // Password is correct, create session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_username'] = $user['userName'];
            // Add more user data to session if needed
        
            // Redirect after successful login
            header("Location: index.php");
            exit();
        } else {
            // Password is incorrect
            $_SESSION['login_error'] = "Incorrect password";
            header("Location: login.php");
            exit();
        }
    } else {
        // No user found with the provided username
        $_SESSION['login_error'] = "No account found with this username";
        header("Location: login.php");
        exit();
    }
} else {
    // Redirect to login page if accessed directly without form submission
    header("Location: login.php");
    exit();
}
?>
