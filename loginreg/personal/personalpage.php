<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../configuration.php");
$page = "home";
$rank = "total";
$userID = $_SESSION["a"];
$content = "";
if($_GET["page"]){
	$page = $_GET["page"];
}
if($_GET["rank"]){
	$rank = $_GET["rank"];
}
if($_GET["userID"]){
	$userID = $_GET["userID"];
	$query = "SELECT * FROM userinfo WHERE userID = $userID;";
	$stmt = $db->prepare($query);
	$exe = $stmt->execute();
	$content = $stmt->fetch();
} else {
	$query = "SELECT * FROM userinfo WHERE username = :username;";
	$stmt = $db->prepare($query);
	$exe = $stmt->execute(array(":username"=>$userID));
	$content = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta author = "">
	<title>personal page</title>
	<link type="text/css" rel="stylesheet" href="./personal.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="hexa.js"></script>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
	<div id = "left">
		<?php
		$userI = $content["userID"];
		$files = scandir("../../upload/uploads/U$userI/");
		$i=0;
		$flag=0;
		while($files[$i]){
			if($files[$i][0] === "P"){
				$flag=1;
				break;
			}
			$i++;
		}
		if($flag){
			$f = $files[$i];
			echo "<div id = 'photo' style=\"background-image: url('../../upload/uploads/U$userI/$f')\">";
		} else {
			echo "<div id = 'photo' style=\"background-image: url('./timg.jpeg')\">";
		}
		?>
		</div>
		<div id = "manage">
			<p style="text-align:left; color:#6699ff; font-size:20px">个人管理:</p>
			<div style = 'text-align:center'>
		<?php 
			if(!$_GET["userID"]){
			echo "<p><a href='./changephoto.php?page=$page&rank=$rank'>更改头像</a></p>";
			echo "<p><a href='../changepass.php?page=$page&rank=$rank'>修改密码</a></p>";
			echo "<p><a href='./personalinfomanage.php?page=$page&rank=$rank'>更改个人信息</a></p>";
			echo "<p><a href='./personalworkmanage.php?page=$page&rank=$rank'>管理个人作品</a></p>";
			//var_dump($admins);
			if(in_array($_SESSION["a"], $admins)){
				echo "<p style='text-align:left; color:#6699ff;font-size:20px'>平台管理:</p>";
				echo "<p><a href='../admins/manageuser.php?page=$page&rank=$rank'>管理用户</a></p>";
				echo "<p><a href='../admins/managework.php?page=$page&rank=$rank'>管理作品</a></p>";
			}}
			echo "<a href='../../hexa/hexa.php?page=$page&rank=$rank'>返回</a>";
		?>
			</div>
		</div>
	</div>
	<div id = "rightup">
		<div>
		<h3 style="margin-left:20px; margin-bottom:5px">个人信息</h1>
      <table id = "tab" border = "0">
	        <tbody>
	        	<tr height = "30px"  align = 'center'>
	                <th width = '150px' align = 'center' style="color:#6699ff">用户名:</th>
	                <?php
	                	echo "<th width = '300px' align = 'center'>".$content["username"]."</th>";
	                ?>
	                <th width = '150px' align = 'center' style="color:#6699ff">注册时间:</th>
	                <?php
	                	echo "<th width = '300px' align = 'center'>".$content["regtime"]."</th>";
	                ?>
	            </tr>
	        	<tr height = "30px"  align = 'center'>
	                <th width = '150px' align = 'center' style="color:#6699ff">性别:</th>
	                <?php
	                	echo "<th width = '300px' align = 'center'>".$content["sex"]."</th>";
	                ?>
	                <th width = '150px' align = 'center' style="color:#6699ff">生日:</th>
	                <?php
	                	echo "<th width = '300px' align = 'center'>".$content["birthday"]."</th>";
	                ?>
	            </tr>
	            <tr height = "30px"  align = 'center'>
	            	<th width = '150px' align = 'center' style="color:#6699ff">电话:</th>
	                <?php
	                	echo "<th width = '300px' align = 'center'>".$content["tel"]."</th>";
	                ?>
	                <th width = '150px' align = 'center' style="color:#6699ff">邮箱:</th>
	                <?php
	                	echo "<th width = '300px' align = 'center'>".$content["email"]."</th>";
	                ?>
	            </tr>
	            <tr height = "30px"  align = 'center'>
	            	<th width = '150px' align = 'center' style="color:#6699ff">位置:</th>
	                <?php
	                	echo "<th width = '300px' align = 'center'>".$content["location"]."</th>";
	                ?>
	                <th width = '150px' align = 'center' style="color:#6699ff">状态:</th>
	                <?php
	                	echo "<th width = '300px' align = 'center'>".$content["state"]."</th>";
	                ?>
	            </tr>
	        </tbody>
	   </table>
	        </div>

	</div>
	<div id = "rightdown">
		<h3 style="margin-left:20px; margin-bottom:5px">我的作品</h1>
			<table id = "tab" border = "0" style="margin-left:50px">
	        <thead id = "headd">
	            <tr height = "40px"  align = 'center'>
	                <th width = '150px' align = 'center' style="color:#6699ff; font-size:20px">作品名称</th>
	                <th width = '150px' align = 'center' style="color:#6699ff; font-size:20px">形式</th>
	                <th width = '150px' align = 'center' style="color:#6699ff; font-size:20px">作者</th>
	                <th width = '150px' align = 'center' style="color:#6699ff; font-size:20px">最新章节</th>
	            </tr>
	        </thead>
	        <tbody>
      <?php
        //echo "<form method='post' action='management.php?page=$page&rank=$rank'>"
        $query = "SELECT * FROM workinfo";
        $stmt = $db->prepare($query);
        $exe = $stmt->execute();
        $content = $stmt->fetch();
        while($content){
        	$workID = $content["workID"];
        	$workname = $content["workname"];
        	$form = $content["form"];
        	$authorID = $content["authorID"];

        	$query1 = "SELECT username FROM userinfo WHERE userID = :authorID";
        	$stmt1 = $db->prepare($query1);
        	$exe1 = $stmt1->execute(array(":authorID"=>$authorID));
        	$content1=$stmt1->fetch();

        	$author = $content1["username"];
        	if($_GET["userID"]){
        	if($authorID !== $userID){
        		$content = $stmt->fetch();
        		continue;
        	}
        	} else {
        		if($author !== $_SESSION["a"]){
        		$content = $stmt->fetch();
        		continue;
        	}
        	}
        	$latest = $content["newestchp"];

        	echo "<tr height = '30px'>
	          <td width = '150px' align = 'center'>$workname</td>
	          <td width = '150px' align = 'center'>$form</td>
	          <td width = '150px' align = 'center'>$author</td>
	          <td width = '150px' align = 'center'>$latest</td>
	      	</tr>";
	      	$content = $stmt->fetch();
	    }
	    //echo "<p style='color:white;font-family:fantasy; text-decoration:none;'><a href='../personalpage.php?page=$page&rank=$rank'>back</a></p>";
      ?>
  </tbody>
</table>
	</div>
</body>
</html>
