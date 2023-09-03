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
   // Fetch the user's email from the database
$sql = "SELECT email FROM users WHERE username = '$username'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $email = $userData['email'];

    // Store the email in the session
    $_SESSION['email'] = $email;
}


    //$email = $_SESSION['email'];
// Check if the withdrawal form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the withdrawal amount, method code, and wallet address from the submitted form data
    $withdrawalAmount = $_POST['amount'];
    $withdrawalMethod = $_POST['method_code'];
    $walletAddress = $_POST['wallet_address'];

    // Perform any necessary validation on the withdrawal amount, method code, and wallet address
    if (empty($withdrawalAmount)) {
        die("Withdrawal amount is required.");
    }

    // Fetch user data from the database using the logged-in user's username
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $sql);

    // Check if the user record was found
    if (mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);

        // Extract the required balance values from the fetched data
        $totalBalance = $userData['money']; // Assuming the total column represents the total balance
        $totalWithdraw = $userData['total_withdraw'];


        // Perform additional validation to ensure sufficient balance
        if ($withdrawalAmount > $totalBalance) {
            die("Insufficient balance.");
        }

        // Deduct the withdrawal amount from the user's total balance
        //$totalBalance -= $withdrawalAmount;
        //$totalWithdraw += $withdrawalAmount;

        // Update the user's balance in the database
        //$updateQuery = "UPDATE users SET total = $totalBalance, total_withdraw = $totalWithdraw WHERE username = '$username'";
        //mysqli_query($connection, $updateQuery);

        // Insert the withdrawal details into the withdrawal history table
        $insertQuery = "INSERT INTO withdrawal_history (user_id, withdrawal_method, withdrawal_amount, wallet_address, withdrawal_date, status) VALUES ((SELECT id FROM users WHERE username = '$username'), '$withdrawalMethod', $withdrawalAmount, '$walletAddress', NOW(), 'Pending')";
        mysqli_query($connection, $insertQuery);

        // Redirect the user to the withdrawal log page
        header('Location: withdrawal_log');
        exit();
    } else {
        // Redirect the user to an error page or display an error message
        die("User data not found.");
    }
}
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
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,Trustvestpro,investment">
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

  
  
  <link rel="stylesheet" href="dashlite.css">
  <link rel="stylesheet" href="theme.css">
  

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
                        <div class="user-avatar">
                          <span>AB</span>
                        </div>
                        <div class="user-info">
                          <span class="lead-text"><?php echo $username; ?></span>
                          <span class="sub-text"><?php echo $email; ?></span>
                        </div>
                        <div class="user-action">
                          <a class="btn btn-icon mr-n2" href="../user/update_profile"><em
                              class="icon ni ni-setting"></em></a>
                        </div>
                      </div>
                    </div>
                    <div class="dropdown-inner user-account-info">
                      
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
              <div class="nk-block-head-sub"></div>
              <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">
                  Withdraw Log</h2>
                <div class="nk-block-des">
                  <p>Withdraw Log</p>
                </div>
              </div>
            </div>
          </div><!-- nk-block -->

          <div class="nk-block">

            <div class="card card-bordered">
              <div class="table-responsive--md table-responsive">





                <table class="table style--two">
  <?php
// Fetch the withdrawal history for the logged-in user
$username = $_SESSION['username'];
$sql = "SELECT * FROM withdrawal_history WHERE user_id = (SELECT id FROM users WHERE username = '$username')";
$result = mysqli_query($connection, $sql);

// Check if withdrawal history records were found
if (mysqli_num_rows($result) > 0) {
    // Display the withdrawal history records
    echo "<table class='table style--two'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'>Withdrawal Amount</th>";
    echo "<th scope='col'>Withdrawal Method</th>";
    echo "<th scope='col'>Wallet Address</th>";
    echo "<th scope='col'>Status</th>";
    echo "<th scope='col'>Withdrawal Date</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['withdrawal_amount'] . "</td>";
        echo "<td>" . $row['withdrawal_method'] . "</td>";
        echo "<td>" . $row['wallet_address'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>" . $row['withdrawal_date'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "No withdrawal history found.";
}

// Close the database connection
mysqli_close($connection);
?>





































       


                





              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>






  
  <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <li class="list-group-item dark-bg">Transactions : <span class="trx"></span></li>
            <li class="list-group-item dark-bg">Admin Feedback : <span class="feedback"></span></li>
          </ul>
          <ul class="list-group withdraw-detail mt-1">
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

      

      
      <!-- footer @s  -->
      <div class="nk-footer nk-footer-fluid bg-lighter">
        <div class="container-xl wide-lg">
          <div class="nk-footer-wrap">
            <div class="nk-footer-copyright">
              © 2022 <a href="https://Trustvestpro.cc">Trustvestpro</a>. All rights reserved            </div>
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
<script src="ziToast.min.js"></script>


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
        modal.find('.trx').text($(this).data('transactions'));
        modal.find('.feedback').text($(this).data('admin_feedback'));
        var list = [];
        var details = Object.entries($(this).data('info'));

        var ImgPath = "https://primevests.com/account/assets/images/verify/withdraw/";
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

        if (singleInfo) {
          modal.find('.withdraw-detail').html(
            `<br><strong class="my-3">Payment Information</strong>  ${singleInfo}`);
        } else {
          modal.find('.withdraw-detail').html(`${singleInfo}`);
        }
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
<script src="//code.tidio.co/1pitlmh4lhqgfytpakerk7i3qt0liah2.js" async></script>
</body>

</html>
