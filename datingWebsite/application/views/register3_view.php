<script src="<?php echo base_url();?>jqueryregisterslider.js"></script>
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
	<form method="post" action="register/thirdStep">
		<input type="submit" value="CREATE!">
	</form>
	
	
	<?php 
	echo $this->session->userdata('logged_in');
	?>
</div>

