<<<<<<< HEAD
<?php
require_once('connect.php');
session_start();

$pid = $_GET['pid'];
$_SESSION['pid']=$pid;

$get_info = "SELECT * FROM Project WHERE pid='$pid'";
$p_info = mysqli_query($conn, $get_info);
if (!$p_info) err_close();
$p_info = mysqli_fetch_array($p_info);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Page</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
  <?php include_once('navbar.php') ?>
  <div class="container">
    <div class="col-md-8">
      <div class="page-header">
        <h2><?php echo $p_info['pname'] ?></h2>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
          Description
        </div>
        <div class="panel-body">
          <?php echo $p_info['description'] ?>
        </div>
      </div>


=======
<?php SESSION_start(); ?>
<!doctype html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Project Page</title>
    </head>
    <body>
		
		<table border="1">
		      <thead>
		        <tr>
				  <th>Project ID</th>
				  <th>Owner ID</th>
				  <th>Project Post time</th>
		          <th>Project Name</th>
		          <th>Project Description</th>
				  <th>Mininum funds required</th>
				  <th>Maximum Funds</th>
				  <th>current Funds</th>
				  <th>Funding End date</th>
				  <th>Completition Date</th>
				  <th>Status</th>
		        </tr>
		      </thead>
		 <?php
		 $error = false;
		// 1. Create a database connection
		require_once('connect.php');
		$proj_id = $_POST['pid'];
		$_SESSION['pid']=$proj_id;
		
		
	 $query = "select * from project where pid = '$proj_id'";
	$result = mysqli_query($conn,$query);
       while($row = mysqli_fetch_assoc($result))
		  {
			  
			?>   
		            <tr>
		              <td><?php echo $row['pid'] ?></td>
					  <td><?php echo $row['uid'] ?></td>
					  <td><?php echo $row['posttime'] ?></td>
					  <td><?php echo $row['pname'] ?></td>
					  <td><?php echo $row['description'] ?></td>
					  <td><?php echo $row['minfunds'] ?></td>
					  <td><?php echo $row['maxfunds'] ?></td>
					  <td><?php echo $row['currentfunds'] ?></td>
					  <td><?php echo $row['enddate'] ?></td>
					  <td><?php echo $row['completiondate'] ?></td>
					  <td><?php echo $row['status'] ?></td>
		            </tr> 
				 
				 <?php
			  }
		  
		         ?>
				 </table>
		<?php
		$result = mysqli_query($conn, "select status from project where pid = '$proj_id'");
		while($row = mysqli_fetch_assoc($result)){
			$status = $row["status"];
		if($status == 'fundraising')
		{
		?>
>>>>>>> 0409193a8f74398e8aac6231808c15b87b7aa33a
			<form action = "project_pledge.php" method ="POST" >
		    <input type="submit" value="pledge"><br/>
		    </form>
			<?php
		}
	}
			?>	
		
	    	<br>
			<ul>
			<?php
			
			$sql = "SELECT attachment,type FROM material where pid = '" . $_SESSION['pid'] . "'";
			$result = mysqli_query($conn,$sql);
            
            if (mysqli_num_rows($result) > 0)
			 {
                while ($row = mysqli_fetch_assoc($result))
				 {
                    $attach = $row["attachment"];
					$type = $row["type"];
					if($type == "image")
					{
						echo "<li>";
					echo "<div class=\"row\"><div class=\"card\">";
                    echo "<img src=uploads/$attach alt=\"Card image cap\" style=\"height: 150px; width: 50%; display: block;\">";
                      echo "</img>";
					  echo "</div>";
					  echo "</div>";
					  echo "</li>";
				  }
				  elseif ($type == "video")
				  {
					  echo "<li>";
					  echo "<div class=\"row\"><div class=\"card\">";
                      echo "<video src=uploads/$attach style=\"height: 150px; width: 50%;\">";
                        echo "</video>";
						echo "</div>";
						echo "</div>";
						echo "</li>";
						
				  }
                    
                }
            }
			
			?>
<<<<<<< HEAD
		
=======
			
	</ul>	
>>>>>>> 0409193a8f74398e8aac6231808c15b87b7aa33a
		
  </div>
</body>
</html>
