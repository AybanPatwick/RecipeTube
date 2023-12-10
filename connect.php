<?php
$servername = "localhost";
$username = "id21648282_admin";
$password = "Arcega.31";

   try {
       $conn = new PDO("mysql:host=$servername;dbname=id21648282_user_db", $username, $password);
       // set the PDO error mode to exception
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
   } catch(PDOException $e) {
       echo "Connection failed: " . $e->getMessage();
   }
?>