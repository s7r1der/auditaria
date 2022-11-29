<link rel="StyleSheet" href="css/forms.css" type="text/css">


<?php
include("inc/schedule/schedule_func.php");

$conn=newConnect();
$res=mysqli_query($conn,"SELECT pac_id,CONCAT(pac_domicilio,' ',pac_dpto) as domicilio,pac_dpto,CONCAT(pac_apellido,' ',pac_nombre) as paciente,"
					."pac_id,pac_domicilio,pac_dpto,pac_nombre,pac_apellido,pac_afil,pac_os,pac_telefono "
					."FROM paciente WHERE pac_id='".$_POST["pac_id"]."'") or die(mysqli_error($conn));

echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

	echo "<table class=menu-gray align=center>";

		echo "<tr>";
			echo "<td colspan=3 class=titulo>";
				echo $_SESSION["day_tmp"]."/".$_SESSION["month_tmp"]."/".$_SESSION["year_tmp"];
			echo "</td>";
		echo "</tr>";
		

		echo "<tr valign=top>";
			
			echo "<td>";	
				echo "<table class=menu>";

					while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		
						echo "<input type=hidden name=pac_telefono value=\"".$row["pac_telefono"]."\">";
						echo "<input type=hidden name=pac_apellido value=\"".$row["pac_apellido"]."\">";
						echo "<input type=hidden name=pac_nombre value=\"".$row["pac_nombre"]."\">";
						echo "<input type=hidden name=pac_dpto value=\"".$row["pac_dpto"]."\">";
						echo "<input type=hidden name=pac_domicilio value=\"".$row["pac_domicilio"]."\">";
						echo "<input type=hidden name=pac_os value=\"".$row["pac_os"]."\">";

						echo "<input type=hidden name=op_prestacion value=\"".$_POST["op_prestacion"]."\">";
						echo "<input type=hidden name=cant_horas value=\"".$_POST["cant_horas"]."\">";
						echo "<input type=hidden name=op_formato value=\"".$_POST["formato"]."\">";
						echo "<input type=hidden name=pac_id value=\"".$row["pac_id"]."\">";
						echo "<input type=hidden name=zona_desc value=".urlencode(det_zona($row["pac_dpto"])).">";
							
						$enfermero=posibles_cuidadores($row["pac_dpto"],$_POST["op_prestacion"],"AP",0,1);

						echo "<tr><td class=subtitulo>SISTEMA:</td></tr>";
					
						$sys=type_user($_SESSION["user"]);
						$color=($sys==1?"blue":"green");
	
						echo "<tr>"; 
						echo "<td align=center><b><font size=4 color=".$color.">".($sys==1?"SOE":"COOPERATIVA")."</font></b></td>";
						echo "</tr>";

						echo "<tr><td class=subtitulo>PACIENTE:</td></tr>";
						echo "<tr><td align=left><b>DOMICILIO: </b>".$row["domicilio"]."</td></tr>";
						echo "<tr><td align=left><b>PACIENTE: </b>".$row["paciente"]."</td></tr>";
					}
						echo "<tr><td class=subtitulo>PRESTACIONES:</td></tr>";
						echo "<tr><td align=left><b>".$_POST["op_prestacion"]." x <u>".$_POST["cant_horas"]."HS.</u>  ( ".strtoupper($_POST["formato"])." )</b></td></tr>";
	
						echo "<tr><td class=subtitulo>MATRICULA:</td></tr>";
						
						$own_ant="COOP";
						echo "<tr><td align=left>";
							echo "<select name=e_mat class=fields>";
								echo "<option disabled>AM----------------------------------";
								
								foreach($enfermero as $enf_tmp){
									
									$enf=explode("-",$enf_tmp);

									/*if($turno_ant!=$enf[2]){
										$turno_ant=$enf[2];
										echo "<option disabled>".($turno_ant=="AP"?"AMBOS":$turno_ant)."----------------------------------";
										}*/
									
									echo "<option name=opt>".$enf[1]." - ".$enf[0];
								}
								echo "<option selected>4444";
							echo "</select>";
						echo "</td></tr>";				
					
						echo "<tr valign=top>";
							echo "<td colspan=3>";
								echo "<table width=100%>";
									echo "<tr><td class=subtitulo>OPCIONES</td></tr>";
									
									echo "<tr><td align=right>";
					   	 				echo "<input type=\"submit\" class=myButton name=\"event\" value=\"Asignar\">";
										echo "<input type=\"submit\" class=myButton name=\"event\" value=\"Cancelar\">";
									echo "</td></tr>";
									
									echo "<tr><td class=subtitulo></td></tr>";
								echo "</table>";
							echo "</td>";
						echo "</tr>";
				echo "</table>";
			echo "</td>";

			echo "<td>";
				echo "<table class=menu>";
					echo "<tr><td class=subtitulo colspan=4>CUIDADORES COOPERATIVA</td></tr>";

					$cont=0;

					$own_ant="COOP";
					foreach($enfermero as $enf_tmp){
						$enf=explode("-",$enf_tmp);
						
						if($enf[1]!="4444" && ($enf[1]>10000 || $enf[1]<9000)){
							echo "<tr>"; 
								echo "<td align=left>".strtoupper($enf[0])."</td>";
								echo "<td><b>".$enf[1]."</b></td>";
								echo "<td>".$enf[2]."</td>";
							echo "</tr>";
						}

						if($own_ant!=$enf[2]){
							$cont=0;
							$own_ant=$enf[2];
							echo "</table>";
							echo "<td>";
								echo "<table class=menu>";
									echo "<tr><td class=subtitulo colspan=4>CUIDADORES ".$enf[2]."</td></tr>";
						}
						$cont++;
			}	
				echo "</table>";
			echo "</td>";
		echo "</tr>";
	echo	"</table>";
echo "</form>";
	
?>
