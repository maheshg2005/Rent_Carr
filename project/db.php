<?php
$host = "localhost";
$user = "root"; // Change if needed
$pass = "";
$db = "rental_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
