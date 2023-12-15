<?php
  include('../API/connect.php');
  date_default_timezone_set("Asia/Kolkata");

  if(isset($_POST['e_id']) AND isset($_POST['c_id']) AND isset($_POST['v_id'])){
    $vote_date = date("y-m-d");
    $vote_time = date("h:i:s a");
  
    mysqli_query($conn, "INSERT INTO vote(election_id, candidate_id, voter_id, vote_date, vote_time)
    VALUES('". $_POST['e_id'] ."', '". $_POST['c_id'] ."','". $_POST['v_id'] ."','". $vote_date ."','". $vote_time ."')");   
    echo "success";
  }
?>