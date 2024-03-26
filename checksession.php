<?php

require_once 'user.php';
session_start();

// Check if user object is set in the session
if (!isset($_SESSION['User'])) {
    // Redirect to unauthorized page with a message
    header("Location: unauthorized.php");
    exit();
} else {
    // Retrieve user object from session
    $user = $_SESSION['User'];
}

// Define allowed roles for the page
//$page_roles = ['Admin','Customer'];

// Check if user's roles match any of the allowed roles for the page
$required_roles_present = false;
$urole = $_SESSION['Role'];
foreach ($page_roles as $prole) {
    if ($prole == $urole) {
        $required_roles_present = true;
        break;
    }
}

// If user's roles do not match any required role, redirect to unauthorized page
if (!$required_roles_present) {
    // Redirect to unauthorized page with a message
    header("Location: unauthorized.php");
    exit();
}

// Check if 'Continue as Guest' was clicked and add 'Basic Customer' role
if (isset($_SESSION['continue_as_guest'])) {
    $_SESSION['User'] = new User('', ['Customer']);
    unset($_SESSION['continue_as_guest']); // Unset the flag to prevent adding the role multiple times
}

//echo "<pre>";
//Print_r($_SESSION);
//echo "</pre>";

?>
