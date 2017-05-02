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
if(isset($_POST["Login"]))
          {
$query="SELECT * FROM user WHERE uid = '$_POST[userid]' and password = '$_POST[password]'";

$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
    header('Location: homepage.php');
}
else
{
  echo "Username or Password is Incorrect";
}
mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<title>Log In</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

  <body>
      <div class="row centered-form">
        <h3 class="text-center">Welcome User Login</h3>
      </div>

      <form id='login' role='form' action='' method='post' >
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
          <div class="panel panel-default">
            <div class="panel-body">

              <div class="control-group">
                <label class="control-label"  for="userid">UserID:</label>
                  <div class="controls">
                    <input type="text" name="userid" id="userid" class="form-control input-sm" placeholder="Username" maxlength="50" />
                  </div>
              </div>

              <div class="control-group">
                <label class="control-label"  for="password">Password:</label>
                  <div class="controls">
                    <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" maxlength="50" />
                    <p>               </p>
                  </div>
              </div>

              <div class="centered">
                <input type="submit" value="Login" name="Login" id="Login" class="btn btn-success"></input>
              </div>
            </div>
          </div>
        </form>
	
</body>
</html>
      
	 
   

