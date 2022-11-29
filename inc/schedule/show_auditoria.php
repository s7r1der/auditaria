<link rel="StyleSheet" href="css/forms.css" type="text/css">


<?php
include("inc/schedule/schedule_func.php");

$conn=newConnect();
$res=mysqli_query($conn,"SELECT aud.aud_movilidad,aud.aud_conciencia,aud.aud_esfinteres,aud.aud_ingesta,aud.aud_heridas,aud.aud_contencion,aud.aud_zonaroja,"
						."date_format(aud.aud_date,\"%d/%m/%Y\") as op_date,CONCAT(pac.pac_apellido,' ',pac.pac_nombre) as paciente,"
						."CONCAT(pac.pac_domicilio,' ',pac.pac_dpto) as domicilio,aud.aud_evol,aud.aud_id,aud_tipo,aud_forma,"
						."aud.cant_horas,aud.aud_formato,aud.aud_regimen,"
						."pac.pac_telefono,pac.pac_os,pac.pac_afil,pac.pac_id"
						." from auditoria aud LEFT JOIN paciente pac ON aud.pac_id=pac.pac_id"
						." WHERE aud.op_id='".$_GET["op_id"]."'") or die(mysqli_error($conn));

while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){

	echo "<table class=menu-gray align=center>";

		echo "<tr>";
			echo "<td colspan=3 class=titulo>";
				echo strtoupper($row["paciente"]);
			echo "</td>";
		echo "</tr>";
		

		echo "<tr valign=top>";
			
			echo "<td>";	
				echo "<table class=myTable-gray width=100%>";
					echo "<input type=hidden name=op_id value=\"".$_GET["op_id"]."\">";
					echo "<input type=hidden name=table value=op20".$_SESSION["year_tmp"]."cuidados>";
					echo "<input type=hidden name=aud_id value=\"".$row["aud_id"]."\">";
						
					echo "<tr><td class=subtitulo colspan=2>DATOS PERSONALES:</td></tr>";
					echo "<tr><td align=left><b>NRO AUDITORIA: </b></td><td>".$_GET["op_id"]."</td></tr>";
					echo "<tr><td align=left><b>FECHA: </b></td><td>".$row["op_date"]."</td></tr>";
					echo "<tr><td align=left><b>DOMICILIO: </b></td><td>".$row["domicilio"]."</td></tr>";
					echo "<tr><td align=left><b>TELEFONO: </b></td><td>".$row["pac_telefono"]."</td></tr>";
					echo "<tr><td align=left><b>O. SOCIAL: </b></td><td>".$row["pac_os"]."</td></tr>";
					echo "<tr><td align=left><b>AFIL: </b></td><td>".$row["pac_afil"]."</td></tr>";
				echo "</table>";
			echo "</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td width=50%>";
				echo "<table class=myTable-gray width=100%>";
					echo "<tr><td class=subtitulo colspan=4>AUDITORIA</td></tr>";
					echo "<tr><td>";
						echo "<table class=myTable-gray width=100%>";
							echo "<tr><td align=left>";
								$opt=($row["aud_tipo"]=="ingreso"?"1":"2");
								
								switch($opt){
									case 1:	echo "<b><font size=6>.</font></b>"
										." La AUDITORIA Se realizo para dar <b><u>INGRESO</u></b> al paciente a CUIDADOS DOMICILIARIOS.";	break;
									case 2:	echo "<b><font size=6>.</font></b>"
										." La AUDITORIA se realizo para realizar <b><u>CONTROL</u></b> del paciente de CUIDADOS DOMICILIARIOS.";	break;
								}
								
							echo "<br>";
								$opt=($row["aud_forma"]=="telefonica"?"1":"2");
								
								switch($opt){
									case 1:	echo "<b><font size=6>.</font></b> La AUDITORIA se realizo en forma <b><u>TELEFONICA</u></b>";	break;
									case 2:	echo "<b><font size=6>.</font></b> La AUDITORIA se realizo en el <b><u>DOMICILIO</u></b> del paciente.";	break;
								}

							echo "<br>";

								switch($row["aud_formato"]){
									case "Fraccion": $opt=" <b><u>FRACCIONADO</u></b>";	break;
									case "Corrido": $opt=" de <b><u>CORRIDO</u></b>";	break;
								}

								$opt=$opt." por <b><u>".$row["cant_horas"]." HORAS</u></b>";

								switch($row["aud_regimen"]){
									case "lunvie": $opt=$opt." de <b>LUNES A VIERNES</b>";	break;
									case "lunsab": $opt=$opt." de <b>LUNES A SABADOS</b>";	break;
									case "lunlun": $opt=$opt." de <b>LUNES A LUNES</b>";	break;
									case "cincouno": $opt=$opt." con <b>REGIMEN 5x1</b>";	break;
								}

								echo "<b><font size=6>.</font></b> El DOMICILIO se realiza ".$opt;
								
							echo "<br><br></td></tr>";

							echo "<tr><td align=left><hr></td></tr>";
							echo "<tr><td align=left class=subtitulo>CARACTERISTICAS DEL DOMICILIO</td></tr>";

							echo "<tr><td align=left>";
								$opt=($row["aud_movilidad"]=="deambula"?"1":($row["aud_movilidad"]=="ayuda"?"2":"3"));
								
								switch($opt){
									case 1:	echo "<b><font size=6>.</font><u>MOVILIDAD</u>:</b> El paciente se <b>DEAMBULA</b> con normalidad.";	break;
									case 2:	echo "<b><font size=6>.</font><u>MOVILIDAD</u>:</b> El paciente se moviliza <b>CON AYUDA.</b>";		break;
									case 3:	echo "<b><font size=6>.</font><u>MOVILIDAD</u>:</b> El paciente se encuentra <b>POSTRADO.</b>";		break;
								}
								
							echo "<br></td></tr>";
							
							echo "<tr><td align=left>";
								$opt=($row["aud_conciencia"]=="lucido"?"1":"2");	

								switch($opt){
									case 1:	
										echo "<b><font size=6>.</font><u>CONCIENCIA</u>:</b> El paciente <b>SE ENCUENTRA CONCIENTE</b> en tiempo y espacio.";	
										break;
									case 2:	echo "<b><font size=6>.</font><u>CONCIENCIA</u>:</b> El paciente <b>NO</b> se encuenta conciente.";		break;	
								}

							echo "<br></td></tr>";
							
							echo "<tr><td align=left>";
								$opt=($row["aud_esfinteres"]=="si"?"1":"2");

								switch($opt){
									case 1:	echo "<b><font size=6>.</font><u>CONTROL DE ESFINTERES</u>:</b> El paciente <b>CONTROLA ESFINTERES.</b>";	break;
									case 2:	echo "<b><font size=6>.</font><u>CONTROL DE ESFINTERES</u>:</b> El paciente <b>NO</b> controla ESFINTERES.";	break;	
								}
							echo "<br></td></tr>";
							
							echo "<tr><td align=left>";
								$opt=($row["aud_ingesta"]=="VO"?"1":"2");
								switch($opt){
									case 1:	echo "<b><font size=6>.</font><u>INGESTA</u>:</b> El paciente realiza su ingesta <b>VIA ORAL.</b>";	break;
									case 2:	echo "<b><font size=6>.</font><u>INGESTA</u>:</b> El paciente realiza su ingesta <b>POR MEDIO SONDA NASOGASTRICA.</b>";		break;	
								}
							echo "<br></td></tr>";
							
							echo "<tr><td align=left>";
								$opt=($row["aud_heridas"]=="si"?"1":"2");
								switch($opt){
									case 1:	echo "<b><font size=6>.</font><u>HERIDAS/ESCARAS</u>:</b> El paciente presenta <b>HERIDAS/ESCARAS</b>.";	break;
									case 2:	echo "<b><font size=6>.</font><u>HERIDAS/ESCARAS</u>:</b> El paciente <b>NO</b> presenta HERIDAS/ESCARAS.";		break;	
								}							
							echo "<br></td></tr>";
							
							echo "<tr><td align=left>";
								$opt=($row["aud_contencion"]=="si"?"1":"2");
								switch($opt){
									case 1:	echo "<b><font size=6>.</font><u>CONTENCION</u>:</b> El paciente tiene <b>CONTENCION FAMILIAR</b>.";	break;
									case 2:	echo "<b><font size=6>.</font><u>CONTENCION</u>:</b> El paciente <b>NO</b> tiene CONTENCION FAMILIAR.";		break;	
								}							
							echo "<br></td></tr>";
							
							echo "<tr><td align=left>";
								$opt=($row["aud_zonaroja"]=="si"?"1":"2");
								switch($opt){
									case 1:	echo "<b><font size=6>.</font><u>ZONA ROJA</u>:</b> El paciente vive en <b>ZONA ROJA</b>.";	break;
									case 2:	echo "<b><font size=6>.</font><u>ZONA ROJA</u>:</b> El paciente <b>NO</b> vive en ZONA ROJA."; break;	
								}							
							echo "<br><br></td></tr>";

							echo "<tr><td align=left><hr></td></tr>";
							echo "<tr><td align=left class=subtitulo>EVOLUCION</td></tr>";
								echo "<tr><td align=left>";
								echo "<font size=4	>".strtoupper($row["aud_evol"])."</font>";
							echo "<br><br></td></tr>";


						echo "</table>";

					echo "</td></tr>";
				echo "</table>";
			echo "</td>";
		echo "</tr>";
}

	echo "</table>";

?>
