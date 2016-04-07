<?php 
if(session_id() == ''){
	session_start();
}
?>


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
		if(!$loggedin){
		echo '<a href="/datingWebsite/index.php/login"><span>Login</span></a>';
		echo '<a href="/datingWebsite/index.php/register"><span>Register</span></a>';
		}else{
		echo '<a href="/datingWebsite/index.php/home/logout">Logout</a>';
		}
		?>
	</div>
</div>

<div class="content">
	<div class="searchArea">
	<form>
	<fieldset class="searchfs">
	<legend class="searchlegend">Gender</legend>
	<input type="checkbox" name="male"/> male
	<input type="checkbox" name="female"/> female <br>
	</fieldset>
	
	<fieldset class="searchfs">
	<legend class="searchlegend">Age</legend>
	<input type="text" id="age" readonly>
	<div id="slider-range"></div>
	</fieldset>
	
	<fieldset class="searchfs">
	<legend class="searchlegend">Personalty types</legend>
	<div class="personalityBoxes">
		<input type="radio" name="PersonEI" value="Extrovert" checked> Extrovert <br>
		<input type="radio" name="PersonNS" value="Intuitive" checked> Intuitive <br>
		<input type="radio" name="PersonFT" value="Thinking" checked> Thinking <br>
  		<input type="radio" name="PersonJP" value="Judging" checked> Judging  	<br>
  	</div>
  	<div class="personalityBoxes">
  		<input type="radio" name="PersonEI" value="Introvert"> Introvert<br>
  		<input type="radio" name="PersonNS" value="Sensing"> Sensing<br>
  		<input type="radio" name="PersonFT" value="Feeling"> Feeling<br>
  		<input type="radio" name="PersonJP" value="Perceiving"> Perceiving<br>
  	</div>
  	</fieldset>
  	
  	<fieldset class="searchfs">
  	<legend class="searchlegend">brands</legend>
  	<input type="checkbox" name="merk1"/> Coca-cola <br>
	<input type="checkbox" name="merk2"/> Pepsi <br>
	</fieldset>
	
	
	 <input type="submit" value="Search">
	</form>
	</div>
	<div>
	<?php
	if($loggedin){
	echo '<h3>DIT IS EEN APPELTJE</h3>';
	}else{
	echo '<h3>AARDAPPEL!</h3>';
	}
	?>
	</div>
</div>
</body>
</html>