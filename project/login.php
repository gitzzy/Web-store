<?php
session_start();
require('db.php');

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM `tetb1` WHERE username='$username'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Incorrect Password.";
        }
    } else {
        $error_message = "Incorrect Username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>My Project</title>
    <link rel="icon" href="alien.png" type="image/icon type"/>
    <link rel="stylesheet" type="text/css" href="loginpage.css"/>
</head>

<body>
    <div id="container">
        <div id="icon">
            <img src="./assets/images/logo/TE.png" />
            <h1>Hey, good to see you again!</h1>
            <h2>Login to get going.</h2>
        </div>
        <div id="box">
            <form id="loginForm" method="post" action="">
                <div id="user">
                    <fieldset>
                        <legend>Email or Username</legend>
                        <input type="text" name="username" maxlength="50" required/>
                    </fieldset>
                </div>
                <div id="passw">
                    <fieldset>
                        <legend>Password</legend>
                        <input type="password" name="password" maxlength="8" required/>
                    </fieldset>
                </div>
                <div id="signin">
                    <button type="submit" value="Sign in">Submit</button>
                </div>
            </form>
        </div>
        <ul style="display: inline;">
            <li><a href="registration.php">Create an account</a></li>
            <li><a href="#forgpassw">Forgot your password?</a></li>
        </ul>
        <?php if ($error_message) : ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
