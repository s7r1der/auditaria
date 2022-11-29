<link rel="StyleSheet" href="css/schedule.css" type="text/css">

<?php

$i=$j=0;
$enfam[]=0;
$enfpm[]=0;
$nombre[]=0;
$qts[]=0;
$real[]=0;

$fec=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"];

$classd="head-gray1";	
$contad=0;

include("inc/enf/enc_enf.php");

$zona1=str_replace('"','',urldecode($_GET["zona_desc"]));

echo "<table width=100%><tr valign=top>";

	echo "<td align=left>";
		echo "<table class=myTable-gray>";
			echo "<tr>"; 
				echo"<td class=titulo colspan=2><font size=4><b>PENDIENTES</b></font></td>";
			echo "</tr>";


			$query1=mysqli_query($conn,"select op.op_id,op.pac_id,CONCAT(pac.pac_domicilio,' ',pac.pac_dpto) as domicilio,pac.pac_os,pac.pac_dpto,op.op_prestacion,"
							."CONCAT(pac.pac_apellido,' ',pac.pac_nombre) as paciente,date_format(op.op_date,\"%H:%i\") as op_date1"
							." FROM ".$table." op left join paciente pac on op.pac_id=pac.pac_id"
							." WHERE op.op_date between '".$fec." 00:00:00' and '".$fec." 23:59:59' and op.e_mat='4444' order by pac.pac_dpto") or die(mysqli_error($conn));
		
			$cont=0;
			while($rw1=mysqli_fetch_array($query1,MYSQLI_ASSOC)){
				$cont++;
				echo "<tr><td align=left><font size=2>".$rw1["op_date1"]." - ".$rw1["domicilio"]."</td></tr>";
				echo "<tr><td>"
						."<a href=".$_SERVER["PHP_SELF"]."?event=det_lst_sh_hc"."&pac_id=".$rw1["pac_id"]
																		."&fec_beg=".date("Y")."-".date("m")."-01"
																		."&fec_fin=".date("Y")."-".date("m")."-31"
																		."&zona_desc=".urlencode(det_zona($rw1["pac_dpto"]))
																		." title=\"Ver Historia Clinica\" class=pendiente>"								
																		."<font size=2 face=Arial>".$rw1["paciente"]." - (".$rw1["pac_id"].")</font></a>";
				echo "</td></tr>";

				echo "<tr><td align=left><font size=2 color=green><b>".$cont." - ".$rw1["pac_os"]."</b></td></tr>";
				echo "<tr><td align=left>"
							."<font size=2><a href=".$_SERVER["PHP_SELF"]."?event=assign_qt_pend&op_id=".$rw1["op_id"]
																		."&table=".$table."&zona_desc=".urlencode(det_zona($rw1["pac_dpto"]))
																		."&ubic=det_enf_lst class=pendiente>".$rw1["op_prestacion"]."</a></td></tr>";
				echo "<tr><td><hr></td></tr>";
			}
		echo "</table>";
	
	echo "</td>";

	echo "<td align=center>"; 
		
		if($_SESSION["pos"]=="list_all_enf"){
			//echo menu_innov()."<br>";
			include("inc/schedule/resumen.php");
		}elseif($_SESSION["pos"]=="det_enf_lst"){
			include("inc/detail/det_enf.php");
		}elseif($_SESSION["pos"]=="show_rts"){
			include("inc/schedule/nrts_schedule.php");
		}elseif($_SESSION["pos"]=="det_enf_lst_evol"){
			include("inc/detail/det_enf_evol.php");;
		}
	
	echo "</td>"; 
	
	/*$query="select zona.zona_desc,zona.e_mat,enf.enf_estado,enf.enf_role,enf.enf_turno,CONCAT(enf.enf_apellido,' ',enf.enf_nombre) as enfermero "
							." FROM zonaenf zona left join enfermero enf on enf.e_mat=zona.e_mat "
							." WHERE enf_estado='ACTIVO' and zona_desc='".$zona1."' ORDER BY zona.zona_desc,enf.enf_turno,enf.enf_apellido";
	
	$query=mysqli_query($conn,$query) or die(mysqli_error($conn));
	$turant="";
	
	echo "<td align=right><table class=myTable-gray><tr><td class=titulo colspan=4><font size=4><b>".$zona1."</b></font></td></tr>";
	
	while($row2=mysqli_fetch_array($query,MYSQLI_ASSOC)){
		
			if($turant!=$row2["enf_turno"]){
	 			$turant=$row2["enf_turno"];
				echo "<tr><td class=subtitulo colspan=4>".($row2["enf_turno"]=="AM"?"TURNO MANANA":($row2["enf_turno"]=="AP"?"AMBOS TURNOS":"TURNO TARDE"))."</td></tr>";
			}	

			if(isset($qts[$row2["e_mat"]])){
				$diff=$qts[$row2["e_mat"]]-$real[$row2["e_mat"]];
				$class=($diff==0?"finish":(($diff<3 && $diff>0)?"warning":"begin"));


				echo "<tr>";

					echo "<td class=".$class.">";
						echo "<a href=\"javascript:void(0)\" "
							."onclick=\"window.open('".$_SERVER["PHP_SELF"]."?event=nh_show_res_enf&e_mat=".$row2["e_mat"]."'"
							.",'','width=450,height=300,noresize')\"><font size=1>".$row2["enf_role"]."</font></td>";

					echo "<td align=left class=".$class.">"
						."<a href=".$_SERVER["PHP_SELF"]."?event=det_enf_lst&e_mat=".$row2["e_mat"]
																			."&date=".$fec."&zona_desc=".urlencode($row2["zona_desc"])
																			."&ubic=det_enf_lst class=link>"
																			."<font face=Arial>".$row2["enfermero"]."</font></a></td>";
					
					echo "<td class=".$class.">"
						."<a href=".$_SERVER["PHP_SELF"]."?event=show_rts&e_mat=".$row2["e_mat"]
																		."&date=".$fec."&zona_desc=".urlencode($row2["zona_desc"])
																		."&ubic=rts class=link>"
																		."<font size=1>".$row2["e_mat"]."</font></a></td>";

					echo "<td class=".$class.">"
						."<a href=".$_SERVER["PHP_SELF"]."?event=det_enf_lst_evol&e_mat=".$row2["e_mat"]
																			."&date=".$fec."&zona_desc=".urlencode($row2["zona_desc"])
																			."&ubic=det_enf_lst class=link>"
																			."<font size=1>(".$qts[$row2["e_mat"]].",".$real[$row2["e_mat"]].")</a></td>";

				echo "</tr>";
			}	
		}*/
	//DE SU ZONA
	
	echo "</tr>";

echo "</table>"; 

?>