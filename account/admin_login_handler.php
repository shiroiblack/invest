<?php
// admin_login_handler.php

session_start();

// Check if the admin is already logged in
if (isset($_SESSION['admin_username'])) {
  // Admin is already logged in, redirect to admin panel
  header('Location: admin.php');
  exit();
}

// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted username and password
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Define admin credentials
  $adminCredentials = [
    'admin' => 'snakes199323' // Replace with your desired admin username and password
  ];

  // Perform authentication
  if (isset($adminCredentials[$username]) && $adminCredentials[$username] === $password) {
    // Successful login, store admin username in session and redirect to admin panel
    $_SESSION['admin_username'] = $username;
    header('Location: admin.php');
    exit();
  } else {
    // Invalid credentials, show error message
    $error = 'Invalid username or password.';
    include('admin_login.php');
    exit();
  }
}

// If the form is accessed directly without submitting, redirect to the login page
header('Location: admin_login.php');
exit();
?>

