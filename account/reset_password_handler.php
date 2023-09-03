<?php
// Database credentials
$servername = "server343";
$dbUsername = "truspqek_coin";
$dbPassword = "snakes199323";
$dbname = "truspqek_coin";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbUsername, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Validate the email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address";
        exit();
    }

    // Check if the email exists in the database
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Email not found";
        exit();
    }

    // Generate a reset token (example implementation)
    $resetToken = bin2hex(random_bytes(32));

    // Save the reset token and associated email in the database
    $stmt = $db->prepare("INSERT INTO password_resets (email, token) VALUES (:email, :token)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':token', $resetToken);
    $stmt->execute();

    // Send the password reset instructions to the user's email (example implementation)
    $resetLink = "https://www.example.com/reset_password.php?token=" . urlencode($resetToken);
    $emailSubject = "Password Reset Instructions";
    $emailBody = "Dear User,\n\n";
    $emailBody .= "To reset your password, please click on the following link:\n";
    $emailBody .= $resetLink . "\n\n";
    $emailBody .= "If you did not request a password reset, please ignore this email.\n\n";
    $emailBody .= "Regards,\nThe Example Team";

    // Send the email using a mail library or your preferred method
    // ...

    echo "Instructions to reset your password have been sent to your email address.";
}
?>
