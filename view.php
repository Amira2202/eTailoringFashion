<?php 
    include "configg.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.csss">
</head>
<style>/* style.csss */

/* Add custom styles here */

/* Set font family */
body {
  font-family: 'Titillium Web', sans-serif;
  background-color: whitesmoke;
}
.h1, h1 {
  font-size: 36px;
  color: #eae9e5;
}
/* Style the container */
.container {
  margin-top: 20px;
  width: 1800px;
}

/* Style the heading */
h1 {
  text-align: center;
  margin-bottom: 30px;
}

/* Style the product box */
.col-sm-4 {
  margin-bottom: 20px;
}

.product-img {
  width: 100%;
  height: auto;
  border: 1px solid #ccc;
  padding: 5px;
  cursor: pointer; /* Add cursor pointer to indicate clickability */
}

.product-name {
  font-weight: bold;
  color: black;
}

.product-price {
  color: red;
  font-style: bold;
}

.qty-input {
  width: 200px;
}

/* Style the Add to Cart button */
.add-to-cart-btn {
  width: 100%;
  padding: 20px;
  color: black;
  font-size: large;
}

/* Style the View Cart button */
.view-cart-btn {
  display: block;
  margin-top: 20px;
  text-align: center;
  padding: 10px;
  color: black;
  font-size: large;
  width: 10%;
}

/* Responsive styles */
@media (max-width: 768px) {
  .col-sm-4 {
    width: 100%;
  }
}

.background-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('ubg4.jpg'); /* Add your background image URL here */
      background-size: cover;
      filter: blur(5px); /* Add blur effect */
      z-index: -1; /* Set z-index to position behind other content */
    }
 
  

</style>
<body>
  <div class="background-container"></div>
<div class="text-center">
<div class="container">
  <div class="row">
  <div class="col-sm-12"> <!-- Center align the content -->
	
    <h1>Checkout Products</h1>
    <?php 
    if(isset($_POST["addCart"])){
      if(isset($_SESSION["cart"])) {
        $pid_array=array_column($_SESSION["cart"],"pid");
        if(!in_array($_GET["id"],$pid_array)) {
          $index=count($_SESSION["cart"]);
          $item=array(
            'pid' => $_GET["id"],
            'pname' => $_POST["pname"],
            'price' => $_POST["price"],
            'qty' => $_POST["qty"]
          );
          $_SESSION["cart"][$index]=$item;
          echo "<script>alert('Product Added..');</script>";
          header("location:viewCart.php");
        } else {
          echo "<script>alert('Already Added..');</script>";
        }
      } else {
        $item=array(
          'pid' => $_GET["id"],
          'pname' => $_POST["pname"],
          'price' => $_POST["price"],
          'qty' => $_POST["qty"]
        );
        $_SESSION["cart"][0]=$item;
        echo "<script>alert('Product Added..');</script>";
        header("location:viewCart.php");
      }
    }

    $sql="select * from blousedesigns where pid='{$_GET["id"]}'";
    $res=$con->query($sql);
    if($res->num_rows>0) {
      echo '<form action="'.$_SERVER["REQUEST_URI"].'" method="post">';
      if($row=$res->fetch_assoc()) {
        echo  '
          <div class="col-sm-4 col-lg-3 col-md-3 text-center">    
            <img src="'. $row['pic'] .'" alt="" class="img-responsive product-img" data-toggle="modal" data-target="#previewModal">
            <p><strong><a href="#">'. $row['pname'] .'</a></strong></p>
            <p><strong><a href="#">'. $row['description'] .'</a></strong></p>
            <h4 class="text-danger"> Rs.'. $row['price'] .'</h4>
            <p>
            <select name="size" class="form-control">
                <option value="" disabled selected>Select size</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
            </select>
        </p>
        

            <p><input type="text"  placeholder="Enter Qty" name="qty"  class="form-control"></p>
            <p><input type="hidden"  name="pname" value="'. $row['pname'] .'" class="form-control"></p>
            <p><input type="hidden"  name="price" value="'. $row['price'] .'" class="form-control"></p>
            <p><input type="submit" name="addCart" class="btn btn-success add-to-cart-btn" value="Add to Cart"></p>
          </div>
        ';
      }
      echo '</form>';
    }
	
    ?>
  </div>
  
  <button class="btn btn-primary view-cart-btn" onclick="window.location.href='viewCart.php'">View Cart</button>
</div>


<!-- Modal for image preview -->
<div id="previewModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <img src="" id="previewImage" class="img-responsive">
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('.product-img').click(function(){
      var imgSrc = $(this).attr('src');
      $('#previewImage').attr('src', imgSrc);
    });
  });
</script>

</body>
</html>
