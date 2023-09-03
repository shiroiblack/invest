




<!DOCTYPE html>
<html>
<head>
    <title>Investment Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
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

// Function to display error message
function displayError($errorMessage, $planName = '')
{
    echo '<div class="box">';
    echo '<a class="button" href="#popup1"></a>';
    echo '</div>';
    echo '<div id="popup1" class="overlay">';
    echo '<div class="popup">';
    echo '<h2>Error</h2>';
    echo '<a class="close" href="plan">×</a>';
    echo '<div class="content">';
    echo $errorMessage;
    if (!empty($planName)) {
        echo ' for ' . $planName;
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

// Check if the user is logged in
session_start();
if (!isset($_SESSION['username'])) {
    displayError("User not logged in.");
    exit;
}

// Retrieve the logged-in username
$username = $_SESSION['username'];

// Retrieve the user ID based on the username
$userIdQuery = "SELECT id, email FROM users WHERE username = '$username'";
$userIdResult = mysqli_query($connection, $userIdQuery);
if ($userIdResult && mysqli_num_rows($userIdResult) > 0) {
    $userIdRow = mysqli_fetch_assoc($userIdResult);
    $userId = $userIdRow['id'];
    $recipientEmail = $userIdRow['email'];
} else {
    // Handle the error if the user ID is not found
    displayError("User ID not found for username: $username");
    exit;
}

// Retrieve the deposit wallet balance
$balanceQuery = "SELECT money FROM users WHERE username = '$username'";
$balanceResult = mysqli_query($connection, $balanceQuery);
if ($balanceResult && mysqli_num_rows($balanceResult) > 0) {
    $balanceRow = mysqli_fetch_assoc($balanceResult);
    $depositWalletBalance = floatval($balanceRow['money']);
} else {
    $depositWalletBalance = 0;
}

// Retrieve the interest wallet balance
$interestQuery = "SELECT interest_wallet_balance FROM users WHERE username = '$username'";
$interestResult = mysqli_query($connection, $interestQuery);
if ($interestResult && mysqli_num_rows($interestResult) > 0) {
    $interestRow = mysqli_fetch_assoc($interestResult);
    $interestWalletBalance = floatval($interestRow['interest_wallet_balance']);
} else {
    $interestWalletBalance = 0;
}

// Retrieve the selected plan ID from the form submission
$planId = $_POST['plan_id'];
// Define an array of plans with their corresponding IDs and names
$plans = [
    1 => 'Starter Plan',
    2 => 'Basic Plan',
    3 => 'Pro Plan',
    4 => 'Premium Plan',
    5 => 'Retirement Plan'
];

// Retrieve the corresponding plan name based on the selected plan ID
if (array_key_exists($planId, $plans)) {
    $planName = $plans[$planId];
} else {
    // Invalid plan ID, handle the error accordingly
    displayError("Invalid plan ID");
    exit;
}

// Define an array of plans with their corresponding interest rates, investment durations, min and max amounts
$plans = [
    1 => ['interest_rate' => 3.0, 'investment_duration' => 5, 'min_amount' => 50, 'max_amount' => 3000],
    2 => ['interest_rate' => 3.5, 'investment_duration' => 5, 'min_amount' => 3000, 'max_amount' => 10000],
    3 => ['interest_rate' => 4.0, 'investment_duration' => 5, 'min_amount' => 10000, 'max_amount' => 20000],
    4 => ['interest_rate' => 5.0, 'investment_duration' => 5, 'min_amount' => 20000, 'max_amount' => 35000],
    5 => ['interest_rate' => 10.0, 'investment_duration' => 5, 'min_amount' => 10000, 'max_amount' => 50000],
];

// Retrieve the corresponding interest rate, investment duration, min and max amounts based on the selected plan ID
if (array_key_exists($planId, $plans)) {
    $plan = $plans[$planId];
    $interestRate = $plan['interest_rate'];
    $investmentDuration = $plan['investment_duration'];
    $minAmount = $plan['min_amount'];
    $maxAmount = $plan['max_amount'];
} else {
    // Invalid plan ID, handle the error accordingly
    displayError("Invalid plan ID");
    exit;
}

// Retrieve other form data
$walletType = $_POST['wallet_type'];
$investAmount = $_POST['amount'];

// Check if the invest amount is within the allowed range
if ($investAmount < $minAmount) {
    displayError("Amount is too low. Minimum amount required for $planName is: $$minAmount");
    exit;
}

if ($investAmount > $maxAmount) {
    displayError("Amount is too high. Maximum amount allowed for $planName is: $$maxAmount");
    exit;
}

// Perform further processing or calculations using the retrieved values
// For example, you can calculate the total return based on the interest rate and invest amount
$totalReturn = $investAmount * ($interestRate / 100);

// Subtract the invest amount from the deposit wallet balance
$depositWalletBalance -= $investAmount;

// Update the deposit wallet balance and total_invest in the database
$updateQuery = "UPDATE users SET money = $depositWalletBalance, total_invest = total_invest + $investAmount WHERE username = '$username'";
$updateResult = mysqli_query($connection, $updateQuery);

if (!$updateResult || mysqli_affected_rows($connection) == 0) {
    // Investment was not successful, display error message
    displayError("Investment failed. Please try again later.");
    exit;
}

// Calculate the ending date based on the investment duration
$endDate = date('Y-m-d', strtotime("+$investmentDuration days"));

// Insert the investment details into the investments table
$insertQuery = "INSERT INTO investments (user_id, username, amount, interest_rate, duration, start_date, ending_date, status) 
               VALUES ($userId, '$username', $investAmount, $interestRate, $investmentDuration, NOW(), '$endDate', 'active')";
mysqli_query($connection, $insertQuery);

// Retrieve the investment ID of the newly inserted investment
$investmentId = mysqli_insert_id($connection);

// Perform daily interest calculations
$startDate = date('Y-m-d'); // Use the current date as the start date

// Iterate through each day within the investment duration
for ($date = $startDate; $date <= $endDate; $date = date('Y-m-d', strtotime("$date +1 day"))) {
    // Calculate the daily interest for the investment amount on the current date
    $dailyInterest = ($investAmount * $interestRate) / 100;
    
    // Insert the daily interest calculation into the daily_interest table
    $insertDailyInterestQuery = "INSERT INTO daily_interest (investment_id, calculation_date, investment_amount, interest_rate, daily_interest)
                                 VALUES ($investmentId, '$date', $investAmount, $interestRate, $dailyInterest)";
    mysqli_query($connection, $insertDailyInterestQuery);
}

// Close the database connection
mysqli_close($connection);

// Send email notification to the user
$subject = "Investment Confirmation";
$message = "Dear $username,\n\nWe are pleased to inform you that your investment of $$investAmount in the $planName has been successfully processed.\n\nThank you for choosing TrustvestPro as your investment partner!\n\nAt TrustvestPro, we are committed to providing exceptional investment services to our clients, and we are thrilled to have you on board.\n\nYour investment is a testament to your confidence in our expertise and dedication.\n\nRest assured that your investment will be handled with the utmost care and in accordance with our rigorous investment strategies.\n\nOur team of seasoned professionals is focused on delivering strong returns and maximizing the potential of your investment.\n\nWe want to take this opportunity to express our gratitude for your trust and assure you that we will work diligently to meet and exceed your expectations.\n\nShould you have any questions or require assistance, our dedicated support team is always here to help.\n\nOnce again, thank you for choosing TrustvestPro. We are honored to have you as a valued investor and look forward to a prosperous journey together.\n\nBest regards,\nThe TrustvestPro Team";
$headers = "From:support@trustvestpro.cc"; // Replace with your email address

mail($recipientEmail, $subject, $message, $headers);

// Investment was successful, redirect to success.html
header("Location: success.html");
exit;
?>





</body>
</html>
