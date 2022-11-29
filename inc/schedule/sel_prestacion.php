<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php 	
	
echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

echo "<input type=hidden name=pac_id value=".$_GET["pac_id"].">";

echo "<table border=0 align=center class=\"menu-gray\">";

	echo "<tr><td colspan=2 class=\"titulo\" align=center><b><u>SELECCION DE PRESTACION:</u></B></td></tr>";

	//for($i=0;$i<4;$i++){
	$res1=mysqli_query($conn,"select prest_nombre from prestacion where prest_visibil='1' order by prest_nombre asc")or die(mysqli_error($conn));

	/*$sys=type_user($_SESSION["user"]);
	$color=($sys==1?"blue":"green");
	
	echo "<tr>"; 
		echo "<td align=left><B>SISTEMA:</B></td><td><b><font size=4 color=".$color.">".($sys==1?"SOE":"COOPERATIVA")."</font></b></td>";
	echo "</tr>";

	echo "<tr><td colspan=2 class=subtitulo></td></tr>";
	*/
	
	echo "<tr>";
		echo "<td align=left><B>PRESTACION:</B></td>";
		echo "<td align=left>";
			echo "<select name=op_prestacion class=Fields>";
				while($row1=mysqli_fetch_array($res1,MYSQLI_ASSOC))
					echo "<option name=opt>".$row1["prest_nombre"];
				//echo "<option selected>".($i==0?"extraccion de sangre":"-");
				echo "<option selected>CUIDADOS";
			echo "</select>"; 
		echo "</td>";	
	echo "</tr>";
//}
	echo "<tr><td colspan=2 class=subtitulo></td></tr>";
		
	echo  "<tr>";
		echo "<td align=left><B>CANTIDAD DE HORAS:</B></td>";
		echo "<td align=left>";
			echo "<select name=cant_horas class=Fields>";
				
				for($i=1;$i<25;$i++){
					echo "<option name=opt>".$i;
				}
				
				echo "<option name=opt selected>4";
			echo  "</select><b> HORAS</b";
		echo "</td>";
	echo "</tr>";
	
	echo "<tr><td colspan=2 class=subtitulo></td></tr>";

	echo  "<tr>";
		echo "<td align=left><B>FORMATO HORARIO:</B></td>";
		echo "<td align=left>";
			echo "<select name=formato class=Fields>";
				echo "<option selected>Corrido</option>";
				echo "<option>Fraccion</option>";			
			echo  "</select>";
		echo "</td>";
	echo "</tr>";


	echo "<tr>";
		echo "<td colspan=2 align=right><input class=myButton type=\"submit\" name=\"event\" value=\"Seleccionar Prestaciones\"></td>";
	echo "</tr>";

echo "</table>";

echo "</form>";
?>
