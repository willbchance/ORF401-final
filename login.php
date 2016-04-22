<?php

$email = $_POST["email"];
$password = $_POST["password"];

if(!$email || !$password){
	echo "<html>"; 
	echo "<title> Empty Fields </title>"; 
	echo '<body>'; 
	echo "You left one or more of the fields blank. Please fill out all required fields. Redirecting you back."; 
	echo '<meta http-equiv="refresh" content="3; url=homepage.html">'; 
	echo '</body>'; 
	echo '</html>'; 
}
else {
	include("readDb.php"); 
	
}