<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "amira"; // Change this to your database username
$password = "1212"; // Change this to your database password
$dbname = "dbfashion"; // Change this to your database name

// Create connection
$conn = new mysqli("localhost", "amira", "1212", "dbfashion");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, comment) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $name, $email, $rating, $comment);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

if ($stmt->execute()) {
    echo "Thank you for your feedback!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

