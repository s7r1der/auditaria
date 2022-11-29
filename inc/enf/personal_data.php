<link rel="StyleSheet" href="css/forms.css" type="text/css">

	<table class=myTable-gray align=center>
		<tr><td colspan=6 class=titulo>INGRESO DE ENFERMERO</td></tr>

		<tr>	<td class=datal><B>ESTADO:</B></td>
				<td class=datal><select name=enf_estado>
					<option name=opt>ACTIVO
					<option name=opt>PASIVO
					<option selected><?php echo ($row["enf_estado"]!=""?$row["enf_estado"]:"ACTIVO");?></select></td></tr>
		<tr>	<td class=datal><B>CATEGORIA:</B></td>
				<td class=datal><select name=enf_role>
					<option name=opt>CUID
					<option selected><?php echo $row["enf_role"];?></select></td></tr>
		<tr>	<td class=datal><B>DNI:</B></td>
				<td class=datal><input type=text name=enf_dni value="<?php echo $row["enf_dni"];?>"></td></tr>
		<tr>	<td class=datal><B>CUIT:</B></td>
				<td class=datal><input type=text name=enf_cuil value="<?php echo $row["enf_cuil"];?>"></td></tr>
		<tr>	<td class=datal><B>Apellido:</B></td>
				<td class=datal><input type=text name=enf_apellido value="<?php echo $row["enf_apellido"];?>"></td></tr>
		<tr>	<td class=datal><b>Nombre:</b></td>
				<td class=datal><input type=text name=enf_nombre value="<?php echo $row["enf_nombre"];?>"></td></tr>
		<tr>	<td class=datal><B>Sexo:</B></td>
				<td class=datal><select name=enf_sexo>
					<option name=opt>M
					<option name=opt>F
					<option selected><?php echo ($row["enf_sexo"]!=""?$row["enf_sexo"]:"");?>
				</select></td></tr>
		<tr>	<td class=datal><B>Fecha de Nacimiento:</B></td>																		
				<td class=datal><input type=text name=enf_fecnac value="<?php echo $row["enf_fecnac"];?>"></td></tr>	
		<tr>	<td class=datal><B>Domicilio:</B></td>
				<td class=datal><input type=text name=enf_domicilio value="<?php echo $row["enf_domicilio"];?>"></td></tr>	
	<?php
		echo "<td class=datal><B>Departamento:</B></td><td class=datal><select name=enf_dpto>";
 
				$res1=mysqli_query($conn,"SELECT dpto_nombre FROM departamento") or die(mysql_error());

				while($row1=mysqli_fetch_array($res1,MYSQLI_ASSOC)){
					echo "<option name=opt>".$row1["dpto_nombre"];
				}
				if($row["enf_dpto"]!="")	 echo "<option selected>".$row["enf_dpto"];
				else	 echo "<option selected>-";

				echo "</select></td></tr>";
?>
		<tr>	<td class=datal><B>Telefono:</B></td>
				<td class=datal><input type=text name=enf_telefono value="<?php echo $row["enf_telefono"];?>"></td></tr>

		<tr>	<td class=datal><B>Codigo Postal:</B></td>
				<td class=datal><input type=text name=enf_cp value="<?php echo $row["enf_cp"];?>"></td></tr>	


		<tr>	<td class=datal><B>Nro Matricula:</B></td>
				<td class=datal><input type=text name=e_mat value="<?php echo $row["e_mat"];?>"></td></tr>
		<tr>	<td class=datal><B>Vto Matricula:</B></td>
				<td class=datal>
				<?php
					sel_date("vto_month",1,12,$date[1]);
					sel_date("vto_year",2016,2025,$date[0]);
				?>
				</td></tr>

<?php  
		//$res2=mysql_select("op".date("Y"),"",)


?>
	</table>