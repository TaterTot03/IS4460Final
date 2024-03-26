<?php
$page_roles = array('Admin','Customer');
require_once 'login.php';
require_once 'checksession.php';

// Retrieve the Employee ID from the URL parameter
$employee_id = isset($_GET['Employee_ID']) ? intval($_GET['Employee_ID']) : 0;

// Connect to the database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize the employee ID
$employee_id = $conn->real_escape_string($employee_id);

// Retrieve the employee's current information from the database
$query = "SELECT `Surname`, `Forename`, `Username` FROM employee WHERE `Employee_ID` = $employee_id";
$result = $conn->query($query);
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Check if the employee exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Surname = $row['Surname'];
    $Forename = $row['Forename'];
    $Username = $row['Username'];
} else {
    echo "Employee information not found.";
    exit;
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee - Fish R Us</title>
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

        input[type="text"] {
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
    <h2>Update Employee Information</h2>
    <form method="post" action="Employees.php">
        <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
        <label for="Surname">First Name:</label><br>
        <input type="text" id="Surname" name="Surname" value="<?php echo $Surname; ?>"><br>
        <label for="Forename">Last Name:</label><br>
        <input type="text" id="Forename" name="Forename" value="<?php echo $Forename; ?>"><br>
        <label for="Username">Username:</label><br>
        <input type="text" id="Username" name="Username" value="<?php echo $Username; ?>"><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
