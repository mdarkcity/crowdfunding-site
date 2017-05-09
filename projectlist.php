<?php session_start(); ?>
<!doctype html>
    <head>
      <meta charset="utf-8">
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
		
	 $query = "select pid,pname,description from project natural join ProjectTag where tag like '%$tag%'";
	$result = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_assoc($result))
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
