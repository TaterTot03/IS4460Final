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
    <title>Stores - Fish R Us</title>
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
    }
    th, td {
        padding: 8px; /* Increased padding */
        border-bottom: 1px solid #ddd;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
        text-align: Center;
    }
    /* Center align table cells in rows */
    tbody td {
        text-align: center;
    }
    /* Style for the add-store-button */
    .add-store-button {
        position: absolute;
        top: 0;
        right: 0;
        margin: 2px;
        padding: 10px 20px;
        background-color: #4a90e2;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .add-store-button:hover {
        background-color: #357ae8;
    }
	form {
        margin-right: 5px;
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
                <li><a href="Customers.php">Customers</a></li>
                <li><a href="Employees.php">Employees</a></li>
				<li><a href="Inventory.php">Inventory</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section id="store">
        <div class="container">
            <div class="table-container"> <!-- Move table-container outside of h2 -->
                <h2 style="text-align: center;">Stores</h2> <!-- Center the header -->
                <table>
                    
                    <tbody>
                        <!-- PHP content here -->
<?php
// Connect to database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted for deleting a store
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_store'])) {
    // Get data from POST object and sanitize them
    $Store_ID = $conn->real_escape_string($_POST['delete_store']);

    // Delete the store from the database
    $query = "DELETE FROM store WHERE Store_ID='$Store_ID'";
    $result = $conn->query($query);
    if (!$result) {
        die("Delete failed: " . $conn->error);
    }
}

// Check if form is submitted for updating an employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Store_ID'], $_POST['Address'], $_POST['Hours'])) {
    // Get data from POST object and sanitize them
    $Store_ID = $conn->real_escape_string($_POST['Store_ID']);
    $New_Address = $conn->real_escape_string($_POST['Address']);
    $New_Hours = $conn->real_escape_string($_POST['Hours']);

    // Update the employee's information in the database
    $query = "UPDATE store SET `Address`='$New_Address', `Hours`='$New_Hours' WHERE Store_ID='$Store_ID'";
    $result = $conn->query($query);
    if (!$result) {
        die("Update failed: " . $conn->error);
    }

    // Redirect back to the main page after successful update
    header("Location: Stores.php");
    exit;
}

// Check if form is submitted for adding a new store
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Address'], $_POST['Hours'])) {
    // Get data from POST object and sanitize them
    $Hours = $conn->real_escape_string($_POST['Hours']);
    $Address = $conn->real_escape_string($_POST['Address']);

    // Insert new store data into the database
    $query = "INSERT INTO store (Address, Hours) VALUES ('$Address', '$Hours')";
    $result = $conn->query($query);
    if (!$result) {
        die("Insert failed: " . $conn->error);
    }

    // Redirect back to the main page after successful insertion
    header("Location: Stores.php");
    exit;
}

// Retrieve and display stores from the database
$query = "SELECT Store_ID, Address, Hours FROM store";
$result = $conn->query($query);
if (!$result) {
    die("Query failed: " . $conn->error);
}

echo "<table>"; // Start table
echo "<tr><th>Store ID</th><th>Address</th><th>Hours</th><th>Actions</th></tr>"; // Table headers

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['Store_ID'] . "</td>";
    echo "<td>" . $row['Address'] . "</td>";
    echo "<td>" . $row['Hours'] . "</td>";
    // Actions column with update and delete buttons
    echo "<td>";
    echo "<form style='display: inline-block;' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
    echo "<input type='hidden' name='delete_store' value='" . $row['Store_ID'] . "'>";
    echo "<button type='submit'>Delete</button>";
    echo "</form>";
    echo "<form style='display: inline-block;' method='get' action='Update_Store.php'>"; // Changed method to GET
    echo "<input type='hidden' name='Store_ID' value='" . $row['Store_ID'] . "'>"; // Pass Store_ID as URL parameter
    echo "<button type='submit'>Update</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>"; // End table

$result->free(); // Free result set
$conn->close(); // Close connection
?>

                        <!-- End of PHP content -->
                    </tbody>
                </table>
                <button class="add-store-button" onclick="location.href='Add_Store.php';">Add Store</button>
            </div>
        </div>
    </section>

    <div class="container">
        <p>&copy; 2024 Fish R Us. All rights reserved.</p>
    </div>
    
</body>
</html>

