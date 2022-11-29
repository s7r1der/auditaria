<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

/*if($row["pac_telefono"]==""){
	$query=mysqli_query($conn,"SELECT pac_id FROM paciente order by pac_id desc limit 1");
	
	if($r=mysqli_fetch_array($query,MYSQLI_ASSOC)){
		$row["pac_id"]=$r["pac_id"]+1;
		$row["pac_telefono"]="261";
	}
}*/

?>

<CENTER>


<form action=<?php echo $_SERVER["PHP_SELF"];?> method=POST>

<input type=hidden name=pac_id value="<?php echo $row["pac_id"];?>">
<input type=hidden name=op_date value="<?php echo $_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"];?>">

<!--<table align=center width=46% class=menu>-->

<table align=center class=myTable-gray valign=top>
	
	<tr>	<td class=titulo colspan=4><u>PACIENTE NUEVO </u></td></tr>

	<tr>	<td><B>Domicilio:</B></td>		<td align=right><input type=text name=pac_domicilio value="<?php echo $row["pac_domicilio"];?>"></td></tr>
	<tr>	<td><B>Departamento:</B></td>	<td align=right>
			<?php			
				echo "<select name=pac_dpto>";
							$res1=mysqli_query($conn,"select dpto_nombre from departamento order by dpto_nombre asc")or die(mysqli_error($conn));

							while($row1=mysqli_fetch_array($res1,MYSQLI_ASSOC)){
								echo "<option name=opt>".$row1["dpto_nombre"];
							}
							
							if($row["pac_dpto"]!="")	echo "<option selected>".$row["pac_dpto"];
							else	echo "<option selected>-";

			echo "</select></td></tr>";?>

	<tr>	<td><B>Tipo Vivienda:</B></td>	<td align=right>
			<?php			
				echo "<select name=pac_vivienda>";
					echo "<option name=opt selected>CASA";
					echo "<option name=opt>GERIATRICO";
				echo "</select></td></tr>";?>

	<tr>	<td><b>Nombre:</b></td>		<td align=right><input type=text name=pac_nombre value="<?php echo $row["pac_nombre"];?>"></td></tr>
	<tr>	<td><B>Apellido:</B></td>	<td align=right><input type=text name=pac_apellido value="<?php echo $row["pac_apellido"];?>"></td></tr>
	<tr>	<td><B>Telefono:</B></td>	<td align=right><input type=text name=pac_telefono value="<?php echo $row["pac_telefono"];?>"></td></tr>
	<tr>	<td><B>Telefono ALT:</B></td>	<td align=right><input type=text name=pac_dni value="<?php echo $row["pac_dni"];?>"></td></tr>
	
	<tr>	<td><B>Obra Social:</B></td>
	<?php
			echo "<td align=right	>	<select name=pac_os>";
						$res1=mysqli_query($conn,"select os_nombre from os where os_estado='activo' order by os_nombre asc")or die(mysqli_error($conn));

						while($row1=mysqli_fetch_array($res1,MYSQLI_ASSOC)){
							echo "<option name=opt>".$row1["os_nombre"];
						}
						
						if($row["pac_os"]!="")	echo "<option selected>".$row["pac_os"];
						else	echo "<option selected>-";

					echo "</select></td></tr>";
		echo "<tr><td><B>Nro AFIL:</B></td>	<td align=right><input type=text name=pac_afil value=".$row["pac_afil"]."></td></tr>";

echo "<tr><td colspan=4><br></td></tr>";

echo	"<tr><th colspan=6 align=right><input type=submit name=event value=\"Agregar Paciente\">"
			."<input type=submit name=event value=Cancelar></th></tr>";	

echo "</table>";

echo "</form>";
?>
