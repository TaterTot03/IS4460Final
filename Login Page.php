<?php
require_once 'login.php';
require_once 'user.php';

// Database connection
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";

// Start session
session_start();

// Check if continue as guest is clicked
if(isset($_GET['guest']) && $_GET['guest'] == true) {
    // Generate a unique customer ID for the guest
    $customer_id = uniqid('guest_', true); // Prefixing with 'guest_' to differentiate from regular customer IDs
    
    // Set session variables
    $_SESSION['Username'] = 'Guest'; // Set a generic username for guests
    $_SESSION['Customer_ID'] = $customer_id;
    $_SESSION['Role'] = 'Customer'; // Set the role to Customer for guests
    
    // Redirect to homepage
    header("Location: Homepage.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Username']) && isset($_POST['Password'])) {
        $tmp_username = $_POST['Username'];
        $tmp_password = $_POST['Password'];

        // Use prepared statement to prevent SQL injection
        $query = "SELECT c.Password AS Customer_Password, c.Customer_ID, NULL AS Employee_ID, r.Role AS Role
          FROM customer c 
          LEFT JOIN roles r ON CAST(c.Role_ID AS CHAR) = CAST(r.Role_ID AS CHAR)
          WHERE CAST(c.Username AS CHAR) = ? 
          UNION 
          SELECT e.Password AS Employee_Password, NULL AS Customer_ID, e.Employee_ID, r.Role AS Role
          FROM employee e 
          LEFT JOIN roles r ON CAST(e.Role_ID AS CHAR) = CAST(r.Role_ID AS CHAR)
          WHERE CAST(e.Username AS CHAR) = ?";


        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $tmp_username, $tmp_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $passwordFromDB = $row['Customer_Password'] ?? $row['Employee_Password']; // Use appropriate password based on user type
            $employee_id = $row['Employee_ID']; // Get Employee_ID
            $customer_id = $row['Customer_ID']; // Get Customer_ID


            // Check if the role is already set in session
            if (!isset($_SESSION['Role'])) {
                // Set the role based on the source table
                if ($employee_id) {
                    $_SESSION['Role'] = 'Admin'; // User from employee table
                    $_SESSION['Employee_ID'] = $employee_id; // Set Employee_ID in session
                    unset($_SESSION['Customer_ID']); // Remove Customer_ID from session if exists
                } else {
                    $_SESSION['Role'] = 'Customer'; // User from customer table
                    $_SESSION['Customer_ID'] = $customer_id; // Set Customer_ID in session
                    unset($_SESSION['Employee_ID']); // Remove Employee_ID from session if exists
                }
            }

            if (password_verify($tmp_password, $passwordFromDB)) {
                // Successful login				
                $_SESSION['User'] = $tmp_username;
                // Redirect to homepage after setting session variables
                header("Location: Homepage.php");
                exit;
            } else {
                $error_message = "Incorrect Username or Password";
            }
        } else {
            $error_message = "Incorrect Username or Password";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fish R Us</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .error-container {
            display: flex;
            justify-content: center;
        }
        .error-message {
            color: black;
            background-color: #ffcccc; /* Light red color */
            margin-top: 5px;
            padding: 8px;
            border: 1px solid #ff9999; /* Darker red border */
            border-radius: 5px;
            width: fit-content; /* Adjust width to fit content */
        }
    </style>
</head>
<body>
    <header>
        <h1>Fish R Us</h1>
    </header>
    
    <section id="login">
        <div class="container">
            <h2>Login</h2>
            <div class="error-container">
                <?php if (!empty($error_message)): ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
            </div>
            <form action="" method="POST">
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="Username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="Password" required>
                </div>
                <button type="submit">Login</button>
            </form>
            <!-- Link to 'Continue as Guest' -->
            <p><a href="Create Account.php">Create Account</a></p>
        </div>
    </section>
    
    <div class="container">
        <p>&copy; 2024 Fish R Us. All rights reserved.</p>
    </div>
</body>
</html>
