<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Database credentials
$servername = "server343";
$dbUsername = "truspqek_coin";
$dbPassword = "snakes199323";
$dbname = "truspqek_coin";


    // Create a connection
    $connection = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

    // Check if the connection was successful
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve the form data
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $country = $_POST['country'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $money = $_POST['money'];
    $interest_wallet_balance = $_POST['interest_wallet_balance'];
    $total_deposit = $_POST['total_deposit'];
    $total_invest = $_POST['total_invest'];
    $total_withdrawal = $_POST['total_withdrawal'];
    $balance_in_account = $_POST['balance_in_account'];
    $interest_wallet = $_POST['interest_wallet'];
    $total = $_POST['total'];
    $update_earnings = $_POST['update_earnings'];

    // Calculate the updated money value
    $updated_money = $money + $update_earnings;
    $updated_earn = $interest_wallet_balance + $update_earnings;
    
    // Debug output
    echo "Current money value: " . $money . "<br>";
    echo "Update earnings value: " . $update_earnings . "<br>";
    echo "Updated money value: " . $updated_money . "<br>";
    echo "Updated earn value: " . $updated_earn . "<br>";

    // Update the user data in the database
    $sql = "UPDATE users SET
            firstname = '$firstname',
            lastname = '$lastname',
            country = '$country',
            mobile = '$mobile',
            email = '$email',
            username = '$username',
            password = '$password',
            money = '$updated_money',
            interest_wallet_balance = '$updated_earn' ,
            total_deposit = '$total_deposit',
            total_invest = '$total_invest',
            total_withdrawal = '$total_withdrawal',
            balance_in_account = '$balance_in_account',
            interest_wallet = '$interest_wallet',
            total = '$total'
            WHERE id = '$id'";

    if (mysqli_query($connection, $sql)) {
        // Clear the update_earnings value
        $update_earnings = '';

        // Redirect back to the admin.php page
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating user: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
