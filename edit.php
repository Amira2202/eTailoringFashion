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



// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Print form data for debugging
    echo "ID: " . $id . "<br>";
    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Phone: " . $phone . "<br>";

    // Rest of your code for updating the record
}


    // Update record in the database
    $sql = "UPDATE blouse SET name='$name', email='$email', phone='$phone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }


// Close connection
$conn->close();
?>

