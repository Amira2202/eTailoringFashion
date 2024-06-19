<?php
include "configg.php";
session_start();


// Fetch orders from the database
$sql = "SELECT * FROM orders";
$result = $con->query($sql);

// Check if any orders exist
if ($result && $result->num_rows > 0) {
    $orders = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $orders = []; // Empty array if no orders found
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            text-align: center;
        }
        .table {
            background-color: #fff;
        }
        .table th {
            background-color: #f0f0f0;
        }
        .table th, .table td {
            text-align: center;
        }
        .delete-btn {
            color: #fff;
            background-color: #d9534f;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
  
<div class="container">
  <h1> Orders From Customers</h1>
  <hr>
  <table class="table">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Customer Name</th>
        <th>Email</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Size</th>
        <th>Payment Method</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders as $order) : ?>
        <tr>
          <td><?php echo $order['order_id']; ?></td>
          <td><?php echo $order['customer_name']; ?></td>
          <td><?php echo $order['email']; ?></td>
          <td><?php echo $order['product_name']; ?></td>
          <td><?php echo $order['price']; ?></td>
          <td><?php echo $order['quantity']; ?></td>
          <td><?php echo $order['size']; ?></td>
          <td><?php echo $order['payment_method']; ?></td>
          <td><button class="delete-btn" onclick="deleteOrder(<?php echo $order['order_id']; ?>)">Delete</button></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
    function deleteOrder(orderId) {
        if (confirm('Are you sure you want to delete this order?')) {
            $.ajax({
                url: 'orderdelete.php',
                type: 'POST',
                data: { order_id: orderId },
                success: function(response) {
                    if (response === 'success') {
                        // Reload the page after successful deletion
                        location.reload();
                    } else {
                        // Display error message if deletion fails
                        alert('Failed to delete order.');
                    }
                },
                error: function() {
                    // Display error message if AJAX request fails
                    alert('An error occurred while deleting the order.');
                }
            });
        }
    }
</script>

</body>
</html>
