<?php
include('connect.php');

require_once("../admin_panel/header.html");
if(isset($_GET['Home'])){
    require_once("../admin_panel/Home.php");
}
else if(isset($_GET['AddElection'])){
    require_once("../admin_panel/add_election.php");
}
else if(isset($_GET['AddCandidate'])){
    require_once("../admin_panel/add_candidate.php");
}    
else if(isset($_GET['AddVoters'])){
    require_once("../admin_panel/add_voters.php");
}     
else if(isset($_GET['voters'])){
    require_once("../admin_panel/voters.php");
} 
else if(isset($_GET['viewResult'])){
    require_once("../admin_panel/viewResult.php");
}
?>