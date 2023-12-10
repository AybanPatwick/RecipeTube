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
        <title>Recipe Tube - Home</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="icon" type="image/png" href="/src/logo.png">
      <style>
        .search-container {
            position: relative;
            width: 700px;
            height: 60px;
        }

        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #555; /* Change color as needed */
        }

        #recipeInput {
            border-radius: 30px;
            padding-left: 30px; /* Adjust padding for icon */
            width: calc(100% - 40px); /* Adjust width for the icon */
            height: 100%;
        }
      </style>
    </head>
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
        <main>
            <section id="hero">
            <div class="search-container">
    <i class="fas fa-search search-icon"></i>
    <input type="text" id="recipeInput" placeholder="Enter a recipe" onkeydown="if(event.keyCode===13) searchRecipe()">
</div>


            </section>
   
        </main>
        <br><br><br><br><br>
        <div class="content">
            
            <div id="recipe"> <div id="foodPhoto"></div></div>
            <div id="videos"></div>
            <div id="nutrition">
          
              <table id="nutritionalFacts">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Your nutritional facts data goes here -->
                </tbody>
              </table>
              <button id="showMoreButton" style="display: none;">Show More</button>
            </div> 
          </div>
        <script src="script.js">
           
        </script>
        
    </body>
    </html>
