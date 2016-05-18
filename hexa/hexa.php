<?php
session_start();
include("../configuration.php");
header('Content-Type: text/html; charset=utf-8');
$page = "home";
$rank = "total";
if($_GET["page"]){
	$page = $_GET["page"];
}
if($_GET["rank"]){
	$rank = $_GET["rank"];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta author = "">
	<title>a</title>
	<link type="text/css" rel="stylesheet" href="./hexa.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="hexa.js"></script>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
	<div id = "tophead">

		<div id = "top">
			<ul class="nav">
  			<li>
  				<?php
  					echo "<a href='./hexa.php?page=home&rank=$rank'>主页</a>"
  				?>
  			</li>
  			<li>
  				<a href="http://www.bilibili.com/video/bangumi.html">动画</a>
  			</li>
  			<li>
  				<?php
  				echo "<a href='./hexa.php?page=manga&rank=$rank'>漫画</a>"
  				?>
  			</li>
  			<li>
  				<?php
  				echo "<a href='./hexa.php?page=lightnovel&rank=$rank'>小说</a>"
  				?>
  			</li>
  		</ul>
		</div>

		<div id = "topright">
			<ul class="nav">
  			<li>
  				<?php
  				$username = $_SESSION["a"];
  				if($username){
  					/*$query = "SELECT userID FROM userinfo WHERE username = :username;";
  					$stmt = $db->prepare($query);
  					$exe = $stmt->execute(array(":username"=>$username));
  					$content = $stmt->fetch();
  					$userID = $content["userID"];*/
  					echo "<a href='../loginreg/personal/personalpage.php?page=$page&rank=$rank'>$username</a>";
  				} else {
  					echo "<a href='../loginreg/login.php?page=$page&rank=$rank'>登录</a>";
  				}
  				?>
  			</li>
  			<li>
  				<?php
  				session_start();
  				if($username){
  					echo "<a href='../loginreg/success.php?page=$page&rank=$rank'>注销</a>";
  				} else {
  					echo "<a href='../loginreg/register.php?page=$page&rank=$rank'>注册</a>";
  				}
  				?>
  			</li>
  			</ul>
		</div>
		<?php
		session_start();
		if($username){
			echo "<div id = 'toprightright'>";
			echo "<ul class='nav' id = 'sp'>";
  			echo	"<li>";
  			echo	"<a href='../upload/uploadd.php?page=$page&rank=$rank'>上传</a>";
  			echo	"</li>";
  			echo	"</ul>";
			echo "</div>";
		}
		?>
	</div>

	<div id = "ranking">
		<div class = "wrap" id = "picwrap">
			<div class="topic-preview-wrapper" id="pic1">
			<div class="topic-preview-list-wrapper" id="pic">
				<ul class="topic-preview" style="width: 700%;">
					<li preview="preview">
						<a target="_blank" href="http://www.bilibili.com/html/animejp2016.html">
							<img src="http://i0.hdslb.com/group1/M00/B6/ED/oYYBAFbzwm2AA8fwAADb3FDpnUE845.jpg">
						</a>
					</li>
					<li preview="preview">
						<a target="_blank" href="http://acg.tv/u14J">
							<img src="http://acg.tv/u152">
						</a>
					</li>
					<li preview="preview">
						<a target="_blank" href="http://www.bilibili.com/topic/v2/1148.html">
							<img src="http://i0.hdslb.com/group1/M00/B6/F1/oYYBAFb1CGSAPbWQAADq0FFsfew649.jpg">
						</a>
					</li>
					<li preview="preview">
						<a target="_blank" href="http://www.bilibili.com/topic/v2/1144.html">
							<img src="http://i0.hdslb.com/group1/M00/B6/EA/oYYBAFbzjGiACnuVAAE_yxGjeas340.jpg">
						</a>
					</li>
					<li preview="preview">
						<a target="_blank" href="http://www.bilibili.com/topic/1142.html">
							<img src="http://i0.hdslb.com/group1/M00/B6/E4/oYYBAFbyBcuAOMHTAADTqGSTHF4271.jpg">
						</a>
					</li>
					<li preview="preview">
						<a target="_blank" href="http://www.bilibili.com/topic/v2/1141.html">
							<img src="http://i0.hdslb.com/group1/M00/B6/E0/oYYBAFbxDviASputAACWRWwvV4w940.jpg">
						</a>
					</li>
					<li preview="preview">
						<a target="_blank" href="http://www.bilibili.com/topic/1135.html">
							<img src="http://i0.hdslb.com/group1/M00/B6/D9/oYYBAFbuS16AGUQ9AAGhkW7fV9U514.jpg">
						</a>
					</li>
				</ul>
			</div>

			<div id="topic-preview-menu-wrapper" >
				<ul>
					<li id="topicmenua">  
					</li>
					<li id="topicmenub">  
					</li>
					<li id="topicmenuc">  
					</li>
					<li id="topicmenud">  
					</li>
					<li id="topicmenue">  
					</li>
					<li id="topicmenuf">  
					</li>
					<li id="topicmenug">  
					</li>
				</ul>
			</div>
			</div>
		</div>
		<div id="rankmenu">
			<ul class="nav">
  			<li>
  				<?php
  				if(($page != "lightnovel")&&($page != "manga")){
  				} else {
  					echo "<a href='./hexa.php?page=$page&rank=total'>排行</a>";
  				}
  				?>
  			</li>
  			<!--<li>
  				<?php
  					//echo "<a href='./hexa.php?page=$page&rank=year'>Year</a>";
  				?>
  			</li>
  			<li>
  				<?php
  					//echo "<a href='./hexa.php?page=$page&rank=season'>Season</a>";
  				?>
  			</li>
  			<li>
  				<?php
  					//echo "<a href='./hexa.php?page=$page&rank=month'>Month</a>";
  				?>
  			</li>
  			<li>
  				<?php
  					//echo "<a href='./hexa.php?page=$page&rank=day'>Day</a>";
  				?>
  			</li
  			>-->
  		</ul>
		</div>
		<?php
		if(($page != "manga")&&($page != "lightnovel")){
			echo "<div id = 'bla' style='left:350px;top:520px;position:absolute;'><p>漫画排行</p></div>";
			echo "<div id = 'bla' style='left:950px;top:520px;position:absolute;'><p>小说排行</p></div>";
		}
		?>
		<div id = "table">
			<ul id="box4" class="clearfix masonry" style="position: relative; height: 900px; width: 1240px; margin-top:0; margin-left:100px; list-style:none;">
<?php
$query = "SELECT * FROM workinfo ORDER BY $tablerank DESC";
$tablerank = "vote".$rank;
if($page == "manga"){
	$query = "SELECT * FROM workinfo WHERE form = 'Manga' ORDER BY $tablerank DESC";
} else if($page == "lightnovel"){
	$query = "SELECT * FROM workinfo WHERE form = 'Light Novel' ORDER BY $tablerank DESC";
} else {
	$query = "SELECT * FROM workinfo ORDER BY $tablerank DESC";
}
if($page == "manga" || $page == "lightnovel"){
$stmt = $db->prepare($query);
$stmt->execute();
$info = $stmt->fetch();
if($info){
$workID=$info["workID"];
$vv = $info["$tablerank"];

$filepath = "../upload/uploads/W$workID/";
//echo "$filepath";
$file = scandir($filepath);
$filename = $file[2];
$topp = 0;
$i = 0;
while($i < 6 && $info){
//var_dump($info);
$vv = $info["$tablerank"];
//echo "<br>";
//var_dump($vv);
$workID=$info["workID"];
$filepath = "../upload/uploads/W$workID/";
$file = scandir($filepath);
$in=0;
$cover="C0VER";
while($file[$in]){
	$filename = $file[$in];
	if(strpos($filename, $cover)!==false){
		break;
	}
	$in++;
	$filename = "a.png";
}
echo "<li style='position: absolute; top: 0px; left: $topp"."px;'><a href='../content.php?id=$workID' style='opacity: 1;'><img src='$filepath$filename' width='180' height='260'></a></li>";
		//<img src="http://www.ajin.net/goods/img/bd_s01.jpg" width="180" height="260"></a></li>
$topp = $topp + 200;
$i++;
$info = $stmt->fetch();
}
}
} else {
//////////////////////////////////////////////////////////////////first 3;
$query = "SELECT * FROM workinfo WHERE form = 'Manga' ORDER BY $tablerank DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$info = $stmt->fetch();
if($info){
$workID=$info["workID"];
$vv = $info["$tablerank"];

$filepath = "../upload/uploads/W$workID/";
//echo "$filepath";
$file = scandir($filepath);
$filename = $file[2];
$topp = 0;
$i = 0;
while($i < 3){
	if(!$info){
		echo "<li style='position: absolute; top: 0px; left: $topp"."px;'><a href='../content.php?id=$workID' style='opacity: 0;'><img src='../loginreg/Ginko.Mushishi.full.230979.jpg' width='180' height='260'></a></li>";
		$topp = $topp + 200;
		$i++;
		$info = $stmt->fetch();
		continue;
	}
//var_dump($info);
$vv = $info["$tablerank"];
//echo "<br>";
//var_dump($vv);
$workID=$info["workID"];
$filepath = "../upload/uploads/W$workID/";
$file = scandir($filepath);
$in=0;
$cover="C0VER";
while($file[$in]){
	$filename = $file[$in];
	if(strpos($filename, $cover)!==false){
		break;
	}
	$in++;
	$filename = "a.png";
}
echo "<li style='position: absolute; top: 0px; left: $topp"."px;'><a href='../content.php?id=$workID' style='opacity: 1;'><img src='$filepath$filename' width='180' height='260'></a></li>";
		//<img src="http://www.ajin.net/goods/img/bd_s01.jpg" width="180" height="260"></a></li>
$topp = $topp + 200;
$i++;
$info = $stmt->fetch();
}
}
////////////////////////////////////////////////////////////second 3
$query = "SELECT * FROM workinfo WHERE form = 'Light Novel' ORDER BY $tablerank DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$info = $stmt->fetch();
if($info){
$workID=$info["workID"];
$vv = $info["$tablerank"];

$filepath = "../upload/uploads/W$workID/";
//echo "$filepath";
$file = scandir($filepath);
$filename = $file[2];
//$topp = 0;
$i = 0;
while($i < 3){
	if(!$info){
		echo "<li style='position: absolute; top: 0px; left: $topp"."px;'><a href='../content.php?id=$workID' style='opacity: 0;'><img src='../loginreg/Ginko.Mushishi.full.230979.jpg' width='180' height='260'></a></li>";
		$topp = $topp + 200;
		$i++;
		$info = $stmt->fetch();
		continue;
	}
//var_dump($info);
$vv = $info["$tablerank"];
//echo "<br>";
//var_dump($vv);
$workID=$info["workID"];
$filepath = "../upload/uploads/W$workID/";
$file = scandir($filepath);
$in=0;
$cover="C0VER";
while($file[$in]){
	$filename = $file[$in];
	if(strpos($filename, $cover)!==false){
		break;
	}
	$in++;
	$filename = "a.png";
}
echo "<li style='position: absolute; top: 0px; left: $topp"."px;'><a href='../content.php?id=$workID' style='opacity: 1;'><img src='$filepath$filename' width='180' height='260'></a></li>";
		//<img src="http://www.ajin.net/goods/img/bd_s01.jpg" width="180" height="260"></a></li>
$topp = $topp + 200;
$i++;
$info = $stmt->fetch();
}
}
}
/*<li style="position: absolute; top: 0px; left: 200px;">
	<a href="#" style="opacity: 1;">
		<img src="http://www.ajin.net/goods/img/bd_s02.jpg" width="180" height="260"></a></li>

<li style="position: absolute; top: 0px; left: 400px;">
	<a href="#" style="opacity: 1;">
		<img src="http://www.ajin.net/goods/img/bd_s03.jpg" width="180" height="260"></a></li>
<li style="position: absolute; top: 0px; left: 600px;">
	<a href="#" style="opacity: 1;">
		<img src="http://www.ajin.net/goods/img/bd_s04.jpg" width="180" height="260"></a></li>
<li style="position: absolute; top: 0px; left: 800px;">
	<a href="#" style="opacity: 1;">
		<img src="http://www.ajin.net/goods/img/bd_s05.jpg" width="180" height="260"></a></li>
<li style="position: absolute; top: 0px; left: 1000px;">
	<a href="#" style="opacity: 1;">
		<img src="http://www.ajin.net/goods/img/bd_s06.jpg" width="180" height="260"></a></li>
*/?>
</ul>
		</div>
	</div>

	<div id = "content" class = "wrap">
		<div id="contmenu">
			<ul class="nav">
  			<li>
  				<a href="#">内容</a>
  			</li>
  			</ul>
		</div>
		<table id = "ta" border = "0">
	        <thead>
	            <tr height = "40px" style = "background-color: rgba(213,128,255,0.5);text-shadow: 2px 2px #b31aff;" align = 'center'>
	                <th width = "300px">作品名</th>
	                <th width = "150px">作者</th>
	                <th width = "150px">最新章节</th>
	                <th width = "200px">最后修改</th>
	                <?php
	                if($rank == "day"){
		echo "<th width = '100px'>day rank</th>";
	} else if($rank == "month"){
		echo "<th width = '100px'>month rank</th>";
	} else if($rank == "season"){
		echo "<th width = '100px'>season rank</th>";
	} else if($rank == "year"){
		echo "<th width = '100px'>year rank</th>";
	} else {
		//echo "<script>alert('1')</script>";
		echo "<th width = '100px'>总排名</th>";
	}
	?>
	                <th width = "100px">投票</th>
	            </tr>
	        </thead>
	    	</table>
		<div id = "realcontent">
		<table id = "tab" border = "0">
	        <thead>
	            <tr height = "40px" style = "background-color: rgba(213,128,255,0.5);text-shadow: 2px 2px #b31aff;" align = 'center'>
	                <th>作品名</th>
	                <th>作者</th>
	                <th>最新章节</th>
	                <th>最后修改</th>
	                <?php
	                if($rank == "day"){
		echo "<th>day rank</th>";
	} else if($rank == "month"){
		echo "<th>month rank</th>";
	} else if($rank == "season"){
		echo "<th>season rank</th>";
	} else if($rank == "year"){
		echo "<th>year rank</th>";
	} else {
		echo "<th>总排名</th>";
	}
	?>
	                <th>vote</th>
	            </tr>
	        </thead>
	        <tbody>
<?php
$query = "SELECT * FROM workinfo;";
if($page == "manga"){
$query = "SELECT * FROM workinfo WHERE form = 'Manga';";
}
if($page == "lightnovel") {
$query = "SELECT * FROM workinfo WHERE form = 'Light Novel';";
}
$stmt = $db->prepare($query);
$stmt->execute();
$info = $stmt->fetch();
$flag = 0;
while($info){
	$id = $info["workID"];
	$workname = $info["workname"];
	$form = $info["form"];
	$author = $info["authorID"];
	$latest = $info["newestchp"];
	$vote = $info["votetotal"];
	if($rank == "day"){
		$vote = $info["voteday"];
	} else if($rank == "month"){
		$vote = $info["votemonth"];
	} else if($rank == "season"){
		$vote = $info["voteseason"];
	} else if($rank == "year"){
		$vote = $info["voteyear"];
	} else {
		$vote = $info["votetotal"];
	}
	$last = $info["lastmod"];
	$bgcolor = "#F2FCFF";
	if($flag == 0){
		$flag++;
		$bgcolor = "";
	} else {
		$flag--;
		$bgcolor = "";
	}
	// grab author name;
	$query = "SELECT username FROM userinfo WHERE userID = :userID";
	$stmt1 = $db->prepare($query);
	$exe = $stmt1->execute(array(":userID"=>$author));
	$content = $stmt1->fetch();
	$authorname = $content["username"];

	echo "<tr style='background-color: rgba(255,255,255,0.5);' height = '30px'>
			  <td width = '300px' align = 'center'><a href='../content.php?id=$id'>$workname</a></td>
	          <td width = '150px' align = 'center'><a href='../loginreg/personal/personalpage.php?page=$page&rank=$rank&userID=$author'>$authorname</a></td>";
	  		if($form == "Manga"){
	          	echo "<td width = '150px' align = 'center'><a href='../viewText.php?id=$id&chpfil=第 $latest 话'>第 $latest 话</a></td>";
	      	} else {
	      		echo "<td width = '150px' align = 'center'><a href='../viewText.php?id=$id&chpfil=第 $latest 章'>第 $latest 章</a></td>";
	      	}
	      	echo "<td width = '200px' align = 'center'>$last</td>
	          	<td width = '100px' align = 'center'>$vote</td>";

	if($username){
		// check whether voted before;
		// grab current id;
		$query = "SELECT userID FROM userinfo where username = :user;";
		$stmt1 = $db->prepare($query);
		$exe = $stmt1->execute(array(":user"=>$_SESSION["a"]));
		$content = $stmt1->fetch();
		$curID = $content["userID"];

		$query = "SELECT * FROM U$curID where type = 'vote' and workID = :id;";
		$stmt1 = $db->prepare($query);
		$exe = $stmt1->execute(array(":id"=>$id));
		$content = $stmt1->fetch();

		if($content){
			echo "<td width = '100px' align = 'center'>
				<form method = 'post' action='button.php'>
				<input type='hidden' name = 'invi' value = '$id'>
					<input type='submit' name = 'do' value = '撤销'>
				</form></td>
	      	</tr>";
	    } else {
	    	echo "<td width = '100px' align = 'center'>
				<form method = 'post' action='button.php'>
					<input type='hidden' name = 'invi' value = '$id'>
					<input type='submit' name = 'do' value = '投票'>
				</form></td>
	      	</tr>";
	    }
	} else {
		echo "<td width = '100px' align = 'center'>login required</td></tr>";
	}
	$info = $stmt->fetch();
}
$a = "d";
?>
</tbody>
</table>

		</div>
	</div>
</body>
</html>
