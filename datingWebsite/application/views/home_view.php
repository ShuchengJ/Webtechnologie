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
<div class="content">
<div class="contentWrapper">
	<div class="searchArea">
	<form id="search" method="post" action="home/search">
	<fieldset class="searchfs">
	<legend class="searchlegend">Gender</legend>
	<input type="radio" name="gender" value="Man" required/> male
	<input type="radio" name="gender" value="Woman"/> female 
	<input type="radio" name="gender" value="Both" checked/> any<br>
	
	</fieldset>
	
	<fieldset class="searchfs">
	<legend class="searchlegend">Age</legend>
	<input type="text" id="age" name="age" readonly>
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
	</div>
</div>
</body>
</html>