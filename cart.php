<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your main CSS file -->
    <style>
        /* Inline CSS for specific styles */
        body {
            background-color: #f2f2f2; /* Set background color */
            font-family: Arial, sans-serif; /* Set default font family */
            color: #333; /* Set default text color */
            padding: 20px; /* Add some padding */
        }

        h1 {
            color: #333; /* Set heading color */
            text-align: center; /* Center align the heading */
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .product-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .product-details {
            margin-left: 20px;
        }

        .product-image {
            width: 140px; /* Set width for the product image */
            height: auto; /* Maintain aspect ratio */
            vertical-align: middle; /* Align image vertically */
        }

        .remove-button {
            background-color: #dc3545; /* Set background color for remove button */
            color: #fff; /* Set text color for remove button */
            border: none; /* Remove border */
            padding: 5px 10px; /* Add padding */
            border-radius: 5px; /* Add border radius */
            cursor: pointer; /* Add cursor pointer */
        }

        .remove-button:hover {
            background-color: #c82333; /* Darker background color on hover */
        }

        .checkout-button {
            display: block;
            width: 100%;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            text-decoration: none;
        }

        .checkout-button:hover {
            background-color: #0056b3; /* Darker background color on hover */
        }

        .continue-shopping {
            display: block;
            width: fit-content;
            margin: 20px auto;
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }

        .continue-shopping:hover {
            background-color: #218838; /* Darker background color on hover */
        }

        .empty-cart-message {
            text-align: center;
            font-size: 18px;
            color: #777;
            margin-top: 50px;
        }

        .empty-cart .continue-shopping:hover {
            background-color: #218838; /* Darker background color on hover */
        }
    </style>
</head>
<body>

<section id="shopping-cart">
    <div class="container">
        <?php
        $page_roles = array('Admin', 'Customer');
        require_once 'login.php';
        require_once 'checksession.php';

        // Display the shopping cart
        if (!empty($_SESSION['cart'])) {
            echo '<h1>Shopping Cart</h1>';

            $total_price = 0;
            foreach ($_SESSION['cart'] as $product_id => $product) {
                // Initialize the $product_id variable
                $product_id = (int)$product_id;

                // Fetch the product details from the database based on Product_ID
                $conn = new mysqli($hn, $un, $pw, $db);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT `Image Source` FROM products WHERE Product_ID = $product_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Display the product details along with the image
                        echo '<div class="product-container">';
                        echo '<img src="' . $row["Image Source"] . '" alt="' . $product['name'] . '" class="product-image">';
                        echo '<div class="product-details">';
                        echo '<p>Name: ' . $product['name'] . '</p>';
                        echo '<p>Price: $' . $product['price'] . '</p>';
                        echo '<p>Quantity: ' . $product['quantity'] . '</p>';
                        echo '<button class="remove-button" onclick="removeFromCart(' . $product_id . ')">Remove</button>';
                        echo '</div>';
                        echo '</div>';
                        $total_price += $product['price'] * $product['quantity'];
                    }
                }
                // No need to display any message if there are no rows returned
                $conn->close();
            }

            // Storing total price in the session
            $_SESSION['total_price'] = $total_price;

            echo '<Strong><p>Total Price: $' . $total_price . '</p>';
            // Display the checkout button
            echo '<a href="checkout.php" class="checkout-button">Checkout</a>';
            // Continue shopping link
            echo '<a href="Products.php" class="continue-shopping">Continue Shopping</a>';
        } else {
            echo '<p class="empty-cart-message empty-cart">Your cart is empty. <a href="Products.php" class="continue-shopping">Continue shopping</a></p>';
        }
        ?>
    </div>
</section>

<script>
    // Function to remove an item from the cart
    function removeFromCart(product_id) {
        // Redirect to remove-from-cart.php with the product_id
        window.location.href = 'remove-from-cart.php?remove=' + product_id;
    }
</script>

</body>
</html>
