<?php 
include "configg.php";
session_start();

// Fetch product details based on the product ID passed via URL
$productId = isset($_GET["pid"]) ? $_GET["pid"] : null;
$sql = "SELECT * FROM gowndesigns WHERE pid = '$productId'";
$result = $con->query($sql);

// Check if the product exists
if ($result && $result->num_rows > 0) {
    $product = $result->fetch_assoc();
    $quantity = isset($_GET["qty"]) ? $_GET["qty"] : 1; // Set a default value if quantity is not provided
} else {
    // Product not found or query failed
    $product = null;
}

// Check if the form is submitted and the order is successfully placed
$orderPlaced = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["customerName"]) && isset($_POST["email"])) {
    // Process the order here (saving to the database)
    $customerName = $_POST["customerName"];
    $email = $_POST["email"];
    $productId = $product['pid'];
    $productName = $product['pname'];
    $price = $product['price'];
    $size = $_POST['size']; // Retrieve selected size from the form

    // Insert the order into the database
    $sql = "INSERT INTO orders (customer_name, email, product_id, product_name, price, quantity, size, payment_method) 
    VALUES ('$customerName', '$email', '$productId', '$productName', '$price', '$quantity', '$size', 'cashondelivery')";

    if ($con->query($sql) === TRUE) {
        $orderPlaced = true;
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Now</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<style>
/* Form container */
.container {
  font-size: large;
}

.row {
  max-width: 800px;
  margin: 0 auto;
  padding: 5px;
}

/* Form styles */
.form-group {
  margin-bottom: 20px;
}

.form-control {
  width: 100%;
  padding: 20px;
  font-size: 20px;
  border: 4px solid black;
  border-radius: 5px;
}

.btn-primary {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 5px;
}

/* Success message */
.alert {
  padding: 40px;
  margin-top: 20px;
  border-radius: 5px;
  background-color: #d4edda;
  border: 1px solid #c3e6cb;
  color: #155724;
}

.qr-code {
  max-width: 700px;
  margin: 20px auto;
}
.payment-link {
  cursor: pointer;
  color: blue; /* Change the color of the link as per your preference */
}

.payment-link:hover {
  text-decoration: underline; /* Underline the link on hover */
}

</style>
<body>
  
<div class="container">
  <div class="row">
    <h1>Order Details</h1><hr>
    <table class='table'>  
      <tr>
        <th>Product Name</th>
        <th>Price</th>
      </tr>
      <?php 
      if($product) {
        echo "
          <tr>
            <td>{$product["pname"]}</td>
            <td>{$product["price"]}</td>
          </tr>
        ";
      }
      ?>
    </table>
  </div>

  <div class="row">
    <h2>Place Order</h2>
    <?php if (!$orderPlaced && $product) { ?>
    <form method="post">
      <div class="form-group">
          <label for="customerName">Customer Name:</label>
          <input type="text" class="form-control" id="customerName" name="customerName" required>
      </div>
      <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
          <label for="size">Select Size:</label><br>
          <label><input type="radio" name="size" value="S" required> S</label><br>
          <label><input type="radio" name="size" value="M" required> M</label><br>
          <label><input type="radio" name="size" value="L" required> L</label><br>
          <label><input type="radio" name="size" value="XL" required> XL</label><br>
          <label><input type="radio" name="size" value="XL" required> XLL</label><br>
          <label><input type="radio" name="size" value="XL" required> 3XL</label><br>
          <label><input type="radio" name="size" value="XL" required> FreeSiZe</label>
      </div>

      <a class="payment-link" onclick="toggleQRCode()">Click For Online Payment Method</a>

<br><br><br>
      <input type="submit" class="btn btn-primary" value="Place Order">
    </form>

    <!-- Link for Online Payment Method -->
   

    <!-- Display Google Pay QR Code -->
    <div id="qrCodeContainer" style="display: none;">
      <?php
      if ($product) {
          $price = $product['price'];
          // Replace 'YOUR_QR_CODE_URL' with the URL of your generated QR code image
          echo "<img class='qr-code' src='images/QR.jpeg' alt='Scan QR Code for Payment'>";
      }
      ?>
    </div>

    <?php } elseif ($orderPlaced) { ?>
    <div class="alert alert-success" role="alert">
      Order successfully placed! Thank you for your purchase.
    </div>
    <?php } ?>
  </div>
</div>

<script>
function showQRCode() {
  var qrCodeContainer = document.getElementById('qrCodeContainer');
  qrCodeContainer.style.display = 'block';
}
function toggleQRCode() {
  var qrCodeContainer = document.getElementById('qrCodeContainer');
  qrCodeContainer.style.display = qrCodeContainer.style.display === 'none' ? 'block' : 'none';
}

</script>

</body>
</html>
