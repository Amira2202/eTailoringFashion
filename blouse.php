<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "amira";// Change this to your MySQL username
$password = "1212"; // Change this to your MySQL password
$database = "dbfashion"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$bust = $_POST['bust'];
$waist = $_POST['waist'];
$shoulder = $_POST['shoulder'];
$sleeve = $_POST['sleeve'];
$frontneck = $_POST['frontneck'];
$backneck = $_POST['backneck'];
$blouselength = $_POST['blouselength'];
$sleevearound = $_POST['sleevearound'];
$armhole = $_POST['armhole'];
$fabric = $_POST['fabric'];
$neck_design = $_POST['neck_design'];
$selectedImage= $_POST['selectedImage'];
$additional = $_POST['additional'];

// Prepare SQL statement (use prepared statement to prevent SQL injection)
$sql = "INSERT INTO blouse(name, email, phone, bust, waist, shoulder, sleeve, frontneck, backneck, blouselength, sleevearound, armhole, fabric, neck_design, selectedImage, additional) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Error in preparing statement: " . $conn->error;
}

$stmt->bind_param("ssssssssssssssss", $name, $email, $phone, $bust, $waist, $shoulder, $sleeve, $frontneck, $backneck, $blouselength, $sleevearound, $armhole, $fabric, $neck_design, $selectedImage, $additional);



// Execute SQL statement
  if ($stmt->execute()) {
    // Echo confirmation message
    
    // Show dialog box
    echo "<script>alert('Your booking has been successfully completed. You will receive a confirmation message shortly.');</script>";

   // header("location: measure.html") ;
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
