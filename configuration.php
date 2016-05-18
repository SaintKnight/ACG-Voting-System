<?php
$db_host='localhost';
$db_user='zhuyue';
$db_pass='GinKzhuy1212';
$db_database='hex_test';

$db = new PDO("mysql:dbname=$db_database; host=$db_host", $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$table = 'test';

function delTree($dir) { 
   $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
}

$admins=["admin"];

?>
