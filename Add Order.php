<!DOCTYPE html>
<?php
$page_roles = array('Admin');
require_once 'login.php';
require_once 'checksession.php';

// Connect to the database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Customer_ID'], $_POST['Date'], $_POST['Total_Price'])) {
    // Get data from POST object and sanitize them
    $Customer_ID = sanitize_data($conn, $_POST['Customer_ID']);
    $Date = sanitize_data($conn, $_POST['Date']);
    $Total_Price = sanitize_data($conn, $_POST['Total_Price']);

    // Insert the order into the database
    $query = "INSERT INTO `order` (`Customer_ID`, `Date`, `Total_Price`) VALUES ('$Customer_ID', '$Date', '$Total_Price')";
    $result = $conn->query($query);
    if (!$result) die("Insertion failed: " . $conn->error);

    // Redirect to Orders.php after successful insertion
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
            padding-top: 70px; /* Added spacing to push content down */
        }

        h1 {
            text-align: center;
            margin-top: 20px; /* Added spacing to create distance from navbar */
        }

        .add-form {
            background-color: #fff;
            border-radius: 4px;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto; /* Centering the form */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Added box shadow for a subtle effect */
        }

        .add-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold; /* Added font weight for labels */
        }

        .add-form input[type="text"],
        .add-form input[type="date"],
        .add-form input[type="number"] {
            width: calc(100% - 20px); /* Adjusted width to account for padding */
            padding: 10px;
            margin-bottom: 15px; /* Increased margin for better spacing */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s ease; /* Added transition effect */
        }

        .add-form input[type="text"]:focus,
        .add-form input[type="date"]:focus,
        .add-form input[type="number"]:focus {
            border-color: #4CAF50; /* Changed border color on focus */
        }

        .add-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%; /* Making the button width 100% */
            transition: background-color 0.3s ease; /* Added transition effect */
        }

        .add-form input[type="submit"]:hover {
            background-color: #45a049; /* Darker color on hover */
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            position: fixed;
            top: 0;
            width: 100%;
        }

        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>

<h1>Add Order</h1>

<div class="add-form">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="Customer_ID">Customer ID:</label>
        <input type="text" id="Customer_ID" name="Customer_ID" required><br>
        <label for="Date">Date:</label>
        <input type="date" id="Date" name="Date" required><br>
        <label for="Total_Price">Total Price:</label>
        <input type="number" id="Total_Price" name="Total_Price" step="0.01" required><br>
        <input type="submit" value="Add Order">
    </form>
</div>

</body>
</html>
