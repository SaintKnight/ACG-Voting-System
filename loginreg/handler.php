<?php
session_start();
$page = $_GET["page"];
$rank = $_GET["rank"];
include("../configuration.php");
// register
if($_POST["old"]){
	$username = $_SESSION["a"];
	$query = "SELECT password FROM userinfo where username = :username;";
	$stmt = $db->prepare($query);
	$exe = $stmt->execute(array(":username"=>$username));
	$content = $stmt->fetch();
	$password = $content["password"];
	if($_POST["old"] === $password){
		if($_POST["new"] === $_POST["confirm"]){
			$newpass = $_POST["new"];
			$query = "UPDATE userinfo SET password = :newpass WHERE username = :username";
			$stmt = $db->prepare($query);
			$exe = $stmt->execute(array(":newpass"=>$newpass,":username"=>$username));
			$_SESSION["a"] = $username;
			echo "<script>alert('Your password has changed successfully!')</script>";
			echo "<script>window.location = './personalpage.php?page=$page&rank=$rank'</script>";
			exit;
		} else {
			echo "<script>alert('New password confirm does not match! Please try again!')</script>";
			echo "<script>window.location = './changepass.php?page=$page&rank=$rank'</script>";
			exit;
		}
	} else {
		echo "<script>alert('Your old password is incorrect! Please try again!')</script>";
		echo "<script>window.location = './changepass.php?page=$page&rank=$rank'</script>";
		exit;
	}
} else if($_POST["password_confirmation"]){
	$name = $_POST["register"];
	$pass = $_POST["password"];

	if($pass !== $_POST["password_confirmation"]){
		echo "<script>alert('Password confirm does not match! Please try again!')</script>";
		echo "<script>window.location = './register.php?page=$page&rank=$rank'</script>";
		exit;
	}

	// check username existence;
	$query = "SELECT * FROM userinfo WHERE username = :username";
	$stmt = $db->prepare($query);
	$exe = $stmt->execute(array(":username"=>$name));
	$content = $stmt->fetch();
	if($content){
		echo "<script>alert('Username already exists! Please use another one!')</script>";
		echo "<script>window.location = './register.php?page=$page&rank=$rank'</script>";
		exit;
	}

	// add a new entry to userinfo, assign a new userID;
	$query = "INSERT INTO userinfo (username, password, regtime, state) VALUES (:name, :pass, NOW(), 'active');";
	$stmt = $db->prepare($query);
	$exe = $stmt->execute(array(":name"=>$name,":pass"=>$pass));

	// grab the new userID;
	$userid = "SELECT userID FROM userinfo ORDER BY userID DESC LIMIT 1;";
	$stmt = $db->prepare($userid);
	$exe = $stmt->execute();
	$content = $stmt->fetch();
	$userid = $content["userID"];

	// create a new folder Uid
	mkdir("../upload/uploads/U$userid",0755,true);

	// create new table for the new userID;
	$userid = "U".$userid;
	$query = "CREATE TABLE $userid (workID INT, type TEXT);";
	$stmt = $db->prepare($query);
	$exe = $stmt->execute();

	// auto login
	$_SESSION["a"] = $name;
	echo "<script>window.location = '../hexa/hexa.php?page=$page&rank=$rank'</script>";
    exit;
} else {
	// login
	$name = $_POST["login"];
	$pass = $_POST["password"];

	// grab the user password;
	$userpass = "select * from userinfo where username = :name;";
	$stmt = $db->prepare($userpass);
	$exe = $stmt->execute(array(":name"=>$name));
	$content = $stmt->fetch();
	//var_dump($content);
	$userpass = $content["password"];
	$userstate = $content["state"];
	//var_dump($userpass);

	// check state;
	if($userstate === "freeze"){
		echo "<script>alert('Sorry, your account is freezed.')</script>";
		echo "<script>window.location = '../hexa/hexa.php?page=$page&rank=$rank'</script>";
		exit;
	} else if($userpass === $pass){
		$_SESSION["a"] = $name;
		echo "<script>window.location = '../hexa/hexa.php?page=$page&rank=$rank'</script>";
    	exit;
	} else {
		echo "<script>alert('login fail. Username and password do not match.')</script>";
		echo "<script>window.location = './login.php?page=$page&rank=$rank'</script>";
		//GOTO("fail.html");
    	exit;
	}
}
?>
