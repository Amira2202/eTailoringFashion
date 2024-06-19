
<?php
session_start();

// Initialize cart session variable if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Function to add item to cart
function addToCart($productId) {
    $_SESSION['cart'][] = $productId;
}

// Function to get cart items
function getCartItems() {
    return $_SESSION['cart'];
}

// Add item to cart if product ID is provided
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    addToCart($productId);
    header('Location: shop.php'); // Redirect to shopping page after adding to cart
    exit();
}

// View cart
if (isset($_GET['view_cart'])) {
    $cartItems = getCartItems();
    // Output cart items (you can format as needed)
    foreach ($cartItems as $itemId) {
        echo "Product ID: $itemId<br>";
        // Retrieve product details from database and display
    }
}

// Process order
if (isset($_POST['place_order'])) {
    // Here you would typically save order details to database, update inventory, etc.
    // Clear the cart after order is placed
    $_SESSION['cart'] = [];
    echo "Order placed successfully!";
}
?>
