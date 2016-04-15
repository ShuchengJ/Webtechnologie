<div class="content">

	<?php
	$type = "(";
	echo "You are ";
	if($ei < 49){
		echo "Extraversion ";
		$type .= "E";
	}
	else {
		echo "Introversion ";
		$type .= "I";
	}
	if($ns < 49){
		echo "Intuition  ";
		$type .= "N";
	}
	else {
		echo "Sensing ";
		$type .= "S";
	}
	if($tf < 49){
		echo "Thinking ";
		$type .= "T";
	}
	else {
		echo "Feeling ";
		$type .= "F";
	}
	if($jp < 49){
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
	<form method="post" action="register/thirdStep">
		
		<div class="personalityBoxes">
			<input type="radio" name="PersonEI" value="100" checked> Extrovert <br>
			<input type="radio" name="PersonNS" value="100" checked> Intuitive <br>
			<input type="radio" name="PersonFT" value="100" checked> Thinking <br>
  			<input type="radio" name="PersonJP" value="100" checked> Judging  	<br>
  		</div>
  		<div class="personalityBoxes">
  			<input type="radio" name="PersonEI" value="0"> Introvert<br>
  			<input type="radio" name="PersonNS" value="0"> Sensing<br>
  			<input type="radio" name="PersonFT" value="0"> Feeling<br>
  			<input type="radio" name="PersonJP" value="0"> Perceiving<br>
  		</div>
		<br>
		<input type="submit" value="CREATE!">
	</form>
	
	
	<?php 
	echo $this->session->userdata('logged_in');
	?>
</div>