<?php 
session_start();
require 'database.php';

// Guard: Redirect back to signup if they try to access this page directly
if (!isset($_SESSION['registered_data'])) {
    header("Location: register.php");
    exit();
}

// Retrieve data from session storage
$userData = $_SESSION['registered_data'];
$name = $userData['name'];
$uname = $userData['uname'];
$email = $userData['email'];
$birthday = $userData['birthday'];

// Clear the session data so refreshing doesn't cause security leakage
unset($_SESSION['registered_data']);
?>
<!DOCTYPE html>
<!-- Kahlil Nash -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Sign Up Success</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
    <div class="container">
      <h3>Thank You For Signing Up!</h3>
      <strong>You have entered the following information:</strong>
      <p>
        <strong>Full Name: </strong><?php echo htmlspecialchars($name); ?>
        <br>
        <strong>Username: </strong><?php echo htmlspecialchars($uname); ?>
        <br>
        <strong>Email: </strong><?php echo htmlspecialchars($email); ?>
        <br>
        <strong>Password: </strong>********
        <br>
        <strong>Date of Birth: </strong><?php echo htmlspecialchars($birthday);?>
      </p>
      <br>
      <a href="login.php">Go to Login</a>
    </div>
  </div>
</body>
</html>
