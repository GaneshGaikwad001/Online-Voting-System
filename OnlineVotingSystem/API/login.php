<?php
session_start();
include("connect.php");

$voter_id =$_POST['voter_id'];
$password =$_POST['password'];
$role = $_POST['role'];
$check = mysqli_query($conn, "SELECT * FROM voter WHERE voter_id ='$voter_id' AND password = '$password' AND role = '$role'");

if(mysqli_num_rows($check)>0){
    $userdata = mysqli_fetch_array($check);
    $groups = mysqli_query($conn, "SELECT * FROM voter WHERE role = 2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['userdata'] = $userdata;
    $_SESSION['groupsdata'] = $groupsdata;

    echo '
    <script>
    window.location = "../routes/dashboard.php";
    </script>
    ';
}
else{
    echo '
    <script>
    alert("user not found");
    window.location = "../";
    </script>
    ';
}
?>