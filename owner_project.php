<?php SESSION_start(); 
$proj_id = $_SESSION['userid'];
?>
<!doctype html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>List of Projects posted by user</title>
    </head>
    <body>
		<form action = "upload.php" method ="POST" enctype="multipart/form-data">
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
	 $query = "select * from project where uid = '$proj_id'";
	$result = mysqli_query($conn,$query);
       while($row = mysqli_fetch_assoc($result))
		  {
			  
			?>   
		            <tr>
		              <td><input type="checkbox" name="pid" value = "<?php echo $row['pid'] ?> "> <?php echo $row['pid'] ?></input></td>
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
	    	
			Select image to upload:
			    <input type="file" name="fileToUpload" id="fileToUpload"><br/>
				<input type ="radio" name="type" value = "image">image<br>
				<input type ="radio" name="type" value = "video">video<br>
				 <input type="submit" value="Upload" name="submit"> <br/>
				
			<h4> <a href='home.php'>Return to home page.</a></h4>
	    </form>		
    <?php mysqli_close($conn); ?>
 	
    </body>
    </html>