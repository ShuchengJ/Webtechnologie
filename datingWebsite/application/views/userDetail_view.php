<div class="content">
<div>
<table>
<?php
$extraversion = $ei < 49;
$intuition = $ns < 49;
$thinking = $tf < 49;
$judging = $jp < 49;
echo "<tr><td>Nickname</td><td>$nickname</td></tr>";
echo "<tr><td>Gender</td><td>$gender</td></tr>";
echo "<tr><td>Birthday</td><td>$day - $month - $year</td></tr>";
echo "<tr><td>Description</td><td>$description</td></tr>";
echo "<tr><td>Age preference</td><td>$agemin - $agemax</td></tr>";
echo "<tr><td>Gender preference</td><td>$interest</td></tr>";
echo "<tr><td>Personality</td><td>";
if($extraversion) echo "Extraversion: $ei "; else echo "Introversion: $ei ";
if($extraversion) echo "Intuition: $ns "; else echo "Sensing: $ns ";
if($extraversion) echo "Thinking: $tf "; else echo "Feeling: $tf ";
if($extraversion) echo "Judging: $jp "; else echo "Perceiving: $jp ";
echo "</td></tr>";
echo "<tr><td>Personality preference</td><td>";
if(!$extraversion) echo "Extraversion: $ownEI "; else echo "Introversion: $ownEI ";
if(!$extraversion) echo "Intuition: $ownNS "; else echo "Sensing: $ownNS ";
if(!$extraversion) echo "Thinking: $ownTF "; else echo "Feeling: $ownTF ";
if(!$extraversion) echo "Judging: $ownJP "; else echo "Perceiving: $ownJP ";
echo "</td></tr>";
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