

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="jquery-1.12.0.js"></script>
<link rel="stylesheet" type="text/css" href="../style.css">
<link rel="stylesheet" href="jquery-ui.min.css">
<script src="jquery-ui.min.js"></script>
<script src="jquerysearch.js"></script>

<title>Datadateorsomething</title>
</head>
<body>
<div class="header">
	<div class="menu">
		<a href="login"><span>log in!</span></a>
		<a href="register"><span>Register!</span></a>
	</div>
</div>

<div class="content">
	<form method="post" action="form3.php">
		<input type="text" name="membership_type" value="Free">
		<input type="text" name="membership_type" value="Normal">
		<input type="submit" value="Go To Step 2">
	</form>
	<?php 
	echo $this->session->userdata('logged_in');
	?>
</div>
</body>
</html>