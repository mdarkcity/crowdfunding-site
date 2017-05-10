<?php
session_start();
$_SESSION['pid']=$_POST["pid"];
    // =============  File Upload Code d  ===========================================
    
	$target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  
    // Check if $uploadOk is set to 0 by an error
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
		 {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } 
		else {
            echo "Sorry, there was an error uploading your file.";
        }
    
    // ===============================================  File Upload Code u  ==========================================================


    // =============  Connectivity for DATABASE d ===================================
    require_once('connect.php');
	

    $vidname = $_FILES["fileToUpload"]["name"] . "";
	$type = $_POST["type"];
   
    $sql = "INSERT INTO material (pid,attachment,type) VALUES ('" . $_SESSION['pid'] . "','$vidname','$type')";

    if (mysqli_query($conn,$sql) === TRUE) {} 
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    mysqli_close($conn);
    // =============  Connectivity for DATABASE u ===================================

    ?>