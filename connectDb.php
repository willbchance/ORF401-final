<?php
$dbhost = "localhost";
$dbuser = "wchance_wchance";     // CHANGE IT TO YOUR DATABASE USER NAME
$dbpass = "guestlist";            // CHANGE IT TO YOUR DATABASE PASSWORD
$dbname = "wchance_events";     // CHANGE IT TO YOUR DATABASE NAME

$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(!$conn) {
  die('Error connecting to mysql');
}
mysql_select_db($dbname); 


?>