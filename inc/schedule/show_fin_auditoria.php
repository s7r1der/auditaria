<link rel="StyleSheet" href="css/forms.css" type="text/css">


<?php
$table=(strlen($_SESSION["year_tmp"])==4?"op".$_SESSION["year_tmp"]:"op20".$_SESSION["year_tmp"]);

include("inc/schedule/schedule_func.php");

$conn=newConnect();
$res=mysqli_query($conn,"SELECT aud.aud_movilidad,aud.aud_conciencia,aud.aud_esfinteres,aud.aud_ingesta,aud.aud_heridas,aud.aud_contencion,aud.aud_zonaroja,"
						."date_format(aud.aud_date,\"%d/%m/%Y\") as op_date,CONCAT(pac.pac_apellido,' ',pac.pac_nombre) as paciente,"
						."CONCAT(pac.pac_domicilio,' ',pac.pac_dpto) as domicilio,aud.aud_evol,aud.aud_id,aud_tipo,aud_forma,"
						."aud.cant_horas,aud.aud_formato,aud.aud_regimen,date_beg,e_mat,e_mat1,"
						."date_format(date_beg,\"%d/%m/%Y\") as fecha,date_format(date_beg,\"%h:%i\") as hora,"
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
			
			echo "<td>";	
				echo "<table class=myTable-gray width=100%>";
					echo "<input type=hidden name=op_id value=\"".$_GET["op_id"]."\">";
					echo "<input type=hidden name=pac_id value=\"".$_GET["pac_id"]."\">";
					echo "<input type=hidden name=table value=".$table."cuidados>";
					echo "<input type=hidden name=fecha value=".$row["fecha"].">";
					echo "<input type=hidden name=hora value=".$row["hora"].">";
					echo "<input type=hidden name=op_formato value=".$row["aud_formato"].">";
					echo "<input type=hidden name=cant_horas value=".$row["cant_horas"].">";

						
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

		$opt="";
		echo "<tr>";
			echo "<td width=50%>";
				echo "<table class=myTable-gray width=100%>";
					echo "<tr><td align=left>";
						switch($row["aud_formato"]){
							case "fraccion": $opt=" <b><u>FRACCIONADO</u></b>";	break;
							case "corrido": $opt=" de <b><u>CORRIDO</u></b>";	break;
						}

						$opt=$opt." por <b><u>".$row["cant_horas"]." HORAS</u></b>";

						switch($row["aud_regimen"]){
							case "lunvie": $opt=$opt." de <b>LUNES A VIERNES</b>";	break;
							case "lunsab": $opt=$opt." de <b>LUNES A SABADOS</b>";	break;
							case "lunlun": $opt=$opt." de <b>LUNES A LUNES</b>";	break;
							case "cincouno": $opt=$opt." con <b>REGIMEN 5x1</b>";	break;
						}

						echo "<b><font size=5>.</font></b> El DOMICILIO se realiza ".$opt;

					echo "<tr><td align=left><hr></td></tr>";
					echo "<tr><td align=left><b><font size=5>.</font> CUIDADOR ASIGNADO: </B>";

					$conn1=newConnect();
					$res1=mysqli_query($conn1,"SELECT e_mat,enf_owner,CONCAT(enf_apellido,' ',enf_nombre,' - ',e_mat,' - ',enf_owner) as cuidador"
									." FROM enfermero where e_mat='".$row["e_mat"]."'") or die(mysqli_error($conn1));
					
					while($rw1=mysqli_fetch_array($res1,MYSQLI_ASSOC)){
						
						echo "<input type=hidden name=e_mat value=".$row["e_mat"].">";
						echo "<input type=hidden name=op_reg value=".($rw1["enf_owner"]=="SOE"?1:0).">";
						
						echo $rw1["cuidador"];
						echo "<br><b><font size=5>.</font> COMIENZA: </B>".$row["fecha"]." ".$row["hora"]." HS.";
					}
		
					echo "</td></tr>";

					echo "<tr><td align=left><hr></B></td></tr>";

					if($row["e_mat1"]!="" && $row["e_mat1"]!="-" && $row["e_mat1"]!=0){

						echo "<input type=hidden name=e_mat1 value=".$row["e_mat1"].">";

						echo "<tr><td align=left><b><font size=5>.</font> CUIDADOR ASIGNADO: </B>";

						$conn1=newConnect();
						$res1=mysqli_query($conn1,"SELECT e_mat,enf_owner,CONCAT(enf_apellido,' ',enf_nombre,' - ',e_mat,' - ',enf_owner) as cuidador"
									." FROM enfermero where e_mat='".$row["e_mat1"]."'") or die(mysqli_error($conn1));
						
							while($rw1=mysqli_fetch_array($res1,MYSQLI_ASSOC)){

								echo "<input type=hidden name=e_mat1 value=".$row["e_mat1"].">";
								echo "<input type=hidden name=op_reg1 value=".($rw1["enf_owner"]=="SOE"?1:0).">";

								echo $rw1["cuidador"];
								echo "<br><b><font size=5>.</font> COMIENZA: </B>".$row["fecha"]." 16:00 HS.";
							}

						echo "</td></tr>";
					}

						
					echo "</td></tr>";

					echo "<tr><td align=left><hr></td></tr>";

				echo "</table>";
			echo "</td>";
		echo "</tr>";
}

	echo "</table>";

echo "</form>";

?>
