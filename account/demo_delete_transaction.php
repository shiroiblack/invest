<?php
// delete_transaction.php

// Retrieve the transaction ID from the URL parameter
$transactionID = $_GET['id'];

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

// Delete the transaction from the database
$deleteQuery = "DELETE FROM demo_trades WHERE transaction_id = '$transactionID'";

if (mysqli_query($connection, $deleteQuery)) {
    // Deletion successful, redirect back to the transactions.php page with a success message
    session_start();
    $_SESSION['success_message'] = "Transaction deleted successfully!";
    header("Location: demo_trades.php");
    exit();
} else {
    // Deletion failed, handle the error as needed (e.g., display an error message)
    echo "Error deleting transaction: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>
