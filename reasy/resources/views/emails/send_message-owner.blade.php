<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
Hi, <?php echo $username; ?><br>

<p><strong><?php echo $tenant_name; ?></strong> send you message.</p>

<p><strong>Tenant Name</strong>: <?php echo $tenant_name; ?></p>
<p><strong>Tenant Email</strong>: <?php echo $tenant_email; ?></p>
<p><strong>Tenant Phone No</strong>: <?php echo $tenant_phone; ?></p>
<p><strong>Tenant Message</strong>: <?php echo $message_data; ?></p>
<p>
	<span><a href="{{url('messenger?uid='.$unit_id.'&tid='.$tenant_id)}}">Reply</a></span>
</p>
<br>

<p>Regards,<br>
Reasy Property
</p>
</body>
</html>


 