<?php
// Database credentials
$host = 'localhost'; // Replace with your database host
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$database = 'coin'; // Replace with your database name

// Create a connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
session_start();

if (!isset($_SESSION['username'])) {
    // If user is not logged in, redirect to login page or show an error message
    header('Location: login.php');
    exit();
}

// Fetch user data from the database using the logged-in user's username
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($connection, $sql);

// Check if the user record was found
if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);

    // Extract the required balance values from the fetched data
    $depositBalance = $userData['deposit_wallet_balance'];
    $interestBalance = $userData['interest_wallet_balance'];
    $totalDeposit = $userData['total_deposit'];
    $totalInvest = $userData['total_invest'];
    $totalWithdraw = $userData['total_withdrawal'];
    $balanceInAccount = $userData['balance_in_account'];
    $email = $userData['email'];
    $referralEarnings = $userData['referrer_earnings']; // Update column name to 'referrer_earnings'
    
    // Fetch the total number of referrals for the logged-in user
    $referrerUsername = $_SESSION['username'];
    $referralCountQuery = "SELECT COUNT(*) AS totalReferrals FROM referral WHERE referrer_username = '$referrerUsername'";
    $referralCountResult = mysqli_query($connection, $referralCountQuery);

    // Fetch the referral earnings for the user
    $referralEarningsQuery = "SELECT SUM(earnings) AS totalReferralEarnings FROM referral WHERE referred_username = '$username'";
    $referralEarningsResult = mysqli_query($connection, $referralEarningsQuery);

    // Check if referral earnings record was found
    if (mysqli_num_rows($referralEarningsResult) > 0) {
        $referralEarningsData = mysqli_fetch_assoc($referralEarningsResult);
        $totalReferralEarnings = $referralEarningsData['totalReferralEarnings'];
    } else {
        $totalReferralEarnings = 0;
    }

    if ($referralCountResult) {
        $referralCountData = mysqli_fetch_assoc($referralCountResult);
        $totalReferrals = $referralCountData['totalReferrals'];
    } else {
        $totalReferrals = 0;
    }

    // Calculate the new total balance
    $balanceInAccount = $balanceInAccount + $interestBalance + $totalReferralEarnings;

    // Update the 'total' column in the 'users' table
    $updateQuery = "UPDATE users SET total = $balanceInAccount WHERE username = '$username'";
    mysqli_query($connection, $updateQuery);

    // Fetch the updated total balance from the database
    $sql = "SELECT total FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $totalBalance = $row['total'];
    }

    // Echo the updated total balance
    //echo "Total Balance: $totalBalance<br>";
    //echo "Referral Earnings: $totalReferralEarnings<br>";

    // Fetch the referral earnings for the user
    $referralEarningsQuery = "SELECT SUM(earnings) AS totalReferralEarnings FROM referral WHERE referrer_username = '$username'";
    $referralEarningsResult = mysqli_query($connection, $referralEarningsQuery);

    if ($referralEarningsResult) {
        $referralEarningsData = mysqli_fetch_assoc($referralEarningsResult);
        $totalReferralEarnings = $referralEarningsData['totalReferralEarnings'];
    } else {
        $totalReferralEarnings = 0;
    }

    // Echo the total balance and referral earnings
    //echo "Total Balance: $totalBalance<br>";
    //echo "Referral Earnings: $totalReferralEarnings<br>";
} else {
    // Redirect the user to an error page or display an error message
    die("User data not found.");
}

// Fetch the deposit history for the user
$depositHistoryQuery = "SELECT * FROM deposit_history WHERE username = '$username'";
$depositHistoryResult = mysqli_query($connection, $depositHistoryQuery);

// Check if deposit history records were found
if (mysqli_num_rows($depositHistoryResult) > 0) {
    // Display the deposit history table
    echo "<table>";
    while ($depositHistoryRow = mysqli_fetch_assoc($depositHistoryResult)) {
        // Extract the relevant data from the fetched row
        $historyID = $depositHistoryRow['id'];
        $gatewayTitle = $depositHistoryRow['gateway_title'];
        $pendingDepositAmount = $depositHistoryRow['pending_deposit_amount'];
        $transactionID = $depositHistoryRow['transaction_id'];
        $createdAt = $depositHistoryRow['created_at'];

        // Display a row in the deposit history table
        //echo "<tr>";
        //echo "<td>$historyID</td>";
        //echo "<td>$gatewayTitle</td>";
        //echo "<td>$pendingDepositAmount</td>";
        //echo "<td>$transactionID</td>";
        //echo "<td>$createdAt</td>";
        //echo "</tr>";
    }
    //echo "</table>";
} else {
    // No deposit history records found
   // echo "No deposit history records found.";
}

// Close the database connection
//mysqli_close($connection);

// Logout functionality
if (isset($_POST['logout'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page
    header('Location: login.php');
    exit();
}
?>












<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://widgets.coinmarketcap.com/api/widget.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="HqgHOpVPjzK2gLEPOdOHNTsZEnfeUyKp7XpC678q">
  <title>ProinvestEngine - Dashboard</title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,ProinvestEngine,investment">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="ProinvestEngine - Dashboard">
    
    <meta itemprop="name" content="ProinvestEngine - Dashboard">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="SEEDGATE- Alternative Investment option">
    <meta property="og:description" content="Introducing the first marketplace for investing in real estate debt and metaverse properties. Now you can invest in the loans made to borrowers(real estate agencies), and as they pay back their loans, you make money.And also co-own properties in the metaverse and NFTs.">
    <meta property="og:image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png"/>
    <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:url" content="dashboard.php">
    
    <meta name="twitter:card" content="summary_large_image">
  <!-- bootstrap 4  -->

  
   <link rel="stylesheet" href="./Dashboard _ Travonfx_files/bootstrap.min.css">
    <!-- <link rel="stylesheet" href=""> -->
    <link rel="stylesheet" href="./Dashboard _ Travonfx_files/font-awesome.min.css">
    <link rel="stylesheet" href="./Dashboard _ Travonfx_files/magnific-popup.css">
    <link rel="stylesheet" href="./Dashboard _ Travonfx_files/ion.rangeSlider.min.css">
    <!-- Core Stylesheet-->
    <link rel="stylesheet" href="./Dashboard _ Travonfx_files/style.css">
    <link href="./Dashboard _ Travonfx_files/sweetalert.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="dashlite.css">
  <link rel="stylesheet" href="theme.css">
  

    <style type="text/css">
    #copyBoard {
      cursor: pointer;
    }

  </style>




<style>
    .modalbox.success,
.modalbox.error {
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  background: #fff;
  padding: 25px 25px 15px;
  text-align: center;
  z-index: 9999;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.modalbox.success.animate .icon,
.modalbox.error.animate .icon {
  -webkit-animation: fall-in 0.75s;
  -moz-animation: fall-in 0.75s;
  -o-animation: fall-in 0.75s;
  animation: fall-in 0.75s;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}
.modalbox.success h1,
.modalbox.error h1 {
  font-family: 'Montserrat', sans-serif;
}
.modalbox.success p,
.modalbox.error p {
  font-family: 'Open Sans', sans-serif;
}
.modalbox.success button,
.modalbox.error button,
.modalbox.success button:active,
.modalbox.error button:active,
.modalbox.success button:focus,
.modalbox.error button:focus {
  -webkit-transition: all 0.1s ease-in-out;
  transition: all 0.1s ease-in-out;
  -webkit-border-radius: 30px;
  -moz-border-radius: 30px;
  border-radius: 30px;
  margin-top: 15px;
  width: 80%;
  background: transparent;
  color: #4caf50;
  border-color: #4caf50;
  outline: none;
}
.modalbox.success button:hover,
.modalbox.error button:hover,
.modalbox.success button:active:hover,
.modalbox.error button:active:hover,
.modalbox.success button:focus:hover,
.modalbox.error button:focus:hover {
  color: #fff;
  background: #4caf50;
  border-color: transparent;
}
.modalbox.success .icon,
.modalbox.error .icon {
  position: relative;
  margin: 0 auto;
  margin-top: -75px;
  background: #4caf50;
  height: 100px;
  width: 100px;
  border-radius: 50%;
}
.modalbox.success .icon span,
.modalbox.error .icon span {
  postion: absolute;
  font-size: 4em;
  color: #fff;
  text-align: center;
  padding-top: 20px;
}
.modalbox.error button,
.modalbox.error button:active,
.modalbox.error button:focus {
  color: #f44336;
  border-color: #f44336;
}
.modalbox.error button:hover,
.modalbox.error button:active:hover,
.modalbox.error button:focus:hover {
  color: #fff;
  background: #f44336;
}
.modalbox.error .icon {
  background: #f44336;
}
.modalbox.error .icon span {
  padding-top: 25px;
}
.center {
  float: none;
  margin-left: auto;
  margin-right: auto;
/* stupid browser compat. smh */
}
.center .change {
  clearn: both;
  display: block;
  font-size: 10px;
  color: #ccc;
  margin-top: 10px;
}
@-webkit-keyframes fall-in {
  0% {
    -ms-transform: scale(3, 3);
    -webkit-transform: scale(3, 3);
    transform: scale(3, 3);
    opacity: 0;
  }
  50% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
    opacity: 1;
  }
  60% {
    -ms-transform: scale(1.1, 1.1);
    -webkit-transform: scale(1.1, 1.1);
    transform: scale(1.1, 1.1);
  }
  100% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
  }
}
@-moz-keyframes fall-in {
  0% {
    -ms-transform: scale(3, 3);
    -webkit-transform: scale(3, 3);
    transform: scale(3, 3);
    opacity: 0;
  }
  50% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
    opacity: 1;
  }
  60% {
    -ms-transform: scale(1.1, 1.1);
    -webkit-transform: scale(1.1, 1.1);
    transform: scale(1.1, 1.1);
  }
  100% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
  }
}
@-o-keyframes fall-in {
  0% {
    -ms-transform: scale(3, 3);
    -webkit-transform: scale(3, 3);
    transform: scale(3, 3);
    opacity: 0;
  }
  50% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
    opacity: 1;
  }
  60% {
    -ms-transform: scale(1.1, 1.1);
    -webkit-transform: scale(1.1, 1.1);
    transform: scale(1.1, 1.1);
  }
  100% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
  }
}
@-webkit-keyframes plunge {
  0% {
    margin-top: -100%;
  }
  100% {
    margin-top: 25%;
  }
}
@-moz-keyframes plunge {
  0% {
    margin-top: -100%;
  }
  100% {
    margin-top: 25%;
  }
}
@-o-keyframes plunge {
  0% {
    margin-top: -100%;
  }
  100% {
    margin-top: 25%;
  }
}
@-moz-keyframes fall-in {
  0% {
    -ms-transform: scale(3, 3);
    -webkit-transform: scale(3, 3);
    transform: scale(3, 3);
    opacity: 0;
  }
  50% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
    opacity: 1;
  }
  60% {
    -ms-transform: scale(1.1, 1.1);
    -webkit-transform: scale(1.1, 1.1);
    transform: scale(1.1, 1.1);
  }
  100% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
  }
}
@-webkit-keyframes fall-in {
  0% {
    -ms-transform: scale(3, 3);
    -webkit-transform: scale(3, 3);
    transform: scale(3, 3);
    opacity: 0;
  }
  50% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
    opacity: 1;
  }
  60% {
    -ms-transform: scale(1.1, 1.1);
    -webkit-transform: scale(1.1, 1.1);
    transform: scale(1.1, 1.1);
  }
  100% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
  }
}
@-o-keyframes fall-in {
  0% {
    -ms-transform: scale(3, 3);
    -webkit-transform: scale(3, 3);
    transform: scale(3, 3);
    opacity: 0;
  }
  50% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
    opacity: 1;
  }
  60% {
    -ms-transform: scale(1.1, 1.1);
    -webkit-transform: scale(1.1, 1.1);
    transform: scale(1.1, 1.1);
  }
  100% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
  }
}
@keyframes fall-in {
  0% {
    -ms-transform: scale(3, 3);
    -webkit-transform: scale(3, 3);
    transform: scale(3, 3);
    opacity: 0;
  }
  50% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
    opacity: 1;
  }
  60% {
    -ms-transform: scale(1.1, 1.1);
    -webkit-transform: scale(1.1, 1.1);
    transform: scale(1.1, 1.1);
  }
  100% {
    -ms-transform: scale(1, 1);
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
  }
}
@-moz-keyframes plunge {
  0% {
    margin-top: -100%;
  }
  100% {
    margin-top: 15%;
  }
}
@-webkit-keyframes plunge {
  0% {
    margin-top: -100%;
  }
  100% {
    margin-top: 15%;
  }
}
@-o-keyframes plunge {
  0% {
    margin-top: -100%;
  }
  100% {
    margin-top: 15%;
  }
}
@keyframes plunge {
  0% {
    margin-top: -100%;
  }
  100% {
    margin-top: 15%;
  }
}
</style>







</head>

<body class="nk-body npc-invest bg-lighter no-touch  as-mobile">
  <div class="nk-app-root">
        <!-- wrap @s  -->
    <div class="nk-wrap ">
      <div class="nk-header nk-header-fluid is-theme">
        <div class="container-xl wide-xl">
          <div class="nk-header-wrap">
            <div class="nk-menu-trigger mr-sm-2 d-lg-none">
              <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em
                  class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand">
             <a href="dashboard.php" class="logo-link">
  <img class="logo-light logo-img" src="logo.png" alt="logo">
  <img class="logo-dark logo-img" src="logo.png" alt="logo-dark">
</a>

            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu" data-content="headerNav">
              <div class="nk-header-mobile">
                <div class="nk-header-brand">
                  <a href="dashboard.php" class="logo-link">
  <img class="logo-light logo-img" src="logo1.png" alt="logo">
  <img class="logo-dark logo-img" src="logo1.png" alt="logo-dark">
</a>

                </div>
                <div class="nk-menu-trigger mr-n2">
                  <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em
                      class="icon ni ni-arrow-left"></em></a>
                </div>
              </div>
              <ul class="nk-menu nk-menu-main ui-s2">
                <li class="nk-menu-item">
                  <a href="dashboard.php" class="nk-menu-link">
                    <span class="nk-menu-text">Dashboard</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="plan.php" class="nk-menu-link">
                    <span class="nk-menu-text">Investment</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="../account/user/withdraw.php" class="nk-menu-link">
                    <span class="nk-menu-text">Withdraw</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="user/deposit/deposit.php" class="nk-menu-link">
                    <span class="nk-menu-text">Deposit</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <!-- .nk-menu-item -->
                
                  </ul><!-- .nk-menu-sub -->
                </li><!-- .nk-menu-item -->


              </ul><!-- .nk-menu -->
            </div><!-- .nk-header-menu -->
            <div class="nk-header-tools">
            	
              <ul class="nk-quick-nav">
                <li class="dropdown user-dropdown order-sm-first">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <div class="user-toggle">
                      <div class="user-avatar sm">
                        <em class="icon ni ni-user-alt"></em>
                      </div>
                      <div class="user-info d-none d-xl-block">
                        
                        <div class="user-name dropdown-indicator"><?php echo $username; ?>
                        </div>
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1 is-light">
                    <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                      <div class="">
                        <div class="user-avatar">
                          <span>AB</span>
                        </div>
                        <div class="user-info">
                          <span class="lead-text"><?php echo $username; ?></span>
                          <span class="sub-text"><?php echo $email; ?></span>
                        </div>
                        <div class="user-action">
                          <a class="btn btn-icon mr-n2" href="../account/user/update_profile.php"><em
                              class="icon ni ni-setting"></em></a>
                        </div>
                      </div>
                    </div>
                    <div class="dropdown-inner user-account-info">
                      <h6 class="overline-title-alt">Balance in Account</h6>
                      <div class="user-balance">$<?php echo $balanceInAccount; ?> <small
                          class="currency currency-usd">USD</small></div>
                      <div class="user-balance-sub">
                  
                      </div>
                      <a href="withdraw.php" class="link">
                        <span>Withdraw Balance</span> <em class="icon ni ni-wallet-out"></em>
                      </a>
                    </div>
                    <div class="dropdown-inner">
                      <ul class="link-list">

                        <li>
                          <a href="../account/user/update_profile.php">
                            <em class="icon ni ni-user-alt"></em>Profile Setting                          </a>
                        </li>
                                                <li>
                          <a href="../account/user/changepass.php">
                            <em class="icon ni ni-lock"></em>Change Password                          </a>
                        </li>
                        <li>
                                                </a>
                        </li>
                        <li>
                                                  </a>
                        </li>
                        <li>
                                                   </a>
                        </li>

                        <li>
                          <a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a>
                        </li>
                      </ul>
                    </div>
                    <div class="dropdown-inner">
                      <ul class="link-list">
                        <li>
                         <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input class="logout-btn" type="submit" name="logout" value="Logout">
    </form>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </li><!-- .dropdown -->
              </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
          </div><!-- .nk-header-wrap -->
        </div><!-- .container-fliud -->
      </div>
      <!-- main header @e  -->





        


  <div class="nk-content nk-content-lg nk-content-fluid">
    <div class="container-xl wide-lg">
      <div class="nk-content-inner">
        <div class="nk-content-body">
          <div class="nk-block-head">
            <div class="nk-block-between-md g-3">
              <div class="nk-block-head-content">
                <div class="nk-block-head-sub"><span>Welcome!</span></div>
                <div class="align-center flex-wrap pb-2 gx-4 gy-3">
                  <div>
                    <h2 class="nk-block-title fw-normal"><?php echo strtoupper($username); ?></h2>

                  </div>
                  <div><a href="plan.php" class="btn btn-white btn-light">Investment Plans <em
                        class="icon ni ni-arrow-long-right ml-2"></em></a></div>
                </div>
                <div class="nk-block-des">
                  <p>
Quickly review the overview of your investment account. Enjoy the experience!</p>
                </div>
              </div><!-- .nk-block-head-content -->

            </div><!-- .nk-block-head -->
          </div>


           <div class="nk-block">
  <div class="row gy-gs">
    <div class="col-md-6 col-lg-4">
      <div class="nk-wg-card is-dark card card-bordered">
        <div class="card-inner">
          <div class="nk-iv-wg2">
            <div class="nk-iv-wg2-title">
              <h6 class="title">Account Balance <em class="icon ni ni-info"></em></h6>
            </div>
            <div class="nk-iv-wg2-text">
              <div class="nk-iv-wg2-amount">$<?php echo $balanceInAccount; ?></div>
            </div>
          </div>
        </div>
      </div><!-- .card -->
    </div><!-- .col -->

   

    <div class="col-md-6 col-lg-4">
      <div class="nk-wg-card is-s3 card card-bordered">
        <div class="card-inner">
          <div class="nk-iv-wg2">
            <div class="nk-iv-wg2-title">
              <h6 class="title">BTC <em class="icon ni ni-info"></em></h6>
            </div>
            <div class="nk-iv-wg2-text">
              <div class="nk-iv-wg2-amount">
                $<?php echo $totalDeposit; ?>
              </div>
            </div>
          </div>
        </div>
      </div><!-- .card -->
    </div><!-- .col -->


    <div class="col-md-6 col-lg-4">
      <div class="nk-wg-card is-s1 card card-bordered">
        <div class="card-inner">
          <div class="nk-iv-wg2">
            <div class="nk-iv-wg2-title">
              <h6 class="title">Total Withdrawal <em class="icon ni ni-info"></em></h6>
            </div>
            <div class="nk-iv-wg2-text">
              <div class="nk-iv-wg2-amount">
                $<?php echo $totalInvest; ?>
              </div>
            </div>
          </div>
        </div>
      </div><!-- .card -->
    </div><!-- .col -->
    </div><!-- .row -->
</div><!-- .nk-block -->

   


<script>
    function closeerr(){document.getElementById("error").style.display = 'none';}
</script>
<div id="error" style="display: none;">
<div class="modalbox error col-sm-8 col-md-6 col-lg-5 center animate">
      <div class="icon">
        <span class="fa fa-close"></span>
      </div>
      <!--/.icon-->
      <h1>Oh no!</h1>
      <p>Oops! Dont leave a space unfilled,
        <br> please fill all the space.</p>
      <button type="button" onclick="closeerr()" class="redo btn">Try again</button>
    </div>
</div>

<div id="popup"></div>
        <script>
function myFunction() {
  var amount = document.getElementById("tota").value;
  var endtime = document.getElementById("endtime").value;
  var symbol = document.getElementById("symbol").value;
  var rate = document.getElementById("rate").value;
  
  if (rate == 10) {
    var strikerate = 16;
  } else if (rate == 9) {
    var strikerate = 29;
  } else if (rate == 8) {
    var strikerate = 9;
  } else if (rate == 7) {
    var strikerate = 36;
  } else if (rate == 6) {
    var strikerate = 2;
  } else {
    var strikerate = 1;
  }
  
  var email = document.getElementById("email").value;
  var balance = document.getElementById("balance").value;
  var buy = 1;
  
  var dataString = 'amount=' + amount + '&endtime=' + endtime + '&symbol=' + symbol + '&buy=' + buy + '&email=' + email + '&balance=' + balance  + '&strikerate=' + strikerate;
  
  if (amount === '' || endtime === '' || symbol === '' || rate === '') {
    document.getElementById("error").style.display = 'block';
  } else {
    $.ajax({
      type: "POST",
      url: "buyaction.php",
      data: dataString,
      cache: false,
      success: function(html) {
        document.getElementById("popup").innerHTML = html;
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText); // Log the error response
        console.log(status); // Log the error status
        console.log(error); // Log the error details
      }
    });
  }
  
  return false;
}

function myFunction2() {
  var amount = document.getElementById("tota").value;
  var endtime = document.getElementById("endtime").value;
  var symbol = document.getElementById("symbol").value;
  var rate = document.getElementById("rate").value;
  var buy; // Declare the buy variable
  
  if (rate == 10) {
    var strikerate = 20;
    buy = 1; // Set the value of buy
  } else if (rate == 9) {
    var strikerate = 25;
    buy = 1; // Set the value of buy
  } else if (rate == 8) {
    var strikerate = 13;
    buy = 1; // Set the value of buy
  } else if (rate == 7) {
    var strikerate = 32;
    buy = 1; // Set the value of buy
  } else if (rate == 6) {
    var strikerate = 4;
    buy = 1; // Set the value of buy
  } else {
    var strikerate = 1;
    buy = 0; // Set the value of buy
  }
  
  var email = document.getElementById("email").value;
  var balance = document.getElementById("balance").value;
  
  var dataString = 'amount=' + amount + '&endtime=' + endtime + '&symbol=' + symbol + '&strikerate=' + strikerate + '&email=' + email + '&balance=' + balance + '&buy=' + buy; // Include buy in dataString
  
  if (amount === '' || endtime === '' || symbol === '' || rate === '') {
    document.getElementById("error").style.display = 'block';
  } else {
    $.ajax({
      type: "POST",
      url: "sellaction.php",
      data: dataString,
      cache: false,
      success: function(response) {
        if (response === "success") {
          alert("Sell action successful!"); // Display success message
        } else {
          alert("Sell action failed!"); // Display failure message
        }
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText); // Log the error response
        console.log(status); // Log the error status
        console.log(error); // Log the error details
      }
    });
  }
  
  return false;
}


        </script> 
<div wire:id="fbEE7G57j6a35OknjpBf">
    <div class="affan-features-wrap">
        <div class="container" style="margin: auto; padding: 20;">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <form id="form" name="form">
                        <input type="hidden" value="meekjordan1989@gmail.com" id="email" name="email">
                        <input type="hidden" value="0.00" id="balance" name="balance">
                    <div class="row">

                        <div class="col d-none">
                            <div class="form-group">
                                <label class="col-form-label">Category</label>
                                <select name="category" id="category" class="form-control select2 w-p100">
                                    <option value="1">CryptoCurrency</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-form-label">Symbol</label>
                                <select name="symbol" class="form-control" id="symbol">
                                                                            <option value="BCH/BTC">BCH/BTC</option>
                                                                            <option value="BCH/EUR">BCH/EUR</option>
                                                                            <option value="BCH/GBP">BCH/GBP</option>
                                                                            <option value="BTC/EOS">BTC/EOS</option>
                                                                            <option value="BTC/EUR">BTC/EUR</option>
                                                                            <option value="BTC/GBP">BTC/GBP</option>
                                                                            <option value="BTC/USDC">BTC/USDC</option>
                                                                            <option value="EOS/BTC">EOS/BTC</option>
                                                                            <option value="EOS/EUR">EOS/EUR</option>
                                                                            <option value="EOS/USD">EOS/USD</option>
                                                                            <option value="ETC/BTC">ETC/BTC</option>
                                                                            <option value="ETC/EUR">ETC/EUR</option>
                                                                            <option value="ETC/GBP">ETC/GBP</option>
                                                                            <option value="ETC/USD">ETC/USD</option>
                                                                            <option value="ETH/BTC">ETH/BTC</option>
                                                                            <option value="ETH/EUR">ETH/EUR</option>
                                                                            <option value="ETH/GBP">ETH/GBP</option>
                                                                            <option value="ETH/USDC">ETH/USDC</option>
                                                                            <option value="LTC/BTC">LTC/BTC</option>
                                                                            <option value="LTC/EUR">LTC/EUR</option>
                                                                            <option value="LTC/GBP">LTC/GBP</option>
                                                                            <option value="LTC/USD">LTC/USD</option>
                                                                            <option value="MKR/BTC">MKR/BTC</option>
                                                                            <option value="REP/BTC">REP/BTC</option>
                                                                            <option value="REP/USD">REP/USD</option>
                                                                            <option value="SOL/USDT">SOL/USDT</option>
                                                                            <option value="TRX/GBP">TRX/GBP</option>
                                                                            <option value="XLM/BTC">XLM/BTC</option>
                                                                            <option value="XLM/EUR">XLM/EUR</option>
                                                                            <option value="XLM/USDT">XLM/USDT</option>
                                                                            <option value="XRP/BTC">XRP/BTC</option>
                                                                            <option value="XRP/ETH">XRP/ETH</option>
                                                                            <option value="XRP/USDT">XRP/USDT</option>
                                                                            <option value="XRP/BNB">XRP/BNB</option>
                                                                            <option value="ZEC/BTC">ZEC/BTC</option>
                                                                            <option value="MATIC/AUD">MATIC/AUD</option>
                                                                            <option value="LTC/RUB">LTC/RUB</option>
                                                                            <option value="WBTC/BUSD">WBTC/BUSD</option>
                                                                            <option value="BNB/GBP">BNB/GBP</option>
                                                                            <option value="XMR/BUSD">XMR/BUSD</option>
                                                                            <option value="BNB/AUD">BNB/AUD</option>
                                                                            <option value="BNB/EUR">BNB/EUR</option>
                                                                            <option value="BNB/USDC">BNB/USDC</option>
                                                                            <option value="ADA/AUD">ADA/AUD</option>
                                                                            <option value="FTT/USDT">FTT/USDT</option>
                                                                            <option value="TRXDOWN/USDT">TRXDOWN/USDT</option>
                                                                            <option value="DASH/BTC">DASH/BTC</option>
                                                                            <option value="AUTO/BTC">AUTO/BTC</option>
                                                                            <option value="YFI/BTC">YFI/BTC</option>
                                                                            <option value="BTCDOWN/USDT">BTCDOWN/USDT</option>
                                                                            <option value="ETHDOWN/USDT">ETHDOWN/USDT</option>
                                                                    </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-form-label">Strike Rate</label><br>
                                <select id="rate" onchange="updateInput()" required="" class="form-control custom-select" name="strikerate" wire:change="checkRate">
                                  <option value="">Select Option</option>
                                  <option value="10">20% &amp; 16%</option>
                                  <option value="9">25% &amp; 29%</option>
                                  <option value="8">13% &amp; 9%</option>
                                  <option value="7">32% &amp; 36%</option>
                                  <option value="6">4% &amp; 2%</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-form-label" for="interval">Interval</label>
                                <select required="" class="form-control" id="endtime" name="interval">
                                    <option value="1">1 min</option>
                                    <option value="3">3 mins</option>
                                    <option value="5">5 mins</option>
                                    <option value="15">15 mins</option>
                                    <option value="30">30 mins</option>
                                    <option value="60">1 hr</option>
                                    <option value="120">2 hrs</option>
                                    <option value="1440">1 day</option>
                                    <option value="21600">15 days</option>
                                    <option value="43,200">30 days</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-form-label">Amount</label>
                                <input required="" name="amount" onkeydown="updateInput()" id="tota" type="number" value="150" class="form-control">
                            </div>
                        </div>
                        <input name="onsell" id="earnonsell" type="hidden" class="form-control">
                        <input name="onbuy" id="earnonbuy" type="hidden" class="form-control">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <label class="text-danger">$<span id="sellamount">0.00</span></label>
                                    <button name="sell" type="button" class="btn btn-danger" onclick="myFunction2()">
                                        SELL <i class="fa fa-arrow-down"></i>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <label class="text-success">$<span id="buyamount">0.00</span></label>
                                    <button name="buy" type="button" class="btn btn-success" onclick="myFunction()">
                                        BUY <i class="fa fa-arrow-up"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
            function updateInput(){
                var amount=document.getElementById("tota").value ;
                var rate=document.getElementById("rate").value;
                if(rate==10){
                    document.getElementById("buyamount").innerHTML = 16*amount/100;
                    document.getElementById("sellamount").innerHTML = 20*amount/100;
                    document.getElementById("earnonsell").value = 20*amount/100;
                    document.getElementById("earnonbuy").value = 16*amount/100;
                }
                else if(rate==9){
                    document.getElementById("buyamount").innerHTML = 29*amount/100;
                    document.getElementById("sellamount").innerHTML = 25*amount/100;
                    document.getElementById("earnonsell").value = 25*amount/100;
                    document.getElementById("earnonbuy").value = 29*amount/100;
                }
                else if(rate==8){
                    document.getElementById("buyamount").innerHTML = 9*amount/100;
                    document.getElementById("sellamount").innerHTML = 13*amount/100;
                    document.getElementById("earnonsell").value = 13*amount/100;
                    document.getElementById("earnonbuy").value = 9*amount/100;
                }
                else if(rate==7){
                    document.getElementById("buyamount").innerHTML = 36*amount/100;
                    document.getElementById("sellamount").innerHTML = 32*amount/100;
                    document.getElementById("earnonsell").value = 32*amount/100;
                    document.getElementById("earnonbuy").value = 36*amount/100;
                }
                else if(rate==6){
                    document.getElementById("buyamount").innerHTML = 2*amount/100;
                    document.getElementById("sellamount").innerHTML = 4*amount/100;
                    document.getElementById("earnonsell").value = 4*amount/100;
                    document.getElementById("earnonbuy").value = 2*amount/100;
                }
                else{
                    document.getElementById("buyamount").innerHTML = 1*amount/100;
                    document.getElementById("sellamount").innerHTML = 1*amount/100;
                    document.getElementById("earnonsell").value = 1*amount/100;
                    document.getElementById("earnonbuy").value = 1*amount/100;
                }

        }
    </script>


    <div class="container">
        <div class="element-heading">
            <h6>Recent Trades</h6>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-adaptive" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Trade Time</th>
                                <th>Symbol</th>
                                <th>Amount</th>
                                <th>Strike Rate</th>
                                <th>End Price</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Trading Type</th>
                            </tr>
                            </thead>
                            <tbody>
                                                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>














   

   
   

         
          <div class="nk-block">
            <div class="row gy-gs">
              <div class="col-md-12 col-lg-12">
                <div class="nk-wg-card card card-bordered h-100">
                  <div class="card-inner h-100">
                    <div class="nk-iv-wg2">
                     
                      
                         
                          
                        </ul>
                      </div>
					  <div class="cryptohopper-web-widget" data-id="2" data-coins="bitcoin,ethereum,tether,bnb,dogecoin,tron,solana,litecoin,polkadot,crypto-com-chain" data-ticker_position="footer" data-ticker_design="2"></div>     
<div id="coinmarketcap-widget"></div>
                      <div class="nk-iv-wg2-cta">
                      
                      </div>
                    </div>
                  </div>
                </div><!-- .card -->
              </div><!-- .col -->

            </div><!-- .row -->
          </div><!-- .nk-block -->










          <div class="nk-block">
            <div class="card card-bordered">
              <div class="nk-refwg">
                <div class="nk-refwg-invite card-inner">
                  <div class="nk-refwg-head g-3">
                    <div class="nk-refwg-title">
                      <h5 class="title">Refer Us & Earn</h5>
                      <div class="title-sub">Use the bellow link to invite your friends.</div>
                    </div>
                    <div class="nk-refwg-action">
                      <a href="#" class="btn btn-primary">Invite</a>
                    </div>
                  </div>
                  <div class="nk-refwg-url">
                    <div class="form-control-wrap">
                      <div class="form-clip clipboard-init" data-clipboard-target="#refUrl" data-success="Copied"
                        data-text="Copy Link"><em class="clipboard-icon icon ni ni-copy"></em> <span
                          class="clipboard-text">Copy Link</span></div>
                      <div class="form-icon">
                        <em class="icon ni ni-link-alt"></em>
                      </div>
                      <input type="text" class="form-control copy-text" id="refUrl"
                        <input type="text" class="form-control copy-text" id="refUrl" value="https://proinvestengine.com/account/register.php?referrer=<?php echo $username; ?>">

                    </div>
                  </div>
                </div>
                <div class="nk-refwg-stats card-inner bg-lighter">
                  <div class="nk-refwg-group g-3">
                    <div class="nk-refwg-name">
                      <h6 class="title">My Referral <em class="icon ni ni-info" data-toggle="tooltip"
                          data-placement="right" title="Referral Informations"></em></h6>
                    </div>
                    <div class="nk-refwg-info g-3">
                      <div class="nk-refwg-sub">
                        <div class="title"><?php echo $totalReferrals; ?></div>
                        <div class="sub-text">Total Joined</div>
                      </div>
                      <div class="nk-refwg-sub">
                        <div class="title">
                          $<?php echo $referralEarnings; ?></div>
                        <div class="sub-text">Referral Earn</div>
                      </div>
                    </div>
                    <div class="nk-refwg-more dropdown mt-n1 mr-n1">
                      <a href="#" class="btn btn-icon btn-trigger" data-toggle="dropdown"><em
                          class="icon ni ni-more-h"></em></a>
                    </div>
                  </div>
                  <div class="nk-refwg-ck">
                    <canvas class="chart-refer-stats" id="refBarChart"></canvas>
                  </div>
                </div>
              </div>
            </div><!-- .card -->
          </div><!-- .nk-block -->



          <div class="nk-block">
            <div class="card card-bordered">
              <div class="table-responsive--md table-responsive">
                
                  <tbody>
				  
				  <table class="table style--two">
   
        <table class="table style--two">
    <thead>
        <tr>
             <th>Order ID</th>
            <th>Trade Time</th>
            <th>Symbol</th>
            <th>Amount</th>
            <th>Strike Rate</th>
            <th>End Price</th>
            <th>End Time</th>
            <th>Status</th>
            <th>Trading Type</th>
           
        </tr>
    </thead>
   <tbody>
    <?php
    // Fetch deposit history for the logged-in user
    $depositHistoryQuery = "SELECT * FROM deposit_history WHERE username = '$username'";
    $depositHistoryResult = mysqli_query($connection, $depositHistoryQuery);

    // Check if deposit history records were found
    if (mysqli_num_rows($depositHistoryResult) > 0) {
        while ($depositHistoryRow = mysqli_fetch_assoc($depositHistoryResult)) {
            // Extract the relevant data from the fetched row
            $createdAt = $depositHistoryRow['created_at'];
            $transactionID = $depositHistoryRow['transaction_id'];
            $pendingDepositAmount = $depositHistoryRow['pending_deposit_amount'];
            $gatewayTitle = $depositHistoryRow['gateway_title'];
            $details = ''; // Replace with the actual details column value
            $postBalance = ''; // Replace with the actual post balance column value

            // Determine the pending status based on the value in the database
            $status = ($depositHistoryRow['pending_status'] == 0) ? "Approved" : "Pending";

            // Determine the font color based on the status
            $fontColor = ($depositHistoryRow['pending_status'] == 0) ? "green" : "red";

            // Display a row in the deposit history table with the appropriate font color
            echo "<tr>";
            echo "<td>$createdAt</td>";
            echo "<td>$transactionID</td>";
            echo "<td>$pendingDepositAmount</td>";
            echo "<td>$gatewayTitle</td>";
            echo "<td>$status</td>";
            echo "<td style='color: $fontColor;'>$postBalance</td>";
            echo "</tr>";
			echo "<br>";
        }
    } else {
       
    }

    // Close the database connection
    mysqli_close($connection);
    ?>
</tbody>



</tbody>



    </tbody>
</table>

   
</table>

				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
                       
              </div>
            </div>
          </div><!-- row end -->


     



 <div class="cryptohopper-web-widget" data-id="2" data-coins="bitcoin,ethereum,tether,bnb,dogecoin,tron,solana,litecoin,polkadot,crypto-com-chain" data-ticker_position="footer" data-ticker_design="2"></div>     
<div id="coinmarketcap-widget"></div>

      
      <!-- footer @s  -->
      <div class="nk-footer nk-footer-fluid bg-lighter">
        <div class="container-xl wide-lg">
          <div class="nk-footer-wrap">
            <div class="nk-footer-copyright">
              © 2023 <a href="https://primevests.com/account">ProinvestEngine</a>. All rights reserved            </div>
            <div class="nk-footer-links">
              <ul class="menu">
								<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1033"><a href="#">Terms & Condition</a></li>
								<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1034"><a href="#">Privacy Policy</a></li>
            </div>
          </div>
        </div>
      </div>
      <!-- footer @e  -->
    </div> <!-- page-wrapper end -->
  </div>
  

  <script src="bundle.js"></script>
  <script src="scripts.js"></script>
  <script src="chart-invest.js"></script>


  <link rel="stylesheet" href="iziToast.min.css">
<script src="iziToast.min.js"></script>


<script>
"use strict";
    function notify(status,message) {
        iziToast[status]({
            message: message,
            position: "topRight"
        });
    }
</script>


  
    <script>
    $('.copyBoard').click(function() {
      "use strict";
      var copyText = document.getElementById("referralURL");
      copyText.select();
      copyText.setSelectionRange(0, 99999);
      /*For mobile devices*/
      document.execCommand("copy");
      iziToast.success({
        message: "Copied: " + copyText.value,
        position: "topRight"
      });
    });
  </script>

  <script>
    (function() {
      "use strict";
      $(document).on("change", ".langSel", function() {
        window.location.href = "https://primevests.com/account/change/" + $(this).val();
      });
    })();
  </script>
<script>
// Replace 'YOUR_API_KEY' with your actual CoinMarketCap API key
coinMarCap('4d461b0f-60d7-4334-a728-6fb1db95a204').createWidget("coinmarketcap-widget", {
  currency: "USD",
  theme: "light",
  transparent: false
});
</script>

<script src="https://www.cryptohopper.com/widgets/js/script"></script>
<!--Start of Tawk.to Script-->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6495c1e494cf5d49dc5f77a2/1h3kfqq0g';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<!--End of Tawk.to Script-->
<!--End of Tawk.to Script-->







 <!-- All JavaScript Files-->
    <script src="./Dashboard _ Travonfx_files/bootstrap.bundle.min.js"></script>
    <script src="./Dashboard _ Travonfx_files/jquery.min.js"></script>
    <script src="./Dashboard _ Travonfx_files/internet-status.js"></script>
    <script src="./Dashboard _ Travonfx_files/waypoints.min.js"></script>
    <script src="./Dashboard _ Travonfx_files/jquery.easing.min.js"></script>
    <script src="./Dashboard _ Travonfx_files/wow.min.js"></script>
    <!-- <script src=""></script> -->
    <script src="./Dashboard _ Travonfx_files/isotope.pkgd.min.js"></script>
    <script src="./Dashboard _ Travonfx_files/jquery.magnific-popup.min.js"></script>
    <script src="./Dashboard _ Travonfx_files/ion.rangeSlider.min.js"></script>
    <script src="./Dashboard _ Travonfx_files/active.js"></script>
    
    <script src="./Dashboard _ Travonfx_files/jquery.js"></script>
    <script src="./Dashboard _ Travonfx_files/fastclick.js"></script>
<script src="./Dashboard _ Travonfx_files/sweetalert2@11"></script>
    <script src="./Dashboard _ Travonfx_files/bootstrap-input-spinner.js"></script>
<!-- Livewire Scripts -->

<script src="./Dashboard _ Travonfx_files/livewire.js.download" data-turbo-eval="false" data-turbolinks-eval="false"></script>
<script data-turbo-eval="false" data-turbolinks-eval="false">
    if (window.livewire) {
      console.warn('Livewire: It looks like Livewire\'s @livewireScripts JavaScript assets have already been loaded. Make sure you aren\'t loading them twice.')
  }

    window.livewire = new Livewire();
    window.livewire.devTools(true);
    window.Livewire = window.livewire;
    window.livewire_app_url = '';
    window.livewire_token = 'igdwoUYif27hDtOxyQIrCE7cVMNBOtjy8OVyiXJX';

  /* Make sure Livewire loads first. */
  if (window.Alpine) {
      /* Defer showing the warning so it doesn't get buried under downstream errors. */
      document.addEventListener("DOMContentLoaded", function () {
          setTimeout(function() {
              console.warn("Livewire: It looks like AlpineJS has already been loaded. Make sure Livewire\'s scripts are loaded before Alpine.\\n\\n Reference docs for more info: http://laravel-livewire.com/docs/alpine-js")
          })
      });
  }

  /* Make Alpine wait until Livewire is finished rendering to do its thing. */
    window.deferLoadingAlpine = function (callback) {
        window.addEventListener('livewire:load', function () {
            callback();
        });
    };

    let started = false;

    window.addEventListener('alpine:initializing', function () {
        if (! started) {
            window.livewire.start();

            started = true;
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        if (! started) {
            window.livewire.start();

            started = true;
        }
    });
</script>
<div>
    <script>
        Livewire.on('sampleEvent', function(){
            Swal.fire({
                icon: 'success',
                title: 'Oops...'
            });
        });

        Livewire.on('minTradeAmountErrorNotice', function(){
            Swal.fire({
                icon: 'error',
                title: 'Minimum trade amount is $200'
            });
        });

        Livewire.on('lowBalanceErrorNotice', function(){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Your account balance is too low to cover this trade.'
            });
        });

        Livewire.on('tradePlacedNotice', function(){
            Swal.fire({
                icon: 'success',
                title: 'Successful!',
                text: 'Your trade is now running!'
            });
        });

        Livewire.on('buyTradePlacedNotice', notice => {
            Swal.fire({icon: 'success', title: 'Call Order Traded', text: notice });
        })

        Livewire.on('sellTradePlacedNotice', notice => {
            Swal.fire({icon: 'success', title: 'Put Order Traded', text: notice });
        })

        Livewire.on('strikeRateErrorNotice', function(){
            Swal.fire({
                icon: 'info',
                title: 'Select a strike rate'
            });
        });

        Livewire.on('changesSaved', function(){
            Swal.fire({
                icon: 'success',
                title: 'Changes Saved!'
            });
        });

        Livewire.on('paymentgatewayerrornotice', function(){
            Swal.fire({
                icon: 'info',
                title: 'Select a valid payment gateway'
            });
        });

        Livewire.on('amounterrornotice', function(){
            Swal.fire({
                icon: 'info',
                title: 'Amount is too low!'
            });
        });

    </script>
</div>

</body>

</html>
