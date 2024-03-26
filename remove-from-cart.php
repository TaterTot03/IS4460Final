<?php

session_start();

if (isset($_GET['remove']) && !empty($_GET['remove'])) {
    $product_id = $_GET['remove'];

    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
        $_SESSION['message'] = 'Product removed from cart.';
    }

    // Redirect back to the cart page
    header('Location: cart.php');
    exit();
}


?>

