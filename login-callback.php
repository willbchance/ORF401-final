<?php
session_start(); 
require_once __DIR__ . '/Facebook/autoload.php';

# login-callback.php
$app_id        = "1683348741918165";   
$app_secret    = "dbf1bb07b715fba944c3b5981716a1d0";   
$site_url    = "www.wchance.mycpanel2.princeton.edu/ORF401/final";
  
$fb = new Facebook\Facebook([   
    'app_id'        => $app_id,   
    'app_secret'    => $app_secret,  
    'default_graph_version' => 'v2.5', 
    ]);  

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;

  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}

  //***********************************************************//
 // Now, using the access token, we have access to user info. //
//***********************************************************//

$fb->setDefaultAccessToken($accessToken);

try {
  $response = $fb->get('/me');
  $userNode = $response->getGraphUser();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

//echo 'Logged into Facebook as ' . $userNode->getName();


//***********************************************************//
// Check whether the given user ID exists within our database
// if not, redirect them to the signup page and display a 
// message. If they are in the DB, send them to their member 
// page. 
//***********************************************************//


$userID = $userNode->getID();
$userfname = $userNode->getName(); 
$userlname = $userNode->getLastName(); 

include("connectDb.php"); 



$sql_member_query = "SELECT * FROM Userinfo WHERE Facebook_ID = '$userID'"; 
$sql_member_query_result = mysql_query($sql_member_query); 

if (!$sql_member_query_result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}

if(!$sql_member_query_result) {
  $sql = "INSERT INTO Userinfo (Facebook_ID, fName) VALUES ('$userID', '$userfname')";
  $result = mysql_query($sql); 
  header("Refresh:5; url=member.php");
  echo "We noticed you havent signed up for GuestList yet, dont worry, we've created an account for you. "; 
  echo "Redirecting you to your new GuestList account now, $userfname!";
  echo "<html>"; 
  echo "<form class = 'sendData' action = 'member.php' method = 'post'>"; 
  echo "<td><input type='hidden' name='userID' value = $userID></td>";
  echo "<td><input type='hidden' name='name' value = $userfname></td></form>";
  echo "</html>"; 
}
else {
header("Refresh:5; url=member.php");
echo "<html>"; 
echo "Welcome back $userfname, redirecting you now.";
echo "<form class = 'sendData2' action = 'member.php' method = 'post'>"; 
echo "<td><input type='hidden' name='userID' value = $userID></td>";
echo "<td><input type='hidden' name='name' value = $userfname></td></form>";
echo "</html>"; 
}


?>