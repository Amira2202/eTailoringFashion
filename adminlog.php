<?php
session_start();

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
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password (you should use more secure methods like bcrypt)
    $hashed_password = md5($password);

    // Check if the username and password match
    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$hashed_password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login successful, set session variables and redirect
        $_SESSION['username'] = $username;
        header("Location: admin.html"); // Redirect to the admin panel page
        exit();
    } else {
        // Login failed, redirect back to the login page with error message
        header("Location: adminlog.php?error=1"); // Redirect to the login page with error parameter
        exit();
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form action="adminlog.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

