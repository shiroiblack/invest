<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page or show an error message
    header('Location: account/login');
    exit();
}

// Check if the required session variables are set
if (!isset($_SESSION['gateway_title']) || !isset($_SESSION['pending_deposit_amount']) || !isset($_SESSION['transaction_id'])) {
    // If the required session variables are not set, redirect to deposit.php with a popup message
    echo '<script>alert("Session has expired. Please resubmit your request."); window.location.href = "deposit";</script>';
    exit();
}

$gatewayTitle = $_SESSION['gateway_title'];
$pendingDepositAmount = $_SESSION['pending_deposit_amount'];
$transactionID = $_SESSION['transaction_id'];

// Get the email and username from the session
$email = $_SESSION['email'];
$username = $_SESSION['username'];

// Wallet addresses for different gateways
$walletAddresses = [
    'Bitcoin' => 'bc1qs5ujzppp63hp589gpyg4kqyafvlg9n637kvc0a', // Replace with your actual Bitcoin wallet address
    'Ethereum' => '0xc4De92d80a4a6217cfDE8fD5bBCEA02B2cBAdA54', // Replace with your actual Ethereum wallet address
    'USDT(TRC20)' => 'TYjj1Y4BD5r8KHxTs5zzVo7BZ1kDRMf8V6', // Replace with your actual USDT(TRC20) wallet address
    'Ripple' => 'COMING SOON, PLEASE CHOOSE ANOTHER GATEWAY!' // Replace with your actual Ripple wallet address
    // Add wallet addresses for other gateways here
];

// Get the wallet address for the selected gateway
$walletAddress = isset($walletAddresses[$gatewayTitle]) ? $walletAddresses[$gatewayTitle] : '';

// Process the action
if (isset($_POST['perform_action'])) {
    // Get the transaction hash from the form input
    $transactionHash = $_POST['transaction_hash'];

    // Validate transaction hash
    if (empty($transactionHash)) {
        echo '<script>alert("Please enter a transaction hash.");</script>';
    } else {
        // Send email notification to the user
        $subject = "Deposit Confirmation";
        $message = "Dear $username,\n\nWe are pleased to inform you that your deposit of $$pendingDepositAmount via $gatewayTitle is currently being processed and awaits approval from our administrative team. Transaction ID: $transactionID.\n\nThank you for choosing Trustvestpro as your investment partner! Your trust in our expertise and dedication is greatly appreciated.\n\nRest assured that your investment will receive meticulous attention and adhere to our rigorous investment strategies. Our seasoned professionals are committed to delivering strong returns and maximizing your investment's potential.\n\nIf you have any questions or require assistance, our dedicated support team is always available to help.\n\nWe sincerely thank you for choosing Trustvestpro. We consider it an honor to have you as a valued investor and look forward to a successful journey together.\n\nBest regards";

        $headers = "From: support@Trustvestpro.cc"; // Replace with your email address

        // Call the mail function to send the email
        mail($email, $subject, $message, $headers);

        // Redirect to history.php with session data and the transaction hash as URL parameters
        $redirectURL = "history";
        $redirectURL .= "?gateway_title=" . urlencode($gatewayTitle);
        $redirectURL .= "&pending_deposit_amount=" . urlencode($pendingDepositAmount);
        $redirectURL .= "&transaction_id=" . urlencode($transactionID);
        $redirectURL .= "&email=" . urlencode($email);
        $redirectURL .= "&username=" . urlencode($username);
        $redirectURL .= "&transaction_hash=" . urlencode($transactionHash);

        header("Location: $redirectURL");
        exit();
    }
}

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
?>














<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
  

  <script src="https://widgets.coinmarketcap.com/api/widget.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="HqgHOpVPjzK2gLEPOdOHNTsZEnfeUyKp7XpC678q">
  <title>Trustvestpro - Deposit</title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,Trustvestpro,investment">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Trustvestpro - Dashboard">
    
    <meta itemprop="name" content="Trustvestpro - Dashboard">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="63cc7c80269ff1674345600.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="SEEDGATE- Alternative Investment option">
    <meta property="og:description" content="Introducing the first marketplace for investing in real estate debt and metaverse properties. Now you can invest in the loans made to borrowers(real estate agencies), and as they pay back their loans, you make money.And also co-own properties in the metaverse and NFTs.">
    <meta property="og:image" content="63cc7c80269ff1674345600.png"/>
    <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:url" content="../account/dashboard">
    
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
                  <a href="deposit" class="nk-menu-link">
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
                          <span class="sub-text"><?php echo $_SESSION['email']."<br>"; ?></span>
                        </div>
                        <div class="user-action">
                          <a class="btn btn-icon mr-n2" href="../update_profile"><em
                              class="icon ni ni-setting"></em></a>
                        </div>
                      </div>
                    </div>
                    <div class="dropdown-inner user-account-info">
                      
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
                          <a href="../changepass">
                            <em class="icon ni ni-lock"></em>Change Password                          </a>
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
          <div class="nk-block-head text-center">
            <div class="nk-block-head-content">
              <div class="nk-block-head-content">
               <h2 class="nk-block-title fw-normal">Deposit Confirm</h2>
<div class="nk-block-des">
  <p>Choose your investment plan and start earning.</p>
</div>
</div>
</div>
</div><!-- nk-block -->
<div class="nk-block">

<div class="row mb-60-80 justify-content-center">
  <div class="col-md-8">
    <div class="card card-bordered">
      <div class="card-body">
       <form method="POST" action="">
    <input type="hidden" name="_token" value="CvSSyqa9DCQV2mOnssmkgof87FvbXYUPynGDasLU">
    <div class="row">
        <div class="col-md-12 text-center">
            <p class="text-center mt-2">You have requested <b class="text-success"><?php echo $pendingDepositAmount; ?> USD</b>, Please pay <b class="text-success">$<?php echo $pendingDepositAmount; ?></b> for successful payment</p>
            <div class="user-guide">
                <p><strong>Note:</strong> Please refer to the <a href="#" data-toggle="modal" data-target="#detailedGuideModal">Detailed guide</a> for each step.</p>
            </div>
        </div>
        <div class="nk-refwg-invite card-inner">
            <div class="nk-refwg-head g-3">
                <div class="nk-refwg-title">
                    <h5 class="title">Copy The Address Below</h5>
                    <div class="title-sub">Use the wallet address below to deposit or click on Moonpay to buy Crypto with Card.</div>
                </div>
                <div class="nk-refwg-action">
                    <a href="http://moonpay.com/" class="btn btn-primary">MoonPay</a>
                </div>
            </div>
            <div class="nk-refwg-url">
                <div class="form-control-wrap">
                    <div class="form-clip clipboard-init" data-clipboard-target="#refUrl" data-success="Copied" data-text="Copy Link">
                        <em class="clipboard-icon icon ni ni-copy"></em> <span class="clipboard-text">Copy Wallet Address</span>
                    </div>
                    <div class="form-icon">
                        <em class="icon ni ni-link-alt"></em>
                    </div>
                    <input type="text" class="form-control copy-text" id="refUrl" value="<?php echo $walletAddress; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label><strong>Transaction Hash <span class="text-danger">*</span></strong></label>
                <input type="text" class="form-control" name="transaction_hash" placeholder="Enter the transaction hash">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn cmn-btn btn-block mt-2 text-center btn-primary" name="perform_action">Perform Action</button>
            </div>
        </div>
    </div>
</form>

      </div>
    </div>
  </div>
</div>

<!-- Detailed Guide Modal -->
<div class="modal fade" id="detailedGuideModal" tabindex="-1" role="dialog" aria-labelledby="detailedGuideModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailedGuideModalLabel">Detailed Trustvestpro Guide</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ol>
          
            <ul>
              <li><strong>STEP 1</strong>. Locate the Company Wallet Address provided by the platform.</li>
              <li><strong>STEP 2</strong>. Highlight and copy the Company Wallet Address to your clipboard.</li>
            </ul>
          </li>
          <li><strong>STEP 3</strong>. Go to Your Wallet/Exchange:
            <ul>
              <li><strong>STEP 4</strong>. Open your preferred cryptocurrency wallet or exchange platform.</li>
              <li><strong>STEP 5</strong>. Ensure that you have sufficient funds available in your wallet or exchange account.</li>
            </ul>
          </li>
          <li><strong>STEP 6</strong>. Transfer the Exact Crypto Value Amount:
            <ul>
              <li><strong>STEP 7</strong>. Initiate a transfer or withdrawal transaction from your wallet or exchange account.</li>
              <li><strong>STEP 8</strong>. Enter the Company Wallet Address you copied in step 2 as the recipient of the transaction.</li>
              <li><strong>STEP 9</strong>. Specify the exact amount of cryptocurrency you wish to invest, ensuring it matches the chosen value.</li>
              <li><strong>STEP 10</strong>. Double-check the recipient address and the amount before confirming the transaction.</li>
            </ul>
          </li>
          
        </ol>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Link to open the Detailed Guide Modal -->





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
              © 2019 <a href="https://trustvestpro.cc">Trustvestpro</a>. All rights reserved            </div>
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
  

  <script src="bundle.js?"></script>
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
    (function() {
      "use strict";
      $(document).on("change", ".langSel", function() {
        window.location.href = "https://primevests.com/account/change/" + $(this).val();
      });
    })();
  </script>
<script>
        function redirectToHistory() {
            // Build the URL with session data as parameters
            var url = "history.php";
            url += "?gateway_title=<?php echo $gatewayTitle; ?>";
            url += "&pending_deposit_amount=<?php echo $pendingDepositAmount; ?>";
            url += "&transaction_id=<?php echo $transactionID; ?>";
            url += "&email=<?php echo $email; ?>";
            url += "&username=<?php echo $username; ?>";

            // Redirect to history.php with session data in URL parameters
            window.location.href = url;
        }
    </script>
<script src="//code.tidio.co/1pitlmh4lhqgfytpakerk7i3qt0liah2.js" async></script>
</body>

</html>
