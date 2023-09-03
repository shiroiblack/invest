<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_username'])) {
    // User is not logged in, redirect to login page
    header('Location: admin_login');
    exit();
}

// Handle logout request
if (isset($_POST['logout'])) {
    // Clear all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header('Location: admin_login');
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['withdrawal_id'])) {
    $withdrawalId = $_POST['withdrawal_id'];

    // Fetch the withdrawal data from the database
    $withdrawalQuery = "SELECT w.*, u.total_withdrawal, u.email, u.username 
                        FROM withdrawal_history AS w 
                        INNER JOIN users AS u ON w.user_id = u.id
                        WHERE w.id = $withdrawalId AND w.status = 'pending'";
    $withdrawalResult = mysqli_query($connection, $withdrawalQuery);

    if ($withdrawalResult && mysqli_num_rows($withdrawalResult) > 0) {
        $withdrawalData = mysqli_fetch_assoc($withdrawalResult);
        $withdrawalAmount = $withdrawalData['withdrawal_amount'];
        $userId = $withdrawalData['user_id'];
        $totalWithdraw = $withdrawalData['total_withdrawal'];
        $WithdrawWallet = $withdrawalData['wallet_address'];

        if (isset($_POST['approve'])) {
            // Update the status of the withdrawal to "Approved" in the database
            $updateQuery = "UPDATE withdrawal_history SET status = 'Approved' WHERE id = $withdrawalId";
            if (mysqli_query($connection, $updateQuery)) {
                // Update the total column in the users table
                $updateUserQuery = "UPDATE users SET 
                                    money = money - $withdrawalAmount, 
                                    total_withdrawal = $totalWithdraw + $withdrawalAmount,
                                    interest_wallet_balance = 0,
                                    total_invest = 0
                                    WHERE id = $userId";

                if (mysqli_query($connection, $updateUserQuery)) {
                    // Send email notification to the user
                    $to = $withdrawalData['email'];
                    $subject = "Withdrawal Approved";
                    $message = "Dear {$withdrawalData['username']},\n\nWe are pleased to inform you that your withdrawal has been approved. It has been sent to your Wallet. \n\nYour wallet address: $WithdrawWallet\n\nThank you for using our platform.\n\nBest regards,\nTrustvestpro Team";
                    $headers = "From: Trustvestpro <support@Trustvestpro.cc>";

                    // Send the email
                    if (mail($to, $subject, $message, $headers)) {
                        // Redirect the admin back to the pending withdrawals page
                        header('Location: admin_update_withdrawal');
                        exit();
                    } else {
                        echo "Email could not be sent.";
                    }
                } else {
                    die("Error updating user data: " . mysqli_error($connection));
                }
            } else {
                die("Error updating withdrawal status: " . mysqli_error($connection));
            }
        } elseif (isset($_POST['decline'])) {
            // Update the status of the withdrawal to "Declined" in the database
            $updateQuery = "UPDATE withdrawal_history SET status = 'Declined' WHERE id = $withdrawalId";
            if (mysqli_query($connection, $updateQuery)) {
                // Send email notification to the user
                $to = $withdrawalData['email'];
                $subject = "Withdrawal Declined";
                $message = "Dear {$withdrawalData['username']},\n\nWe regret to inform you that your withdrawal request has been declined. If you have any questions, please contact our support team.\n\nThank you for using our platform.\n\nBest regards,\nTrustvestpro Team";
                $headers = "From: Trustvestpro <support@Trustvestpro.cc>";

                // Send the email
                if (mail($to, $subject, $message, $headers)) {
                    // Redirect the admin back to the pending withdrawals page
                    header('Location: admin_update_withdrawal');
                    exit();
                } else {
                    echo "Email could not be sent.";
                }
            } else {
                die("Error updating withdrawal status: " . mysqli_error($connection));
            }
        }
    } else {
        die("Withdrawal data not found or already processed.");
    }
}

// Fetch pending withdrawals from the database
$query = "SELECT w.*, u.username 
          FROM withdrawal_history AS w 
          INNER JOIN users AS u ON w.user_id = u.id
          WHERE w.status = 'pending'";
$result = mysqli_query($connection, $query);

// Close the PHP tag and start writing the HTML code
?>
<!-- Your HTML code here -->




<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="CvSSyqa9DCQV2mOnssmkgof87FvbXYUPynGDasLU">
  <title>Trustvestpro - Pending Withdrawals</title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,ProinvestEngine,investment">
    <link rel="shortcut icon" href="https://trustvestpro.cc/account/assets/images/logoIcon/favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="https://trustvestpro.cc/account/assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="ProinvestEngine - Pending Withdrawals">
    
    <meta itemprop="name" content="Trustvestpro - Pending Withdrawals">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="https://trustvestpro.cc/account/assets/images/seo/63cc7c80269ff1674345600.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="SEEDGATE- Alternative Investment option">
    <meta property="og:description" content="Introducing the first marketplace for investing in real estate debt and metaverse properties. Now you can invest in the loans made to borrowers(real estate agencies), and as they pay back their loans, you make money.And also co-own properties in the metaverse and NFTs.">
    <meta property="og:image" content="https://liontFxasset.com/account/assets/images/seo/63cc7c80269ff1674345600.png"/>
    <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:url" content="https://liontFxasset.com/account/user/deposit/history">
    
    <meta name="twitter:card" content="summary_large_image">
  <!-- bootstrap 4  -->

  
  
  <link rel="stylesheet" href="dashlite.css?ver=2.4.0">
  <link rel="stylesheet" href="theme.css?ver=2.4.0">
  

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
              <a href="admin" class="logo-link">
                <img class="logo-light logo-img" src="logo.png"
                  srcset="logo.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="logo.png"
                  srcset="logo.png 2x" alt="logo-dark">
              </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu" data-content="headerNav">
              <div class="nk-header-mobile">
                <div class="nk-header-brand">
                  <a href="admin" class="logo-link">
                    <img class="logo-light logo-img"
                      src="logo.png"
                      srcset="logo.png 2x" alt="logo">
                    <img class="logo-dark logo-img"
                      src="logo1.png"
                      srcset="logo1.png 2x" alt="logo-dark">
                  </a>
                </div>
                <div class="nk-menu-trigger mr-n2">
                  <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em
                      class="icon ni ni-arrow-left"></em></a>
                </div>
              </div>
              <ul class="nk-menu nk-menu-main ui-s2">
                <li class="nk-menu-item">
                  <a href="admin" class="nk-menu-link">
                    <span class="nk-menu-text">Admin Dashboard</span>
                  </a>
                </li><!-- .nk-menu-item -->
                
                <li class="nk-menu-item">
                  <a href="transactions" class="nk-menu-link">
                    <span class="nk-menu-text">Pending Deposit</span>
                  </a>
                </li><!-- .nk-menu-item -->
                 <li class="nk-menu-item">
                  <a href="admin_update_withdrawal" class="nk-menu-link">
                    <span class="nk-menu-text">Pending Withdrawals</span>
                  </a>
                </li><!-- .nk-menu-item -->
                 <li class="nk-menu-item">
                  <a href="referral" class="nk-menu-link">
                    <span class="nk-menu-text">Referrals</span>
                  </a>
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
                        
                        <div class="user-name dropdown-indicator">Admin
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
                          <span class="lead-text">Admin</span>
                          <span class="sub-text">support@trustvestpro.cc</span>
                        </div>
                        <div class="user-action">
                          
                        </div>
                      </div>
                    </div>
                    <div class="dropdown-inner user-account-info">
                     
                      <div class="user-balance-sub">
                       
                      </div>
                    
                    </div>
                    <div class="dropdown-inner">
                      <ul class="link-list">

                        <li>
                          <a href="admin">
                            <em class="icon ni ni-user-alt"></em>Admin Dashboard                         </a>
                        </li>

                <li class="nk-menu-item">
                  <a href="trades" class="nk-menu-link">
                    <span class="nk-menu-text">Trades</span>
                  </a>
                </li><!-- .nk-menu-item -->
                                                <li>
                          <a href="transactions">
                            <em class="icon ni ni-lock"></em>Pending Deposit                          </a>
                        </li>
                        <li>
                          <a href="admin_update_withdrawal">
                            <em class="icon ni ni-info"></em>Pending Withdrawals                          </a>
                        </li>
                         <li>
                          <a href="referral">
                            <em class="icon ni ni-info"></em>Referrals                          </a>
                        </li>
                        <li>
                                            
                        </li>
                        <li>
                         
                        </li>

                        <li>
                          <a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a>
                        </li>
                      </ul>
                    </div>
                    <div class="dropdown-inner">
                       <!-- Logout button -->
  
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
<table class="table style--two">
    <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Withdrawal Method</th>
        <th>Withdrawal Amount</th>
        <th>Wallet Address</th>
        <th>Withdrawal Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php
    // Iterate over the pending withdrawals and populate the table rows
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['withdrawal_method']; ?></td>
            <td><?php echo $row['withdrawal_amount']; ?></td>
            <td><?php echo $row['wallet_address']; ?></td>
            <td><?php echo $row['withdrawal_date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                 <form method="POST" action="admin_update_withdrawal">
                        <input type="hidden" name="withdrawal_id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="approve" value="Approve">
                        <input type="submit" name="decline" value="Decline"> <!-- New Decline Button -->
                    </form>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
// Check if any pending withdrawals are found
if (mysqli_num_rows($result) <= 0) {
    echo 'No pending withdrawals found.';
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
            
            <div class="nk-footer-links">
              <ul class="menu">
                                
            </div>
          </div>
        </div>
      </div>
      <!-- footer @e  -->
    </div> <!-- page-wrapper end -->
  </div>
  

  <script src="bundle.js?ver=2.4.0"></script>
  <script src="scripts.js?ver=2.4.0"></script>
  <script src="chart-invest.js?ver=2.4.0"></script>


  <link rel="stylesheet" href="iziToast.min.css">
<script src="iziToast.min.js"></script>

            <script type="text/javascript">
            "use strict";
            iziToast.success({message:"Withdrawal Approved.", position: "topRight"});
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
        var ImgPath = "https://liontFxasset.com/account/assets/images/verify/deposit/";

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
        window.location.href = "https://liontFxasset.com/account/change/" + $(this).val();
      });
    })();
  </script>

</body>

</html>

