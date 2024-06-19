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
    $gownDesignImage = $_POST['gownDesignImage'];
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

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customized Gown Stitching Form</title>

<style>
  /* Add your CSS styles here */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
  
  .background-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('images/h.webp'); /* Add your background image URL here */
    background-size: cover;
    filter: blur(20px); /* Add blur effect */
    z-index: -1; /* Set z-index to position behind other content */
  }

  h1 {
    text-align: center;
    margin-top: 20px;
  }

  form {
    max-width: 800px; /* Adjust the maximum width of the form */
    margin: 0 auto;
    background-color: transparent;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-size: large;
  }

  h2 {
    margin-top: 20px;
  }

  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    font-size: large; /* Make label font size larger */
  }

  input[type="text"],
  input[type="number"],
  input[type="email"],
  input[type="tel"],
  textarea,
  select {
    width: calc(100% - 40px); /* Adjust the width of the fields */
    padding: 15px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: large; /* Make input font size larger */
  }

  input[type="submit"] {
    width: 100%; /* Make the submit button full width */
    background-color: #dd0d7f;
    color: rgb(5, 5, 5);
    padding: 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 18px; /* Increase submit button font size */
  }

  input[type="submit"]:hover {
    background-color: #45a049;
  }

  .image-select {
    position: relative;
    width: 300px; /* Adjust as needed */
  }

  #imageListBox {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    background-color: #fff;
  }

  #selectedImageContainer {
    margin-top: 10px;
    text-align: center;
  }

  #selectedImage {
    max-width: 100%;
    max-height: 200px; /* Adjust as needed */
  }

  input[type="date"] {
    width: calc(100% - 40px);
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    appearance: none;
    -moz-appearance: none;
    -webkit-appearance: none;
    background-image: url('calendar-icon.png');
    background-size: 20px;
    background-repeat: no-repeat;
    background-position: calc(100% - 10px) center;
    font-size: large; /* Make input font size larger */
  }
  .image-select select {
    width: calc(100% - 40px); /* Adjust the width of the select box */
    padding: 15px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: large;
  }

  .image-select option {
    font-size: large; /* Adjust the font size of the options */
  }

  .image-select option:not(:first-child) {
    padding: 10px 0; /* Adjust the padding of the options */
  }

  .image-select img {
    width: 600px; /* Set the width of the images */
    height: 1500px; /* Automatically adjust height */
    margin-right: 50px; /* Adjust margin between image and text */
    vertical-align: middle; /* Align image vertically */
  }

  .scrolling-text {
    font-style: oblique;
   font-size: large;
    width: 100%;
    white-space: nowrap; /* Prevent text from wrapping */
    overflow: hidden; /* Hide overflowed text */
    animation: marquee 30s linear infinite; /* Apply animation */
  }

  @keyframes marquee {
    0% { transform: translateX(100%); } /* Start from right */
    100% { transform: translateX(-100%); } /* Move to left */
  }

  .gobtn button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .gobtn button:hover {
            background-color: #45a049;
        }
</style>

</head>
<body>
<br><br>
<div class="background-container"></div>
<br><br>
<div class="scrolling-text" >
  Fill the Required details for Customized Gown Stitching
</div>

<br><br>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  <label for="customerName">Customer Name:</label>
  <input type="text" id="customerName" name="customerName" required><br><br>
  
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required><br><br>
  
  <label for="phone">Phone:</label>
  <input type="tel" id="phone" name="phone" required><br><br>
  
  <label for="address">Address:</label><br>
  <textarea id="address" name="address" rows="4" cols="50" required></textarea><br><br>
  
  <label for="bust">Bust:</label>
  <select id="bust" name="bust" required>
    <option value="30">30 inches</option>
    <option value="32">32 inches</option>
     <option value="34">34 inches</option>
      <option value="36">36 inches</option>
      <option value="38">38 inches</option>
      <option value="40">40 inches</option>
      <option value="42">42 inches</option>
      <option value="44">44 inches</option>
      <option value="46">46 inches</option>
    <!-- Add more options as needed -->
  </select><br><br>
  
  <label for="gownlength"> Gown Length:</label>
  <input type="number" id="gownlength" name="gownlength" required
  ><br><br>
  
  <label for="fabricType">Fabric Type:</label>
  <select id="fabricType" name="fabricType" required>
    <option value="Silk">Silk</option>
    <option value="Satin">Satin</option>
     <option value="Satin">Satin</option>
    <option value="Chiffon">Chiffon</option>
    <!-- Add more options as needed -->
  </select><br><br>

  <div class="image-select">
    <label for="gownDesignImage">Select Gown Design:</label>
    <select id="gownDesignImage" name="gownDesignImage" onchange="selectImage(this)" required>
      <option value="" selected disabled>Select Image</option>
      <option value="images/alien.jpg">A-line</option>
      <option value="images/gathered-gown-280x280.jpg">Gathered gown</option>
        <option value="images/empire-gown-280x280.jpg">empire-gown</option>
        <option value="images/high-low-gown-280x280.jpg">high-low-gown</option>
        <option value="images/mermaid-280x280.jpg">mermaid gown</option>
        <option value="images/pleated-gown-280x280.jpg">pleated-gown</option>
        <option value="images/sheath-280x280.jpg">sheath-gown</option>
        <option value="images/sheer-overlay-280x280.jpg">sheer-overlay-gown</option>
        <option value="images/trumpet-280x280.jpg">trumpet-gown</option>
      <!-- Add more options as needed -->
    </select>
    <div id="selectedImageContainer">
      <img id="selectedImage" src="#" alt="Selected Image">
    </div>
  </div>

  <label for="deliveryDate">Delivery Date:</label>
  <input type="date" id="deliveryDate" name="deliveryDate" required>
<br><br>
  <label for="additionalInstructions">Additional Instructions:</label><br>
  <textarea id="additionalInstructions" name="additionalInstructions" rows="4" cols="50"></textarea><br><br>

  <input type="submit" value="Submit Order">
  <br><br>
  <p style="text-align: right;">Size Chart: <a href="designs.html">View Size Chart</a></p>
  <br>
  <div  class="gobtn"><button class="goBack" onclick="goBack()">Go Back</button></div>
</form>

<script>
// Function to display selected image
function selectImage(select) {
  var selectedImage = select.options[select.selectedIndex].value;
  document.getElementById("selectedImage").src = selectedImage;
}
function goBack() {
      window.history.back();
  }
</script>
</body>
</html>
