<?php
$userID = $_POST["userID"];
$name = $_POST["name"];  

?>
<html> 
	<style> 
	</style> 
	<body>

		<div class = "event_form"> 
			<form action = "addevent.php" method = "post">
				<tr><td>Name</td><td><input type = "text" name ="event_name"></td></tr>
				<tr><td>Description</td><td><input type = "text" name ="event_description"></td></tr>
				<tr><td>Date</td><td><input type = "date" name ="event_date"/></td></tr>
				<tr><td>Time</td><td><input type = "time" name ="event_time"/></td></tr>
				<tr><td>Location</td><td><input type = "text" name ="event_location"/></td></tr>
				<tr><td>Host</td><td><input type = "text" name ="event_host"/></td></tr>


	</body> 