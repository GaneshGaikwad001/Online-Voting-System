<?php
if(isset($_GET['added'])){
    ?>
    <div class="alert alert-success" role="alert">
    voter has been added successfully.
</div>
    <?php
}elseif(isset($_GET['error'])){
  ?>
  <div class="alert alert-warning" role="alert">
  Some error occured.
</div>
  <?php
}elseif(isset($_GET['notmatched'])){
  ?>
  <div class="alert alert-warning" role="alert">
  password are not matched.
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
    <title>Voters</title>
    <style>
      .heading{
        text-align: center;
        font-size: 30px;
        font-weight: bolder;
      }
      #form{
        margin: 10px 100px 0px 100px;
        padding: 80px;
        border: 1px groove rgb(26, 23, 23);
      }
      input{
        margin-right: 20px;
        width: 450px;
        height: 25px;
        padding-left: 10px;
      }
      label{
        margin-bottom: 5px;
      }
      textarea{
        padding-left: 10px;
      }
      button{
        margin: 20px 0px 5px 220px;       
        width: 400px;
        height: 30px;
        font-size: 18px;
        border-radius: 10px;
        background-color: rgb(3, 230, 71);
        color: white;
      }
      h3{
        margin-top: 15px;
      }
    </style>
</head>
<body>
    <div class="row my-3">
    <div class="heading">
  <h3>Voter Registration Form</h3>
  </div>
  <div id="form" class="col-10">
   <form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="name">
    <input type="text" onfocus="this.type='date'" name="birthdate" id="birthdate" placeholder="birth date"><br><br>
    <input type="number" name="mobile" id="mobile" placeholder="mobile no">
    <input type="text" name="voter_id" id="voter_id" placeholder="voter id"><br><br>
    <input type="text" name="email" id="email" placeholder="Email"><br><br>
    <input type="text" onfocus="this.type='password'" name="password"  placeholder=" password">
    <input type="text" onfocus="this.type='password'" name="Cpassword" id="Cpassword" placeholder="confirm password"><br><br>
    <textarea name="address" id="address" cols="122" rows="2" placeholder="Permanant Address"></textarea><br><br>
   <label for="image">Upload image : </label>
    <input type="file" name="photo"><br><br>
    <button id="register" name="register">Register</button><br><br>
   </form>
        </div>
    </div>
    <?php
    include("connect.php");
    if(isset($_POST['register'])){
    $name = $_POST["name"];
    $birthdate = $_POST["birthdate"];
    $mobile = $_POST["mobile"];
    $voter_id = $_POST["voter_id"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $Cpassword = $_POST["Cpassword"];
    $address = $_POST["address"];
    $image = $_FILES["photo"]["name"];
    $tmp_name = $_FILES["photo"]["tmp_name"];
    
    if($password==$Cpassword){
        move_uploaded_file($tmp_name,"../voter_images/$image");
        $insert = mysqli_query($conn, "INSERT INTO voter(name, birthdate, mobile, voter_id, email, password, address, photo)
         VALUES('$name', '$birthdate', '$mobile', '$voter_id', '$email', '$password','$address', '$image')");
    
         if($insert){
          ?>
          <script> location.assign("head_connector.php?AddVoters&added=1");</script>
          <?php
         }
         else{
          ?>
          <script> location.assign("head_connector.php?AddVoters&error=1");</script>
          <?php
         }
    }
    else{
      ?>
      <script> location.assign("head_connector.php?AddVoters&notmatched=1");</script>
      <?php
    }
  }
    ?>
</body>
</html>