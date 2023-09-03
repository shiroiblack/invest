<?php
session_start();

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
    header('Location: account/login');
    exit();
}

// Fetch user data from the database using the logged-in user's username
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($connection, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

// Check if the user record was found
if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);

    // Store the required balance values and other user data in the session
    $_SESSION['deposit_wallet_balance'] = $userData['deposit_wallet_balance'];
    $_SESSION['interest_wallet_balance'] = $userData['interest_wallet_balance'];
    $_SESSION['total_deposit'] = $userData['total_deposit'];
    $_SESSION['total_invest'] = $userData['total_invest'];
    $_SESSION['total_withdrawal'] = $userData['total_withdrawal'];
    $_SESSION['balance_in_account'] = $userData['balance_in_account'];
    $_SESSION['email'] = $userData['email'];
    $_SESSION['money'] = $userData['money'];
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $depositAmount = $_POST['pending_deposit_amount'];
        $gatewayType = $_POST['gateway_title'];
    
        // Validate deposit amount and gateway type
        if (empty($depositAmount)) {
            $errorMessage = "Deposit amount is required.";
        } elseif ($depositAmount < 50) {
            $errorMessage = "Minimum deposit amount is $50.";
        } elseif ($depositAmount > 1000000) {
            $errorMessage = "Maximum deposit amount is $1,000,000.";
        } elseif (empty($gatewayType)) {
            $errorMessage = "Gateway type is required.";
        } else {
            // Generate transaction ID
            $transaction_id = generateTransactionID();

            // Store the deposit information in the session
            $_SESSION['pending_deposit_amount'] = $depositAmount;
            $_SESSION['gateway_title'] = $gatewayType;
            $_SESSION['transaction_id'] = $transaction_id;
            $_SESSION['pending'] = true;

            // Check if the current user has a referrer
            $referralRecordQuery = "SELECT * FROM referral WHERE referred_username = '$username'";
            $referralRecordResult = mysqli_query($connection, $referralRecordQuery);

            if (mysqli_num_rows($referralRecordResult) > 0) {
                // Update earnings for the referrer of the current user
                $referralRecordData = mysqli_fetch_assoc($referralRecordResult);
                $referrerUsername = $referralRecordData['referrer_username'];
                $referrerEarnings = $depositAmount * 0.1; // 10% of the deposit amount
                $updateReferrerQuery = "UPDATE referral SET earnings = earnings + $referrerEarnings WHERE referred_username = '$referrerUsername'";
                mysqli_query($connection, $updateReferrerQuery);

                // Update the referrer's earnings in the users table
                $updateUserQuery = "UPDATE users SET referrer_earnings = referrer_earnings + $referrerEarnings WHERE username = '$referrerUsername'";
                mysqli_query($connection, $updateUserQuery);
            }

            // Redirect the user to the manual preview page
            header('Location: manual');
            exit();
        }
    }
} else {
    // Redirect the user to an error page or display an error message
    die("User data not found.");
}

// Free the result set
mysqli_free_result($result);

// Close the database connection
mysqli_close($connection);

// Function to generate a transaction ID
function generateTransactionID()
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $transactionID = '';

    for ($i = 0; $i < 10; $i++) {
        $randomIndex = rand(0, strlen($characters) - 1);
        $transactionID .= $characters[$randomIndex];
    }

    return $transactionID;
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

  
  <link rel="stylesheet" href="iziToast.min.css" />
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
                      <h6 class="overline-title-alt">Balance in Account</h6>
                      <div class="user-balance">$<?php echo $_SESSION['money'] ?> <small
                          class="currency currency-usd">USD</small></div>
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
              <div class="nk-block-head-sub"><span>Choose an Option</span></div>
              <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">Deposit Methods</h2>
                <div class="nk-block-des">
                  <p>Choose a deposit method to add money.</p>
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
                            <img src="61db059bcbe401641743771.png" class="card-img-top w-100" alt="Bitcoin">
                          </div>
                        </div>
                        <div class="plan-item-heading">
                          <h4 class="plan-item-title card-title title">Bitcoin</h4>
                        </div>
                      </div>

                      <div class="plan-item-body">
                        <div class="plan-item-desc card-text">
                          <ul class="plan-item-desc-list">

                            <li>
                              <span class="desc-label">Limit:</span> <span
                                class="desc-data">50 -
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
                                  data-resource="{&quot;id&quot;:1,&quot;name&quot;:&quot;Bitcoin&quot;,&quot;currency&quot;:&quot;\u00a3&quot;,&quot;symbol&quot;:&quot;&quot;,&quot;method_code&quot;:1000,&quot;gateway_alias&quot;:&quot;bitcoin&quot;,&quot;min_amount&quot;:&quot;500.00000000&quot;,&quot;max_amount&quot;:&quot;1000000.00000000&quot;,&quot;percent_charge&quot;:&quot;0.00&quot;,&quot;fixed_charge&quot;:&quot;0.00000000&quot;,&quot;rate&quot;:&quot;1.00000000&quot;,&quot;image&quot;:&quot;61db059bcbe401641743771.png&quot;,&quot;gateway_parameter&quot;:&quot;{\&quot;transaction_proof\&quot;:{\&quot;field_name\&quot;:\&quot;transaction_proof\&quot;,\&quot;field_level\&quot;:\&quot;Transaction proof\&quot;,\&quot;type\&quot;:\&quot;file\&quot;,\&quot;validation\&quot;:\&quot;required\&quot;}}&quot;,&quot;created_at&quot;:&quot;2021-12-30T18:28:31.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-01-22T11:57:12.000000Z&quot;,&quot;method&quot;:{&quot;id&quot;:33,&quot;code&quot;:&quot;1000&quot;,&quot;alias&quot;:&quot;bitcoin&quot;,&quot;image&quot;:&quot;61db059bcbe401641743771.png&quot;,&quot;name&quot;:&quot;Bitcoin&quot;,&quot;status&quot;:true,&quot;parameters&quot;:&quot;[]&quot;,&quot;supported_currencies&quot;:&quot;[]&quot;,&quot;crypto&quot;:0,&quot;extra&quot;:null,&quot;description&quot;:&quot;bc1q6phymn8rpz6xjttew6qvhmg4mqwqkv0kr0fqz6&quot;,&quot;input_form&quot;:{&quot;transaction_proof&quot;:{&quot;field_name&quot;:&quot;transaction_proof&quot;,&quot;field_level&quot;:&quot;Transaction proof&quot;,&quot;type&quot;:&quot;file&quot;,&quot;validation&quot;:&quot;required&quot;}},&quot;created_at&quot;:&quot;2021-12-30T18:28:31.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-01-22T11:57:12.000000Z&quot;}}"
                                  class="cmn-btn btn-md mt-4 deposit">Deposit</a>
                              </label>
                            </div>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                                  <li class="plan-item">
                    <div class="plan-item-card">
                      <div class="plan-item-head">
                        <div class="row justify-content-center mb-2">
                          <div class="col-6">
                            <img src="61db07f90e7121641744377.png" class="card-img-top w-100" alt="Ethereum">
                          </div>
                        </div>
                        <div class="plan-item-heading">
                          <h4 class="plan-item-title card-title title">Ethereum</h4>
                        </div>
                      </div>

                      <div class="plan-item-body">
                        <div class="plan-item-desc card-text">
                          <ul class="plan-item-desc-list">

                            <li>
                              <span class="desc-label">Limit:</span> <span
                                class="desc-data">50 -
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
                                  data-resource="{&quot;id&quot;:2,&quot;name&quot;:&quot;Ethereum&quot;,&quot;currency&quot;:&quot;\u00a3&quot;,&quot;symbol&quot;:&quot;&quot;,&quot;method_code&quot;:1001,&quot;gateway_alias&quot;:&quot;ethereum&quot;,&quot;min_amount&quot;:&quot;500.00000000&quot;,&quot;max_amount&quot;:&quot;1000000.00000000&quot;,&quot;percent_charge&quot;:&quot;0.00&quot;,&quot;fixed_charge&quot;:&quot;0.00000000&quot;,&quot;rate&quot;:&quot;1.00000000&quot;,&quot;image&quot;:&quot;61db07f90e7121641744377.png&quot;,&quot;gateway_parameter&quot;:&quot;{\&quot;transaction_proof\&quot;:{\&quot;field_name\&quot;:\&quot;transaction_proof\&quot;,\&quot;field_level\&quot;:\&quot;Transaction proof\&quot;,\&quot;type\&quot;:\&quot;file\&quot;,\&quot;validation\&quot;:\&quot;required\&quot;}}&quot;,&quot;created_at&quot;:&quot;2021-12-30T18:29:33.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-01-22T11:58:05.000000Z&quot;,&quot;method&quot;:{&quot;id&quot;:34,&quot;code&quot;:&quot;1001&quot;,&quot;alias&quot;:&quot;ethereum&quot;,&quot;image&quot;:&quot;61db07f90e7121641744377.png&quot;,&quot;name&quot;:&quot;Ethereum&quot;,&quot;status&quot;:true,&quot;parameters&quot;:&quot;[]&quot;,&quot;supported_currencies&quot;:&quot;[]&quot;,&quot;crypto&quot;:0,&quot;extra&quot;:null,&quot;description&quot;:&quot;0xc9dD52e1767982d7c9d58c209c19735e02635A68&quot;,&quot;input_form&quot;:{&quot;transaction_proof&quot;:{&quot;field_name&quot;:&quot;transaction_proof&quot;,&quot;field_level&quot;:&quot;Transaction proof&quot;,&quot;type&quot;:&quot;file&quot;,&quot;validation&quot;:&quot;required&quot;}},&quot;created_at&quot;:&quot;2021-12-30T18:29:33.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-01-22T11:58:05.000000Z&quot;}}"
                                  class="cmn-btn btn-md mt-4 deposit">Deposit</a>
                              </label>
                            </div>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                                  <li class="plan-item">
                    <div class="plan-item-card">
                      <div class="plan-item-head">
                        <div class="row justify-content-center mb-2">
                          <div class="col-6">
                            <img src="6272946cba5461651676268.png" class="card-img-top w-100" alt="USDT (TRC 20)">
                          </div>
                        </div>
                        <div class="plan-item-heading">
                          <h4 class="plan-item-title card-title title">USDT (TRC 20)</h4>
                        </div>
                      </div>

                      <div class="plan-item-body">
                        <div class="plan-item-desc card-text">
                          <ul class="plan-item-desc-list">

                            <li>
                              <span class="desc-label">Limit:</span> <span
                                class="desc-data">50 -
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
                                  data-resource="{&quot;id&quot;:3,&quot;name&quot;:&quot;USDT (TRC 20)&quot;,&quot;currency&quot;:&quot;\u00a3&quot;,&quot;symbol&quot;:&quot;&quot;,&quot;method_code&quot;:1002,&quot;gateway_alias&quot;:&quot;usdt_(trc_20)&quot;,&quot;min_amount&quot;:&quot;500.00000000&quot;,&quot;max_amount&quot;:&quot;1000000.00000000&quot;,&quot;percent_charge&quot;:&quot;0.00&quot;,&quot;fixed_charge&quot;:&quot;0.00000000&quot;,&quot;rate&quot;:&quot;1.00000000&quot;,&quot;image&quot;:&quot;6272946cba5461651676268.png&quot;,&quot;gateway_parameter&quot;:&quot;{\&quot;transaction_proof\&quot;:{\&quot;field_name\&quot;:\&quot;transaction_proof\&quot;,\&quot;field_level\&quot;:\&quot;Transaction proof\&quot;,\&quot;type\&quot;:\&quot;file\&quot;,\&quot;validation\&quot;:\&quot;required\&quot;}}&quot;,&quot;created_at&quot;:&quot;2021-12-30T18:30:35.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-01-22T11:59:11.000000Z&quot;,&quot;method&quot;:{&quot;id&quot;:35,&quot;code&quot;:&quot;1002&quot;,&quot;alias&quot;:&quot;usdt_(trc_20)&quot;,&quot;image&quot;:&quot;6272946cba5461651676268.png&quot;,&quot;name&quot;:&quot;USDT (TRC 20)&quot;,&quot;status&quot;:true,&quot;parameters&quot;:&quot;[]&quot;,&quot;supported_currencies&quot;:&quot;[]&quot;,&quot;crypto&quot;:0,&quot;extra&quot;:null,&quot;description&quot;:&quot;TM2MZUAWkMVJbUiWXKW6w5ggEobmGE5ZMV&quot;,&quot;input_form&quot;:{&quot;transaction_proof&quot;:{&quot;field_name&quot;:&quot;transaction_proof&quot;,&quot;field_level&quot;:&quot;Transaction proof&quot;,&quot;type&quot;:&quot;file&quot;,&quot;validation&quot;:&quot;required&quot;}},&quot;created_at&quot;:&quot;2021-12-30T18:30:35.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-01-22T11:59:11.000000Z&quot;}}"
                                  class="cmn-btn btn-md mt-4 deposit">Deposit</a>
                              </label>
                            </div>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                                  <li class="plan-item">
                    <div class="plan-item-card">
                      <div class="plan-item-head">
                        <div class="row justify-content-center mb-2">
                          <div class="col-6">
                            <img src="63cd2459b462f1674388569.png" class="card-img-top w-100" alt="Ripple">
                          </div>
                        </div>
                        <div class="plan-item-heading">
                          <h4 class="plan-item-title card-title title">Ripple</h4>
                        </div>
                      </div>

                      <div class="plan-item-body">
                        <div class="plan-item-desc card-text">
                          <ul class="plan-item-desc-list">

                            <li>
                              <span class="desc-label">Limit:</span> <span
                                class="desc-data">50 -
                                10000000 USD</span>
                            </li>
                            <li>
                              <span class="desc-label">Charge:</span> <span
                                class="desc-data">0 USD +
                                0%</span>
                            </li>


                            <div class="plan-item-action mt-3">
                              <label for="plan-iv-1" class="plan-label">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal"
                                  data-resource="{&quot;id&quot;:4,&quot;name&quot;:&quot;Ripple&quot;,&quot;currency&quot;:&quot;\u00a3&quot;,&quot;symbol&quot;:&quot;&quot;,&quot;method_code&quot;:1003,&quot;gateway_alias&quot;:&quot;ripple&quot;,&quot;min_amount&quot;:&quot;500.00000000&quot;,&quot;max_amount&quot;:&quot;10000000.00000000&quot;,&quot;percent_charge&quot;:&quot;0.00&quot;,&quot;fixed_charge&quot;:&quot;0.00000000&quot;,&quot;rate&quot;:&quot;1.00000000&quot;,&quot;image&quot;:&quot;63cd2459b462f1674388569.png&quot;,&quot;gateway_parameter&quot;:&quot;{\&quot;transaction_proof\&quot;:{\&quot;field_name\&quot;:\&quot;transaction_proof\&quot;,\&quot;field_level\&quot;:\&quot;Transaction Proof\&quot;,\&quot;type\&quot;:\&quot;file\&quot;,\&quot;validation\&quot;:\&quot;required\&quot;}}&quot;,&quot;created_at&quot;:&quot;2023-01-22T11:56:09.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-01-22T11:56:09.000000Z&quot;,&quot;method&quot;:{&quot;id&quot;:36,&quot;code&quot;:&quot;1003&quot;,&quot;alias&quot;:&quot;ripple&quot;,&quot;image&quot;:&quot;63cd2459b462f1674388569.png&quot;,&quot;name&quot;:&quot;Ripple&quot;,&quot;status&quot;:true,&quot;parameters&quot;:&quot;[]&quot;,&quot;supported_currencies&quot;:&quot;[]&quot;,&quot;crypto&quot;:0,&quot;extra&quot;:null,&quot;description&quot;:&quot;rwhiaEgdZyDHMWSTJ2Fwb8tfkbcM5H3x6Y&quot;,&quot;input_form&quot;:{&quot;transaction_proof&quot;:{&quot;field_name&quot;:&quot;transaction_proof&quot;,&quot;field_level&quot;:&quot;Transaction Proof&quot;,&quot;type&quot;:&quot;file&quot;,&quot;validation&quot;:&quot;required&quot;}},&quot;created_at&quot;:&quot;2023-01-22T11:56:09.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-01-22T11:56:23.000000Z&quot;}}"
                                  class="cmn-btn btn-md mt-4 deposit">Deposit</a>
                              </label>
                            </div>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                

              </ul>
            </div>


          


          </div>
        </div>
      </div>
    </div>
  </div>









  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-content-bg">
        <div class="modal-header">
          <strong class="modal-title method-name text-white" id="exampleModalLabel"></strong>
          <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </a>
        </div>
        <form action="" method="POST" class="register">
    <div class="modal-body">
        <div class="form-group">
            <label for="deposit">Enter deposit amount:</label>
            <div class="input-group">
                <input id="deposit" type="number" class="form-control form-control-lg" name="pending_deposit_amount" placeholder="0.00" required>
                <div class="input-group-prepend">
                    <span class="input-group-text currency-addon addon-bg">USD</span>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="gateway">Select gateway:</label>
            <select name="gateway_title" id="gateway" class="form-control form-control-lg" required>
                <option value="Bitcoin">Bitcoin</option>
                <option value="Ethereum">Ethereum</option>
                <option value="USDT(TRC20)">USDT(TRC20)</option>
                <option value="Ripple">Ripple</option>
            </select>
        </div>

       
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn-md cmn-btn">Deposit</button>
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
      $('.deposit').on('click', function() {
        var id = $(this).data('id');
        var result = $(this).data('resource');
        var minAmount = $(this).data('min_amount');
        var maxAmount = $(this).data('max_amount');
        var baseSymbol = "USD";
        var fixCharge = $(this).data('fix_charge');
        var percentCharge = $(this).data('percent_charge');

        var depositLimit = `Deposit Limit: ${minAmount} - ${maxAmount}  ${baseSymbol}`;
        $('.depositLimit').text(depositLimit);
        var depositCharge =
          `Charge: ${fixCharge} ${baseSymbol}  ${(0 < percentCharge) ? ' + ' +percentCharge + ' % ' : ''}`;
        $('.depositCharge').text(depositCharge);
        $('.method-name').text(`Payment By  ${result.name}`);
        $('.currency-addon').text(baseSymbol);

        $('.edit-currency').val(result.currency);
        $('.edit-method-code').val(result.method_code);
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
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
    <?php endif; ?>
<script src="//code.tidio.co/1pitlmh4lhqgfytpakerk7i3qt0liah2.js" async></script>
</body>

</html>
