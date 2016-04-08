<div class="content">
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