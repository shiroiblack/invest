
<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted email address
    $email = $_POST['email'];

    // Perform any necessary validation or email sending logic here
    // For demonstration purposes, we'll assume the email sending is successful

    // ... Code for sending the password reset email ...

    // Display success message
    $successMessage = "An email has been sent to your recovery email address with instructions on how to reset your password.";
    $_SESSION['success_message'] = $successMessage;
}
?>




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
  <meta name="csrf-token" content="RGr1Fy2cmDxbx0YZVoiIAfRsJjEe8mCmjajlytP3">
  <title>Affliateasset - Sign In </title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,ProinvestEngine,investment">
    <link rel="shortcut icon" href="assets/images/logoIcon/favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="ProinvestEngine - Sign In">
    
    <meta itemprop="name" content="ProinvestEngine - Sign In">
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
                  <h4 class="nk-block-title">Reset Password </h4>
                  <div class="nk-block-des">
                    <p>Password Recovery
                    </p>
                  </div>
                </div>
              </div>
			  
	
              <form action="" method="post" class="mt-4" onsubmit="return submitResetPasswordForm();">
    <input type="hidden" name="_token" value="RGr1Fy2cmDxbx0YZVoiIAfRsJjEe8mCmjajlytP3">
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="email">Email</label>
        </div>
        <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Enter your email address">
    </div>
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">Reset Password</button>
    </div>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success_message']; ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
</form>


              <div class="form-note-s2 text-center pt-4"> New on our platform? <a
                  href="register.php">Create
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
        window.location.href = "https://primevests.com/account/change/" + $(this).val();
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


