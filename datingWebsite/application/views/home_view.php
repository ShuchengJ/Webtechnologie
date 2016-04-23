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
<script src="<?php echo base_url();?>jquerysearch.js"></script>
<script src="<?php echo base_url();?>jquerydropdown.js"></script>
<script src="<?php echo base_url();?>jqueryregisterslider.js"></script>

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
	<input type="text" id="age" name="age" value="18 - 25" readonly>
	<div id="slider-range"></div>
	</fieldset>
  	
  	<fieldset class="searchfs">
  	<legend class="searchlegend">Brands</legend>
  	<dl class="dropdown"> 
    		<dt>
    		<a href="#">
      			<span id="span" class="showtext">Select here</span>   
    		</a>
    		</dt>
    		<dd>
        		<div class="listofbrands">
           			<ul>
               			<?php
           				$file = fopen(FCPATH.'brands.txt','r');
           				while ($line = fgets($file)) {
           				  echo("<li><input type=\"checkbox\" value=".$line.">"."$line"."</li>");
           				}
           				fclose($file);
           				?>
           			</ul>
        		</div>
    		</dd>
		</dl>
		<input id="brands" type="hidden" name="brands" value="" />
	</fieldset>
	
	<fieldset class="searchfs">
	<legend class="searchlegend">Personalty types</legend>
		<div class="sliderPerso" id="sliderEI"></div>
		<div class="left">Extrovert <input type="text" class="smallbox" id="PersonEI" name="PersonEI" value="100" readonly checked></div> 
		<div class="right">Introvert <input type="text" class="smallbox" id="PersonI" name="PersonI" value="0" readonly> </div>
		<br><br>
		<div class="sliderPerso" id="sliderNS"></div>
		<div class="left">Intuitive <input type="text" class="smallbox" id="PersonNS" name="PersonNS" value="100" readonly checked></div> 
		<div class="right">Sensing <input type="text" class="smallbox" id="PersonS" name="PersonS" value="0" readonly> </div>
		<br><br>
		<div class="sliderPerso" id="sliderFT"></div>
		<div class="left">Thinking <input type="text" class="smallbox" id="PersonFT" name="PersonFT" value="100" readonly checked></div> 
		<div class="right">Feeling <input type="text" class="smallbox" id="PersonF" name="PersonF" value="0" readonly> </div>
		<br><br>
		<div class="sliderPerso" id="sliderJP"></div>
		<div class="left">Judging <input type="text" class="smallbox" id="PersonJP" name="PersonJP" value="100" readonly checked></div> 
		<div class="right">Perceiving <input type="text" class="smallbox" id="PersonP" name="PersonP" value="0" readonly> </div>
		<br><br>
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
	
	<div class='zomaar'></div>
	</div>
</div>
</body>
</html>