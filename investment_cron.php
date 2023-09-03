<?php

// Database credentials
$servername = "server343";
$dbUsername = "truspqek_coin";
$dbPassword = "snakes199323";
$dbname = "truspqek_coin";

// Create a connection
$connection = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch user-specific active investments with user information
$fetchQuery = "SELECT i.id AS investment_id, i.user_id, i.plan_id, i.amount, i.duration, i.interest_rate, i.earnings, i.start_date, i.ending_date, i.status, u.username FROM investments AS i JOIN users AS u ON i.user_id = u.id WHERE i.status = 'active'";
$result = mysqli_query($connection, $fetchQuery);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

if (mysqli_num_rows($result) == 0) {
    die("No active investments found");
}

$currentDate = date('Y-m-d');
$totalEarningsForAllUsers = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $investmentId = $row['investment_id'];
    $userId = $row['user_id'];
    $username = $row['username'];
    $planId = $row['plan_id'];
    $amount = $row['amount'];
    $duration = $row['duration'];
    $interestRate = $row['interest_rate'];
    $currentEarnings = $row['earnings'];
    $startDate = $row['start_date'];
    $endDate = $row['ending_date'];

    if ($currentDate >= $endDate) {
        $updateStatusQuery = "UPDATE investments SET status = 'inactive' WHERE id = $investmentId";
        mysqli_query($connection, $updateStatusQuery);

        // Add earnings to total earnings for all users
        $totalEarningsForAllUsers += $currentEarnings;

        continue;
    }

    $investmentEndDate = date('Y-m-d', strtotime($startDate . " + $duration days"));
    if ($currentDate >= $investmentEndDate) {
        $updateStatusQuery = "UPDATE investments SET status = 'inactive' WHERE id = $investmentId";
        mysqli_query($connection, $updateStatusQuery);
        continue;
    }

    $earnings = $amount * ($interestRate / 100);
    $totalEarnings = $currentEarnings + $earnings;

    // Update the investment record with the calculated earnings
    $updateQuery = "UPDATE investments SET earnings = $totalEarnings WHERE id = $investmentId";
    mysqli_query($connection, $updateQuery);

    // Update the user's interest_wallet_balance
    $updateUserBalanceQuery = "UPDATE users SET interest_wallet_balance = interest_wallet_balance + $earnings WHERE id = $userId";
    mysqli_query($connection, $updateUserBalanceQuery);

    echo "Updating investment ID $investmentId for user $username with earnings: $totalEarnings and updating interest_wallet_balance: $earnings<br>";

    // Add earnings to total earnings for all users
    $totalEarningsForAllUsers += $earnings;
}

// If today is the enddate, add total earnings and initial invested amount to the money column
if ($currentDate == $endDate) {
    // Update the money column in the users table with the total earnings and initial invested amount
    $updateTotalMoneyQuery = "UPDATE users SET money = money + $totalEarningsForAllUsers + $amount";
    mysqli_query($connection, $updateTotalMoneyQuery);
}

mysqli_close($connection);
?>
