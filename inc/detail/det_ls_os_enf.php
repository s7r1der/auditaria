<link rel="StyleSheet" href="css/forms.css" type="text/css">
<meta name=viewport content="width=device-width, initial-scale=1">
	
<?php 

$emat=explode(" - ",$_POST["e_mat"]);
$_POST["e_mat"]=$emat[1];

$dat_color="#330099";
$cont=0;

$table_in=substr($fec1,0,4);
$table_stop=substr($fec2,0,4);

$fec1_tmp=explode("-",$fec1);
$day1_tmp=explode(" ",$fec1_tmp[2]);
$fecha1=$day1_tmp[0]."/".$fec1_tmp[1]."/".$fec1_tmp[0]." ".$day1_tmp[1];

$fec2_tmp=explode("-",$fec2);
$day2_tmp=explode(" ",$fec2_tmp[2]);
$fecha2=$day2_tmp[0]."/".$fec2_tmp[1]."/".$fec2_tmp[0]." ".$day2_tmp[1];

$tmp=($emat[1]=="*"?"enf_estado='ACTIVO'":"e_mat='".$emat[1]."'");

$qry_tmp="SELECT CONCAT(enf_nombre,' ',enf_apellido) as nombre,e_mat,enf_owner FROM enfermero WHERE ".$tmp." ORDER BY enf_apellido";

$conn=newConnect();
$res2=mysqli_query($conn,$qry_tmp);

while($row=mysqli_fetch_array($res2,MYSQLI_ASSOC)){
	$tot=0;

	echo "<table class=myTable-gray align=center width=95%>";

		echo "<tr><td class=titulo colspan=8>".strtoupper($row["nombre"])."(".$row["e_mat"].") - ".$row["enf_owner"]."</td></tr>";
		
		echo "<TR>";	
			echo "<td colspan=2 align=right>Prestaciones de pacientes desde </td>";
			echo "<td colspan=2 align=center class=bold>".$fecha1."</td>";
			echo "<td align=center> hasta </td>";
			echo "<td colspan=2 class=bold>".$fecha2."</td>";
		echo "</tr>";

		echo"<tr>";
			echo "<td class=subtitulo><b>N°</b></td>";			
			echo "<td class=subtitulo><b>DOMICILIO</b></td>";
			echo "<td class=subtitulo><b>PACIENTE</b></td>";
			echo "<td class=subtitulo><b>TELEFONO</b></td>";
			echo "<td class=subtitulo><b>OBRA SOCIAL</b></td>";
			echo "<td class=subtitulo><b>NRO AFIL</b></td>";			
			echo "<td class=subtitulo><b>CANTIDAD</b></td>";
			echo "<td class=subtitulo><b>TOTAL HORAS</b></td>";
			echo "<td class=subtitulo><b>ESTADO PLANILLA</b></td>";
		echo "</tr>";

	for($i=$table_in;$i<=$table_stop;$i++){

		$qr="SELECT op.pac_id, pac.pac_os, op.op_prestacion, pac.pac_domicilio, pac.pac_dpto, pac.pac_telefono,pac.pac_afil,"
				." pac.pac_apellido, pac.pac_nombre, count(  *  ) as cont , sum(op.cant_horas) as sum1"
				." FROM op".$i."cuidados op left join paciente pac on op.pac_id=pac.pac_id"
				." WHERE op.op_date BETWEEN '".$fec1."' AND '".$fec2."'"// AND pac_os='".$_POST["os"]."'"
				." AND op.op_coseg<=0"
				." AND op.op_prestacion!='NO CORRESPONDE' AND op.op_prestacion!='Visita s/coseg' AND op.op_prestacion!='NC x cambio modulo'"
				." AND op.op_prestacion!='AUDITORIA ENFERMERIA' AND op.op_prestacion!='FALTA SIN AVISO'"
				." AND op.op_prestacion!='Entrega Aspirador' AND op.op_prestacion!='Retiro Aspirador'"
				." AND op.e_mat='".$row["e_mat"]."'"
				." GROUP BY op.pac_id order by pac.pac_os,pac.pac_domicilio";

		$conn1=newConnect();
		$res=mysqli_query($conn1,$qr)or die(mysqli_error($conn));	

		$cant=0;																																				
		$tot=0;

		while($row1=mysqli_fetch_array($res,MYSQLI_ASSOC)){

			$cont++;		
			echo "<tr>";
				$dt1=split_date($fec1);
				$dt2=split_date($fec2);

				echo "<td>".$cont."</td>";

				if($_SESSION["usr_role"]!="enf"){
						echo "<td align=left><a href=".$_SERVER["PHP_SELF"]."?event=viewdetxos"."&pac_id=".$row1["pac_id"]
																				."&fec_beg=".$dt1["year"]."-".$dt1["month"]."-".$dt1["day"]
																				."&fec_fin=".$dt2["year"]."-".$dt2["month"]."-".$dt2["day"]
																				."&e_mat_tmp=".$_POST["e_mat"]
																				." title=\"Ver Detalle x paciente\">"

								."<font color=black>".$row1["pac_domicilio"]." - ".$row1["pac_dpto"]."</a>"

								."<a href=".$_SERVER["PHP_SELF"]."?event=det_lst_sh_hc"."&pac_id=".$row1["pac_id"]
																				."&fec_beg=".$dt1["year"]."-".$dt1["month"]."-".$dt1["day"]
																				."&fec_fin=".$dt2["year"]."-".$dt2["month"]."-".$dt2["day"]
																				." title=\"Ver Historia Clinica\">"
								."<font color=black> - ".$row1["pac_dpto"]."</a></td>";

				}elseif($_SESSION["usr_role"]=="enf"){
						echo "<td align=left><font color=black>".$row1["pac_domicilio"]." - ".$row1["pac_dpto"]."</font></td>";
				}
				
					echo "<td class=head2 align=left>".$row1["pac_nombre"]." ".$row1["pac_apellido"]."</td>";

					echo "<td class=head2>".$row1["pac_telefono"]."</td>";
					echo "<td class=head2 align=left>".$row1["pac_os"]."</td>";
					echo "<td class=head2 align=left>".($row1["pac_afil"]==""?"<font color=red><b>COMPLETAR</b></font>":$row1["pac_afil"])."</td>";
					echo "<td class=head2>".$row1["cont"]."</td>";
					echo "<td class=head2>".$row1["sum1"]."</td>";

				$cant=$cant+$row1["cont"];
				$tot=$tot+$row1["sum1"];
			echo "</tr>";
		}
	}

	echo "<tr><td class=titulo colspan=7>TOTAL</td><td class=titulo>".$tot."</td></tr>";
	echo "</table>";

	echo "<p align=left><br><br>";
	echo "<font size=3>";

	echo "<b>FECHA: ".date("d-m-Y")."</b><br><br>";
	echo "<b>PERIODO: </b> desde <b>".$fecha1."</b> hasta <b>".$fecha2."</b><br>";
	echo "<br><br><b>FIRMA CUIDADOR: </b>.......................";
	echo "         FIRMA RECEPCION: </b>......................";
	echo "			FIRMA REVISION: </b>......................<br>";
	echo "<br><b> ESTAS PLANILLAS SERAN SUJETAS A REVISION POR PARTE DE LA ADMINISTRACION, PARA LUEGO DETERMINAR LOS HONORARIOS DEL CUIDADOR DE TODAS LAS PRESTACIONES CORRECTAMENTE VERIFICADAS<b>";

	echo "</font>";
	echo "</p>";

	echo "<H1 class=SaltodePagina>";

}

?>