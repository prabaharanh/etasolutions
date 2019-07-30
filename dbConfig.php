<?php
define ("DB_HOST", "etasolutions.mysql.database.azure.com"); 
define ("DB_USER", "eta@etasolutions"); 
define ("DB_PASS","Radhah@5969"); 
define ("DB_NAME","dbeta"); 

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make a test  connection.");
$db = mysqli_select_db($link, DB_NAME) or die("Couldn't select database");
?>