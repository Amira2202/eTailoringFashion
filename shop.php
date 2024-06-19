<?php 
	include "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
  <
<title>Shopping Page</title>
<style>
    .product-container {
    display: flex;
    flex-wrap: nowrap; /* Prevent products from wrapping */
    overflow-x: auto; /* Enable horizontal scrolling */
    margin-bottom: 20px; /* Add bottom margin to the container */
}

.product-card {
    width: 250px; /* Fixed width for each product */
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 20px;
    margin-right: 20px; /* Adjust spacing between products */
}
    /* Style for the grid */
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        grid-gap: 20px;
        padding: 20px;
    }

    /* Style for individual item */
    .item {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    /* Style for the image */
    .item img {
        width: 100%;
        height: auto;
    }

    /* Style for the view details button */
    .view-details-button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10px;
        cursor: pointer;
        border-radius: 5px;
    }
</style>
</head>
<body>

<div class="grid-container">
    <!-- Item 1 -->
    <div class="item">
        <img src="images/b2.jpg" alt="Item 1">
        <p>Item 1 Description</p>
        <button class="view-details-button">View Details</button>
    </div>

    <!-- Item 2 -->
    <div class="item">
        <img src="images/b5.jpg" alt="Item 2">
        <p>Item 2 Description</p>
        <button class="view-details-button">View Details</button>
    </div>

    <div class="item">
        <img src="images/b5.jpg" alt="Item 2">
        <p>Item 2 Description</p>
        <button class="view-details-button">View Details</button>
    </div>

    <!-- Add more items as needed -->
</div>

<div class="container">
    <div class="row">
        <h1>Products</h1>
        <hr>
        <div class="product-container row">
            <?php 
            $sql = "select * from blousedesigns";
            $res = $con->query($sql);
            if($res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    echo '
                    <div class="col-sm-4 col-lg-3 col-md-3">
                        <div class="product-card text-center">
                            <img src="'. $row['pic'] .'" alt="" class="img-responsive">
                            <p><strong><a href="#">'. $row['pname'] .'</a></strong></p>
                            <h4 class="text-danger"> Rs.'. $row['price'] .'</h4>
                            <p><a href="view.php?id='. $row['pid'] .'" class="btn btn-success">View Details</a></p>
                        </div>
                    </div>';
                }
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
