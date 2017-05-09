<?php
session_start();
require_once('connect.php');
//set validation error flag as false
$error = false;
//check if form is submitted
if (isset($_POST['signup'])) {
	
    $pid = trim(mysqli_real_escape_string($conn, $_POST['pid']));
	$tag = trim(mysqli_real_escape_string($conn, $_POST['tag']));
    $pname = trim(mysqli_real_escape_string($conn, $_POST['pname']));
    $desc = trim(mysqli_real_escape_string($conn, $_POST['description']));
    $minfunds = trim(mysqli_real_escape_string($conn, $_POST['minfunds']));
	$maxfunds = trim(mysqli_real_escape_string($conn, $_POST['maxfunds']));
	$enddate = trim(mysqli_real_escape_string($conn, $_POST['enddate']));
	$completiondate = trim(mysqli_real_escape_string($conn, $_POST['completiondate']));
    
    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]{2,40}$/", $pname)) {
        $error = true;
        $pname_error = "Name may contain only alpha characters and spaces,\n
                       and must be between 2 and 40 characters.";
    }
    if (preg_match("/[^a-z0-9_\-!?#$]/i", $pid, $invalid)) {
        $error = true;
        $pid_error = "Login ID may not contain: $invalid[0]";
    } 
    
	
    if ($sql=mysqli_query($conn, "SELECT pname FROM project WHERE LOWER(pid)=LOWER('$pid')")) {
        $row_count = mysqli_num_rows($sql);
        if ($row_count == 1) {
            $error = true;
            $pid_error1 = "Project ID already exists.";
        }
    }
	
    if (!$error) {
        if (mysqli_query($conn, "INSERT INTO project(pid,uid,description,pname,minfunds,maxfunds,enddate,completiondate) VALUES('" . $pid ."', '" . $_SESSION['userid'] . "', '" . $desc . "','". $pname ."','" . $minfunds . "','" . $maxfunds . "','" . $enddate . "','" . $completiondate . "')")) {
			mysqli_query($conn,"INSERT INTO ProjectTag(pid,tag) VALUES('" . $pid . "','" . $tag . "')");
            $successmsg = "Successfully created";
        } else {
            $errormsg = "Error in creating... Please try again later!";
        }
    }
}
?>

<style>
  body {padding: 40px 20px;}
</style>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="col-md-4 col-md-offset-4">
      <div class="page-header text-center">
        <h2>Create a new Project</h2>
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <div class="form-group">
          <label for="pname">Project Name</label>
          <input type="text" name="pname" class="form-control" placeholder="Project Title" value="<?php if ($error) echo $pname; ?>" required>
          <span class="text-danger"><?php if (isset($pname_error)) echo $pname_error; ?></span>
        </div>

        <div class="form-group">
          <label for="userid">Project ID</label>
          <input type="text" name="pid" class="form-control" placeholder="Project ID" value="<?php if ($error) echo $pid; ?>" required>
          <span class="text-danger"><?php if (isset($pid_error)) echo $pid_error; ?></span>
          <span class="text-danger"><?php if (isset($pid_error1)) echo $pid_error1; ?></span>
        </div>
        <div class="form-group">
          <label for="tag">Project category</label>
          <input type="text" name="tag" class="form-control" placeholder="Project category" value="<?php if ($error) echo $tag; ?>" required>
        </div>

       <div class="form-group">
         <label for="userid"> Enter the Description</label>
         <input type="text" name="description" class="form-control" placeholder="Project description" value="<?php if ($error) echo $desc; ?>" required>
       </div>
	   
       <div class="form-group">
         <label for="userid"> Enter the minimum funds required for the campaign</label>
         <input type="text" name="minfunds" class="form-control" placeholder="Mininum funds for Project" value="<?php if ($error) echo $minfunds; ?>" required>
       </div>
	   
       
       <div class="form-group">
         <label for="userid"> Enter the maximum funds required for the campaign</label>
         <input type="text" name="maxfunds" class="form-control" placeholder="Maximum funds for Project" value="<?php if ($error) echo $maxfunds; ?>" required>
       </div>
	   
       <div class="form-group">
         <label for="userid"> Enter the end date for campaign</label>
         <input type="text" name="enddate" class="form-control" placeholder="End date" value="<?php if ($error) echo $enddate; ?>" required>
       </div>
	   
       <div class="form-group">
         <label for="userid"> Enter the completion date for project</label>
         <input type="text" name="completiondate" class="form-control" placeholder="Completion date" value="<?php if ($error) echo $completiondate; ?>" required>
       </div>
       

        <button class="btn btn-primary btn-block" style="margin-top:30px;" type="submit" name="signup">Sign Up</button>
		<h4> <a href='home.php'>Return to home page.</a></h4>
      </form>
	  

      <?php if (isset($successmsg)) {
          echo "<script type=\"text/javascript\">
                  window.onload = function() {document.getElementById('note').innerHTML = \"<span class='text-success'>" . $successmsg . "</span>\";}
                </script>";
      } ?>

      <?php if (isset($errormsg)) {
          echo "<script type=\"text/javascript\">
                  window.onload = function() {document.getElementById('note').innerHTML = \"<span class='text-danger'>" . $errormsg . "</span>\";}
                </script>";
      } ?>
    </div> <!-- middle column -->
  </div> <!-- container -->
</body>
</html>