<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
	<meta author = "">
	<title>login</title>
  <link type="text/css" rel="stylesheet" href="./loginreg.css" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
  <div class="outer">
<div class="middle">
<div class="inner">
	<section class="container three">
    <div class="login">
      <h1>登录</h1>
      <?php
      $page = $_GET["page"];
      $rank = $_GET["rank"];
        echo "<form method='post' action='handler.php?page=$page&rank=$rank'>"
      ?>
        <p><input type="text" name="login" value="" placeholder="Username" /></p>
        <p><input type="password" name="password" value="" placeholder="Password" /></p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
      <?php
      echo "<p><a href='../hexa/hexa.php?page=$page&rank=$rank'>返回</a></p>";
      ?>
    </div>
  </section>
</div>
</div>
</div>
</body>
</html>