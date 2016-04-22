<?php 
if(session_id() == ''){
	session_start();
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="<?php echo base_url();?>jquery-1.12.0.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style.css">
<link rel="stylesheet" href="<?php echo base_url();?>jquery-ui.min.css">
<script src="<?php echo base_url();?>jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>jquerysearchmutual.js"></script>
<script src="<?php echo base_url();?>jquerydropdown.js"></script>
<script src="<?php echo base_url();?>jqueryregisterslider.js"></script>

<title>Datadateorsomething</title>
</head>
<body>
<div class="content">
<div class="contentWrapper">
	
	<div class="matchesWrapper">
	<form name='matchForm0' method="post" action="userDetail">
	<input type='hidden' name="id" value="0">
	<div class="match" id='0' onClick="document.forms['matchForm0'].submit()"> No more results!</div>
	</form>
	<form name='matchForm1' method="post" action="userDetail">
	<input type='hidden' name="id" value="1">
	<div class="match" id='1' onClick="document.forms['matchForm1'].submit()"> No more results!</div>
	</form>
	<form name='matchForm2' method="post" action="userDetail">
	<input type='hidden' name="id" value="2">
	<div class="match" id='2' onClick="document.forms['matchForm2'].submit()"> No more results!</div>
	</form>
	<form name='matchForm3' method="post" action="userDetail">
	<input type='hidden' name="id" value="3">
	<div class="match" id='3' onClick="document.forms['matchForm3'].submit()"> No more results!</div>
	</form>
	<form name='matchForm4' method="post" action="userDetail">
	<input type='hidden' name="id" value="4">
	<div class="match" id='4' onClick="document.forms['matchForm4'].submit()"> No more results!</div>
	</form>
	<form name='matchForm5' method="post" action="userDetail">
	<input type='hidden' name="id" value="5">
	<div class="match" id='5' onClick="document.forms['matchForm5'].submit()"> No more results!</div>
	</form>
	</div>
	
	<div class='zomaar'>hoi</div>
	</div>
</div>
</body>
</html>