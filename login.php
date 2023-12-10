<?php
  // Ensure you include your database connection file here (if not included within connectLogin.php)
  include "connectLogin.php";
  
  // You might have other PHP logic here for sessions, error handling, etc., related to login, if needed.
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Recipe Tube - Login</title>
  <link rel="stylesheet" href="loginstyle.css">
  <link rel="icon" type="image/png" href="/src/logo.png">
</head>
<body style="background-image: url('src/loginbg.png'); background-size: cover;">

<div class="container" style="margin-right: 40px; padding: 50px;">
<img src="/src/logo.png" alt="Your Logo" class="logo"  style="display: block; margin: 0 auto;">
        <div class="welcome-text">
          <h2>Welcome Back</h2>
          <p>Log in to your account</p>
        </div>
        <form class="login-form" action="loginProcess.php" method="POST">
          <div class="input-group">
            <label for="username">Email</label>
            <input type="email" id="username" name="username" required>
          </div>
          <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
          </div>
          <div class="input-group">
            <span class="forgot-password"><a href="forgotpassword.php">Forgot Password?</a></span>
          </div>
          <button type="submit">CONTINUE</button>
          <hr class="custom-line">
          <p>New user? <a href="signup.php" class="sign-up-link">SIGN UP HERE</a></p>
        </form>

<script>


</script>
</body>
</html>
