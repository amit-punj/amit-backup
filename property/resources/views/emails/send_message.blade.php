<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
Hi, <?php echo $username; ?><br>

<p>Just to inform, We have sent message to Property Manager "<strong><?php echo $owner_name; ?></strong>" and will update soon.</p>

<p>Your Message: <?php echo $message_data; ?></p>
<p>
	<span><a href="{{url('messenger?uid='.$unit_id.'&tid='.$tenant_id)}}">Reply</a></span>
</p>

<br>

<p>Regards,<br>
Reasy Property
</p>
</body>
</html>


 