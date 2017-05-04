<?php
require_once('connect.php');

if (isset($_POST['login'])) {

    $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query="SELECT * FROM user WHERE uid='$userid' and password='$password'";
	
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        header('Location: home.php');
    } else {
        $loginerror = "Username or password is incorrect.";
        mysqli_close($conn);
    }

    if (isset($loginerror)) {
        echo "<script type=\"text/javascript\">
                  window.onload = function() {document.getElementById('error-note').innerHTML = \"<span class='text-danger'>" . $loginerror . "</span>\";}
              </script>";
    }

    session_start();
    $_SESSION['userid']=$userid;
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
  <title>Log In</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="col-md-4 col-md-offset-4">
      <div class="page-header text-center">
        <h2>Log in</h2>
      </div>
      <form action='' method='post'>

        <div class="form-group">
          <label for="userid">User ID</label>
            <input type="text" name="userid" class="form-control" placeholder="Username" value="<?php if (isset($loginerror)) echo $userid; ?>" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button class="btn btn-success btn-block" style="margin-top:30px;" type="submit" name="login">Log In</button>
      </form>

      <p id="note" class="text-center">    
        Don't have an account? <a href="reg.php">Create one here!</a>
      </p>
      <p id="error-note" class="text-center"></p>
    </div> <!-- middle column -->
	</div> <!-- container -->
</body>
</html>
