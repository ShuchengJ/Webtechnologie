<div class="content">
Hier komt alle informatie over die gebruiker en hier kan je hem liken en contact zoeken of whatever...
alle informatie over die gebruiker is in ieder geval al op te halen dus yay

<div>
<table>
<?php
echo "<tr><td>nickname</td><td>$nickname</td></tr>";
echo "<tr><td>geslacht</td><td>$gender</td></tr>";
echo "<tr><td>geboortedatum</td><td>$day</td></tr>";
?>
</table>
</div>
<form method="post" action="userDetail/like">
<?php
echo '<input type="submit" value="like">';
 ?>
</form>

</div>
</body>
</html>