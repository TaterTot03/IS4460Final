<!DOCTYPE html>
<?php
$page_roles = array('Admin', 'Customer');
require_once 'login.php';
require_once 'checksession.php';

// Check if the Add to Cart button is clicked
if(isset($_POST['add_to_cart'])) {
    // Validate the product ID, name, price, and quantity
    if(isset($_POST['Product_ID'], $_POST['Product_Name'], $_POST['Product_Price'], $_POST['Product_Quantity'])) {
        $product_id = $_POST['Product_ID'];
        $product_name = $_POST['Product_Name'];
        $product_price = $_POST['Product_Price'];
        $product_quantity = $_POST['Product_Quantity'];

        // Add the product to the cart session
        $_SESSION['cart'][$product_id] = array(
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $product_quantity
        );
    }
    else {
        // Handle missing or invalid data
        echo "Error: Missing or invalid data.";
    }
}

// Fetch products from the database
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `Product Name`, `Image Source`, `Product Description`, `Product Price`, `Product_ID` FROM products";
$result = $conn->query($sql);

$conn->close();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish R Us - Products</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        h2 {
            text-align: Center;
        }
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }
        .product {
            position: relative; /* Added position relative */
            width: 30%;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .product:hover {
            transform: translateY(-5px);
        }
        .product img {
            width: 100%;
            height: 270px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }
        .product-info {
            padding: 20px;
        }
        .product h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .product p {
            margin: 0;
        }
        .product p strong {
            font-weight: bold;
        }
        .add-to-cart {
            position: absolute; /* Added position absolute */
            bottom: 10px; /* Adjusted bottom position */
            right: 10px; /* Adjusted right position */
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .add-to-cart:hover {
            background-color: #357ae8;
        }
        .product-quantity {
            position: absolute;
            bottom: 10px;
            left: 10px;
        }

        .product-quantity input[type="number"] {
            width: 80px;
            height: 40px;
            padding: 20px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
		.cart-icon {
            position: absolute; /* Position the cart icon absolutely */
            top: 10px; /* Adjust top position */
            right: 10px; /* Adjust right position */
            width: 40px; /* Set width */
            height: auto; /* Maintain aspect ratio */
            cursor: pointer; /* Add cursor pointer */
        }

        .cart-icon img {
            width: 100%; /* Make sure the image fills its container */
            height: auto; /* Maintain aspect ratio */
        }
        /* Add styles for the badge */
        .cart-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 4px 8px;
            font-size: 12px;
        }
        /* Navigation bar styles */
        header {
            background-color: #0098CC;; /* Change background color to blue */
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            padding: 0;
            list-style-type: none;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Your existing HTML content -->
    <header>
        <h1>Fish R Us</h1>
        <!-- Add the cart icon with the badge -->
        <div class="cart-icon">
            <a href="cart.php">
                <img src="cart.png" alt="Shopping Cart">
                <!-- Display the badge with the item count -->
                <?php
                // Calculate the item count in the cart
                $item_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                // Display the badge only if there are items in the cart
                if($item_count > 0) {
                    echo '<span class="cart-badge">' . $item_count . '</span>';
                }
                ?>
            </a>
        </div>
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
        <h2>Our Products</h2>
        <div class="product-list">
<?php
                        // Check if there are any products in the database
            if ($result->num_rows > 0) {
                // Loop through each row of products and display them
                while($row = $result->fetch_assoc()) {
                    echo '<div class="product">';
                    echo '<img src="' . $row["Image Source"] . '" alt="' . $row["Product Name"] . '">';
                    echo '<div class="product-info">';
                    echo '<h3>' . $row["Product Name"] . '</h3>';
                    echo '<p>' . $row["Product Description"] . '</p>';
                    echo '<p><strong>$' . $row["Product Price"] . '</strong></p>';
                    echo '</div>';
                    // Add to Cart form
                    echo '<form method="post">';
                    echo '<input type="hidden" name="Product_ID" value="' . $row["Product_ID"] . '">';
                    echo '<input type="hidden" name="Product_Name" value="' . $row["Product Name"] . '">';
                    echo '<input type="hidden" name="Product_Price" value="' . $row["Product Price"] . '">';
                    echo '<input type="number" name="Product_Quantity" value="1" min="1" max="10">';
                    echo '<button class="add-to-cart" type="submit" name="add_to_cart">Add to Cart</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "No products found.";
            }
?>
        </div>
    </div>

    <div class="container">
        <p>&copy; 2024 Your Company. All rights reserved.</p>
    </div>
    
</body>
</html>

