<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php	

echo "<CENTER><FONT SIZE=\"5\" COLOR=\"white\" face=\"Neuropol\"><B>COPIAR DATOS</b></FONT></CENTER><br>";
	
echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

	echo "<input type=hidden name=op_date value=".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"].">";
	echo "<input type=hidden name=op_date1 value=".$_GET["day"]."/".$_GET["month"]."/".$_GET["year"].">";

//tab_gral_st("",'3',"#000099","","");

echo "<table class=menu-gray align=center>";
	
	echo "<tr><td colspan=5 align=CENTER class=titulo>COPIAR DIA:</td></tr>";

	echo "<tr><td colspan=5 align=CENTER><FONT size=5 face=\"Berlin Sans FB\"><b>"
	.$_GET["day"]."/".$_GET["month"]."/".$_GET["year"]."</b></FONT></td></tr>";

	echo "<tr><td colspan=5 align=CENTER class=subtitulo><FONT face=\"Berlin Sans FB\"><b>AL DIA: </b></FONT></td></tr>";

	echo "<tr><td>";	sel_date("fec_day",1,32,$_SESSION["day"])."<td>";
	echo "<td><FONT COLOR=\"white\" face=\" Sans FB\"><b> / </b></font>";
	
	echo "<td>";	sel_date("fec_month",1,13,$_SESSION["month"])."<td>";
	echo "<td><FONT COLOR=\"white\" face=\"Berlin Sans FB\"><b> / </b></font>";

	echo "<td>";	sel_date("fec_year",2018,2023,$_SESSION["year"])."<td>";
	echo "</td></tr>";
				
	echo "<tr>"	."<td colspan=3 align=left><input type=checkbox name=state><font size=2>Copiar Estado</font>"
							."<br><input type=checkbox name=deldatos class=Fields><font size=2>Borrar datos</font>"
							."<td colspan=2	align=right><input type=\"submit\" name=\"event\" value=\"Copiar Dia\" class=myButton></td></tr>";
		
echo "</table>";

echo "</form>";

?>
