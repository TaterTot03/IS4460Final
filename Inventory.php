<!DOCTYPE html>
<?php
$page_roles = array('Admin');
require_once 'login.php';
require_once 'checksession.php';

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the JSON data sent from the client side
    $data = json_decode(file_get_contents("php://input"), true);

    // Connect to the database
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Iterate over each product in the data
    foreach ($data as $productId => $quantity) {
        // Prepare and execute the SQL update query to update the quantity
        $sql = "UPDATE inventory SET Quantity = Quantity + ? WHERE Product_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $quantity, $productId);
        $stmt->execute();
    }

    // Close the database connection
    $conn->close();

    // Send a response back to the client side
    http_response_code(200); // Success status code
    echo "Inventory updated successfully";
    exit;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Inventory - Fish R Us</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Inline CSS for table styling */
        .table-container {
            width: auto; /* Adjusted width */
            margin: 20px auto; /* Center the container horizontally */
            position: relative; /* Make container position relative */
        }
        table {
            width: 100%; /* Adjusted table width */
            border-collapse: collapse;
            border: 1px solid #ddd; /* Added border for consistency */
        }
        th, td {
            padding: 8px; /* Increased padding for better readability */
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        }
        .dropdown {
            position: absolute;
            top: 0;
            right: 0;
            margin: 20px;
            cursor: pointer;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
		form {
        margin-right: 5px; /* Adjust margin as needed */
    }

    /* Styling for buttons */
    button.delete-button {
        background-color: #4a90e2; /* Updated color */
        color: white;
        padding: 8px 16px;
        border: none;
        cursor: pointer;
        border-radius: 6px;
        margin-right: 5px;
    }

    button.delete-button:hover {
        background-color: #357ae8; /* Darker blue color on hover */
    }

    button.update-button {
        background-color: #4a90e2; /* Updated color */
        color: white;
        padding: 8px 16px;
        border: none;
        cursor: pointer;
        border-radius: 6px;
        margin-right: 5px;
    }

    button.update-button:hover {
        background-color: #357ae8; /* Darker blue color on hover */
    }

    /* New button styling */
    .purchase-button {
        background-color: #4a90e2;
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 6px;
        position: absolute;
        top: 0;
        right: 0;
    }

    .purchase-button:hover {
        background-color: #357ae8;
    }
    </style>
</head>
<body>
    <header>
        <h1>Fish R Us</h1>
        <nav>
            <ul>
                <li><a href="Homepage.php">Home</a></li>
                <li><a href="Products.php">Products</a></li>
                <li><a href="Orders.php">Orders</a></li>
                <li><a href="Employees.php">Employees</a></li>
                <li><a href="Stores.php">Stores</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section id="inventory">
        <div class="container">
            <div class="table-container"> <!-- Move table-container outside of h2 -->
                <h2 style="text-align: center;">Current Inventory</h2> <!-- Center the header -->
                <!-- New Purchase Inventory button -->
                <a href="Purchase_Inventory.php" class="purchase-button">Purchase Inventory</a>
                <table>
                    <!-- Table headers -->
                    <thead>
                        <tr>
                            <th>Inventory ID</th>
                            <th>Product Name</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody>
                        <?php
                        // Connect to the database
                        $conn = new mysqli($hn, $un, $pw, $db);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Retrieve and display inventory information from the database
                        $query = "SELECT i.Inventory_ID, p.`Product Name`, p.Type, i.Quantity, i.Cost 
						FROM inventory i
						JOIN products p ON i.Product_ID = p.Product_ID";
						                        $result = $conn->query($query);
                        if (!$result) {
                            die("Query failed: " . $conn->error);
                        }

                        // Check if                        // Check if data is being fetched
                        if ($result->num_rows > 0) {
                            // Display the table with inventory details
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['Inventory_ID'] . "</td>";
                                echo "<td>" . $row['Product Name'] . "</td>"; // Fixed column name
                                echo "<td>" . $row['Type'] . "</td>";
                                echo "<td>" . $row['Quantity'] . "</td>";
                                echo "<td>$" . $row['Cost'] . "</td>"; // Display Cost with $
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No inventory records found</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="container">
        <p>&copy; 2024 Fish R Us. All rights reserved.</p>
    </div>

    <!-- JavaScript for submitting order and updating inventory -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitOrderButton = document.querySelector('.submit-order-button');

            // Add event listener to submit order button
            submitOrderButton.addEventListener('click', function() {
                // Prepare data to send to server
                const purchaseButtons = document.querySelectorAll('.purchase-button');
                const data = {};
                purchaseButtons.forEach(function(button) {
                    const productId = button.parentElement.parentElement.querySelector('td:first-child').textContent;
                    const quantity = parseInt(button.parentElement.parentElement.querySelector('.quantity-input').value);
                    if (!isNaN(quantity) && quantity > 0) {
                        data[productId] = quantity;
                    }
                });

                // Send a POST request to update inventory
                fetch('Inventory.php', { // Updated URL to Inventory.php
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to update inventory');
                    }
                    return response.text();
                })
                .then(message => {
                    // Hide roles and show success message
                    document.querySelector('header nav').style.display = 'none';
                    document.querySelector('#inventory').innerHTML = "<div style='text-align:center;'><h2>Inventory Updated Successfully</h2></div>";
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to update inventory. Please try again.');
                });
            });
        });
    </script>
</body>
</html>

