<?php
// update_transaction.php

// Your database credentials
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "coin";

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

    // Update the End Price and Status in the database for the specific transaction
    $updateQuery = "UPDATE trades SET end_price = '$updatedEndPrice', status = '$updatedStatus' WHERE transaction_id = '$transactionID'";

    if (mysqli_query($connection, $updateQuery)) {
        // Check if the selected status is "Won"
        if ($updatedStatus === "Won") {
            // Retrieve the 'amount' from the 'trades' table based on the username associated with the transaction
            $usernameQuery = "SELECT users.username, trades.amount FROM trades
                              INNER JOIN users ON trades.user_id = users.user_id
                              WHERE trades.transaction_id = '$transactionID'";

            $usernameResult = mysqli_query($connection, $usernameQuery);

            if ($usernameResult && mysqli_num_rows($usernameResult) > 0) {
                $row = mysqli_fetch_assoc($usernameResult);
                $username = $row['username'];
                $amount = $row['amount'];

                // Update the 'money' column in the 'users' table by adding the updated end price to the amount
                $updateMoneyQuery = "UPDATE users SET demo_trade_money = demo_trade_money + '$updatedEndPrice' + '$amount' WHERE username = '$username'";
                mysqli_query($connection, $updateMoneyQuery);

                mysqli_free_result($usernameResult);
            }
        }

        // Update successful, redirect back to the transactions.php page with a success message
        session_start();
        $_SESSION['success_message'] = "Transaction updated successfully!";
        mysqli_close($connection);
        header("Location: demotrades.php");
        exit();
    } else {
        // Update failed, handle the error as needed (e.g., display an error message)
        echo "Error updating transaction: " . mysqli_error($connection);
    }
} else {
    // Retrieve the 'amount' value from the 'trades' table for the specific transaction
    if (isset($_GET['id'])) {
        $transactionID = $_GET['id'];
        $amountQuery = "SELECT amount FROM demo_trades WHERE transaction_id = '$transactionID'";
        $amountResult = mysqli_query($connection, $amountQuery);

        if ($amountResult && mysqli_num_rows($amountResult) > 0) {
            $row = mysqli_fetch_assoc($amountResult);
            $amount = $row['amount'];
        }
    }
}

// Close the database connection
mysqli_close($connection);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Transaction</title>
</head>
<body>
    <h4 class="nk-block-title fw-normal">Update Trade</h4>
     <h2 class="nk-block-title fw-normal">Don't forget to tick " Is Loss" if you want it to be a loss!!! e.g -$5000.</h2>
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
