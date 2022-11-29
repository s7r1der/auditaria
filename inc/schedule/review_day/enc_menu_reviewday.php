<link rel="StyleSheet" href="css/forms.css" type="text/css">
<?php 

include("inc/schedule/schedule_func.php");


$ant=det_dia($_GET["day"],$_GET["month"],$_GET["year"],"-1");
$dia=$_GET["year"]."-".$_GET["month"]."-".$_GET["day"];
$pos=det_dia($_GET["day"],$_GET["month"],$_GET["year"],"1");

$ant1=explode("-",$ant);
$dia1=explode("-",$dia);
$pos1=explode("-",$pos);

echo "<table class=myTable-gray width=100%>";

	echo "<tr><td class=head-blu-c colspan=8 align=center width=\"100\"></td></tr>";

	echo "<tr><td class=titulo colspan=8 align=center width=\"100\">";
		echo "<a href=".$_SERVER["PHP_SELF"]."?event=review_day"."&day=".$ant1[2]
														."&month="	.$ant1[1]
														."&year="	.$ant1[0]
														."&opt=".$_GET["opt"]." class=link><font color=white size=4> <<    </font></a>";	
		echo "REVISION DEL DIA: ".$_GET["day"]."/".$_GET["month"]."/".$_GET["year"];
		echo "<a href=".$_SERVER["PHP_SELF"]."?event=review_day"."&day=".$pos1[2]
														."&month="	.$pos1[1]
														."&year="	.$pos1[0]
														."&opt=".$_GET["opt"]." class=link><font color=white size=4> >>    </font></a>";		
	echo "</td></tr>";
	
	echo "<tr valign=center>";
		echo "<td align=center>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=review_day"."&day="	.$dia1[2]
																	."&month="	.$dia1[1]
																	."&year="	.$dia1[0]
																	."&opt=news class=link>NUEVOS</a>";	
		echo "</td>";

		echo "<td align=center>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=review_day"."&day="	.$dia1[2]
																	."&month="	.$dia1[1]
																	."&year="	.$dia1[0]
																	."&opt=internado class=link>INTERNADOS</a>";	
		echo "</td>";

		echo "<td align=center>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=review_day"."&day="	.$dia1[2]
																	."&month="	.$dia1[1]
																	."&year="	.$dia1[0]
																	."&opt=fallecido class=link>FALLECIDOS</a>";	
		echo "</td>";

		echo "<td align=center>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=review_day"."&day="	.$dia1[2]
																	."&month="	.$dia1[1]
																	."&year="	.$dia1[0]
																	."&opt=8horas_dom class=link>+8 HORAS DOMICILIO</a>";	
		echo "</td>";

		echo "<td align=center>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=review_day"."&day="	.$dia1[2]
																	."&month="	.$dia1[1]
																	."&year="	.$dia1[0]
																	."&opt=8horas_cuid class=link>+8 HORAS CUIDADOR</a>";	
		echo "</td>";

		echo "<td align=center>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=review_day"."&day="	.$dia1[2]
																	."&month="	.$dia1[1]
																	."&year="	.$dia1[0]
																	."&opt=sinqth class=link>SIN QTHS</a>";	
		echo "</td>";

		echo "<td align=center>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=review_day"."&day="	.$dia1[2]
																	."&month="	.$dia1[1]
																	."&year="	.$dia1[0]
																	."&opt=sinqru class=link>SIN QRU</a>";	
		echo "</td>";

		echo "<td align=center>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=review_day"."&day="	.$dia1[2]
																	."&month="	.$dia1[1]
																	."&year="	.$dia1[0]
																	."&opt=sonda class=link>PACIENTE SIN CUIDADOR ASIGNADO</a>";	
		echo "</td>";

	echo "</tr>";		
echo "</table>";

?>