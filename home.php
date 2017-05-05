<?php
session_start();
require_once('connect.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>User's Home Page'</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        <h4>Welcome user <?php echo $_SESSION["userid"] ?>!!! </h4>
        </div>
    </div>
</div>
<form action="projectlist.php" method="POST">
<input type="text" name="project_name" placeholder="search project here">
<input type="submit" name="search" value="Search">
</form>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

