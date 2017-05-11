<?php
require_once('connect.php');
session_start();

if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
}

$userid = $_SESSION['userid'];

/* 
  $activity will be an array indexed by timestamp,
  with each timestamp mapping to an array of events.
  each event will also be an array, with element [0] being
  a marker for the type of event:
  "c": comment / "l": like / "p": pledge / "m": material (project update).
  element [1] of event will be the relevant event info
*/

$activity = [];

// get all user's friends (followees)
$get_friends = "SELECT uid FROM Follow WHERE followerid='$userid'";
$friends = mysqli_query($conn, $get_friends);
if (!$friends) err_close();
while ($friend = mysqli_fetch_assoc($friends)) {
    $friend = $friend['uid'];

    // get all friends' comments
    $get_comments = "SELECT C.uid, C.text, P.pid, P.pname, C.commenttime FROM Comment C JOIN Project P USING(pid) WHERE C.uid='$friend'";
    $comments = mysqli_query($conn, $get_comments);
    if (!$comments) err_close();
    while ($comment = mysqli_fetch_assoc($comments)) {
        if (array_key_exists($comment['commenttime'], $activity)) {
            $activity[$comment['commenttime']][] = ["c", $comment];
        } else {
            $activity[$comment['commenttime']] = [["c", $comment]];
        }
    }

    // get all friends' likes
    $get_likes = "SELECT L.uid, P.pid, P.pname, L.liketime FROM `Like` L JOIN Project P USING(pid) WHERE L.uid='$friend'";
    $likes = mysqli_query($conn, $get_likes);
    if (!$likes) err_close();
    while ($like = mysqli_fetch_assoc($likes)) {
        if (array_key_exists($like['liketime'], $activity)) {
            $activity[$like['liketime']][] = ["l", $like];
        } else {
            $activity[$like['liketime']] = [["l", $like]];
        }
    }

    // get all friends' pledges
    $get_pledges = "SELECT Pl.uid, P.pid, P.pname, Pl.amount, Pl.pledgetime FROM Pledge Pl JOIN Project P USING(pid) WHERE Pl.uid='$friend'";
    $pledges = mysqli_query($conn, $get_pledges);
    if (!$pledges) err_close();
    while ($pledge = mysqli_fetch_assoc($pledges)) {
        if (array_key_exists($pledge['pledgetime'], $activity)) {
            $activity[$pledge['pledgetime']][] = ["p", $pledge];
        } else {
            $activity[$pledge['pledgetime']] = [["p", $pledge]];
        }
    }
}

// get all projects user likes / has funded
$get_projects = "SELECT pid FROM `Like` WHERE uid='$userid' UNION SELECT pid FROM Pledge WHERE uid='$userid'";
$projects = mysqli_query($conn, $get_projects);
if (!$projects) err_close();
while ($project = mysqli_fetch_assoc($projects)) {
    $project = $project['pid'];

    // get all posts from project
    $get_posts = "SELECT P.pid, P.pname, M.text, M.attachment, M.type, M.addtime FROM Project P JOIN Material M USING(pid) WHERE P.pid='$project'";
    $posts = mysqli_query($conn, $get_posts);
    if (!$posts) err_close();
    while ($post = mysqli_fetch_assoc($posts)) {
        if (array_key_exists($post['addtime'], $activity)) {
            $activity[$post['addtime']][] = ["m", $post];
        } else {
            $activity[$post['addtime']] = [["m", $post]];
        }
    }
}

// sort events in reverse chronological order
krsort($activity);
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
  li.material:before {
    content: "\e146";
  }
</style>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
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
                              ".$e['uid']." commented on <a href=\"project.php?pid=${e['pid']}\">".$e['pname']."</a>:<br>"
                              .$e['text']."
                            </div>
                          </div>
                        </li>";
                    } elseif ($e_type == "l") {
                        echo
                        "<li class='like'>
                          <div class=\"row\">
                            <div class='well well-sm pull-left'>
                              ".$e['uid']." likes <a href=\"project.php?pid=${e['pid']}\">".$e['pname']."</a>
                            </div>
                          </div>
                        </li>";
                    } elseif ($e_type == "p") {
                        echo
                        "<li class='pledge'>
                          <div class=\"row\">
                            <div class='well well-sm pull-left'>
                              ".$e['uid']." pledged $".$e['amount']." to <a href=\"project.php?pid=${e['pid']}\">".$e['pname']."</a>
                            </div>
                          </div>
                        </li>";
                    } elseif ($e_type == "m") {
                        echo
                        "<li class='material'>
                          <div class=\"row\">
                            <div class='well well-sm pull-left'>
                              <a href=\"project.php?pid=${e['pid']}\">".$e['pname']."</a> posted an update:<br>".$e['text']."<br>";
                        if ($e['type'] == "image") {
                            echo "<img src=uploads/${e['attachment']}>";
                        } elseif ($type == "video") {
                            echo "<video controls>
                                    <source src=uploads/${e['attachment']}>
                                  </video>";
                        }
                        echo "</div>
                          </div>
                        </li>";
                    }
                }
            }
        ?>

      </ul>
    </div>
    <div class="col-md-3 col-md-offset-1" style="padding-top:40px;">
      <div class="row">
        <a href="projectcreate.php" class="btn btn-primary btn-lg btn-block" type="button"><span class="glyphicon glyphicon-flag"></span>&nbsp;&nbsp;Create a project!</a>
      </div>
    </div>
  </div> <!-- container -->
</body>
</html>
