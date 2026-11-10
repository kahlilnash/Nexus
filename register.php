<?php 
session_start();
require 'database.php';

$errors = [];
$okay = true;

$fullName = '';
$username = '';
$email = '';
$rawPassword = '';
$dob = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['name'] ?? '');
    $username = trim($_POST['uname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $rawPassword = $_POST['psw'] ?? '';
    $dob = $_POST['birthday'] ?? '';

    if (empty($fullName)) {
        $errors[] = "Enter your name.";
        $okay = false;
    }

    if (empty($username)) {
        $errors[] = "Enter a username.";
        $okay = false;
    }

    if (empty($email)) {
        $errors[] = "Enter your email.";
        $okay = false;
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Enter a valid email.";
        $okay = false;
    }

    if (empty($rawPassword)) {
        $errors[] = "Enter a password.";
        $okay = false;
    } elseif (strlen($rawPassword) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
        $okay = false;
    }

    if (empty($dob)) {
        $errors[] = "Enter your date of birth.";
        $okay = false;
    } else {
        $birthdayDate = new DateTime($dob);
        $today = new DateTime();
        $ageDifference = $today->diff($birthdayDate);

        if ($ageDifference->y < 13) {
            $errors[] = "You must be at least 13 years old to create an account.";
            $okay = false;
        }
    }

    if ($okay) {
        try { 
            $sql = 'INSERT INTO users (
                name, uname, email, psw, birthday
            ) VALUES (
                :name, :uname, :email, :psw, :birthday
            )';

            $stmt = $dbh->prepare($sql);

            $hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

            $stmt->bindValue(':name', $fullName);
            $stmt->bindValue(':uname', $username);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':psw', $hashedPassword);
            $stmt->bindValue(':birthday', $dob);
            $stmt->execute();

            $_SESSION['registered_data'] = [
                'name' => $fullName,
                'uname' => $username,
                'email' => $email,
                'birthday' => $dob
            ];

            $_SESSION['success_message'] = "Account created successfully!";
            header("Location: account_signup.php"); // Redirect straight to login page upon success
            exit();
        } catch (PDOException $e) {
            // Check for MySQL Duplicate Entry error code 23000
            if ($e->getCode() == 23000) {
                $errors[] = "That username or email is already registered.";
            } else {
                $errors[] = "Database Error: " . $e->getMessage();
            }
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
    <title>Register</title>
</head>

<body>
    <a class="logo" href="login.php">Nexus</a>
    <br>
    <form action="" class="login-container" method="POST">
        <div class="container">
            <div class="login-label">
                <strong>Create a new account</strong>
            </div>

            <?php if (!empty($errors)) : ?>
                <div class="error-box" style="color: red; margin-bottom: 15px;">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <label for="fullname"><strong>Full Name</strong></label>
            <input type="text" placeholder="Full Name" name="name" class="textbox" value="<?php echo htmlspecialchars($fullName); ?>" required>

            <label for="username"><strong>Username</strong></label>
            <!-- FIXED: Added missing 'echo' keyword inside value attribute -->
            <input type="text" placeholder="Username" name="uname" pattern="^\S+$"
                title="Spaces are not allowed in the username." value="<?php echo htmlspecialchars($username); ?>" required>

            <label for="email"><strong>Email</strong></label>
            <!-- FIXED: Added missing 'echo' keyword inside value attribute -->
            <input type="email" placeholder="Email" name="email"
                value="<?php echo htmlspecialchars($email); ?>" required>

            <label for="password"><strong>Password</strong></label>
            <input type="password" placeholder="Password" name="psw" pattern="^\S+$"
                title="Spaces are not allowed in the password." required>

            <label for="birthday"><strong>Date of Birth</strong></label>
            <input type="date" id="birthday" name="birthday" min="1920-01-01" max="2026-12-31" value="<?php echo htmlspecialchars($dob); ?>" required>

            <input type="submit" value="Submit">
            <a href="login.php">
                <p>Back</p>
            </a>
        </div>
    </form>
</body>

</html>
