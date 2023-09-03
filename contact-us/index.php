<?php
$submissionStatus = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $username = $_POST['your-name'];
    $email = $_POST['your-email'];
    $subject = $_POST['your-subject'];
    $message = $_POST['your-message'];

    // Send the email notification
    $to = "support@Trustvestpro.cc";
    $emailSubject = "Contact Form Submission: $subject";
    $emailMessage = "Name: $username\n\nEmail: $email\n\nMessage: $message";
    $headers = "From: $email";

    // Attempt to send the email
    if (mail($to, $emailSubject, $emailMessage, $headers)) {
        // Email sent successfully
        $submissionStatus = "Email sent successfully. Thank you for your message!";
    } else {
        // Error sending email
        $submissionStatus = "Error sending email. Please try again later.";
    }
}
?>




<!DOCTYPE html>
<html lang="en-US">

<!-- Mirrored from primevests.com/contact-us/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 May 2023 20:28:08 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="UTF-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="../xmlrpc.php" />

		<link rel="shortcut icon" href="../wp-content/uploads/2023/01/Screenshot_2023-01-21_at_18-51-46_Logopony-removebg-preview1.png" type="image/x-icon" />
		<link rel="apple-touch-icon" href="../wp-content/uploads/2023/01/Screenshot_2023-01-21_at_18-51-46_Logopony-removebg-preview1.png">
		<link rel="apple-touch-icon" sizes="120x120" href="../wp-content/uploads/2023/01/Screenshot_2023-01-21_at_18-51-46_Logopony-removebg-preview1.png">
		<link rel="apple-touch-icon" sizes="76x76" href="../wp-content/uploads/2023/01/Screenshot_2023-01-21_at_18-51-46_Logopony-removebg-preview1.png">
		<link rel="apple-touch-icon" sizes="152x152" href="../wp-content/uploads/2023/01/Screenshot_2023-01-21_at_18-51-46_Logopony-removebg-preview1.png">
	<title>Contact Us &#8211; Trustvestpro</title>
<meta name='robots' content='max-image-preview:large' />
<link rel="alternate" type="application/rss+xml" title="Primevest &raquo; Feed" href="../feed/index.html" />
<link rel="alternate" type="application/rss+xml" title="Primevest &raquo; Comments Feed" href="../comments/feed/index.html" />

<style>
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 0.07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
	<link rel='stylesheet' id='wp-block-library-css' href='../wp-includes/css/dist/block-library/style.min6fb3.css?ver=6.1.3' media='all' />
<style id='wp-block-library-theme-inline-css'>
.wp-block-audio figcaption{color:#555;font-size:13px;text-align:center}.is-dark-theme .wp-block-audio figcaption{color:hsla(0,0%,100%,.65)}.wp-block-audio{margin:0 0 1em}.wp-block-code{border:1px solid #ccc;border-radius:4px;font-family:Menlo,Consolas,monaco,monospace;padding:.8em 1em}.wp-block-embed figcaption{color:#555;font-size:13px;text-align:center}.is-dark-theme .wp-block-embed figcaption{color:hsla(0,0%,100%,.65)}.wp-block-embed{margin:0 0 1em}.blocks-gallery-caption{color:#555;font-size:13px;text-align:center}.is-dark-theme .blocks-gallery-caption{color:hsla(0,0%,100%,.65)}.wp-block-image figcaption{color:#555;font-size:13px;text-align:center}.is-dark-theme .wp-block-image figcaption{color:hsla(0,0%,100%,.65)}.wp-block-image{margin:0 0 1em}.wp-block-pullquote{border-top:4px solid;border-bottom:4px solid;margin-bottom:1.75em;color:currentColor}.wp-block-pullquote__citation,.wp-block-pullquote cite,.wp-block-pullquote footer{color:currentColor;text-transform:uppercase;font-size:.8125em;font-style:normal}.wp-block-quote{border-left:.25em solid;margin:0 0 1.75em;padding-left:1em}.wp-block-quote cite,.wp-block-quote footer{color:currentColor;font-size:.8125em;position:relative;font-style:normal}.wp-block-quote.has-text-align-right{border-left:none;border-right:.25em solid;padding-left:0;padding-right:1em}.wp-block-quote.has-text-align-center{border:none;padding-left:0}.wp-block-quote.is-large,.wp-block-quote.is-style-large,.wp-block-quote.is-style-plain{border:none}.wp-block-search .wp-block-search__label{font-weight:700}.wp-block-search__button{border:1px solid #ccc;padding:.375em .625em}:where(.wp-block-group.has-background){padding:1.25em 2.375em}.wp-block-separator.has-css-opacity{opacity:.4}.wp-block-separator{border:none;border-bottom:2px solid;margin-left:auto;margin-right:auto}.wp-block-separator.has-alpha-channel-opacity{opacity:1}.wp-block-separator:not(.is-style-wide):not(.is-style-dots){width:100px}.wp-block-separator.has-background:not(.is-style-dots){border-bottom:none;height:1px}.wp-block-separator.has-background:not(.is-style-wide):not(.is-style-dots){height:2px}.wp-block-table{margin:"0 0 1em 0"}.wp-block-table thead{border-bottom:3px solid}.wp-block-table tfoot{border-top:3px solid}.wp-block-table td,.wp-block-table th{word-break:normal}.wp-block-table figcaption{color:#555;font-size:13px;text-align:center}.is-dark-theme .wp-block-table figcaption{color:hsla(0,0%,100%,.65)}.wp-block-video figcaption{color:#555;font-size:13px;text-align:center}.is-dark-theme .wp-block-video figcaption{color:hsla(0,0%,100%,.65)}.wp-block-video{margin:0 0 1em}.wp-block-template-part.has-background{padding:1.25em 2.375em;margin-top:0;margin-bottom:0}
</style>
<link rel='stylesheet' id='wc-blocks-vendors-style-css' href='../wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/wc-blocks-vendors-style13cb.css?ver=9.1.5' media='all' />
<link rel='stylesheet' id='wc-blocks-style-css' href='../wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/wc-blocks-style13cb.css?ver=9.1.5' media='all' />
<link rel='stylesheet' id='classic-theme-styles-css' href='../wp-includes/css/classic-themes.min68b3.css?ver=1' media='all' />
<style id='global-styles-inline-css'>
body{--wp--preset--color--black: #000000;--wp--preset--color--cyan-bluish-gray: #abb8c3;--wp--preset--color--white: #ffffff;--wp--preset--color--pale-pink: #f78da7;--wp--preset--color--vivid-red: #cf2e2e;--wp--preset--color--luminous-vivid-orange: #ff6900;--wp--preset--color--luminous-vivid-amber: #fcb900;--wp--preset--color--light-green-cyan: #7bdcb5;--wp--preset--color--vivid-green-cyan: #00d084;--wp--preset--color--pale-cyan-blue: #8ed1fc;--wp--preset--color--vivid-cyan-blue: #0693e3;--wp--preset--color--vivid-purple: #9b51e0;--wp--preset--color--primary: #0053ce;--wp--preset--color--secondary: #fbe91b;--wp--preset--color--tertiary: #2baab1;--wp--preset--color--quaternary: #383f48;--wp--preset--color--dark: #212529;--wp--preset--color--light: #ffffff;--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%);--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%);--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%);--wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg,rgba(255,105,0,1) 0%,rgb(207,46,46) 100%);--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg,rgb(238,238,238) 0%,rgb(169,184,195) 100%);--wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg,rgb(74,234,220) 0%,rgb(151,120,209) 20%,rgb(207,42,186) 40%,rgb(238,44,130) 60%,rgb(251,105,98) 80%,rgb(254,248,76) 100%);--wp--preset--gradient--blush-light-purple: linear-gradient(135deg,rgb(255,206,236) 0%,rgb(152,150,240) 100%);--wp--preset--gradient--blush-bordeaux: linear-gradient(135deg,rgb(254,205,165) 0%,rgb(254,45,45) 50%,rgb(107,0,62) 100%);--wp--preset--gradient--luminous-dusk: linear-gradient(135deg,rgb(255,203,112) 0%,rgb(199,81,192) 50%,rgb(65,88,208) 100%);--wp--preset--gradient--pale-ocean: linear-gradient(135deg,rgb(255,245,203) 0%,rgb(182,227,212) 50%,rgb(51,167,181) 100%);--wp--preset--gradient--electric-grass: linear-gradient(135deg,rgb(202,248,128) 0%,rgb(113,206,126) 100%);--wp--preset--gradient--midnight: linear-gradient(135deg,rgb(2,3,129) 0%,rgb(40,116,252) 100%);--wp--preset--duotone--dark-grayscale: url('#wp-duotone-dark-grayscale');--wp--preset--duotone--grayscale: url('#wp-duotone-grayscale');--wp--preset--duotone--purple-yellow: url('#wp-duotone-purple-yellow');--wp--preset--duotone--blue-red: url('#wp-duotone-blue-red');--wp--preset--duotone--midnight: url('#wp-duotone-midnight');--wp--preset--duotone--magenta-yellow: url('#wp-duotone-magenta-yellow');--wp--preset--duotone--purple-green: url('#wp-duotone-purple-green');--wp--preset--duotone--blue-orange: url('#wp-duotone-blue-orange');--wp--preset--font-size--small: 13px;--wp--preset--font-size--medium: 20px;--wp--preset--font-size--large: 36px;--wp--preset--font-size--x-large: 42px;--wp--preset--spacing--20: 0.44rem;--wp--preset--spacing--30: 0.67rem;--wp--preset--spacing--40: 1rem;--wp--preset--spacing--50: 1.5rem;--wp--preset--spacing--60: 2.25rem;--wp--preset--spacing--70: 3.38rem;--wp--preset--spacing--80: 5.06rem;}:where(.is-layout-flex){gap: 0.5em;}body .is-layout-flow > .alignleft{float: left;margin-inline-start: 0;margin-inline-end: 2em;}body .is-layout-flow > .alignright{float: right;margin-inline-start: 2em;margin-inline-end: 0;}body .is-layout-flow > .aligncenter{margin-left: auto !important;margin-right: auto !important;}body .is-layout-constrained > .alignleft{float: left;margin-inline-start: 0;margin-inline-end: 2em;}body .is-layout-constrained > .alignright{float: right;margin-inline-start: 2em;margin-inline-end: 0;}body .is-layout-constrained > .aligncenter{margin-left: auto !important;margin-right: auto !important;}body .is-layout-constrained > :where(:not(.alignleft):not(.alignright):not(.alignfull)){max-width: var(--wp--style--global--content-size);margin-left: auto !important;margin-right: auto !important;}body .is-layout-constrained > .alignwide{max-width: var(--wp--style--global--wide-size);}body .is-layout-flex{display: flex;}body .is-layout-flex{flex-wrap: wrap;align-items: center;}body .is-layout-flex > *{margin: 0;}:where(.wp-block-columns.is-layout-flex){gap: 2em;}.has-black-color{color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-color{color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-color{color: var(--wp--preset--color--white) !important;}.has-pale-pink-color{color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-color{color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-color{color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-color{color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-color{color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-color{color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-color{color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-color{color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-color{color: var(--wp--preset--color--vivid-purple) !important;}.has-black-background-color{background-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-background-color{background-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-background-color{background-color: var(--wp--preset--color--white) !important;}.has-pale-pink-background-color{background-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-background-color{background-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-background-color{background-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-background-color{background-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-background-color{background-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-background-color{background-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-background-color{background-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-background-color{background-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-background-color{background-color: var(--wp--preset--color--vivid-purple) !important;}.has-black-border-color{border-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-border-color{border-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-border-color{border-color: var(--wp--preset--color--white) !important;}.has-pale-pink-border-color{border-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-border-color{border-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-border-color{border-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-border-color{border-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-border-color{border-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-border-color{border-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-border-color{border-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-border-color{border-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-border-color{border-color: var(--wp--preset--color--vivid-purple) !important;}.has-vivid-cyan-blue-to-vivid-purple-gradient-background{background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;}.has-light-green-cyan-to-vivid-green-cyan-gradient-background{background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;}.has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;}.has-luminous-vivid-orange-to-vivid-red-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;}.has-very-light-gray-to-cyan-bluish-gray-gradient-background{background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;}.has-cool-to-warm-spectrum-gradient-background{background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;}.has-blush-light-purple-gradient-background{background: var(--wp--preset--gradient--blush-light-purple) !important;}.has-blush-bordeaux-gradient-background{background: var(--wp--preset--gradient--blush-bordeaux) !important;}.has-luminous-dusk-gradient-background{background: var(--wp--preset--gradient--luminous-dusk) !important;}.has-pale-ocean-gradient-background{background: var(--wp--preset--gradient--pale-ocean) !important;}.has-electric-grass-gradient-background{background: var(--wp--preset--gradient--electric-grass) !important;}.has-midnight-gradient-background{background: var(--wp--preset--gradient--midnight) !important;}.has-small-font-size{font-size: var(--wp--preset--font-size--small) !important;}.has-medium-font-size{font-size: var(--wp--preset--font-size--medium) !important;}.has-large-font-size{font-size: var(--wp--preset--font-size--large) !important;}.has-x-large-font-size{font-size: var(--wp--preset--font-size--x-large) !important;}
.wp-block-navigation a:where(:not(.wp-element-button)){color: inherit;}
:where(.wp-block-columns.is-layout-flex){gap: 2em;}
.wp-block-pullquote{font-size: 1.5em;line-height: 1.6;}
</style>
<link rel='stylesheet' id='contact-form-7-css' href='../wp-content/plugins/contact-form-7/includes/css/styles9f31.css?ver=5.7.2' media='all' />
<style id='woocommerce-inline-inline-css'>
.woocommerce form .form-row .required { visibility: visible; }
</style>
<link rel='stylesheet' id='elementor-icons-css' href='../wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.mine127.css?ver=5.17.0' media='all' />
<link rel='stylesheet' id='elementor-frontend-css' href='../wp-content/uploads/elementor/css/custom-frontend-lite.min3a7a.css?ver=1674327392' media='all' />
<link rel='stylesheet' id='elementor-post-443-css' href='../wp-content/uploads/elementor/css/post-4433a7a.css?ver=1674327392' media='all' />
<link rel='stylesheet' id='porto-css-vars-css' href='../wp-content/uploads/porto_styles/theme_css_vars0757.css?ver=6.2.4' media='all' />
<link rel='stylesheet' id='bootstrap-css' href='../wp-content/uploads/porto_styles/bootstrap0757.css?ver=6.2.4' media='all' />
<link rel='stylesheet' id='porto-plugins-css' href='../wp-content/themes/porto/css/plugins0757.css?ver=6.2.4' media='all' />
<link rel='stylesheet' id='porto-theme-css' href='../wp-content/themes/porto/css/theme0757.css?ver=6.2.4' media='all' />
<link rel='stylesheet' id='porto-shortcodes-css' href='../wp-content/themes/porto/css/shortcodes0757.css?ver=6.2.4' media='all' />
<link rel='stylesheet' id='porto-theme-shop-css' href='../wp-content/themes/porto/css/theme_shop0757.css?ver=6.2.4' media='all' />
<link rel='stylesheet' id='porto-dynamic-style-css' href='../wp-content/uploads/porto_styles/dynamic_style0757.css?ver=6.2.4' media='all' />
<link rel='stylesheet' id='elementor-post-999-css' href='../wp-content/uploads/elementor/css/post-9997ee8.css?ver=1674370169' media='all' />
<link rel='stylesheet' id='porto-style-css' href='../wp-content/themes/porto/style0757.css?ver=6.2.4' media='all' />
<style id='porto-style-inline-css'>
#header .logo,.side-header-narrow-bar-logo{max-width:160px}@media (min-width:1230px){#header .logo{max-width:160px}}@media (max-width:991px){#header .logo{max-width:160px}}@media (max-width:767px){#header .logo{max-width:100px}}@media (min-width:992px){}#header .header-main .header-left,#header .header-main .header-center,#header .header-main .header-right,.fixed-header #header .header-main .header-left,.fixed-header #header .header-main .header-right,.fixed-header #header .header-main .header-center,.header-builder-p .header-main{padding-top:0;padding-bottom:0}@media (max-width:991px){#header .header-main .header-left,#header .header-main .header-center,#header .header-main .header-right,.fixed-header #header .header-main .header-left,.fixed-header #header .header-main .header-right,.fixed-header #header .header-main .header-center,.header-builder-p .header-main{padding-top:8px;padding-bottom:8px}}.page-top .product-nav{position:static;height:auto;margin-top:0}.page-top .product-nav .product-prev,.page-top .product-nav .product-next{float:none;position:absolute;height:30px;top:50%;bottom:50%;margin-top:-15px}.page-top .product-nav .product-prev{right:10px}.page-top .product-nav .product-next{left:10px}.page-top .product-nav .product-next .product-popup{right:auto;left:0}.page-top .product-nav .product-next .product-popup:before{right:auto;left:6px}.page-top .sort-source{position:static;text-align:center;margin-top:5px;border-width:0}.page-top{padding-top:20px;padding-bottom:20px}.page-top .page-title{padding-bottom:0}@media (max-width:991px){.page-top .page-sub-title{margin-bottom:5px;margin-top:0}.page-top .breadcrumbs-wrap{margin-bottom:5px}}@media (min-width:992px){.page-top .page-title{min-height:0;line-height:1.25}.page-top .page-sub-title{line-height:1.6}.page-top .product-nav{display:inline-block;height:30px;vertical-align:middle;margin-left:10px}.page-top .product-nav .product-prev,.page-top .product-nav .product-next{position:relative}.page-top .product-nav .product-prev{float:left;left:0}.page-top .product-nav .product-prev .product-popup{right:auto;left:-26px}.page-top .product-nav .product-prev:before{right:auto;left:32px}.page-top .product-nav .product-next{float:left;left:0}.page-top .product-nav .product-next .product-popup{right:auto;left:0}.page-top .product-nav .product-next .product-popup:before{right:auto}}@media (min-width:992px){.page-top .product-nav{height:auto}.page-top .breadcrumb{-webkit-justify-content:flex-end;-ms-flex-pack:end;justify-content:flex-end}}#login-form-popup{position:relative;width:80%;max-width:525px;margin-left:auto;margin-right:auto}#login-form-popup .featured-box{margin-bottom:0;box-shadow:none;border:none;border-radius:0}#login-form-popup .featured-box .box-content{padding:45px 36px 30px;border:none}#login-form-popup .featured-box h2{text-transform:uppercase;font-size:15px;letter-spacing:.05em;font-weight:600;line-height:2}#login-form-popup .porto-social-login-section{margin-top:20px}.porto-social-login-section{background:#f4f4f2;text-align:center;padding:20px 20px 25px}.porto-social-login-section p{text-transform:uppercase;font-size:12px;font-weight:600;margin-bottom:8px}#login-form-popup .col2-set{margin-left:-20px;margin-right:-20px}#login-form-popup .col-1,#login-form-popup .col-2{padding-left:20px;padding-right:20px}@media (min-width:992px){#login-form-popup .col-1{border-right:1px solid #f5f6f6}}#login-form-popup .input-text{box-shadow:none;padding-top:10px;padding-bottom:10px;border-color:#ddd;border-radius:2px;line-height:1.5 !important}#login-form-popup .form-row{margin-bottom:20px}#login-form-popup .woocommerce-privacy-policy-text{display:none}#login-form-popup .button{border-radius:2px;padding:18px 24px;text-shadow:none;font-size:12px;letter-spacing:-0.025em}#login-form-popup label.inline{margin-top:15px;float:right;position:relative;cursor:pointer;line-height:1.5}#login-form-popup label.inline input[type=checkbox]{opacity:0;margin-right:8px;margin-top:0;margin-bottom:0}#login-form-popup label.inline span:before{content:'';position:absolute;border:1px solid #ddd;border-radius:1px;width:16px;height:16px;left:0;top:0;text-align:center;line-height:15px;font-family:'Font Awesome 5 Free';font-weight:900;font-size:9px;color:#aaa}#login-form-popup label.inline input[type=checkbox]:checked + span:before{content:'\f00c'}#login-form-popup .social-button i{font-size:16px;margin-right:8px}.porto-social-login-section .google-plus{background:#dd4e31}.porto-social-login-section .facebook{background:#3a589d}.porto-social-login-section .twitter{background:#1aa9e1}.featured-box .porto-social-login-section i{color:#fff}.porto-social-login-section .social-button:hover{background:var(--bs-primary)}#login-form-popup{max-width:480px}html.panel-opened body > .mfp-bg{z-index:9042}html.panel-opened body > .mfp-wrap{z-index:9043}@media (min-width:1440px){.page-wrapper{margin:0 50px 50px}.header-wrapper{margin-left:-50px;margin-right:-50px}.container,.elementor-section.elementor-section-boxed > .elementor-container{max-width:1440px}.elementor-section.elementor-section-boxed > .elementor-column-gap-no{max-width:1410px}.ml-sl-3{margin-left:1rem}.pc-section-fullwidth{margin-left:-80px !important;margin-right:-80px !important}}@media (min-width:1440px) and (max-width:1600px){.container,.elementor-section.elementor-section-boxed > .elementor-container{padding-left:80px;padding-right:80px}}.mega-menu.menu-hover-line > li.menu-item > a:before{background-color:#444;margin-top:13px}.header-contact a:hover{text-decoration:underline !important}.page-top .page-title{font-size:3.75rem;font-weight:800;text-transform:uppercase}.page-top .breadcrumbs-wrap{font-size:1em;font-weight:600}.page-top ul.breadcrumb > li:last-child,.page-top .breadcrumb .delimiter{opacity:.7}@media (max-width:767px){.page-top .page-title{font-size:2rem}}@media (min-width:1230px){.w-xl-33{width:33.3333% !important}.w-xl-41{width:41.6666% !important}}.elementor-heading-title em,.porto-u-sub-heading em{font-family:Lora,sans-serif;font-weight:700}.main-content,.left-sidebar,.right-sidebar{padding-top:4rem}.elementor-image-box-description strong,.wpcf7-form .btn.btn-borders,.elementor-heading-title strong{color:#212529}.btn{font-weight:600;text-transform:uppercase}.btn-borders.btn-lg,html .wpcf7-form .btn.btn-borders{border-width:4px;padding:1.1428em 1.7142em}.section-dark .btn-borders.btn-secondary{color:#fff}.custom-arrow-icon .fas.fa-long-arrow-alt-right{position:relative;display:inline-block;width:17px;height:17px;vertical-align:middle;top:-.5px}.custom-arrow-icon .fa-long-arrow-alt-right:before{content:'';position:absolute;top:50%;left:0;width:100%;border-top:1px solid;border-color:inherit;transform:translate3d(0,-50%,0)}.custom-arrow-icon .fa-long-arrow-alt-right:after{content:'';position:absolute;top:50%;right:0;width:50%;height:50%;border-top:1px solid;border-right:1px solid;border-color:inherit;transform:translate3d(0,-50%,0) rotate(45deg)}.custom-link-effect-1 i{transition:transform .3s}.custom-link-effect-1 .btn:hover i,.custom-link-effect-1 a:hover i{transform:translateX(10px) !important}.custom-link-effect-2 .btn:hover{padding-right:35px !important}.porto-heading.custom-border-1,.custom-border-1 .elementor-heading-title{display:flex;align-items:center}.porto-heading.custom-border-1:before,.custom-border-1 .elementor-heading-title:before{content:'';max-width:50px;flex:0 0 50px;border-top:5px solid #fbe91b;margin-right:15px}.text-end .elementor-image-box-title:before{right:auto;left:calc(100% + 15px)}.svg-fill-color-primary svg path,.svg-fill-color-primary svg rect{fill:#0053ce !important}.porto-sicon-read span{display:none}.porto-sicon-read{font-size:1.1em;text-transform:uppercase;font-weight:700;color:inherit}.open-video{transition:transform .3s}.open-video:hover{transform:scale(1.1)}.custom-box-shadow-1{box-shadow:0 0 37px -4px rgba(0,0,0,0.1) !important}.row-justify-content-center .row{justify-content:center}.pc-position-center-x-y{position:absolute !important;z-index:0;top:46%;left:45%;width:140% !important;transform:translate3d(-50%,-50%,0)}.brand-slider img{max-width:110px;margin-left:auto;margin-right:auto}.elementor-testimonial-wrapper{padding:.5rem}.elementor-testimonial-wrapper .elementor-testimonial-content{position:relative;padding:25px 12px 0 30px}.elementor-testimonial-wrapper .elementor-testimonial-content:before{content:"“";font-family:Poppins,sans-serif;position:absolute;line-height:1;font-weight:400;font-style:normal;top:-5px;left:-5px;font-size:90px;color:#0053ce}.elementor-testimonial-wrapper .elementor-testimonial-meta{position:relative;margin-left:70px}.elementor-testimonial-wrapper .elementor-testimonial-meta:before{content:'';position:absolute;top:6px;right:calc(100% + 10px);width:30px;border-top:4px solid #000}.porto-process.process-horizontal .process-step-circle{width:110px;height:110px;background:#fff;border-color:#e2e5e8;z-index:1;box-shadow:0 0 0 15px #fff;font-size:2.3em;color:#0053ce}.porto-process.process-horizontal .process-step-content h4{font-size:1.2em}.porto-process.process-horizontal .process-step-content{padding:2rem 3rem 0}@media (min-width:992px){.porto-process.process-horizontal{position:relative}.porto-process.process-horizontal:before{content:'';position:absolute;left:-25%;width:150%;border-top:2px solid #EDEDED;top:77px}.porto-process.process-horizontal .process-step:nth-child(2n + 1){margin-top:-75px}.porto-process.process-horizontal .process-step:before,.porto-process.process-horizontal .process-step:after{content:none}.sort-source-style-3{justify-content:flex-end;font-size:1em}}.sort-source-style-3 > li > a{border:1px solid #dee2e6;padding:1rem 1.5rem;font-weight:700;color:#212529;line-height:1.5;margin:0 0 1rem 1.25rem}.sort-source-style-3 > li:hover > a,.sort-source-style-3 > li.active > a{color:#212529;border:1px solid}.pagination.load-more .next{width:auto !important;border-radius:0 !important;display:inline-block;border:none;color:#0053ce;font-size:1em;font-weight:700;text-decoration:underline;padding:0}.portfolio-item.outimage{text-align:left;padding:2.25rem 2.25rem 1rem;background:#fff;box-shadow:0 20px 80px rgba(0,0,0,.09)}.portfolio-item.outimage .portfolio-brief-content{padding:0 !important;font-family:Lora,sans-serif;font-size:1.1em}.portfolio-item.outimage .portfolio-title{font-size:1.35em;text-transform:uppercase;padding-top:.5rem}.portfolio-row{margin:0 -15px}.portfolio-row .portfolio{padding:0 10px 20px}.elementor-accordion .elementor-accordion-item{margin-bottom:.25rem}.elementor-accordion .elementor-accordion-item+.elementor-accordion-item{border-top-style:solid}.elementor-accordion .elementor-tab-content{border-top:none !important}html .form-control,html .form-control:focus{background:#f7f7f7;border:none;box-shadow:none}.wpcf7-form .form-control{background:#fff;box-shadow:0 0 37px -4px rgba(0,0,0,0.1) !important;border:none;padding:1.2rem;font-size:.875rem}.wpcf7-form .form-control:focus{background:#fff}.blog-posts .post-image .entry-title{position:absolute;color:#fff;left:2rem;right:5rem;bottom:1rem;z-index:2;font-size:1.8em;line-height:1.1;font-weight:700}.blog-posts .post-image .entry-title a{color:inherit !important}.blog-posts .post-grid .grid-box{padding:0 2rem 2rem}.blog-posts .post-grid .post-image{margin-left:-2rem;margin-right:-2rem}.blog-posts .post-grid .img-thumbnail:after{content:'';position:absolute;top:0;left:0;right:0;bottom:0;background:#212529;opacity:.8;z-index:1;transition:opacity .3s ease .1s}.blog-posts .post-grid:hover .img-thumbnail:after{opacity:0.2}.blog-posts .post-grid .post-content{font-size:1.1em}article.post .post-meta i{display:none}article.post .post-meta{display:inline-block;font-size:1em;text-transform:uppercase;line-height:1;margin-bottom:1.5rem}article.post .post-meta + .post-meta > span{border-left:1px solid #ccc;padding-left:12px;margin-left:4px}article.post-grid .post-image.single,article.post-grid .post-image .owl-carousel{margin-bottom:1.5rem}article.post .btn-readmore{background:none !important;border:none;padding:0;color:#0053ce !important;font-size:1.1em !important;font-weight:700;text-transform:capitalize !important;text-decoration:underline}.pagination>a,.pagination>span{width:2.75rem !important;height:2.75rem;line-height:2.5rem;color:#999;background:#fff;border:2px solid #999;font-size:1rem;padding:0;border-radius:2rem !important;margin:0 .25rem}.pagination .prev:before,.pagination .next:before{top:0}@media (max-width:575px){article.post .post-meta{font-size:.8em}}.single-post article.post .post-image.single{margin-bottom:1rem}.single-post .post-content > div:first-child{font-family:Lora,sans-serif;text-transform:uppercase}.single-post .post-content span.m-l-lg{margin-left:.75rem !important}.single-post .post-content span.m-l-lg:before{content:'|';opacity:.3;margin-right:.75rem}.post-block h3,article.post .comment-respond h3{font-size:1.5em;font-weight:700}@media (min-width:768px){ul.comments ul.children>li img.avatar,ul.comments>li img.avatar{width:3rem;height:3rem}ul.comments ul.children>li,ul.comments>li{padding-left:70px}ul.comments ul.children>li .img-thumbnail,ul.comments>li .img-thumbnail{margin-left:-70px}}ul.comments .comment-arrow{left:-12px;top:10px}.post-author p .name a,ul.comments .comment-block .comment-by,.comment-block .comment-by > strong > a{color:#212529}.comment-form{border-radius:0;background:none;padding:0}.comment-form input,.comment-form textarea{border:none;box-shadow:0 0 37px -4px rgba(0,0,0,0.1);padding:1rem 1.5rem}.comment-form label{display:inline-block}.comment-form input[type="submit"]{background:none;border:4px solid #fbe91b;font-size:.875rem;color:#212529;transition:padding-right .3s}.comment-form input[type="submit"]:hover{background:#fbe91b}.widget .widget-title{font-size:1.5em;text-transform:none;color:#212529}.sidebar-content .widget{padding-left:1rem;padding-right:1rem}.sidebar-content .widget + .widget{padding-top:30px;border-top:1px solid rgba(0,0,0,.06);margin-top:30px}.widget > ul,.widget > ul li{border:none}.widget>div>ul,.widget>ul{font-size:.9em}.widget_recent_entries > ul li,.widget_recent_comments > ul li{padding-left:0;border:none}.widget_recent_entries > ul li > a{color:#212529;font-weight:700}.widget_recent_entries > ul li:before,.widget_recent_comments>ul li:before{content:none}.widget_recent_comments > ul li > a{font-weight:700;font-size:1.2em;color:#212529}.widget_search .btn-dark{background:#f7f7f7 !important;border:none;color:#212529 !important;font-size:.8em}#footer .widget-title{font-size:1.4em;letter-spacing:0;text-transform:uppercase;color:#fff}.footer-main>.container:after{content:'';display:block;border-top:1px solid rgba(255,255,255,.2);position:relative;top:2.4rem}#footer .share-links a{box-shadow:none}#footer .footer-bottom{font-size:1em;padding:1.5rem 0 2.5rem}#footer .logo img{max-width:none}@media (min-width:768px) and (max-width:991px){.footer-main > .container > .row > .col-lg-2{width:33.3333%}.footer-main > .container > .row > .col-lg-4{width:66.6666%}}
</style>
<link rel='stylesheet' id='google-fonts-1-css' href='https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&amp;display=swap&amp;ver=6.1.3' media='all' />
<link rel='stylesheet' id='elementor-icons-shared-0-css' href='../wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min52d5.css?ver=5.15.3' media='all' />
<link rel='stylesheet' id='elementor-icons-fa-solid-css' href='../wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min52d5.css?ver=5.15.3' media='all' />


<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="../wp-includes/wlwmanifest.xml" />
<meta name="generator" content="WordPress 6.1.3" />
<meta name="generator" content="WooCommerce 7.3.0" />
<link rel="canonical" href="index.html" />
<link rel='shortlink' href='../index58aa.html?p=999' />


			<noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
	<style>.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style><link rel="preconnect" href="http://code.tidio.co/"><link rel="icon" href="../wp-content/uploads/2023/01/Screenshot_2023-01-21_at_18-51-46_Logopony-removebg-preview1-85x85.png" sizes="32x32" />
<link rel="icon" href="../wp-content/uploads/2023/01/Screenshot_2023-01-21_at_18-51-46_Logopony-removebg-preview1-300x300.png" sizes="192x192" />
<link rel="apple-touch-icon" href="../wp-content/uploads/2023/01/Screenshot_2023-01-21_at_18-51-46_Logopony-removebg-preview1-300x300.png" />
<meta name="msapplication-TileImage" content="https://primevests.com/wp-content/uploads/2023/01/Screenshot_2023-01-21_at_18-51-46_Logopony-removebg-preview1-300x300.png" />
</head>
<body class="page-template-default page page-id-999 wp-embed-responsive theme-porto woocommerce-no-js login-popup full blog-1 elementor-default elementor-kit-443 elementor-page elementor-page-999">

	<div class="page-wrapper"><!-- page wrapper -->

		
								<!-- header wrapper -->
			<div class="header-wrapper">
								

	<header id="header" class="header-builder">
	
	<div class="header-main"><div class="header-row container"><div class="header-col header-left">		<div class="logo">
		<a href="../index.html" title="Primevest - "  rel="home">
		<img class="img-responsive sticky-logo sticky-retina-logo" src="../wp-content/uploads/2023/01/Screenshot_2023-01-21_at_18-57-04_Logopony-removebg-preview-1.png" alt="Primevest" /><img class="img-responsive standard-logo retina-logo" src="../wp-content/uploads/2023/01/Screenshot_2023-01-21_at_18-57-04_Logopony-removebg-preview-1.png" alt="Primevest" />	</a>
			</div>
		</div><div class="header-col header-right"><ul id="menu-main-menu" class="main-menu mega-menu menu-hover-line menu-hover-underline"><li id="nav-menu-item-969" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home narrow"><a href="../index.html">Home</a></li>
<li id="nav-menu-item-973" class="menu-item menu-item-type-post_type menu-item-object-page narrow"><a href="../about-us/index.html">About Us</a></li>
<li id="nav-menu-item-1007" class="menu-item menu-item-type-post_type menu-item-object-page narrow"><a href="../investment-plans/index.html">Investment Plans</a></li>
<li id="nav-menu-item-1006" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-999 current_page_item active narrow"><a href="index.html" class=" current">Contact Us</a></li>
<li id="nav-menu-item-985" class="menu-item menu-item-type-custom menu-item-object-custom narrow"><a href="../account/login.php">LOGIN</a></li>
<li id="nav-menu-item-986" class="menu-item menu-item-type-custom menu-item-object-custom narrow"><a href="../account/register.php">REGISTER</a></li>
</ul><a class="mobile-toggle" href="#"><i class="fas fa-bars"></i></a></div></div>
<div id="nav-panel">
	<div class="container">
		<div class="mobile-nav-wrap">
		<div class="menu-wrap"><ul id="menu-main-menu-1" class="mobile-menu accordion-menu"><li id="accordion-menu-item-969" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home"><a href="../index.html">Home</a></li>
<li id="accordion-menu-item-973" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="../about-us/index.html">About Us</a></li>
<li id="accordion-menu-item-1007" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="../investment-plans/index.html">Investment Plans</a></li>
<li id="accordion-menu-item-1006" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-999 current_page_item active"><a href="index.html" class=" current ">Contact Us</a></li>
<li id="accordion-menu-item-985" class="menu-item menu-item-type-custom menu-item-object-custom"><a href="../account/login.php">LOGIN</a></li>
<li id="accordion-menu-item-986" class="menu-item menu-item-type-custom menu-item-object-custom"><a href="../account/register.php">REGISTER</a></li>
</ul></div>		</div>
	</div>
</div>
</div>	</header>

							</div>
			<!-- end header wrapper -->
		
		
		
		<div id="main" class="column1 boxed no-breadcrumbs"><!-- main -->

			<div class="container">
			<div class="row main-content-wrap">

			<!-- main content -->
			<div class="main-content col-lg-12">

			
	<div id="content" role="main">
				
			<article class="post-999 page type-page status-publish hentry">
				
				<h2 class="entry-title" style="display: none;">Contact Us</h2><span class="vcard" style="display: none;"><span class="fn"><a href="../author/primevest/index.html" title="Posts by Primevest" rel="author">Primevest</a></span></span><span class="updated" style="display:none">2023-01-22T00:54:56+00:00</span>
				<div class="page-content">
							<div data-elementor-type="wp-page" data-elementor-id="999" class="elementor elementor-999">
									<section class="elementor-section elementor-top-section elementor-element elementor-element-e5ce7ca elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="e5ce7ca" data-element_type="section">
			
									<div class="elementor-container elementor-column-gap-default">
											<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-47f168e" data-id="47f168e" data-element_type="column">

					<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-c4aefc6 elementor-widget elementor-widget-heading" data-id="c4aefc6" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<style>/*! elementor - v3.10.1 - 17-01-2023 */
.elementor-heading-title{padding:0;margin:0;line-height:1}.elementor-widget-heading .elementor-heading-title[class*=elementor-size-]>a{color:inherit;font-size:inherit;line-height:inherit}.elementor-widget-heading .elementor-heading-title.elementor-size-small{font-size:15px}.elementor-widget-heading .elementor-heading-title.elementor-size-medium{font-size:19px}.elementor-widget-heading .elementor-heading-title.elementor-size-large{font-size:29px}.elementor-widget-heading .elementor-heading-title.elementor-size-xl{font-size:39px}.elementor-widget-heading .elementor-heading-title.elementor-size-xxl{font-size:59px}</style><h2 class="elementor-heading-title elementor-size-default">CONTACT US</h2>		</div>
				</div>
					</div>
				</div>
						</div>
				</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-8887ce7 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="8887ce7" data-element_type="section">
			
									<div class="elementor-container elementor-column-gap-default">
											<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-363a8f5" data-id="363a8f5" data-element_type="column">

					<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-e77e1cf elementor-widget elementor-widget-google_maps" data-id="e77e1cf" data-element_type="widget" data-widget_type="google_maps.default">
				<div class="elementor-widget-container">
			<style>/*! elementor - v3.10.1 - 17-01-2023 */
.elementor-widget-google_maps .elementor-widget-container{overflow:hidden}.elementor-widget-google_maps iframe{height:300px}</style>		<div class="elementor-custom-embed">
			<iframe loading="lazy"
        src="https://maps.google.com/maps?q=Greece&amp;t=m&amp;z=7&amp;output=embed&amp;iwloc=near"
        title="Greece"
        aria-label="Greece"
></iframe>

		</div>
				</div>
				</div>
					</div>
				</div>
						</div>
				</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-5649967 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="5649967" data-element_type="section">
			
									<div class="elementor-container elementor-column-gap-default">
											<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-c9897a8" data-id="c9897a8" data-element_type="column">

					<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-70f2ff1 elementor-widget elementor-widget-shortcode" data-id="70f2ff1" data-element_type="widget" data-widget_type="shortcode.default">
				<div class="elementor-widget-container">
					<div class="elementor-shortcode"><div class="wpcf7 no-js" id="wpcf7-f15-p999-o1" lang="en-US" dir="ltr">
<div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p> <ul></ul></div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <div>
        <input type="hidden" name="_wpcf7" value="15" />
        <input type="hidden" name="_wpcf7_version" value="5.7.2" />
        <input type="hidden" name="_wpcf7_locale" value="en_US" />
        <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f15-p999-o1" />
        <input type="hidden" name="_wpcf7_container_post" value="999" />
        <input type="hidden" name="_wpcf7_posted_data_hash" value="" />
    </div>
    <p>
        <label for="your-name">Your name</label><br />
        <input type="text" id="your-name" name="your-name" required />
    </p>
    <p>
        <label for="your-email">Your email</label><br />
        <input type="email" id="your-email" name="your-email" required />
    </p>
    <p>
        <label for="your-subject">Subject</label><br />
        <input type="text" id="your-subject" name="your-subject" required />
    </p>
    <p>
        <label for="your-message">Your message (optional)</label><br />
        <textarea id="your-message" name="your-message" rows="10"></textarea>
    </p>
    <p>
        <input type="submit" value="Submit" />
    </p>
    <?php if (!empty($submissionStatus)): ?>
    <p><?php echo $submissionStatus; ?></p>
    <?php endif; ?>
    
</form>



</div></div>
				</div>
				</div>
					</div>
				</div>
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-ae916f9" data-id="ae916f9" data-element_type="column">

					<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-0af6be5 elementor-widget elementor-widget-image" data-id="0af6be5" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
			<style>/*! elementor - v3.10.1 - 17-01-2023 */
.elementor-widget-image{text-align:center}.elementor-widget-image a{display:inline-block}.elementor-widget-image a img[src$=".svg"]{width:48px}.elementor-widget-image img{vertical-align:middle;display:inline-block}</style>												<img decoding="async" width="509" height="339" src="../wp-content/uploads/2023/01/istockphoto-1331493599-170667a.jpg" class="attachment-large size-large wp-image-1002" alt="" loading="lazy" srcset="https://primevests.com/wp-content/uploads/2023/01/istockphoto-1331493599-170667a.jpg 509w, https://primevests.com/wp-content/uploads/2023/01/istockphoto-1331493599-170667a-400x266.jpg 400w, https://primevests.com/wp-content/uploads/2023/01/istockphoto-1331493599-170667a-367x244.jpg 367w" sizes="(max-width: 509px) 100vw, 509px" />															</div>
				</div>
				<div class="elementor-element elementor-element-97bb505 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="97bb505" data-element_type="widget" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
			<link rel="stylesheet" href="../wp-content/uploads/elementor/css/custom-widget-icon-list.min86ee.css?ver=1674331781">		<ul class="elementor-icon-list-items">
							<li class="elementor-icon-list-item">
											<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-location-arrow"></i>						</span>
										<span class="elementor-icon-list-text">ADDRESS:Persefonis 41 Athina Attina, Greece</span>
									</li>
							
								<li class="elementor-icon-list-item">
											<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-envelope"></i>						</span>
										<span class="elementor-icon-list-text">EMAIL: support@Trustvestpro.cc</span>
									</li>
						</ul>
				</div>
				</div>
					</div>
				</div>
						</div>
				</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-a6018cf elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="a6018cf" data-element_type="section">
			
									<div class="elementor-container elementor-column-gap-default">
											<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-ca6ce33" data-id="ca6ce33" data-element_type="column">

					<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-01739f0 elementor-widget elementor-widget-html" data-id="01739f0" data-element_type="widget" data-widget_type="html.default">
				<div class="elementor-widget-container">
			<div class="mgm" style="display: none;">
        <div class="txt" style="color: #2468ef;">An Investor from <b></b> just invested <a
            href="javascript:void(0);" onclick="javascript:void(0);"></a>
        </div>
      </div>

      <style>
        .mgm {
          border-radius: 7px;
          position: fixed;
          z-index: 90;
          bottom: 80px;
          right: 50px;
          background: #000001;
          padding: 10px 27px;
          box-shadow: 0px 5px 13px 0px rgba(0, 0, 0, .3);
        }

        .mgm a {
          font-weight: 700;
          display: block;
          color: #fff;
        }

        .mgm a,
        .mgm a:active {
          transition: all .2s ease;
          color: #fff;
        }

      </style>

      <script type="text/javascript">
        var listCountries = ['UK', 'USA', 'Germany', 'France', 'Italy', 'South Africa', 'Australia', 'Switzerland', 'Canada',
          'Argentina', 'Saudi Arabia', 'Mexico', 'Mexico', 'South Africa', 'Venezuela', 'South Africa', 'Sweden',
          'South Africa', 'USA', 'Italy', 'United State', 'United Kingdom', 'California', 'Greece', 'Cuba', 'South Africa',
          'Portugal', 'Austria', 'South Africa', 'London', 'South Africa', 'Cyprus', 'Netherlands', 'Switzerland',
          'Belgium', 'Israel', 'Cyprus' ,'Greece'
        ];
        var listPlans = ['$5000', '$1500', '$1000', '$10,000', '$2000', '$3000', '$4000', '$600', '$700', '$2500'];
        interval = Math.floor(Math.random() * (40000 - 8000 + 1) + 8000);
        var run = setInterval(request, interval);

        function request() {
          clearInterval(run);
          interval = Math.floor(Math.random() * (40000 - 8000 + 1) + 8000);
          var country = listCountries[Math.floor(Math.random() * listCountries.length)];
          var plan = listPlans[Math.floor(Math.random() * listPlans.length)];
          var msg = 'An Investor from <b>' + country +
            '</b> just invested <a href="javascript:void(0);" onclick="javascript:void(0);">' + plan + ' .</a>';
          jQuery(".mgm .txt").html(msg);
          jQuery(".mgm").stop(true).fadeIn(300);
          window.setTimeout(function() {
            jQuery(".mgm").stop(true).fadeOut(300);
          }, 6000);
          run = setInterval(request, interval);
        }
      </script>		</div>
				</div>
					</div>
				</div>
						</div>
				</section>
							</div>
						</div>
			</article>
					
	</div>

		

</div><!-- end main content -->



	</div>
	</div>


		
			
			</div><!-- end main -->

			
			<div class="footer-wrapper">

																							
						<div id="footer" class="footer-1"
>
			<div class="footer-main">
			<div class="container">
				
									<div class="row">
														<div class="col-lg-2">
									<aside id="block-5" class="widget widget_block">
<h4>ADDRESS</h4>
</aside><aside id="block-4" class="widget widget_block">
<ul>
<li><strong>Persefonis 41 Athina Attina, Greece</strong>
<ul></ul>
</li>
</ul>
</aside>								</div>
																<div class="col-lg-4">
									<aside id="custom_html-3" class="widget_text widget widget_custom_html"><div class="textwidget custom-html-widget"><div class="row">
	<div class="col-md-6">
		<h3 class="widget-title">OUR CONTACTS</h3>
		<ul class="links">
			<li class="pb-1 mb-2"><span class="d-block line-height-xs">SUPPORT</span><a href="tel:+1 (669) 338-0852" class="font-weight-bold text-color-light" style="font-size: 1.8em">21 03464984</a></li>
			
		</div></aside>								</div>
																<div class="col-lg-4">
									<aside id="custom_html-2" class="widget_text widget widget_custom_html"><div class="textwidget custom-html-widget">
		<h3 class="widget-title">About</h3>
		<ul class="links">
			<li><a href="../about-us/index.html">About Us</a></li>
			<li><a href="index.html">Send a Message</a></li>
		</ul>
	</div>
</div></div></aside>								</div>
													</div>
				
							</div>
		</div>
	
	<div class="footer-bottom">
	<div class="container">
				<div class="footer-left">
							<span class="logo">
					
				</span>
								</div>
		
					<div class="footer-center">
								<span class="footer-copyright">Trustvestpro. © 2019. All Rights Reserved</span>			</div>
		
			</div>
</div>
</div>
										
				
			</div>
					
		
	</div><!-- end wrapper -->
	
<!-- Cryptocurrency Widgets - Version:- 2.6 By Cool Plugins (CoolPlugins.net) --><div style="display:none" class="ccpw-container ccpw-ticker-cont ccpw-footer-ticker-fixedbar"><div  class="tickercontainer" style="height: auto; overflow: hidden;"><ul   data-tickerspeed="35000" id="ccpw-ticker-widget-1121"><li id="bitcoin"><div class="coin-container"><span class="ccpw_icon"><img id="bitcoin" alt="bitcoin" src="../wp-content/plugins/cryptocurrency-price-ticker-widget/assets/coin-logos/bitcoin.svg"></span><span class="name">Bitcoin(BTC)</span><span class="price">&#36;27,662.00</span><span class="changes up"><i class="ccpw_icon-up" aria-hidden="true"></i>0.39%</span></div></li><li id="ethereum"><div class="coin-container"><span class="ccpw_icon"><img id="ethereum" alt="ethereum" src="../wp-content/plugins/cryptocurrency-price-ticker-widget/assets/coin-logos/ethereum.svg"></span><span class="name">Ethereum(ETH)</span><span class="price">&#36;1,892.39</span><span class="changes up"><i class="ccpw_icon-up" aria-hidden="true"></i>2.22%</span></div></li><li id="tether"><div class="coin-container"><span class="ccpw_icon"><img id="tether" alt="tether" src="../wp-content/plugins/cryptocurrency-price-ticker-widget/assets/coin-logos/tether.svg"></span><span class="name">Tether(USDT)</span><span class="price">&#36;1.00</span><span class="changes up"><i class="ccpw_icon-up" aria-hidden="true"></i>0.02%</span></div></li><li id="binancecoin"><div class="coin-container"><span class="ccpw_icon"><img id="binancecoin" alt="binancecoin" src="../wp-content/plugins/cryptocurrency-price-ticker-widget/assets/coin-logos/binancecoin.svg"></span><span class="name">BNB(BNB)</span><span class="price">&#36;312.24</span><span class="changes up"><i class="ccpw_icon-up" aria-hidden="true"></i>1.02%</span></div></li><li id="usd-coin"><div class="coin-container"><span class="ccpw_icon"><img id="usd-coin" alt="usd-coin" src="../wp-content/plugins/cryptocurrency-price-ticker-widget/assets/coin-logos/usd-coin.svg"></span><span class="name">USD Coin(USDC)</span><span class="price">&#36;1.00</span><span class="changes up"><i class="ccpw_icon-up" aria-hidden="true"></i>0.07%</span></div></li><li id="ripple"><div class="coin-container"><span class="ccpw_icon"><img id="ripple" alt="ripple" src="../wp-content/plugins/cryptocurrency-price-ticker-widget/assets/coin-logos/ripple.svg"></span><span class="name">XRP(XRP)</span><span class="price">&#36;0.485923</span><span class="changes up"><i class="ccpw_icon-up" aria-hidden="true"></i>1.59%</span></div></li><li id="cardano"><div class="coin-container"><span class="ccpw_icon"><img id="cardano" alt="cardano" src="../wp-content/plugins/cryptocurrency-price-ticker-widget/assets/coin-logos/cardano.svg"></span><span class="name">Cardano(ADA)</span><span class="price">&#36;0.378876</span><span class="changes up"><i class="ccpw_icon-up" aria-hidden="true"></i>0.28%</span></div></li><li id="staked-ether"><div class="coin-container"><span class="ccpw_icon"><img id="staked-ether" alt="staked-ether" src="../wp-content/plugins/cryptocurrency-price-ticker-widget/assets/coin-logos/staked-ether.png"></span><span class="name">Lido Staked Ether(STETH)</span><span class="price">&#36;1,890.99</span><span class="changes up"><i class="ccpw_icon-up" aria-hidden="true"></i>2.24%</span></div></li><li id="dogecoin"><div class="coin-container"><span class="ccpw_icon"><img id="dogecoin" alt="dogecoin" src="../wp-content/plugins/cryptocurrency-price-ticker-widget/assets/coin-logos/dogecoin.svg"></span><span class="name">Dogecoin(DOGE)</span><span class="price">&#36;0.073142</span><span class="changes up"><i class="ccpw_icon-up" aria-hidden="true"></i>0.20%</span></div></li><li id="matic-network"><div class="coin-container"><span class="ccpw_icon"><img id="matic-network" alt="matic-network" src="../wp-content/plugins/cryptocurrency-price-ticker-widget/assets/coin-logos/matic-network.svg"></span><span class="name">Polygon(MATIC)</span><span class="price">&#36;0.91</span><span class="changes down"><i class="ccpw_icon-down" aria-hidden="true"></i>-1.99%</span></div></li></ul></div></div><style>.tickercontainer #ccpw-ticker-widget-1121{background-color:#0a0a0a;}
            .tickercontainer #ccpw-ticker-widget-1121 span.name,
            .tickercontainer #ccpw-ticker-widget-1121 .ccpw-credits a {color:#f7f7f7;}
            .tickercontainer #ccpw-ticker-widget-1121 span.coin_symbol {color:#f7f7f7;}
            .tickercontainer #ccpw-ticker-widget-1121 span.price {color:#f7f7f7;} .tickercontainer .price-value{color:#f7f7f7;}
            .ccpw-header-ticker-fixedbar{top:33px !important;}</style>	<script type="text/javascript">
		(function () {
			var c = document.body.className;
			c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
			document.body.className = c;
		})();
	</script>
	<link rel='stylesheet' id='ccpw-styles-css' href='../wp-content/plugins/cryptocurrency-price-ticker-widget/assets/css/ccpw-stylesfc99.css?ver=2.6' media='all' />
<link rel='stylesheet' id='ccpw-bootstrap-css' href='../wp-content/plugins/cryptocurrency-price-ticker-widget/assets/css/bootstrap.minfc99.css?ver=2.6' media='all' />
<link rel='stylesheet' id='ccpw-custom-icons-css' href='../wp-content/plugins/cryptocurrency-price-ticker-widget/assets/css/ccpw-iconsfc99.css?ver=2.6' media='all' />




<script id='wc-add-to-cart-js-extra'>
var wc_add_to_cart_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/?wc-ajax=%%endpoint%%","i18n_view_cart":"View cart","cart_url":"https:\/\/primevests.com\/cart\/","is_cart":"","cart_redirect_after_add":"no"};
</script>




<script src="//code.tidio.co/1pitlmh4lhqgfytpakerk7i3qt0liah2.js" async></script>
<script>
  function notify(status, message) {
    iziToast[status]({
      message: message,
      position: "topRight"
    });
  }
</script>






</body>

<!-- Mirrored from primevests.com/contact-us/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 May 2023 20:28:27 GMT -->
</html>