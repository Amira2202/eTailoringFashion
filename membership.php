<?php
// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Establish connection to MySQL database
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

    // Get the input values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phno = $_POST['phno'];

    // SQL to insert the data into the database table
    $sql = "INSERT INTO membership (name, email, phno) VALUES ('$name', '$email', '$phno')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Display a success message
        echo '<script>alert("You are added as a member to Twin Fashion. Thank you! You\'ll receive more offers soon.");';
        // Redirect the user to membership.php after clicking OK
        echo 'window.location.href = "index.html";</script>';
    } else {
        // Display an error message if the query fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
