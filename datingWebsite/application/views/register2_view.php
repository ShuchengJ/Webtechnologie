<div class="content">

	do the following test to see what personality type thingy you are!
	<form method="post" action="register/secondStep">
		<?php 
		for ($x = 1; $x < 3; $x++) {
			$question = "v".$x;
			$real = $$question;
			echo 'Vraag '.$x.'<br>';
   		 	echo "<input type='radio' name=v".$real['n']." value='a'>".$real['a']."<br>";
   		 	echo "<input type='radio' name=v".$real['n']." value='b'>".$real['b']."<br>";
   		 	echo "<input type='radio' name=v".$real['n']." value='c'>".$real['c']."<br>";
		}
		?>
		<br>
		<input type="submit" value="Go To Step 3">
	</form>
</div>