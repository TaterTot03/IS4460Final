<!DOCTYPE html>
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Added box shadow for a subtle effect */
        }

        .add-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold; /* Added font weight for labels */
        }

        .add-form input[type="text"],
        .add-form input[type="date"],
        .add-form input[type="number"],
        .add-form input[type="password"] {
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
        .add-form input[type="number"]:focus,
        .add-form input[type="password"]:focus {
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
    <h1>Create Account</h1>

    <div class="add-form">
        <form action="Create Account.php" method="post">
            <label for="Surname">First Name:</label>
            <input type="text" id="Surname" name="Surname" required><br>
            <label for="Forename">Last Name:</label>
            <input type="text" id="Forename" name="Forename" required><br>
            <label for="Address">Address:</label>
            <input type="text" id="Address" name="Address" required><br>
            <label for="Username">Username:</label>
            <input type="text" id="Username" name="Username" required><br>
            <label for="Password">Password:</label>
            <input type="password" id="Password" name="Password" style="width: calc(100% - 20px); padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" required><br>
            <input type="submit" value="Add Customer">
        </form>
    </div>
</body>
</html>
