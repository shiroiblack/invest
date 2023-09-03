<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // If user is not logged in, redirect to login page or show an error message
    header('Location: login');
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
// Fetch user data from the database using the logged-in user's username
$username = $_SESSION['username'];
$balanceInAccount = $_SESSION['balance_in_account'];
$money = $_SESSION['money'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($connection, $sql);

// Retrieve user information
$username = $_SESSION['username'];
$email = $_SESSION['email'];
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted password
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['password'];

    // Check if the current password is correct
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$currentPassword'";
    $result = mysqli_query($connection, $query);
    $userData = mysqli_fetch_assoc($result);

    if ($userData) {
        // Update the password in the database
        $updateQuery = "UPDATE users SET password = '$newPassword' WHERE username = '$username'";
        mysqli_query($connection, $updateQuery);

        // Set success message
        $successMessage = "Password changed successfully.";
    } else {
        // Set error message
        $errorMessage = "Incorrect current password.";
    }
}
// Logout functionality
if (isset($_POST['logout'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page
    header('Location: ../login');
    exit();}
// Close the database connection
mysqli_close($connection);
?>




<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
   

  <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <script type="text/javascript">
        "use strict";
        function notify(status, message) {
            iziToast[status]({
                message: message,
                position: "topRight"
            });
        }
    </script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="rCzoGuQCuRA01VBNuKzuY78DXZiDfHA4QfRtflDJ">
  <title>Trustvestpro - CHANGE PASSWORD</title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,liontFxasset,investment">
    <link rel="shortcut icon" href="https://primevests.com/account/assets/images/logoIcon/favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="https://primevests.com/account/assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="liontFxasset - CHANGE PASSWORD">
    
    <meta itemprop="name" content="Trustvestpro - CHANGE PASSWORD">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="SEEDGATE- Alternative Investment option">
    <meta property="og:description" content="Introducing the first marketplace for investing in real estate debt and metaverse properties. Now you can invest in the loans made to borrowers(real estate agencies), and as they pay back their loans, you make money.And also co-own properties in the metaverse and NFTs.">
    <meta property="og:image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png"/>
    <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:url" content="https://primevests.com/account/user/change-password">
    
    <meta name="twitter:card" content="summary_large_image">
  <!-- bootstrap 4  -->

  
  
  <link rel="stylesheet" href="../dashlite.css">
  <link rel="stylesheet" href="../theme.css">
  

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
                <img class="logo-light logo-img" src="logo.png"
                  srcset="logo.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="logo.png"
                  srcset="logo.png 2x" alt="logo-dark">
              </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu" data-content="headerNav">
              <div class="nk-header-mobile">
                <div class="nk-header-brand">
                  <a href="../dashboard" class="logo-link">
                    <img class="logo-light logo-img"
                      src="logo.png"
                      srcset="logo.png 2x" alt="logo">
                    <img class="logo-dark logo-img"
                      src="logo.png"
                      srcset="logo.png 2x" alt="logo-dark">
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
                  <a href="deposit/deposit" class="nk-menu-link">
                    <span class="nk-menu-text">Deposit</span>
                  </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item">
                 
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item has-sub">
                  
                  <ul class="nk-menu-sub">
                    
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
                          <a class="btn btn-icon mr-n2" href="update_profile.php"><em
                              class="icon ni ni-setting"></em></a>
                        </div>
                      </div>
                    </div>
                    <div class="dropdown-inner user-account-info">
                      <h6 class="overline-title-alt"></h6>
                      <div class="user-balance"> <?php echo $_SESSION['money']; ?> <small
                          class="currency currency-usd"></small></div>
                      <div class="user-balance-sub">
                  
                      </div>
                      <a href="../user/withdraw.php" class="link">
                        <span>Withdraw Balance</span> <em class="icon ni ni-wallet-out"></em>
                      </a>
                    </div>
                    <div class="dropdown-inner">
                      <ul class="link-list">

                        <li>
                          <a href="update_profile.php">
                            <em class="icon ni ni-user-alt"></em>Profile Setting                          </a>
                        </li>
                          <li>
                          <a href="../user/kyc_verification.php">
                            <em class="icon ni ni-user-alt"></em>kyc                         </a>
                        </li>
                                                <li>
                          <a href="changepass.php">
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
                <?php if (isset($successMessage)): ?>
        <script type="text/javascript">
            "use strict";
            notify('success', "<?php echo $successMessage; ?>");
        </script>
    <?php elseif (isset($errorMessage)): ?>
        <script type="text/javascript">
            "use strict";
            notify('error', "<?php echo $errorMessage; ?>");
        </script>
    <?php endif; ?>
               <h2 class="nk-block-title fw-normal">CHANGE PASSWORD</h2>
    <div class="nk-block">
        <div class="card card-bordered">
            <form action="changepass.php" method="post">
                <input type="hidden" name="_token" value="rCzoGuQCuRA01VBNuKzuY78DXZiDfHA4QfRtflDJ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Enter Old Password</label>
                                <input type="password" name="current_password" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <label>Enter New Password</label>
                                <input type="password" name="password" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <label>Re-type Password</label>
                                <input type="password" name="password_confirmation" class="form-control form-control-lg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-lg btn-primary cmn-btn">Update</button>
                </div>
            </form>
        </div>
    </div>





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


  <link rel="stylesheet" href="../iziToast.min.css">
<script src="../iziToast.min.js"></script>


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
<script src="//code.tidio.co/1pitlmh4lhqgfytpakerk7i3qt0liah2.js" async></script>
</body>

</html>
