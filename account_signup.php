<?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  // Get and cleans values from the form
  $name = trim($_POST['name'] ?? '');
  $uname = trim($_POST['uname'] ?? '');
  $email = trim($_POST['email'] ?? '');
  // Character casing or trimming can break valid user passwords or weaken complexity.
  $password = $_POST['psw'] ?? '';
  $safe_password = password_hash($password, PASSWORD_DEFAULT);
  $birthday = trim($_POST['birthday'] ?? '');

  $errors = [];
  if (empty($name))  $errors[] = "Full Name is required.";
  if (empty($uname)) $errors[] = "Username is required.";
  
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "A valid email address is required.";
  }
  if (strlen($password) < 8) {
      $errors[] = "Password must be at least 8 characters long.";
  }
  if (empty($birthday)) {
      $errors[] = "Date of birth is required.";
  }

  // 3. Only hash the password if validation passes
  if (empty($errors)) {
      $safe_password = password_hash($password, PASSWORD_DEFAULT);
  }
?>
<!DOCTYPE html>
<!-- Kahlil Nash -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Sign Up</title>
</head>
<body>
  <strong>Thank You for Signing Up!</strong>
  <h3>You have entered the following information:</h3>
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
</body>
</html>