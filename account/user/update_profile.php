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

// Specify the directory where the images should be saved
$uploadDirectory = 'uploads/';

// Check if the upload directory exists, create it if not
if (!is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, 0755, true);
}

// Retrieve user information
$username = $_SESSION['username'];
//$money = $_SESSION['money'];

// Retrieve existing user details from the database
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($connection, $query);
$userData = mysqli_fetch_assoc($result);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted values
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];

    // Update the user's details in the database
    $updateQuery = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', address = '$address', state = '$state', zip = '$zip', city = '$city' WHERE username = '$username'";
    mysqli_query($connection, $updateQuery);

    // Check if an image file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tempFilePath = $_FILES['image']['tmp_name'];
        $newFilePath = $uploadDirectory . $_FILES['image']['name'];
        move_uploaded_file($tempFilePath, $newFilePath);

        // Update the user's avatar in the database
        $avatar = $newFilePath;
        $updateAvatarQuery = "UPDATE users SET avatar = '$avatar' WHERE username = '$username'";
        mysqli_query($connection, $updateAvatarQuery);
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Process the form submission and update the user details

        // Set $updateSuccessful to true if the update is successful
        $updateSuccessful = true;

        // Example code to update user details in the database
        // Replace this with your own logic
        if ($updateSuccessful) {
            $successMessage = "Profile updated successfully.";
        } else {
            $errorMessage = "Profile update failed.";
        }
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
   
<div id="google_translate_element"></div> 
      <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ar,de,es,fr,it,ja,ko,ru,zh-CN,zh-TW', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
  }
</script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
<script>
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
  <meta name="csrf-token" content="EpA8f7Gx3Ge4XPgJ7ZpD6I0lpqmvArzFQwNKAhC9">
  <title>Trustvestpro - Profile Setting</title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,liontFxasset,investment">
    <link rel="shortcut icon" href="https://Trustvestpro.cc/account/assets/images/logoIcon/favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="https://Trustvestpro.cc/account/assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Trustvestpro - Profile Setting">
    
    <meta itemprop="name" content="Trustvestpro - Profile Setting">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="SEEDGATE- Alternative Investment option">
    <meta property="og:description" content="Introducing the first marketplace for investing in real estate debt and metaverse properties. Now you can invest in the loans made to borrowers(real estate agencies), and as they pay back their loans, you make money.And also co-own properties in the metaverse and NFTs.">
    <meta property="og:image" content="https://primevests.com/account/assets/images/seo/63cc7c80269ff1674345600.png"/>
    <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:url" content="https://Trustvestpro.cc/account/user/profile-setting">
    
    <meta name="twitter:card" content="summary_large_image">
  <!-- bootstrap 4  -->

  
  
  <link rel="stylesheet" href="../dashlite.css">
  <link rel="stylesheet" href="../theme.css">
  

    <style type="text/css">
    .avatar-upload {
      position: relative;
      max-width: 205px;
      margin: 20px auto;
    }

    .avatar-upload .avatar-edit {
      position: absolute;
      z-index: 1;
      bottom: 0px;
      right: 31px;
    }

    .avatar-upload .avatar-edit input {
      display: none;
    }

    .avatar-upload .avatar-edit label {
      display: inline-block;
      width: 34px;
      height: 34px;
      margin-bottom: 0;
      border-radius: 100%;
      background: #FFFFFF;
      border: 1px solid transparent;
      box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
      cursor: pointer;
      font-weight: normal;
      transition: all .2s ease-in-out;
    }

    .avatar-upload .avatar-edit label:hover {
      background: #F1F1F1;
      border-color: #D6D6D6;
    }

    /* .avatar-upload .avatar-edit label:after {
                          content: "\f044";
                          font-family: 'Font Awesome 5 Free';
                          color: #757575;
                          position: absolute;
                          top: 5px;
                          left: 1px;
                          right: 0;
                          text-align: center;
                          margin: auto;
                        } */

    .avatar-preview {
      width: 192px;
      height: 192px;
      position: relative;
      border-radius: 50%;
      border: 6px solid #e4e4e4;
      box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .avatar-preview div {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }

    .copytextDiv {
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
  <img class="logo-light logo-img" src="logo.png" alt="logo">
  <img class="logo-dark logo-img" src="logo.png" alt="logo-dark">
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
                          <span class="sub-text"><?php echo $userData['email']; ?></span>
                        </div>
                        <div class="user-action">
                          <a class="btn btn-icon mr-n2" href="update_profile"><em
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
                          <a href="update_profile">
                            <em class="icon ni ni-user-alt"></em>Profile Setting                          </a>
                        </li>
                                                <li>
                          <a href="changepass">
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
                <h2 class="nk-block-title fw-normal">Profile Setting</h2>
              </div>
            </div>
          </div><!-- nk-block -->
          <div class="nk-block">


            <div class="card card-bordered">
              <?php if (isset($successMessage)): ?>
        <div class="success-message"></div>
    <?php endif; ?>

    <h2>Update User Details</h2>

   <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="EpA8f7Gx3Ge4XPgJ7ZpD6I0lpqmvArzFQwNKAhC9">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="avatar-upload">
            <div class="avatar-edit">
                <input type='file' name="image" id="imageUpload" class="upload" accept=".png, .jpg, .jpeg" />
                <label for="imageUpload" class="imgUp d-flex justify-content-center align-items-center"><em class="icon ni ni-upload"></em></label>
            </div>
            <div class="avatar-preview">
                
<div class="imagePreview" style="background-image: url('<?php echo $userData['avatar']; ?>')"></div>

            </div>
        </div>

                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="firstname" class="form-control form-control-lg" placeholder="First Name" value="<?php echo $userData['firstname']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lastname" class="form-control form-control-lg" placeholder="Last Name" value="<?php echo $userData['lastname']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" value="<?php echo $userData['username']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control form-control-lg" placeholder="Email" value="<?php echo $userData['email']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="mobile" class="form-control form-control-lg" placeholder="Mobile" value="<?php echo $userData['mobile']; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" class="form-control" value="<?php echo $userData['country']; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control form-control-lg" placeholder="Address" value="<?php echo $userData['address']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" name="state" class="form-control form-control-lg" placeholder="State" value="<?php echo $userData['state']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Zip</label>
                                <input type="text" name="zip" class="form-control form-control-lg" placeholder="Zip" value="<?php echo $userData['zip']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control form-control-lg" placeholder="City" value="<?php echo $userData['city']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary btn-lg">Update</button>
        </div>
    </form>
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
    (function($) {
      "use strict";
      $('.imgUp').click(function() {
        upload();
      });

      function upload() {
        $(".upload").change(function() {
          readURL(this);
        });
      }

      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            var preview = $(input).parents('.avatar-upload').find('.imagePreview');
            $(preview).css('background-image', 'url(' + e.target.result + ')');
            $(preview).hide();
            $(preview).fadeIn(650);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $('select[name=country]').val('Nigeria');
    })(jQuery);
  </script>

  <script>
    (function() {
      "use strict";
      $(document).on("change", ".langSel", function() {
        window.location.href = "https://affliateasset.com/account/change/" + $(this).val();
      });
    })();
  </script>
<script src="//code.tidio.co/1pitlmh4lhqgfytpakerk7i3qt0liah2.js" async></script>
</body>

</html>
