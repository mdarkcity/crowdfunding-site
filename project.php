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


			<form action = "project_pledge.php" method="POST" >
		    <input type="submit" value="pledge">
		  </form>

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
					echo "<div class=\"row\"><div class=\"card\">";
                    echo "<img src=uploads/$attach alt=\"Card image cap\" style=\"height: 150px; width: 50%; display: block;\">";
                      echo "</img>";
					  echo "</div>";
				  }
				  elseif ($type == "video")
				  {
					  echo "<div class=\"row\"><div class=\"card\">";
                      echo "<video src=uploads/$attach style=\"height: 150px; width: 50%;>";
                        echo "</video>";
						echo "</div>";
						
				  }
                    
                }
            }
			
			?>
		
		
  </div>
</body>
</html>
