<div class="content">
Hier komt alle informatie over die gebruiker en hier kan je hem liken en contact zoeken of whatever...
alle informatie over die gebruiker is in ieder geval al op te halen dus yay

<div>
<table>
<?php
echo "<tr><td>Nickname</td><td>$nickname</td></tr>";
echo "<tr><td>Gender</td><td>$gender</td></tr>";
echo "<tr><td>Birthday</td><td>$day - $month - $year</td></tr>";
echo "<tr><td>Description</td><td>$description</td></tr>";
echo "<tr><td>Age preference</td><td>$agemin - $agemax</td></tr>";
echo "<tr><td>Gender preference</td><td>$interest</td></tr>";
echo "<tr><td>Personality</td><td>$ei $ns $tf $jp</td></tr>";
echo "<tr><td>Personality preference</td><td>$ownEI - $ownNS - $ownTF - $ownJP</td></tr>";
echo "<tr><td>Brands</td><td>$brands</td></tr>";
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