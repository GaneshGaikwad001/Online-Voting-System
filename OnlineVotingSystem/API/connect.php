<?php

$conn = mysqli_connect("localhost","root","","Voting") or die("connection failed");

if($conn){
    echo "connected";
}
else{
    echo "not connected";
}
?>