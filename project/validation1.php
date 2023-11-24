<?php

session_start();






$con = mysqli_connect('localhost:3306','root','','user');

mysqli_select_db($con, 'lpl');


$username = $_POST['username'];
$password = $_POST['password'];

$s= "select * from userdata where username = '$username' && password = '$password'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    header('location:index.html');
}
else{
    header('location:login.php');
  

}



?>