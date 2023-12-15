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
	</div>
    <div class="col-md-9 col-md-offset-2">
        <div class="otp">
        <form role="form" action="ss.php" method="post" >
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