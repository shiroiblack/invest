<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Start the session


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
            $query = "SELECT * FROM users WHERE username = :username";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            // Check if a matching user record is found
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Authentication successful
                    // Store user information in session or set a cookie
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    // Debugging: Output the fetched user record
    //print_r($user);
                    // Redirect the user to the desired page after successful login
                    header('Location: dashboard');
                    exit();
                } else {
                    // Add an error message if the password is incorrect
                    $errors[] = "Incorrect password.";
                }
            } else {
                // Add an error message if the username is not found
                $errors[] = "Username not found.";
            }
        } catch (PDOException $e) {
            // Handle any database connection errors
            $errors[] = "Database connection error: " . $e->getMessage();
        }
    }
}

// If there are errors, redirect back to the login page with error messages
// Add this code in login_handler.php when there is an error
$error = "Invalid username or password.";
include 'login.php';
exit();?>

