<?php
session_start();
include("connect.php");

$username =$_POST['username'];
$password =$_POST['password'];
$check = mysqli_query($conn, "SELECT * FROM admin WHERE username ='$username' AND password = '$password'");

if(mysqli_num_rows($check)>0){
    $admindata = mysqli_fetch_array($check);
    $_SESSION['admindata'] = $admindata;

    echo '
    <script>
    window.location = "../routes/admin.html";
    </script>
    ';
}
else{
    echo '
    <script>
    alert("username and password are incorrect");
    window.location = "../";
    </script>
    ';
}

?>