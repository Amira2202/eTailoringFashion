<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
        // Retrieve form data
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Validate password matching
        if ($password !== $confirm_password) 
        {

            echo "Error: Passwords do not match.";
            exit;
        }

        // Hash the password
        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Database connection
        $servername = "localhost";
        $db_username = "amira";
        $db_password = "1212";
        $database = "dbfashion";

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL to insert data into the table
        $sql = "INSERT INTO login (uname, pass) VALUES (?, ?)";

        // Prepare and bind statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.html");
            exit;
        } else {
            header("Location: createacc.html");
            exit;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        header("Location: create_account.html");
        exit;
    }
}
?>