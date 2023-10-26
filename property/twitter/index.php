<?php
// require codebird
require_once('./codebird-php-develop/src/codebird.php');
?>

<form method="post">

	Tweet Text: <input type="text" name="tweet">
	<input type="submit" value="Submit" name="submit">
</form>

<!-- <a href="http://twitter.com/share?text=Im Sharing on Twitter&url=https://www.youtube.com/watch?v=rl4YMyruYOQ&hashtags=aonestudies,anayapunj,amitpunj">Share on twitter</a>
 -->

<?php 
if(isset($_POST['submit']))
{
	$tweetMessage = $_POST['tweet'];
	//echo $tweetMessage;die("amitsharma");

  Codebird\Codebird::setConsumerKey('o2kxxK00NwMDTnnxtATozHUam', 'Cyfi1UkjRDlZu99SXB4HmiGclcAFEgUirm0M0gXddzEH7sywMG'
  );
  $cb = \Codebird\Codebird::getInstance();
  $cb->setToken('971072905273577473-qBq76ImJyXLGZ2QsdchndCXFz4too27', 'QnvjBTllbdwT96yxI5ZfZrEwubKk9Xd1FXHbcq3pymiOq');
   
   // post single tweet
  $params = array(
    'status' => 'Auto Post on Twitter with PHP http://goo.gl/OZHaQD #php #twitter'
  );
  $amit = $cb->statuses_update([
  	'status' => $tweetMessage
  ]);
  echo "<pre>";
  print_r($amit);//die('test');
}


//Post image with tweet

//  Codebird\Codebird::setConsumerKey('o2kxxK00NwMDTnnxtATozHUam', 'Cyfi1UkjRDlZu99SXB4HmiGclcAFEgUirm0M0gXddzEH7sywMG'
//   );
//   $cb = \Codebird\Codebird::getInstance();
//   $cb->setToken('971072905273577473-qBq76ImJyXLGZ2QsdchndCXFz4too27', 'QnvjBTllbdwT96yxI5ZfZrEwubKk9Xd1FXHbcq3pymiOq');

// $params = array(
//   // 'status' => 'Auto Post on Twitter with PHP http://goo.gl/OZHaQD #php #twitter',
//   'status' => 'Jobs in Delhi.. https://www.youtube.com/watch?v=rl4YMyruYOQ',
//   'media[]' => './codebird-php-develop/src/download (4).jpeg',
// );
// $mediaUpload = $cb->statuses_updateWithMedia($params);
// echo "<pre>";
// print_r($mediaUpload);
// die('ggggggggg');


// post restricted text
// $tweetMessage = 'This is a tweet to my Twitter account via PHP.';

// // Check for 140 characters
// if(strlen($tweetMessage) <= 140)
// {
//     // Post the status message
//     $cb->statuses_update([
//     	'status' => $tweetMessage
//     ]);
// }


?>
