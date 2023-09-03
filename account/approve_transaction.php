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

// Check if the necessary transaction information is received
if (isset($_GET['transaction_id'])) {
    // Sanitize and retrieve the transaction ID
    $transactionID = mysqli_real_escape_string($connection, $_GET['transaction_id']);

    // Update the database record to mark it as approved
    $query = "UPDATE deposit_history SET pending_status = 0 WHERE transaction_id = '$transactionID'";

    if (mysqli_query($connection, $query)) {
        // Retrieve the approved pending_deposit_amount and associated username
        $amountQuery = "SELECT pending_deposit_amount, username, email FROM deposit_history WHERE transaction_id = '$transactionID' AND pending_status = 0";
        $amountResult = mysqli_query($connection, $amountQuery);

        if (mysqli_num_rows($amountResult) > 0) {
            $row = mysqli_fetch_assoc($amountResult);
            $approvedAmount = $row['pending_deposit_amount'];
            $username = $row['username'];
            $recipientEmail = $row['email'];

            // Check if the user has a referrer
            $referrerQuery = "SELECT referrer_username FROM referral WHERE referred_username = '$username'";
            $referrerResult = mysqli_query($connection, $referrerQuery);

            if (mysqli_num_rows($referrerResult) > 0) {
                $referrerRow = mysqli_fetch_assoc($referrerResult);
                $referrerUsername = $referrerRow['referrer_username'];

                // Calculate referral earnings
                $referralEarningPercentage = 0.1; // 10%
                $referralEarnings = $approvedAmount * $referralEarningPercentage;

                // Update the referral earnings in the referral table
                $referralUpdateQuery = "UPDATE referral SET earnings = earnings + '$referralEarnings' WHERE referrer_username = '$referrerUsername'";
                if (mysqli_query($connection, $referralUpdateQuery)) {
                    // Update the referrer_earnings and money in the users table
                    $referrerUpdateQuery = "UPDATE users SET referrer_earnings = referrer_earnings + '$referralEarnings', money = money + '$referralEarnings' WHERE username = '$referrerUsername'";
                    if (mysqli_query($connection, $referrerUpdateQuery)) {
                        // Display the referrer and referral earnings
                        echo "Referrer: " . $referrerUsername . "<br>";
                        echo "Referral Earnings: " . $referralEarnings . "<br>";
                        echo "Amount added to referrer_earnings in users table: " . $referralEarnings . "<br>";
                        echo "Amount added to money in users table: " . $referralEarnings . "<br>";
                    } else {
                        echo "Error updating referrer earnings and money in the users table: " . mysqli_error($connection) . "<br>";
                        echo "Query: " . $referrerUpdateQuery;
                    }
                } else {
                    echo "Error updating referral earnings: " . mysqli_error($connection) . "<br>";
                    echo "Query: " . $referralUpdateQuery;
                }
            } else {
                echo "No referrer found for user: $username";
            }

            // Update the deposit_wallet_balance for the specific user in the users table
            $updateQuery = "UPDATE users SET money = money + '$approvedAmount', total_deposit = total_deposit + '$approvedAmount' WHERE username = '$username'";
            if (mysqli_query($connection, $updateQuery)) {
                // Send the email notification
                $subject = "Transaction Approved";
                $message = "Dear $username,\n\nWe are pleased to inform you that your transaction with transaction ID: $transactionID has been approved.\n\nThank you for choosing our platform.\n\nBest regards,\nTrustvestpro Team";
                $headers = "From: Trustvestpro <support@trustvestpro.cc>";

                if (mail($recipientEmail, $subject, $message, $headers)) {
                    // Set the success message in a session variable
                    session_start();
                    $_SESSION['success_message'] = "Transaction approved successfully. Wallet balance and total deposit updated for user: $username. Email notification sent.";

                    // Redirect back to the transactions.php page
                    header('Location: transactions.php');
                    exit();
                } else {
                    echo "Error sending email.";
                }
            } else {
                echo "Error updating wallet balance and total deposit: " . mysqli_error($connection);
            }
        } else {
            echo "Approved amount not found or the transaction is already approved.";
        }
    } else {
        echo "Error approving transaction: " . mysqli_error($connection);
    }
} else {
    echo "Transaction information not received.";
}

// Close the database connection
mysqli_close($connection);
?>
