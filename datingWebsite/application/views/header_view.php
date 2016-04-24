<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="<?php echo base_url();?>jquery-1.12.0.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style.css">
<link rel="stylesheet" href="<?php echo base_url();?>jquery-ui.min.css">
<script src="<?php echo base_url();?>jquery-ui.min.js"></script>

<title>DateDate</title>
</head>
<body>
<div class="header">
	<a href="<?php echo base_url();?>index.php/home" class="home" >DateDate</a>
	<div class="menu"> 
	<?php 
		echo '<a href="'.base_url().'index.php/home"><span>Home</span></a>';
		if(!$loggedin){
		echo '<a href="'.base_url().'index.php/login"><span>Login</span></a>';
		echo '<a href="'.base_url().'index.php/register"><span>Register</span></a>';
		}else{
		echo '<a href="'.base_url().'index.php/profile">Profile</a>';
		echo '<a href="'.base_url().'index.php/like"><span>Like</span></a>';
		echo '<a href="'.base_url().'index.php/likedby"><span>LikedBy</span></a>';
		echo '<a href="'.base_url().'index.php/mutual"><span>Mutual</span></a>';
		echo '<a href="'.base_url().'index.php/home/logout">Logout</a>';
		if($admin)
			echo '<a href="'.base_url().'index.php/configuration">Config</a>';
		
		echo $email;
		}
	?>
	</div>
</div>
</body>
</html>