<div class="content">

	<h2>Do the following personality test to see what personalitytype you are!</h2>
	<form method="post" action="register/secondStep">
		<?php 
		$indices = range(1, 19);
		for ($x = 1; $x < 20; $x++) {
			$index = array_rand($indices);
			$question = "v".$indices[$index];
			unset($indices[$index]);
			$real = $$question;
			echo 'Vraag '.$x.'<br>';
   		 	echo "<input type='radio' name=v".$real['n']." value='a' required>".$real['a']."<br>";
   		 	echo "<input type='radio' name=v".$real['n']." value='b' required>".$real['b']."<br>";
   		 	echo "<input type='radio' name=v".$real['n']." value='c' required>".$real['c']."<br>";
		}
		?>
		<br>
		<input type="submit" value="Go To Step 3">
	</form>
</div>