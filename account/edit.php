<!DOCTYPE html>
<html>
<head>
  <title>Edit User</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">


  <style>
    
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    form {
      max-width: 500px;
      margin: 0 auto;
    }

  .red-outline {
    outline-color: red;
  }
    .form-group {
      margin-bottom: 20px;
    }

    .form-control {
      width: 100%;
      padding: 8px 12px;
      border-radius: 4px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    .btn-primary {
      margin-top: 20px;
      padding: 10px 20px;
      border-radius: 4px;
      text-decoration: none;
      color: #fff;
      background-color: #007bff;
      border: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>Edit User</h1>

 <?php
// Check if the ID parameter is set in the URL
if (!isset($_GET['id'])) {
    echo "<p>No user ID provided.</p>";
} else {
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

    // Retrieve the user data based on the provided ID
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Display the user data in an editable form
?>
         <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <div class="form-group">
              <label for="firstname">First Name:</label>
              <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>" required>
            </div>

            <div class="form-group">
              <label for="lastname">Last Name:</label>
              <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>" required>
            </div>

            <div class="form-group">
              <label for="country">Country:</label>
              <input type="text" class="form-control" id="country" name="country" value="<?php echo $row['country']; ?>" required>
            </div>

            <div class="form-group">
              <label for="mobile">Mobile:</label>
              <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $row['mobile']; ?>" required>
            </div>

            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>

            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
            </div>

            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password" value="<?php echo $row['password']; ?>" required>
            </div>

            <div class="form-group">
              <label for="deposit_wallet_balance">Account Balance:</label>
              <input type="number" step="0.01" class="form-control" id="money" name="money" value="<?php echo $row['money']; ?>" required>
            </div>
            
           <div class="form-group">
  <label for="update_earnings">Update Earnings:</label>
  <input type="number" step="0.01" class="form-control red-outline" id="update_earnings" name="update_earnings" value="<?php echo $row['update_earnings']; ?>" required>
</div>

            
            
            
            
            
            
            <div class="form-group">
              <label for="interest_wallet_balance">Earnings:</label>
              <input type="number" step="0.01" class="form-control" id="interest_wallet_balance" name="interest_wallet_balance" value="<?php echo $row['interest_wallet_balance']; ?>" required>
            </div>

            <div class="form-group">
              <label for="total_deposit">Total Deposit:</label>
              <input type="number" step="0.01" class="form-control" id="total_deposit" name="total_deposit" value="<?php echo $row['total_deposit']; ?>" required>
            </div>

            <div class="form-group">
              <label for="total_invest">Total Invest:</label>
              <input type="number" step="0.01" class="form-control" id="total_invest" name="total_invest" value="<?php echo $row['total_invest']; ?>" required>
            </div>

            <div class="form-group">
              <label for="total_withdrawal">Total Withdraw:</label>
              <input type="number" step="0.01" class="form-control" id="total_withdrawal" name="total_withdrawal" value="<?php echo $row['total_withdrawal']; ?>" required>
            </div>

            <div class="form-group">
              <label for="balance_in_account">Balance in Account:</label>
              <input type="number" step="0.01" class="form-control" id="balance_in_account" name="balance_in_account" value="<?php echo $row['balance_in_account']; ?>" required>
            </div>

            <div class="form-group">
              <label for="interest_wallet">Interest Wallet:</label>
              <input type="number" step="0.01" class="form-control" id="interest_wallet" name="interest_wallet" value="<?php echo $row['interest_wallet']; ?>" required>
            </div>

            <div class="form-group">
              <label for="total">Total:</label>
              <input type="number" step="0.01" class="form-control" id="total" name="total" value="<?php echo $row['total']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
<?php
    } else {
        echo "<p>No user found with the provided ID.</p>";
    }

    // Close the database connection
    mysqli_close($connection);
}
?>


  <!-- Include Bootstrap JS (optional) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
