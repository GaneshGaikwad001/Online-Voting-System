<?php
if(isset($_GET['add'])){
    ?>
    <div class="alert alert-success" role="alert">
   Candiadte has been added successfully.
</div>
    <?php
}else if(isset($_GET['delete_id'])){
    mysqli_query($conn, "DELETE FROM candidate WHERE id = '".$_GET['delete_id']."'");
    ?>
    <div class="alert alert-danger" role="alert">
   Candiadte has been deleted successfully.
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
    <title>Candidate Details</title>
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
        .photo{
            width: 80px;
            height: 80px;
            border: 1px solid #67c232;
            border-radius: 100%;
        }
    </style>
</head>
<body>
    <div class="row my-3">
        <div class="col-4">
            <h3>Add New Candidate
            </h3>
            <form action="" method="post" enctype="multipart/form-data">
               <div class="form-group">
                <select class="form-control" name="election_id" required>
                    <option value="">Select election</option>
                    <?php
                    $fetchingElection = mysqli_query($conn,"SELECT * FROM election WHERE status ='Active'") or die(mysqli_error($conn));
                    $isAnyElectionAdded = mysqli_num_rows($fetchingElection);
                    if($isAnyElectionAdded >0){
                        while($row = mysqli_fetch_assoc($fetchingElection)){
                            $election_id = $row['id'];
                            $election_name = $row['election_topic'];
                            $allowed_candidate = $row['number_of_candidate'];

                            $fetchingcandidate = mysqli_query($conn, "SELECT * FROM candidate WHERE election_id = $election_id");
                            $added_candidate = mysqli_num_rows($fetchingcandidate);

                            if($added_candidate < $allowed_candidate){
                            ?>
                            <option value="<?php echo $election_id;?>"><?php echo $election_name; ?></option>
                            <?php
                            }
                        }
                        }else{
                            ?>
                          
                            <option value="">no any election registered</option>
                            <?php
                        }
                    ?>
                </select>
               </div> 
               <div class="form-group">
                <input type="text" name="party_name" placeholder="party name" class="form-control" required>
               </div>   
               <div class="form-group">
                <input type="text" name="candidate_name" placeholder="name of candidate" class="form-control" required>
               </div>  
               <div class="form-group">
                <input type="file" name="party_symbol"  class="form-control" required>
               </div>  
               <div class="form-group">
                <input type="text" name="candidate_details" placeholder="candidate details" class="form-control" required>
               </div> 
               <div>
                <input type="submit" value="Add candidate" name="add_candidate" id="btn" class="btn btn-success">
               </div>
            </form>
        </div>
        <div class="col-8">
            <h3>Candidate Details</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">sno</th>
      <th scope="col">Party Symbol</th>
      <th scope="col">candidate name</th>
      <th scope="col">election name</th>
      <th scope="col">party name</th>
      <th scope="col">candidate details</th>
      <th scope="col">Action </th>
    </tr>
  </thead>
  <tbody>
    <?php
    $fetchingData =mysqli_query($conn,"SELECT * FROM candidate") or die(mysqli_error($conn));
    $isAnyCandidateAdded = mysqli_num_rows($fetchingData);

    if($isAnyCandidateAdded > 0){
        $sno = 1;
        while($row = mysqli_fetch_assoc($fetchingData)){
            $candidate_id = $row['id'];
            $election_id = $row['election_id'];
            $fetchingElectionName = mysqli_query($conn, "SELECT * FROM election WHERE id = '$election_id'");
            $fetchingElectionNameQuery = mysqli_fetch_assoc($fetchingElectionName);
            $election_name = $fetchingElectionNameQuery['election_topic'];
            $party_symbol = $row['party_symbol'];
            ?>
            <tr>
                <td><?php echo $sno++ ?></td>
                <td><img src="../party_symbol/<?php echo $party_symbol;?>"class="photo"/></td>
                <td><?php echo $row['candidate_name']; ?></td>
                <td><?php echo $election_name;?></td>
                <td><?php echo $row['party_name']; ?></td>
                <td><?php echo $row['candidate_details']; ?></td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="DeleteData(<?php echo $candidate_id;?>)">Delete</button>
                </td>
            </tr>
            <?php
        }

    }else{
        ?>
        <tr>
            <td colspan="?">No any candidate is added yet.</td>
        </tr>
        <?php
    }
    ?>
  </tbody>
</table>
        </div>
    </div>
    <script>
        const DeleteData = (c_id) =>
        {
            let c =confirm("Are you really want to delete it?");
            if(c == true){
                location.assign("head_connector.php?AddCandidate&delete_id=" + c_id);
            }
        }
    </script>
    <?php
    include('connect.php');
    if(isset($_POST['add_candidate'])){
        $election_id = $_POST['election_id'];
        $party_name = $_POST['party_name'];
        $candidate_name = $_POST['candidate_name'];
        $party_symbol = $_FILES["party_symbol"]["name"];
        $tmp_name = $_FILES["party_symbol"]["tmp_name"];
        move_uploaded_file($tmp_name, "../party_symbol/$party_symbol");
        $candidate_details = $_POST['candidate_details'];
        $inserted_on = date("y-m-d");

        mysqli_query($conn,"INSERT INTO candidate(election_id,party_name,candidate_name,
        party_symbol,candidate_details,inserted_on)
        VALUES('$election_id','$party_name','$candidate_name','$party_symbol',
        '$candidate_details','$inserted_on')");
        ?>
        <script> location.assign("head_connector.php?AddCandidate&add=1");</script>
        <?php
    }
    ?>
</body>
</html>