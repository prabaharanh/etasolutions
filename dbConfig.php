<?php
define ("DB_HOST", "localhost"); 
define ("DB_USER", "root"); 
define ("DB_PASS",""); 
define ("DB_NAME","dbeta"); 

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysqli_select_db($link, DB_NAME) or die("Couldn't select database");
?>