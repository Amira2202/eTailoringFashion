<?php
// Initialize error variable
$error = "";

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
        header("location: admin.html");
        exit();
    } else {
        // Set error message
        $error = "Incorrect username or password.";
    }

    // Close connection
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7; /* Light gray background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            max-width: 400px;
            
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333; /* Dark gray text */
        }

        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid #ccc; /* Light gray border */
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff; /* Blue button */
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (!empty($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
