<?php 
	include "config.php";
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Php Cart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <style>
    /* Custom CSS for enhanced interactivity */
    body {
      font-family: 'Titillium Web', sans-serif;
     
    }
    .background-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('ubg3.jpg'); /* Add your background image URL here */
      background-size: cover;
      filter: blur(5px); /* Add blur effect */
      z-index: -1; /* Set z-index to position behind other content */
    }
    h1 {
      text-align: center;
      margin-top: 20px;
      margin-bottom: 30px;
    }
    .table {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }
    th, td {
      text-align: center;
    }
    th {
      background-color: #f2f2f2;
    }
    .btn-buy {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      transition-duration: 0.4s;
      cursor: pointer;
      border-radius: 5px;
    }
    .btn-buy:hover {
      background-color: #45a049;
    }
    .btn-buy:active {
      background-color: #3e8e41;
      transform: translateY(2px);
    }
  </style>
</head>
<body>
  <div class="background-container"></div>
<div class="container">
  <div class="row">
    <h1>Cart Items</h1>
    <a href='sh.php'>Home</a>
    <table class='table'>	
      <tr>
        <th>Item Name</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Total</th>
        <th>Remove</th>
        <th>Buy</th>
      </tr>
      <?php 
      if(isset($_GET["del"])) {
        foreach($_SESSION["cart"] as $keys=>$values) {
          if($values["pid"]==$_GET["del"]) {
            unset($_SESSION["cart"][$keys]);
          }
        }
      }
      if(!empty($_SESSION["cart"])) {
        $total = 0;
        foreach($_SESSION["cart"] as $keys=>$values) {
          $amt = $values["qty"] * $values["price"];
          $total += $amt;
          echo "
            <tr>
              <td>{$values["pname"]}</td>
              <td>{$values["size"]}</td>
              <td>{$values["qty"]}</td>
              <td>{$values["price"]}</td>
              <td>{$amt}</td>
              <td><a href='viewCart.php?del={$values["pid"]}'>Remove</a></td>
              <td><a href='buy.php?pid={$values["pid"]}' class='btn btn-buy'>Buy Now</a></td>
            </tr>";		
        }	
        echo "
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td>Total</td>
              <td>{$total}</td>
              <td><a href='viewCart.php?del={$values["pid"]}' class='btn btn-buy'>Buy Now</a></td>
            </tr>";							
      }
      ?>
    </table>
  </div>
</div>

</body>
</html>
