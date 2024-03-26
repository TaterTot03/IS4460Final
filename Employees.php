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
    <title>Employees - Fish R Us</title>
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
        th {
            background-color: #f2f2f2;
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
                <li><a href="Stores.php">Stores</a></li>
				<li><a href="Inventory.php">Inventory</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section id="employees">
        <div class="container">
            <div class="table-container"> <!-- Move table-container outside of h2 -->
                <h2 style="text-align: center;">Employees</h2> <!-- Center the header -->
                <div style='position: absolute; top: 0; right: 0; margin: 0px;'>
                    <form method='get' action='Add_Employee.php'>
                        <button type='submit'>Add Employee</button>
                    </form>
                </div>
                <table>
                
                    <!-- Table body -->
                    <tbody>
                       

<?php

// Connect to the database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted for adding an employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Surname'], $_POST['Forename'], $_POST['Username'], $_POST['Password'])) {
    // Get data from POST object and sanitize them
    $First_Name = $conn->real_escape_string($_POST['Surname']);
    $Last_Name = $conn->real_escape_string($_POST['Forename']);
    $Username = $conn->real_escape_string($_POST['Username']);
    $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Hashing the password

    // Insert new employee data into the database
    $query = "INSERT INTO employee (`Surname`, `Forename`, `Username`, `Password`) VALUES ('$First_Name', '$Last_Name', '$Username', '$Password')";
    $result = $conn->query($query);
    if (!$result) {
        die("Insert failed: " . $conn->error);
    }
}

// Check if form is submitted for deleting an employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_employee'])) {
    // Get data from POST object and sanitize them
    $Employee_ID = $conn->real_escape_string($_POST['delete_employee']);

    // Delete the employee from the database
    $query = "DELETE FROM employee WHERE Employee_ID='$Employee_ID'";
    $result = $conn->query($query);
    if (!$result) {
        die("Delete failed: " . $conn->error);
    }
}

// Check if form is submitted for updating an employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['employee_id'], $_POST['Surname'], $_POST['Forename'], $_POST['Username'])) {
    // Get data from POST object and sanitize them
    $Employee_ID = $conn->real_escape_string($_POST['employee_id']);
    $New_Surname = $conn->real_escape_string($_POST['Surname']);
    $New_Forename = $conn->real_escape_string($_POST['Forename']);
    $New_Username = $conn->real_escape_string($_POST['Username']);

    // Update the employee's information in the database
    $query = "UPDATE employee SET `Surname`='$New_Surname', `Forename`='$New_Forename', `Username`='$New_Username' WHERE Employee_ID='$Employee_ID'";
    $result = $conn->query($query);
    if (!$result) {
        die("Update failed: " . $conn->error);
    }
}

// Retrieve and display employees from the database
$query = "SELECT `Employee_ID`, `Surname`, `Forename`, `Username` FROM employee";
$result = $conn->query($query);
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Display the table with employee details
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>Employee #</th>";
echo "<th>First Name</th>";
echo "<th>Last Name</th>";
echo "<th>Username</th>";
echo "<th>Actions</th>"; // Add column for action buttons
echo "</tr>";
echo "</thead>";
echo "<tbody>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['Employee_ID'] . "</td>";
    echo "<td>" . $row['Surname'] . "</td>";
    echo "<td>" . $row['Forename'] . "</td>";
    echo "<td>" . $row['Username'] . "</td>";
    echo "<td>";
    // Delete button form
    echo "<form style='display: inline-block;' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
    echo "<input type='hidden' name='delete_employee' value='" . $row['Employee_ID'] . "'>";
    echo "<button type='submit'>Delete</button>";
    echo "</form>";
    // Update button form
    echo "<form style='display: inline-block;' method='get' action='Update_Employee.php'>";
    echo "<input type='hidden' name='Employee_ID' value='" . $row['Employee_ID'] . "'>";
    echo "<input type='hidden' name='Surname' value='" . $row['Surname'] . "'>";
    echo "<input type='hidden' name='Forename' value='" . $row['Forename'] . "'>";
    echo "<input type='hidden' name='Username' value='" . $row['Username'] . "'>";
    echo "<button type='submit'>Update</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

$conn->close(); // Close connection
?>





