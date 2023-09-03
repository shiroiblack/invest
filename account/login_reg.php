<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform any necessary validation or authentication logic here
    // For demonstration purposes, we'll just check if the username and password are empty

    $errors = [];

    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // If there are no errors, perform authentication and redirect
    if (empty($errors)) {
// Database credentials
$servername = "server343";
$dbUsername = "truspqek_coin";
$dbPassword = "snakes199323";
$dbname = "truspqek_coin";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbUsername, $dbPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare and execute the SQL query to check user credentials
            $query = "SELECT id, password FROM users WHERE username = :username";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            // Fetch the user record
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if a matching user record is found
            if ($user && password_verify($password, $user['password'])) {
                // Store the user ID in the session (optional but useful for managing user data)
                $_SESSION['user_id'] = $user['id'];

                // Store the username in the session
                $_SESSION['username'] = $username;

                // Redirect the user to the desired page after successful login
                header('Location: dashboard');
                exit();
            } else {
                // Add an error message if the credentials are invalid
                $errors[] = "Invalid username or password.";
            }
        } catch (PDOException $e) {
            // Handle any database connection errors
            $errors[] = "Database connection error: " . $e->getMessage();
        }
    }
}
?>



<head>
   
<div id="google_translate_element"></div> 
      <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'af,sq,am,ar,hy,as,ay,az,eu,bn,bh,bih,br,be,bn,bs,bg,ca,ceb,ny,zh-TW,zh-CN,co,hr,cs,da,dv,nl,en,eo,et,fo,fi,fr,fy,gd,gl,ka,de,el,gn,gu,ht,ha,iw,hmn,hmn,is,ig,io,id,it,ja,jw,jw,kn,ka,ks,ks,km,rw,ky,lo,la,lv,lt,lb,li,ln,lt,lu,mg,ms,ml,mt,mr,mi,mn,mr,ne,ne,nd,nso,no,oc,or,om,ps,fa,pl,pt,pa,qu,ro,ru,sm,sg,sa,sr,sd,st,sd,sn,ii,sd,si,sk,sl,so,es,su,sw,tl,tg,ta,tt,te,kk,th,ti,bo,to,ts,tn,tr,tk,ug,uk,ur,uz,vi,cy,wo,xh,yi,yo,zu', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
  }
</script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="RGr1Fy2cmDxbx0YZVoiIAfRsJjEe8mCmjajlytP3">
  <title>Liontfxasset - Sign In </title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,Liontfxasset,investment">
    <link rel="shortcut icon" href="assets/images/logoIcon/favicon.png" type="image/x-icon">

    
    <link rel="apple-touch-icon" href="assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Liontfxasset - Sign In">
    
    <meta itemprop="name" content="Liontfxasset - Sign In">
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
            <a href="../trade%20fx/content/en-us/welcome.html" class="logo-link">
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
                  <h4 class="nk-block-title">Registration successful! Sign-in </h4>
                  <div class="nk-block-des">
                    <p>Enter your Username and
                      password to access dashboard.
                    </p>
                  </div>
                </div>
              </div>
			  
	
                <form action="login_handler" method="post" class="mt-4" onsubmit="return submitUserForm();">
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
<script src="//code.tidio.co/1pitlmh4lhqgfytpakerk7i3qt0liah2.js" async></script>
  
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
  </script
  </body>
  </html>


