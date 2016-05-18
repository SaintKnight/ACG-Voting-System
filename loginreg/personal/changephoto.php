<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
	<meta autdor = "">
	<title>change photo</title>
  <link type="text/css" rel="stylesheet" href="../loginreg.css" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
  <div class="outer">
<div class="middle">
<div class="inner">
	<section class="container three">
    <div class="login">
    	<h1>上传新头像</h1>
      <?php
      include ("../../configuration.php");
      echo "<form method = 'post' action='postphoto.php' enctype='multipart/form-data'>
      		<p><input type = 'file' name = 'photo' id = 'photo'></p>
      		<p><input type='submit' name = 'submit' value = 'upload photo'></p>
      		</form>
      		";
      ?>
      <?php
      echo "<p><a href='./personalpage.php?page=$page&rank=$rank'>返回</a></p>";
      ?>
    </div>
  </section>
</div>
</div>
</div>
</body>
</html>