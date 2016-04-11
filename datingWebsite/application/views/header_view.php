<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="/datingWebsite/jquery-1.12.0.js"></script>
<link rel="stylesheet" type="text/css" href="/datingWebsite/style.css">
<link rel="stylesheet" href="/datingWebsite/jquery-ui.min.css">
<script src="/datingWebsite/jquery-ui.min.js"></script>
<script src="/datingWebsite/jquerysearch.js"></script>

<title>Datadateorsomething</title>
</head>
<body>
<div class="header">
	<a href="/datingWebsite/index.php/home" class="home" >WebsiteName</a>
	<div class="menu"> 
	<?php 
		echo '<a href="/datingWebsite/index.php/home"><span>Home</span></a>';
		if(!$loggedin){
		echo '<a href="/datingWebsite/index.php/login"><span>Login</span></a>';
		echo '<a href="/datingWebsite/index.php/register"><span>Register</span></a>';
		}else{
		echo '<a href="/datingWebsite/index.php/profile">profile</a>';
		echo '<a href="/datingWebsite/index.php/home/logout">Logout</a>';
		echo $email;
		}
	?>
	</div>
</div>
</body>
</html>