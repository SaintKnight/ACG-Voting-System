<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html>
<head>
	<meta author = "">
	<title>register</title>
  <link type="text/css" rel="stylesheet" href="./loginreg.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <script src="register.js"></script>
</head>

<body>
    <div class="outer">
<div class="middle">
<div class="inner">
	<section class="container three">
    <div class="register">
      <h1>注册</h1>
      <?php
      $page = $_GET["page"];
      $rank = $_GET["rank"];
      echo "<form method='post' action='handler.php?page=$page&rank=$rank'>";
      ?>
        <p><input type="text" name="register" value="" placeholder="Username"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p><input type="password" name="password confirmation" value="" placeholder="Password Confirm"></p>
        <p><input type="checkbox" name="agreement" id="agreement" onchange="document.getElementById('submit').disabled = !this.checked;" />我已阅读并同意协议</p>
        <p><input type="submit" id = "submit" name="commit" value="Register" ></p>
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