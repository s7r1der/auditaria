<link rel="StyleSheet" href="css/forms.css" type="text/css">


<form action=<?php echo $_SERVER["PHP_SELF"];?> method=POST>

<?php	


$table=$_GET["table"];

$qr=mysqli_query($conn,"SELECT op.op_id,op.op_date,CONCAT(pac.pac_apellido,' ',pac.pac_nombre) as paciente,CONCAT(pac.pac_domicilio,' ',pac_dpto) as domicilio,"
						."op.op_prestacion,pac.pac_os, date_format(op.op_date, \"%d/%m/%y\ - %T \") as date"
						." FROM ".$table." op left join paciente pac on pac.pac_id=op.pac_id"
						." WHERE op_id='".$_GET["op_id"]."'") or die(mysqli_error($conn));

if($rw=mysqli_fetch_array($qr,MYSQLI_ASSOC)){

	echo "<input type=hidden name=op_id value=".$rw["op_id"].">";
	echo "<input type=hidden name=table  value=".$_GET["table"].">";

	$date=split_date($rw["op_date"]);

	$_SESSION["day_tmp"]=$date["day"];
	$_SESSION["month_tmp"]=$date["month"];
	$_SESSION["year_tmp"]=$date["year"];
	$_SESSION["ins_hora"]=$date["hr"];
	$_SESSION["ins_min"]=$date["min"];

	echo "<table class=menu-gray align=center>";
		echo "<tr><td colspan=2 class=titulo>PLANIFICAR HORARIO <br> ".$rw["date"]."</td></tr>";
		echo "<tr><td align=left><b>PACIENTE:</b></td><td align=left>".$rw["paciente"]."</td></tr>";
		echo "<tr><td align=left><b>DOMICILIO:</b></td><td align=left>".$rw["domicilio"]."</td></tr>";
		echo "<tr><td align=left><b>OBRA SOCIAL:</b></td><td align=left>".$rw["pac_os"]."</td></tr>";
		echo "<tr><td align=left><b>PRESTACION:</td><td align=left>".strtoupper($rw["op_prestacion"])."</b></td></tr>";
		echo "<tr><td colspan=2 class=titulo></td></tr>";
}
?>

		<tr>	<td align=left><font color=black><b>CADA:</font></td>
				<td align=left>
					<select name=frecuencia class=Fields>          
						<option name=opt8 selected=opt1>24
						<option name=opt2>1
						<option name=opt3>4
						<option name=opt4>6			
						<option name=opt5>8
						<option name=opt6>12
						<option name=opt8>24
						<option name=opt8>48
					</select><font color=black><b>HRS.</font>
				</td>
		</tr>

		<tr>	<td align=left><font color=black><b>DURANTE:</b></font></td>
				<td align=left>
					<select name=periodo class=Fields>
						<option name=opt1 selected=opt1>30
						<?php	for($i=1;$i<31;$i++) echo "<option name=opt".$i.">".$i; ?>
					</select><font color=black><b> DIAS</font>
				</td>
		</tr>

		<tr><td colspan=2 class=titulo></td></tr>
		<tr><td colspan=2 align=left><input type=checkbox name=sunday_planif checked><b>Sin planificar los domingos</b></td></tr>
		<tr><td colspan=2 class=titulo></td></tr>

		<tr>	<td colspan=2 align=right>
					<input type=submit name=event value=Planificar class=myButton>
					<input type=submit name=event value=Cancelar class=myButton>
				</td>
		</tr>
<!--
				<tr>	<th colspan=3 align=right><a href=<?php echo $_SERVER["PHP_SELF"]."?event=calendar"?>>
							<font color=blue size=2>Calendario</font></a></th></tr>-->
	</table>

</form></CENTER>