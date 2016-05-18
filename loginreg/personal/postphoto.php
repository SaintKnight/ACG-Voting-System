<?php
include ("../../configuration.php");
session_start();
var_dump($_FILES);
    // grab userID;
    $username = $_SESSION["a"];
    $query = "SELECT userID FROM userinfo WHERE username = :username;";
    $stmt = $db->prepare($query);
    $exe = $stmt->execute(array(":username"=>$username));
    $content = $stmt->fetch();
    $userID = $content["userID"];

    // upload photo;
    $target_dir = "../../upload/uploads/U$userID/";
    $photo = "PHOTO";
    $temp = $target_dir . basename($_FILES["photo"]["name"]);
    $FileType = pathinfo($temp,PATHINFO_EXTENSION);
    $target_file = $target_dir . $photo. '.'.$FileType;
    $coverOk = 1;

    // REMOVE prev photo;
    delTree("../../upload/uploads/U$userID/");
    mkdir("../../upload/uploads/U$userID/");

    // Check if cover already exists
    if (file_exists($target_file)) {
        echo "Sorry, photo already exists.";
        $coverOk = 0;
    }

    // Check cover size;
    if ($_FILES["photo"]["size"] > 500000000) {
        echo "Sorry, your cover is too large.";
        $coverOk = 0;
    }
    // Check cover type;    
    if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
    && $FileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for cover.";
        $coverOk = 0;
    }
    if ($coverOk != 0) {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
        }
    }
    echo "<script>alert('Your photo has been uploaded successfully.')</script>";
    echo "<script>window.location = './personalpage.php?page=home&rank=total'</script>";
/*	// grab userID;
	$username = $_SESSION["a"];
	$query = "SELECT userID FROM userinfo WHERE username = :username;";
	$stmt = $db->prepare($query);
	$exe = $stmt->execute(array(":username"=>$username));
	$content = $stmt->fetch();
	$userID = $content["userID"];

	// upload photo;
    $target_dir = "../upload/uploads/U$userID/";
    echo "<script>alert('$target_dir')</script>";
    $photo = "PHOTO";
    $temp = $target_dir . basename($_FILES["photo"]["name"]);
    $FileType = pathinfo($temp,PATHINFO_EXTENSION);
    $target_file = $target_dir . $photo. '.'.$FileType;
    $coverOk = 1;

    // REMOVE prev photo;
    //delTree("../upload/uploads/U$userID/");

    // Check if cover already exists
    if (file_exists($target_file)) {
        echo "Sorry, photo already exists.";
        $coverOk = 0;
    }

    // Check cover size;
    if ($_FILES["photo"]["size"] > 500000000) {
        echo "Sorry, your cover is too large.";
        $coverOk = 0;
    }
    // Check cover type;    
    if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
    && $FileType != "gif" ) {
    	echo "<script>alert('$FileType')</script>";
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for cover.";
        $coverOk = 0;
    }
    if ($coverOk != 0) {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
        }
    }*/
    ?>