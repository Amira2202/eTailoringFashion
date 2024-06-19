<?php
// Database connection parameters
$servername = "localhost";
$username = "amira";
$password = "1212";
$dbname = "dbfashion";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO lehenga_orders (name, email, phone, waist, hip, length, blouse, neck, sleeve, fabric, embroidery, selected_design) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssss", $name, $email, $phone, $waist, $hip, $length, $blouse, $neck, $sleeve, $fabric, $embroidery, $selected_design);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$waist = $_POST['waist'];
$hip = $_POST['hip'];
$length = $_POST['length'];
$blouse = $_POST['blouse'];
$neck = $_POST['neck'];
$sleeve = $_POST['sleeve'];
$fabric = $_POST['fabric'];
$embroidery = $_POST['embroidery'];
$selected_design = $_POST['selectedDesign'];

$stmt->execute();

echo "Form submitted successfully.";

$stmt->close();
$conn->close();
?>

