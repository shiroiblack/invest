<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

<?php
// Database credentials
$servername = "server309";
$dbUsername = "proinhar_root";
$dbPassword = "Snakes199323";
$dbname = "proinhar_coin";

// Create a connection
$connection = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Function to display error message
function displayError($errorMessage)
{
    die("Error: " . $errorMessage);
}

// Function to calculate and update daily interest
function calculateDailyInterest($investorId, $connection)
{
    // Calculate and store the daily interest in the daily_interest table
    $insertQuery = "INSERT INTO daily_interest (investor_id, calculation_date, investment_amount, interest_rate, daily_interest)
                    SELECT 
                        investor_id,
                        CURDATE() AS calculation_date,
                        investment_amount,
                        interest_rate,
                        (investment_amount * (interest_rate / 100)) AS daily_interest
                    FROM investments
                    WHERE investor_id = ?
                    AND status = 'active'
                    AND start_date <= CURDATE()
                    AND CURDATE() <= DATE_ADD(start_date, INTERVAL duration DAY)";
    
    $statement = mysqli_prepare($connection, $insertQuery);
    mysqli_stmt_bind_param($statement, "i", $investorId);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    
    // Update the investor's interest wallet balance
    $updateQuery = "UPDATE users
                    SET interest_wallet_balance = interest_wallet_balance + (
                        SELECT SUM(daily_interest)
                        FROM daily_interest
                        WHERE investor_id = ?
                        AND calculation_date = CURDATE()
                    )
                    WHERE id = ?";
    
    $statement = mysqli_prepare($connection, $updateQuery);
    mysqli_stmt_bind_param($statement, "ii", $investorId, $investorId);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}

// Retrieve active investor IDs
$investorQuery = "SELECT id FROM users WHERE status = 'active'";
$investorResult = mysqli_query($connection, $investorQuery);

if ($investorResult) {
    while ($investorRow = mysqli_fetch_assoc($investorResult)) {
        $investorId = $investorRow['id'];
        calculateDailyInterest($investorId, $connection);
    }
} else {
    displayError("Failed to retrieve investor data.");
}

// Close the database connection
mysqli_close($connection);
