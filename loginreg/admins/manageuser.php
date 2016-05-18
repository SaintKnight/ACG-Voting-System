<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html>
<head>
	<meta author = "">
	<title>manage user</title>
  <link type="text/css" rel="stylesheet" href="../loginreg.css" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
  <div class="outer">
<div class="middle">
<div class="inner">
	<section class="container">
    <div class="login">
      <h1>用户管理</h1>
      <table id = "tab" border = "0">
	        <thead id="headd">
	            <tr height = "40px"  align = 'center'>
	            	<th>作品名</th>
	                <th>作者</th>
	                <th>状态</th>
	                <th>更改</th>
	            </tr>
	        </thead>
	        <tbody>
      <?php
      $page = $_GET["page"];
      $rank = $_GET["rank"];
      include ("../../configuration.php");
        //echo "<form method='post' action='management.php?page=$page&rank=$rank'>"
        $query = "SELECT * FROM userinfo";
        $stmt = $db->prepare($query);
        $exe = $stmt->execute();
        $content = $stmt->fetch();
        while($content){
        	if(in_array($content["username"], $admins)){
        		$content = $stmt->fetch();
        		continue;
        	}
        	$userID = $content["userID"];
        	$username = $content["username"];
        	$userstate = $content["state"];
        	echo "<tr height = '30px'>
			  <td width = '150px' align = 'center'>$userID</td>
	          <td width = '150px' align = 'center'>$username</td>
	          <td width = '150px' align = 'center'>$userstate</td>";
	  		if($userstate == "active"){
	          	echo "<td width = '150px' align = 'center'>
				<form method = 'post' action='management.php?page=$page&rank=$rank'>
				<input type='hidden' name = 'invi' value = '$userID'>
				<input type='hidden' name = 'page' value = '$page'>
				<input type='hidden' name = 'rank' value = '$rank'>
					<input type='submit' name = 'do' value = 'freeze'>
				</form></td>
	      	</tr>";
	      	} else {
	      		echo "<td width = '150px' align = 'center'>
				<form method = 'post' action='management.php?page=$page&rank=$rank'>
				<input type='hidden' name = 'invi' value = '$userID'>
				<input type='hidden' name = 'page' value = '$page'>
				<input type='hidden' name = 'rank' value = '$rank'>
					<input type='submit' name = 'do' value = 'reactive'>
				</form></td>
	      	</tr>";
	      	}
	      	$content = $stmt->fetch();
	    }
	    //echo "<p style='color:white;font-family:fantasy; text-decoration:none;'><a href='../personalpage.php?page=$page&rank=$rank'>back</a></p>";
      ?>
      <?php
      echo "<p><a href='../personal/personalpage.php?page=$page&rank=$rank'>返回</a></p>";
      ?>
    </div>
  </section>
</div>
</div>
</div>
</body>
</html>