<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php 	
	if(isset($_GET["fec_hora"])){
		$_SESSION["ins_hora"]=$_GET["fec_hora"];
	}		
?>

<table align=center><tr><td>

<CENTER><form action=<?php echo $_SERVER["PHP_SELF"];?> method=POST>

	<input type=hidden name=ubic value=<?php echo $_GET["ubic"];?>>

	<table class=menu-gray>
		<tr><td class=titulo colspan=4><b>BUSCAR DATOS</b></td>
		<tr><td class=separador colspan=4></td><td>
		<tr>	<td><b>Buscar Por:</b></td>
				<td><select name=busqueda>
					<option name=opt1>Nro Identedif
					<option name=opt1>Nro AFIL
					<option name=opt1>Apellido
					<option name=opt2>Departamento
					<option name=opt3 selected=opt3>Domicilio				
					<option name=opt4>Telefono
					<option name=opt5>Nombre
					<option name=opt6>Obra Social
					<?php if($_SESSION["type_busq"]=="enfermero") echo"<option name=opt7 selected>Matricula";?>
				</select></td>
				<td><b>Dato:</b></td><td><input class=Fields type=text name=dato></td></tr>

		<tr>	<td colspan=3></td>
				<td><p align=right><input type="submit" class=myButton name="event" value="Buscar"></p></td>
		</tr>
		<tr><td class=separador colspan=4></td><td>
	</table>
	</tr></td></table>
</form></CENTER>