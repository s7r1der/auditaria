<link rel="StyleSheet" href="css/forms.css" type="text/css">

<form action=<?php echo $_SERVER["PHP_SELF"]; ?> method=POST>


<TABLE width=100% border=1 align=center class=myTable-gray>

	<TR>
		<TD class=titulo><TABLE align=center>
					<TR><TD align=center><font size=6 face="Bauhaus 93" color=#66FF33><u>CUIDADOS</u></STRONG></font></TD></TR>
					<TR><TD align=center><font size=4 face="neuropol" color=white><STRONG>AGREGAR PACIENTE</STRONG></font></TD></TR></TABLE></TD>

		<TD class=titulo>
					<TABLE align=center>	<TR><TD align=center><font size=6 color=#66FF33 face="Bauhaus 93">
						<STRONG>Prestaciones de Cuidados Domiciliaria</STRONG></font></TD></TR>
					<TR><TD align=center><font size=3 color=white>
						<STRONG><u>TEL:</u> 0800 333 4321 - (0261) 4286212 
						<br>www.zerobo.com.ar  -  contactenos@zerobo.com.ar</STRONG></font></TD></TR></TABLE></TD>
		
		<TD class=titulo><TABLE border=1 align=center class=menu>
					<TR><TD colspan=3 align=center class=head>FECHA</TD></TR>
					<TR>	<TD align=center class=head><b>DIA</b></TD>
							<TD align=center class=head><b>MES</b></TD>
							<TD align=center><b>AÑO</b></TD></tr>

					<TR>	<TD align=center><font color=black size=2><?php echo date("d");?></TD>
							<TD align=center><font color=black size=2><?php echo date("m");?></TD>
							<TD align=center class=data><font color=black size=2><?php echo date("Y");?></TD></TD></TR>
		</TABLE></TD>
	</TR>

	<tr><td colspan=3>

	<table border=1 align=center width=100%><tr><td>
			<table align=left width=100%>
				<tr valign=top>
						<td width=15% align=center>
							<img src=\"iconos/background/perfil.jpg\" width=69%>
						</td>
						
						<td>
							<table>

								<tr rowspan=2>	<td rowspan=2><b>Nombre <br> Apellido:</b></td>
										<td>	<input type=text name="pac_nombre" size=21></td></tr>
								<tr>	<td>	<input type=text name="pac_apellido" size=21></td></tr>

								<tr rowspan=2>	<td rowspan=2><b>Direccion <br> Departamento:</b></td>
										<td>	<input type=text name="pac_domicilio" size=21 value="<?php echo $row["pac_nombre"];?>"></td></tr>
								<tr>	<td>	<select name=pac_dpto>	
								<?php			$res=mysqli_query($conn,"SELECT dpto_nombre FROM departamento where 1");
												while($rw=mysqli_fetch_array($res,MYSQLI_ASSOC))	echo "<option>".$rw["dpto_nombre"];
												
												echo "</select></td></tr>";
								?>

								<tr>	<td><B>Telefono:</B></td>
										<td><input type=text name="pac_telefono" size=21 value="<?php echo $row["pac_telefono"];?>"></td></tr>
								<tr>	<td><B>Telefono II:</B></td>
										<td><input type=text name="pac_dni" size=21 value="<?php echo $row["pac_dni"];?>"></td></tr>
									<tr>	<td><B>Estado paciente:</B></td>
											<td><b>ACTIVO</b></td></tr>								
							</table>
						</td>
						<td align=left>
							<table>
				
								<tr>	<td><B>OS:</B></td>
										<td>
										<?php	echo "<select name=pac_os>";


												$res=mysqli_query($conn,"SELECT os_nombre FROM os where os_estado='ACTIVO'");
												while($rw=mysqli_fetch_array($res,MYSQLI_ASSOC))	echo "<option>".$rw["os_nombre"];
													echo "<option selected>MODULO 1";
													echo "<option>MODULO 2";
													echo "<option>MODULO 3";
													echo "<option>MODULO 4";
													echo "<option>OSEP";
													echo "<option>OSPAT";
													echo "<option>ZER";
													echo "<option>ZERN";													
												echo "</select>";
										?></td></tr>

								<tr>	<td><B>Nro AFIL:</B></td>
										<td><input type=text name="pac_afil" size=14 value="<?php echo $row["pac_afil"];?>"></td></tr>


							</table>
						</td>

						<td>
							<table>
								<tr>	<td ><B>Fecha Nac:</B></td><td>
										<?php
										$fec_nac="";
										if($row["pac_fecnac"]!=""){
											$fec=explode("-",$row["pac_fecnac"]);
											sel_date("daynac",1,31,$fec[2]);
											echo " /";
											sel_date("monthnac",1,12,$fec[1]);
											echo " /";
											sel_date("yearnac",1900,2020,$fec[0]);
										}else{
											sel_date("daynac",1,31,date("d"));
											echo " /";
											sel_date("monthnac",1,12,date("m"));
											echo " /";
											sel_date("yearnac",1900,2020,date("Y"));
										}
										?></td></tr>

								<tr>	<td><B>UBICACION:</B></td>
				
										<td>	LAT: <input type=text name="ubc_lat" size=8>
												LONG: <input type=text name="ubc_lon" size=8></td></tr>";

								<tr>	<td><B>Ingr. Sistema:</B></td><td>
										<?php	echo "<b>".date("d/m/Y");?></b></td></tr>

							</table>
						</td>
				</tr>				
	</table></CENTER>

	</td></tr>
			
	<?php	if($_SESSION["type_busq"]=="insertar"){
				echo "<tr><td colspan=6 class=titulo>";
				echo "<input type=submit name=event value=Insertar>";
			}else{
				$_SESSION["pac_id_ant"]=$row["pac_id"];
				echo "<tr><td class=titulo>";
				echo "<input type=submit name=event value=Almacenar>  ";
				if($_SESSION["usr_role"]=="admin")	echo "<input type=submit name=event value=Eliminar>";
			}
	?>
					<input type=submit name=event value=Cancelar></th></tr>
		</table>
	</td></tr>
</TABLE>
</form></CENTER>
