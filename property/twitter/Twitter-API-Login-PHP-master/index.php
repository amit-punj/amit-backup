

<?php
header('Access-Control-Allow-Origin: *', false);
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
	// die('okk');
require 'autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'o2kxxK00NwMDTnnxtATozHUam'); 	
define('CONSUMER_SECRET', 'Cyfi1UkjRDlZu99SXB4HmiGclcAFEgUirm0M0gXddzEH7sywMG'); 
define('OAUTH_CALLBACK', 'http://marvelweb.visionvivante.com/login'); 
//define('oauth_token', '842987337353052160-LL8z2AHxYRP7lHo8iDaq8cLNzeSu8OP');
//define('oauth_token_secret', '6eZZno5qC6d8E5Gtc9jakmhEgvP07F3MfxOBwJ5ysLm8x');
// if (!isset($_SESSION['access_token'])) {

	if(!isset($_REQUEST['oauth_token']) && !isset($_REQUEST['oauth_verifier']))
	{
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
		$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
		echo json_encode(['status'=>true,'data'=>$url,'oauth_token_secret' => $request_token['oauth_token_secret']]);
	}
	else if(isset($_REQUEST['oauth_token']) && isset($_REQUEST['oauth_verifier']))
	{
		$request_token = [];
		$request_token['oauth_token'] = $_REQUEST['oauth_token'];
		$request_token['oauth_token_secret'] = $_REQUEST['oauth_token_secret'];
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
		$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));

		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		$user = $connection->get("account/verify_credentials", ['include_email' => 'true']);
		echo json_encode(['status'=>true,'data'=>$user]);
	}
// } else {
// 	$access_token = $_SESSION['access_token'];
// 	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
// 	$user = $connection->get("account/verify_credentials", ['include_email' => 'true']);
// //    $user1 = $connection->get("https://api.twitter.com/1.1/account/verify_credentials.json", ['include_email' => true]);
//     echo "<img src='$user->profile_image_url'>";echo "<br>";		//profile image twitter link
//     echo $user->name;echo "<br>";									//Full Name
//     echo $user->location;echo "<br>";								//location
//     echo $user->screen_name;echo "<br>";							//username
//     echo $user->created_at;echo "<br>";
// //    echo $user->profile_image_url;echo "<br>";
//     echo $user->email;echo "<br>";									//Email, note you need to check permission on Twitter App Dashboard and it will take max 24 hours to use email 
//     echo "<pre>";
//     print_r($user);
//     echo "<pre>";
//     die('gggg');								//These are the sets of data you will be getting from Twitter 												Database 
// }