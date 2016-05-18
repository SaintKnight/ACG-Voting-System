<?php
session_start();
include ("../../configuration.php");
$page = "home";
$rank = "total";
if($_GET["page"]){
	$page = $_GET["page"];
}
if($_GET["rank"]){
	$rank = $_GET["rank"];
}
if(!$_GET["submit"]){
// error
}
$username = $_SESSION["a"];
$sex = $_GET["sex"];
$birthday = $_GET["birthday"];
$tel = $_GET["tel"];
$email = $_GET["email"];
$location = $_GET["location"];

$query = "UPDATE userinfo SET sex = :sex, birthday = :birthday, tel=:tel, email = :email, location=:location WHERE username = :username;";
$stmt = $db->prepare($query);
$exe = $stmt->execute(array(":sex"=>$sex, ":birthday"=>$birthday, ":tel"=>$tel, ":email"=>$email, ":location"=>$location, ":username"=>$username));

echo "<script>alert('Your change has been made successfully!')</script>";
echo "<script>window.location = './personalpage.php?page=$page&rank=$rank'</script>";
exit;

?>