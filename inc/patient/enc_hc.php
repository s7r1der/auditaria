<link rel="StyleSheet" href="css/forms.css" type="text/css">

<TABLE width=100% border=1 align=center class=myTable-gray	>

	<TR><TD class=titulo>
		<TABLE align=center>
			<TR><TD align=center><font size=6 face="Bauhaus 93" color=#66FF33><u>CUIDADOS</u></STRONG></font></TD></TR>
			<TR><TD align=center><font size=4 face="neuropol" color=white><STRONG>HISTORIA CLINICA</STRONG></font></TD></TR>
		</TABLE>
	</TD>

	<TD class=titulo>
		<TABLE align=center>	<TR><TD align=center><font size=6 color=#66FF33 face="Bauhaus 93">
			<STRONG>Prestaciones de Cuidados Domiciliarios</STRONG></font></TD></TR>
				<TR><TD align=center><font size=3 color=white>
					<STRONG><u>TEL:</u> 0800 333 4321 - (0261) 4286212 
					<br>www.zerobo.com.ar  -  contactenos@zerobo.com.ar</STRONG></font></TD></TR></TABLE></TD>
		
	<TD class=titulo>
		<TABLE border=1 align=center>	<TR><TD colspan=2>Hoja Nº</TD></TR>
			<TR><TD colspan=2><font size=2 color=black>FECHA INGRESO</TD></TR>
			<TR><TD align=center><font color=black>	<font size=2><b>MES</b></font></TD><TD align=center>
																	<font size=2><b>AÑO</b></font></TD></TR>
			<TR><TD align=center><font color=black size=2><?php echo month_toString(substr($_SESSION["fec1"],5,2));?></TD>
			<TD align=center><font color=black size=2><?php echo substr($_SESSION["fec1"],0,4);?></TD></TR>
		</TABLE>
	</TD></TR>

	<tr><td colspan=3>

		<table border=1 align=center width=100% class=myTable-gray><tr><td>
			<input type=hidden name=pac_id value="<?php echo $row["pac_id"];?>">		
			<!--<center><b><u><font color=white>DATOS PERSONALES:</font></u></B><br></center>	-->
				
			<table align=left width=100%>
				<tr valign=top>
						<td width=15% align=center>
							<?php

							if($_SESSION["usr_role"]!="sema")
								echo "<a href=".$_SERVER["PHP_SELF"]."?event=show_dat_pac"
									."&pac_id=".$row["pac_id"].">";
							elseif($_SESSION["usr_role"]=="sema")
								echo "<a href=".$_SERVER["PHP_SELF"]."?event=show_dat_pac_sema"
									."&pac_id=".$row["pac_id"].">";
					

									switch($row["pac_estado"]){
										case "ACTIVO":		echo "<img src=\"iconos/background/perfil_green.jpg\" width=69%>";	break;
										case "BAJA":		echo "<img src=\"iconos/background/perfil.jpg\" width=69%>";		break;
										case "INTERNADO":	echo "<img src=\"iconos/background/perfil_yellow.jpg\" width=69%>";	break;
										case "FALLECIDO":	echo "<img src=\"iconos/background/perfil_red.jpg\" width=69%>";	break;					
										default:			echo "<img src=\"iconos/background/perfil.jpg\" width=69%>";	break;
									}
					
							echo "</a></td>";
							?>
						</td>
						
						<td>
							<table>
								<tr>	<td><b>Nombre y Apellido:</b></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_nombre"]." ".$row["pac_apellido"];?></I></FONT></td></tr>
								<tr>	<td ><B>Domicilio:</B></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_domicilio"]." ".$row["pac_dpto"];?></I></FONT>
										<?php
											if($_SESSION["usr_role"]=="admin")
												echo "<td align=left><a href=".$_SERVER["PHP_SELF"]."?event=sel_pac_chg_dom"."&pac_id=".$row["pac_id"]
																		." title=\"Cambiar domicilio paciente\">"
																		."<font color=black><font color=blue size=2>Cambiar</font></a>";	 ?>
										</td></tr>
								<tr>	<td><B>Telefono:</B></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_telefono"];?></I></FONT></td></tr>
								<tr>	<td><b>Telefono II:</b></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_dni"];?></I></FONT></td></tr>
								<tr>	<td ><B>Estado paciente:</B></td><td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_estado"];?></I></FONT>
										<?php
											if($_SESSION["usr_role"]=="admin")
												echo "<a href=".$_SERVER["PHP_SELF"]."?event=sel_pac_chg_state"."&pac_id=".$row["pac_id"]
																		." title=\"Cambiar Obra Social\">"
																		."<font color=black><font color=blue size=2>Cambiar</font></a>";	 ?>
										</td></tr>
									<tr>	<td ><B>ID:</B></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_id"];?></I></FONT></td></tr>
							</table>
						</td>
						<td>
							<table>
								<tr>	<td><B>OS:</B></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_os"];?></I></FONT></td></tr>
								<tr>	<td><B>Nro AFIL:</B></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_afil"];?></I></FONT></td></tr>
								<?php	
									/*echo "<tr>	<td><b>Medico Tratante:</b></td>";
									$res=mysqli_query($conn,"select * from medico where med_id='".$row["med_id"]."'") or die(mysqli_error($conn));
									if($rw=mysqli_fetch_array($res,MYSQLI_ASSOC))
												echo "<td><FONT SIZE=\"3\" COLOR=\"\"><I>".$rw["med_nombre"]." ".$rw["med_apellido"]."</I></FONT></td></tr>";*/
								?>
								<tr>	<td><B>OS ALTERNATIVA:</B></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_osalt"];?></I></FONT></td></tr>

								<!--
								<?php
								
								$cont=$prest="";
								$limit=($row["pac_os"]=="SEMA MODULO A"?30:($row["pac_os"]=="SEMA"?60:($row["pac_os"]=="SEMA MODULO C"?90:100)));
								$qry_tmp=mysqli_query($conn,"SELECT COUNT(pac_id) as cont, op_prestacion FROM op".substr($_SESSION["fec1"],0,4)."cuidados"
																			." WHERE op_date between '".$_SESSION["fec1"]."' and '".$_SESSION["fec2"]."'"
																			." AND pac_id='".$row["pac_id"]."'"
																			." GROUP BY op_prestacion") or die(mysql_error($conn));

								while($rw_tmp=mysqli_fetch_array($qry_tmp,MYSQLI_ASSOC)){
												 $prest=$prest.$rw_tmp["op_prestacion"]."(".$rw_tmp["cont"].")<br>";
												 $cont=$cont+$rw_tmp["cont"];
								}
								
								echo "<tr valign=top><td><b>PRESTACIONES:</b></td>"
										."<td><FONT SIZE=\"3\" COLOR=".($cont>$limit?"#B70F20":"black")."><I>".$prest."</I></FONT></td>";
								?>-->
									
								</tr>
							</table>
						</td>

						<td>
							<table>
								<tr>	<td ><B>Fecha Nac:</B></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_fecnac"];?></I></FONT></td></tr>
								<tr>	<td><B>Fecha Ingr Sistema:</B></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["pac_fecingr"];?></I></FONT></td></tr>
								<tr>	<td><B>
								<?php
								echo "<a href=http://maps.google.com.ar/maps?q=".$row["ubc_lat"].",".$row["ubc_lon"]
										."&num=1&vpsrc=0&ie=UTF8&t=m&z=18&iwloc=ne&ved=0CA0QpQY&sa=X&ei=e2kUT9fdMJKp8gaA5rmcAQ>UBICACION</a>";?>
										</B></td>
										<td><FONT SIZE="3" COLOR=""><I><?php echo $row["ubc_lat"].",".$row["ubc_lon"];?></I></FONT></td></tr>
							</table>
						</td>
				</tr>				
	</table></CENTER>

	</td></tr></table>

	</td></tr>

</TABLE>