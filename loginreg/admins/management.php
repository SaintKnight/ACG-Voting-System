<?php
include ("../../configuration.php");
header('Content-Type: text/html; charset=utf-8');
session_start();
$page = $_POST["page"];
$rank = $_POST["rank"];
if($_POST["delete"]){
	$workID = $_POST["invi"];
	$authorID = $_POST["authorID"];
	// delete work;
	$var = var_dump($_POST);
	echo "<script>alert('$var')</script>";
	//echo "<script>window.location = './managework.php?page=$page&rank=$rank'</script>";
	// delete in file system
	delTree("../../upload/uploads/W$workID");
	// remove entry in workinfo
	$query = "DELETE FROM workinfo WHERE workID = :workID;";
	$stmt = $db->prepare($query);
	$exe = $stmt->execute(array(":workID"=>$workID));
	// remove entry in Uid where upload
	$query = "DELETE FROM U$authorID WHERE workID = :workID AND type = 'upload';";
	$stmt = $db->prepare($query);
	$exe = $stmt->execute(array(":workID"=>$workID));
	// remove Wid table;
	$query = "DROP TABLE W$workID";
	$stmt = $db->prepare($query);
	$exe = $stmt->execute();
	if($_POST["personal"]){
		echo "<script>window.location = '../personal/personalworkmanage.php?page=$page&rank=$rank'</script>";
	} else {
		echo "<script>window.location = './managework.php?page=$page&rank=$rank'</script>";
	}
} else if($_POST["rmlat"]){
	$var = var_dump($_POST);
	echo "<script>alert('$var')</script>";
	$workID = $_POST["invi"];
	$latest = $_POST["latest"];
	$authorID = $_POST["authorID"];
	$form = $_POST["form"];
	// delete one;
	if($form === "Manga"){
		echo "<script>alert('../../upload/uploads/W$workID/第 $latest 话')</script>";
	} else {
		echo "<script>alert('../../upload/uploads/W$workID/第 $latest 章')</script>";
	}
	//echo "<script>window.location = './managework.php?page=$page&rank=$rank'</script>";
	if($latest === "1"){
		// delete in file system;
		delTree("../../upload/uploads/W$workID");
		// remove entry in workinfo
		$query = "DELETE FROM workinfo WHERE workID = $workID;";
		$stmt = $db->prepare($query);
		$exe = $stmt->execute();
		// remove entry in Uid where upload
		$query = "DELETE FROM U$authorID WHERE workID = $workID AND type = 'upload';";
		$stmt = $db->prepare($query);
		$exe = $stmt->execute();
		// remove Wid table;
		$query = "DROP TABLE W$workID";
		$stmt = $db->prepare($query);
		$exe = $stmt->execute();
	} else {
		// delete in file system;
		if($form === "Manga"){
			delTree("../../upload/uploads/W$workID/第 $latest 话");
		} else {
			delTree("../../upload/uploads/W$workID/第 $latest 章");
		}
		// remove entry in Wid 
		$query = "DELETE FROM W$workID WHERE num = $latest;";
		$stmt = $db->prepare($query);
		$exe = $stmt->execute();
		// update latest release;
		$latest--;
		$query = "UPDATE workinfo SET newestchp = $latest WHERE workID = $workID;";
		$stmt = $db->prepare($query);
		$exe = $stmt->execute();
	}
	if($_POST["personal"]){
		echo "<script>window.location = '../personal/personalworkmanage.php?page=$page&rank=$rank'</script>";
	} else {
		echo "<script>window.location = './managework.php?page=$page&rank=$rank'</script>";
	}
} else {
	$userID = $_POST["invi"];
	$action = $_POST["do"];
	if($action === "reactive"){
		$action = "active";
	}
	$query = "UPDATE userinfo SET state = :action WHERE userID = :userID";
	$stmt = $db->prepare($query);
	$exe = $stmt->execute(array(":action"=>$action,":userID"=>$userID));
	echo "<script>alert('Your change has been made!')</script>";
	echo "<script>window.location = './manageuser.php?page=$page&rank=$rank'</script>";
}
?>