<!DOCTYPE html>
<html>
<body>

<?php
include("configuration.php");
$query = "SELECT * FROM workinfo;";
$stmt = $db->prepare($query);
$stmt->execute();
$info = $stmt->fetch();
while($info){
	$id = $info["workID"];
	echo "<a href='http://localhost/hex/content.php?id=$id'>Work NO.$id</a><br>";
	$info = $stmt->fetch();
}
$a = "d";
?>


</body>
</html>