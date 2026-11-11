<?php 
session_start();
require 'database.php'; // 1. Added database link to load real users

$errors = []; // 3. Standardized variable name to collect error items

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['uname'] ?? '');
    $password = $_POST['psw'] ?? '';

    if (empty($username) || empty($password)) {
        $errors[] = "Please fill in both fields.";
    } else {
        try {
            // Fetch the user data from your real database schema securely
            $sql = "SELECT uname, psw FROM users WHERE uname = :uname LIMIT 1";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':uname', $username);
            $stmt->execute();
            $user = $stmt->fetch();

            // If user exists, check their password against the database hash
            if ($user) {
                if (password_verify($password, $user['psw'])) {
                    $_SESSION['logged_in_user'] = $user['uname'];
                    
                    // Redirect them to the protected home page
                    header("Location: index.php");
                    exit();
                } else {
                    // Generic message prevents attacker enumeration
                    $errors[] = "Invalid username or password.";
                }
            } else {
                $errors[] = "Invalid username or password.";
            }
        } catch (PDOException $e) {
            $errors[] = "Authentication failure occurred. Please try again.";
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
    <a class="logo" href="login.php">Nexus</a>
    <form class="login-container" method="post">    
        <div class="container">
            <?php if (!empty($_SESSION['success_message'])): ?>
                <div style="color: green; margin-bottom: 15px; font-weight: bold;">
                    <?php 
                    echo htmlspecialchars($_SESSION['success_message']); 
                    // Clear it so it disappears if they refresh the login page
                    unset($_SESSION['success_message']); 
                    ?>
                </div>
            <?php endif; ?>
                <!-- 3. Fixed Error Block Layout Loop to match backend array -->
            <?php if (!empty($errors)): ?>
                <div style="color: red; margin-bottom: 15px;">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
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
                <input type="checkbox" checked="checked" name="remember" value="1"> Remember me
            </label>
            <span class="psw"><a href="forgotpassword.html">Forgot password?</a></span>
        </div>
    </form>
</body>

</html>
