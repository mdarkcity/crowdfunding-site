<?php
require_once('connect.php');
session_start();
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
  
    <form action="project.php" method ="POST">
      <table border="1">
        <thead>
          <th>Project ID</th>
          <th>Project Name</th>
          <th>Project Description</th>
        </thead>
        <?php
            $tag = $_POST["project_name"];
            $get_projects = "SELECT pid,pname,description FROM Project NATURAL JOIN ProjectTag WHERE tag LIKE '%$tag%'";
            $result = mysqli_query($conn, $get_projects);
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
          <td><input type="checkbox" name="pid" value = "<?php echo $row['pid'] ?>"> <?php echo $row['pid'] ?></input></td>
          <td><?php echo $row['pname'] ?></td>
          <td><?php echo $row['description'] ?></td> 
        </tr>
        <?php } ?>
      </table>
      <br><br>
      <input type="submit" value="submit" style = " margin-left: 50%" >
    </form>

  </div>
</body>
</html>
