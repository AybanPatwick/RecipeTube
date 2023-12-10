<?php
  include "connect.php";

session_start();

// Check if the user is not logged in (session variable not set)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Tube - Welcome</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="/src/logo.png">
</head>
<body style="background-image: url('/src/landingpagebg.png'); background-size: cover;">
    <header>
        <nav>
            <img src="/src/logo.png" alt="Your Logo" class="logo">
            <ul>
            <li><a href="index.php">HOME</a></li>
                  <li><a href="recipe.php">RECIPES</a></li>
                  <li><a href="forum.php">FORUM</a></li>    
            </ul>
    <a href="logout.php" class="sign-in-link">
        <button class="sign-in-btn">SIGN OUT</button>
    </a>

        </nav>
    </header>
    <main>
        <section id="hero">
            <h1>RECIPE AT YOUR FINGERTIPS</h1>
            <p>The solution in your daily struggle <br> for your meal plan.</p>
            <a href="recipe.php">
            <button class="join-now-btn">SEARCH RECIPE</button>
        </section>
    </main>
</body>
</html>
