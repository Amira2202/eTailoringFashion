<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$bust = $_POST['bust'];
$waist = $_POST['waist'];
$hips = $_POST['hips'];
$shoulder = $_POST['shoulder'];
$armhole = $_POST['armhole'];
$sleevetype = $_POST['sleevetype'];
$backneck= $_POST['backneck'];
$frontneck = $_POST['frontneck'];
$chudilength= $_POST['chudilength'];
$fabric = $_POST['fabric'];
$design = $_POST['design']; // This will contain the filename of the selected design image

// Prepare SQL statement (use prepared statement to prevent SQL injection)
$sql = "INSERT INTO chudi (name, email, phone, bust, waist, hips, shoulder, armhole, sleevetype, backneck, frontneck, chudilength, fabric, design) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssss", $name, $email, $phone, $bust, $waist, $hips, $shoulder, $armhole, $sleevetype, $backneck, $frontneck, $chudilength, $fabric, $design);

// Execute SQL statement
if ($stmt->execute()) {
   // echo "Your chudidar stitching request has been submitted successfully!";
    $success_message = "Your chudidar stitching request has been submitted successfully!";
} else {
   // echo "Error: " . $stmt->error;
    $error_message = "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Churidar Stitching Form</title>
    
    <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-repeat: no-repeat;
      background-color:#fff;
      background-size: cover;
    
  }
  .container {
      max-width: 500px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  } 
  h2 {
      text-align: center;
  }
  
  form {
      display: grid;
      grid-gap: 10px;
  }
  
  label {
      font-weight: bold;
  }
  
  input[type="text"],
  input[type="email"],
  input[type="tel"],
  input[type="number"],
  select,
  textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
  }
  
  input[type="submit"] {
      background-color: #4caf50;
      color: white;
      border: none;
      padding: 15px 20px;
      border-radius: 5px;
      cursor: pointer;
  }
  
  input[type="submit"]:hover {
      background-color: #45a049;
  }

  

  .dialog-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            border: 1px solid #000000;
            padding: 20px;
            z-index: 1000;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }

        .dialog-box h2 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .dialog-box p {
            color: #666666;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .dialog-box button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .dialog-box button:hover {
            background-color: #45a049;
        }

  </style>
</head>
<body>
<div class="dialog-box">
    <?php if (isset($success_message)): ?>
        <h2>Success!</h2>
        <p><?php echo $success_message; ?></p>
    <?php elseif (isset($error_message)): ?>
        <h2>Error!</h2>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <button onclick="window.history.back()">Close</button>

</div>

   
</body>
</html>
