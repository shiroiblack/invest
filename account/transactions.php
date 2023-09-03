
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

// Check if a success message is set in the session
if (isset($_SESSION['success_message'])) {
    // Echo the success message using JavaScript code
    echo '<script type="text/javascript">
        "use strict";
        iziToast.success({message: "'.$_SESSION['success_message'].'", position: "topRight"});
    </script>';

    // Unset the success message in the session
    unset($_SESSION['success_message']);
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

// Retrieve all transactions from the deposit history
$transactionsQuery = "SELECT * FROM deposit_history";
$transactionsResult = mysqli_query($connection, $transactionsQuery);

// Check if transactions exist
if (mysqli_num_rows($transactionsResult) > 0) {
    // Initialize an array to store the transaction data
    $transactions = array();

    while ($row = mysqli_fetch_assoc($transactionsResult)) {
        $transaction = array(
            'transactionID' => $row['transaction_id'],
            'username' => $row['username'],
            'amount' => $row['pending_deposit_amount'],
            'transactionHash' => $row['transaction_hash'],
            'status' => ($row['pending_status'] == 1) ? 'Pending' : 'Approved'
        );
        // Add the transaction to the array
        $transactions[] = $transaction;
    }

    // Close the result set
    mysqli_free_result($transactionsResult);

    // Close the database connection
    mysqli_close($connection);
} else {
    // No transactions found
    $transactions = array();
}
?>





<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Include jQuery library -->


<!-- Script to handle transaction approval -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Attach click event handler to the "Approve" buttons
    $(".approve-btn").click(function() {
        var transactionID = $(this).data("transaction-id");

        // Send an AJAX request to approve_transaction.php with the transaction ID
        $.ajax({
            url: "approve_transaction.php",
            type: "POST",
            data: { transaction_id: transactionID },
            success: function(response) {
                alert(response);
                // Refresh the transactions table after approving the transaction
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});
</script>








  <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="CvSSyqa9DCQV2mOnssmkgof87FvbXYUPynGDasLU">
  <title>ProinvestEngine - Pending Deposits</title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,ProinvestEngine,investment">
    <link rel="shortcut icon" href="https://primevests.com/account/assets/images/logoIcon/favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="https://primevests.com/account/assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="ProinvestEngine - Pending Withdrawals">
    
    <meta itemprop="name" content="ProinvestEngine - Pending Withdrawals">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="SEEDGATE- Alternative Investment option">
    <meta property="og:description" content="Introducing the first marketplace for investing in real estate debt and metaverse properties. Now you can invest in the loans made to borrowers(real estate agencies), and as they pay back their loans, you make money.And also co-own properties in the metaverse and NFTs.">
    <meta property="og:image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png"/>
    <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:url" content="https://primevests.com/account/user/deposit/history">
    
    <meta name="twitter:card" content="summary_large_image">
  <!-- bootstrap 4  -->

  <style>
      
      .approve-button {
    background-color: green;
    color: white;
    padding: 5px 10px;
    border-radius: 3px;
    margin-right: 5px;
}

.decline-button {
    background-color: red;
    color: white;
    padding: 5px 10px;
    border-radius: 3px;
}

      
      
  </style>
  
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
                          <span class="sub-text">support@trustvestpro.com</span>
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
      <!-- main header @e  -->





      
  


  <div class="nk-content nk-content-lg nk-content-fluid">
    <div class="container-xl wide-lg">
      <div class="nk-content-inner">
        <div class="nk-content-body">
          <div class="nk-block-head text-center">
            <div class="nk-block-head-content">
              <div class="nk-block-head-sub"></div>
              <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">All Transactions</h2>
                <div class="nk-block-des">
                  <p>Approve transactions</p>
                </div>
              </div>
            </div>
          </div><!-- nk-block -->

          <div class="nk-block">

            <div class="card card-bordered">
              <div class="table-responsive--md table-responsive">






                <table class="table style--two">

  <?php if (!empty($transactions)): ?>
    <table class="table style--two">
        <tr>
            <th>Transaction ID</th>
            <th>Username</th>
            <th>Amount</th>
            <th>Transaction Hash</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($transactions as $transaction): ?>
            <?php if ($transaction['status'] !== 'Approved'): ?>
                <tr>
                    <td><?php echo $transaction['transactionID']; ?></td>
                    <td><?php echo $transaction['username']; ?></td>
                    <td><?php echo $transaction['amount']; ?></td>
                    <td><?php echo $transaction['transactionHash']; ?></td>
                    <td><?php echo $transaction['status']; ?></td>
                    <td>
                        <?php if ($transaction['status'] == 'Pending'): ?>
                            <a href="approve_transaction.php?transaction_id=<?php echo $transaction['transactionID']; ?>" class="approve-button">Approve</a>
                            <a href="decline_transaction.php?transaction_id=<?php echo $transaction['transactionID']; ?>" class="decline-button">Decline</a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No transactions found.</p>
<?php endif; ?>



    </table>
</body>
</html>




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
               © 2019 <a href="https://proinvestengine.com">ProinvestEngine</a>. All rights reserved            </div>
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

            <script type="text/javascript">
            "use strict";
            iziToast.success({message:"Oga Welcome back.", position: "topRight"});
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

</body>

</html>
