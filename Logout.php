<?php
$page_roles = array('Admin', 'Customer');
require_once 'login.php';
require_once 'checksession.php';

// Check if logout request is received
if (isset($_POST['logout'])) {
    destroy_session_and_data();
}

function destroy_session_and_data() {
    // Clear shopping cart session data
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }

    // Destroy session data
    $_SESSION = array();
    session_destroy();

    // Redirect to login page after logout
    header("Location: Login Page.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you have a styles.css file for styling -->
</head>
<body>
    <header>
        <h1>Fish R Us</h1>
        <nav>
    <ul>
        <?php if ($_SESSION['Role'] === 'Admin'): ?>
            <!-- Show these links only to Admin users -->
            <li><a href="Products.php">Products</a></li>
            <li><a href="Orders.php">Orders</a></li>
            <li><a href="Customers.php">Customers</a></li>
            <li><a href="Employees.php">Employees</a></li>
            <li><a href="Stores.php">Stores</a></li>
            <li><a href="Inventory.php">Inventory</a></li>
        <?php endif; ?>
        <?php if ($_SESSION['Role'] === 'Customer'): ?>
            <!-- Show these links only to Customer users -->
            <li><a href="Homepage.php">Home</a></li>
            <li><a href="Products.php">Products</a></li>
        <?php endif; ?>
        <!-- Common links for all users -->
        <li><a href="Homepage.php#about">About Us</a></li>
        <li><a href="Homepage.php#services">Our Services</a></li>
        <li><a href="Homepage.php#contact">Contact Us</a></li>
        <li><a href="Logout.php">Logout</a></li>
    </ul>
</nav>
    </header>

    <div class="container">
        <h2>Logout</h2>
        <p>Are you sure you want to log out?</p>
        <form action="" method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>

    <div class="container">
        <p>&copy; 2024 Fish R Us. All rights reserved.</p>
    </div>
    
</body>
</html>
