<?php
require_once('connect.php');
session_start();

$activity = [];

$friend = $_GET['uid'];

$get_comments = "SELECT C.uid, C.text, P.pname, C.commenttime FROM Comment C JOIN Project P USING(pid) WHERE C.uid='$friend'";
$comments = mysqli_query($conn, $get_comments);
if (!$comments) err_close();
while ($comment = mysqli_fetch_assoc($comments)) {
    if (array_key_exists($comment['commenttime'], $activity)) {
        $activity[$comment['commenttime']][] = ["c", $comment];
    } else {
        $activity[$comment['commenttime']] = [["c", $comment]];
    }
}

$get_likes = "SELECT L.uid, P.pname, L.liketime FROM `Like` L JOIN Project P USING(pid) WHERE L.uid='$friend'";
$likes = mysqli_query($conn, $get_likes);
if (!$likes) err_close();
while ($like = mysqli_fetch_assoc($likes)) {
    if (array_key_exists($like['liketime'], $activity)) {
        $activity[$like['liketime']][] = ["l", $like];
    } else {
        $activity[$like['liketime']] = [["l", $like]];
    }
}

$get_pledges = "SELECT Pl.uid, P.pname, Pl.amount, Pl.pledgetime FROM Pledge Pl JOIN Project P USING(pid) WHERE Pl.uid='$friend'";
$pledges = mysqli_query($conn, $get_pledges);
if (!$pledges) err_close();
while ($pledge = mysqli_fetch_assoc($pledges)) {
    if (array_key_exists($pledge['pledgetime'], $activity)) {
        $activity[$pledge['pledgetime']][] = ["p", $pledge];
    } else {
        $activity[$pledge['pledgetime']] = [["p", $pledge]];
    }
}


// sort events in reverse chronological order
krsort($activity);

$uid = $_SESSION['userid'];

if (isset($_POST['follow'])) {
    $follow_ins = "INSERT INTO Follow(uid, followerid) VALUES('$friend', '$uid')";
    mysqli_query($conn, $follow_ins);
    header('Refresh:0');
}

?>

<style>
  ul {list-style: none;}
  li:before {
    font-family: "Glyphicons Halflings";
    font-size: 20px;
    float: left;
    position: relative;
    top: 5px;
    left: -20px;
  }
  li.comment:before {
    content: "\270f";
  }
  li.like:before {
    content: "\e125";
  }
  li.pledge:before {
    content: "\e225";
  }
</style>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User's Home Page</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
  <?php include_once('navbar.php') ?>
  <div class="container">
    <div class="col-md-8">
      <div class="page-header">
        <h2>Recent Activity</h2>
      </div>
      <ul>

        <?php
            foreach ($activity as $events) {
                foreach ($events as $e) {
                    $e_type = $e[0];
                    $e = $e[1];
                    if ($e_type == "c") {
                        echo
                        "<li class='comment'>
                          <div class=\"row\">
                            <div class='well well-sm pull-left'>
                              ".$e['uid']." commented on ".$e['pname'].":<br>"
                              .$e['text']."
                            </div>
                          </div>
                        </li>";
                    } elseif ($e_type == "l") {
                        echo
                        "<li class='like'>
                          <div class=\"row\">
                            <div class='well well-sm pull-left'>
                              ".$e['uid']." likes ".$e['pname']."
                            </div>
                          </div>
                        </li>";
                    } elseif ($e_type == "p") {
                        echo
                        "<li class='pledge'>
                          <div class=\"row\">
                            <div class='well well-sm pull-left'>
                              ".$e['uid']." pledged $".$e['amount']." to ".$e['pname']."
                            </div>
                          </div>
                        </li>";
                    }
                }
            }
        ?>

      </ul>
    </div>
    <div class="col-md-4">
      <form method="POST">
        <button class="btn btn-default btn-sm" type="submit" name="follow">
          <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Follow this user
        </button>
      </form>
    </div>
    
  </div> <!-- container -->
</body>
</html>
