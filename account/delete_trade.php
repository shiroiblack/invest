<?php
// Database credentials
$servername = "server343";
$dbUsername = "truspqek_coin";
$dbPassword = "snakes199323";
$dbname = "truspqek_coin";

// Create a connection
$connection = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_GET['transaction_id'])) {
    $transactionID = $_GET['transaction_id'];

    // Delete the trade from the database
    $deleteQuery = "DELETE FROM trades WHERE transaction_id = '$transactionID'";
    if (mysqli_query($connection, $deleteQuery)) {
        // Success
        $_SESSION['success_message'] = "Trade deleted successfully.";
    } else {
        // Error
        $_SESSION['error_message'] = "Error deleting trade: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);

// Redirect back to the admin panel page (where the table is displayed)
header('Location: admin_panel.php');
exit();
?>
