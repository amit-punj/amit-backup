<!DOCTYPE html>
<html >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=charset" />
		<title>title</title>
	</head>
	<body  marginwidth="0" topmargin="0" marginheight="0" offset="0">
		<div id="wrapper" dir="rt">
			<table>	
				<tr>
					<td>					
						<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container">
							<tr>
								<td align="center" valign="top">
									<!-- Header -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_header">
										<tr>
											<td id="header_wrapper">
												<div class="header" style="overflow: hidden;background-color: #f1f1f1; padding: 20px 10px;">
												  	<img src="{{ $logo }}" style="float: left;color: black;text-align: center;text-decoration: none;font-size: 18px; line-height: 25px;border-radius: 4px;width: 100px;height: 50px">
													<div class="header-right" style="float: right;">
													    <span>{{$username}}</span><br>
													</div>
												</div>
												<header style="background-color: #85be39;padding: 10px;text-align: left;font-size: 20px;color: white;">
												  <h2 style="margin:0;padding: 0;">Issue Report</h2>
												</header>
											</td>
										</tr>
									</table>
									<!-- End Header -->
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<!-- Body -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body">
										<tr>
											<td valign="top" id="body_content">
												<!-- Content -->
												<table border="0" cellpadding="20" cellspacing="0" width="100%">
													<tr>
														<td valign="top">
															<div id="body_content_inner">
																<h1>Hello {{ $username }},</h1>
																<p>Thank you for taking the time to report issues on <strong>“{{  $title }}” </strong> with <strong>“{{ $reason }}”</strong>. We will address this issue as soon as we can. </p>
																<p>You can check the status of this issue here:<br>
																<a href="{{ $url }}"> {{ $url }} </a>
																<p>
																Have a great day!  <br>
																The Manga Rock team.
																</p>
															</div>
														</td>
													</tr>
												</table>
												<!-- End Content -->
											</td>
										</tr>
									</table>
									<!-- End Body -->
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<div class="header" style="overflow: hidden;background-color: #f1f1f1;text-align: center;color: #000000; padding: 20px 10px;">
									  	{{ $title }}
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
