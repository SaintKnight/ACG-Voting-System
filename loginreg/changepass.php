<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta author = "">
	<title>changepass</title>
  <link type="text/css" rel="stylesheet" href="./loginreg.css" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
  <div class="outer">
<div class="middle">
<div class="inner">
	<section class="container three">
    <div class="login">
      <h1>修改密码</h1>
      <?php
      $page = $_GET["page"];
      $rank = $_GET["rank"];
        echo "<form method='post' action='handler.php?page=$page&rank=$rank'>"
      ?>
        <p><input type="password" name="old" value="" placeholder="Old Password" /></p>
        <p><input type="password" name="new" value="" placeholder="New Password" /></p>
        <p><input type="password" name="confirm" value="" placeholder="New Password Confirm" /></p>
        <p class="submit"><input type="submit" name="commit" value="Change"></p>
      </form>
      <?php
      echo "<p><a href='./personal/personalpage.php?page=$page&rank=$rank'>返回</a></p>";
      ?>
    </div>
  </section>
</div>
</div>
</div>
</body>
</html>