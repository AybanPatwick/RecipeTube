<?php
include "connectLogin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Recipe Tube - Sign Up</title>
  <link rel="stylesheet" href="loginstyle.css">
  <link rel="icon" type="image/png" href="/src/logo.png">
</head>
<body style="background-image: url('src/loginbg.png'); background-size: cover;">

<div class="container" style="margin-right: 40px; padding: 50px;">
<img src="/src/logo.png" alt="Your Logo" class="logo"  style="display: block; margin: 0 auto;">
    <div class="welcome-text">
        <h2>Join Recipe Tube!</h2>
        <p>Create your account</p>
    </div>
    <form class="login-form" action="signupProcess.php" method="POST">
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
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


        <button type="submit">CONTINUE</button>
        <hr class="custom-line">
        <p>Already have an account? <a href="login.php" class="sign-up-link">LOGIN HERE</a></p>
    </form>
</div>

</body>
</html>
