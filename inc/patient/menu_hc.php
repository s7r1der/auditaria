<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php	

echo "<table class=myTable-gray width=100% align=center>";
	echo "<tr><td align=center>";
		echo "<table><tr>"
			."<td><a href=".$_SERVER["PHP_SELF"]."?event=evol_hc_pac"
				."&pac_id=".$row["pac_id"]."&year=".date("Y").">"
				."<img src=\"iconos/icons/menuppalstad32.png\" width=32 title=\"Evolucion\"></td>"
			."<td><font color=black>EVOLUCIONES</a></td>";
		echo "</tr></table>";
	
	echo "</td>";

	echo "<td align=center>";
		echo "<table><tr>"
			."<td><a href=".$_SERVER["PHP_SELF"]."?event=evolmen_hc_pac1"
				."&pac_id=".$row["pac_id"]."&year=".date("Y").">"
				."<img src=\"iconos/icons/menuppalprog32.png\" title=\"Evolucion\"></td>"
			."<td><font color=black>EVOLUCIONES MENSUALES</a></td>";
		echo "</tr></table>";
	echo "</td>";

	echo "<td align=center>";
		echo "<table><tr>"
			."<td><a href=".$_SERVER["PHP_SELF"]."?event=nov_hc_pac"
				."&pac_id=".$row["pac_id"]."&year=".date("Y").">"
				."<img src=\"iconos/icons/information-balloon32.png\" title=\"Evolucion\"></td>"
			."<td><font color=black>NOVEDADES</a></td>";
		echo "</tr></table>";
	echo "</td>";

	echo "<td align=center>";
		echo "<table><tr>"
			."<td><a href=".$_SERVER["PHP_SELF"]."?event=sond_hc_pac"
				."&pac_id=".$row["pac_id"]."&year=".date("Y").">"
				."<img src=\"iconos/icons/menuppalenf32.png\" title=\"Evolucion\"></td>"
			."<td><font color=black>SONDAJES</a></td>";
		echo "</tr></table>";
	echo "</td>";

	echo "<td align=center>";
		echo "<table><tr>"
			."<td><a href=".$_SERVER["PHP_SELF"]."?event=ubc_hc_pac"
				."&ubc_lat=".$row["ubc_lat"]."&ubc_lon=".$row["ubc_lon"].">"
				."<img src=\"iconos/icons/web32.png\" width=32 title=\"Evolucion\"></td>"
			."<td><font color=black>UBICACION</a></td>";
		echo "</tr></table>";
	echo "</td>";

	echo "<td align=center>";
		echo "<table><tr>"
			."<td><a href=".$_SERVER["PHP_SELF"]."?event=hc_atention"
				."&pac_id=".$row["pac_id"]."&year=".date("Y").">"
				."<img src=\"iconos/icons/menuppaldet32.png\" title=\"Evolucion\"></td>"
			."<td><font color=black>DETALLE</a></td>";
		echo "</tr></table>";
	echo "</td>";

	echo "</tr>";
echo "</table>";
	
?>

	