<!DOCTYPE html>
<?php
$page_roles = array('Admin','Customer');
require_once 'login.php';
require_once 'checksession.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish R Us</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Inline CSS for background image */
        body {
            background-image: url('Water.jpg'); 
            background-size: cover; /* Cover the entire viewport */
            background-repeat: no-repeat; /* No repeating of the image */
            background-attachment: fixed; /* Fixed background position */
            font-family: Arial, sans-serif; /* Set default font family */
            line-height: 1.6; /* Set default line height */
            color: #333; /* Set default text color */
            opacity: 100%;
        }

        header {
            position: relative; /* Position the header relative */
        }

        .cart-icon {
            position: absolute; /* Position the cart icon absolutely */
            top: 10px; /* Adjust top position */
            right: 10px; /* Adjust right position */
            width: 40px; /* Set width */
            height: auto; /* Maintain aspect ratio */
            cursor: pointer; /* Add cursor pointer */
        }

        .cart-icon img {
            width: 100%; /* Make sure the image fills its container */
            height: auto; /* Maintain aspect ratio */
        }

        .contact-image {
            width: 100px; /* Set the width of the contact image */
            height: auto; /* Maintain aspect ratio */
        }

        nav ul {
            list-style-type: none; /* Remove bullet points from the navigation list */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }

        nav ul li {
            display: inline; /* Display list items horizontally */
            margin-right: 10px; /* Add margin between list items */
        }
		/* Add styles for the badge counter in the Homepage file */
/* Add styles for the badge counter in the Homepage file */
.cart-badge-home {
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 4px 8px;
    font-size: 12px;
    /* Add the following styles for positioning */
    display: flex;
    justify-content: center;
    align-items: center;
}


    </style>
</head>
<body>

<header>
    <h1>Fish R Us</h1>
    <!-- Add cart icon with badge counter -->
    <div class="cart-icon">
        <a href="cart.php"><img src="cart.png" alt="Shopping Cart"></a>
        <!-- Display the badge with the item count -->
        <?php
        // Calculate the item count in the cart
        $item_count_home = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
        // Display the badge only if there are items in the cart
        if($item_count_home > 0) {
            echo '<span class="cart-badge cart-badge-home">' . $item_count_home . '</span>';
        }
        ?>
    </div>
   <nav>
    <ul>
        <?php if ($_SESSION['Role'] === 'Admin'): ?>
            <!-- Show these links only to Admin users -->
            <li><a href="Products.php">Products</a></li>
            <li><a href="Orders.php">Orders</a></li>
            <li><a href="Customers.php">Customers</a></li>
            <li><a href="Employees.php">Employees</a></li>
            <li><a href="Stores.php">Stores</a></li>
            <li><a href="Inventory.php">Inventory</a></li>
        <?php endif; ?>
        <?php if ($_SESSION['Role'] === 'Customer'): ?>
            <!-- Show these links only to Customer users -->
            <li><a href="Homepage.php">Home</a></li>
            <li><a href="Products.php">Products</a></li>
        <?php endif; ?>
        <!-- Common links for all users -->
        <li><a href="#about">About Us</a></li>
        <li><a href="#services">Our Services</a></li>
        <li><a href="#contact">Contact Us</a></li>
        <li><a href="Logout.php">Logout</a></li>
    </ul>
</nav>


</header>

<!-- Rest of the page content here -->
<section id="about">
    <div class="container">
        <h2>About Us</h2>
        <p>Welcome to Fish R Us!

        At Fish R Us, we're passionate about bringing the wonders of aquatic life into your home. With a legacy of excellence spanning over two decades, we've established ourselves as a leading provider of premium fish and aquatic supplies. Our commitment to quality, sustainability, and customer satisfaction sets us apart in the industry.

        Founded in 2002 by a group of dedicated marine enthusiasts, Fish R Us began as a small local shop in the heart of Ocean City, USA. Over the years, fueled by our love for marine life and unwavering dedication, we've expanded to multiple stores across the United States, serving customers nationwide.</p>
    </div>
</section>

<section id="featured-products">
    <div class="container">
        <h2>Featured Products</h2>
        <!-- Add your featured products here with image sources -->
        <div class="featured-product">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSYi6cLCedvT9rDewepxjmepG582zdBk3iyw&s" alt="Starfish">
            <!-- Add more featured products as needed -->
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWDhzS_zM0QCc9_X0nXr2jREYXeWutT1h6vQ&s" alt="Second Image" style="margin-left: 20px;">
            <img src="https://th.bing.com/th/id/OIP.zsHl0_xbKvWUDlSd37epXwHaEo?w=290&h=181&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Third Image" style="margin-left: 20px;">
        </div>
    </div>
</section>



<section id="services">
    <div class="container" style="padding-left: 50px;">
        <h2>Our Services</h2>
        <ul style="list-style-type: disc;">
            <li>Easy online browsing and ordering of fish and supplies</li>
            <li>Convenient store locations with knowledgeable staff</li>
            <li>Professional Aquarium designers ready to bring your aquarium to life</li> 			
			</ul>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="contact-heading">
            <h2>Contact Us</h2>
        </div>
        <address>
            Fish R Us Headquarters<br>
            123 Fish Street<br>
            Ocean City, USA<br>
            Phone: 1-800-FISH-R-US<br>
            Email: info@fishrus.com
        </address>
        <img class="contact-image" src="Contact Us" alt="Contact Image">
    </div>
</section>

<div class="container">
    <p>&copy; 2024 Fish R Us. All rights reserved.</p>
</div>

<footer>

</footer>

</body>
</html>

