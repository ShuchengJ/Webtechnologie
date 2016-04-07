

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
		<a href="/datingWebsite/index.php/login"><span>Login</span></a>
	</div>
</div>

<div class="content">
	<form method="post" action="form3.php">
		<label for='firstname' class='labelname'>First name:</label> 
		<label for='lastname'>Last name:</label>
		<br>
		<input type='text' name='firstname' id='firstname' maxlength="50" />
		<input type='text' name='lastname' id='lastname' maxlength="50" />
		<br>
		<label for='email'>Email address:</label>
		<br>
		<input type='email' name='email' id='email' maxlength="100" />
		<br>
		<input type="submit" value="Go To Step 2">
	</form>
	<?php 
	echo $this->session->userdata('logged_in');
	?>
</div>
</body>
</html>