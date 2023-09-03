<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Database credentials
$servername = "server343";
$dbUsername = "truspqek_coin";
$dbPassword = "snakes199323";
$dbname = "truspqek_coin";

// Create a connection
try {
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $dbUsername, $dbPassword);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!$connection) {
        die("Database connection failed.");
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If user is not logged in, redirect to login page or show an error message
    header('Location: login');
    exit();
}

// Fetch user data from the database using the logged-in user's username
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $connection->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();

// Check if the user record was found
if ($stmt && $stmt->rowCount() > 0) {
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Extract the required balance values from the fetched data
    $depositBalance = $userData['deposit_wallet_balance'];
    $totalDeposit = $userData['total_deposit'];
    $totalInvest = $userData['total_invest'];
    $totalWithdraw = $userData['total_withdrawal'];
    $balanceInAccount = $userData['balance_in_account'];
    $Money = $userData['money'];
    $email = $userData['email'];
    $interestBalance = $userData['interest_wallet_balance'];
    $referralEarnings = $userData['referrer_earnings'];

    // Fetch the total number of referrals for the logged-in user
    $referrerUsername = $_SESSION['username'];
    $referralCountQuery = "SELECT COUNT(*) AS totalReferrals FROM referral WHERE referrer_username = :referrerUsername";
    $referralCountStmt = $connection->prepare($referralCountQuery);
    $referralCountStmt->bindParam(':referrerUsername', $referrerUsername);
    $referralCountStmt->execute();

    // Check if referral count record was found
    if ($referralCountStmt && $referralCountStmt->rowCount() > 0) {
        $referralCountData = $referralCountStmt->fetch(PDO::FETCH_ASSOC);
        $totalReferrals = $referralCountData['totalReferrals'];
    } else {
        $totalReferrals = 0;
    }

    // Calculate the new total balance
    $money = $Money;

    // Update the 'total' and 'money' columns in the 'users' table
    $updateQuery = "UPDATE users SET total = :balanceInAccount, money = :money WHERE username = :username";
    $updateStmt = $connection->prepare($updateQuery);
    $updateStmt->bindParam(':balanceInAccount', $balanceInAccount);
    $updateStmt->bindParam(':money', $money);
    $updateStmt->bindParam(':username', $username);
    $updateStmt->execute();

    // Fetch the updated total balance from the database
    $sql = "SELECT total FROM users WHERE username = :username";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    if ($stmt && $stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalBalance = $row['total'];
    }

    // Fetch the updated money from the database
    $sql = "SELECT money FROM users WHERE username = :username";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    if ($stmt && $stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $Money = $row['money'];
    }
} else {
    // Redirect the user to an error page or display an error message
    die("User data not found.");
}

// Fetch the deposit history for the user
$depositHistoryQuery = "SELECT * FROM deposit_history WHERE username = :username";
$depositHistoryStmt = $connection->prepare($depositHistoryQuery);
$depositHistoryStmt->bindParam(':username', $username);
$depositHistoryStmt->execute();

// Check if deposit history records were found
if ($depositHistoryStmt && $depositHistoryStmt->rowCount() > 0) {
    // Display the deposit history table
    while ($depositHistoryRow = $depositHistoryStmt->fetch(PDO::FETCH_ASSOC)) {
        // Extract the relevant data from the fetched row
        $historyID = $depositHistoryRow['id'];
        $gatewayTitle = $depositHistoryRow['gateway_title'];
        $pendingDepositAmount = $depositHistoryRow['pending_deposit_amount'];
        $transactionID = $depositHistoryRow['transaction_id'];
        $createdAt = $depositHistoryRow['created_at'];

        // Display a row in the deposit history table
        // echo "<tr>";
        // echo "<td>$historyID</td>";
        // echo "<td>$gatewayTitle</td>";
        // echo "<td>$pendingDepositAmount</td>";
        // echo "<td>$transactionID</td>";
        // echo "<td>$createdAt</td>";
        // echo "</tr>";
    }
} else {
    // No deposit history records found
    // echo "No deposit history records found.";
}

// Logout functionality
if (isset($_POST['logout'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page
    header('Location: login');
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
  <title>Trustvestpro - Dashboard</title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,Trustvestpro,investment">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Trustvestpro - Dashboard">
    
    <meta itemprop="name" content="Trustvestpro - Dashboard">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="SEEDGATE- Alternative Investment option">
    <meta property="og:description" content="Introducing the first marketplace for investing in real estate debt and metaverse properties. Now you can invest in the loans made to borrowers(real estate agencies), and as they pay back their loans, you make money.And also co-own properties in the metaverse and NFTs.">
    <meta property="og:image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png"/>
    <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:url" content="dashboard">
    
    <meta name="twitter:card" content="summary_large_image">
  <!-- bootstrap 4  -->

  
  
   <link rel="stylesheet" href="dashlite.css">
  <link rel="stylesheet" href="theme.css">
  

    <style type="text/css">
    #copyBoard {
      cursor: pointer;
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
             <a href="dashboard" class="logo-link">
  <img class="logo-light logo-img" src="logo.png" alt="logo">
  <img class="logo-dark logo-img" src="logo.png" alt="logo-dark">
</a>

            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu" data-content="headerNav">
              <div class="nk-header-mobile">
                <div class="nk-header-brand">
                  <a href="dashboard" class="logo-link">
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
                  <a href="dashboard" class="nk-menu-link">
                    <span class="nk-menu-text">Dashboard</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="plan" class="nk-menu-link">
                    <span class="nk-menu-text">Investment</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="../account/user/withdraw" class="nk-menu-link">
                    <span class="nk-menu-text">Withdraw</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="user/deposit/deposit" class="nk-menu-link">
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
                        
                        <div class="user-info">
                          <span class="lead-text"><?php echo $username; ?></span>
                          <span class="sub-text"><?php echo $email; ?></span>
                        </div>
                        <div class="user-action">
                          <a class="btn btn-icon mr-n2" href="../account/user/update_profile"><em
                              class="icon ni ni-setting"></em></a>
                        </div>
                      </div>
                    </div>
                    <div class="dropdown-inner user-account-info">
                      <h6 class="overline-title-alt">Balance in Account</h6>
                      <div class="user-balance">$<?php echo $Money; ?> <small
                          class="currency currency-usd">USD</small></div>
                      <div class="user-balance-sub">
                  
                      </div>
                      <a href="../account/user/withdraw" class="link">
                        <span>Withdraw Balance</span> <em class="icon ni ni-wallet-out"></em>
                      </a>
                    </div>
                    <div class="dropdown-inner">
                      <ul class="link-list">

                        <li>
                          <a href="../account/user/update_profile">
                            <em class="icon ni ni-user-alt"></em>Profile Setting                          </a>
                        </li>
                                                <li>
                          <a href="../account/user/changepass">
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
                  <div><a href="plan" class="btn btn-white btn-light">Investment Plans <em
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
              <div class="nk-iv-wg2-amount">$<?php echo $Money; ?></div>
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
              <h6 class="title">Total Earnings <em class="icon ni ni-info"></em></h6>
            </div>
            <div class="nk-iv-wg2-text">
              <div class="nk-iv-wg2-amount">$<?php echo $interestBalance; ?></div>
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
              <h6 class="title">Total Invest <em class="icon ni ni-info"></em></h6>
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

    <div class="col-md-6 col-lg-8">
      <div class="nk-wg-card is-s1 card card-bordered">
        <div class="card-inner">
          <div class="nk-iv-wg2">
            <div class="nk-iv-wg2-title">
              <h6 class="title">Total Withdraw <em class="icon ni ni-info"></em></h6>
            </div>
            <div class="nk-iv-wg2-text">
              <div class="nk-iv-wg2-amount">
                $<?php echo $totalWithdraw; ?>
              </div>
            </div>
          </div>
        </div>
      </div><!-- .card -->
    </div><!-- .col -->
  </div><!-- .row -->
</div><!-- .nk-block -->

         
          <div class="nk-block">
            <div class="row gy-gs">
              <div class="col-md-12 col-lg-12">
                <div class="nk-wg-card card card-bordered h-100">
                  <div class="card-inner h-100">
                    <div class="nk-iv-wg2">
                     
                        <ul class="nk-iv-wg2-list">
                         
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
                        <input type="text" class="form-control copy-text" id="refUrl" value="https://Trustvestpro.cc/account/register.php?referrer=<?php echo $username; ?>">

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
                         
                        <div class="sub-text">Referral Earn</div>
                      </div>
                       $<?php echo $referralEarnings; ?>
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
            <th>Date</th>
            <th>Transaction ID</th>
            <th>Amount</th>
            <th>Wallet</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch the last 5 deposit history records for the logged-in user
        $depositHistoryQuery = "SELECT * FROM deposit_history WHERE username = :username ORDER BY created_at DESC LIMIT 5";
        $depositHistoryStmt = $connection->prepare($depositHistoryQuery);
        
        // Check if the connection and statement are valid
        if ($connection && $depositHistoryStmt) {
            $depositHistoryStmt->bindParam(':username', $username);
            $depositHistoryStmt->execute();

            // Check if deposit history records were found
            if ($depositHistoryStmt->rowCount() > 0) {
                while ($depositHistoryRow = $depositHistoryStmt->fetch(PDO::FETCH_ASSOC)) {
                    // Extract the relevant data from the fetched row
                    $createdAt = $depositHistoryRow['created_at'];
                    $transactionID = $depositHistoryRow['transaction_id'];
                    $pendingDepositAmount = $depositHistoryRow['pending_deposit_amount'];
                    $gatewayTitle = $depositHistoryRow['gateway_title'];
                    $details = ''; // Replace with the actual details column value
                    $postBalance = ''; // Replace with the actual post balance column value

                    // Determine the pending status based on the value in the database
                $status = '';
                $fontColor = '';
                switch ($depositHistoryRow['pending_status']) {
                    case 0:
                        $status = 'Approved';
                        $fontColor = 'green';
                        break;
                    case 1:
                        $status = 'Pending';
                        $fontColor = 'blue';
                        break;
                    case 2:
                        $status = 'Declined';
                        $fontColor = 'red';
                        break;
                    default:
                        $status = 'Unknown';
                        $fontColor = 'black';
                        break;
                }

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
                // No deposit history records found
                echo "<tr><td colspan='6'>No deposit history records found.</td></tr>";
            }
        } else {
            // Handle the case where the connection or statement is invalid
            echo "Database error: Failed to prepare the statement.";
        }

        // Close the database connection (optional if you are using PDO persistent connection)
        $connection = null;
        ?>
    </tbody>
</table>





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
              © 2019 <a href="https://Trustvestpro.cc">Trustvestpro</a>. All rights reserved            </div>
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
<script src="js/iziToast.min.js"></script>


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
<script src="//code.tidio.co/1pitlmh4lhqgfytpakerk7i3qt0liah2.js" async></script>

</body>

</html>
