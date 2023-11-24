<?php
// Enter your host name, database username, password, and database name.
// If you have not set a database password on localhost, then set it empty.
$con = mysqli_connect("localhost:3306", "root", "", "new_data");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
