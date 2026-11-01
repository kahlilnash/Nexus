<? 



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
    <a class="logo" href="login.html">Nexus</a>
    <br>
    <form action="account_signup.php" class="login-container" method="POST">
        <div class="container">
            <div class="login-label">
                <strong>Create a new account</strong>
            </div>

            <label for="fullname"><strong>Full Name</strong></label>
            <input type="text" placeholder="Full Name" name="name" class="textbox" required>

            <!-- 
                ^(Caret): start of a string
                \S(Capital S): Matches any non-white space characters (\s means the exact opposite—it matches only spaces)
                +(Plus Sign): A quantifier meaning one or more times. Ensures user types at least one character.
                $(Dollar sign): Asserts the end of the string. It ensures the rule applies to the entire input, not just the beginning.
            -->
            <label for="username"><strong>Username</strong></label>
            <input type="text" placeholder="Username" name="uname" pattern="^\S+$"
                title="Spaces are not allowed in the username." required>

            <label for="email"><strong>Email</strong></label>
            <input type="email" placeholder="Email" name="email" pattern="^\S+$"
                title="Spaces are not allowed in the email." required>

            <label for="password"><strong>Password</strong></label>
            <input type="password" placeholder="Password" name="psw" pattern="^\S+$"
                title="Spaces are not allowed in the password." required>

            <label for="birthday"><strong>Date of Birth</strong></label>
            <input type="date" id="birthday" name="birthday" min="01-01-1920" max="12-31-2026" required>

            <input type="submit" value="Submit">
            <a href="login.html">
                <p>Back</p>
            </a>
    </form>
</body>

</html>