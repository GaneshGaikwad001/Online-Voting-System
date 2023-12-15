<!DOCTYPE html>
<html>
<head>
	<title>Send SMS from PHP using textlocal</title>
    <link rel="stylesheet" href="../../index.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .otp{
            margin: 150px 0px 0px 280px;
        }
    </style>
</head>
<body>
<div class="header">
        <H1>Online Voting System</H1>
    </div>
<div class="container">

	<div class="row">
	<div class="col-md-9 col-md-offset-2">
		<?php
			if(isset($_POST['sendotp'])) {
				require('textlocal.class.php');
				require('credential.php');

				$textlocal = new Textlocal('ganeshgaikwad010901@gmail.com', 'ganesh2001');

                // You can access MOBILE from credential.php
				// $numbers = array(MOBILE);
                // Access enter mobile number in input box
                $numbers = array(9890593458);

				$sender = 'Textlocal';
				$otp = mt_rand(10000, 99999);
				$message = "Hello, This is your OTP: " . $otp;

				try {
				    $result = $textlocal->sendSms($numbers, $message, $sender);
				    setcookie('otp', $otp);
				    echo "OTP successfully send..";
				} catch (Exception $e) {
				    die('Error: ' . $e->getMessage());
				}
			}

			if(isset($_POST['verifyotp'])) { 
				$otp = $_POST['otp'];
				if($_COOKIE['otp'] == $otp) {
					echo "Congratulation, Your mobile is verified.";
				} else {
					echo "Please enter correct otp.";
				}
			}
		?>
	</div>
    <div class="col-md-9 col-md-offset-2">
        <div class="otp">
        <form role="form" method="post" >
            <div class="row">
                <div class="col-sm-9 form-group">
                    <input type="text" class="form-control" id="mobile" name="mobile" value=" " maxlength="15" placeholder="Enter valid Mobile number" required="">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9 form-group">
                    <button type="submit" name="sendotp" class="btn btn-lg btn-success btn-block">Send OTP</button>
                </div>
            </div>
            </form>
            <form method="POST" action="">
            <div class="row">
                <div class="col-sm-9 form-group">
                    <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP" maxlength="5" required="">
                </div>
            </div>
             <div class="row">
                <div class="col-sm-9 form-group">
                    <button type="submit" name="verifyotp" class="btn btn-lg btn-info btn-block">Verify</button>
                </div>
            </div>
        </form>
        </div>
        
	</div>
</div>
</body>
</html>