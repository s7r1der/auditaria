<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

$conn=newConnect();

if($row["enf_telefono"]==""){
	$query=mysqli_query($conn,"SELECT enf_id FROM enfermero WHERE 1 order by enf_id desc limit 1");
		
	if($r=mysqli_fetch_array($query,MYSQLI_ASSOC))	$row["enf_telefono"]=$r["enf_id"]+1;
}

echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

	echo "<table align=center class=myTable-gray>";
		
		echo "<tr><td colspan=3 class=titulo>FORMULARIO INGRESO ENFERMEROS</td></tr>";
		
		echo "<tr valign=top>";
			echo "<td>";
				include("inc/enf/personal_data.php");
			echo "</td><td>";
				include("inc/enf/laboral_data.php");
			echo "</td><td>";
				include("inc/enf/access_data.php");
			echo "</td>";
		echo "</tr>";

		echo "<tr><td colspan=3><hr></td></tr>";

		echo "<tr><td colspan=3 class=head align=right>";
			if($_SESSION["type_busq"]=="enfer1"){
				$_SESSION["p_id_ant"]=$row["enf_id"];

				echo "<input type=submit name=event class=myButton value=\"Guardar Datos\">";
				echo "<input type=submit name=event class=myButton value=\"Eliminar Enfermero\">";
			}else{
				echo "<input type=submit name=event class=myButton value=\"Ingresar\">";
			}
?>
		<input type=submit name=event class=myButton value=Cancelar></td></tr>
	</table>
</form>