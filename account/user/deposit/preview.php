<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If user is not logged in, redirect to login page or show an error message
    header('Location: account/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['pending_deposit_amount'], $_SESSION['gateway_title'], $_SESSION['transaction_id'])) {
        $depositAmount = $_SESSION['pending_deposit_amount'];
        $gatewayTitle = $_SESSION['gateway_title'];
        $transactionID = $_SESSION['transaction_id'];

        // Display the deposit information for confirmation
        echo "Deposit Amount: $depositAmount<br>";
        echo "Gateway Title: $gatewayTitle<br>";
        echo "Transaction ID: $transactionID<br>";

        // Access other values from the session
        echo "Deposit Wallet Balance: " . $_SESSION['deposit_wallet_balance'] . "<br>";
        echo "Username: " . $_SESSION['username'] . "<br>";
        echo "Interest Wallet Balance: " . $_SESSION['interest_wallet_balance'] . "<br>";
        echo "Total Deposit: " . $_SESSION['total_deposit'] . "<br>";
        echo "Total Invest: " . $_SESSION['total_invest'] . "<br>";
        echo "Total Withdraw: " . $_SESSION['total_withdraw'] . "<br>";
        echo "Balance in Account: " . $_SESSION['balance_in_account'] . "<br>";
        echo "Email: " . $_SESSION['email'] . "<br>";
    } else {
        // If the required data is not set in the session, redirect the user to the deposit form
        header("Location: deposit.php");
        exit;
    }
} else {
    // If the form is not submitted via POST, redirect the user to the deposit form
    header("Location: deposit.php");
    exit;
}

?>







<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="byEyVQt1MMlj8hjPM03msaMNfeZlcr4TC9MLw9ct">
  <title>Primevests - Payment Preview</title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,primevests,investment">
    <link rel="shortcut icon" href="https://primevests.com/account/assets/images/logoIcon/favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="https://primevests.com/account/assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Primevests - Payment Preview">
    
    <meta itemprop="name" content="Primevests - Payment Preview">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="SEEDGATE- Alternative Investment option">
    <meta property="og:description" content="Introducing the first marketplace for investing in real estate debt and metaverse properties. Now you can invest in the loans made to borrowers(real estate agencies), and as they pay back their loans, you make money.And also co-own properties in the metaverse and NFTs.">
    <meta property="og:image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png"/>
    <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:url" content="https://primevests.com/account/user/deposit/preview">
    
    <meta name="twitter:card" content="summary_large_image">
  <!-- bootstrap 4  -->

  
  
  <link rel="stylesheet" href="https://primevests.com/account/assets/templates/dashlite//css/dashlite.css?ver=2.4.0">
  <link rel="stylesheet" href="https://primevests.com/account/assets/templates/dashlite//css/theme.css?ver=2.4.0">
  

    <style type="text/css">
    .p-prev-list img {
      max-width: 100px;
      max-height: 100px;
      margin: 0 auto;
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
              <a href="https://primevests.com/account" class="logo-link">
                <img class="logo-light logo-img" src="https://primevests.com/account/assets/images/logoIcon/logo.png"
                  srcset="https://primevests.com/account/assets/images/logoIcon/logo.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="https://primevests.com/account/assets/images/logoIcon/logo.png"
                  srcset="https://primevests.com/account/assets/images/logoIcon/logo.png 2x" alt="logo-dark">
              </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu" data-content="headerNav">
              <div class="nk-header-mobile">
                <div class="nk-header-brand">
                  <a href="https://primevests.com/account" class="logo-link">
                    <img class="logo-light logo-img"
                      src="https://primevests.com/account/assets/images/logoIcon/logo.png"
                      srcset="https://primevests.com/account/assets/images/logoIcon/logo.png 2x" alt="logo">
                    <img class="logo-dark logo-img"
                      src="https://primevests.com/account/assets/images/logoIcon/logo.png"
                      srcset="https://primevests.com/account/assets/images/logoIcon/logo.png 2x" alt="logo-dark">
                  </a>
                </div>
                <div class="nk-menu-trigger mr-n2">
                  <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em
                      class="icon ni ni-arrow-left"></em></a>
                </div>
              </div>
              <ul class="nk-menu nk-menu-main ui-s2">
                <li class="nk-menu-item">
                  <a href="https://primevests.com/account/user/dashboard" class="nk-menu-link">
                    <span class="nk-menu-text">Dashboard</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="https://primevests.com/account/user/plan" class="nk-menu-link">
                    <span class="nk-menu-text">Investment</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="https://primevests.com/account/user/withdraw" class="nk-menu-link">
                    <span class="nk-menu-text">Withdraw</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="deposit.php" class="nk-menu-link">
                    <span class="nk-menu-text">Deposit</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="https://primevests.com/account/user/transactions/deposit-wallet" class="nk-menu-link">
                    <span class="nk-menu-text">Transactions</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item has-sub">
                  <a href="#" class="nk-menu-link nk-menu-toggle">
                    <span class="nk-menu-text">Referrals</span>
                  </a>
                  <ul class="nk-menu-sub">
                    <li class="nk-menu-item">
                      <a href="https://primevests.com/account/user/referral/users" class="nk-menu-link"><span
                          class="nk-menu-text">Referred Users</span></a>
                    </li>
                    <li class="nk-menu-item">
                      <a href="https://primevests.com/account/user/referral/commissions/deposit" class="nk-menu-link"><span
                          class="nk-menu-text">Referral Commisions</span></a>
                    </li>
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
                        
                        <div class="user-name dropdown-indicator">Henry Beth
                        </div>
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1 is-light">
                    <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                      <div class="user-card">
                        <div class="user-avatar">
                          <span>AB</span>
                        </div>
                        <div class="user-info">
                          <span class="lead-text">Henry Beth</span>
                          <span class="sub-text">joshdjosh6@gmail.com</span>
                        </div>
                        <div class="user-action">
                          <a class="btn btn-icon mr-n2" href="https://primevests.com/account/user/profile-setting"><em
                              class="icon ni ni-setting"></em></a>
                        </div>
                      </div>
                    </div>
                    <div class="dropdown-inner user-account-info">
                      <h6 class="overline-title-alt">Interest Balance</h6>
                      <div class="user-balance">0.00 <small
                          class="currency currency-usd">GBP</small></div>
                      <div class="user-balance-sub">
                        Locked <span>0.00
                          <span class="currency currency-usd">GBP</span></span>
                      </div>
                      <a href="https://primevests.com/account/user/withdraw" class="link">
                        <span>Withdraw Balance</span> <em class="icon ni ni-wallet-out"></em>
                      </a>
                    </div>
                    <div class="dropdown-inner">
                      <ul class="link-list">

                        <li>
                          <a href="https://primevests.com/account/user/profile-setting">
                            <em class="icon ni ni-user-alt"></em>Profile Setting                          </a>
                        </li>
                                                <li>
                          <a href="https://primevests.com/account/user/change-password">
                            <em class="icon ni ni-lock"></em>Change Password                          </a>
                        </li>
                        <li>
                          <a href="https://primevests.com/account/ticket">
                            <em class="icon ni ni-info"></em>Support Ticket                          </a>
                        </li>
                        <li>
                          <a href="https://primevests.com/account/user/promotional-tool">
                            <em class="icon ni ni-gift"></em>Promotional Tool                          </a>
                        </li>
                        <li>
                          <a href="https://primevests.com/account/user/twofactor">
                            <em class="icon ni ni-lock"></em>2FA Security                          </a>
                        </li>

                        <li>
                          <a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a>
                        </li>
                      </ul>
                    </div>
                    <div class="dropdown-inner">
                      <ul class="link-list">
                        <li>
                          <a href="https://primevests.com/account/logout">
                            <em class="icon ni ni-signout"></em><span>Sign Out</span>
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
          <div class="nk-block-head text-center">
            <div class="nk-block-head-content">
              <div class="nk-block-head-content">
                <!DOCTYPE html>
<html>
<head>
    <title>Payment Preview</title>
</head>
<body>
    <h2 class="nk-block-title fw-normal">Payment Preview</h2>
<div class="nk-block-des">
<p>Review deposit details.</p>
</div>
</div>
</div>
</div><!-- nk-block -->
<div class="nk-block">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <ul class="list-group text-center">
                        <li class="list-group-item p-prev-list">
                            <img src="https://primevests.com/account/assets/images/gateway/61db059bcbe401641743771.png" />
                        </li>
                        <p class="list-group-item">
                            Amount:
                            <strong><?php echo isset($depositAmount) ? $depositAmount : ''; ?></strong> GBP
                        </p>
                        <p class="list-group-item">
                            Charge:
                            <strong>0</strong> GBP
                        </p>
                        <p class="list-group-item">
                            Payable: <strong><?php echo isset($depositAmount) ? $depositAmount : ''; ?></strong> GBP
                        </p>
                        <p class="list-group-item">
                            Conversion Rate: <strong>1 GBP = 1 £</strong>
                        </p>
                        <p class="list-group-item">
                            In £:
                            <strong><?php echo isset($depositAmount) ? $depositAmount : ''; ?></strong>
                        </p>
                    </ul>
                    <a href="manual.php" class="btn btn-block py-3 font-weight-bold mt-4 btn-primary">Confirm</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>





          </div>
        </div>
      </div>
    </div>
  </div>

      

      
      <!-- footer @s  -->
      <div class="nk-footer nk-footer-fluid bg-lighter">
        <div class="container-xl wide-lg">
          <div class="nk-footer-wrap">
            <div class="nk-footer-copyright">
              © 2023 <a href="https://primevests.com/account">Primevests</a>. All rights reserved            </div>
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
  

  <script src="https://primevests.com/account/assets/templates/dashlite//js/bundle.js?ver=2.4.0"></script>
  <script src="https://primevests.com/account/assets/templates/dashlite//js/scripts.js?ver=2.4.0"></script>
  <script src="https://primevests.com/account/assets/templates/dashlite//js/charts/chart-invest.js?ver=2.4.0"></script>


  <link rel="stylesheet" href="https://primevests.com/account/assets/templates/dashlite/css/iziToast.min.css">
<script src="https://primevests.com/account/assets/templates/dashlite/js/iziToast.min.js"></script>


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
    (function() {
      "use strict";
      $(document).on("change", ".langSel", function() {
        window.location.href = "https://primevests.com/account/change/" + $(this).val();
      });
    })();
  </script>

</body>

</html>
