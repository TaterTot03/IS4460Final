<!DOCTYPE html>

<?php
$page_roles = array('Admin');
require_once 'login.php';
require_once 'checksession.php';

// Connect to the database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted for adding or updating a store
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Address'], $_POST['Hours'])) {
        // Get data from POST object and sanitize them
        $Address = sanitize_data($conn, $_POST['Address']);
        $Hours = sanitize_data($conn, $_POST['Hours']);

        $result = $conn->query($query);
        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        // Redirect to Stores.php after successful insertion or update
        header("Location: Stores.php");
        exit; // Terminate script execution after redirection
    }
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
    <title>Add or Update Store</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>

<!-- Add your HTML content here -->

</body>
</html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Store</title>
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
        }

        .add-form label {
            display: block;
            margin-bottom: 10px;
        }

        .add-form input[type="text"],
        .add-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .add-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%; /* Making the button width 100% */
        }

        .add-form input[type="submit"]:hover {
            background-color: #45a049;
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

<h1>Add Store</h1>

<div class="add-form">
   <form action="Stores.php" method="post"> <!-- Changed action to Add_Employee.php to submit to the same page -->
    <label for="Address">Address:</label>
    <input type="text" id="Address" name="Address" required><br>
    <label for="Hours">Hours:</label>
    <input type="text" id="Hours" name="Hours" required><br>
    <input type="submit" value="Add Store">
</form>

</div>

</body>
</html>