<?php
// Database connection parameters
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "amira"; // Change this to your MySQL username
$password = "1212"; // Change this to your MySQL password
$database = "dbfashion"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID parameter is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete record from the database
    $sql = "DELETE FROM blouse WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>

