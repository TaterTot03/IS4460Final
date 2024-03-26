<!DOCTYPE html>
<?php
$page_roles = array('Admin');
require_once 'login.php';
require_once 'checksession.php';

// Check if the delete form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_order'])) {
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    $Order_ID = $conn->real_escape_string($_POST['delete_order']);

    // Delete the order from the database
    $query = "DELETE FROM `order` WHERE `Order_ID`='$Order_ID'";
    $result = $conn->query($query);
    if (!$result) die("Delete failed: " . $conn->error);
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Fish R Us</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Inline CSS for table styling */
        .table-container {
            width: auto; /* Adjusted width */
            margin: 20px auto; /* Center the container horizontally */
            position: relative; /* Added position relative for positioning the Add Order button */
        }
        table {
            width: 100%; /* Adjusted table width */
            border-collapse: collapse;
            text-align: center; /* Center the content of the table */
        }
        th, td {
            padding: 4px; /* Reduced padding */
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        /* Added style for buttons */
        .action-buttons button {
            margin-right: 5px; /* Add margin between buttons */
        }
        /* Adjusted position for Add Order button */
        .add-order-button {
            position: absolute;
            top: 0px; /* Adjusted top position */
            right: 20px; /* Adjusted right position */
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
                <li><a href="Employees.php">Employees</a></li>
                <li><a href="Customers.php">Customers</a></li>
				<li><a href="Inventory.php">Inventory</a></li>
                <li><a href="Stores.php">Stores</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section id="orders">
        <div class="container">
            <div class="table-container"> <!-- Move table-container outside of h2 -->
                <h2 style="text-align: center;">Orders</h2> <!-- Center the header -->
                <!-- Adjusted position for Add Order button -->
                <div class="add-order-button">
                    <form method="get" action="Add Order.php">
                        <button type="submit">Add Order</button>
                    </form>
                </div>
                <table>
                    <!-- Table headers -->
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer ID</th>
                            <th>Date</th>
                            <th>Total Price</th>
                            <th>Action</th> <!-- Add Action column header -->
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody>
                        <!-- PHP content here -->
                        <?php
                        $conn = new mysqli($hn, $un, $pw, $db);
                        if ($conn->connect_error) die($conn->connect_error);

                        $query = "SELECT `Order_ID`, `Customer_ID`, `Date`, `Total_Price` FROM `order`"; // Escaping the reserved keyword `order`
                        $result = $conn->query($query);
                        if (!$result) die ($conn->error);

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['Order_ID'] . "</td>";
                            echo "<td>" . $row['Customer_ID'] . "</td>";
                            echo "<td>" . $row['Date'] . "</td>";
                            echo "<td>$" . number_format($row['Total_Price'], 2) . "</td>"; // Display Total Price with dollar sign and 2 decimals
                            echo "<td class='action-buttons'>";
                            // Update button form
                            echo "<form style='display: inline-block;' method='get' action='Update Order.php'>";
                            echo "<input type='hidden' name='Order_ID' value='" . $row['Order_ID'] . "'>";
                            echo "<input type='hidden' name='Customer_ID' value='" . $row['Customer_ID'] . "'>";
                            // Add more hidden input fields as needed for updating
                            echo "<button type='submit'>Update</button>";
                            echo "</form>";
                            // Delete button form
                            echo "<form style='display: inline-block;' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                            echo "<input type='hidden' name='delete_order' value='" . $row['Order_ID'] . "'>";
                            // Add more hidden input fields as needed for deleting
                            echo "<button type='submit'>Delete</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }

                        $result->close();
                        $conn->close();
                        ?>
                        <!-- End of PHP content -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="container">
        <p>&copy; 2024 Fish R Us. All rights reserved.</p>
    </div>

</body>
</html>

