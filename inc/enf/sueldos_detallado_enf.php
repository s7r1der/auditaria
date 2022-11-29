<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

function det_coseg_liq($cant,$emat,$role,$prest,$os){

	//echo $os;

	if($os=="MODULO 1" ||$os=="MODULO 2"||$os=="MODULO 3"||$os=="MODULO 4"){

		switch ($role) {

			case 'CUID':
				switch ($prest) {
					case 'NO CORRESPONDE':
					case 'NC x cambio modulo':
					case 'Pasa a SEMA':
					case 'FALTA SIN AVISO':
					case 'INICIA MAÑANA':
					case 'SUSPENDIDO DE MOMENTO':
					case 'Visita s/coseg':
						return 0;
						break;

					default:
						return $cant*120;
						break;
				}
		}

	}elseif($os=="OSEP" || $os=="SEMA JUDIC"){
		switch ($role) {

			case 'CUID':
				switch ($prest) {
					case 'NO CORRESPONDE':
					case 'NC x cambio modulo':
					case 'Pasa a SEMA':
					case 'FALTA SIN AVISO':
					case 'INICIA MAÑANA':
					case 'SUSPENDIDO DE MOMENTO':
					case 'Visita s/coseg':
						return 0;
						break;

					default:
						return $cant*180;
						break;
				}
		}

	}
}

#cc_reclamos@samsungargentina.com
$fech1=$_GET["year"]."-".$_GET["month"]."-01 00:00:00";	
$fech2=$_GET["year"]."-".$_GET["month"]."-31 23:59:59";
$table="op".$_GET["year"]."cuidados";

$conn=newConnect();
$res=mysqli_query($conn,"select e_mat from enfermero where 1") or die(mysqli_error($conn));

while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
	$prest_cat1[$row["e_mat"]]=0;
	$prest_cat2[$row["e_mat"]]=0;
	$sub[$row["e_mat"]]=0;
}


$date1=split_date($fech1);
$date2=split_date($fech2);

$sumtot=0;
$role="";
$cont=1;
$cant=0;

$conn=newConnect();
$query_in=mysqli_query($conn,"select op.pac_id,pac.pac_os,op.pac_id,op.e_mat,count(op.op_id) as cant,sum(op.cant_horas) as suma,"
					."op.op_prestacion,enf.enf_role,CONCAT(enf.enf_apellido,' ',enf.enf_nombre) as enfermero"
					." FROM ".$table." op left join paciente pac on op.pac_id=pac.pac_id LEFT JOIN enfermero enf on op.e_mat=enf.e_mat"
					." where op.op_date between '".$fech1."' and '".$fech2."'"
					." AND op.e_mat='".$_GET["e_mat"]."'"
					." GROUP BY pac.pac_os,op.op_prestacion"
					." ORDER BY pac.pac_os,op.op_prestacion") or die(mysqli_error($conn));

echo "<table class=myTable-gray align=center width=70%>";
	echo "<tr><td colspan=11 class=titulo>HONORARIOS</td></tr>";

	echo "<tr>";
		echo "<td colspan=2 class=subtitulo>DESDE</td>";
		echo "<td colspan=1 class=><b>".$date1["day"]."/".$date1["month"]."/".$date1["year"]."</b></td>";
		echo "<td colspan=1 class=subtitulo><b>HASTA:</b></td>";
		echo "<td colspan=7 class=><b>".$date2["day"]."/".$date2["month"]."/".$date2["year"]."</b></td>";
	echo "</tr>";

	echo "<tr><td colspan=11 class=titulo>CUIDADOR</td></tr>";

	echo "<tr>";
		echo "<td class=subtitulo><b>Nro</b></td>";
		echo "<td class=subtitulo><b>ENFERMERO</b></td>";
		echo "<td class=subtitulo><b>MATRICULA</b></td>";
		echo "<td class=subtitulo><b>PRESTACIONES</b></td>";
		echo "<td class=subtitulo><b>OS</b></td>";
		echo "<td class=subtitulo><b>Cant</b></td>";
		echo "<td class=subtitulo><b>Pr. Unid</b></td>";
		echo "<td class=subtitulo><b>SUBTOTAL</b></td>";
		echo "<td class=subtitulo><b>ACUMULADA</b></td>";
	echo "</tr>";	

	$cont=1;


while($rw1=mysqli_fetch_array($query_in,MYSQLI_ASSOC)){
		
	$parc=det_coseg_liq($rw1["suma"],$rw1["e_mat"],$rw1["enf_role"],$rw1["op_prestacion"],$rw1["pac_os"]);

	$sub[$rw1["e_mat"]]=$sub[$rw1["e_mat"]]+$parc;

	$sumtot=$sumtot+$parc;

	echo "<tr>"
			."<td>".$cont."</td>"
			."<td align=left>".strtoupper($rw1["enfermero"])."</td>"
			."<td>".$rw1["e_mat"]."</td>"
			."<td align=left>".$rw1["op_prestacion"]."</td>"
			."<td align=left>".$rw1["pac_os"]."</td>"
			."<td align=center>".$rw1["suma"]."</td>"
			."<td align=center>".($parc/$rw1["suma"])."</td>"
			."<td align=center>".$parc."</td>"
			."<td align=center>".$sub[$rw1["e_mat"]]."</td>";
	echo "</tr>";

	$cont++;
	if($rw1["op_prestacion"]!='NO CORRESPONDE'
	&$rw1["op_prestacion"]!= 'AUDITORIA ENFERMERIA'
	&$rw1["op_prestacion"]!= 'NC x cambio modulo'
	&$rw1["op_prestacion"]!= 'Pasa a SEMA'
	&$rw1["op_prestacion"]!= 'FALTA SIN AVISO'
	&$rw1["op_prestacion"]!= 'INICIA MAÑANA'
	&$rw1["op_prestacion"]!= 'Visita s/coseg')
		$cant=$cant+$rw1["cant"];

}

echo "<tr><td colspan=11 class=subtitulo>cantidad de prestaciones: ".$cant."</td></tr>";
echo "<tr><td colspan=11 class=subtitulo>sueldos prestacionales: $".$sumtot."</td></tr>";
echo "</table>";

echo "<BR><BR>";
?>