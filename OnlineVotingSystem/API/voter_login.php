<?php
include("connect.php");
session_start();

$voter_id =$_POST['voter_id'];
$password =$_POST['password'];
$check = mysqli_query($conn, "SELECT * FROM voter WHERE voter_id ='$voter_id' AND password = '$password'");

if(mysqli_num_rows($check)>0){
    $userdata = mysqli_fetch_array($check);
    $_SESSION['userdata'] = $userdata;
 
    echo '
    <script>
    window.location = "../routes/dashboard.php";
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