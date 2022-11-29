<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php 

$table_in=	substr($_SESSION["fec1"],0,4);
$table_stop=substr($_SESSION["fec2"],0,4);

$dat_color="#CC0033";
$cont=$cont1=0;			//contadores
$find=0;				//bool si existen prestaciones
$sum=0;
$subsum=0;
$cont2=0;



$ty_usr=type_user($_SESSION["user"]);
$cond="";

if($ty_usr==0 || $ty_usr==1)
	$cond=" AND op_reg='".$ty_usr."'";


if($_SESSION["usr_role"]=="admin" && $_SESSION["usr_level"]>3){

	$tot["COOP"]=$tot["ZER"]=0;
	$prest=$horas=0;

	echo "<table width=100%>";
		echo "<tr valign=top>";
			echo "<td width=50%>";

				echo"<table class=myTable-gray width=100%>";

					echo "<tr><td colspan=3 class=subtitulo>RESUMEN DEL PACIENTE:</td></tr>";
					echo "<tr>";
						echo "<td><b>CUIDADOR</b></td>";
						echo "<td align=center><b>PRESTACION</B></td>";
						echo "<td align=center><b>CANT HORAS</B></td>";
					echo "</tr>";

				for($j=$table_in;$j<=$table_stop;$j++){

					$qr1=mysqli_query($conn,"select count(op.op_id) as cont,sum(op.cant_horas) as horas"
											.",CONCAT(enf.enf_nombre,' ',enf.enf_apellido) as enfermero,enf.e_mat,enf.enf_owner"
											." FROM  op".$j. "cuidados op LEFT JOIN enfermero enf on op.e_mat=enf.e_mat"
											." WHERE op.pac_id='".$row["pac_id"]."'"
											." AND op.op_date between '".$_SESSION["fec1"]." 00:00:00' and '".$_SESSION["fec2"]." 23:50:00'"
											." AND (op.op_prestacion!='NO CORRESPONDE' && op.op_prestacion!='AUDITORIA ENFERMERIA' && op.op_prestacion!='SUSPENDIDO DE MOMENTO' && op.op_prestacion!='FALTA SIN AVISO'  && op.op_prestacion!='Visita s/coseg')"
											.$cond
											//." ORDER BY op.e_mat,op.op_date asc") or die(mysqli_error($conn));
											." group by op.e_mat order by enf.enf_apellido") or die(mysqli_error($conn));
					
					while($rw=mysqli_fetch_array($qr1,MYSQLI_ASSOC)){
				
						echo "<tr>";
							echo "<td>".$rw["enfermero"]."</td>";
							echo "<td align=center>".$rw["cont"]."</td>";
							echo "<td align=center>".$rw["horas"]." HS.</td>";
						echo "</tr>";
						
						$prest=$prest+$rw["cont"];
						$horas=$horas+$rw["horas"];

						$tot[$rw["enf_owner"]]=$tot[$rw["enf_owner"]]+$rw["horas"];
					}

				}

					echo "<tr>";
						echo "<td align=center><b>TOTAL</b></td>";
						echo "<td align=center><b>".$prest."</b></td>";
						echo "<td align=center><b>".$horas." HS.</b></td>";
					echo "</tr>";
					echo "</table>";
			echo "</td>";

			echo "<td width=50%>";
				
				echo"<table class=myTable-gray width=100%>";

					echo "<tr><td colspan=2 class=subtitulo>HORAS :</td></tr>";

					echo "<tr>";
						echo "<td>ZEROBO</td>";
						echo "<td align=center>".$tot["ZER"]." HS.</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td>COOPERATIVA</td>";
						echo "<td align=center>".$tot["COOP"]." HS.</td>";
					echo "</tr>";
				
					echo "<tr>";
						echo "<td align=center><b>TOTAL</b></td>";
						echo "<td align=center><b>".($tot["ZER"]+$tot["COOP"])." HS.</b></td>";
					echo "</tr>";

				echo "</table>";
			echo "</td>";
		echo "</tr>";
	echo "</table>";
}


echo"<table width=100% class=myTable-gray>";

	echo "<tr><td colspan=10 class=titulo>DATOS DE ATENCION:</td></tr>";

	echo"<tr>";
		echo "<td class=subtitulo align=center><b>N°</b></td>";
		echo "<td class=subtitulo align=center><b><b>CUID</b></td>";
		echo "<td class=subtitulo align=center><b><b>MAT</b></td>";
		echo "<td class=subtitulo align=center><b><b>DIA</b></td>";
		echo "<td class=subtitulo align=center><b><b>FECHA</b></td>";
		echo "<td class=subtitulo align=center><b><b>HORA</b></td>";
		echo "<td class=subtitulo align=center><b><b>PRESTACION</b></td>";
		echo "<td class=subtitulo align=center><b><b>CANT HORAS</b></td>";
		echo "<td class=subtitulo align=center><b><b>FORMATO</b></td>";
	echo "</tr>";


for($i=$table_in;$i<=$table_stop;$i++){

		//Prestaciones NEGATIVAS.
		$qr=mysqli_query($conn,"select op.op_date,date_format(op.op_date, \"%d/%m/%y\ - %T\") as dateop"
								.",date_format(op.op_date, \"%a\") as date_sem"
								.",date_format(op.op_date, \"%d/%m/%y\ - %T\") as date_admin"
								.",date_format(op.op_date, \"%H\") as hora"
								.",op.op_prestacion,op.op_id,op.op_formato,op.cant_horas,pac.pac_dpto,"
								."op.op_coseg,op.e_mat,enf.enf_owner,op.pac_id,op.op_reg,"
								."CONCAT(enf.enf_apellido,' ',enf.enf_nombre) as enfermero"
								." FROM  op".$i. "cuidados op LEFT JOIN enfermero enf on op.e_mat=enf.e_mat"
								." LEFT JOIN paciente pac on op.pac_id=pac.pac_id"
								." WHERE op.pac_id='".$row["pac_id"]."'"
								." AND op.op_date between '".$_SESSION["fec1"]." 00:00:00' and '".$_SESSION["fec2"]." 23:50:00'"
								.$cond
								//." AND op.op_reg='".type_user($_SESSION["user"])."'"
								.(isset($_GET["e_mat_tmp"])?" and op.e_mat='".$_GET["e_mat_tmp"]."'":"")
								//." ORDER BY op.e_mat,op.op_date asc") or die(mysqli_error($conn));
								." ORDER BY op.op_date asc") or die(mysqli_error($conn));
																							 
		while($row1=mysqli_fetch_array($qr,MYSQLI_ASSOC)){

			if($row1["op_prestacion"]=='Visita s/coseg' || 
				$row1["op_prestacion"]=='AUDITORIA ENFERMERIA'||
				$row1["op_prestacion"]=='NC x cambio modulo'||
				$row1["op_prestacion"]=='FALTA SIN AVISO' ||
				$row1["op_prestacion"]=='NO CORRESPONDE'){
			
					$valid=0;			
			}else{
					$valid=1;
			}

			$cont++;
			
			$fecha=explode(" - ",(($_SESSION["usr_mat"]=="2446" || $_SESSION["usr_mat"]=="863")?$row1["date_admin"]:$row1["dateop"]));
		
			$class1="subtitulo-".($valid==0?"NOVALID":($row1["op_reg"]==1?"ZER":"COOP"));
			$class2="data-".($valid==0?"NOVALID":($row1["op_reg"]==1?"ZER":"COOP"));

			if($_SESSION["usr_role"]=="admin" && $_SESSION["usr_level"]>3){
				echo "<tr>";	
					echo "<td align=center class=".$class1.">";

						echo "<a href=".$_SERVER["PHP_SELF"]."?event=upd_enf_cfg"
																	."&op_id=".$row1["op_id"]
																	."&ubic=detxos"
																	."&table=op".$i."cuidados"
																	."&e_mat=".$row1["e_mat"]
																	."&zona_desc=".urlencode($row1["pac_dpto"])
																	."><font color=white>"
																	.($valid==1?$cont:"-")."</font></a>";
					echo "</td>";			

					//echo "<td align=center class=".$class1.">".$row1["e_mat"]."</td>";
					echo "<td align=left width=10% class=".$class1."><font size=3>".$row1["enfermero"]."</font></td>";
					echo "<td align=left class=".$class2.">".$row1["e_mat"]."</td>";

					echo "<td align=center class=".$class2.">";
						echo "<a href=".$_SERVER["PHP_SELF"]."?event=nh_not_corresp"
														."&op_id=".$row1["op_id"]
														."&op_prestacion=".urlencode($row1["op_prestacion"])
														."&pac_id=".$row1["pac_id"]
														."&zona_desc=".urlencode($row1["pac_dpto"])
														."&ubic=viewdetxos"
														."&table=op".$i."cuidados"
														."&pac_os=".$row["pac_os"]." class=linkBold>".dia_semana($row1["date_sem"],1,1)."</a></td>";
					
					echo "<td align=center class=".$class2.">";
						echo "<a href=".$_SERVER["PHP_SELF"]."?event=nh_not_corresp"
														."&op_id=".$row1["op_id"]
														."&op_prestacion=".urlencode($row1["op_prestacion"])
														."&pac_id=".$row1["pac_id"]
														."&zona_desc=".urlencode($row1["pac_dpto"])
														."&ubic=viewdetxos"
														."&table=op".$i."cuidados"
														."&pac_os=".$row["pac_os"]." class=linkBold>".$fecha[0]."</a></td>";


					echo "<TD align=center class=".$class2.">".$fecha[1]."</td>";
					echo "<TD align=left class=".$class2.">".$row1["op_prestacion"]."</a></td>";
					echo "<td align=center class=".$class2.">".$row1["cant_horas"]." hs.</a></td>";
					echo "<td align=center class=".$class2.">".$row1["op_formato"]."</a></td>";
				echo "</tr>";
			}else{
				echo "<tr>";	
					echo "<td align=center class=".$class1.">".($valid==1?$cont:"-")."</td>";			
					echo "<td align=left width=10% class=".$class1."><font size=3>".$row1["enfermero"]."</font></td>";
					echo "<td align=left width=5% class=".$class2.">".$row1["e_mat"]."</td>";
					echo "<td align=center width=5% class=".$class2.">".strtoupper(dia_semana($row1["date_sem"],0,1))."</a></td>";
					echo "<td align=center class=".$class2.">".$fecha[0]."</a></td>";
					echo "<TD align=center class=".$class2.">".$fecha[1]."</td>";
					echo "<TD align=left class=".$class2.">".$row1["op_prestacion"]."</a></td>";
					echo "<td align=center class=".$class2.">".$row1["cant_horas"]." hs.</a></td>";
					echo "<td align=center class=".$class2.">".$row1["op_formato"]."</a></td>";
				echo "</tr>";				
			}
			
			if($valid==1){
				$sum=$sum+$row1["cant_horas"];
				$subsum=$subsum+$row1["cant_horas"];
				//$cantprest[$row1["e_mat"]]=$cantprest[$row1["e_mat"]]+1;
				//$canthoras[$row1["e_mat"]]=$canthoras[$row1["e_mat"]]+$row1["cant_horas"];
			}

			if($valid==0){
				$cont--;
				$cont2--;
			}
		}

	echo "<tr><td colspan=1 class=subtitulo>".$cont."</td><td colspan=8 class=subtitulo>TOTAL HORAS: ".strtoupper($subsum)."</font></td></tr>";
}

?>
