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
	<section class="container" class = "eight">
    <div class="login">
      <h1>作品管理</h1>
      <table id = "tab" border = "0">
	        <thead id = "headd">
	            <tr height = "40px"  align = 'center'>
	            	<th width = '150px' align = 'center'>作品ID</th>
	                <th width = '150px' align = 'center'>作品名</th>
	                <th width = '150px' align = 'center'>形式</th>
	                <th width = '150px' align = 'center'>作者</th>
	                <th width = '150px' align = 'center'>最新章节</th>
	                <th width = '150px' align = 'center'>删除最新章节</th>
	                <th width = '150px' align = 'center'>删除作品</th>
	            </tr>
	        </thead>
	        <tbody>
      <?php
      $page = $_GET["page"];
      $rank = $_GET["rank"];
      include ("../../configuration.php");
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
        	$latest = $content["newestchp"];

        	echo "<tr height = '30px'>
			  <td width = '150px' align = 'center'>$workID</td>
	          <td width = '150px' align = 'center'>$workname</td>
	          <td width = '150px' align = 'center'>$form</td>
	          <td width = '150px' align = 'center'>$author</td>
	          <td width = '150px' align = 'center'>$latest</td>";
	          echo "<form method = 'post' action='management.php?page=$page&rank=$rank'>
	          	<td width = '100px' align = 'center'>
					<input type='hidden' name = 'invi' value = '$workID'>
					<input type='hidden' name = 'page' value = '$page'>
					<input type='hidden' name = 'rank' value = '$rank'>
					<input type='hidden' name = 'latest' value = '$latest'>
					<input type='hidden' name = 'form' value = '$form'>
					<input type='hidden' name = 'authorID' value = '$authorID'>
					<input type='submit' name = 'rmlat' value = 'remove'></td>
	          	<td width = '100px' align = 'center'>
					<input type='hidden' name = 'invi' value = '$workID'>
					<input type='hidden' name = 'page' value = '$page'>
					<input type='hidden' name = 'rank' value = '$rank'>
					<input type='hidden' name = 'authorID' value = '$authorID'>
					<input type='submit' name = 'delete' value = 'delete'></td>
				</form>
	      	</tr>";
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