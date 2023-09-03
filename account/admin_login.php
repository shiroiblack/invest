<?php
// admin_login.php

//session_start();

// Check if the admin is already logged in
if (isset($_SESSION['admin_username'])) {
  // Admin is already logged in, redirect to admin panel
  header('Location: admin.php');
  exit();
}

// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted username and password
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Perform authentication (replace with your own authentication logic)
  if ($username === 'admin' && $password === 'snakes199323') {
    // Successful login, store admin username in session and redirect to admin panel
    $_SESSION['admin_username'] = $username;
    header('Location: admin.php');
    exit();
  } else {
    // Invalid credentials, show error message
    $error = 'Invalid username or password.';
  }
}
?>





<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="RGr1Fy2cmDxbx0YZVoiIAfRsJjEe8mCmjajlytP3">
  <title>Trustvestpro - Sign In </title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,liontFxasset,investment">
    <link rel="shortcut icon" href="assets/images/logoIcon/favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="liontFxasset - Sign In">
    
    <meta itemprop="name" content="liontFxasset - Sign In">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="assets/images/seo/63cc7c80269ff1674345600.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="SEEDGATE- Alternative Investment option">
    <meta property="og:description" content="Introducing the first marketplace for investing in real estate debt and metaverse properties. Now you can invest in the loans made to borrowers(real estate agencies), and as they pay back their loans, you make money.And also co-own properties in the metaverse and NFTs.">
    <meta property="og:image" content="assets/images/seo/63cc7c80269ff1674345600.png"/>
    <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:url" content="login.html">
    
    <meta name="twitter:card" content="summary_large_image">

  
  <link rel="stylesheet" href="assets/templates/dashlite/css/dashlite.css">
  <link rel="stylesheet" href="assets/templates/dashlite/css/theme.css">
  
<style>
    .bg{background-color:#021e43;}
</style>

  </head>
<body class="nk-body bg">
  <div class="nk-app-root">
  <div class="nk-main ">
    <!-- wrap @s  -->
    <div class="nk-wrap nk-wrap-nosidebar">
      <!-- content @s  -->
      <div class="nk-content ">
        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
          <div class="brand-logo pb-4 text-center">
            <a href="../index.html" class="logo-link">
              <img class="logo-light logo-img logo-img-lg"
                src="logo.png"
                srcset="logo.png 2x" alt="logo">
              <img class="logo-dark logo-img logo-img-lg"
                src="logo.png"
                srcset="logo.png 2x" alt="logo-dark">
            </a>
          </div>
          <div class="card card-bordered">
            <div class="card-inner card-inner-lg">
              <div class="nk-block-head">
                <div class="nk-block-head-content">
                  <h4 class="nk-block-title">Admin Sign-in </h4>
                  <div class="nk-block-des">
                    <p>Enter your Username and
                      password to access dashboard.
                    </p>
                  </div>
                </div>
              </div>
			  
	
                <form action="admin_login_handler.php" method="post" class="mt-4" onsubmit="return submitUserForm();">
    <input type="hidden" name="_token" value="RGr1Fy2cmDxbx0YZVoiIAfRsJjEe8mCmjajlytP3">
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="default-01">Username</label>
        </div>
        <input type="text" name="username" class="form-control form-control-lg" id="default-01" placeholder="Enter your username">
    </div>
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="password">Password</label>
            <a class="link link-primary link-sm" href="password/reset.html">Forgot Password?</a>
        </div>
        <div class="form-control-wrap">
            <a href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Enter your password">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
</form>


              <div class="form-note-s2 text-center pt-4"> New on our platform? <a
                  href="register.html">Create
                  an account</a>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- wrap @e  -->
    </div>
    <!-- content @e  -->
  </div>


 
  <script src="assets/templates/dashlite/js/bundle8d5a.js?ver=2.4.0"></script>
  <script src="assets/templates/dashlite/js/scripts8d5a.js?ver=2.4.0"></script>


  <link rel="stylesheet" href="assets/templates/dashlite/css/iziToast.min.css">
<script src="assets/templates/dashlite/js/iziToast.min.js"></script>


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
        window.location.href = "https://liontFxasset.com/account/change/" + $(this).val();
      });

      $('.policy').on('click', function() {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.get('cookie/accept.json', function(response) {
          iziToast.success({
            message: response,
            position: "topRight"
          });
          $('.cookie__wrapper').addClass('d-none');
        });
      });
    })();
  </script>


