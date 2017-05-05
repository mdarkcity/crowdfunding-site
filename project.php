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
		// 1. Create a database connection
		require_once('connect.php');
		
		$proj_id = $_POST["pid"];
		
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
		
	    	<br><br>
	    	<input type="submit" value="submit" style = " margin-left: 50%" >
	    </form>		
    <?php mysqli_close($conn); ?>
 	
    </body>
    </html>