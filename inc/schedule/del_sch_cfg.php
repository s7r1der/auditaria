<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

echo "<form ENCTYPE=\"multipart/form-data\" action=".$_SERVER["PHP_SELF"]." method=POST>";

	echo "<input type=hidden name=pac_id value=".$_GET["pac_id"].">";
	echo "<input type=hidden name=op_id value=".$_GET["op_id"].">";
	echo "<input type=hidden name=table value=".$_GET["table"].">";
	echo "<input type=hidden name=ubic value=det_enf_lst>";
	
	echo "<table align=center class=myTable-gray><tr><td>";

	$res=mysqli_query($conn,"select CONCAT(pac.pac_apellido,' ',pac.pac_nombre) as paciente,CONCAT(pac.pac_domicilio,' ',pac.pac_dpto) as domicilio,pac.pac_dpto,"
					."op.op_date,op.op_prestacion,date_format(op.op_date,'%Y-%m-%d') as date1,date_format(op.op_date,'%d/%m/%Y %h:%i:%s') as fecha,op.e_mat"
					." FROM ".$_GET["table"]." op left join paciente pac on pac.pac_id=op.pac_id"
					." WHERE op.	op_id='".$_GET["op_id"]."'") or die(mysqli_error($conn));

	while($rowq=mysqli_fetch_array($res,MYSQLI_ASSOC)){


		echo "<input type=hidden name=date1 value=".$rowq["date1"].">";
		echo "<input type=hidden name=zona_desc value=".urlencode(det_zona($rowq["pac_dpto"])).">";
		echo "<input type=hidden name=e_mat value=".$rowq["e_mat"].">";
		echo "<input type=hidden name=op_date value=\"".$rowq["op_date"]."\">";
		echo "<input type=hidden name=op_prestacion value=\"".$rowq["op_prestacion"]."\">";

		echo "<TR><TD class=titulo colspan=2>CONFIRMACION BORRADO</td></tr>";
		echo "<TR><TD class=subtitulo colspan=2>DATOS PACIENTE</td></tr>";
		
		echo "<TR>";
			echo "<TD class=bold>Paciente:</td>";
			echo "<td>".$rowq["paciente"]."</td>";
		echo "</tr>";
		
		echo "<TR><TD class=bold>Domicilio:</td>";
		echo "<td>".$rowq["domicilio"]."</td></tr>";
		
		echo "<TR><TD class=bold> Prestacion:</td>";
		echo "<td>".$rowq["op_prestacion"]."</td></tr>";
		
		echo "<TR><TD class=bold>Fecha:</td>";
		echo "<td>".$rowq["fecha"]."</td></tr>";

		echo "<TR><TD class=bold>Enfermero:</td>";
		echo "<td>".$rowq["e_mat"]."</td></tr>";

		echo "<TR><TD class=subtitulo colspan=2></td></tr>";

	}

	echo "<tr><td colspan=2><input type=checkbox name=delplanifdiaria>Borrar la planificacion diaria</td></tr>";
	echo "<tr><td colspan=2><input type=checkbox name=delplanif>Borrar la planificacion completa</td></tr>";
	echo "<tr><td colspan=2><input type=checkbox name=delprestacion>Borrar planificacion de prestaciones</td></tr>";
	echo "<tr><td colspan=2><input type=checkbox name=delmatric>Borrado planificacion con igual matricula</td></tr>";

	echo  "<tr>";
					echo "<td colspan=2 align=center>";
						echo "<input type=submit class=myButton name=event value=\"Borrar Prestacion\">";
					echo "</td>";
				echo "</tr>";
	echo "</table>";
echo "</form>";
?>