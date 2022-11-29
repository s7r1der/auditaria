<link rel="StyleSheet" href="css/forms.css" type="text/css">


<?php
include("inc/schedule/schedule_func.php");
$table=(strlen($_SESSION["year_tmp"])==4?"op".$_SESSION["year_tmp"]:"op20".$_SESSION["year_tmp"]);


$conn=newConnect();
$res=mysqli_query($conn,"SELECT pac_id,CONCAT(pac_domicilio,' ',pac_dpto) as domicilio,pac_dpto,CONCAT(pac_apellido,' ',pac_nombre) as paciente,"
					."pac_id,pac_domicilio,pac_dpto,pac_nombre,pac_apellido,pac_afil,pac_os,pac_telefono "
					."FROM paciente WHERE pac_id='".$_GET["pac_id"]."'") or die(mysqli_error($conn));

echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

	echo "<table class=menu-gray align=center>";

		echo "<tr>";
			echo "<td colspan=2 class=titulo>";
				echo $_SESSION["day_tmp"]."/".$_SESSION["month_tmp"]."/".$_SESSION["year_tmp"];
			echo "</td>";
		echo "</tr>";
		
		$formato=$cant_horas=0;

		echo "<tr valign=top>";
			
			echo "<td colspan=2>";	
				echo "<table class=myTable-gray width=100%>";

					while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		
						echo "<input type=hidden name=op_id value=\"".$_GET["op_id"]."\">";
						echo "<input type=hidden name=pac_id value=\"".$_GET["pac_id"]."\">";
						echo "<input type=hidden name=table value=".$table."cuidados>";
							
						echo "<tr><td class=subtitulo colspan=2>PACIENTE:</td></tr>";
						echo "<tr><td align=left><b>DOMICILIO: </b></td><td>".strtoupper($row["domicilio"])."</td></tr>";
						echo "<tr><td align=left><b>PACIENTE: </b></td><td>".strtoupper($row["paciente"])."</td></tr>";
						echo "<tr><td align=left><b>TELEFONO: </b></td><td>".$row["pac_telefono"]."</td></tr>";
						echo "<tr><td align=left><b>O. SOCIAL: </b></td><td>".$row["pac_os"]."</td></tr>";
						echo "<tr><td align=left><b>AFIL: </b></td><td>".$row["pac_afil"]."</td></tr>";
					}
				echo "</table>";

			echo "</td>";
		echo "</tr>";

		echo "<tr valign=top>";
				echo "<td>";

					echo "<table class=myTable-gray width=100%>";
						
						echo "<tr><td class=subtitulo colspan=4>TIPO DE AUDITORIA</td></tr>";
						echo "<tr><td>";
							echo "<table class=myTable-gray width=100%>";
								echo "<tr><td align=center><b><u>OBJETIVO DE LA AUDITORIA</u></b></td></tr>";
								echo "<tr><td align=center>";
									echo "<input type=radio name=tipo value=ingreso>INGRESO";								
									echo "<input type=radio name=tipo value=control>CONTROL";								
								echo "<br><br></td></tr>";
								echo "<tr><td class=subtitulo></td></tr>";
								
								echo "<tr><td align=center><b><u>FORMA DE LA AUDITORIA</u></b></td></tr>";
								echo "<tr><td align=center width>";
									echo "<input type=radio name=forma value=telefonica>TELEFONICA";								
									echo "<input type=radio name=forma value=domicilio>EN EL DOMICILIO";								
								echo "<br><br></td></tr>";
								echo "<tr><td class=subtitulo></td></tr>";
							echo "</table>";
						echo "</td></tr>";
					echo "</table>";

					//echo "<br>";

					echo "<table class=myTable-gray width=100%>";
						
						echo "<tr><td class=subtitulo colspan=4>FORMA DE TRABAJO</td></tr>";
						echo "<tr><td>";
							echo "<table class=myTable-gray width=100%>";
								echo "<tr><td align=center><b><u>CANTIDAD DE HORAS</u></b></td></tr>";
								echo "<tr><td align=center>HORAS";
									echo "<select name=cant_horas>";
										for($i=1;$i<13;$i++)
											echo "<option>".$i."</option>";
										echo "<option selected>".$_GET["cant_horas"]."</option>";
									echo "</select>";
								echo "<br><br></td></tr>";
								echo "<tr><td class=subtitulo></td></tr>";
								
								echo "<tr><td align=center><b><u>FORMATO DE LAS HORAS</u></b></td></tr>";
								echo "<tr><td align=center width>";
									echo "<input type=radio name=formato value=Corrido ".($_GET["op_formato"]=="Corrido"?"checked":"").">CORRIDO";
									echo "<input type=radio name=formato value=Fraccion ".($_GET["op_formato"]=="Fraccion"?"checked":"").">FRACCION";								
								echo "<br></td></tr>";
								echo "<tr><td class=subtitulo></td></tr>";
							echo "</table>";
						echo "</td></tr>";
					echo "</table>";

					echo "<table class=myTable-gray width=100%>";
						
						echo "<tr><td class=subtitulo colspan=4>FRECUENCIA DEL CUIDADOR</td></tr>";
						echo "<tr><td>";
							echo "<table class=myTable-gray width=100%>";
								echo "<tr><td align=center><b><u>REGIMEN TRABAJO</u></b></td></tr>";

								echo "<tr><td align=center width>";
									echo "<input type=radio name=regimen value=lunvie>DE LUNES A VIERNES";
								echo "</td></tr>";

								echo "<tr><td align=center width>";
									echo "<input type=radio name=regimen value=lunsab>DE LUNES A SABADOS";
								echo "</td></tr>";

								echo "<tr><td align=center width>";
									echo "<input type=radio name=regimen value=lunlun>DE LUNES A LUNES";
								echo "</td></tr>";

								echo "<tr><td align=center width>";
									echo "<input type=radio name=regimen value=cincouno>REGIMEN 5 x 1";
								echo "</td></tr>";
								echo "<tr><td class=subtitulo></td></tr>";
							echo "</table>";
						echo "</td</tr>";
					echo "</table>";

				echo "</td>";

				echo "<td width=50%>";
					echo "<table class=myTable-gray width=100%>";
						echo "<tr><td class=subtitulo colspan=4>AUDITORIA</td></tr>";
						
						echo "<tr><td class=titulo></td></tr>";
						echo "<tr><td>";
							echo "<table class=myTable-gray width=100%>";
								echo "<tr><td align=center><b><u>MOVILIDAD</u></b></td></tr>";
								echo "<tr><td align=center>";
									echo "<input type=radio name=movilidad value=deambula>Deambula";								
									echo "<input type=radio name=movilidad value=ayuda>con ayuda";								
									echo "<input type=radio name=movilidad value=Postrado>Postrado";								
								echo "<br><br></td></tr>";
								echo "<tr><td class=subtitulo></td></tr>";
								
								echo "<tr><td align=center><b><u>CONCIENCIA</u></b></td></tr>";
								echo "<tr><td align=center width>";
									echo "<input type=radio name=conciencia value=lucido>LUCIDO   ";								
									echo "<input type=radio name=conciencia value=nolucido>NO LUCIDO";								
								echo "<br><br></td></tr>";
								echo "<tr><td class=subtitulo></td></tr>";
								
								echo "<tr><td align=center><b><u>CONTROL ESFINTERES</u></b></td></tr>";
								echo "<tr><td align=center>";
									echo "<input type=radio name=esfinteres value=si>SI";								
									echo "<input type=radio name=esfinteres value=no>NO";								
								echo "<br><br></td></tr>";
								echo "<tr><td class=subtitulo></td></tr>";
								
								echo "<tr><td align=center><b><u>INGESTA</u></b></td></tr>";
								echo "<tr><td align=center>";
									echo "<input type=radio name=ingesta value=VO>VO";								
									echo "<input type=radio name=ingesta value=SNG>SNG";								
								echo "<br><br></td></tr>";
								echo "<tr><td class=subtitulo></td></tr>";
								
								echo "<tr><td align=center><b><u>HERIDAS/ESCARAS</u></b></td></tr>";
								echo "<tr><td align=center>";
									echo "<input type=radio name=heridas value=si>SI";								
									echo "<input type=radio name=heridas value=no>NO";								
								echo "<br><br></td></tr>";
								echo "<tr><td class=subtitulo></td></tr>";
								
								echo "<tr><td align=center><b><u>CONTENCION</u></b></td></tr>";
								echo "<tr><td align=center>";
									echo "<input type=radio name=contencion value=si>SI";								
									echo "<input type=radio name=contencion value=no>NO";								
								echo "<br><br></td></tr>";
								echo "<tr><td class=subtitulo></td></tr>";
								
								echo "<tr><td align=center><b><u>ZONA ROJA</u></b></td></tr>";
								echo "<tr><td align=center>";
									echo "<input type=radio name=zonaroja value=si>SI";								
									echo "<input type=radio name=zonaroja value=no>NO";								
								echo "<br><br></td></tr>";
								echo "<tr><td class=titulo></td></tr>";

							echo "</table>";

						echo "</td>";
					echo "</tr>";
				echo "</table>";
			echo "</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<tr><td class=subtitulo colspan=2>EVOLUCION</td></tr>";

			echo "<td colspan=2>";
				echo "<textarea name=evol cols=100 rows=10></textarea>";
			echo "</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td colspan=6 class=titulo align=center><input type=submit name=event value=\"Agregar AUDITORIA\">";
		echo "</tr>";	
	echo "</table>";
echo "</form>";
	
?>
