<?php
require_once("common.php"); 

 
 if($_COOKIE['xss_user']!=$user && $_COOKIE['xss_pass']!=$pass){
 	
 	header("Location:login.php");
 	exit();
 	
 }

 
 
 ?>