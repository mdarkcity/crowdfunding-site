<?php
require_once('connect.php');
session_start();

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['create'])) {

    $uid = $_SESSION['userid'];
    $pname = trim(mysqli_real_escape_string($conn, $_POST['pname']));
    $minfunds = trim(mysqli_real_escape_string($conn, $_POST['minfunds']));
    $maxfunds = trim(mysqli_real_escape_string($conn, $_POST['maxfunds']));
    $enddate = trim(mysqli_real_escape_string($conn, $_POST['enddate']));
    $completiondate = trim(mysqli_real_escape_string($conn, $_POST['completiondate']));

    // get float values of minfunds & maxfunds
    $minfunds = floatval($minfunds);
    $maxfunds = floatval($maxfunds);

    if (strlen($pname) < 2 | strlen($pname) > 40) {
        $error = true;
        $pname_error = "Project name must be between 2 and 40 characters.";
    }
    if (preg_match("/[^a-z0-9_\-!?#$%&]/i", $pname, $invalid)) {
        $pname_error2 = "Project name may not contain: $invalid[0]";
        if (isset($pname_error)) {
            $pname_error .= "<br>" . $pname_error2;
        } else {
            $error = true;
            $pname_error = $pname_error2;
        }
    }
    if ($minfunds < 0 | $maxfunds < 0) {
        $error = true;
        $funds_error = "Fund limits must be non-negative.";
    } elseif ($maxfunds <= 0) {
        $error = true;
        $funds_error = "Maximum funds be greater than zero.";
    } elseif ($minfunds>$maxfunds) {
        $error = true;
        $funds_error = "Minimum funds may not exceed maximum fund limit.";
    }

    $p_fields = "Project(uid, pname, minfunds, maxfunds, enddate, completiondate)";
    $p_vals = "('".$uid."','".$pname."','".$minfunds."','".$maxfunds."','".$enddate."','".$completiondate."')";

    if (!$error) {
        if (mysqli_query($conn,"INSERT INTO ".$p_fields." VALUES ".$p_vals)) {
            echo "Successfully created";
        } else {
            echo "Error in creating... Please try again later!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>New Project</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
  <?php include_once('navbar.php') ?>
  <div class="container">
    <div class="col-md-4 col-md-offset-4">
      <div class="page-header text-center">
        <h2>Create a new project</h2>
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <div class="form-group">
          <label for="pname">Project name</label>
          <input type="text" name="pname" class="form-control" placeholder="Name" value="<?php if ($error) echo $pname; ?>" required>
          <p class="text-danger text-right"><?php if (isset($pname_error)) echo $pname_error; ?></p>
        </div>
	   
        <div class="form-group">
          <label for="minfunds">Minimum funds for a successful campaign</label>
          <input type="text" name="minfunds" class="form-control" placeholder="Mininum funds" value="<?php if ($error) echo number_format($minfunds, 2); ?>" required>
        </div>

        <div class="form-group">
          <label for="maxfunds">Maximum funds to be raised</label>
          <input type="text" name="maxfunds" class="form-control" placeholder="Maximum funds" value="<?php if ($error) echo number_format($maxfunds, 2); ?>" required>
        </div>
	   
        <p class="text-danger text-right"><?php if (isset($funds_error)) echo $funds_error; ?></p>

        <div class="form-group">
          <label for="enddate">End date for the fundraising campaign</label>
          <input type="text" name="enddate" class="form-control" placeholder="End date" value="<?php if ($error) echo $enddate; ?>" required>
        </div>
	   
        <div class="form-group">
          <label for="completiondate">Estimated project completion date</label>
          <input type="text" name="completiondate" class="form-control" placeholder="Completion date" value="<?php if ($error) echo $completiondate; ?>" required>
        </div>
       
        <button class="btn btn-primary btn-block" style="margin-top:30px;" type="submit" name="create">Create Project</button>
      </form>
	  
    </div> <!-- middle column -->
  </div> <!-- container -->
</body>
</html>
