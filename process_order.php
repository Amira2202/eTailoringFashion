<?php
// Establish database connection
$servername = "localhost";
$username = "amira"; // Your MySQL username
$password = "1212"; // Your MySQL password
$dbname = "dbfashion";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $customerName = $_POST["customerName"];
  // Add more variables to store other order details

  // Insert order into database
  $sql = "INSERT INTO orders (customerName) VALUES ('$customerName')";
  // Execute SQL query
  if ($conn->query($sql) === TRUE) {
    echo "Order placed successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Close database connection
$conn->close();
?>

