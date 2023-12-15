<?php
include("connect.php");
$fetchingElection = mysqli_query($conn, "SELECT * FROM election") or die(mysqli_error($conn));
while($data = mysqli_fetch_assoc($fetchingElection)){
    $starting_date = $data['starting_date'];
    $ending_date = $data['ending_date'];
    $curr_date = date("y-m-d");
    $election_id = $data['id'];
    $status = $data['status'];

    if($status == "Active"){
        $date1=date_create($curr_date);
        $date2=date_create($ending_date);
        $diff=date_diff($date1,$date2);

        if((int)$diff->format("%R%a") <0){
            
            mysqli_query($conn, "UPDATE election SET status = 'Expired' WHERE id = $election_id") or die(mysqli_error($conn));
        }
    }else if($status == "Inactive"){
        $date1=date_create($curr_date);
        $date2=date_create($starting_date);
        $diff=date_diff($date1,$date2);

        if((int)$diff->format("%R%a")<= 0){
            mysqli_query($conn, "UPDATE election SET status = 'Active' WHERE id = $election_id") or die(mysqli_error($conn));
        }
    }
}
?>

<?php
include('connect.php');
if(isset($_GET['added'])){
    ?>
    <div class="alert alert-success" role="alert">
   Election has been added successfully.
</div>
    <?php
}else if(isset($_GET['delete_id'])){
    mysqli_query($conn, "DELETE FROM election WHERE id = '".$_GET['delete_id']."'");
    ?>
    <div class="alert alert-danger" role="alert">
   Election has been deleted successfully.
</div>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h3{
            margin:20px;
            margin-left: 10px;
        }
        #btn{
            margin-left: 20px;
        }
        .form-group{
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="row my-3">
        <div class="col-4">
            <h3>Add New Election
            </h3>
            <form action="" method="post">
               <div class="form-group">
                <input type="text" name="election_topic" placeholder="election topic" class="form-control" required>
               </div>   
               <div class="form-group">
                <input type="number" name="number_of_candidate" placeholder="number of candidate" class="form-control" required>
               </div>  
               <div class="form-group">
                <input type="text" onfocus="this.type='date'" name="starting_date" placeholder="Starting Date" class="form-control" required>
               </div>  
               <div class="form-group">
                <input type="text" onfocus="this.type='date'" name="ending_date" placeholder="Ending Date" class="form-control" required>
               </div> 
               <div>
                <input type="submit" value="Add Election" name="addelection" id="btn" class="btn btn-success">
               </div>
            </form>
        </div>
        <div class="col-8">
            <h3>Upcomming Election</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">sno</th>
      <th scope="col"> Election Topic </th>
      <th scope="col"> Number of candidate </th>
      <th scope="col"> Starting Date </th>
      <th scope="col"> Ending Date </th>
      <th scope="col"> Status </th>
      <th scope="col"> Action </th>
    </tr>
  </thead>
  <tbody>
    <?php
    $fetchingData =mysqli_query($conn,"SELECT * FROM election") or die(mysqli_error($conn));
    $isAnyElectionAdded = mysqli_num_rows($fetchingData);

    if($isAnyElectionAdded > 0){
        $sno = 1;
        while($row = mysqli_fetch_assoc($fetchingData)){
            $election_id = $row['id'];
            ?>
            <tr>
                <td><?php echo $sno++ ?></td>
                <td><?php echo $row['election_topic']; ?></td>
                <td><?php echo $row['number_of_candidate']; ?></td>
                <td><?php echo $row['starting_date']; ?></td>
                <td><?php echo $row['ending_date']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                 
                    <button  class="btn btn-sm btn-danger" onclick="DeleteData(<?php echo $election_id; ?>)">Delete</button>
                </td>
            </tr>
            <?php
        }

    }else{
        ?>
        <tr>
            <td colspan="?">No any election is added yet.</td>
        </tr>
        <?php
    }
    ?>
  </tbody>
</table>
        </div>
    </div>

    <script>
        const DeleteData = (e_id) =>
        {
            let c =confirm("Are you really want to delete it?");
            if(c == true){
                location.assign("head_connector.php?AddElection&delete_id=" + e_id);
            }
        }
    </script>

    <?php
    include('connect.php');
    if(isset($_POST['addelection'])){
        $election_topic = $_POST['election_topic'];
        $number_of_candidate = $_POST['number_of_candidate'];
        $starting_date = $_POST['starting_date'];
        $ending_date = $_POST['ending_date'];
        $inserted_on = date("y-m-d");

        $date1=date_create($inserted_on);
        $date2=date_create($starting_date);
        $diff=date_diff($date1,$date2);
        echo $diff->format("%R%a");

        if((int)$diff->format("%R%a")>0){
            $status = "Inactive";
        }else{
            $status = "Active";
        }

        mysqli_query($conn,"INSERT INTO election(election_topic,number_of_candidate,starting_date,
        ending_date, status, inserted_on)
        VALUES('$election_topic','$number_of_candidate','$starting_date','$ending_date',
        '$status','$inserted_on')");
        ?>
        <script> location.assign("head_connector.php?AddElection&added=1");</script>
        <?php
    }
    ?>
</body>
</html>