<?php
if(isset($_GET['delete_id'])){
    mysqli_query($conn, "DELETE FROM voter WHERE id = '".$_GET['delete_id']."'");
}
?>
<h3>Voters Details</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">sno</th>
      <th scope="col">photo</th>
      <th scope="col">Name</th>
      <th scope="col">Birthdate</th>
      <th scope="col">mobile</th>
      <th scope="col">Voter id</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Address</th>
      <th scope="col">Action</th>
     
    </tr>
  </thead>
  <tbody>
    <?php
    $fetchingData =mysqli_query($conn,"SELECT * FROM voter") or die(mysqli_error($conn));
    $isAnyElectionAdded = mysqli_num_rows($fetchingData);

    if($isAnyElectionAdded > 0){
        $sno = 1;
        while($row = mysqli_fetch_assoc($fetchingData)){
            $voter_id = $row['id'];
            $photo = $row['photo'];
            ?>
            <tr>
                <td><?php echo $sno++ ?></td>
                <td><img src="../voter_images/<?php echo $photo;?>"class="photo"/></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['birthdate']; ?></td>
                <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['voter_id']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td>
                    <button  class="btn btn-sm btn-danger" onclick="DeleteData(<?php echo $voter_id; ?>)">Delete</button>
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
     <script>
        const DeleteData = (v_id) =>
        {
            let c =confirm("Are you really want to delete it?");
            if(c == true){
                location.assign("head_connector.php?voters&delete_id=" +v_id);
            }
        }
    </script>
  </tbody>
</table>