<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Start the session

// Generate the transaction ID
function generateTransactionId() {
  // Generate a random number between 100000 and 999999
  return rand(100000, 999999);
}

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

// Retrieve POST parameters
$amount = $_POST['amount'];
$endtime = $_POST['endtime'];
$symbol = $_POST['symbol'];
$strikerate = $_POST['strikerate'];
$endprice = $_POST['endprice'];
$status = 'Ongoing'; // Set the initial status to 'Ongoing'
$tradingType = $_POST['type']; // Get the trading type from the form
$tradeTime = $_POST['trade_time'];
// Retrieve the logged-in username from the session
$username = $_SESSION['username'];

// Generate the transaction ID
$transactionId = generateTransactionId();

// Prepare the SQL statement
$query = "INSERT INTO trades (transaction_id, symbol, amount, strike_rate, end_time, end_price, status, trading_type, username, trade_time) VALUES ($transactionId, '$symbol', $amount, $strikerate, '$endtime', $endprice, '$status', '$tradingType', '$username', '$tradeTime' )";

if (mysqli_query($conn, $query)) {
  // Update the user's balance in the `users` table
  $updateQuery = "UPDATE users SET money = money - $amount WHERE username = '$username'";
  if (mysqli_query($conn, $updateQuery)) {
    // Send email notification to the website owner
    $to = 'support@affliateasset.cc'; // Replace with the actual owner's email address
    $subject = 'New Purchase Notification';
    $message = "A user has made a purchase:\n\n";
    $message .= "Username: $username\n";
    $message .= "Amount: $amount\n";
    $message .= "Symbol: $symbol\n";
    $message .= "Trading Type: $tradingType\n";

    $headers = "From: notifications@example.com\r\n";
    mail($to, $subject, $message, $headers);

    echo "success"; // Return success message to JavaScript
  } else {
    echo "error"; // Return error message to JavaScript
  }
} else {
  echo "error"; // Return error message to JavaScript
}

// Close the database connection
mysqli_close($conn);
?>
