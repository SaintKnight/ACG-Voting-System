<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta autdor = "">
	<title>personal info</title>
  <link type="text/css" rel="stylesheet" href="../loginreg.css" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
  <div class="outer">
<div class="middle">
<div class="inner">
	<section class="container three">
    <div class="login">
    	<h1>更改个人信息</h1>
      <?php
      $page = $_GET["page"];
      $rank = $_GET["rank"];
      include ("../../configuration.php");
      echo "<form metdod = 'get' action='./managepersonal.php?page=$page&rank=$rank' enctype='multipart/form-data'>
      		<table>
      		<tr height = '40px' style = 'color:#6699ff; font-size:20px'>
      			<td width = '100px' align = 'center'>性别:</td>
      			<td width = '200px' align = 'center' style = 'color:white'><input type='radio' name = 'sex' value = 'Male'>男 
      			<input type='radio' name = 'sex' value = 'Female'>女</td></tr>
      		<tr height = '40px' style = 'color:#6699ff; font-size:20px'>
      			<td width = '100px' align = 'center'>生日: </td>
      			<td width = '200px' align = 'center'><input type = 'date' name = 'birthday' value ='' placeholder = 'Birtdday'></td></tr>
      		<tr height = '40px' style = 'color:#6699ff; font-size:20px'>
      			<td width = '100px' align = 'center'>电话: </td>
      			<td width = '200px' align = 'center'><input type = 'tel' name = 'tel' value ='' placeholder = 'Telephone'></td></tr>
      		<tr height = '40px' style = 'color:#6699ff; font-size:20px'>
      			<td width = '100px' align = 'center'>邮件: </td>
      			<td width = '200px' align = 'center'><input type = 'email' name = 'email' value ='' placeholder = 'Email'></td></tr>
      		<tr height = '40px' style = 'color:#6699ff; font-size:20px'>
      			<td width = '100px' align = 'center'>位置: </td>
      			<td width = '200px' align = 'center'><input type = 'text' name = 'location' value ='' placeholder = 'location'></td></tr>
      			</table>
      		<input type='submit' name = 'submit' value = 'submit'></td>
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