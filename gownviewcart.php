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
  .background-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('images/abt.jpg'); /* Add your background image URL here */
      background-size: cover;
      filter: blur(5px); /* Add blur effect */
      z-index: -1; /* Set z-index to position behind other content */
    }
	</style>
</head>

<body>
  
<div class="container">
  <div class="row">
			<h1>Cart Items</h1>
			<a href='gownshop.php'>Home</a>
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
				if(isset($_GET["del"]))
				{
					foreach($_SESSION["cart"] as $keys=>$values)
					{
							if($values["pid"]==$_GET["del"])
							{
								unset($_SESSION["cart"][$keys]);
							}
					}
				}
					if(!empty($_SESSION["cart"]))
					{
							$total=0;
							foreach($_SESSION["cart"] as $keys=>$values)
							{
								$amt=$values["qty"]*$values["price"];
									$total+=$amt;
									echo "
											<tr>
												<td>{$values["pname"]}</td>
												<td>{$values["qty"]}</td>
												<td>{$values["price"]}</td>
												<td>{$amt}</td>
												<td><a href='viewCart.php?del={$values["pid"]}'>Remove</a></td>
												<td><a href='buygown.php?pid={$values["pid"]}' class='btn btn-buy'>Buy Now</a></td>
											</tr>
									";
									
							}	
								echo "
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td>Total</td>
												<td>{$total}</td>
												<td><a href='gownviewcart.php?del={$values["pid"]}'>Buy Now</a></td>
											</tr>";							
							
					}
				?>
			</table>
			
  </div>
</div>

</body>
</html>
