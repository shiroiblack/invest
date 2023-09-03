<?php
// update_transaction.php

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the transaction ID from the URL parameter
    $transactionID = isset($_GET['id']) ? $_GET['id'] : null;

    // Retrieve the updated End Price and Status from the submitted form
    $updatedEndPrice = isset($_POST['endPrice']) ? $_POST['endPrice'] : null;
    $updatedStatus = isset($_POST['status']) ? $_POST['status'] : null;

    // Check if the 'isLoss' checkbox is selected
    $isLoss = isset($_POST['isLoss']) ? true : false;

    // If it's a loss, make the amount negative
    if ($isLoss) {
        $updatedEndPrice = -$updatedEndPrice;
    }

    // Update the End Price and Status in the 'trades' table for the specific transaction
    $updateQuery = "UPDATE trades SET end_price = '$updatedEndPrice', status = '$updatedStatus' WHERE transaction_id = '$transactionID'";

    if (mysqli_query($connection, $updateQuery)) {
        // Check if the status is "Won" to update the user's balance
        if ($updatedStatus === "Won") {
            // Retrieve the 'username' associated with the transaction
            $usernameQuery = "SELECT username FROM trades WHERE transaction_id = '$transactionID'";
            $usernameResult = mysqli_query($connection, $usernameQuery);

            if ($usernameResult && mysqli_num_rows($usernameResult) > 0) {
                $row = mysqli_fetch_assoc($usernameResult);
                $username = $row['username'];

                // Update the 'money' column in the 'users' table by adding the updated end price
                $updateMoneyQuery = "UPDATE users SET money = money + ? WHERE username = ?";
                $stmt = mysqli_prepare($connection, $updateMoneyQuery);

                if ($stmt) {
                    // Bind the parameters and execute the statement
                    mysqli_stmt_bind_param($stmt, "ds", $updatedEndPrice, $username);
                    mysqli_stmt_execute($stmt);

                    // Close the statement
                    mysqli_stmt_close($stmt);

                    // Retrieve user's email from the 'users' table
                    $emailQuery = "SELECT email FROM users WHERE username = '$username'";
                    $emailResult = mysqli_query($connection, $emailQuery);

                    if ($emailResult && mysqli_num_rows($emailResult) > 0) {
                        $emailRow = mysqli_fetch_assoc($emailResult);
                        $userEmail = $emailRow['email'];

                        // Send email notification to the user
                        $to = $userEmail;
                        $subject = "Trade Concluded";
                        $message = "Dear $username,\n\nYour trade with transaction ID: $transactionID has been concluded. \n\nThank you for trading with us.\n\nBest regards,\nAffliateAsset Team";
                        $headers = "From: AffliateAsset <support@affliateasset.cc>";

                        // Uncomment the following line to send the email
                        mail($to, $subject, $message, $headers);
                    }

                    mysqli_free_result($emailResult);
                } else {
                    // Error handling for the prepared statement
                    echo "Error in prepared statement: " . mysqli_error($connection);
                }

                mysqli_free_result($usernameResult);
            }
        }

        // Update successful, redirect back to the transactions.php page with a success message
        session_start();
        $_SESSION['success_message'] = "Transaction updated successfully!";
        header("Location: trades.php");
        exit();
    } else {
        // Error handling for the update query
        echo "Error updating transaction: " . mysqli_error($connection);
    }
}

// Retrieve the 'amount' value from the 'trades' table for the specific transaction
if (isset($_GET['id'])) {
    $transactionID = $_GET['id'];
    $amountQuery = "SELECT amount FROM trades WHERE transaction_id = '$transactionID'";
    $amountResult = mysqli_query($connection, $amountQuery);

    if ($amountResult && mysqli_num_rows($amountResult) > 0) {
        $row = mysqli_fetch_assoc($amountResult);
        $amount = $row['amount'];
    }
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Transaction</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            max-width: 400px;
            margin: 0 auto;
        }

        h4 {
            font-size: 1.2rem;
            font-weight: normal;
            margin-top: 0;
        }

        h2 {
            font-size: 1.4rem;
            font-weight: normal;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h4 class="nk-block-title fw-normal">Update Trade</h4>
    <h2 class="nk-block-title fw-normal">Don't forget to tick "Is Loss" if you want it to be a loss!!! e.g -$5000.</h2>
    <!-- Display the form to update the End Price and Status -->
    <form action="update_transaction.php?id=<?php echo $_GET['id']; ?>" method="post">
        <label for="endPrice">Updated End Price:</label>
        <input type="number" name="endPrice" value="<?php echo isset($amount) ? abs($amount) : ''; ?>" required>

        <label for="status">Updated Status:</label>
        <select name="status">
            <option value="On going">On going</option>
            <option value="Won">Won</option>
            <option value="Loss">Loss</option>
        </select>

        <input type="checkbox" name="isLoss" id="isLoss" value="1">
        <label for="isLoss">Is Loss?</label>

        <input type="submit" value="Update">
    </form>
</body>
</html>
