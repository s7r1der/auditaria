<link rel="StyleSheet" href="css/hc.css" type="text/css">

<?php	

$class=0;

echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

	echo "<input type=hidden name=pac_id value=".$row["pac_id"].">";
	echo "<input type=hidden name=est_ant value='".$row["pac_estado"]."'>";
	
	echo "<table class=myTable-gray align=center>";

		switch($row["pac_estado"]){
			case "ACTIVO":
			case "ALTA ENF":	$class="activo";
									break;
			case "ALTA":		$class="alta";
									break;
			case "INTERNADO":	$class="internado";
									break;
			case "FALLECIDO":	$class="fallecido";
									break;
		}

		echo "<tr><td class=titulo>ESTADO DEL PACIENTE</td></tr>";
		echo "<tr><td align=center><b>".$row["pac_nombre"]." ".$row["pac_apellido"]."</b></td></tr>";
		echo "<tr><td align=center><b>".$row["pac_domicilio"]." ".$row["pac_dpto"]."</b></td></tr>";
		echo "<tr><td align=center><b>".$row["pac_os"]."</b></td></tr>";
		echo "<tr><td align=center></td></tr>";

		echo "<tr><td align=center class=subtitulo><b>ESTADO ACTUAL</b></td></tr>";
		echo "<tr><td align=center class=".$class."><b>".$row["pac_estado"]."</b></td></tr>";
		echo "<tr><td align=center class=subtitulo></td></tr>";
	//	echo "<tr><td align=center><hr></td></tr>";

		echo "<tr><td align=center class=subtitulo><b>NUEVO ESTADO</b></td></tr>";
		echo "<tr><td align=center class=alta><b>"; 
							echo "<select name=pac_estado width=100%>"
											."<option>ACTIVO"
											."<option>ALTA"
											."<option>ALTA ENF"
											."<option>FALLECIDO"
											."<option>INTERNADO"
											."<option selected>".$row["pac_estado"];
							echo "</select>";
		
		echo "</b></td></tr>";
		//echo "<tr><td align=center class=subtitulo></td></tr>";
		echo "<tr><td align=center><br></td></tr>";

		echo "<tr><td class=subtitulo>FECHA CAMBIO ESTADO</td></tr>";
		echo "<tr><td align=center>";
		
			echo "<table>";
				echo "<tr>";
					echo "<td>".sel_date("day",1,31,date("d"))."</td>";
					echo "<td>".sel_date("month",1,12,date("m"))."</td>";
					echo "<td>".sel_date("year",2006,2012,date("Y"))."</td>";
				echo "</tr>";
			echo "</table>";
		
		echo "</td></tr>";
		echo "<tr><td colspan=1 align=center><b><textarea name=desc cols=33 rows=5></textarea></b></td></tr>";
		echo "<tr><td align=center class=alta>";

		echo "<input type=submit name=event value=\"Cambiar Estado\" class=myButton></td></tr>";

	echo "</table>";
echo "</form>";
?>