<?php 
session_start();

// Simulated database using hardcoded arrays
$mock_users = [

    "admin" => password_hash("password123", PASSWORD_DEFAULT),
    "student" => password_hash("nexus2026", PASSWORD_DEFAULT),
    "webdev_user" => password_hash("securepass", PASSWORD_DEFAULT)
];

$error_message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['uname']);
    $password = $_POST['psw'];

    if(empty($username) || empty($password)) {
        $error_message = "Please fill in both fields.";
    } else {
        // Check if the username exists in our array and the password matches
        if(array_key_exists($username, $mock_users)) {

            // Grab the generated hash for that user
            $stored_hash = $mock_users[$username];

            // User password_verify to check if the password matches the hash
            if(password_verify($password, $stored_hash)) {
                $_SESSION['logged_in_user'] = $username;
            // Redirect them to the protected page
            header("Location: index.php");
            exit;
        } else {
            $error_message = "Invalid username or password.";
        } 
        } else {
            $error_message = "Invalid username or password.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus</title>
</head>

<body>
    <a class="logo">Nexus</a>
    <form class="login-container" method="post">
        <div class="container">
        <?php if (!empty($error_message)): ?>
            <div style="color: red; margin-bottom: 15px;">
                <strong>Error:</strong> <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
            <div class="login-label">
                <strong>Log into Nexus</strong>
            </div>
            <input type="text" placeholder="Username" name="uname" pattern="^\S+$"
                title="Spaces are not allowed in the username." required>
            <input type="password" placeholder="Password" name="psw" required>
            <button type="submit">Login</button>
            <span class="newaccount"><a href="register.php">Create a new account</a></span>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
            <span class="psw"><a href="forgotpassword.html">Forgot password?</a></span>
        </div>
    </form>
</body>

</html>