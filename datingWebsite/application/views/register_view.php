<div class="content">

	<?php
	if($error)
		echo '<p class="error">Email already in use.</p>';
	?>
	<form method="post" action="register/firstStep" class="register">
	<div class='registerwrapper'>
		<div class='registerForm'>
			nickname/alias <br>
			<input type='text' name='nickname' id='nickname' required/> <br>
		
			full name<br>
			<input type='text' name='fullname' id='fullname' required/> <br>
	
			Email address<br>
			<input type='email' name='email' id='email' required/> <br>
		
			password:<br>
			<input type='password' name='password' id='password' minlength='4' required/>
		</div>
		<div class='registerForm'>
			birthday <br>
			<input type='number' name='day' id='day' maxlength='2' size='4' min="1" max="31" placeholder='day' required/>
			<input type='number' name='month' id='month' maxlength='2' size='4' min="1" max="12" placeholder='month' required/>
			<input type='number' name='year' id='year' maxlength='4' size='4' min="1900" max="2016" placeholder='year' required/>
			<br>
			I am a:<br>
			<input type='radio' name='gender' value='Man' required checked> Man
			<input type='radio' name='gender' value='Woman' required> Woman <br>
			looking for: <br>
			<input type='radio' name='interest' required> Man
			<input type='radio' name='interest' required checked> Woman
			<input type='radio' name='interest' required> Both
			<p>slider here!</p>
			<input type='text' readonly name='age' value='5' required>
			<p> dropdown with checkboxes here! </p>
			<input type='text' readonly name='brands' value='Pepsi' required>
			<br>
		</div>
		<div class='descriptionForm'>
		tell us something about you! <br>
		<input type='text' id='userDescription' name='description'>
		<input type="submit" value="Go To Step 2">
		</div>
		</div>
	</form>
</div>