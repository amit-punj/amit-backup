<?php
session_start();

header('Access-Control-Allow-Origin: *', false);
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


require 'autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'o2kxxK00NwMDTnnxtATozHUam'); 	
define('CONSUMER_SECRET', 'Cyfi1UkjRDlZu99SXB4HmiGclcAFEgUirm0M0gXddzEH7sywMG'); 
define('OAUTH_CALLBACK', 'http://visionvivante.com/twitter/Twitter-API-Login-PHP-master/twitterShare.php'); // your app callback URL
if(!isset($_REQUEST['oauth_token']) && !isset($_REQUEST['oauth_verifier']))
{
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	// $_SESSION['access_token'] = $request_token['oauth_token'];
	// echo "string<br>";
	// echo $url;
	// echo "<a href='$url'><img src='twitter-login-blue.png' style='margin-left:4%; margin-top: 4%'></a>";
	echo json_encode(['status'=>true,'data'=>$url,'oauth_token_secret' => $request_token['oauth_token_secret']]);
} 
else if(isset($_REQUEST['oauth_token']) && isset($_REQUEST['oauth_verifier']))
{
	$image_url 	= ($_REQUEST['image_url']) ? $_REQUEST['image_url'] : 'twitter-login-blue.png' ;
	$page_url 	= ($_REQUEST['page_url']) ? $_REQUEST['page_url'] : 'http://192.168.1.16/amit_data/property/public/create-property' ;
	$request_token = [];
	$request_token['oauth_token'] = $_SESSION['oauth_token'];
	$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
	$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));

	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	
	// getting basic user info
	$user = $connection->get("account/verify_credentials");
	
	// printing username on screen
	echo "Welcome " . $user->screen_name;
	// uploading media (image) and getting media_id
	$tweetWM = $connection->upload('media/upload', ['media' => $image_url]);
	echo "<pre>";
	print_r($tweetWM);
	// die('fffddddddddddddd');

	// tweeting with uploaded media (image) using media_id
	$tweet = $connection->post('statuses/update', ['media_ids' => $tweetWM->media_id, 'status' => $page_url]);
	echo "<pre>";
	print_r($tweet);
	die('ffffffffffffff');
}