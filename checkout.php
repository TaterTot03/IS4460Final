<?php
// Start the session

// Include necessary files
$page_roles = array('Admin', 'Customer');
require_once 'login.php';
require_once 'checksession.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the payment (fake implementation)
    $cardholder_name = $_POST['cardholder_name'];
    $card_number = $_POST['card_number'];
    $expiration_date = $_POST['expiration_date'];
    $cvv = $_POST['cvv'];

    // Insert order details into the database
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve customer ID and total price from session
    $customer_id = $_SESSION['Customer_ID'] ?? null; // Assuming the session variable is 'Customer_ID'
    $total_price = $_SESSION['total_price'] ?? null; // Assuming you have stored the total price in session

    // Check if Customer_ID is set in the session
    if ($customer_id === null) {
        die("Error: Customer ID is not set in the session.");
    }

    // Get current date
    $date = date('Y-m-d');

    // Prepare and execute the INSERT statement
    $stmt = $conn->prepare("INSERT INTO `order` (`Customer_ID`, `Date`, `Total_Price`) VALUES (?, ?, ?)");
    $stmt->bind_param("isd", $customer_id, $date, $total_price);
    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
    }

    // Update inventory quantity
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $quantity_ordered = $product['quantity'];
        $sql_update_inventory = "UPDATE inventory SET Quantity = Quantity - ? WHERE Product_ID = ?";
        $stmt_update_inventory = $conn->prepare($sql_update_inventory);
        $stmt_update_inventory->bind_param("ii", $quantity_ordered, $product_id);
        $stmt_update_inventory->execute();
        $stmt_update_inventory->close();
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();

    // Clear the cart after successful checkout
    $_SESSION['cart'] = array();
    echo 'Checkout successful. Your order total was $' . $total_price . '.';
    // Redirect to Homepage.php
    header('Location: Homepage.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content here -->
</head>
<body>
    <!-- HTML content here -->
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content here -->
</head>
<body>
    <!-- HTML content here -->
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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

        .checkout-form {
            background-color: #fff; /* Set background color */
            padding: 20px; /* Add some padding */
            border-radius: 5px; /* Add border radius */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add box shadow */
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input[type="submit"] {
            background-color: #007bff; /* Set background color for submit button */
            color: #fff; /* Set text color for submit button */
            border: none; /* Remove border */
            padding: 10px; /* Add padding */
            border-radius: 5px; /* Add border radius */
            cursor: pointer; /* Add cursor pointer */
            font-size: 16px; /* Set font size */
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3; /* Darker background color on hover */
        }

        .continue-shopping {
            display: block;
            width: fit-content;
            margin-top: 20px;
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
    </style>
</head>
<body>

<section id="checkout">
    <div class="container">
        <h1>Checkout</h1>
        <div class="checkout-form">
            <form action="checkout.php" method="post" onsubmit="return confirmOrder()">
                <div class="form-group">
                    <label for="cardholder_name">Cardholder Name:</label>
                    <input type="text" id="cardholder_name" name="cardholder_name" required>
                </div>
                <div class="form-group">
                    <label for="card_number">Card Number:</label>
                    <input type="text" id="card_number" name="card_number" required>
                </div>
                <div class="form-group">
                    <label for="expiration_date">Expiration Date:</label>
                    <input type="text" id="expiration_date" name="expiration_date" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit Order">
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function confirmOrder() {
        if (confirm("Are you sure you want to submit the order?")) {
            alert("Order submitted successfully!");
            return true;
        } else {
            return false;
        }
    }
</script>

</body>
</html>
