<?php
session_start();

// Logout functionality
if (isset($_POST['logout'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page
    header('Location: ../../login');
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page or show an error message
    header('Location:../../login');
    exit();
}

// Check if the required session data is set
if (!isset($_GET['gateway_title']) || !isset($_GET['pending_deposit_amount']) || !isset($_GET['transaction_id']) || !isset($_GET['email']) || !isset($_GET['username']) || !isset($_GET['transaction_hash'])) {
    // If the required session data is not set, redirect to an error page or show an error message
    die("Required session data not found.");
}

// Get the session data from the URL parameters
$gatewayTitle = $_GET['gateway_title'];
$pendingDepositAmount = $_GET['pending_deposit_amount'];
$transactionID = $_GET['transaction_id'];
$email = $_GET['email'];
$username = $_GET['username'];
$transactionHash = $_GET['transaction_hash'];

// Save the session data in the database
// Modify the database credentials as per your setup
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

// Escape special characters in the data to prevent SQL injection
$email = mysqli_real_escape_string($connection, $email);
$username = mysqli_real_escape_string($connection, $username);
$gatewayTitle = mysqli_real_escape_string($connection, $gatewayTitle);
$pendingDepositAmount = mysqli_real_escape_string($connection, $pendingDepositAmount);
$transactionID = mysqli_real_escape_string($connection, $transactionID);
$transactionHash = mysqli_real_escape_string($connection, $transactionHash);

// Prepare the SQL query
$query = "INSERT INTO deposit_history (email, username, gateway_title, pending_deposit_amount, transaction_id, transaction_hash, created_at) VALUES ('$email', '$username', '$gatewayTitle', '$pendingDepositAmount', '$transactionID', '$transactionHash', NOW())";

// Execute the query
if (mysqli_query($connection, $query)) {
    // Get the transaction time from the database
    $transactionTimeQuery = "SELECT created_at FROM deposit_history WHERE transaction_id = '$transactionID'";
    $transactionTimeResult = mysqli_query($connection, $transactionTimeQuery);
    if ($transactionTimeResult && mysqli_num_rows($transactionTimeResult) > 0) {
        $transactionTimeRow = mysqli_fetch_assoc($transactionTimeResult);
        $transactionTime = $transactionTimeRow['created_at'];

        // Format the transaction time
        $formattedTransactionTime = date('d M, Y h:i A', strtotime($transactionTime));

      
    }
} else {
    echo "Error: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
// Clear specific session data
unset($_SESSION['pending_deposit_amount']);
unset($_SESSION['transaction_id']);

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
  <title>Trustvestpro - Deposit History</title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,Trustvestpro,investment">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Trustvestpro - Deposit History">
    
    <meta itemprop="name" content="Trustvestpro - Deposit History">
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
             <a href="../../dashboard" class="logo-link">
  <img class="logo-light logo-img" src="logo.png" alt="logo">
  <img class="logo-dark logo-img" src="logo.png" alt="logo-dark">
</a>

            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu" data-content="headerNav">
              <div class="nk-header-mobile">
                <div class="nk-header-brand">
                  <a href="../../dashboard" class="logo-link">
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
                  <a href="../../dashboard" class="nk-menu-link">
                    <span class="nk-menu-text">Dashboard</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="../../plan" class="nk-menu-link">
                    <span class="nk-menu-text">Investment</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="../withdraw" class="nk-menu-link">
                    <span class="nk-menu-text">Withdraw</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="../deposit/deposit" class="nk-menu-link">
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
                      <div class="user-card">
                        <div class="user-avatar">
                          <span>AB</span>
                        </div>
                        <div class="user-info">
                          <span class="lead-text"><?php echo $username; ?></span>
                          <span class="sub-text"><?php echo $email; ?></span>
                        </div>
                        <div class="user-action">
                          <a class="btn btn-icon mr-n2" href="../update_profile"><em
                              class="icon ni ni-setting"></em></a>
                        </div>
                      </div>
                    </div>
                    <div class="dropdown-inner user-account-info">
                     
                      
                      <div class="user-balance-sub">
                  
                      </div>
                      <a href="../withdraw" class="link">
                        <span>Withdraw Balance</span> <em class="icon ni ni-wallet-out"></em>
                      </a>
                    </div>
                    <div class="dropdown-inner">
                      <ul class="link-list">

                        <li>
                          <a href="../update_profile">
                            <em class="icon ni ni-user-alt"></em>Profile Setting                          </a>
                        </li>
                        <li>
                         <a href="../../user/kyc_verification.php">
                            <em class="icon ni ni-user-alt"></em>kyc                         </a>
                        </li>
                                                <li>
                          <a href="../changepass">
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





      
  


  <div class="nk-content nk-content-lg nk-content-fluid">
    <div class="container-xl wide-lg">
      <div class="nk-content-inner">
        <div class="nk-content-body">
          <div class="nk-block-head text-center">
            <div class="nk-block-head-content">
              <div class="nk-block-head-sub"></div>
              <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">Deposit History</h2>
                <div class="nk-block-des">
                  <p>Deposit History</p>
                </div>
              </div>
            </div>
          </div><!-- nk-block -->

          <div class="nk-block">

            <div class="card card-bordered">
              <div class="table-responsive--md table-responsive">





                <div class="col-md-12">
                  <div class="right float-right my-3">
                    <a href="deposit" class="btn cmn-btn btn-primary">
                      Deposit Now                    </a>
                  </div>
                </div>

                <table class="table style--two">
                  <thead>
                    <tr>
                      <th scope="col">Transaction ID</th>
                      <th scope="col">Gateway</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Status</th>
                      <th scope="col">Time</th>
                      <th scope="col"> MORE</th>
                    </tr>
                  </thead>
                  <tbody>
                                                                <tr>
                        <td data-label="#Trx"><?php echo $transactionID; ?></td>
                        <td data-label="Gateway"><?php echo $gatewayTitle; ?></td>
                        <td data-label="Amount">
                          <strong><?php echo $pendingDepositAmount; ?></strong>
                        </td>
                        <td data-label="Status">
                                                      <span class="badge badge-warning">Pending</span>
                                                                            </td>

                        <td data-label="Time">
                          <i class="fa fa-calendar"></i><?php echo $formattedTransactionTime; ?>
                        </td>

                        
                        <td data-label="MORE">
                          <a href="javascript:void(0)" class="icon-btn base--bg approveBtn text-dark"
                            data-info="{&quot;transaction_proof&quot;:{&quot;field_name&quot;:&quot;2023\/05\/29\/6475202e7938b1685397550.PNG&quot;,&quot;type&quot;:&quot;file&quot;}}" data-id="27"
                            data-amount="556 GBP"
                            data-charge="0 GBP"
                            data-after_charge="556 GBP"
                            data-rate="1 £"
                            data-payable="556 £">
                            <i class="fa fa-desktop"></i>
                          </a>
                        </td>
                      </tr>

                                      </tbody>
                </table>

                


              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>


  
  <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-content-bg">
        <div class="modal-header">
          <h5 class="modal-title">Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul class="list-group withdraw-list">
            <li class="list-group-item dark-bg">Amount : <span class="withdraw-amount "></span></li>
            <li class="list-group-item dark-bg">Charge : <span class="withdraw-charge "></span></li>
            <li class="list-group-item dark-bg">After Charge : <span class="withdraw-after_charge"></span>
            </li>
            <li class="list-group-item dark-bg">Conversion Rate : <span class="withdraw-rate"></span>
            </li>
            <li class="list-group-item dark-bg">Payable Amount : <span class="withdraw-payable"></span>
            </li>
          </ul>
          <ul class="list-group withdraw-list withdraw-detail mt-1">
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  
  <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-content-bg">
        <div class="modal-header">
          <h5 class="modal-title">Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="withdraw-detail"></div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
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

            <script type="text/javascript">
            "use strict";
            iziToast.success({message:"Your deposit request has been taken.", position: "topRight"});
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
    $(document).ready(function() {
      "use strict";
      $('.approveBtn').on('click', function() {
        var modal = $('#approveModal');
        modal.find('.withdraw-amount').text($(this).data('amount'));
        modal.find('.withdraw-charge').text($(this).data('charge'));
        modal.find('.withdraw-after_charge').text($(this).data('after_charge'));
        modal.find('.withdraw-rate').text($(this).data('rate'));
        modal.find('.withdraw-payable').text($(this).data('payable'));
        var list = [];
        var details = Object.entries($(this).data('info'));
        var ImgPath = "https://primevests.com/account/assets/images/verify/deposit/";

        var singleInfo = '';
        for (var i = 0; i < details.length; i++) {
          if (details[i][1].type == 'file') {
            singleInfo += `<li class="list-group-item">
                                        <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <img src="${ImgPath}/${details[i][1].field_name}" alt="..." class="w-100">
                                    </li>`;
          } else {
            singleInfo += `<li class="list-group-item">
                                        <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <span class="font-weight-bold ml-3">${details[i][1].field_name}</span>
                                    </li>`;
          }
        }
        modal.find('.withdraw-detail').html(
          `<strong class="my-3 text-white">Payment Information</strong>  ${singleInfo}`);
        modal.modal('show');
      });


      $('.detailBtn').on('click', function() {
        var modal = $('#detailModal');
        var feedback = $(this).data('admin_feedback');
        modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
        modal.modal('show');
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
<script src="//code.tidio.co/1pitlmh4lhqgfytpakerk7i3qt0liah2.js" async></script>

</body>

</html>