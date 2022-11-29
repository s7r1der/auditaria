<form action=<?php echo $_SERVER["PHP_SELF"];?> method=POST>
<?php	


//include("inc/enc_busq.php");
echo "<table class=myTable-gray align=center>";
//DETALLES POR OBRA SOCIAL.
	echo "<tr><td class=titulo colspan=2>MES A LIQUIDAR</td></tr>";

	echo "<tr><td>MES:</td>";
	echo "<td align=right><select name=month>";
	for($i=1;$i<=12;$i++){
		//$i++;
		echo "<option>".$i;
	}echo "<option name=opt selected>".(date("m")-1);

	echo "</select></td></tr>";

	echo "<tr><td>AnO:</td>";
	echo "<td align=right><select name=year>";
	for($i=2020;$i<=2022;$i++){
		//$i++;
		echo "<option>".$i;
	}echo "<option name=opt selected>".(date("m")<2?date("Y")-1:date("Y"));

	echo "</select></td></tr>";
	
	echo "<tr><td colspan=2 align=right><input type=\"submit\" class=myButton name=\"event\" value=\"Sueldos\"></td></tr>";


echo "</table></form></center>";
tab_gral_end()

?>
