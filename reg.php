<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Tanu2603";
$dbname = "crowdfunding_project";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// Test if connection succeeded
if(mysqli_connect_errno()) 
{
  die("Database connection failed: " . 
       mysqli_connect_error() . 
       " (" . mysqli_connect_errno() . ")"
  );
}
//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
	
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $userid = mysqli_real_escape_string($con, $_POST['userid']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    
    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(empty($userid)) {
        $error = true;
        $userid_error = "Please Enter Valid user ID";
		
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
	
	}
	
	if($sql=mysqli_query($con,"select uname from user where uid='$userid'"))
	{
	$row_count = mysqli_num_rows($sql);
	if($row_count >= 1)
	{
		$error = true;
		$userid_error1 = "User ID already exist";
	}
}
	
    if (!$error) {
		
        if(mysqli_query($con, "INSERT INTO user(uid,uname,password) VALUES('" . $userid ."', '" . $name . "', '" . $password . "')")) {
            $successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
        } else {
            $errormsg = "Error in registering...Please try again later!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration Script</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                <fieldset>
                    <legend>Sign Up</legend>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Login ID</label>
                        <input type="text" name="userid" placeholder="UserID" required value="<?php if($error) echo $userid; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($userid_error)) echo $userid_error; ?></span>
						<span class="text-danger"><?php if (isset($userid_error1)) echo $userid_error1; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Password" required class="form-control" />
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Confirm Password</label>
                        <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
                        <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        Already Registered? <a href="login.php">Login Here</a>
        </div>
    </div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>