<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php	

$class=0;

echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

	echo "<input type=hidden name=pac_id value=".$row["pac_id"].">";
	echo "<input type=hidden name=os_ant value='".$row["pac_os"]."'>";
	
	echo "<table class=myTable-gray align=center>";

		echo "<tr><td class=subtitulo>CAMBIAR OBRA SOCIAL DEL PACIENTE</td></tr>";
		echo "<tr><td align=center><b>".$row["nombre"]."</b></td></tr>";
		echo "<tr><td align=center><b>".$row["pac_domicilio"]." ".$row["pac_dpto"]."</b></td></tr>";
		echo "<tr><td align=center><b>".$row["pac_os"]."</b></td></tr>";

		echo "<tr><td align=center class=subtitulo><b>OBRA SOCIAL ACTUAL</b></td></tr>";
		echo "<tr><td align=center class=".$class."><b>".$row["pac_os"]."</b></td></tr>";
		echo "<tr><td align=center class=subtitulo></td></tr>";

		echo "<tr><td align=center class=subtitulo	><b>NUEVA OBRA SOCIAL</b></td></tr>";
		echo "<tr><td align=center class=data><b>"; 
							echo "<select name=pac_os width=100% class=Fields>";
								
								$res=mysql_select("os_nombre","os");
								while($rw=mysql_fetch_array($res,MYSQL_ASSOC))
									echo "<option>".$rw["os_nombre"];
								
								echo "<option selected>".$row["pac_os"];
							echo "</select>";
		
		echo "</b></td></tr>";
		echo "<tr><td align=center><hr></td></tr>";

		echo "<tr><td class=head>FECHA CAMBIO</td></tr>";
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
		echo "<tr><td align=center>";

		echo "<input type=submit name=event class=myButton value=\"Cambiar OS\"></td></tr>";

	echo "</table>";
echo "</form>";
	tab_gral_end()
?>