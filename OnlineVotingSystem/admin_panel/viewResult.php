<?php
  $election_id = $_GET['viewResult'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .voting{
            margin-left: 25px;
            
        }
  .photo{
            width: 80px;
            height: 80px;
            border: 1px solid #67c232;
            border-radius: 100%;
        }
        #voted{
            color: white;
            background-color: blue;
            padding-left: 5px;
            padding-right: 5px;
        }
        .table{
            margin:10px 25px 10px 25px ;
        }
    </style>
</head>
<body> 
  <div class="row my-3">
    <div class="col-10" >

    </div>
           
    <?php
    include('../API/connect.php');
    $fetchingActiveElection = mysqli_query($conn, "SELECT * FROM election WHERE id ='$election_id'");
    $totalActiveElection = mysqli_num_rows($fetchingActiveElection);

    if($totalActiveElection > 0){
        $sno = 1;
        while($data = mysqli_fetch_assoc($fetchingActiveElection)){
            $election_id = $data['id'];
            $election_topic = $data['election_topic'];
            ?>
                    <table class ="table">
                    <thead>
            <tr>
                <th colspan="6"><h4>Election Name : <?php echo strtoupper( $election_topic); ?> </h4> </th>
            </tr>
            <tr>
                <th>Sno</th>
                <th>Party Symbol</th>
                <th>Party Name</th>
                <th>Candidate Name</th>
                <th>Votes</th>
                <th>Result</th>

            </tr>
        </thead>
                        <tbody>
            <?php
            $fetchingCandidate = mysqli_query($conn, "SELECT * FROM candidate WHERE election_id = $election_id");

            while($candidateData = mysqli_fetch_assoc($fetchingCandidate)){
                $candidate_id = $candidateData['id'];
                $party_symbol= $candidateData['party_symbol'];

                $fetchingvotes = mysqli_query($conn, "SELECT * FROM vote WHERE candidate_id = $candidate_id");
                $totalVotes = mysqli_num_rows($fetchingvotes);

             
            ?>
            <tr>
            <td><?php echo $sno++ ?></td>
            <td><img src="../party_symbol/<?php echo $party_symbol;?>" class="photo"/></td>
            <td><?php echo $candidateData['party_name']; ?></td>
            <td><?php echo $candidateData['candidate_name']; ?></td>
            <td><?php echo $totalVotes?></td>
            <td>
         
    
            </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
                    </table>
                    <?php
                }
            }else{
                echo "No any active election";
            }
        
            ?>

            <hr> <hr>
            <br>
            <div class="voting">
            <h4>Voting Details</h4><br>
            <table class="table">
            <tr>
                    <th>Sno</th>
                    <th>Voter Name</th>
                    <th>Voter ID</th>
                    <th>Voted To</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
                <?php
                include("../API/connect.php");
                $fetchingVoteDetails = mysqli_query($conn, "SELECT * FROM vote WHERE election_id = '$election_id'");
                $number_of_votes = mysqli_num_rows($fetchingVoteDetails);

                if($number_of_votes >0){
                    $sno =1;
                
                    while($data = mysqli_fetch_assoc($fetchingVoteDetails)){
                        $voter_id = $data['voter_id'];
                        $candidate_id = $data['candidate_id'];
                        $fetchingusername = mysqli_query($conn, "SELECT * FROM voter WHERE voter_id = '$voter_id'");
                        $isDataAvailable = mysqli_num_rows($fetchingusername);

                        if($isDataAvailable > 0){
                            $userData = mysqli_fetch_assoc($fetchingusername);
                            $name = $userData['name'];
                            $user_id = $userData['voter_id'];
                        }

                        $fetchingCandidate = mysqli_query($conn, "SELECT * FROM candidate WHERE id = '$candidate_id'");
                        $isDataavailable = mysqli_num_rows($fetchingCandidate);

                        if($isDataavailable  > 0){
                            $candidateData = mysqli_fetch_assoc($fetchingCandidate);
                            $candidate_name = $candidateData['candidate_name'];
                        }

                        ?>
                        <tr>
                            <td><?php echo $sno++; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $voter_id; ?></td>
                            <td><?php echo $candidate_name; ?></td>
                            <td><?php echo $data['vote_date']; ?></td>
                            <td><?php echo $data['vote_time']; ?></td>
                        </tr>
                        <?php
                    }
                
                }else{
                    echo "No any vote details is available";
                }
                ?>
            </table>
            </div>
  </div>
    </div>
</body>
</html>