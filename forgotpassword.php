<?php
include "connectLogin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Recipe Tube - Forgot Password</title>
  <link rel="stylesheet" href="loginstyle.css">
  <link rel="icon" type="image/png" href="/src/logo.png">
</head>
<body style="background-image: url('src/loginbg.png'); background-size: cover;">

<div class="container" style="margin-right: 40px; padding: 50px;">
<img src="/src/logo.png" alt="Your Logo" class="logo"  style="display: block; margin: 0 auto;">
  <div class="welcome-text">
    <h2>Forgot Password?</h2>
    <p>Enter your email and new password to reset</p>
  </div>
  <form class="login-form" action="forgotPasswordProcess.php" method="POST">
    <div class="input-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>
    </div>

    <div class="input-group">
      <label for="new_password">New Password</label>
      <input type="password" id="new_password" name="new_password" required>
    </div>

    <div class="input-group">
    <label for="securityQuestion">Security Question</label>
        <select id="securityQuestion" name="securityQuestion">
            <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
            <!-- Add other security questions as options -->
        </select>
    </div>
    <div class="input-group">
        <label for="securityAnswer">Answer</label>
        <input type="text" id="securityAnswer" name="securityAnswer" required>
    </div>

    <button type="submit">RESET PASSWORD</button>
    <hr class="custom-line">
    <p>Remember your password? <a href="login.php" class="sign-up-link">LOGIN HERE</a></p>
  </form>

  <script>
    // Any additional JavaScript for validation or functionality can be added here
  </script>
</body>
</html>
