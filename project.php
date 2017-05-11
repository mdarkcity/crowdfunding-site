<?php
require_once('connect.php');
session_start();

$pid = $_GET['pid'];
$_SESSION['pid']=$pid;
$uid = $_SESSION['userid'];

$get_info = "SELECT * FROM Project WHERE pid='$pid'";
$p_info = mysqli_query($conn, $get_info);
if (!$p_info) err_close();
$p_info = mysqli_fetch_array($p_info);

$get_tags = "SELECT tag FROM ProjectTag WHERE pid='$pid'";
$tags = mysqli_query($conn, $get_tags);
if (!$get_tags) err_close();

$get_material = "SELECT text, attachment, type FROM Material WHERE pid='$pid' ORDER BY addtime DESC";
$material = mysqli_query($conn, $get_material);
if (!$material) err_close();

$get_like = "SELECT * FROM `Like` WHERE uid='$uid' AND pid='$pid'";
$like = mysqli_query($conn, $get_like);
if (!$like) err_close();

$get_comments = "SELECT * FROM Comment WHERE pid='$pid'";
$comments = mysqli_query($conn, $get_comments);
if (!$comments) err_close();

if (isset($_POST['like'])) {
    unset($_POST['unlike']);
    $like_ins = "INSERT INTO `Like`(uid, pid) VALUES('$uid', '$pid')";
    mysqli_query($conn, $like_ins);
    header('Refresh:0');
} elseif (isset($_POST['unlike'])) {
    unset($_POST['like']);
    $unlike = "DELETE FROM `LIKE` WHERE uid='$uid' AND pid='$pid'";
    mysqli_query($conn, $unlike);
    header('Refresh:0');
}

if (isset($_POST['post'])) {
    $comm_ins = "INSERT INTO Comment(uid, pid, text) VALUES('$uid', '$pid','".$_POST['comment']."')";
    mysqli_query($conn, $comm_ins);
    header('Refresh:0');
}

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
        <div class="panel-footer">
          Tags:
          <?php
              if (mysqli_num_rows($tags) > 0) {
                  while ($row = mysqli_fetch_assoc($tags)) {
                      $tag = $row['tag'];
                      echo "&emsp;<a href='projectlist.php?tag=$tag'>".$tag."</a>";
                  }
              } else {
                  echo " none";
              }
          ?>
        </div>
      </div>

			<?php
          if (mysqli_num_rows($material) > 0) {
              echo "<div class='page-header'><h3>Updates</h3></div>";
              while ($row = mysqli_fetch_assoc($material)) {
                  echo "<div class='panel panel-default'>
                          <div class='panel-heading'>
                            ${row['text']}
                          </div>
                          <div class='panel-body text-center'>";
                  $attach = $row['attachment'];
                  if ($row['type'] == "image") {
                      echo "<img src=uploads/$attach>";
                  } elseif ($row['type'] == "video") {
                      echo "<video controls>
                              <source src=uploads/$attach>
                            </video>";
                  }
                  echo "</div></div>";
              }
          }
			?>

      <?php
          if (mysqli_num_rows($comments) > 0) {
              echo "<div class='page-header'><h3>Comments</h3></div>";
              while ($row = mysqli_fetch_assoc($comments)) {
                echo "<div class='panel panel-default'>
                        <div class='panel-heading'>
                          ${row['uid']}
                        </div>
                        <div class='panel-body'>";
                echo $row['text'];
                echo "</div></div>";
              }
          }
      ?>

      <form method="POST">
        <input type="text" name="comment" class="form-control" placeholder="Write a comment..." required>
        <button class="btn btn-primary" type="submit" name="post">Post comment</button>
      </form>

    </div> <!-- main column (8) -->

    <div class="col-md-4" style="padding-top:13px;">
      <div class="page-header text-center">
        <form method="POST">
          <?php if (mysqli_num_rows($like) == 0) { ?>
            <button class="btn btn-default btn-sm" type="submit" name="like">
              <span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;&nbsp;Like this project
            </button>
          <?php } else { ?>
            <button class="btn btn-info btn-sm" type="submit" name="unlike">
              <span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;&nbsp;You like this project
            </button>
          <?php } ?>
        </form>
      </div>


      <div class="panel panel-default">
        <div class="panel-heading">
          Project Details
        </div>
        <ul class="list-group">
          <li class="list-group-item">
            Creator: <a href="user.php?uid=<?php echo $p_info['uid'] ?>"><?php echo $p_info['uid'] ?></a>
          </li>
          <li class="list-group-item">
            <?php $posttime = date_create($p_info['posttime']) ?>
            Posted: <?php echo date_format($posttime, 'F j, Y') ?>
          </li>
          <li class="list-group-item">
            Status: <?php echo $p_info['status'] ?>
          </li>
          <li class="list-group-item">
            <?php $enddate = date_create($p_info['enddate']) ?>
            Campaign ends: <?php echo date_format($enddate, 'F j, Y') ?>
          </li>
          <li class="list-group-item">
            <?php $completion = date_create($p_info['completiondate']) ?>
            Completed by: <?php echo date_format($completion, 'F j, Y') ?>
          </li>
        </ul>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
          Funding Info
        </div>
        <ul class="list-group">
          <li class="list-group-item">
            Minimum for success: $<?php echo $p_info['minfunds'] ?>
          </li>
          <li class="list-group-item">
            Maximum to be raised: $<?php echo $p_info['maxfunds'] ?>
          </li>
          <li class="list-group-item">
            Current amount: $<?php echo $p_info['currentfunds'] ?>
          </li>
        </ul>
      </div>

      <?php if ($p_info['status'] == 'fundraising') { ?>
        <div class="text-center">
          <a href="project_pledge.php" class="btn btn-success btn-lg" type="button">Make a pledge!</a>
        </div>
      <?php } ?>

    </div> <!-- right column (4) -->
    
  </div> <!-- container -->
</body>
</html>
