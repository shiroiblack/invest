





<?php
session_start(); // Start the session
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define an array of countries with their respective values
$countries = array(
    "Afghanistan" => "AF",
    "Albania" => "AL",
    "Algeria" => "DZ",
    "Andorra" => "AD",
    "Angola" => "AO",
    "Antigua and Barbuda" => "AG",
    "Argentina" => "AR",
    "Armenia" => "AM",
    "Australia" => "AU",
    "Austria" => "AT",
    "Azerbaijan" => "AZ",
    "Bahamas" => "BS",
    "Bahrain" => "BH",
    "Bangladesh" => "BD",
    "Barbados" => "BB",
    "Belarus" => "BY",
    "Belgium" => "BE",
    "Belize" => "BZ",
    "Benin" => "BJ",
    "Bhutan" => "BT",
    "Bolivia" => "BO",
    "Bosnia and Herzegovina" => "BA",
    "Botswana" => "BW",
    "Brazil" => "BR",
    "Brunei" => "BN",
    "Bulgaria" => "BG",
    "Burkina Faso" => "BF",
    "Burundi" => "BI",
    "Cabo Verde" => "CV",
    "Cambodia" => "KH",
    "Cameroon" => "CM",
    "Canada" => "CA",
    "Central African Republic" => "CF",
    "Chad" => "TD",
    "Chile" => "CL",
    "China" => "CN",
    "Colombia" => "CO",
    "Comoros" => "KM",
    "Congo, Democratic Republic of the" => "CD",
    "Congo, Republic of the" => "CG",
    "Costa Rica" => "CR",
    "Côte d'Ivoire" => "CI",
    "Croatia" => "HR",
    "Cuba" => "CU",
    "Cyprus" => "CY",
    "Czech Republic" => "CZ",
    "Denmark" => "DK",
    "Djibouti" => "DJ",
    "Dominica" => "DM",
    "Dominican Republic" => "DO",
    "East Timor" => "TL",
    "Ecuador" => "EC",
    "Egypt" => "EG",
    "El Salvador" => "SV",
    "Equatorial Guinea" => "GQ",
    "Eritrea" => "ER",
    "Estonia" => "EE",
    "Eswatini" => "SZ",
    "Ethiopia" => "ET",
    "Fiji" => "FJ",
    "Finland" => "FI",
    "France" => "FR",
    "Gabon" => "GA",
    "Gambia" => "GM",
    "Georgia" => "GE",
    "Germany" => "DE",
    "Ghana" => "GH",
    "Greece" => "GR",
    "Grenada" => "GD",
    "Guatemala" => "GT",
    "Guinea" => "GN",
    "Guinea-Bissau" => "GW",
    "Guyana" => "GY",
    "Haiti" => "HT",
    "Honduras" => "HN",
    "Hungary" => "HU",
    "Iceland" => "IS",
    "India" => "IN",
    "Indonesia" => "ID",
    "Iran" => "IR",
    "Iraq" => "IQ",
    "Ireland" => "IE",
    "Israel" => "IL",
    "Italy" => "IT",
    "Jamaica" => "JM",
    "Japan" => "JP",
    "Jordan" => "JO",
    "Kazakhstan" => "KZ",
    "Kenya" => "KE",
    "Kiribati" => "KI",
    "Korea, North" => "KP",
    "Korea, South" => "KR",
    "Kosovo" => "XK",
    "Kuwait" => "KW",
    "Kyrgyzstan" => "KG",
    "Laos" => "LA",
    "Latvia" => "LV",
    "Lebanon" => "LB",
    "Lesotho" => "LS",
    "Liberia" => "LR",
    "Libya" => "LY",
    "Liechtenstein" => "LI",
    "Lithuania" => "LT",
    "Luxembourg" => "LU",
    "Madagascar" => "MG",
    "Malawi" => "MW",
    "Malaysia" => "MY",
    "Maldives" => "MV",
    "Mali" => "ML",
    "Malta" => "MT",
    "Marshall Islands" => "MH",
    "Mauritania" => "MR",
    "Mauritius" => "MU",
    "Mexico" => "MX",
    "Micronesia" => "FM",
    "Moldova" => "MD",
    "Monaco" => "MC",
    "Mongolia" => "MN",
    "Montenegro" => "ME",
    "Morocco" => "MA",
    "Mozambique" => "MZ",
    "Myanmar" => "MM",
    "Namibia" => "NA",
    "Nauru" => "NR",
    "Nepal" => "NP",
    "Netherlands" => "NL",
    "New Zealand" => "NZ",
    "Nicaragua" => "NI",
    "Niger" => "NE",
    "Nigeria" => "NG",
    "North Macedonia" => "MK",
    "Norway" => "NO",
    "Oman" => "OM",
    "Pakistan" => "PK",
    "Palau" => "PW",
    "Panama" => "PA",
    "Papua New Guinea" => "PG",
    "Paraguay" => "PY",
    "Peru" => "PE",
    "Philippines" => "PH",
    "Poland" => "PL",
    "Portugal" => "PT",
    "Qatar" => "QA",
    "Romania" => "RO",
    "Russia" => "RU",
    "Rwanda" => "RW",
    "Saint Kitts and Nevis" => "KN",
    "Saint Lucia" => "LC",
    "Saint Vincent and the Grenadines" => "VC",
    "Samoa" => "WS",
    "San Marino" => "SM",
    "Sao Tome and Principe" => "ST",
    "Saudi Arabia" => "SA",
    "Senegal" => "SN",
    "Serbia" => "RS",
    "Seychelles" => "SC",
    "Sierra Leone" => "SL",
    "Singapore" => "SG",
    "Slovakia" => "SK",
    "Slovenia" => "SI",
    "Solomon Islands" => "SB",
    "Somalia" => "SO",
    "South Africa" => "ZA",
    "South Sudan" => "SS",
    "Spain" => "ES",
    "Sri Lanka" => "LK",
    "Sudan" => "SD",
    "Suriname" => "SR",
    "Sweden" => "SE",
    "Switzerland" => "CH",
    "Syria" => "SY",
    "Taiwan" => "TW",
    "Tajikistan" => "TJ",
    "Tanzania" => "TZ",
    "Thailand" => "TH",
    "Togo" => "TG",
    "Tonga" => "TO",
    "Trinidad and Tobago" => "TT",
    "Tunisia" => "TN",
    "Turkey" => "TR",
    "Turkmenistan" => "TM",
    "Tuvalu" => "TV",
    "Uganda" => "UG",
    "Ukraine" => "UA",
    "United Arab Emirates" => "AE",
    "United Kingdom" => "GB",
    "United States" => "US",
    "Uruguay" => "UY",
    "Uzbekistan" => "UZ",
    "Vanuatu" => "VU",
    "Vatican City" => "VA",
    "Venezuela" => "VE",
    "Vietnam" => "VN",
    "Yemen" => "YE",
    "Zambia" => "ZM",
    "Zimbabwe" => "ZW"
);


//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// Database credentials
$servername = "server343";
$dbUsername = "truspqek_coin";
$dbPassword = "snakes199323";
$dbname = "truspqek_coin";

// Create a new PDO instance
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbUsername, $dbPassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



// Check if the referrer query parameter is set
if (isset($_GET['referrer'])) {
    // Store the referrer's username in a session variable
    $_SESSION['referrer'] = $_GET['referrer'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $country = $_POST['country'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];
    $terms = isset($_POST['terms']) ? $_POST['terms'] : '';

    // Perform validation on the form data
    $errors = [];

    // Validate first name
    if (empty($firstname)) {
        $errors[] = "First name is required.";
    }

    // Validate last name
    if (empty($lastname)) {
        $errors[] = "Last name is required.";
    }

    // Validate country
    if (empty($country)) {
        $errors[] = "Country is required.";
    }

    // Validate mobile
    if (empty($mobile)) {
        $errors[] = "Mobile number is required.";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required.";
    } else {
        // Check for duplicate username
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $errors[] = "Username is already taken. Please choose a different username.";
        }
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif ($password !== $password_confirmation) {
        $errors[] = "Passwords do not match.";
    }

    // If there are no errors, process the form data
    if (empty($errors)) {
        try {
            // Prepare the SQL statement
            $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, country, mobile, email, username, password, terms, referrer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Bind the parameters
            $stmt->bindParam(1, $firstname);
            $stmt->bindParam(2, $lastname);
            $stmt->bindParam(3, $country);
            $stmt->bindParam(4, $mobile);
            $stmt->bindParam(5, $email);
            $stmt->bindParam(6, $username);
            
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Bind the hashed password
            $stmt->bindParam(7, $hashedPassword);

            $stmt->bindParam(8, $terms);

            // Check if the referrer parameter exists in the URL
            if (isset($_GET['referrer'])) {
                // Store the referrer's username in the session variable
                $_SESSION['referrer'] = $_GET['referrer'];
            }

            // Get the referrer from the session
            $referrer = isset($_SESSION['referrer']) ? $_SESSION['referrer'] : null;

            // Bind the referrer parameter
            $stmt->bindParam(9, $referrer);

            // Execute the statement
            $stmt->execute();

            // Get the last inserted user ID
            $lastInsertedUserId = $pdo->lastInsertId();

            // Update the demo_trade_money column for the newly inserted user
            $creditAmount = 10000;
            $updateStmt = $pdo->prepare("UPDATE users SET demo_trade_money = demo_trade_money + ? WHERE id = ?");
            $updateStmt->execute([$creditAmount, $lastInsertedUserId]);

            // Clear the referrer from the session
            unset($_SESSION['referrer']);

            // Update the referral table if a referrer exists
            if (!empty($referrer)) {
                // Prepare the SQL statement to insert referral data
                $insertReferralStmt = $pdo->prepare("INSERT INTO referral (referrer_username, referred_username, earnings, created_at) VALUES (?, ?, ?, NOW())");

                // Bind the parameters for referral data insertion
                $insertReferralStmt->bindParam(1, $referrer);
                $insertReferralStmt->bindParam(2, $username);
                $insertReferralStmt->bindValue(3, 0.00);

                // Execute the referral data insertion statement
                $insertReferralStmt->execute();
            }

            // Redirect to a success page
            header("Location:login_reg");
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
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
  <title>Trustvestpro - Sign Up</title>
    <meta name="description" content="become a private lender on SeedGate and make huge returns for the rest of the year investing in real estate and Metaverse.">
    <meta name="keywords" content="TRADING,MAKING MONEY,NFTs,Metaverse,Trustvestpro,investment">
    <link rel="shortcut icon" href="assets/images/logoIcon/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="apple-touch-icon" href="assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Liontfxasset - Sign Up">
    
    <meta itemprop="name" content="TrustvestPro - Sign Up">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="assets/images/seo/63cc7c80269ff1674345600.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="SEEDGATE- Alternative Investment option">
    <meta property="og:description" content="Introducing the first marketplace for investing in real estate debt and metaverse properties. Now you can invest in the loans made to borrowers(real estate agencies), and as they pay back their loans, you make money.And also co-own properties in the metaverse and NFTs.">
    <meta property="og:image" content="assets/images/seo/63cc7c80269ff1674345600.png"/>
    <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:url" content="register.html">
    
    <meta name="twitter:card" content="summary_large_image">

  
  <link rel="stylesheet" href="assets/templates/dashlite/css/dashlite.css">
  <link rel="stylesheet" href="assets/templates/dashlite/css/theme.css">
  
<style>
	 .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    .bg{background-color:#021e43;}
</style>

  </head>
 <div class="nk-main bg ">
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
                  <h4 class="nk-block-title">Sign-Up</h4>
                  <div class="nk-block-des">
                   
               
                  </div>
                </div>
              </div>
 

<!-- The HTML form -->


<!-- The HTML form -->

<!-- The HTML form -->



<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-4" method="post">
    <!-- The HTML form -->

    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="firstname">First Name</label>
        </div>
        <input type="text" name="firstname" id="firstname" class="form-control" required autofocus>
    </div>

    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="lastname">Last Name</label>
        </div>
        <input type="text" name="lastname" id="lastname" class="form-control" required>
    </div>

    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="country">Country</label>
        </div>
        <select name="country" id="country" class="form-control">
            <?php foreach ($countries as $countryName => $countryValue) { ?>
                <option value="<?php echo $countryValue; ?>"><?php echo $countryName; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="mobile">Mobile</label>
        </div>
        <input type="text" name="mobile" id="mobile" class="form-control" required>
    </div>

    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="email">Email Address</label>
        </div>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="referrer">Referrer</label>
        </div>
        <input type="text" name="referrer" id="referrer" class="form-control" value="<?php echo isset($_SESSION['referrer']) ? $_SESSION['referrer'] : ''; ?>" readonly>
    </div>

    <div class="form-group">
    <div class="form-label-group">
        <label class="form-label" for="username">Username</label>
    </div>
    <input type="text" name="username" id="username" class="form-control" required>
    <?php if (!empty($errors) && in_array('username_taken', $errors)) { ?>
        <p class="error-message">Username already taken</p>
    <?php } ?>
</div>

    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="password">Password</label>
        </div>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="password_confirmation">Confirm Password</label>
        </div>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    </div>

    <div class="form-group">
        <div class="form-check">
            <input type="checkbox" name="terms" id="terms" class="form-check-input">
            <label class="form-check-label" for="terms">I agree to the terms and conditions</label>
        </div>
    </div>

    <?php if (!empty($errors)) { ?>
        <!-- Error messages -->
        <div class="error-container">
            <?php foreach ($errors as $error) { ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block" onclick="showConfirmation()">Sign up</button>
    </div>
</form>

<style>
    .error-message {
        color: red;
    }
</style>


<!-- Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Registration Form Submitted</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Your registration form has been submitted. Please wait while our admin reviews your application.</p>
                <p>This process can take from 10 minutes to an hour.</p>
                <p>Thank you for choosing Liontfxasset.</p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    function showConfirmation() {
        $('#confirmationModal').modal('show');
        setTimeout(function() {
            $('#confirmationModal').modal('hide');
            window.location.href = "login_reg";
        }, 60000);
    }

    
</script>














            </div>

            <div class="form-note-s2 text-center pt-4"> Already have an account? <a
                href="login.php"style="color:#fcae04">Sign in</a>
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
    "use strict";
          $(`option[data-code=NG]`).attr('selected','');
    
    $('select[name=country]').change(function() {
      $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
      $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
    });
    $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
    $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));

    function submitUserForm() {
      var response = grecaptcha.getResponse();
      if (response.length == 0) {
        document.getElementById('g-recaptcha-error').innerHTML =
          '<span style="color:red;">Captcha field is required.</span>';
        return false;
      }
      return true;
    }

    function verifyCaptcha() {
      document.getElementById('g-recaptcha-error').innerHTML = '';
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Input field for username
    var usernameInput = $('#username');

    // Error message container
    var errorContainer = $('.error-container');

    // Check username availability on input change
    usernameInput.on('input', function() {
        var username = usernameInput.val();

        // Clear previous error messages
        errorContainer.empty();

        // Make an AJAX request to check username availability
        $.ajax({
            url: 'check_username.php', // Replace with the URL of your PHP script to check username availability
            method: 'POST',
            data: { username: username },
            dataType: 'json',
            success: function(response) {
                if (response.available) {
                    // Username is available
                    usernameInput.removeClass('error');
                } else {
                    // Username is already taken
                    usernameInput.addClass('error');
                    errorContainer.html('<p class="error-message">Username already taken</p>');
                }
            }
        });
    });
});
</script>

</head>
</html>
