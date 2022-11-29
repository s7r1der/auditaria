<link rel="StyleSheet" href="css/forms.css" type="text/css">


<?php
include("inc/schedule/schedule_func.php");

$conn=newConnect();
$res=mysqli_query($conn,"SELECT aud.aud_movilidad,aud.aud_conciencia,aud.aud_esfinteres,aud.aud_ingesta,aud.aud_heridas,aud.aud_contencion,aud.aud_zonaroja,"
						."date_format(aud.aud_date,\"%d/%m/%Y\") as op_date,CONCAT(pac.pac_apellido,' ',pac.pac_nombre) as paciente,"
						."CONCAT(pac.pac_domicilio,' ',pac.pac_dpto) as domicilio,aud.aud_evol,aud.aud_id,aud_tipo,aud.aud_forma,aud.cant_horas,"
						."aud.aud_formato,aud.aud_regimen,"
						."pac.pac_telefono,pac.pac_os,pac.pac_afil,pac.pac_id"
						." from auditoria aud LEFT JOIN paciente pac ON aud.pac_id=pac.pac_id"
						." WHERE aud.op_id='".$_GET["op_id"]."'") or die(mysqli_error($conn));

echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";
	

while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){

	echo "<table class=menu-gray align=center>";

		echo "<tr>";
			echo "<td colspan=3 class=titulo>";
				echo strtoupper($row["paciente"]);
			echo "</td>";
		echo "</tr>";
		

		echo "<tr valign=top>";
			
			echo "<td colspan=2>";	
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

		echo "<tr valign=top>";
			echo "<td width=50%>";

				echo "<table class=myTable-gray width=100%>";
					
					echo "<tr><td class=subtitulo colspan=4>TIPO DE AUDITORIA</td></tr>";
					echo "<tr><td>";
						echo "<table class=myTable-gray width=100%>";
							echo "<tr><td align=center><b><u>OBJETIVO DE LA AUDITORIA</u></b></td></tr>";
							echo "<tr><td align=center>";
								$opt=($row["aud_tipo"]=="ingreso"?"1":"2");
								echo "<input type=radio name=tipo value=ingreso ".($opt==1?"checked":"").">INGRESO";								
								echo "<input type=radio name=tipo value=control ".($opt==2?"checked":"").">CONTROL";								
							echo "<br><br></td></tr>";
							echo "<tr><td class=subtitulo></td></tr>";
							
							
							echo "<tr><td align=center><b><u>FORMA DE LA AUDITORIA</u></b></td></tr>";
							echo "<tr><td align=center>";
								$opt=($row["aud_forma"]=="telefonica"?"1":"2");
								echo "<input type=radio name=forma value=telefonica ".($opt==1?"checked":"").">TELEFONICA";								
								echo "<input type=radio name=forma value=domicilio ".($opt==2?"checked":"").">DOMICILIO";								
							echo "<br><br></td></tr>";
							echo "<tr><td class=subtitulo></td></tr>";
						echo "</table>";
					echo "</td></tr>";
				echo "</table>";

				echo "<table class=myTable-gray width=100%>";
						
					echo "<tr><td class=subtitulo colspan=4>FORMA DE TRABAJO</td></tr>";
					echo "<tr><td>";
						echo "<table class=myTable-gray width=100%>";
							echo "<tr><td align=center><b><u>CANTIDAD DE HORAS</u></b></td></tr>";
							echo "<tr><td align=center>HORAS";
								echo "<select name=cant_horas>";
									for($i=1;$i<13;$i++)
										echo "<option>".$i."</option>";
									echo "<option selected>".$row["cant_horas"]."</option>";
								echo "</select>";
							echo "<br><br></td></tr>";
							echo "<tr><td class=subtitulo></td></tr>";
							
							echo "<tr><td align=center><b><u>FORMATO DE LAS HORAS</u></b></td></tr>";
							echo "<tr><td align=center>";
								$opt=($row["aud_formato"]=="Corrido"?"1":"2");
								echo "<input type=radio name=formato value=Corrido ".($opt==1?"checked":"").">CORRIDO";								
								echo "<input type=radio name=formato value=Fraccion ".($opt==2?"checked":"").">FRACCION";								
							echo "<br><br></td></tr>";
							echo "<tr><td class=subtitulo></td></tr>";
						echo "</table>";
					echo "</td></tr>";
				echo "</table>";

				echo "<table class=myTable-gray width=100%>";
					
					switch($row["aud_regimen"]){

						case "lunvie": $opt=1;	break;
						case "lunsab": $opt=2;	break;
						case "lunlun": $opt=3;	break;
						case "cincouno": $opt=4;	break;

					}

					echo "<tr><td class=subtitulo colspan=4>FRECUENCIA DEL CUIDADOR</td></tr>";
					echo "<tr><td>";
						echo "<table class=myTable-gray width=100%>";
							echo "<tr><td align=center><b><u>REGIMEN TRABAJO</u></b></td></tr>";

							echo "<tr><td align=center width>";
								echo "<input type=radio name=regimen value=lunvie ".($opt==1?"checked":"").">DE LUNES A VIERNES";
							echo "</td></tr>";

							echo "<tr><td align=center width>";
								echo "<input type=radio name=regimen value=lunsab ".($opt==2?"checked":"").">DE LUNES A SABADOS";
							echo "</td></tr>";

							echo "<tr><td align=center width>";
								echo "<input type=radio name=regimen value=lunlun ".($opt==3?"checked":"").">DE LUNES A LUNES";
							echo "</td></tr>";

							echo "<tr><td align=center width>";
								echo "<input type=radio name=regimen value=cincouno ".($opt==4?"checked":"").">REGIMEN 5 x 1";
							echo "</td></tr>";
							echo "<tr><td class=subtitulo></td></tr>";
						echo "</table>";
					echo "</td</tr>";
				echo "</table>";

			echo "</td>";

			echo "<td width=50%>";
				echo "<table class=myTable-gray width=100%>";
					echo "<tr><td class=subtitulo colspan=4>AUDITORIA</td></tr>";
					echo "<tr><td>";
						echo "<table class=myTable-gray width=100%>";
							echo "<tr><td align=center><b><u>MOVILIDAD</u></b></td></tr>";
							echo "<tr><td align=center>";
								$opt=($row["aud_movilidad"]=="deambula"?"1":($row["aud_movilidad"]=="ayuda"?"2":"3"));

								echo "<input type=radio name=movilidad value=deambula ".($opt==1?"checked":"").">Deambula";								
								echo "<input type=radio name=movilidad value=ayuda ".($opt==2?"checked":"").">con ayuda";								
								echo "<input type=radio name=movilidad value=Postrado ".($opt==3?"checked":"").">Postrado";
	
							echo "<br><br></td></tr>";
							echo "<tr><td class=subtitulo></td></tr>";
							
							echo "<tr><td align=center><b><u>CONCIENCIA</u></b></td></tr>";
							echo "<tr><td align=center width>";
								$opt=($row["aud_conciencia"]=="lucido"?"1":"2");	
								echo "<input type=radio name=conciencia value=lucido ".($opt==1?"checked":"").">LUCIDO   ";								
								echo "<input type=radio name=conciencia value=nolucido ".($opt==2?"checked":"").">NO LUCIDO";								
							echo "<br><br></td></tr>";
							echo "<tr><td class=subtitulo></td></tr>";
							
							echo "<tr><td align=center><b><u>CONTROL ESFINTERES</u></b></td></tr>";
							echo "<tr><td align=center>";
								$opt=($row["aud_esfinteres"]=="si"?"1":"2");
								echo "<input type=radio name=esfinteres value=si ".($opt==1?"checked":"").">SI";								
								echo "<input type=radio name=esfinteres value=no ".($opt==2?"checked":"").">NO";								
							echo "<br><br></td></tr>";
							echo "<tr><td class=subtitulo></td></tr>";
							
							echo "<tr><td align=center><b><u>INGESTA</u></b></td></tr>";
							echo "<tr><td align=center>";
								$opt=($row["aud_ingesta"]=="VO"?"1":"2");
								echo "<input type=radio name=ingesta value=VO ".($opt==1?"checked":"").">VO";								
								echo "<input type=radio name=ingesta value=SNG ".($opt==2?"checked":"").">SNG";								
							echo "<br><br></td></tr>";
							echo "<tr><td class=subtitulo></td></tr>";
							
							echo "<tr><td align=center><b><u>HERIDAS/ESCARAS</u></b></td></tr>";
							echo "<tr><td align=center>";
								$opt=($row["aud_heridas"]=="si"?"1":"2");
								echo "<input type=radio name=heridas value=si ".($opt==1?"checked":"").">SI";								
								echo "<input type=radio name=heridas value=no ".($opt==2?"checked":"").">NO";								
							echo "<br><br></td></tr>";
							echo "<tr><td class=subtitulo></td></tr>";
							
							echo "<tr><td align=center><b><u>CONTENCION</u></b></td></tr>";
							echo "<tr><td align=center>";
								$opt=($row["aud_contencion"]=="si"?"1":"2");
								echo "<input type=radio name=contencion value=si ".($opt==1?"checked":"").">SI";								
								echo "<input type=radio name=contencion value=no ".($opt==2?"checked":"").">NO";								
							echo "<br><br></td></tr>";
							echo "<tr><td class=subtitulo></td></tr>";
							
							echo "<tr><td align=center><b><u>ZONA ROJA</u></b></td></tr>";
							echo "<tr><td align=center>";
								$opt=($row["aud_zonaroja"]=="si"?"1":"2");
								echo "<input type=radio name=zonaroja value=si ".($opt==1?"checked":"").">SI";								
								echo "<input type=radio name=zonaroja value=no ".($opt==2?"checked":"").">NO";								
							echo "<br><br></td></tr>";
							echo "<tr><td class=titulo></td></tr>";

						echo "</table>";

					echo "</td></tr>";
				echo "</table>";
			echo "</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<tr><td class=subtitulo colspan=2>EVOLUCION</td></tr>";

			echo "<td colspan=2>";
				echo "<textarea name=evol cols=100 rows=10>".$row["aud_evol"]."</textarea>";
			echo "</td>";
		echo "</tr>";
}

		echo "<tr>";
			echo "<td colspan=6 align=center><input type=submit name=event value=\"Guardar AUDITORIA\">";
		echo "</tr>";	
	echo "</table>";
echo "</form>";
	
?>
