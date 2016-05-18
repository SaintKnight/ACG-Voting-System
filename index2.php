<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

include('configuration.php');
$test = "asdfasdf";
$stmt = $db->prepare("SELECT * FROM test");
$stmt->execute();
$result = $stmt->fetch();
var_dump($result);
$result = $stmt->fetch();
var_dump($result);
echo exec('whoami');
phpinfo();
?>