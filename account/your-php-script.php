<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Start the session (if not already started)

// Database credentials
$servername = "server139";
$dbUsername = "afflmdav_trader";
$dbPassword = "snakes199323";
$dbname = "afflmdav_trade";

// Create a connection
$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in and the username is stored in the session
if (isset($_SESSION['username'])) {
    $loggedInUsername = $_SESSION['username'];

    // Fetch trade records from the database for the logged-in user
    $query = "SELECT * FROM trades WHERE username = '$loggedInUsername'";
    $result = mysqli_query($conn, $query);

    // Initialize an empty array to store trade records
    $tradeRecords = array();

    // Check if records were retrieved successfully
    if ($result && mysqli_num_rows($result) > 0) {
        // Add each trade record to the array
        while ($row = mysqli_fetch_assoc($result)) {
            $tradeRecords[] = $row;
        }
    } else {
        // No records found for the logged-in user
        $tradeRecords = array();
    }

    // Close the database connection
    mysqli_close($conn);

    // Return the trade records as JSON
    header('Content-Type: application/json');
    echo json_encode($tradeRecords);
} else {
    // User is not logged in, return an error message or redirect to login page
    http_response_code(401); // Unauthorized
    echo json_encode(array('error' => 'User not logged in.'));
}
?>
