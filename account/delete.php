<?php
// Check if the ID parameter is set in the URL
if (!isset($_GET['id'])) {
    echo "<p>No user ID provided.</p>";
} else {
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

    // Retrieve the user ID from the URL parameter
    $id = $_GET['id'];

    // Delete the user from the database
    $sql = "DELETE FROM users WHERE id = '$id'";
    if (mysqli_query($connection, $sql)) {
        // Redirect back to the admin.php page after successful deletion
        header("Location: admin.php");
        exit();
    } else {
        echo "Error deleting user: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
