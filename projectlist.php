<<<<<<< HEAD
<?php
require_once('connect.php');
session_start();

$key = $_POST["keyword"];

$get_projects = "SELECT DISTINCT pid, pname, description, status FROM Project NATURAL JOIN ProjectTag WHERE tag LIKE '%$key%' OR pname LIKE '%$key%' OR description LIKE '%$key%' ORDER BY posttime DESC";
$projects = mysqli_query($conn, $get_projects);
if (!$projects) err_close();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Search</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
  <?php include_once('navbar.php') ?>
  <div class="container">

    <div class="panel panel-default">
      <div class="panel-heading">
        Search results for "<?php echo $key ?>" – newest first
      </div>
      <?php if (mysqli_num_rows($projects) > 0) { ?>
        <table class="table table-striped table-bordered">
          <thead>
            <th>Project Name</th>
            <th>Description</th>
            <th>Status</th>
          </thead>
          <?php
              while ($row = mysqli_fetch_assoc($projects)) {
                  $pid = $row['pid'];
          ?>
          <tr>
            <td>
              <a href="project.php?pid=<?php echo $pid?>">
                <?php echo $row['pname'] ?>
              </a>
            </td>
            <td><?php echo $row['description'] ?></td>
            <td><?php echo $row['status'] ?></td>
          </tr>
          <?php } ?>
        </table>
      <?php } else { ?>
        <div class="panel-body">
          No projects found.
        </div>
      <?php } ?>
    </div>

  </div>
</body>
</html>
=======
<?php SESSION_start(); ?>
<!doctype html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>List of Products</title>
    </head>
    <body>
		<form action = "project.php" method ="POST" >
		<table border="1">
		      <thead>
		        <tr>
				  <th>Project ID</th>
		          <th>Project Name</th>
		          <th>Project Description</th>
		        </tr>
		      </thead>
			  conn
		 <?php
		// 1. Create a database connection
		require_once('connect.php');
		$tag = $_POST["project_name"];
		
	 $query = "select DISTINCT pid,pname,description from project natural join ProjectTag where tag like '%$tag%' or pname like '%$tag%' or pid like '%$tag%'";
	$result = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($result))
		  {
			  
			?>   
		            <tr>
		              <td><input type="checkbox" name="pid" value = "<?php echo $row['pid'] ?> "> <?php echo $row['pid'] ?></input></td>
					  <td><?php echo $row['pname'] ?></td>
					  <td><?php echo $row['description'] ?></td> 
		            </tr> 
				 
				 <?php
			  }
		  
		         ?>
				 </table>
		
	    	<br><br>
	    	<input type="submit" value="submit" style = " margin-left: 50%" >
	    </form>		
    <?php mysqli_close($conn); ?>
 	
    </body>
    </html>
>>>>>>> 0409193a8f74398e8aac6231808c15b87b7aa33a
