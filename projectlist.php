<?php
require_once('connect.php');
session_start();

if (isset($_POST["keyword"])) {
    $key = $_POST["keyword"];
    $get_projects = "SELECT DISTINCT pid, pname, description, status FROM Project NATURAL JOIN ProjectTag WHERE tag LIKE '%$key%' OR pname LIKE '%$key%' OR description LIKE '%$key%' ORDER BY posttime DESC";
} elseif (isset($_GET["tag"])) {
    $tag = $_GET["tag"];
    $get_projects = "SELECT DISTINCT pid, pname, description, status, posttime FROM Project NATURAL JOIN ProjectTag WHERE tag='$tag' ORDER BY posttime DESC";
}

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
        <?php if (isset($key)) {
            echo "Search results for \"$key\"";
        } elseif (isset($tag)) {
            echo "Projects with tag \"$tag\"";
        } echo " – newest first";
        ?>
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
