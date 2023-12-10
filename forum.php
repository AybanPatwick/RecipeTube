<?php
include "connect.php";

try {
    // Retrieve recipes from the database
    $stmt = $conn->query("SELECT * FROM forum");
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


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
  <title>Recipe Tube - Forum</title>
  <link rel="icon" type="image/png" href="/src/logo.png">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    /* Basic styling for demonstration purposes */
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      margin: 0;
      padding: 20px;
    }
    .popup-form {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: #fff;
      padding: 100px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      z-index: 1000;
    }
    .recipe-container {
      margin-top: 80px;
    }
    .recipe {
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 10px;
      background:#fff;
    }
  </style>
</head>
<body>

       
       
   
    <body style="background-image: url('/src/landingpagebg.png'); background-size: cover;
    background-attachment: fixed;">
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
  <h1>Welcome to the Recipe Forum</h1>

  <!-- "Add Recipe" Button -->
  <button onclick="toggleForm()">Add Recipe</button>

  <!-- Popup Form -->
  <div class="popup-form" id="recipeForm">
    <i class="fas fa-times close-icon" onclick="toggleForm()"></i> <!-- Close (X) icon from Font Awesome -->
    <form action="save.php" method="post">
        <label for="rec_name">Recipe Title:</label>
        <input type="text" id="rec_name" name="rec_name" required><br><br>
        <label for="rec_desc">Recipe Description:</label>
        <textarea id="rec_desc" name="rec_desc" required></textarea><br><br>
        <input type="submit" value="Submit">
    </form>
</div>


  <div class="recipe-container" id="forumPosts">
    <?php foreach ($recipes as $recipe) : ?>
        <div class="recipe">
            <h2><?= $recipe['rec_name'] ?></h2>
            <p><strong>Author:</strong> <?= $recipe['auth_name'] ?></p>
            <p><?= $recipe['rec_desc'] ?></p>
            <p><strong>Date & Time:</strong> <?= $recipe['dt_recipe'] ?></p>
        </div>
    <?php endforeach; ?>
</div>

  <script>
    function toggleForm() {
      const form = document.getElementById('recipeForm');
      form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }

    function submitForm(event) {
      event.preventDefault(); // Prevent form submission (for demo purposes)
      const title = document.getElementById('title').value;
      const author = document.getElementById('author').value;
      const description = document.getElementById('description').value;
      const datetime = document.getElementById('datetime').value;

      // Create a new recipe element
      const recipeElement = document.createElement('div');
      recipeElement.classList.add('recipe');
      recipeElement.innerHTML = `
        <h2>${title}</h2>
        <p><strong>Author:</strong> ${author}</p>
        <p>${description}</p>
        <p><strong>Date & Time:</strong> ${datetime}</p>
      `;

      // Append the new recipe element to the forum posts container
      const forumPosts = document.getElementById('forumPosts');
      forumPosts.appendChild(recipeElement);

      // Clear the form and close the popup (for demonstration purposes)
      document.getElementById('title').value = '';
      document.getElementById('author').value = '';
      document.getElementById('description').value = '';
      document.getElementById('datetime').value = '';
      toggleForm(); // Close the form
    }
  </script>
</body>
</html>
