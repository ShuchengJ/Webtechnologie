<script src="/datingWebsite/jquerydropdown.js"></script>
<div class="content">

	<?php
	if($error)
		echo '<p class="error">Email already in use.</p>';
	?>
	<form method="post" action="register/firstStep" class="register">
	<div class='registerwrapper'>
		<div class='registerForm'>
			Nickname/alias <br>
			<input type='text' name='nickname' id='nickname' required/> <br>
		
			Full name<br>
			<input type='text' name='fullname' id='fullname' required/> <br>
	
			Email address<br>
			<input type='email' name='email' id='email' required/> <br>
		
			Password:<br>
			<input type='password' name='password' id='password' minlength='4' required/>
			
		</div>
		
		
		<div class='registerForm'>
			Birthday <br>
			<input type='number' name='day' id='day' maxlength='2' size='4' min="1" max="31" placeholder='day' required/>
			<input type='number' name='month' id='month' maxlength='2' size='4' min="1" max="12" placeholder='month' required/>
			<input type='number' name='year' id='year' maxlength='4' size='4' min="<?php echo date("Y") - 100;?>" max="<?php echo date("Y");?>" placeholder='year' required/>
			<br>
			I am a:<br>
			<input type='radio' name='gender' value='Man' required checked> Man
			<input type='radio' name='gender' value='Woman' required> Woman <br>
			looking for: <br>
			<input type='radio' name='interest' value='Man' required> Man
			<input type='radio' name='interest' value='Woman' required checked> Woman
			<input type='radio' name='interest' value='Both' required> Both
			
			<br>
			between the ages of:
			<br>
			<div id="slider"></div>
			
			<input id='amount' type='text' readonly name='age' value='18 - 25' required>
		</div>
		
		<div  class='descriptionForm'>
		Choose your favorite brands: <br>
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
           				$file = fopen($_SERVER['DOCUMENT_ROOT'].'/datingwebsite/brands.txt','r');
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
		
		Tell us something about you! <br>
		<textarea name='description' rows="5" cols="57"></textarea>
		<br>
		<input type="submit" value="Go To Step 2">
		</div>
		</div>
	</form>
</div>