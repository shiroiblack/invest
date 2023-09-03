<?php
session_start(); // Start the PHP session

// Database credentials
$servername = "server139";
$dbUsername = "afflmdav_trader";
$dbPassword = "snakes199323";
$dbname = "afflmdav_trade";

// Create a connection
$connection = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['markCompleted'])) {
    $transactionID = $_POST['transactionID'];

    // Get current time
    $endTime = date('Y-m-d H:i:s');

    // Get end price from the form submission (if you decide to use a form)
    // For simplicity, let's assume it's submitted as a POST variable 'endPrice'
    $endPrice = $_POST['endPrice']; // You should validate and sanitize the input

    // Get the status from the form submission (if you decide to use a form)
    // For simplicity, let's assume it's submitted as a POST variable 'status'
    $status = $_POST['status']; // You should validate and sanitize the input

    // Update the trade in the database
    $updateQuery = "UPDATE trades SET end_time = '$endTime', status = '$status', end_price = '$endPrice' WHERE transaction_id = '$transactionID'";
    if (mysqli_query($connection, $updateQuery)) {
        // Success
        $_SESSION['success_message'] = "Trade marked as Completed successfully.";
    } else {
        // Error
        $_SESSION['error_message'] = "Error updating trade: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);

// Redirect back to the admin panel page (where the table is displayed)
header('Location: admin.php');
exit();
?>
