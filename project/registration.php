<?php
session_start();
require('db.php');

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $mobile = mysqli_real_escape_string($con, $_POST["mobile"]); // Added Mobile Number

    // Perform basic data validation here (e.g., check if fields are not empty)

    // Insert the data into the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO tetb1 (name, email, username, password, mobile)
            VALUES ('$name', '$email', '$username', '$hashed_password', '$mobile')";

    if (mysqli_query($con, $sql)) {
        $_SESSION['username'] = $username;
        header("Location: login.php"); // Redirect to login.php
        exit();
    } else {
        $error_message = "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>My Project - Registration</title>
    <link rel="icon" href="alien.png" type="image/icon type" /> 
    <link rel="stylesheet" type="text/css" href="loginpage.css" />
    <link rel="stylesheet" type="text/css" href="registrationpage.css" />
</head>

<body>
    <div id="container">
        <div id="icon">
            <img src="./assets/images/logo/TE.png" />
            <h1>Create an Account</h1>
        </div>
        <form id="registration-form" method="post" action="">
            <!-- ... Your existing HTML content ... -->

            <!-- Add the following fields to your existing form -->
            <div class="registration-row">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required/>
            </div>
            <div class="registration-row">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required/>
            </div>
            <div class="registration-row">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required/>
            </div>
            <div class="registration-row">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required/>
            </div>
            <div class="registration-row">
                <label for="mobile">Mobile Number</label>
                <input type="text" id="mobile" name="mobile" required/>
            </div>

            <div id="register-button">
                <input type="submit" value="Register" />
            </div>
        </form>
        <?php if ($error_message) : ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
