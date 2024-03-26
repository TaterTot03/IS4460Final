<!DOCTYPE html>
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Surname'], $_POST['Forename'], $_POST['Address'], $_POST['Username'], $_POST['Password'])) {
    // Get data from POST object and sanitize them
    $Surname = sanitize_data($conn, $_POST['Surname']);
    $Forename = sanitize_data($conn, $_POST['Forename']);
    $Address = sanitize_data($conn, $_POST['Address']);
    $Username = sanitize_data($conn, $_POST['Username']);
    $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Hashing the password

    // Insert new customer data into the database
    $query = "INSERT INTO customer (Surname, Forename, Address, Username, Password) 
    VALUES ('$Surname','$Forename', '$Address', '$Username', '$Password')";
    
    $result = $conn->query($query);
    if (!$result) {
        die("Insert failed: " . $conn->error);
    }

    // Redirect to Customers.php after successful insertion
    header("Location: Customers.php");
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
    <!-- Your HTML head content -->
</head>
<body>
    <!-- Your HTML body content -->
</body>
</html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
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

<h1>Create Account</h1>

<div class="add-form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> <!-- Changed action to handle form submission properly -->
            <label for="Surname">First Name:</label>
            <input type="text" id="Surname" name="Surname" required><br>
            <label for="Forename">Last Name:</label>
            <input type="text" id="Forename" name="Forename" required><br>
            <label for="Address">Address:</label>
            <input type="text" id="Address" name="Address" required><br>
            <label for="Username">Username:</label>
            <input type="text" id="Username" name="Username" required><br>
            <label for="Password">Password:</label>
            <input type="password" id="Password" name="Password" required><br>
            <input type="submit" value="Add Customer">
        </form>
    </div>

</body>
</html>