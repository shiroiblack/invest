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

    // Update the database record to mark it as declined
    $query = "UPDATE deposit_history SET pending_status = 2 WHERE transaction_id = '$transactionID'";

    if (mysqli_query($connection, $query)) {
        // Retrieve the username and email of the user associated with the declined transaction
        $userQuery = "SELECT username, email FROM deposit_history WHERE transaction_id = '$transactionID'";
        $userResult = mysqli_query($connection, $userQuery);

        if ($userResult && mysqli_num_rows($userResult) > 0) {
            $userData = mysqli_fetch_assoc($userResult);
            $username = $userData['username'];
            $email = $userData['email'];

            // Send the email notification
            $subject = "Transaction Declined";
            $message = "Dear $username,\n\nWe regret to inform you that your transaction with transaction ID: $transactionID has been declined.\n\nIf you have any questions or concerns, please contact our support team.\n\nThank you for choosing our platform.\n\nBest regards,\nThe Trustvestpro Team";
            $headers = "From: Trustvestpro <support@trustvestpro.cc>";

            if (mail($email, $subject, $message, $headers)) {
                // Set the success message in a session variable
                session_start();
                $_SESSION['success_message'] = "Transaction declined successfully. An email notification has been sent to the user.";

                // Redirect back to the transactions.php page with the success message as a query parameter
                header('Location: transactions.php?success_message=' . urlencode($_SESSION['success_message']));
                exit();
            } else {
                echo "Error sending email.";
            }
        } else {
            echo "User data not found.";
        }
    } else {
        echo "Error declining transaction: " . mysqli_error($connection);
    }
} else {
    echo "Transaction information not received.";
}

// Close the database connection
mysqli_close($connection);
?>
