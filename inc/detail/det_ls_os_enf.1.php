<link rel="StyleSheet" href="css/forms.css" type="text/css">
<meta name=viewport content="width=device-width, initial-scale=1">
	
<?php 

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


$res=mysql_select("CONCAT(enf_nombre,' ',enf_apellido) as nombre,e_mat","enfermero","e_mat='".$_POST["e_mat"]."'");

if($row=mysql_fetch_array($res,MYSQL_ASSOC)){

echo "<table class=myTable-gray align=center width=95%>";

		echo "<tr><td class=titulo colspan=7>".strtoupper($row["nombre"])."(".$row["e_mat"].")</td></tr>";
		
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
		echo "</tr>";
	for($i=$table_in;$i<=$table_stop;$i++){

		$qr="SELECT pac_id, pac_os, op_prestacion, pac_domicilio, pac_dpto, pac_telefono, pac_apellido, pac_nombre, count(  *  ) as cont , sum(op_coseg) as sum1"
				." FROM op".$i
				." WHERE op_date BETWEEN '".$fec1."' AND '".$fec2."'"// AND pac_os='".$_POST["os"]."'"
				." AND op_coseg<=0"
				." AND e_mat='".$_POST["e_mat"]."'"
				." GROUP BY pac_id order by pac_os,pac_domicilio";

		$res=mysql_query($qr)or die(mysql_error());	

		$cant=0;																																				
		$tot=0;

		while($row1=mysql_fetch_array($res,MYSQL_ASSOC)){

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

								."<font color=black>".$row1["pac_domicilio"]."</a>"

								."<a href=".$_SERVER["PHP_SELF"]."?event=det_lst_sh_hc"."&pac_id=".$row1["pac_id"]
																				."&fec_beg=".$dt1["year"]."-".$dt1["month"]."-".$dt1["day"]
																				."&fec_fin=".$dt2["year"]."-".$dt2["month"]."-".$dt2["day"]
																				." title=\"Ver Historia Clinica\">"
								."<font color=black> - ".$row1["pac_dpto"]."</a></td>";
				}elseif($_SESSION["usr_role"]=="enf"){
						echo "<td align=left><font color=black>".$row1["pac_domicilio"]." - ".$row1["pac_dpto"]."</font></td>";
				}
				
				echo "<td class=head2 align=left>".$row1["pac_nombre"]." ".$row1["pac_apellido"]."</td>";

				$qr1=mysql_query("select pac_afil,pac_telefono,pac_os from paciente where pac_id='".$row1["pac_id"]."'") or die(mysql_error());

				if($row2=mysql_fetch_array($qr1,MYSQL_ASSOC)){
					echo "<td class=head2>".$row2["pac_telefono"]."</td>";
					echo "<td class=head2 align=left>".$row2["pac_os"]."</td>";
					echo "<td class=head2 align=left>".($row2["pac_afil"]==""?"<font color=red><b>COMPLETAR</b></font>":$row2["pac_afil"])."</td>";
					echo "<td class=head2>".$row1["cont"]."</td>";
				}

				$cant=$cant+$row1["cont"];
				$tot=$tot+$row1["sum1"];
			echo "</tr>";
		}
	}
}
echo "</table>";


echo "<H1 class=SaltodePagina>";

echo "<p align=left><br><br>";
echo "<font size=3>";


echo "<b>FECHA: ".date("d-m-Y")."</b><br><br>";
echo "<b>PERIODO: </b> desde <b>".$fecha1."</b> hasta <b>".$fecha2."</b><br>";
echo "<br><br><b>FIRMA ENF/EST: </b>.......................";
echo "         FIRMA RECEPCION: </b>......................";
echo "			FIRMA REVISION: </b>......................<br>";
echo "<br><b> ESTAS PLANILLAS SERAN SUJETAS A REVISION POR PARTE DE LA ADMINISTRACION DE SOE, PARA LUEGO DETERMINAR LOS HONORARIOS DEL ENFERMERO DE TODAS LAS PRESTACIONES CORRECTAMENTE VERIFICADAS<b>";

echo "<br><br><b>LA FACTURACION CORRESPONDIENTE AL PAGO DEBE SER ENTREGADA ANTES DEL 30 DE CADA MES. CASO CONTRARIO NO SE HARA LA LIQUIDACION DEL SIGUIENTE MES	</b>";



echo "</font>";
echo "</p>";

echo "<H1 class=SaltodePagina>";

//$res=mysql_select("CONCAT(enf_nombre,' ',enf_apellido) as nombre,e_mat","enfermero","e_mat='".$_POST["e_mat"]."'");
//if($row=mysql_fetch_array($res,MYSQL_ASSOC))
	
echo "<table class=myTable-gray align=center width=50%>";

	echo "<tr><td class=titulo colspan=7>".strtoupper($row["nombre"])."(".$row["e_mat"].")</td></tr>";
		
		echo "<TR>";
			echo "<td colspan=4 align=center>DESDE ";
			echo "<b>".$fecha1."</b>";
			echo " HASTA ";
			echo "<b>".$fecha2."</b></td>";
		echo "</tr>";

	echo"<tr>";
		echo "<td class=subtitulo><b>N°</b></td>";			
		echo "<td class=subtitulo colspan=2><b>PACIENTE</b></td>";
		echo "<td class=subtitulo><b>AFILIADO</b></td>";
	echo "</tr>";

	for($i=$table_in;$i<=$table_stop;$i++){

		$qr="SELECT op.pac_id,pac.pac_id,op.pac_domicilio, op.pac_dpto, op.pac_apellido, op.pac_nombre, pac.pac_afil,op.op_coseg,op.e_mat"
				." FROM op".$i." op LEFT JOIN paciente pac ON op.pac_id=pac.pac_id"
				." WHERE op_date BETWEEN '".$fec1."' AND '".$fec2."'"// AND pac_os='".$_POST["os"]."'"
				." AND op.op_coseg<=0"
				." AND op.op_prestacion!='NO CORRESPONDE' AND op.op_prestacion!='Visita s/coseg' AND op.op_prestacion!='NC x cambio modulo'"
				." AND op.op_prestacion!='AUDITORIA ENFERMERIA' AND op.op_prestacion!='FALTA SIN AVISO'"
				." AND op.op_prestacion!='Entrega Aspirador' AND op.op_prestacion!='Retiro Aspirador'"
				." AND op.e_mat='".$_POST["e_mat"]."'"
				." AND op.pac_os!='OSEP'"
				." GROUP BY op.pac_id order by op.pac_apellido";

		$res=mysql_query($qr)or die(mysql_error());	

		$cant=0;																																				
		$tot=0;
		$cont=0;

		while($row1=mysql_fetch_array($res,MYSQL_ASSOC)){

			$cont++;		
			echo "<tr>";
				$dt1=split_date($fec1);
				$dt2=split_date($fec2);

				echo "<td align=center>".$cont."</td>";
				echo "<td align=left><font color=black><b>".strtoupper($row1["pac_apellido"])."</b></font></td><td align=left>".$row1["pac_nombre"]."</font></td>";				
				echo "<td class=head2 align=left>".$row1["pac_afil"]."</td>";
			echo "</tr>";
		}
	}
	echo "</table>";

echo "<p align=left><br><br>";
echo "<font size=3>";
echo "<b>FECHA: ".date("d-m-Y")."</b><br><br>";
echo "<b>PERIODO: </b> desde <b>".$fecha1."</b> hasta <b>".$fecha2."</b></p>";


echo "<H1 class=SaltodePagina>";

//$res=mysql_select("CONCAT(enf_nombre,' ',enf_apellido) as nombre,e_mat","enfermero","e_mat='".$_POST["e_mat"]."'");
//if($row=mysql_fetch_array($res,MYSQL_ASSOC))
	
echo "<table class=myTable-gray align=center width=50%>";

	echo "<tr><td class=titulo colspan=7>".strtoupper($row["nombre"])."(".$row["e_mat"].") <BR> OSEP</td></tr>";
		
		echo "<TR>";
			echo "<td colspan=4 align=center>DESDE ";
			echo "<b>".$fecha1."</b>";
			echo " HASTA ";
			echo "<b>".$fecha2."</b></td>";
		echo "</tr>";

	echo"<tr>";
		echo "<td class=subtitulo><b>N°</b></td>";			
		echo "<td class=subtitulo colspan=2><b>PACIENTE</b></td>";
		echo "<td class=subtitulo><b>AFILIADO</b></td>";
	echo "</tr>";

	for($i=$table_in;$i<=$table_stop;$i++){

		$qr="SELECT op.pac_id,pac.pac_id,op.pac_domicilio, op.pac_dpto, op.pac_apellido, op.pac_nombre, pac.pac_afil,op.op_coseg,op.e_mat"
				." FROM op".$i." op LEFT JOIN paciente pac ON op.pac_id=pac.pac_id"
				." WHERE op_date BETWEEN '".$fec1."' AND '".$fec2."'"// AND pac_os='".$_POST["os"]."'"
				." AND op.op_coseg<=0"
				." AND op.op_prestacion!='NO CORRESPONDE' AND op.op_prestacion!='Visita s/coseg' AND op.op_prestacion!='NC x cambio modulo'"
				." AND op.op_prestacion!='AUDITORIA ENFERMERIA' AND op.op_prestacion!='FALTA SIN AVISO'"
				." AND op.op_prestacion!='Entrega Aspirador' AND op.op_prestacion!='Retiro Aspirador'"
				." AND op.e_mat='".$_POST["e_mat"]."'"
				." AND op.pac_os='OSEP'"
				." GROUP BY op.pac_id order by op.pac_apellido";

		$res=mysql_query($qr)or die(mysql_error());	

		$cant=0;																																				
		$tot=0;
		$cont=0;

		while($row1=mysql_fetch_array($res,MYSQL_ASSOC)){

			$cont++;		
			echo "<tr>";
				$dt1=split_date($fec1);
				$dt2=split_date($fec2);

				echo "<td align=center>".$cont."</td>";
				echo "<td align=left><font color=black><b>".strtoupper($row1["pac_apellido"])."</b></font></td><td align=left>".$row1["pac_nombre"]."</font></td>";				
				echo "<td class=head2 align=left>".$row1["pac_afil"]."</td>";
			echo "</tr>";
		}
	}
	echo "</table>";

echo "<p align=left><br><br>";
echo "<font size=3>";
echo "<b>FECHA: ".date("d-m-Y")."</b><br><br>";
echo "<b>PERIODO: </b> desde <b>".$fecha1."</b> hasta <b>".$fecha2."</b></p>";


//echo "</hl>";
?>