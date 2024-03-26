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
    <title>Customers - Fish R Us</title>
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

    <section id="customers">
        <div class="container">
            <div class="table-container"> <!-- Move table-container outside of h2 -->
                <h2 style="text-align: center;">Customers</h2> <!-- Center the header -->
                <div style='position: absolute; top: 0; right: 0; margin: 0px;'>
                    <form method='get' action='Add_Customer.php'>
                        <button type='submit'>Add Customer</button>
                    </form>
                </div>
                <table>
                    <!-- Table headers -->
                    <thead>
                        <tr>
                            <th>Customer #</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Username</th>
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

                        // Check if form is submitted for deleting a customer
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_customer'])) {
                            // Get data from POST object and sanitize them
                            $Customer_ID = $conn->real_escape_string($_POST['delete_customer']);

                            // Delete the customer from the database
                            $query = "DELETE FROM customer WHERE Customer_ID='$Customer_ID'";
                            $result = $conn->query($query);
                            if (!$result) {
                                die("Delete failed: " . $conn->error);
                            }
                        }

                        // Retrieve and display customers from the database
                        $query = "SELECT `Customer_ID`, `Surname`, `Forename`, `Address`, `Username` FROM customer";
                        $result = $conn->query($query);
                        if (!$result) {
                            die("Query failed: " . $conn->error);
                        }

                        // Display the table with customer details
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['Customer_ID'] . "</td>";
                            echo "<td>" . $row['Surname'] . "</td>";
                            echo "<td>" . $row['Forename'] . "</td>";
                            echo "<td>" . $row['Address'] . "</td>";
                            echo "<td>" . $row['Username'] . "</td>";
                            echo "<td>";
                            // Delete button form
                            echo "<form style='display: inline-block;' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                            echo "<input type='hidden' name='delete_customer' value='" . $row['Customer_ID'] . "'>";
                            echo "<button class='delete-button' type='submit'>Delete</button>";
                            echo "</form>";
                            // Update button anchor tag
                            echo "<a href='Update Customer.php?Customer_ID=" . $row['Customer_ID'] . "&Surname=" . urlencode($row['Surname']) . "&Forename=" . urlencode($row['Forename']) . "&Address=" . urlencode($row['Address']) . "&Username=" . urlencode($row['Username']) . "'>";
                            echo "<button class='update-button'>Update</button>"; // Apply styling similar to delete button
                            echo "</a>";
                            echo "</td>";
                            echo "</tr>";
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
</body>
</html>
