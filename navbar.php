<nav class="navbar navbar-default">
  <div class="container">

    <form class="navbar-form navbar-left" action="projectlist.php" method="POST">
      <div class="form-group">
        <input type="text" class="form-control" name="project_name" placeholder="Search projects">
      </div>
      <button type="submit" class="btn btn-default">Search</button>
    </form>

    <ul class="nav navbar-nav navbar-right">
      <li><a class="navbar-brand" href="home.php"><span class="glyphicon glyphicon-home"></span></a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, <?php echo $_SESSION['userid']; ?> <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Something</a></li>
          <li class="divider"></li>
          <li><a href="logout.php">Log out</a></li>
        </ul>
      </li>
    </ul>

  </div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>