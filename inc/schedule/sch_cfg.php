<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php	
//echo "<CENTER><FONT SIZE=\"5\" COLOR=\"white\" face=\"Neuropol\"><B>VER HORARIOS</b></FONT></CENTER>";
	
echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

echo "<table class=myTable-gray align=center width=16%>";

//echo "<table class=menu>";
	echo "<tr>	<TD colspan=3 class=titulo>VER DIA</td></tr>";
	
	echo "<tr>	<td colspan=3 class=subtitulo>Fecha : </td></tr>";

	echo "<tr>";
		echo "<td align=center>";	sel_date("fec_day",1,31,1)."</td>";
		echo "<td align=center>";	sel_date("fec_month",1,12,date("m")-0)."</td>";
		echo "<td align=center>";	sel_date("fec_year",2018,2023,$_SESSION["year"])."</td>";
		//echo "<td align=center>";	sel_date("fec_day",1,31,$_SESSION["day"])."</td>";
		//echo "<td align=center>";	sel_date("fec_month",1,12,$_SESSION["month"])."</td>";
		//echo "<td align=center>";	sel_date("fec_year",2006,2020,$_SESSION["year"])."</td>";
				
	if($_SESSION["pos"]=="enf")
		echo "<tr>	<td colspan=3 align=center><input type=\"submit\" class=myButton name=\"event\" value=\"Consulta\"></td></tr>";
	elseif($_SESSION["pos"]=="hrs_cfg")
		echo "<tr>	<td colspan=3 align=center><input type=\"submit\" class=myButton name=\"event\" value=\"Consultar\"></td></tr>";
	elseif($_SESSION["pos"]=="rts_cfg"){
		
			echo "<tr><td>Matricula:</td>";
				echo "<td align=right colspan=3><select name=e_mat>";
				
				$conn=newConnect();
				$res=mysqli_query($conn,"SELECT e_mat, enf_nombre FROM enfermero WHERE enf_estado='ACTIVO' order by e_mat asc");

				while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
						echo "<option name=opt>".$row["e_mat"]." - ".$row["enf_nombre"];
				}echo "<option name=opt selected=opt>E.T";
				echo "</select></td></tr>";
	
		echo "<tr>	<td colspan=3 align=right><input type=\"submit\" name=\"event\" value=\"Ver Rutas\" ></td></tr>";			
	}

echo "</table>";

echo "</form>";

?>