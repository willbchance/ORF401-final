<?php
session_start(); 
require_once __DIR__ . '/Facebook/autoload.php';

$app_id        = "1683348741918165";   
$app_secret    = "dbf1bb07b715fba944c3b5981716a1d0";   
$site_url    = "www.wchance.mycpanel2.princeton.edu/ORF401/final";
  
$fb = new Facebook\Facebook([   
    'app_id'        => $app_id,   
    'app_secret'    => $app_secret,  
    'default_graph_version' => 'v2.5', 
    ]);  

# login.php

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes']; // optional
$loginUrl = $helper->getLoginUrl('http://www.wchance.mycpanel2.princeton.edu/ORF401/final/login-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

?>
