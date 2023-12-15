<?php
include("connect.php");
$name = $_POST["name"];
$birthdate = $_POST["birthdate"];
$mobile = $_POST["mobile"];
$voter_id = $_POST["voter_id"];
$password = $_POST["password"];
$Cpassword = $_POST["Cpassword"];
$address = $_POST["address"];
$image = $_FILES["photo"]["name"];
$tmp_name = $_FILES["photo"]["tmp_name"];
$role = $_POST["role"];

if($password==$Cpassword){
    move_uploaded_file($tmp_name,"../uploads/$image");
    $insert = mysqli_query($conn, "INSERT INTO voter(name, birthdate, mobile, voter_id, password, address, photo, role, status, votes)
     VALUES('$name', '$birthdate', '$mobile', '$voter_id', '$password','$address', '$image', '$role',0,0)");

     if($insert){
        echo '
        <script>
        alert("registration succesfully");
        window.location = "../";
        </script>
        ';
     }
     else{
        echo '
        <script>
        alert("Some error occured");
        window.location = "../routes/register.html";
        </script>
        ';
     }
}
else{
    echo '
    <script>
    alert("password not matched");
    window.location = "../routes/register.html";
    </script>
    ';
}
?>