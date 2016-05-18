<?php
session_start();
$page = $_GET["page"];
$rank = $_GET["rank"];
unset($_SESSION["a"]);
echo "<script>window.location = '../hexa/hexa.php?page=$page&rank=$rank'</script>";
exit;
?>