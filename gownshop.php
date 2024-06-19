<?php 
    include "configg.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Page - tailor shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: pink;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .background-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('ubg5.jpg'); /* Add your background image URL here */
      background-size: cover;
      filter: blur(5px); /* Add blur effect */
      z-index: -1; /* Set z-index to position behind other content */
    }
        .cart {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            background-color: black;
            color: #fff;
            border-radius: 50%;
        }

        .cart img {
            width: 50px;
            margin-right: 5px;
        }

        .cart span {
            font-size: 18px;
        }

       

        header {
            text-align: center;
        }

        footer {
            text-align: center;
            color: #666;
        }

        .product-container {
            display: grid;
          
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
            /* Automatically adjust grid columns based on available space */
            grid-template-rows: repeat(0, auto);
            gap: 20px; /* Spacing between grid items */
            margin-bottom: 0px;
        }

        .product-card {
            background-color: black;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 10px;
            color: white;
            
       
        }

        b, strong {
  font-weight: 700;
  font-size: x-large;
}

.h1, h1 {
  font-size: 36px;
  color: white;
}
    </style>
</head>
<body>
<div class="background-container"></div>
<div class="cart">
    <a href="viewCart.php">
        <img src="images/cart.png" alt="Cart">
    </a>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <h1>Products</h1>
            
            <div class="product-container">
                <?php 
                    $sql="select * from gowndesigns";
                    $res=$con->query($sql);
                    if($res->num_rows>0) {
                        while($row=$res->fetch_assoc()) {
                            echo  '
                                <div class="product-card">
                                    <img src="'. $row['pic'] .'" alt="" class="img-responsive">
                                    <p><strong><a href="#">'. $row['pname'] .'</a></strong></p>
                                    <h4 class="text-danger"> Rs.'. $row['price'] .'</h4>
                                    <p><a href="gownview.php?id='. $row['pid'] .'" class="btn btn-success">View Details</a></p>
                                </div>
                            ';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>
            
</body>
</html>

