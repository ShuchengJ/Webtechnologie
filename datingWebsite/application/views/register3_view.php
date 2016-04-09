<div class="content">

	<?php
	$userData = $this->session->userdata('userData');
	$type = "(";
	echo "You are ";
	if($userData['ei'] < 49){
		echo "Extraversion ";
		$type .= "E";
	}
	else {
		echo "Introversion ";
		$type .= "I";
	}
	if($userData['ns'] < 49){
		echo "Intuition  ";
		$type .= "N";
	}
	else {
		echo "Sensing ";
		$type .= "S";
	}
	if($userData['tf'] < 49){
		echo "Thinking ";
		$type .= "T";
	}
	else {
		echo "Feeling ";
		$type .= "F";
	}
	if($userData['jp'] < 49){
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
	<form method="post" action="register/thirdStep">
	
		<label for='firstname' class='labelname'>First name:</label> 
		<label for='lastname'>Last name:</label>
		<br>
		<input type='text' name='firstname' id='firstname' maxlength="50" />
		<input type='text' name='lastname' id='lastname' maxlength="50" />
		<br>
		<label for='email'>banaan</label>
		<br>
		<input type='email' name='email' id='email' maxlength="100" />
		<br>
		<input type="submit" value="CREATE!">
	</form>
	
	
	<?php 
	echo $this->session->userdata('logged_in');
	?>
</div>