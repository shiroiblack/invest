<?php
session_start();
// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_username'])) 
    // User is not logged in, redirect to login page
    header('Location: admin_login.php');
    exit();
}

// Handle logout request
if (isset($_POST['logout'])) {
    // Clear all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header('Location: admin_login.php');
    exit();
}

// Database credentials
$servername = "server343";
$dbUsername = "truspqek_coin";
$dbPassword = "snakes199323";
$dbname = "truspqek_coin";

// Create a connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    // If the admin is not logged in, redirect to the admin login page or show an error message
    header('Location: admin_login.php');
    exit();
}

// Check if the withdrawal ID was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['withdrawal_id'])) {
    $withdrawalId = $_POST['withdrawal_id'];

    // Update the status of the withdrawal to "Approved" in the database
    $updateQuery = "UPDATE withdrawal_history SET status = 'Approved' WHERE id = $withdrawalId";
    mysqli_query($connection, $updateQuery);

    // Redirect the admin back to the pending withdrawals page
    header('Location: admin_pending_withdrawals.php');
    exit();
}

// Close the database connection
mysqli_close($connection);
?>
