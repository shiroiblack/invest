<?php
// Database credentials
$servername = "server309";
$dbUsername = "proinhar_root";
$dbPassword = "Snakes199323";
$dbname = "proinhar_coin";

// Create a connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Retrieve the active investments from the database
$query = "SELECT * FROM investments WHERE status = 'active'";
$result = mysqli_query($connection, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    // No active investments found
    mysqli_close($connection);
    exit;
}

// Retrieve the current date and time
$currentDateTime = new DateTime();

// Iterate through the active investments
while ($row = mysqli_fetch_assoc($result)) {
    $investmentId = $row['id'];
    $userId = $row['user_id'];
    $investmentAmount = $row['amount'];
    $investmentStartDate = new DateTime($row['start_date']);
    $investmentDuration = $row['duration'];
    $investmentEndDate = clone $investmentStartDate;
    $investmentEndDate->modify("+$investmentDuration day");

    // Check if the investment duration has passed
    if ($currentDateTime >= $investmentEndDate) {
        // Calculate the interest based on the investment amount and duration
        $interestRate = $row['interest_rate'];
        $dailyInterest = $investmentAmount * ($interestRate / 100);
        $totalInterest = $dailyInterest * $investmentDuration;

        // Update the user's interest wallet balance
        $updateQuery = "UPDATE users SET interest_wallet_balance = interest_wallet_balance + $totalInterest WHERE id = $userId";
        mysqli_query($connection, $updateQuery);

        // Mark the investment as completed
        $updateStatusQuery = "UPDATE investments SET status = 'completed' WHERE id = $investmentId";
        mysqli_query($connection, $updateStatusQuery);
    }
}

// Close the database connection
mysqli_close($connection);
