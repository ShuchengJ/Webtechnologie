<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="<?php echo base_url();?>jquery-1.12.0.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style.css">
<link rel="stylesheet" href="<?php echo base_url();?>jquery-ui.min.css">
<script src="<?php echo base_url();?>jquery-ui.min.js"></script>

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