<?php
session_start();
if(!isset($_SESSION['userdata'])){
    header("../");
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if($_SESSION['userdata']['status']==0){
    $status = '<b style="color:red">Not Voted</b>';
}
else{
    $status = '<b style="color:green">Voted</b>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - dashboard</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <style>
        #back{
            float: left;
            margin-left: 30px;
            margin-top: 15px;
            width: 100px;
            height: 30px;
            background-color:  rgb(50, 120, 185);
            color: white;
            border: 2px groove black;
            border-radius: 5px;
        }
        #logout{
            float: right;
            margin-right: 30px;
            margin-top: 15px;
            width: 100px;
            height: 30px;
            background-color:  rgb(50, 120, 185);
            color: white;
            border: 2px groove black;
            border-radius: 5px;
        }
        #profile{
            margin: 40px 0px 0px 30px;
            border: 1px groove black;
            background-color: antiquewhite;
            width: 30%;
            padding: 50px;
            float: left;
        }
        #group{
            margin: 40px 0px 0px 0px;
            border: 1px groove black;
            background-color: antiquewhite;
            width: 50%;
            float: right;
            padding: 50px;
        }
        #voted{
            color: white;
            background-color: blue;
        }
    </style>
    <div class="main">
    <div class="header">
    <a href="../"><button id="back">Back </button></a> 
    <a href="logout.php"><button id="logout">Logout</button></a> 
    <h1>Online Voting System</h1>
  </div><br>

  <div id="profile">
   <center> <img src="../uploads/<?php echo $userdata['photo'] ?>" height="100px" width="100px" alt="user image"><br><br></center>
    <b>name : </b><?php echo $userdata['name'] ?><br><br>
    <b>mobile : </b><?php echo $userdata['mobile'] ?><br><br>
    <b>voter_id : </b><?php echo $userdata['voter_id'] ?><br><br>
    <b>address : </b><?php echo $userdata['address'] ?><br><br>
    <b>status : </b><?php echo $status ?>
  </div>
  <div id="group">
    <?php
    if($_SESSION['groupsdata']){
        for($i=0; $i<count($groupsdata); $i++){
            ?>
            <div>
                <img style="float:right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100px" width="100px" alt="group image"><br><br>
               <div class="left">
               <b>Group name : </b><?php echo $groupsdata[$i]['name']?><br><br>
                <b>votes : </b><?php echo $groupsdata[$i]['votes']?><br><br>
               </div>
                <form action="../API/vote.php" method="POST">
                    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
                    <?php
                    if($_SESSION['userdata']['status']==0){
                        ?>
                          <input type="submit" name="votebtn" value="vote" id="votebtn">
                          <?php
                    }
                    else{
                        ?>
                        <button disabled type="button" name="votebtn" value="vote" id="voted">voted</button>
                        <?php
                    }
                    ?>
                  
                </form>
            </div>
            <hr>
            <?php
        }
    }
    else{

    }
    ?>
  </div>
    </div>
    
</body>
</html>