<!DOCTYPE html>
<?php
// Include the database connection code
$page_roles = array('Admin');
require_once 'login.php';
require_once 'checksession.php';

// Retrieve the Store_ID from the URL parameter
$Store_ID = $_GET['Store_ID'];

// Connect to the database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the existing values of the store from the database
$query = "SELECT Address, Hours FROM store WHERE Store_ID = '$Store_ID'";
$result = $conn->query($query);
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Fetch the row containing the existing values
$row = $result->fetch_assoc();
$Address = $row['Address'];
$Hours = $row['Hours'];

// Close the database connection
$conn->close();
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Store - Fish R Us</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* CSS for form styling */
        form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Fish R Us</h1>
    </header>

<section id="update-store">
    <div class="container">
        <form method="post" action="Stores.php">
            <label for="Address">Address:</label>
            <input type="text" id="Address" name="Address" value="<?php echo $Address; ?>" required>
            <label for="Hours">Hours:</label>
            <input type="text" id="Hours" name="Hours" value="<?php echo $Hours; ?>" required>
            <input type="hidden" name="Store_ID" value="<?php echo $Store_ID; ?>"> <!-- Include hidden input for Store_ID -->
            <input type="submit" value="Update Store">
        </form>
    </div>
</section>


    <div class="container">
        <p>&copy; 2024 Fish R Us. All rights reserved.</p>
    </div>
</body>
</html>
