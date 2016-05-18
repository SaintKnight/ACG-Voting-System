<?php
	header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html>
<head>
	<meta author = "">
	<title>login</title>
  <link type="text/css" rel="stylesheet" href="./content.css" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
  <div class="outer">
<div class="inner">
	<section class="container">
<?php 
include("configuration.php");
if($_GET){
	$counter = 1;
	$id = $_GET["id"];
	$query = "SELECT * FROM workinfo WHERE workID = $id;";
	$stmt = $db->prepare($query);
	$stmt->execute();
	$info = $stmt->fetch();
	if($info){
		if($info["form"] === "Manga"){
			echo "漫画".": ".$info["workname"]."<br>";
		} else {
			echo "小说".": ".$info["workname"]."<br>";
		}

		// grab path;
		$filepath = "upload/uploads/W".$info["workID"]."/";
		// open file;
		//var_dump($filepath);
		$files = scandir($filepath);
		//var_dump($files);
		$i = 2;
		//var_dump($files);
		$num = 1;
		while($files[$i]){
			if($files[$i][0]!="."&&$files[$i][1]!="0"){
				$query = "SELECT * FROM W$id WHERE num = $num;";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$info = $stmt->fetch();
				echo "<a href='./viewText.php?id=".$id."&chpfil=".$files[$i]."'>".$files[$i].". ".$info["name"]."</a>"."<br>";
				$num++;
			}
			$i++;
		}

		/*if($info["form"] == "Manga"){
			echo "<br>PATH:$filepath<br>";
			$files = scandir($filepath);
			$i=2;
			while($files[$i]){
				$filename = $files[$i];
				$count = $i-1;
				echo "NO$count: <img src='$filepath$filename' /><br>";
				//$counter++;
				$i++;
			}
		} else {
			$files = scandir($filepath);
			$myfile = fopen($filepath.$files[2], "r") or die("Unable to open file!");
			echo fread($myfile,filesize($filepath));
			fclose($myfile);
		}*/

	}else{
		echo "Invalid ID!!!!!";
	}
}else{
	echo "NOTHING";
}
?>

  </section>
</div>
</div>
</body>
</html>