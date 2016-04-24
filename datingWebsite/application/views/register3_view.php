<script src="<?php echo base_url();?>jqueryregisterslider.js"></script>
<div class="content">

	<?php
	if($error['error']){
		$string = strip_tags($error['errortext']);
		echo '<p class="error">'.$string.'</p>';
	}
	$type = "(";
	echo "You are ";
	if($personality['ei'] < 49){
		echo "Extraversion ";
		$type .= "E";
	}
	else {
		echo "Introversion ";
		$type .= "I";
	}
	if($personality['ns'] < 49){
		echo "Intuition  ";
		$type .= "N";
	}
	else {
		echo "Sensing ";
		$type .= "S";
	}
	if($personality['tf'] < 49){
		echo "Thinking ";
		$type .= "T";
	}
	else {
		echo "Feeling ";
		$type .= "F";
	}
	if($personality['jp'] < 49){
		echo "Judging ";
		$type .= "J";
	}
	else {
		echo "Perceiving ";
		$type .= "P";
	}
	$type .= ").";
	echo $type;
	?>
	
	<br>
	<a target="_blank" href='https://en.wikipedia.org/wiki/Myers%E2%80%93Briggs_Type_Indicator' class="normal">More information can be found here.</a>
	<br>
	What personality type are you looking for?
	<?php echo form_open_multipart('register/thirdStep');?>
	
		<div class="registerForm">
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
			
			Upload a profile picture!
			<input type="file" name="userfile" accept=".gif,.jpg,.png">
			<br><br>
			
			<input type="submit" value="CREATE!">
		</div>
		<?php echo form_close();?>
</div>

