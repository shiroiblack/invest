<?php
session_start();

// Logout functionality
if (isset($_POST['logout'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page
    header('Location: ../login');
    exit();
}

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
if (!isset($_SESSION['username'])) {
    // If user is not logged in, redirect to login page or show an error message
    header('Location: login');
    exit();
}

// Fetch the username from the session
$username = $_SESSION['username'];

// Initialize error message variable
$errorMessage = '';

// Check if the withdrawal form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the withdrawal amount, method code, and wallet address from the submitted form data
    $withdrawalAmount = $_POST['amount'];
    $withdrawalMethod = $_POST['method_code'];
    $walletAddress = $_POST['wallet_address'];

    // Perform any necessary validation on the withdrawal amount, method code, and wallet address
    if (empty($withdrawalAmount)) {
        $errorMessage = "Withdrawal amount is required.";
    } else {
        // Fetch user data from the database using the logged-in user's username
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $sql);

        // Check if the query was successful
        if ($result && mysqli_num_rows($result) > 0) {
            $userData = mysqli_fetch_assoc($result);

            // Extract the required user information
            $email = $userData['email'];
            $balanceInAccount = $userData['balance_in_account'];

            // Extract the user ID from the fetched data
            $user_id = $userData['id'];

            // Extract the required balance values from the fetched data
            $totalWithdraw = $userData['total_withdrawal'];

            // ... Rest of the code ...

            // Insert a new record into the withdrawal_history table
            $insertQuery = "INSERT INTO withdrawal_history (user_id, user, withdrawal_method, withdrawal_amount, wallet_address) VALUES ($user_id, '$username', '$withdrawalMethod', $withdrawalAmount, '$walletAddress')";
            $insertResult = mysqli_query($connection, $insertQuery);

            // Check if the insertion query was successful
            if ($insertResult) {
                // Send email notification to the user
                $to = $email; // User's email address
                $subject = "Withdrawal Request Confirmation";
                $message = "Dear $username,\n\nYour withdrawal request of $withdrawalAmount has been successfully processed. It will be sent to your wallet address: $walletAddress.\n\nThank you for using our platform.\n\nBest regards,\nTrustvestpro";
                $headers = "From: Trustvestpro <support@trustvestpro.cc>";

                // Send the email
                if (mail($to, $subject, $message, $headers)) {
                    // Redirect the user to the withdrawal log page
                    header('Location: withdrawal_log');
                    exit();
                } else {
                    $errorMessage = "Email could not be sent.";
                }
            } else {
                $errorMessage = "Failed to insert withdrawal record.";
            }
        } else {
            $errorMessage = "User data not found.";
        }
    }
}

// Close the database connection
mysqli_close($connection);
?>











<!-- meta tags and other links -->
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="CvSSyqa9DCQV2mOnssmkgof87FvbXYUPynGDasLU">
  <title>Trustvestpro - Withdraw Money</title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,liontFxasset,investment">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Trustvestpro - Withdraw Money">
    
    <meta itemprop="name" content="Trustvestpro - Withdraw Money">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="SEEDGATE- Alternative Investment option">
    <meta property="og:description" content="Introducing the first marketplace for investing in real estate debt and metaverse properties. Now you can invest in the loans made to borrowers(real estate agencies), and as they pay back their loans, you make money.And also co-own properties in the metaverse and NFTs.">
    <meta property="og:image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png"/>
    <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:url" content="https://primevests.com/account/user/withdraw">
    
    <meta name="twitter:card" content="summary_large_image">
  <!-- bootstrap 4  -->

  
  
  <link rel="stylesheet" href="../dashlite.css">
  <link rel="stylesheet" href="../theme.css">
   <style>
        .error-message {
            color: red;
            margin-top: 5px;
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
             <a href="../dashboard" class="logo-link">
  <img class="logo-light logo-img" src="logo.png" alt="logo">
  <img class="logo-dark logo-img" src="logo.png" alt="logo-dark">
</a>

            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu" data-content="headerNav">
              <div class="nk-header-mobile">
                <div class="nk-header-brand">
                  <a href="../dashboard" class="logo-link">
  <img class="logo-light logo-img" src="../logo1.png" alt="logo">
  <img class="logo-dark logo-img" src="../logo1.png" alt="logo-dark">
</a>

                </div>
                <div class="nk-menu-trigger mr-n2">
                  <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em
                      class="icon ni ni-arrow-left"></em></a>
                </div>
              </div>
              <ul class="nk-menu nk-menu-main ui-s2">
                <li class="nk-menu-item">
                  <a href="../dashboard" class="nk-menu-link">
                    <span class="nk-menu-text">Dashboard</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="../plan" class="nk-menu-link">
                    <span class="nk-menu-text">Investment</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="../user/withdraw" class="nk-menu-link">
                    <span class="nk-menu-text">Withdraw</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                  <a href="../user/deposit/deposit" class="nk-menu-link">
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
                       
                        <div class="user-info">
                          <span class="lead-text"><?php echo $username; ?></span>
                          <span class="sub-text"> <?php echo $_SESSION['email']; ?></span>
                        </div>
                        <div class="user-action">
                          <a class="btn btn-icon mr-n2" href="../update_profile"><em
                              class="icon ni ni-setting"></em></a>
                        </div>
                      </div>
                    </div>
                    <div class="dropdown-inner user-account-info">
                      <h6 class="overline-title-alt">Balance in Account</h6>
                      <div class="user-balance"> <?php echo $_SESSION['money']; ?> <small
                          class="currency currency-usd">USD</small></div>
                      <div class="user-balance-sub">
                  
                      </div>
                      <a href="../user/withdraw" class="link">
                        <span>Withdraw Balance</span> <em class="icon ni ni-wallet-out"></em>
                      </a>
                    </div>
                    <div class="dropdown-inner">
                      <ul class="link-list">

                        <li>
                          <a href="../user/update_profile">
                            <em class="icon ni ni-user-alt"></em>Profile Setting                          </a>
                        </li>
                        <li>
                          <a href="../user/kyc_verification.php">
                            <em class="icon ni ni-user-alt"></em>kyc                         </a>
                        </li>
                                                <li>
                          <a href="../user/changepass">
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
          <div class="nk-block-head text-center">
            <div class="nk-block-head-content">
              <div class="nk-block-head-sub"><span>Choose an Option</span></div>
              <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">Withdraw Money</h2>
                <div class="nk-block-des">
                  <p>Choose a withdrawal method.</p>
                </div>
              </div>
            </div>
          </div><!-- nk-block -->
          <div class="nk-block">

            <div class="plan-iv-list nk-slider nk-slider-s2">
              <ul class="plan-list slider-init"
                data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "infinite":false, "responsive":[{"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}} ]}'>


                                  <li class="plan-item">
                    <div class="plan-item-card">
                      <div class="plan-item-head">
                        <div class="row justify-content-center mb-2">
                          <div class="col-6">
                            <img src="pic.png"
                              class="card-img-top w-100" alt="Bitcoin">
                          </div>
                        </div>
                        <div class="plan-item-heading">
                      
                        </div>
                      </div>

                      <div class="plan-item-body">
                        <div class="plan-item-desc card-text">
                          <ul class="plan-item-desc-list">

                            <li>
                              <span class="desc-label">Limit:</span> <span
                                class="desc-data">300 -
                                1000000 USD</span>
                            </li>
                            <li>
                              <span class="desc-label">Charge:</span> <span
                                class="desc-data">0 USD +
                                0%</span>
                            </li>


                            <div class="plan-item-action mt-3">
                              <label for="plan-iv-1" class="plan-label">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal"
                                  data-resource="{&quot;id&quot;:1,&quot;name&quot;:&quot;The three methods below&quot;,&quot;image&quot;:&quot;6272967d189fe1651676797.png&quot;,&quot;min_limit&quot;:&quot;300.00000000&quot;,&quot;max_limit&quot;:&quot;1000000.00000000&quot;,&quot;delay&quot;:&quot;24 hrs&quot;,&quot;fixed_charge&quot;:&quot;0.00000000&quot;,&quot;rate&quot;:&quot;1.00000000&quot;,&quot;percent_charge&quot;:&quot;0.00&quot;,&quot;currency&quot;:&quot;$&quot;,&quot;user_data&quot;:{&quot;wallet_address&quot;:{&quot;field_name&quot;:&quot;wallet_address&quot;,&quot;field_level&quot;:&quot;Wallet Address&quot;,&quot;type&quot;:&quot;text&quot;,&quot;validation&quot;:&quot;required&quot;}},&quot;description&quot;:&quot;Please provide your wallet address below! (make sure its correct)&quot;,&quot;status&quot;:1,&quot;created_at&quot;:&quot;2021-12-30T18:33:54.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-18T14:29:29.000000Z&quot;}"
                                  class="cmn-btn btn-md mt-4 deposit">Withdraw</a>
                              </label>
                            </div>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                

              </ul>
            </div>


            <div class="plan-iv-actions text-center">
              <a href="withdrawal_log" class="btn btn-primary btn-lg"> <span>Withdrawal
                  History</span>
                <em class="icon ni ni-arrow-right"></em></a>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-bg">
            <div class="modal-header">
                <h5 class="modal-title method-name" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="withdraw" method="post" class="register">
    <input type="hidden" name="_token" value="CvSSyqa9DCQV2mOnssmkgof87FvbXYUPynGDasLU">
    <div class="modal-body">
        <p class="text-info depositLimit"></p>
        <p class="text-info depositCharge"></p>

        <div class="form-group">
            <label>Select Method:</label>
            <select name="method_code" class="edit-method-code form-control">
                <option value="Bitcoin">Bitcoin</option>
                <option value="Ethereum">Ethereum</option>
                <option value="USDT(TRC20)">USDT(TRC20)</option>
            </select>
        </div>

        <div class="form-group">
            <label>Wallet Address:</label>
            <input type="text" name="wallet_address" class="form-control" placeholder="Enter your wallet address" required>
        </div>

        <div class="form-group">
            <label>Enter Amount:</label>
            <div class="input-group">
                <input id="amount" type="text" class="form-control form-control-lg" onkeyup="this.value = this.value.replace(/^\.|[^\d\.]/g, '')" name="amount" placeholder="0.00" required>
                <div class="input-group-prepend">
                    <span class="input-group-text addon-bg currency-addon">USD</span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn cmn-btn btn-primary">Confirm</button>
    </div>
</form>

        </div>
    </div>
</div>
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<div class="elfsight-app-20b92b88-31e7-4948-928f-ee8d1afed3af"></div>
      

      
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
  

  <script src="../bundle.js"></script>
  <script src="../scripts.js"></script>
  <script src="../chart-invest.js"></script>


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
    (function($) {
      "use strict";
      $(document).ready(function() {
        $('.deposit').on('click', function() {
          var result = $(this).data('resource');

          $('.method-name').text(`Withdraw Via  ${result.name}`);


          $('.edit-method-code').val(result.id);
        });
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
        // Function to display toast notifications
        function notify(status, message) {
            iziToast[status]({
                message: message,
                position: "topRight"
            });
        }
    </script>

    <?php if (!empty($errorMessage)) : ?>
        <script>
            // Display error message as a toast
            notify('error', '<?php echo $errorMessage; ?>');
        </script>
Success!
    <?php endif; ?>

<script src="//code.tidio.co/1pitlmh4lhqgfytpakerk7i3qt0liah2.js" async></script>
</body>

</html>
