<!DOCTYPE html>
<?php
$page_roles = array('Admin');
require_once 'login.php';
require_once 'checksession.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Inventory - Fish R Us</title>
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
    }

    .purchase-button:hover {
        background-color: #357ae8;
    }

    /* Quantity input styling */
    .quantity-input {
        width: 50px; /* Adjust width as needed */
        margin-left: 5px; /* Add some space between the button and input */
    }

    /* Submit button styling */
    .submit-order-button {
        background-color: #4a90e2;
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: block;
        margin: 20px auto;
        cursor: pointer;
        border-radius: 6px;
        transition: background-color 0.3s ease; /* Added transition effect */
    }

    .submit-order-button:hover {
        background-color: #357ae8;
    }

    /* Total cost styling */
    #total-cost {
    text-align: center;
    margin-bottom: 40px; /* Increase margin to move it further away */
    font-weight: bold; /* Make it bold */
    font-size: 20px; /* Increase font size */
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
				<li><a href="Inventory.php">Inventory</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section id="inventory">
        <div class="container">
            <div class="table-container"> <!-- Move table-container outside of h2 -->
                <h2 style="text-align: center;">Purchase Inventory</h2> <!-- Center the header -->
                <table>
                    <!-- Table headers -->
                    <thead>
                        <tr>
                            <th>Product ID</th> <!-- New column for Product ID -->
                            <th>Product Name</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Cost</th>
                            <th>Actions</th> <!-- Add column for action buttons -->
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
                        $query = "SELECT i.Product_ID, p.`Product Name`, p.Type, i.Quantity, i.Cost 
						FROM inventory i
						JOIN products p ON i.Product_ID = p.Product_ID";
                        $result = $conn->query($query);
                        if (!$result) {
                            die("Query failed: " . $conn->error);
                        }

                        // Check if data is being fetched
						                        if ($result->num_rows > 0) {
                            // Display the table with inventory details
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='product-id'>" . $row['Product_ID'] . "</td>"; // Display Product ID
                                echo "<td>" . $row['Product Name'] . "</td>";
                                echo "<td>" . $row['Type'] . "</td>";
                                echo "<td>";
                                echo "<input type='number' class='quantity-input' name='quantity' value='1' min='1'>"; // Quantity input
                                echo "</td>";
                                echo "<td class='cost-column'>$" . $row['Cost'] . "</td>"; // Display Cost with $
                                echo "<td>";
                                echo "<button type='button' class='purchase-button'>Add</button>"; // Change type to button
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No inventory records found</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>

                <div id="total-cost"></div> <!-- Empty div for total cost -->

                <button class="submit-order-button">Submit Order</button>

            </div>
        </div>
    </section>

    <div class="container">
        <p>&copy; 2024 Fish R Us. All rights reserved.</p>
    </div>

    <!-- JavaScript for calculating total cost -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const purchaseButtons = document.querySelectorAll('.purchase-button');
            const totalCostDiv = document.getElementById('total-cost');
            const submitOrderButton = document.querySelector('.submit-order-button');
            let totalCost = 0;
            let inventoryData = {}; // Object to store updated inventory data

            // Add event listener to each purchase button
            purchaseButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    const quantityInput = button.closest('tr').querySelector('.quantity-input');
                    const quantity = parseInt(quantityInput.value);
                    const cost = parseFloat(button.closest('tr').querySelector('.cost-column').textContent.substring(1));
                    const productId = button.closest('tr').querySelector('.product-id').textContent;

                    totalCost += quantity * cost;
                    totalCostDiv.textContent = 'Total Cost: $' + totalCost.toFixed(2);

                    // Update inventory data object
                    if (!inventoryData[productId]) {
                        inventoryData[productId] = 0;
                    }
                    inventoryData[productId] += quantity;
                });
            });

            // Add event listener to the "Submit Order" button
            submitOrderButton.addEventListener('click', function(event) {
                event.preventDefault();

                // Send a POST request to update inventory
                fetch('Inventory.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(inventoryData),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to update inventory');
                    }
                    return response.text();
                })
                .then(message => {
                    alert(message); // Show success message
                    window.location.href = "Inventory.php"; // Redirect to Inventory.php
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

