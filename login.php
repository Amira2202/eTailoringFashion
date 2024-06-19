<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $con = new mysqli("localhost", "amira", "1212", "dbfashion");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // SQL query
    $q = "SELECT * FROM login WHERE uname='$username' AND pass='$password'";

    // Execute query
    $res = mysqli_query($con, $q);

    // Check if user exists with the provided credentials
    if (mysqli_fetch_assoc($res)) {
        // Start session
        session_start();

        // Store user information in session variables
        $_SESSION["username"] = $username;
       
        // Redirect user based on role
        header("location: user.html");
    } else {
        
        header("location: login.html");
        
       // echo "Invalid username and password";
    }

    // Close connection
    $con->close();
}
?>