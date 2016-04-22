<?php
$userID = $_POST["userID"];
$name = $_POST["name"]; 
//Link to create new event page
echo "<td><a href='createevent.php'> Create a new event </a></td>": 

//Display a user's upcoming events
echo "<html>"; 
echo "<title> GuestList - " .$name. "'s profile </title>"; 
echo "<div class = upcoming_events>"
echo "<table>"
echo "<th>Name</th>";
echo "<th>Date</th>";
echo "<th>Time</th>";
echo "<th>Location</th>";
echo "<th>Host</th>";

//Fill the table
include("connectDb.php"); 

echo "<form class = 'sendData' action = 'member.php' method = 'post'>"; 
echo "<td><input type='hidden' name='userID' value = $userID></td>";
echo "<td><input type='hidden' name='name' value = $userfname></td></form>";

?>