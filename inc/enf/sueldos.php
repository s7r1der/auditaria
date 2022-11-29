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
$fech1=$_POST["year"]."-".$_POST["month"]."-01 00:00:00";	
$fech2=$_POST["year"]."-".$_POST["month"]."-31 23:59:59";
$table="op".$_POST["year"]."cuidados";

//echo $table;

$date1=split_date($fech1);
$date2=split_date($fech2);

$sumtot=$subhoras=0;
$tot=$tothoras=0;
$role="";
$cont=1;
$tot1=$tothoras1=0;


$conn=newConnect();
$res=mysqli_query($conn,"select e_mat from enfermero where 1") or die(mysqli_error($conn));

while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
	$cant[$row["e_mat"]]=0;
	$sub[$row["e_mat"]]=0;
}

$query_in=mysqli_query($conn,"select op.pac_id,pac.pac_os,op.pac_id,op.e_mat,count(op.op_id) as cant,sum(op.cant_horas) as suma,"
					."op.op_prestacion,enf.enf_role,CONCAT(enf.enf_apellido,' ',enf.enf_nombre) as enfermero"
					." FROM ".$table." op left join paciente pac on op.pac_id=pac.pac_id LEFT JOIN enfermero enf on op.e_mat=enf.e_mat"
					." where op.op_date between '".$fech1."' and '".$fech2."'"
					//." and enf.enf_role='CUID'"
					." GROUP BY op.e_mat,op.op_prestacion,op.pac_id"
					." ORDER BY enf.enf_role,op.e_mat") or die(mysqli_error($conn));

/*
$query_in=mysqli_query($conn,"select op.pac_id,op.pac_id,op.e_mat,"
					."op.op_prestacion"
					." FROM ".$table." op left join paciente pac on op.pac_id=pac.pac_id"
					." where op.op_date between '".$fech1."' and '".$fech2."'"
					." AND pac.pac_os='OSEP'"
					//." and enf.enf_role='CUID'"
					//." GROUP BY op.e_mat"
					//." GROUP BY op.e_mat,op.op_prestacion,op.pac_id"
					." ORDER BY op.op_date") or die(mysqli_error($conn));
*/

while($rw1=mysqli_fetch_array($query_in,MYSQLI_ASSOC)){
	//echo $rw1["op_id"];
//	$parc=det_coseg_liq($rw1["suma"],$rw1["e_mat"],$rw1["enf_role"],$rw1["op_prestacion"]);
//	$sub[$rw1["e_mat"]]=$sub[$rw1["e_mat"]]+$parc;
	//echo $rw1["e_mat"]."-".$rw1["op_prestacion"]."-".$rw1["pac_id"]."-".$rw1["pac_os"]."-<br>";
	//if($rw1["e_mat"]=="5060") echo "HOL".$rw1["pac_os"];

	if($rw1["op_prestacion"]!='NO CORRESPONDE'
		//&&$rw1["op_prestacion"]!= 'AUDITORIA'
		&&$rw1["op_prestacion"]!= 'NC x cambio modulo'
		&&$rw1["op_prestacion"]!= 'SUSPENDIDO DE MOMENTO'
		&&$rw1["op_prestacion"]!= 'Pasa a SEMA'
		&&$rw1["op_prestacion"]!= 'FALTA SIN AVISO'
		&&$rw1["op_prestacion"]!= 'INICIA MAÑANA'
		&&$rw1["op_prestacion"]!= 'Visita s/coseg'){
		

			$parc=det_coseg_liq($rw1["suma"],$rw1["e_mat"],$rw1["enf_role"],$rw1["op_prestacion"],$rw1["pac_os"]);
			$sub[$rw1["e_mat"]]=$sub[$rw1["e_mat"]]+$parc;
			$cant[$rw1["e_mat"]]=$cant[$rw1["e_mat"]]+$rw1["suma"];
		}
}

$ty_usr=type_user($_SESSION["user"]);

echo "<table class=myTable-gray align=center>";
	echo "<tr><td colspan=11 class=titulo>HONORARIOS</td></tr>";

	echo "<tr>";
		echo "<td colspan=2 class=subtitulo>DESDE</td>";
		echo "<td colspan=1 class=><b>".$date1["day"]."/".$date1["month"]."/".$date1["year"]."</b></td>";
		echo "<td colspan=1 class=subtitulo><b>HASTA:</b></td>";
		echo "<td colspan=7 class=><b>".$date2["day"]."/".$date2["month"]."/".$date2["year"]."</b></td>";
	echo "</tr>";

	if($ty_usr!=1){

		echo "<tr>";
			echo "<td colspan=7>";

			echo "<table class=myTable-gray width=100%>";
				
				echo "<tr><td colspan=7 class=titulo-COOP>COOPERATIVA</td></tr>";

				$query_out=mysqli_query($conn,"select e_mat,enf_zona,enf_role,enf_apellido,CONCAT(enf_apellido,' ',enf_nombre) as enfermero,enf_owner	"
									." FROM enfermero enf"
									." WHERE enf_owner='COOP'"
									//." where enf_dpto='GRAL ALVEAR'"
									." ORDER BY enf_owner,enf_zona,enf_apellido") or die(mysqli_error($conn));

				$zona_ant="";

				while($rw2=mysqli_fetch_array($query_out,MYSQLI_ASSOC)){
					
					if($zona_ant!=$rw2["enf_zona"]){
						$zona_ant=$rw2["enf_zona"];

						if($sumtot!=0){
							 echo "<tr>";
							 	echo "<td colspan=4 class=subtitulo-COOP>".$subhoras." hs.</td>";
							 	echo "<td colspan=3 class=subtitulo-COOP>$ ".$sumtot." </td>";
							 echo "</tr>";
						}

						echo "<tr><td colspan=7 class=subtitulo-COOP>ZONA ".$rw2["enf_zona"]."</td></tr>";

						echo "<tr>";
							echo "<td class=subtitulo-COOP><b>Nro</b></td>";
							//echo "<td class=subtitulo><b>ZONA</b></td>";
							echo "<td class=subtitulo-COOP><b>CUIDADOR</b></td>";
							echo "<td class=subtitulo-COOP><b>CUIL</b></td>";
							echo "<td class=subtitulo-COOP><b>CUENTA</b></td>";
							echo "<td class=subtitulo-COOP><b>MAT.</b></td>";
							echo "<td class=subtitulo-COOP><b>HORAS</b></td>";
							echo "<td class=subtitulo-COOP><b>SUBTOTAL</b></td>";
						echo "</tr>";	

						$cont=1;
						$sumtot=$subhoras=0;

					}

					IF($sub[$rw2["e_mat"]]!=0 && $rw2["e_mat"]!='3111'){
						echo "<tr>";
							echo "<td>".$cont."</td>";
							echo "<td align=left>".strtoupper($rw2["enfermero"])."</td>";
							echo "<td>".$rw2["enf_cuil"]."</td>";
							echo "<td>".$rw2["enf_cta"]."</td>";

							echo "<td>".$rw2["e_mat"]."</td>"
								."<td align=center>"
									."<a href=\"javascript:void(0)\" "
									."onclick=\"window.open('".$_SERVER["PHP_SELF"]."?event=nh_cal_sueldos_detallado_enf"
										."&month=".$_POST["month"]."&year=".$_POST["year"]."&e_mat=".$rw2["e_mat"]."','','width=850,height=550,noresize')\">"
									.$cant[$rw2["e_mat"]]."</a>"
								."</td>";
								
								if($_SESSION["usr_level"]>3){
									echo "<td align=center>".$sub[$rw2["e_mat"]]."</td>";
								}
						echo "</tr>";

						$sumtot=$sumtot+$sub[$rw2["e_mat"]];
						$subhoras=$subhoras+$cant[$rw2["e_mat"]];
						
						$tothoras=$tothoras+$cant[$rw2["e_mat"]];
						$tot=$tot+$sub[$rw2["e_mat"]];
						
						$cont++;
					}

				}	

				echo "<tr>";
				 	echo "<td colspan=4 class=subtitulo-COOP>".$subhoras." hs.</td>";
				 	echo "<td colspan=3 class=subtitulo-COOP>$ ".$sumtot." </td>";
				echo "</tr>";

				echo "<tr>";
				 	echo "<td colspan=4 class=subtitulo-COOP>".$tothoras." hs.</td>";
				 	echo "<td colspan=3 class=subtitulo-COOP>$ ".$tot." </td>";
				echo "</tr>";

			echo "</table>";
			
			echo "</td>";
		echo "</tr>";

	}

	if($ty_usr!=0){

		$sumtot1=$subhoras1=0;
		$tot1=$tothoras1=0;

		echo "<tr>";
			echo "<td colspan=7>";

			echo "<table class=myTable-gray width=100%>";
				
				echo "<tr><td colspan=7 class=titulo-ZER>ZEROBO</td></tr>";

				$query_out1=mysqli_query($conn,"select e_mat,enf_zona,enf_role,enf_cuil,enf_apellido,CONCAT(enf_apellido,' ',enf_nombre) as enfermero,enf_owner,enf_cta"
									." FROM enfermero enf"
									." WHERE (enf_owner='ZER' || enf_owner='ZERN')"
									//." where enf_dpto='GRAL ALVEAR'"
									." ORDER BY enf_zona,enf_apellido") or die(mysqli_error($conn));

				$zona_ant="";

				while($rw2=mysqli_fetch_array($query_out1,MYSQLI_ASSOC)){

					//if($rw2["e_mat"]=="5060") echo "SI PASE POR ACA CON COSEG=".$sub[$rw2["e_mat"]];

					if($zona_ant!=$rw2["enf_zona"]){
						$zona_ant=$rw2["enf_zona"];

						if($sumtot1!=0){
							 echo "<tr>";
							 	echo "<td colspan=3 class=subtitulo-ZER>".$subhoras1." hs.</td>";
							 	echo "<td colspan=4 class=subtitulo-ZER>$ ".$sumtot1." </td>";
							 echo "</tr>";
						}

						echo "<tr><td colspan=7 class=subtitulo-ZER>ZONA ".$rw2["enf_zona"]."</td></tr>";

						echo "<tr>";
							echo "<td class=subtitulo-ZER><b>Nro</b></td>";
							//echo "<td class=subtitulo><b>ZONA</b></td>";
							echo "<td class=subtitulo-ZER><b>CUIDADOR</b></td>";
							echo "<td class=subtitulo-ZER><b>CUIL</b></td>";
							echo "<td class=subtitulo-ZER><b>CUENTA</b></td>";
							echo "<td class=subtitulo-ZER><b>MAT.</b></td>";
							echo "<td class=subtitulo-ZER><b>HORAS</b></td>";
							echo "<td class=subtitulo-ZER><b>SUBTOTAL</b></td>";
						echo "</tr>";	

						$cont=1;
						$sumtot1=$subhoras1=0;

					}

					IF($sub[$rw2["e_mat"]]!=0 && $rw2["e_mat"]!='3111'){

						echo "<tr>";
								echo "<td>".$cont."</td>";
								echo "<td align=left>".strtoupper($rw2["enfermero"])."</td>";
								echo "<td>".$rw2["enf_cuil"]."</td>";
								echo "<td>".$rw2["enf_cta"]."</td>";

								echo "<td>".$rw2["e_mat"]."</td>"
								."<td align=center>"
									."<a href=\"javascript:void(0)\" "
									."onclick=\"window.open('".$_SERVER["PHP_SELF"]."?event=nh_cal_sueldos_detallado_enf"
									."&year=".$_POST["year"]."&month=".$_POST["month"]."&e_mat=".$rw2["e_mat"]."','','width=850,height=550,noresize')\">"
									.$cant[$rw2["e_mat"]]."</a>"
								."</td>";
							
								if($_SESSION["usr_level"]>3){
									echo "<td align=center>".$sub[$rw2["e_mat"]]."</td>";
								}								

						echo "</tr>";

						$sumtot1=$sumtot1+$sub[$rw2["e_mat"]];
						$subhoras1=$subhoras1+$cant[$rw2["e_mat"]];
						
						$tothoras1=$tothoras1+$cant[$rw2["e_mat"]];
						$tot1=$tot1+$sub[$rw2["e_mat"]];
						
						$cont++;
					}

				}	

				echo "<tr>";
				 	echo "<td colspan=4 class=subtitulo-ZER>".$subhoras1." hs.</td>";
				 	echo "<td colspan=3 class=subtitulo-ZER>$ ".$sumtot1." </td>";
				echo "</tr>";

				echo "<tr>";
				 	echo "<td colspan=4 class=subtitulo-ZER>".$tothoras1." hs.</td>";
				 	echo "<td colspan=3 class=subtitulo-ZER>$ ".$tot1." </td>";
				echo "</tr>";

			echo "</table>";
			
			echo "</td>";
		echo "</tr>";

	}

	echo "<tr>";
	 	echo "<td colspan=3 class=titulo>".($tothoras+$tothoras1)." hs.</td>";
	 	echo "<td colspan=3 class=titulo>$ ".($tot+$tot1)." </td>";
	echo "</tr>";

?>