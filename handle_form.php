<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database credentials


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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO gown_orders (customer_name, email, phone, address, bust, gown_length, fabric_type, gown_design_image, delivery_date, additional_instructions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssissss", $customerName, $email, $phone, $address, $bust, $gownLength, $fabricType, $gownDesignImage, $deliveryDate, $additionalInstructions);

    // Set parameters
    $customerName = $_POST['customerName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $bust = $_POST['bust'];
    $gownLength = $_POST['gownlength'];
    $fabricType = $_POST['fabricType'];
    
    // Check if gownDesignImage is set
    if(isset($_POST['gownDesignImage'])){
        $gownDesignImage = $_POST['gownDesignImage'];
    } else {
        // Set a default value if gownDesignImage is not set
        $gownDesignImage = "default_image.jpg";
    }
    
    $deliveryDate = $_POST['deliveryDate'];
    $additionalInstructions = $_POST['additionalInstructions'];

    // Execute the statement
    if ($stmt->execute()) {
        $success_message = "Your gown stitching request has been submitted successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
