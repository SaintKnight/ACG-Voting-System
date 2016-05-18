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
//var_dump($_GET);
include("configuration.php");
if($_GET){
	$workID = $_GET["id"];
	$chpfil = $_GET["chpfil"];
	$query = "SELECT form FROM workinfo WHERE workID = $workID";
	$stmt = $db->prepare($query);
	$stmt->execute();
	$content = $stmt->fetch();
	$type = $content["form"];

	$filepath = "upload/uploads/W".$workID."/".$chpfil."/";

	//$files = scandir($filepath);

	if($type == "Manga"){
			//echo "<br>PATH:$filepath<br>";
			$files = scandir($filepath);
			//var_dump($filepath);
			$i=2;
			$count=0;
			while($files[$i]){
				$filename = $files[$i];
				//var_dump($filename[0]);
				$i++;
				if($filename[0]==".") {
					continue;
				}
				$count++;
				echo "NO$count: <img src='$filepath$filename' /><br>";
				//$counter++;
			}
		} else {
			$files = scandir($filepath);
			$i=2;
			$count=0;
			$filename=$files[0];
			while($files[$i]){
				$filename = $files[$i];
				//var_dump($filename[0]);
				$i++;
				if($filename[0]==".") {
					continue;
				}
				//var_dump($filename);
				break;
				//$counter++;
			}
			$myfile = fopen($filepath.$filename, "r") or die("Unable to open file!");
			echo fread($myfile,filesize($filepath.$filename));
			fclose($myfile);
		}
}else{
	echo "error";
}
?>
  </section>
</div>
</div>
</body>
</html>