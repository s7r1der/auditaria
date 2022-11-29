<link rel="StyleSheet" href="css/forms.css" type="text/css">

<TABLE width=100% border=1 class=myTable-gray align=center>

	<TR>
		<TD class=titulo><TABLE align=center>
					<TR><TD align=center><font size=5 face="Bauhaus 93" color=#66FF33><u>GRUPO SOE</u></STRONG></font></TD></TR>
					<TR><TD align=center><font size=4 face="neuropol" color=white><STRONG>HISTORIA CLINICA</STRONG></font></TD></TR></TABLE></TD>

		<TD class=titulo>
					<TABLE align=center>	<TR><TD align=center><font size=5 color=#66FF33 face="Bauhaus 93">
						<STRONG>Prestaciones de Cuidados domiciliarios</STRONG></font></TD></TR>
					<TR><TD align=center><font size=3 color=white>
						<STRONG><u>TEL:</u> (0261) 4286212  - 4238310 - 4237057 - 4934026
						<br>www.gruposoe.com.ar  -  contactenos@gruposoe.com.ar</STRONG></font></TD></TR></TABLE></TD>
		
		<TD class=titulo><TABLE border=1 align=center>	<TR><TD colspan=2>Hoja Nº</TD></TR>
					<TR><TD align=center><font color=black>	<font size=2><b>MES</b></font></TD><TD align=center>
															<font size=2><b>AÑO</b></font></TD></TR>
					<TR><TD align=center><font color=black size=2><?php echo month_toString(substr($_SESSION["fec1"],5,2));?></TD>
						<TD align=center><font color=black size=2><?php echo substr($_SESSION["fec1"],0,4);?></TD></TD></TR>
		</TABLE></TD>
	</TR>

	<tr><td colspan=3>

	<table align=center width=100% class=myTable-gray><tr><td>
			<input type=hidden name=pac_id value="<?php echo $row["pac_id"];?>">		
			<!--<center><b><u><font color=white>DATOS PERSONALES:</font></u></B><br></center>	-->
				
			<table align=left width=100%>
				<tr valign=top>
						<td width=15% align=center>
							<?php
								switch($row["pac_estado"]){
									case "ACTIVO":		echo "<img src=\"iconos/background/perfil_green.jpg\" width=69%>";	break;
									case "ALTA ENF":	echo "<img src=\"iconos/background/perfil_green.jpg\" width=69%>";	break;
									case "ALTA":		echo "<img src=\"iconos/background/perfil.jpg\" width=69%>";			break;
									case "INTERNADO":	echo "<img src=\"iconos/background/perfil_yellow.jpg\" width=69%>";	break;
									case "FALLECIDO":	echo "<img src=\"iconos/background/perfil_red.jpg\" width=69%>";		break;					
									default:				echo "<img src=\"iconos/background/perfil.jpg\" width=69%>";			break;
								}
							?>
						</td>
						
						<td>
							<table>
								<tr>	<td ><B>Domicilio:</B></td>
										<td><FONT SIZE="4" COLOR=""><I><b><?php echo $row["pac_domicilio"]." ".$row["pac_dpto"]."</b>";?></I></FONT></td></tr>
								<tr>	<td><b>Nombre y Apellido:</b></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_nombre"]." ".$row["pac_apellido"];?></I></FONT></td></tr>
								<tr>	<td><B>Telefono:</B></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_telefono"];?></I></FONT></td></tr>
								<tr>	<td><b>ID:</b></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_id"];?></I></FONT></td></tr>

							</table>
						</td>
						<td>
							<table>
								<tr>	<td><B>OS:</B></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_os"];?></I></FONT></td></tr>
								<tr>	<td><B>Nro AFIL:</B></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_afil"];?></I></FONT></td></tr>										
								<tr>	<td ><B>Estado paciente:</B></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_estado"];?></I></FONT></td></tr>
							</table>
						</td>
				</tr>				
	</table></CENTER>

	</td></tr></table>

	</td></tr>

</TABLE>	