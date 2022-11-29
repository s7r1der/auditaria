<link rel="StyleSheet" href="css/forms.css" type="text/css">
	
<?php	

$date=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"];


//echo $_POST["op_prestacion"];	

echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

	echo "<input type=hidden name=pac_id value='".$_POST["pac_id"]."'>";
	if($_POST["ubic"]=="pendiente") echo "<input type=hidden name=op_id value='".$_POST["op_id"]."'>";
	echo "<input type=hidden name=pac_domicilio value='".$_POST["pac_domicilio"]."'>";
	echo "<input type=hidden name=pac_dpto value='".$_POST["pac_dpto"]."'>";
	echo "<input type=hidden name=pac_nombre value='".$_POST["pac_nombre"]."'>";
	echo "<input type=hidden name=pac_apellido value='".$_POST["pac_apellido"]."'>";
	echo "<input type=hidden name=pac_os value='".$_POST["pac_os"]."'>";
	if($_POST["ubic"]=="pendiente")echo "<input type=hidden name=opdate1 value='".$_POST["opdate1"]."'>";
	echo "<input type=hidden name=pac_telefono value='".$_POST["pac_telefono"]."'>";

	echo "<input type=hidden name=op_prestacion value='".$_POST["op_prestacion"]."'>";
	echo "<input type=hidden name=cant_horas value='".$_POST["cant_horas"]."'>";
	echo "<input type=hidden name=op_formato value='".$_POST["op_formato"]."'>";

	echo "<input type=hidden name=zona_desc value='".$_POST["zona_desc"]."'>";

echo "<table align=center class=menu-gray>";
	echo "<tr><td colspan=2 align=center class=titulo><font size=5>COMPROBACION DE DATOS</font></td></tr>";
	
	echo "<tr valign=top><td>";
		echo "<table>";
			echo "<tr><td colspan=2 class=subtitulo align=center>DATOS DEL PACIENTE<br></td></tr>";
			echo "<tr><td><b>PACIENTE:</b></td><td>".$_POST["pac_nombre"]." ".$_POST["pac_apellido"]."</td></tr>";
			echo "<tr><td><b>DOMICILIO:</b></td><td>".$_POST["pac_domicilio"]." ".$_POST["pac_dpto"]."</td></tr>";
			echo "<tr><td><b>OBRA SOCIAL:</b></td><td>".$_POST["pac_os"]."</td></tr>";
		echo "</table>";

		echo "<br>";

		echo "<table width=100%>";
			echo "<tr><td colspan=2 class=subtitulo width=100%>PRESTACIONES A CARGAR<br></td></tr>";
				echo "<tr><td align=left><b>".$_POST["op_prestacion"]." x <u>".$_POST["cant_horas"]."HS.</u>  ( ".strtoupper($_POST["op_formato"])." )</b></td></tr>";

		echo "</table>";

		echo "<br>";


		$emat=explode(" - ",$_POST["e_mat"]);

		$conn1=newConnect();
		$res1=mysqli_query($conn1,"SELECT enf_owner from enfermero where e_mat='".$emat[0]."'") or die(mysqli_error($conn));


		while($rqwqr=mysqli_fetch_array($res1,MYSQLI_ASSOC)){
		
			echo "<input type=hidden name=enf_owner value='".$rqwqr["enf_owner"]."'>";

			echo "<table width=100%>";
				echo "<tr><td colspan=2 class=subtitulo>ENFERMERO A ASIGNAR<br></td></tr>";
				echo "<tr><td>ENFERMERO:</td><td>".$rqwqr["enf_owner"]."</td></tr>";
				echo "<tr><td>PERTENECE:</td><td>".$_POST["e_mat"]."</td></tr>";
			echo "</table>";

		}

		echo "<br>";

		echo "<table width=100%>";
			echo "<tr><td class=subtitulo colspan=4>HORARIO DEL DOMICILIO<br></td></tr>";
			echo "<tr><td>A PARTIR DE LAS:</td><td>";
				sel_date("hrs",1,23,"08"); 
				echo " : ";
				sel_date("min",0,59,"00"); 
			echo "</td></tr>";

			echo "<tr><td></td></tr>";
			if($_POST["ubic"]=="pendiente"){
				echo "<tr><td align=center colspan=2><input type=submit name=event class=myButton value=\"Prestacion Pendiente\"><br></td></tr>";

			}else{
				echo "<tr><td align=center colspan=2 class=head><input type=submit class=myButton name=event value=\"Agregar Prestacion\"><br></td></tr>";	
			}
		echo "</table>";

	echo "</td>";

	echo "<td>";
		echo "<table>";
			echo "<tr><td colspan=3 class=head>DOMICILIOS ASIGNADOS AL ENFERMERO:".$_POST["e_mat"]."<br></td></tr>";
			
			$mat=explode(' - ',$_POST["e_mat"]);
			echo "<input type=hidden name=e_mat value='".$mat[0]."'>";

			$cont=0;
			
			$conn=newConnect();
			$query=mysqli_query($conn,"SELECT CONCAT(pac.pac_domicilio,' ',pac.pac_dpto) as domicilio,date_format(op.op_date,'%H:%i') as op_date1"
								." FROM op".$_SESSION["year_tmp"]."cuidados op left join paciente pac on op.pac_id=pac.pac_id"
								." WHERE op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59'"
								." and op.e_mat=".$mat[0]." order by op.op_date");

			while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
				$cont++;
				echo "<tr><td>".$cont." - </td><td>".$row["op_date1"]."</td><td>".$row["domicilio"]."</td></tr>";
			}
			
		echo "</table>";
	echo "</td></tr>";

echo "</table>";

echo "</form>";
?>