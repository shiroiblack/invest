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

// Retrieve the list of users
$userQuery = "SELECT * FROM users";
$userResult = mysqli_query($connection, $userQuery);

// Check if the query was successful
if (!$userResult) {
    die("Query failed: " . mysqli_error($connection));
}

// Define the investment plans with their interest rates and durations
$plans = [
    1 => ['interest_rate' => 1.5, 'investment_duration' => 7],
    2 => ['interest_rate' => 2.5, 'investment_duration' => 7],
    3 => ['interest_rate' => 3.5, 'investment_duration' => 7],
    4 => ['interest_rate' => 4.0, 'investment_duration' => 7],
    5 => ['interest_rate' => 15.0, 'investment_duration' => 30],
];

// Calculate and update interest balances for each user
while ($userRow = mysqli_fetch_assoc($userResult)) {
    $userId = $userRow['id'];
    $interestWalletBalance = $userRow['interest_wallet_balance'];
    $planId = $userRow['plan_id'];

    if (array_key_exists($planId, $plans)) {
        $plan = $plans[$planId];
        $interestRate = $plan['interest_rate'];
        $investmentDuration = $plan['investment_duration'];

        // Calculate the interest based on the interest rate and investment duration
        $interest = ($interestWalletBalance * $interestRate / 100) * ($investmentDuration / 365);

        // Update the interest wallet balance for the user
        $updateQuery = "UPDATE users SET interest_wallet_balance = interest_wallet_balance + $interest WHERE id = $userId";
        mysqli_query($connection, $updateQuery);
    }
}

// Close the database connection
mysqli_close($connection);
?>
