<div class="content">

	<form method="post" action="configuration/submit">
		<h2>Brand formula:</h2>
		<input type="radio" name="brands" value="1" required checked/> Dice's coefficient <br>
		<input type="radio" name="brands" value="2" /> Jaccard's coefficient <br>
		<input type="radio" name="brands" value="3" /> Cosine coefficient <br>
		<input type="radio" name="brands" value="4" /> Overlap coefficient <br>
		
		<h2>Distance x:</h2>
		<input type="number" name="x" step="0.01" min="0" max="1" value=0.5 required> <br>
		
		<h2>Likes alpha:</h2>
		<input type="number" name="alpha" step="0.01" min="0" value=0.5 max="1"> <br><br>
		
		<input type="submit" value="Change">
	</form>
</div>