<?php
require_once('connect.php');
session_start();

$uid = $_SESSION['userid'];

$get_info = "SELECT * FROM User WHERE uid='$uid'";
$u_info = mysqli_query($conn, $get_info);
if (!$u_info) err_close();
$u_info = mysqli_fetch_array($u_info);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Account</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
  <?php include_once('navbar.php') ?>
  <div class="container">
    <div class="col-md-4 col-md-offset-4">
      <div class="page-header text-center">
        <h2>Edit your account</h2>
      </div>
      <h4 class="text-center"><span class="label label-info">Public</span></h4>
      <form class="form-horizontal" method="POST">
        <div class="form-group">
          <label class="control-label col-md-4">User ID:</label>
          <div class="col-md-8">
            <input type="text" name="uid" class="form-control col-md-8" value="<?php echo $u_info['uid'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-4">Full name:</label>
          <div class="col-md-8">
            <input type="text" name="name" class="form-control col-md-8" value="<?php echo $u_info['uname'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-4">Hometown:</label>
          <div class="col-md-8">
            <input type="text" name="city" class="form-control col-md-8" value="<?php echo $u_info['city'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-4">Bio:</label>
          <div class="col-md-8">
            <input type="text" name="bio" class="form-control col-md-8" value="<?php echo $u_info['bio'] ?>">
          </div>
        </div>
        <br>
        <h4 class="text-center"><span class="label label-warning">Private</span></h4>
        <div class="form-group">
          <label class="control-label col-md-4">CC</label>
          <div class="col-md-8">
            <input type="text" name="cc" class="form-control col-md-8" value="<?php echo $u_info['ccno'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-4">PW</label>
          <div class="col-md-8">
            <input type="text" name="pw" class="form-control col-md-8" value="<?php echo $u_info['password'] ?>">
          </div>
        </div>

        <div class="text-center">
          <button class="btn btn-primary" type="submit" name="save">Save</button>
        </div>
      </form>



    </div> <!-- middle column -->
  </div> <!-- container -->
</body>
</html>