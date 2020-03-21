<?php
// Debug info
if ($debug){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

// Session
ini_set('session.gc_maxlifetime', 31536000); # 1 Year
session_set_cookie_params(31536000);
ob_start();
session_start();

// Monetary
setlocale(LC_MONETARY, 'en_US.UTF-8');

$link = mysqli_connect($dbhost,$dbuser,$dbpasswd,$dbname); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
}
?>
