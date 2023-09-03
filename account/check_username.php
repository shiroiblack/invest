<?php
// check_username.php

// Database credentials
$servername = "server139";
$dbUsername = "afflmdav_trader";
$dbPassword = "snakes199323";
$dbname = "afflmdav_trade";

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Get the username from the AJAX request
$username = $_GET['username'];

// Check if the username exists in the database
$query = "SELECT * FROM users WHERE username = :username";
$stmt = $pdo->prepare($query);
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Prepare the response
$response = [];
if ($user) {
    $response['status'] = 'error';
    $response['message'] = 'Username already taken';
} else {
    $response['status'] = 'success';
    $response['message'] = 'Username is available';
}

// Send the response back to the client-side
header('Content-Type: application/json');
echo json_encode($response);
?>
