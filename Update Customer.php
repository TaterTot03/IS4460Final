<?php
$page_roles = array('Admin');
require_once 'login.php';
require_once 'checksession.php';

// Connect to the database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted for updating customer information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize
    $Customer_ID = $conn->real_escape_string($_POST['Customer_ID']);
    $Surname = $conn->real_escape_string($_POST['Surname']);
    $Forename = $conn->real_escape_string($_POST['Forename']);
    $Address = $conn->real_escape_string($_POST['Address']);
    $Username = $conn->real_escape_string($_POST['Username']);

    // Construct SQL UPDATE query
    $query = "UPDATE customer SET Surname='$Surname', Forename='$Forename', Address='$Address', Username='$Username' WHERE Customer_ID='$Customer_ID'";

    // Execute the update query
    $result = $conn->query($query);
    if ($result) {
        // Redirect to Customers.php after successful update
        header("Location: Customers.php");
        exit;
    } else {
        // Error handling if update fails
        echo "Update failed: " . $conn->error;
    }
}

// Check if the Customer_ID is provided in the URL
if (isset($_GET['Customer_ID'])) {
    // Retrieve customer details from URL parameters
    $Customer_ID = $_GET['Customer_ID'];
    $Surname = $_GET['Surname'];
    $Forename = $_GET['Forename'];
    $Address = $_GET['Address'];
    $Username = $_GET['Username'];
} else {
    // If Customer_ID is not provided, redirect back to Customers.php
    header("Location: Customers.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer - Fish R Us</title>
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
    <h2>Update Customer Information</h2>
    <form id="updateForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="Customer_ID" value="<?php echo $Customer_ID; ?>">
        <label for="Surname">First Name:</label><br>
        <input type="text" id="Surname" name="Surname" value="<?php echo $Surname; ?>" required><br>
        <label for="Forename">Last Name:</label><br>
        <input type="text" id="Forename" name="Forename" value="<?php echo $Forename; ?>" required><br>
        <label for="Address">Address:</label><br>
        <input type="text" id="Address" name="Address" value="<?php echo $Address; ?>" required><br>
        <label for="Username">Username:</label><br>
        <input type="text" id="Username" name="Username" value="<?php echo $Username; ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
