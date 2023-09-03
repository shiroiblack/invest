<?php
// Database credentials
$servername = "server139";
$dbUsername = "afflmdav_trader";
$dbPassword = "snakes199323";
$dbname = "afflmdav_trade";

// Create a connection
$connection = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if ($connection->connect_error) {
  die("Database connection failed: " . $connection->connect_error);
}

// Retrieve the amount sent via AJAX
$amount = $_POST['amount'];

// Fetch the user's balance from the database
session_start();
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];

  // Prepare and execute a query to fetch the user's balance
  $balanceQuery = "SELECT demo_trade_money FROM users WHERE username = ?";
  $stmt = $connection->prepare($balanceQuery);
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userBalance = $row['demo_trade_money'];

    // Compare the user's balance with the desired amount
    if ($userBalance >= $amount) {
      // Sufficient balance, return a success response
      echo "success";
    } else {
      // Insufficient balance, return an error response
      echo "Insufficient balance";
    }
  } else {
    // User not found or database error, return an error response
    echo "Error retrieving user data";
  }
} else {
  // User not logged in, return an error response
  echo "User not logged in";
}

// Close the database connection
$connection->close();
?>
