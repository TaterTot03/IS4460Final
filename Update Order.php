<?php
$page_roles = array('Admin');
require_once 'login.php';
require_once 'checksession.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Order_ID'])) {
    // Connect to the database
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve Order_ID from the form
    $Order_ID = sanitize_data($conn, $_POST['Order_ID']);

    // Construct the update query
    $query = "UPDATE `order` SET ";
    $updates = array();

    // Check if each field is set and add it to the update statement
    if (isset($_POST['Customer_ID'])) {
        $Customer_ID = sanitize_data($conn, $_POST['Customer_ID']);
        $updates[] = "`Customer_ID`='$Customer_ID'";
    }
    if (isset($_POST['Date'])) {
        $Date = sanitize_data($conn, $_POST['Date']);
        $updates[] = "`Date`='$Date'";
    }
    if (isset($_POST['Total_Price'])) {
        $Total_Price = sanitize_data($conn, $_POST['Total_Price']);
        $updates[] = "`Total_Price`='$Total_Price'";
    }

    // Join the updates into the query
    $query .= implode(", ", $updates);
    $query .= " WHERE `Order_ID`='$Order_ID'";

    // Execute the update query
    $result = $conn->query($query);
    if (!$result) {
        die("Update failed: " . $conn->error);
    } else {
        echo "Update successful.";
    }

    // Redirect to Orders.php after successful update
    header("Location: Orders.php");
    exit; // Terminate script execution after redirection
}

// Function to sanitize data
function sanitize_data($conn, $data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order - Fish R Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
            padding-top: 70px; /* Added spacing to push content down */
        }

        h2 {
            text-align: center;
            margin-top: 20px; /* Added spacing to create distance from navbar */
        }

        form {
            background-color: #fff;
            border-radius: 4px;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto; /* Centering the form */
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%; /* Making the button width 100% */
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Update Order Information</h2>
    <form id="updateForm" method="post" action="Update Order.php">
        <!-- Include a hidden input field to store the Order_ID -->
        <input type="hidden" name="Order_ID" value="<?php echo isset($_GET['Order_ID']) ? $_GET['Order_ID'] : ''; ?>">
        <label for="Customer_ID">Customer ID:</label><br>
        <input type="text" id="Customer_ID" name="Customer_ID" value="<?php echo isset($_POST['Customer_ID']) ? $_POST['Customer_ID'] : ''; ?>" required><br>
        <label for="Date">Date:</label><br>
        <input type="date" id="Date" name="Date" value="<?php echo isset($_POST['Date']) ? $_POST['Date'] : ''; ?>" required><br>
        <label for="Total_Price">Total Price:</label><br>
        <input type="number" id="Total_Price" name="Total_Price" value="<?php echo isset($_POST['Total_Price']) ? $_POST['Total_Price'] : ''; ?>" step="0.01" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>

