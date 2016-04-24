<div class="content">
<div>
<table>
<?php
if($loggedin)
{
	//$file_headers = @get_headers(base_url().$email.".jpg");
	//print_r($file_headers);
	if (file_exists($email.".png"))
		echo "<img class=images src='../".$email.".png'>";
	else 
		echo "<img class=images src='../picture".$gender.".png'>";
}
else 
	echo "<img class=images src='../picture".$gender.".png'>";
echo "<tr><td>Nickname</td><td>$nickname</td></tr>";
echo "<tr><td>Gender</td><td>$gender</td></tr>";
echo "<tr><td>Birthday</td><td>$day - $month - $year</td></tr>";
echo "<tr><td>Description</td><td>$description</td></tr>";
echo "<tr><td>Age preference</td><td>$agemin - $agemax</td></tr>";
echo "<tr><td>Gender preference</td><td>$interest</td></tr>";
echo "<tr><td>Personality</td><td>";
if($ownEI < 49) echo "Extraversion:".(100 - $ownEI)."% " ; else echo "Introversion: $ownEI% ";
if($ownNS < 49) echo "Intuition:".(100 - $ownNS)."% " ; else echo "Sensing: $ownNS% ";
if($ownTF < 49) echo "Thinking:".(100 - $ownTF)."% " ; else echo "Feeling: $ownTF% ";
if($ownJP < 49) echo "Judging:".(100 - $ownJP)."% " ; else echo "Perceiving: $ownJP% ";
echo "</td></tr>";
echo "<tr><td>Personality preference</td><td>";
if($wantedEI < 49) echo "Extraversion:".(100 -  $wantedEI)."% " ; else echo "Introversion: $wantedEI% ";
if($wantedNS < 49) echo "Intuition:".(100 -  $wantedNS)."% " ; else echo "Sensing: $wantedNS% ";
if($wantedTF < 49) echo "Thinking:".(100 -  $wantedTF)."% " ; else echo "Feeling: $wantedTF% ";
if($wantedJP < 49) echo "Judging:".(100 -  $wantedJP)."% " ; else echo "Perceiving: $wantedJP% ";
echo "</td></tr>";
echo "<tr><td>Brands</td><td>$brands</td></tr>";
?>
</table>
</div>
<form method="post" action="userDetail/like">
<?php
if($loggedin)
	$text = "Like";
else 
	$text = "Login";
echo '<input class="button" type="submit" value="'.$text.'">';
?>
</form>

</div>
</body>
</html>