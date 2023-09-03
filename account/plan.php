<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Check if the user is logged in
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Retrieve the logged-in username
$username = $_SESSION['username'];
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
    $money = $userData['money'];

    // Echo the username and email
   
    }

// Retrieve the deposit wallet balance from the 'total' column
$balanceQuery = "SELECT money FROM users WHERE username = '$username'";
$balanceResult = mysqli_query($connection, $balanceQuery);
if ($balanceResult && mysqli_num_rows($balanceResult) > 0) {
    $balanceRow = mysqli_fetch_assoc($balanceResult);
    $balanceInAccount = floatval($balanceRow['money']);
} else {
    $balanceInAccount = 0;
}
// Echo the deposit wallet balance


// Retrieve the interest wallet balance
$interestQuery = "SELECT interest_wallet_balance FROM users WHERE username = '$username'";
$interestResult = mysqli_query($connection, $interestQuery);
if ($interestResult && mysqli_num_rows($interestResult) > 0) {
    $interestRow = mysqli_fetch_assoc($interestResult);
    $interestWalletBalance = floatval($interestRow['interest_wallet_balance']);
} else {
    $interestWalletBalance = 0;
}

// Close the database connection
mysqli_close($connection);


// Logout functionality
if (isset($_POST['logout'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page
    header('Location:login');
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
   
<div id="google_translate_element"></div> 
      <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ar,de,es,fr,it,ja,ko,ru,zh-CN,zh-TW', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
  }
</script>
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
    <meta property="og:url" content="../../dashboard">
    
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
                  <a href="../account/user/withdraw"  class="nk-menu-link">
                    <span class="nk-menu-text">Withdraw</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="user/deposit/deposit" class="nk-menu-link">
                    <span class="nk-menu-text">Deposit</span>
                  </a>
                </li><!-- .nk-menu-item -->
                
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
                      <div class="user-card">
                        
                        <div class="user-info">
                          <span class="lead-text"><?php echo $username; ?></span>
                          <span class="sub-text"><?php echo $email; ?></span>
                        </div>
                        <div class="user-action">
                          <a class="btn btn-icon mr-n2" href="update_profile"><em
                              class="icon ni ni-setting"></em></a>
                        </div>
                      </div>
                    </div>
                    <div class="dropdown-inner user-account-info">
                      <h6 class="overline-title-alt">Balance in Account</h6>
                      <div class="user-balance">$<?php echo $money; ?> <small
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
                          <a href="../user/kyc_verification.php">
                            <em class="icon ni ni-user-alt"></em>kyc                         </a>
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
              <div class="nk-block-head-sub"><span>Choose an Option</span></div>
              <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">Investment Plan</h2>
                <div class="nk-block-des">
                  <p>Choose your investment plan and start earning.</p>
                </div>
              </div>
            </div>
          </div><!-- nk-block -->
          <div class="nk-block">

            <div class="plan-iv-list nk-slider nk-slider-s2">
              <ul class="plan-list slider-init"
                data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "infinite":false, "responsive":[{"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}} ]}'>

                                                    <li class="plan-item">
                    <input type="radio" id="plan-iv-0" name="plan-iv" class="plan-control">
                    <div class="plan-item-card">
                      <div class="plan-item-head">
                        <div class="plan-item-heading">
                          <h4 class="plan-item-title card-title title">Starter</h4>
</div>
<div class="plan-item-summary card-text">
  <div class="row">
    <div class="col-6">
      <span class="lead-text">3.0%</span>
      <span class="sub-text">Every Day</span>
    </div>
    <div class="col-6">
      <span class="lead-text">5</span>
      <span class="sub-text">Day(s)</span>
    </div>
  </div>
</div>
</div>
<div class="plan-item-body">
  <div class="plan-item-desc card-text">
    <ul class="plan-item-desc-list">
      <li><span class="desc-label">Min Investment</span> - <span class="desc-data">$50</span></li>
      <li><span class="desc-label">Max Investment</span> - <span class="desc-data">$3,000</span></li>
      <li><span class="desc-label">Capital Return</span> - <span class="desc-data">5 days</span></li>
      <li><span class="desc-label">Total Return</span> - <span class="desc-data">15%</span></li>
    </ul>
    <div class="plan-item-action">
      <label for="plan-iv-0" class="plan-label">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#depoModal" data-plan-id="1" class="cmn-btn btn-md mt-4 investButton">Choose this plan</a>
      </label>
    </div>
  </div>
</div>
</div>
</li><!-- .plan-item -->

                                                    <li class="plan-item">
                    <input type="radio" id="plan-iv-1" name="plan-iv" class="plan-control">
                    <div class="plan-item-card">
                      <div class="plan-item-head">
                        <div class="plan-item-heading">
                          <h4 class="plan-item-title card-title title">Orbit</h4>
</div>
<div class="plan-item-summary card-text">
  <div class="row">
    <div class="col-6">
      <span class="lead-text">3.5%</span>
      <span class="sub-text">Every Day</span>
    </div>
    <div class="col-6">
      <span class="lead-text">5</span>
      <span class="sub-text">Day(s)</span>
    </div>
  </div>
</div>
</div>
<div class="plan-item-body">
  <div class="plan-item-desc card-text">
    <ul class="plan-item-desc-list">
      <li><span class="desc-label">Min Investment</span> - <span class="desc-data">$3,000</span></li>
      <li><span class="desc-label">Max Investment</span> - <span class="desc-data">$10,000</span></li>
      <li><span class="desc-label">Capital Return</span> - <span class="desc-data">5 days</span></li>
      <li><span class="desc-label">Total Return</span> - <span class="desc-data">17.5%</span></li>
    </ul>
    <div class="plan-item-action">
      <label for="plan-iv-1" class="plan-label">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#depoModal" data-plan-id="2" class="cmn-btn btn-md mt-4 investButton">Choose this plan</a>
      </label>
    </div>
  </div>
</div>
</div>
</li><!-- .plan-item -->

                                                    <li class="plan-item">
                    <input type="radio" id="plan-iv-2" name="plan-iv" class="plan-control">
                    <div class="plan-item-card">
                      <div class="plan-item-head">
                        <div class="plan-item-heading">
                          <h4 class="plan-item-title card-title title">Diamond</h4>
</div>
<div class="plan-item-summary card-text">
  <div class="row">
    <div class="col-6">
      <span class="lead-text">4.0%</span>
      <span class="sub-text">Every Day</span>
    </div>
    <div class="col-6">
      <span class="lead-text">5</span>
      <span class="sub-text">Day(s)</span>
    </div>
  </div>
</div>
</div>
<div class="plan-item-body">
  <div class="plan-item-desc card-text">
    <ul class="plan-item-desc-list">
      <li><span class="desc-label">Min Investment</span> - <span class="desc-data">$10,000</span></li>
      <li><span class="desc-label">Max Investment</span> - <span class="desc-data">$20,000</span></li>
      <li><span class="desc-label">Capital Return</span> - <span class="desc-data">5 days</span></li>
      <li><span class="desc-label">Total Return</span> - <span class="desc-data">20%</span></li>
    </ul>
    <div class="plan-item-action">
      <label for="plan-iv-2" class="plan-label">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#depoModal" data-plan-id="3" class="cmn-btn btn-md mt-4 investButton">Choose this plan</a>
      </label>
    </div>
  </div>
</div>
</div>
</li>
<!-- .plan-item -->

                                                    <li class="plan-item">
                    <input type="radio" id="plan-iv-3" name="plan-iv" class="plan-control">
                    <div class="plan-item-card">
                      <div class="plan-item-head">
                        <div class="plan-item-heading">
                          <h4 class="plan-item-title card-title title">Premium</h4>
</div>
<div class="plan-item-summary card-text">
  <div class="row">
    <div class="col-6">
      <span class="lead-text">4%</span>
      <span class="sub-text">Every Day</span>
    </div>
    <div class="col-6">
      <span class="lead-text">5</span>
      <span class="sub-text">Day(s)</span>
    </div>
  </div>
</div>
</div>
<div class="plan-item-body">
  <div class="plan-item-desc card-text">
    <ul class="plan-item-desc-list">
      <li><span class="desc-label">Min Investment</span> - <span class="desc-data">$20,000</span></li>
      <li><span class="desc-label">Max Investment</span> - <span class="desc-data">$35,000</span></li>
      <li><span class="desc-label">Capital Return</span> - <span class="desc-data">5 days</span></li>
      <li><span class="desc-label">Total Return</span> - <span class="desc-data">25%</span></li>
    </ul>
    <div class="plan-item-action">
      <label for="plan-iv-3" class="plan-label">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#depoModal" data-plan-id="4" class="cmn-btn btn-md mt-4 investButton">Choose this plan</a>
      </label>
    </div>
  </div>
</div>
</div>
</li>
<!-- .plan-item -->

                                                    <li class="plan-item">
                    <input type="radio" id="plan-iv-4" name="plan-iv" class="plan-control">
                    <div class="plan-item-card">
                      <div class="plan-item-head">
                        <div class="plan-item-heading">
                          <h4 class="plan-item-title card-title title">Retirement</h4>
</div>
<div class="plan-item-summary card-text">
  <div class="row">
    <div class="col-6">
      <span class="lead-text">10%</span>
      <span class="sub-text">Every Day</span>
    </div>
    <div class="col-6">
      <span class="lead-text">5</span>
      <span class="sub-text">Day(s)</span>
    </div>
  </div>
</div>
</div>
<div class="plan-item-body">
  <div class="plan-item-desc card-text">
    <ul class="plan-item-desc-list">
      <li><span class="desc-label">Min Investment</span> - <span class="desc-data">$10,000</span></li>
      <li><span class="desc-label">Max Investment</span> - <span class="desc-data">$50,000</span></li>
      <li><span class="desc-label">Capital Return</span> - <span class="desc-data">5 days</span></li>
      <li><span class="desc-label">Total Return</span> - <span class="desc-data">50%</span></li>
    </ul>
    <div class="plan-item-action">
      <label for="plan-iv-4" class="plan-label">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#depoModal" data-plan-id="5" class="cmn-btn btn-md mt-4 investButton">Choose this plan</a>
      </label>
    </div>
  </div>
</div>
</div>
</li>
<!-- .plan-item -->

                
              </ul><!-- .plan-list -->
            </div>
            
          </div><!-- nk-block -->
        </div>
      </div>
    </div>
  </div>





  



  
      
   <!-- Modal -->
<div class="modal fade" id="depoModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-content-bg">
      <div class="modal-header">
        <strong class="modal-title text-white" id="ModalLabel">
          Confirm to invest on <span class="planName"></span>
        </strong>
        <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
    <form action="process_investment" method="post" class="register" onsubmit="return validateInvestmentAmount()">
    <input type="hidden" name="_token" value="kZohTDwwYA1lmMIe5eiMoGH61XLydEMj2Lxtb2B6">
    <input type="hidden" name="plan_id" id="plan_id_input">
    <div class="modal-body">
        <div class="form-group">
            <h6 class="text-center investAmountRange"></h6>
            <p class="text-center mt-1 interestDetails"></p>
            <p class="text-center interestValidity"></p>
        </div>
        <div class="form-group">
            <strong class="text-white mb-2 d-block">Select wallet</strong>
            <select class="form-control" name="wallet_type">
                <option value="deposit_wallet">Deposit Wallet - $<?php echo $balanceInAccount; ?></option>
                <option value="interest_wallet">Interest Wallet - $<?php echo $interestWalletBalance; ?></option>
                <option value="checkout">Checkout</option>
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="investAmount" name="amount" value="" onkeyup="this.value = this.value.replace(/^\.|[^\d\.]/g, '')" placeholder="Invest Amount" autocomplete="off">
            <span id="amountError" class="text-danger"></span>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        <button type="submit" class="btn cmn-btn btn-primary">Yes</button>
    </div>
</form>
    </div>
  </div>
</div>
  

      
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
<script src="iziToast.min.js"></script>


        <script>
        "use strict";
                iziToast.error({
            message: 'Please choose a plan.',
            position: "topRight"
        });
            </script>
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
    (function($) {
      "use strict";
      $(document).on('click', '.investButton', function() {
        var data = $(this).data('resource');
        var symbol = "$";
        var currency = "USD";

        $('#mySelect').empty();

        if (data.fixed_amount == '0') {
          $('.investAmountRenge').text(`invest: ${symbol}${data.minimum} - ${symbol}${data.maximum}`);
          $('.fixedAmount').val('');
          $('#fixedAmount').attr('readonly', false);


        } else {
          $('.investAmountRenge').text(`invest: ${symbol}${data.fixed_amount}`);
          $('.fixedAmount').val(data.fixed_amount);
          $('#fixedAmount').attr('readonly', true);

        }

        if (data.interest_status == '1') {
          $('.interestDetails').html(`<strong> Interest: ${data.interest} % </strong>`);
        } else {
          $('.interestDetails').html(`<strong> Interest: ${data.interest} ${currency}  </strong>`);
        }
        if (data.lifetime_status == '0') {
          $('.interestValidaty').html(
            `<strong>  per ${data.times} hours ,  ${data.repeat_time} times</strong>`);
        } else {
          $('.interestValidaty').html(
            `<strong>  per ${data.times} hours,  life time </strong>`);
        }

        $('.planName').text(data.name);
        $('.plan_id').val(data.id);
      });



    })(jQuery);
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
  document.addEventListener("DOMContentLoaded", function() {
    var investButtons = document.getElementsByClassName("investButton");
    var planIdInput = document.getElementById("plan_id_input");

    for (var i = 0; i < investButtons.length; i++) {
      investButtons[i].addEventListener("click", function() {
        var planId = this.getAttribute("data-plan-id");
        planIdInput.value = planId;
      });
    }
  });
</script>
<script>
    // Update the investAmountRange, interestDetails, and interestValidity based on the selected plan
    function updateInvestmentDetails(planId) {
        var plan = <?php echo json_encode($plans); ?>;
        if (planId in plan) {
            var selectedPlan = plan[planId];
            var minAmount = selectedPlan['min_amount'];
            var maxAmount = selectedPlan['max_amount'];
            var interestRate = selectedPlan['interest_rate'];
            var investmentDuration = selectedPlan['investment_duration'];

            document.querySelector('.investAmountRange').textContent = 'Investment Range: $' + minAmount + ' - $' + maxAmount;
            document.querySelector('.interestDetails').textContent = 'Interest Rate: ' + interestRate + '% per day';
            document.querySelector('.interestValidity').textContent = 'Investment Duration: ' + investmentDuration + ' days';
        } else {
            document.querySelector('.investAmountRange').textContent = '';
            document.querySelector('.interestDetails').textContent = '';
            document.querySelector('.interestValidity').textContent = '';
        }
    }

    // Update the plan_id_input value when a plan is selected
    document.addEventListener('change', function(event) {
        if (event.target.name === 'plan_id') {
            var planId = event.target.value;
            document.getElementById('plan_id_input').value = planId;
            updateInvestmentDetails(planId);
        }
    });
</script>
<script>
    // Update the investAmountRange, interestDetails, and interestValidity based on the selected plan
    function updateInvestmentDetails(planId) {
        var plan = <?php echo json_encode($plans); ?>;
        if (planId in plan) {
            var selectedPlan = plan[planId];
            var minAmount = selectedPlan['min_amount'];
            var maxAmount = selectedPlan['max_amount'];
            var interestRate = selectedPlan['interest_rate'];
            var investmentDuration = selectedPlan['investment_duration'];

            document.querySelector('.investAmountRange').textContent = 'Investment Range: $' + minAmount + ' - $' + maxAmount;
            document.querySelector('.interestDetails').textContent = 'Interest Rate: ' + interestRate + '% per day';
            document.querySelector('.interestValidity').textContent = 'Investment Duration: ' + investmentDuration + ' days';
        } else {
            document.querySelector('.investAmountRange').textContent = '';
            document.querySelector('.interestDetails').textContent = '';
            document.querySelector('.interestValidity').textContent = '';
        }
    }

    // Update the plan_id_input value when a plan is selected
    document.addEventListener('change', function(event) {
        if (event.target.name === 'plan_id') {
            var planId = event.target.value;
            document.getElementById('plan_id_input').value = planId;
            updateInvestmentDetails(planId);
        }
    });

    // Validate the investment amount
    function validateInvestmentAmount() {
        var investAmount = parseFloat(document.getElementById('investAmount').value);
        var minAmount = parseFloat(<?php echo $minAmount; ?>);
        var maxAmount = parseFloat(<?php echo $maxAmount; ?>);
        var errorSpan = document.getElementById('amountError');

        if (isNaN(investAmount) || investAmount < minAmount || investAmount > maxAmount) {
            errorSpan.textContent = 'Amount must be between $' + minAmount + ' and $' + maxAmount + '.';
            return false; // Prevent form submission
        } else {
            errorSpan.textContent = '';
            return true; // Allow form submission
        }
    }
</script>

Success!
<script src="//code.tidio.co/1pitlmh4lhqgfytpakerk7i3qt0liah2.js" async></script>
</body>

</html>
