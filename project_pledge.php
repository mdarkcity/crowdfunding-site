<?php
session_start();
require_once('connect.php');
$error = false;

$result = mysqli_query($conn," SELECT uid,pid from pledge where uid = '" . $_SESSION['userid'] ."' and pid = '" . $_SESSION['pid'] . "'");
$row = mysqli_num_rows($result);

if(isset($_POST['submit']))
{
$amount = trim(mysqli_real_escape_string($conn, $_POST['amount']));
echo $amount;
    if ($amount < 0)
	 {
        $error = true;
        $amount_error = "Amount cannot be negative.It should be > 0";
    }

if(!$error)
{
if ($row == 0)
{
echo "insert";		
if(mysqli_query($conn, "INSERT INTO pledge(uid,pid,amount) VALUES('" . $_SESSION['userid'] . "','" . $_SESSION['pid'] . "','" . $amount . "')"))
		{
			echo "successfully pledged";
		}
		else
		{
			echo "error inserting the amount.";
	    }
}
	
elseif ($row >= 1)
{
		 echo "update";
		 if(mysqli_query($conn, "UPDATE pledge SET amount = '" . $amount . "' where uid = '" . $_SESSION['userid'] ."' and pid = '" . $_SESSION['pid'] . "'"))
		 {
			 echo " amount updated successfully";
		 }
}
}	
} 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Project fund page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    
</head>
<body>
    
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        <h4>Welcome user <?php echo $_SESSION['userid'] ?>!!! </h4> 
		<h4>pledge money for project <?php echo $_SESSION['pid'] ?>!!! </h4> 
        </div>
    </div>
	
</div>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<input type="text" name="amount" placeholder="enter ramount" value="<?php if ($error) echo $amount; ?>" required>
			<span class="text-danger"><?php if (isset($amount_error)) echo $amount_error; ?></span>
	    <button class="btn btn-primary btn-block" style="margin-top:30px;" type="submit" name="submit">Pledge</button>
</form>	
<div class="row">
	<div class="col-md-4 col-md-offset-4 text-center">    
	<h4> <a href='home.php'>Return to home page.</a></h4>
	 </div>
</div>	

<?php mysqli_close($conn); ?>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>