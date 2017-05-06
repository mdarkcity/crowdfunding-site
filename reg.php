<?php
require_once('connect.php');

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
	
    $name = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $userid = trim(mysqli_real_escape_string($conn, $_POST['userid']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));
    $cpassword = trim(mysqli_real_escape_string($conn, $_POST['cpassword']));
    
    //name can contain only alpha characters and space
    if (strlen($name) < 2 | strlen($name) > 40) {
        $error = true;
        $name_error = "Name must be between 2 and 40 characters.";
    }
    if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $name_error2 = "Name may contain only alpha characters and spaces.";
        if (isset($name_error)) {
            $name_error .= "<br>" . $name_error2;
        } else {
            $error = true;
            $name_error = $name_error2;
        }
    }
    if (strlen($userid) < 5 | strlen($userid) > 40) {
        $error = true;
        $userid_error = "Login ID must be between 5 and 40 characters.";
    }
    if (preg_match("/[^a-z0-9_\-!?#$]/i", $userid, $invalid)) {
        $userid_error2 = "Login ID may not contain: $invalid[0]";
        if (isset($userid_error)) {
            $userid_error .= "<br>" . $userid_error2;
        } else {
            $error = true;
            $userid_error = $userid_error2;
        }
    }
    if (strlen($password) < 6 | strlen($password) > 40) {
        $error = true;
        $password_error = "Password must be between 6 and 40 characters.";
    }
    if ($password != $cpassword) {
        $error = true;
        $cpassword_error = "Passwords don't match.";
    }
	
    if ($sql=mysqli_query($conn, "SELECT uname FROM User WHERE LOWER(uid)=LOWER('$userid')")) {
        $row_count = mysqli_num_rows($sql);
        if ($row_count == 1) {
            $error = true;
            $userid_error = "Username already exists.";
        }
    }
	
    if (!$error) {
        if (mysqli_query($conn, "INSERT INTO User(uid, uname, password) VALUES('" . $userid ."', '" . $name . "', '" . $password . "')")) {
            $successmsg = "Successfully registered! <a href='login.php'>Click here to log in.</a>";
        } else {
            $errormsg = "Error in registering... Please try again later!";
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
        <h2>Create an account</h2>
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" class="form-control" placeholder="Full Name" value="<?php if ($error) echo $name; ?>" required>
          <p class="text-danger text-right"><?php if (isset($name_error)) echo $name_error; ?></p>
        </div>

        <div class="form-group">
          <label for="userid">Login ID</label>
          <input type="text" name="userid" class="form-control" placeholder="Username" value="<?php if ($error) echo $userid; ?>" required>
          <p class="text-danger text-right"><?php if (isset($userid_error)) echo $userid_error; ?></p>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <p class="text-danger text-right"><?php if (isset($password_error)) echo $password_error; ?></p>
        </div>

        <div class="form-group">
          <label for="cpassword">Confirm Password</label>
          <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required>
          <p class="text-danger text-right"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></p>
        </div>

        <button class="btn btn-primary btn-block" style="margin-top:30px;" type="submit" name="signup">Sign Up</button>
      </form>

      <p id="note" class="text-center">    
        Already have an account? <a href="login.php">Log in here!</a>
      </p>

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
