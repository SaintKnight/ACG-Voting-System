<?php
session_start();
$value = "bla";
$_SESSION["newsession"]=$value;
var_dump($_SESSION);
//unset($_SESSION["newsession"]);
?>