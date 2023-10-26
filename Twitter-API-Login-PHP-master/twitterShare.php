<a href="http://twitter.com/share?text=Im Sharing on Twitter&url=https://safetyengagement.com/bids/select_job/53&hashtags=stackoverflow,example,youssefusf">test</a>


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
define('OAUTH_CALLBACK', 'http://localhost/amit_data/Twitter-API-Login-PHP-master/twitterShare.php'); // your app callback URL
if(!isset($_REQUEST['oauth_token']) && !isset($_REQUEST['oauth_verifier']))
{
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	// $_SESSION['access_token'] = $request_token['oauth_token'];
	echo "string<br>";
	echo $url;
	echo "<a href='$url'><img src='twitter-login-blue.png' style='margin-left:4%; margin-top: 4%'></a>";
} 
else if(isset($_REQUEST['oauth_token']) && isset($_REQUEST['oauth_verifier']))
{
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
	$tweetWM = $connection->upload('media/upload', ['media' => 'twitter-login-blue.png']);
	echo "<pre>";
	print_r($tweetWM);
	// die('ffffffffffffff');



	// tweeting with uploaded media (image) using media_id
	$tweet = $connection->post('statuses/update', ['media_ids' => $tweetWM->media_id, 'status' => 'tweeting with image file']);
	echo "<pre>";
	print_r($tweet);
	die('ffffffffffffff');
}