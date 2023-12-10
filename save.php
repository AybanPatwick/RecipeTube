<?php
session_start(); // Start the session to access user data
$servername = "localhost";
$username = "id21648282_admin";
$password = "Arcega.31";
$dbname = "id21648282_user_db"; // Database 1

// Create connection to the first database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data (assuming proper validation/sanitization is performed)
$title = $_POST['rec_name'];
$description = $_POST['rec_desc'];

// Retrieve the author (userName) from the users table based on the user_id stored in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Prepare a statement to select the username based on user ID
    $stmt = $conn->prepare("SELECT userName FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $author = $row['userName']; // Assign the fetched userName to $author
    } else {
        // If no user is found, set a default author or handle the situation accordingly
        $author = "Unknown";
    }
} else {
    // If user_id is not set in the session, set a default author or handle the situation accordingly
    $author = "Unknown";
}

// Prepare SQL statement for insertion
$sql = "INSERT INTO forum (rec_name, auth_name, rec_desc) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

// Bind parameters and execute the statement
$stmt->bind_param("sss", $title, $author, $description);
if ($stmt->execute()) {
    echo '<script>alert("Recipe saved successfully!");</script>';
    echo '<script>setTimeout(function(){ window.location = "forum.php"; }, 1);</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the statement and the connection
$stmt->close();
$conn->close();

?>
