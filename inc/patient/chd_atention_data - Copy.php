<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php 

$table_in=	substr($_SESSION["fec1"],0,4);
$table_stop=substr($_SESSION["fec2"],0,4);

$dat_color="#CC0033";
$cont=$cont1=0;			//contadores
$find=0;				//bool si existen prestaciones
$sum=0;
$subsum=0;


echo"<table width=100% class=myTable-gray>";

	echo "<tr><td colspan=10 class=titulo>DATOS DE ATENCION:</td></tr>";

	for($i=$table_in;$i<=$table_stop;$i++){

		//Prestaciones NEGATIVAS.
		$qr=mysqli_query($conn,"select op.op_date,date_format(op.op_date, \"%d/%m/%y\ - %T\") as dateop"
								.",date_format(op.op_date, \"%a . %d/%m/%y\ - %T\") as date_admin"
								.",op.op_prestacion,op.op_id,op.op_formato,op.cant_horas,pac.pac_dpto,"
								."op.op_coseg,op.e_mat,enf.enf_owner,op.pac_id,op.op_reg,"
								."CONCAT(enf.enf_nombre,' ',enf.enf_apellido) as enfermero"
								." FROM  op".$i. "cuidados op LEFT JOIN enfermero enf on op.e_mat=enf.e_mat"
								." LEFT JOIN paciente pac on op.pac_id=pac.pac_id"
								." WHERE op.pac_id='".$row["pac_id"]."'"
								." AND op.op_date between '".$_SESSION["fec1"]." 00:00:00' and '".$_SESSION["fec2"]." 23:50:00'"
								//." AND op.op_reg='".type_user($_SESSION["user"])."'"
								.(isset($_GET["e_mat_tmp"])?" and op.e_mat='".$_GET["e_mat_tmp"]."'":"")
								//." ORDER BY op.e_mat,op.op_date asc") or die(mysqli_error($conn));
								." ORDER BY op.op_date asc") or die(mysqli_error($conn));


		if(mysqli_num_rows($qr)>0){
			$find=1;

		}else sys_msg(2,3,'#FFFF66');

		$class="";
		$cont=$cont2=0;
		$emat_ant="-";
		$opid_ant=$opid_ant1="";

		$valid=1;
		$cambio=$enf_owner=0;
																							 
		while($row1=mysqli_fetch_array($qr,MYSQLI_ASSOC)){

			if($enf_owner!=$row1["enf_owner"] && $cambio==0){
				$enf_owner=$row1["enf_owner"];
				$cambio=1;
			}

			if($row1["op_prestacion"]=='Visita s/coseg' || 
				$row1["op_prestacion"]=='AUDITORIA ENFERMERIA'||
				$row1["op_prestacion"]=='NC x cambio modulo'||
				$row1["op_prestacion"]=='FALTA SIN AVISO' ||
				$row1["op_prestacion"]=='NO CORRESPONDE'){
				
				$valid=0;
			
			}else{
				$valid=1;
				
			}
			
			if($row1["op_id"]!=$opid_ant && $row1["op_id"]!=$opid_ant1){

				$opid_ant1=$opid_ant;
				$opid_ant=$row1["op_id"];

				if($emat_ant!=$row1["e_mat"]){

					if($cont!=0)  echo "<tr><td colspan=1 class=subtitulo-".$enf_owner.">".$cont."</td>"
										."<td colspan=8 class=subtitulo-".$enf_owner."> SUBTOTAL HORAS: ".strtoupper($subsum)."</font></td></tr>";
					
					$cont=$subsum=0;
					$emat_ant=$row1["e_mat"];

					echo "<tr><td colspan=9 class=subtitulo-".$enf_owner."><font size=4> ".strtoupper($row1["enfermero"])."</font>  (".$row1["e_mat"].") - ".$row1["enf_owner"]."</td></tr>";

					echo"<tr>";
						echo "<td class=subtitulo-".$enf_owner." align=center><b>N°</b></td>";
						echo "<td class=subtitulo-".$enf_owner." align=center><b><b>FECHA</b></td>";
						echo "<td class=subtitulo-".$enf_owner." align=center><b><b>HORA</b></td>";
						echo "<td class=subtitulo-".$enf_owner." align=center><b><b>PRESTACION</b></td>";
						echo "<td class=subtitulo-".$enf_owner." align=center><b><b>CANT HORAS</b></td>";
						echo "<td class=subtitulo-".$enf_owner." align=center><b><b>FORMATO</b></td>";
						if($_SESSION["sh_mat"])	echo "<td class=subtitulo-".$enf_owner."><b><b>MATRICULA</b></td>";
						if($_SESSION["usr_role"]=="admin" && ($_SESSION["usr_mat"]=="2446" || $_SESSION["usr_mat"]=="863")) 
							echo "<td class=subtitulo-".$enf_owner."><b><b>COSEG</b></td>";
						//echo "<td class=subhead><b><b>EVOL</b></td>";
					echo "</tr>";

				$cambio=0;

				}

			$cont++;
			$cont2++;

			
			$fecha=explode(" - ",(($_SESSION["usr_mat"]=="2446" || $_SESSION["usr_mat"]=="863")?$row1["date_admin"]:$row1["dateop"]));
		
			echo "<tr>";	
				echo "<td align=center class=subtitulo-".($row1["op_reg"]==1?"SOE":"COOP").">";

					echo "<a href=".$_SERVER["PHP_SELF"]."?event=upd_enf_cfg"
																	."&op_id=".$row1["op_id"]
																	."&ubic=detxos"
																	."&table=op".$i."cuidados"
																	."&e_mat=".$row1["e_mat"]
																	."&zona_desc=".urlencode($row1["pac_dpto"])
																	."><font color=white>"
																	.($valid==1?$cont:"-")."</font></a>";
				echo "</td>";			
				
				if($_SESSION["usr_role"]=="admin"){

					echo "<td align=center>";
						echo "<a href=".$_SERVER["PHP_SELF"]."?event=nh_not_corresp"
														."&op_id=".$row1["op_id"]
														."&op_prestacion=".urlencode($row1["op_prestacion"])
														."&pac_id=".$row1["pac_id"]
														."&zona_desc=".urlencode($row1["pac_dpto"])
														."&ubic=viewdetxos"
														."&table=op".$i."cuidados"
														."&pac_os=".$row["pac_os"]." class=linkBold>".$fecha[0]."</a></td>";


					/*echo "<TD align=center>	<a href=".$_SERVER["PHP_SELF"]."?event=nh_falta_saviso"	
															."&op_id=".$row1["op_id"]
															."&pac_id=".$row1["pac_id"]
															."&op_prestacion=".($row1["op_prestacion"]=="Visita de Enfermeria"?0:1)
															."&zona_desc=".urlencode($row1["pac_dpto"])
															."&ubic=viewdetxos"
															."&table=op".$i."cuidados"
															."&pac_os=".$row["pac_os"]." class=linkBold>".$fecha[0]."</a></td>";*/

					echo "<TD align=center><a href=".$_SERVER["PHP_SELF"]."?event=nh_vis_scoseg"	
															."&op_id=".$row1["op_id"]
															."&pac_id=".$row1["pac_id"]
															."&op_prestacion=".($row1["op_prestacion"]=="Visita de Enfermeria"?0:1)
															."&zona_desc=".urlencode($row1["pac_dpto"])
															."&ubic=viewdetxos"
															."&table=op".$i."cuidados"
															."&pac_os=".$row["pac_os"]." class=linkBold>".$fecha[1]."</a></td>";

					echo "<TD align=left><a href=".$_SERVER["PHP_SELF"]."?event=upd_sch_det"
													."&op_id=".$row1["op_id"]
													."&ubic=detxos"
													."&table=op".$i."cuidados"
													."&zona_desc=".urlencode($row1["pac_dpto"])
													."&date=".$row1["op_date"]	
													." title=\"Ver Detalle x paciente\" class=link>"
													.$row1["op_prestacion"]."</a></td>";

					echo "<td align=center>";
						echo "<a href=".$_SERVER["PHP_SELF"]."?event=nh_not_curac"	
															."&op_id=".$row1["op_id"]
															."&pac_id=".$row1["pac_id"]
															."&op_prestacion=".($row1["op_prestacion"]=="Visita de Enfermeria"?0:1)
															."&zona_desc=".urlencode($row1["pac_dpto"])
															."&ubic=viewdetxos"
															."&table=op".$i."cuidados"
															."&pac_os=".$row["pac_os"]." class=linkBold>".$row1["cant_horas"]." hs.</a></td>";
					
					echo "<td align=center>";
						echo "<a href=".$_SERVER["PHP_SELF"]."?event=nh_not_corresp"
														."&op_id=".$row1["op_id"]
														."&pac_id=".$row1["pac_id"]
														."&zona_desc=".urlencode($row1["pac_dpto"])
														."&ubic=viewdetxos"
														."&table=op".$i."cuidados"
														."&pac_os=".$row["pac_os"]." class=linkBold>".$row1["op_formato"]."</a></td>";

					echo "<td align=center>";
						echo "<a href=".$_SERVER["PHP_SELF"]."?event=nh_not_corresp"
														."&op_id=".$row1["op_id"]
														."&pac_id=".$row1["pac_id"]
														."&zona_desc=".urlencode($row1["pac_dpto"])
														."&ubic=viewdetxos"
														."&table=op".$i."cuidados"
														."&pac_os=".$row["pac_os"]." class=linkBold>".$row1["e_mat"]."</a></td>";


					if($_SESSION["usr_mat"]=="2446" || $_SESSION["usr_mat"]=="863") echo "<td>".$row1["op_coseg"]."</b></font></td>";
				
				}else{
					echo "<TD align=center><font color=black>".substr($row1["dateop"],0,8)."</font></td>";
		
					echo "<TD align=center><font color=black>".substr($row1["op_dt_qt"],10)."</font></td>";

					echo "<TD class=".$class.">".$row1["op_prestacion"]."</font></td>";

					echo "<td class=".$class.">".$row1["cant_horas"]." hs.</b></font></td>";
			
					echo "<td class=".$class.">".$row1["op_formato"]."</b></font></td>";

					echo "<td class=".$class.">".$row1["e_mat"]."</b></font></td>";
				}
				
				$state=0;
				$class=($state==0?"head-org-c":($state==2?"head-org-c":"head3"));
				
					//echo "<TD class=".$class." width=40%><p align=left width=100%><font color=black>".$row1["evol_desc"]
					//		." <font size=1>(".$row1["evol_id"].")</font></font></p></td>";	

			echo "</tr>";
			
			$sum=$sum+$row1["cant_horas"];
			$subsum=$subsum+$row1["cant_horas"];
			if($valid==0){
				$cont--;
				$cont2--;
			}
			}
		}
	}

	echo "<tr><td colspan=1 class=subtitulo>".$cont."</td><td colspan=8 class=subtitulo> SUBTOTAL HORAS: ".strtoupper($subsum)."</font></td></tr>";
	
	if($find==1){
		echo "<tr><td align=center class=subtitulo colspan=1>".($cont2)."</td><td colspan=8 class=titulo> TOTAL HORAS: ".$sum."</td></tr>";
		echo "</table>";
	}

?>
