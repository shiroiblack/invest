<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_username'])) {
    // Admin is not logged in, redirect to login page
    header('Location: admin_login');
    exit();
}

// Fetch admin data from the database using the logged-in admin's username
$adminUsername = $_SESSION['admin_username'];

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
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to retrieve and return user data as an array
function getUsersData($connection) {
    $userData = array();

    $sql = "SELECT * FROM users";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $userData[] = $row;
        }
    }

    return $userData;
}

// Get the user data
$usersData = getUsersData($connection);
?>






<!-- meta tags and other links -->
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="CvSSyqa9DCQV2mOnssmkgof87FvbXYUPynGDasLU">
  <title>Trustvestpro - Admin panel</title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,liontFxasset,investment">
    <link rel="shortcut icon" href="https://primevests.com/account/assets/images/logoIcon/favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="https://primevests.com/account/assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="liontFxasset - Admin Panel">
    
    <meta itemprop="name" content="liontFxasset - Admin Panel">
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
    
.actions {
    white-space: nowrap;
}

.action-buttons {
    display: inline-block;
}

.action-buttons .btn {
    margin-right: 5px;
}


  </style>
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
                 <!-- .nk-menu-item -->
               <!-- .nk-menu-item -->
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
                    <span class="nk-menu-text">referral</span>
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
                          <span class="sub-text">support@liontFxasset.com</span>
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




      
  


  <div class="nk-content nk-content-lg nk-content-fluid">
    <div class="container-xl wide-lg">
      <div class="nk-content-inner">
        <div class="nk-content-body">
          <div class="nk-block-head text-center">
            <div class="nk-block-head-content">
              <div class="nk-block-head-sub"></div>
              <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">Admin Page</h2>
                <h4 class="nk-block-title fw-normal">Registered User's data</h4>
              
              </div>
            </div>
          </div><!-- nk-block -->

         


             
                

  <!-- Add table to display registered users with Bootstrap classes -->
 <table class="table style--two">
    <thead>
        <tr>
            
            <th>First Name</th>
            <th>Last Name</th>
            <th>Country</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Username</th>
            <th>Account Balance</th>
            <th>Total Earnings</th>
            <th>Total Deposit</th>
            <th>Total Invest</th>
            <th>Total Withdraw</th>
            <th>Interest Wallet</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
    </thead>
   <tbody>
    <?php
    // Call the getUsersData() function to retrieve user data
    $users = getUsersData($connection);

    if (!empty($users)) {
        foreach ($users as $user) {
            echo "<tr>";
            
            echo "<td>" . $user['firstname'] . "</td>";
            echo "<td>" . $user['lastname'] . "</td>";
            echo "<td>" . $user['country'] . "</td>";
            echo "<td>" . $user['mobile'] . "</td>";
            echo "<td>" . $user['email'] . "</td>";
            echo "<td>" . $user['username'] . "</td>";
            echo "<td>" . $user['money'] . "</td>";
            echo "<td>" . $user['interest_wallet_balance'] . "</td>";
            echo "<td>" . $user['total_deposit'] . "</td>";
            echo "<td>" . $user['total_invest'] . "</td>";
            echo "<td>" . $user['total_withdrawal'] . "</td>";
            echo "<td>" . $user['interest_wallet'] . "</td>";
            echo "<td>" . $user['total'] . "</td>";
            echo "<td class='actions'>";
            echo "<div class='action-buttons'>";
            echo "<a href='edit.php?id=" . $user['id'] . "' class='btn btn-warning'>Edit</a>";
            echo "<a href='delete.php?id=" . $user['id'] . "' class='btn btn-danger'>Delete</a>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='17'>No users found</td></tr>";
    }
    // Close the database connection
    mysqli_close($connection);
    ?>
</tbody>
</table>


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
            
            <div class="nk-footer-links">
              <ul class="menu">
								
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
            iziToast.success({message:"Scroll right to see the Edit buttons.", position: "topRight"});
        </script>
<script src="iziToast.min.js"></script>

            <script type="text/javascript">
            "use strict";
            iziToast.success({message:"Welcome Back Oga kpatata.", position: "topRight"});
        </script>
    
<script>
 
    
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
