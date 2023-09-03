<?php
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

// Retrieve the active investments
$activeInvestmentsQuery = "SELECT username, total_invest, interest_rate, investment_duration FROM users WHERE total_invest > 0";
$activeInvestmentsResult = mysqli_query($connection, $activeInvestmentsQuery);

// Iterate through each active investment
while ($row = mysqli_fetch_assoc($activeInvestmentsResult)) {
    $username = $row['username'];
    $totalInvest = $row['total_invest'];
    $interestRate = $row['interest_rate'];
    $investmentDuration = $row['investment_duration'];

    // Calculate the daily interest based on the interest rate and investment duration
    $dailyInterest = ($totalInvest * $interestRate / 100) / $investmentDuration;

    // Update the interest_wallet_balance for the user
    $updateBalanceQuery = "UPDATE users SET interest_wallet_balance = interest_wallet_balance + $dailyInterest WHERE username = '$username'";
    mysqli_query($connection, $updateBalanceQuery);
}

// Close the database connection
mysqli_close($connection);
?>
