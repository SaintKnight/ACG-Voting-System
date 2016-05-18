<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$username=$_SESSION["a"]; 
include("../configuration.php");
	var_dump($_POST);
	$workID = $_POST["invi"];
	if($_POST["do"] == "投票"){
		// modify workinfo
		// load info
		$query = "SELECT * FROM workinfo where workID = :workID;";
		$stmt1 = $db->prepare($query);
		$exe = $stmt1->execute(array(":workID"=>$workID));
		$content = $stmt1->fetch();
		$vtotal = $content["votetotal"];
		$vyear = $content["voteyear"];
		$vseason = $content["voteseason"];
		$vmonth = $content["votemonth"];
		$vday = $content["voteday"];

		// modify info
		$vtotal++;
		$vyear++;
		$vseason++;
		$vmonth++;
		$vday++;

		// store info
		$query = "UPDATE workinfo SET votetotal = :v1, voteyear=:v2, voteseason=:v3, votemonth=:v4, voteday=:v5 WHERE workID = :workID;";
		$stmt1 = $db->prepare($query);
		$exe = $stmt1->execute(array(":v1"=>$vtotal,":v2"=>$vyear,":v3"=>$vseason,":v4"=>$vmonth,":v5"=>$vday,":workID"=>$workID));


		// modify Uid
		// grab current id;
		$query = "SELECT userID FROM userinfo where username = :user;";
		$stmt1 = $db->prepare($query);
		$exe = $stmt1->execute(array(":user"=>$_SESSION["a"]));
		$content = $stmt1->fetch();
		$curID = $content["userID"];

		// add entry to Uid
		$query = "INSERT INTO U$curID (workID, type) VALUES (:workID, 'vote');";
		$stmt1 = $db->prepare($query);
		$exe = $stmt1->execute(array(":workID"=>$workID));

	} else {
		// modify workinfo
		// load info
		$query = "SELECT * FROM workinfo where workID = :workID;";
		$stmt1 = $db->prepare($query);
		$exe = $stmt1->execute(array(":workID"=>$workID));
		$content = $stmt1->fetch();
		$vtotal = $content["votetotal"];
		$vyear = $content["voteyear"];
		$vseason = $content["voteseason"];
		$vmonth = $content["votemonth"];
		$vday = $content["voteday"];

		// modify info
		$vtotal--;
		$vyear--;
		$vseason--;
		$vmonth--;
		$vday--;

		// store info
		$query = "UPDATE workinfo SET votetotal = :v1, voteyear=:v2, voteseason=:v3, votemonth=:v4, voteday=:v5 WHERE workID = :workID;";
		$stmt1 = $db->prepare($query);
		$exe = $stmt1->execute(array(":v1"=>$vtotal,":v2"=>$vyear,":v3"=>$vseason,":v4"=>$vmonth,":v5"=>$vday,":workID"=>$workID));


		// modify Uid
		// grab current id;
		$query = "SELECT userID FROM userinfo where username = :user;";
		$stmt1 = $db->prepare($query);
		$exe = $stmt1->execute(array(":user"=>$_SESSION["a"]));
		$content = $stmt1->fetch();
		$curID = $content["userID"];

		// remove entry from Uid
		$query = "DELETE FROM U$curID where workID = :workID and type = 'vote';";
		$stmt1 = $db->prepare($query);
		$exe = $stmt1->execute(array(":workID"=>$workID));
	}
	echo "<script>window.location = 'hexa.php'</script>";
?>