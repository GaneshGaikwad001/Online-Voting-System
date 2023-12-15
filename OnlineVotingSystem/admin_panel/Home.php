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
        <div class="col-12">
            <h3> Elections </h3>
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
                    <a href="head_connector.php?viewResult=<?php echo $election_id?>" class="btn btn-sm btn-success">View Results</a>
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
</body>
</html>