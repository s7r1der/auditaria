<link rel="StyleSheet" href="css/schedule.css" type="text/css">

<?php
//inicializacion de variables
global $dat_col;
global $tab_color;

if(!isset($_GET["opts"])) $_GET["opts"]="pendiente";

$fec1=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"];
$fec2=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"];

$date=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"];

$table="op".$_SESSION["year_tmp"]."cuidados";

$conn=newConnect();

include("inc/schedule/menu_schedule.php");

switch(type_user($_SESSION["user"])){
	case "0":
	case "1":
		$cond=" AND op.op_reg='".type_user($_SESSION["user"])."'";	break;
	case "2":
		$cond="";	break;
}



/*$query1=mysqli_query($conn,"select op.pac_id,op.op_id,op.e_mat,op.pac_id,op.op_date,pac.pac_apellido,pac.pac_nombre,pac.pac_domicilio,pac.pac_os,"
					."op.cant_horas,pac.pac_dpto,op.op_prestacion,date_format(op.op_date,\"%H:%i\") as op_date1,date_format(op.op_date,\"%H\") as op_hour,"
					."enf.enf_apellido,enf.enf_nombre,enf.enf_owner,op.op_sit"
					." FROM ".$table." op join paciente pac on op.pac_id=pac.pac_id join enfermero enf on op.e_mat=enf.e_mat"
					." WHERE op.op_date between '".$fec1." 00:00:00' and '".$fec2." 12:01:01' and op_reg='0'"
					." ORDER BY op.op_date,enf.enf_apellido") or die(mysqli_error($conn));

$query2=mysqli_query($conn,"select op.pac_id,op.op_id,op.e_mat,op.pac_id,op.op_date,pac.pac_apellido,pac.pac_nombre,pac.pac_domicilio,pac.pac_os,"
					."op.cant_horas,pac.pac_dpto,op.op_prestacion,date_format(op.op_date,\"%H:%i\") as op_date1,date_format(op.op_date,\"%H\") as op_hour,"
					."enf.enf_apellido,enf.enf_nombre,enf.enf_owner,op.op_sit"
					." FROM ".$table." op join paciente pac on op.pac_id=pac.pac_id join enfermero enf on op.e_mat=enf.e_mat"
					." WHERE op.op_date between '".$fec1." 13:00:00' and '".$fec2." 23:59:59' and op_reg='0'"
					." ORDER BY op.op_date,enf.enf_apellido") or die(mysqli_error($conn));*/

$query3=mysqli_query($conn,"select op.pac_id,op.op_id,op.e_mat,op.pac_id,op.op_date,pac.pac_apellido,pac.pac_nombre,pac.pac_domicilio,pac.pac_os,"
					."op.cant_horas,pac.pac_dpto,op.op_prestacion,date_format(op.op_date,\"%H:%i\") as op_date1,date_format(op.op_date,\"%H\") as op_hour,"
					."enf.enf_apellido,enf.enf_nombre,enf.enf_owner,op.op_sit"
					." FROM ".$table." op join paciente pac on op.pac_id=pac.pac_id join enfermero enf on op.e_mat=enf.e_mat"
					." WHERE op.op_date between '".$fec1." 00:00:00' and '".$fec2." 12:01:01' and op_reg='1'"
					." ORDER BY op.op_date,enf.enf_apellido") or die(mysqli_error($conn));

$query4=mysqli_query($conn,"select op.pac_id,op.op_id,op.e_mat,op.pac_id,op.op_date,pac.pac_apellido,pac.pac_nombre,pac.pac_domicilio,pac.pac_os,"
					."op.cant_horas,pac.pac_dpto,op.op_prestacion,date_format(op.op_date,\"%H:%i\") as op_date1,date_format(op.op_date,\"%H\") as op_hour,"
					."enf.enf_apellido,enf.enf_nombre,enf.enf_owner,op.op_sit"
					." FROM ".$table." op join paciente pac on op.pac_id=pac.pac_id join enfermero enf on op.e_mat=enf.e_mat"
					." WHERE op.op_date between '".$fec1." 13:00:00' and '".$fec2." 23:59:59' and op_reg='1'"
					." ORDER BY op.op_date,enf.enf_apellido") or die(mysqli_error($conn));

$cont=0;
echo "<table width=100% align=center>";
	echo "<tr valign=top>";
		/*echo "<td width=50%>";
			echo "<table class=myTable-gray width=100%>";
				echo "<tr><td class=titulo-coop colspan=7>COOP</td></tr>";
				echo "<tr><td class=subtitulo-coop colspan=7>TURNO MAÑANA</td></tr>";

				$pid_ant=$opid_ant=0;
				$bgcolor="";
				while($rw1=mysqli_fetch_array($query1,MYSQLI_ASSOC)){

//					iF($pid_ant==$rw1["pac_id"]&& $opid_ant==$rw1["op_id"] && $_SESSION["user"]=="root"){
					iF($pid_ant==$rw1["pac_id"]){
						//$conn=newConnect(); 
						//$qr=mysqli_query($conn,"DELETE FROM op2018cuidados where op_id='".$rw1["op_id"]."'")or die(mysqli_error($conn));
						$bgcolor="red";
					}
					//else{
						$cont++;			
						echo "<tr>";
							echo "<td class=".det_class($rw1["op_sit"],$rw1["op_prestacion"])."><font color=".$bgcolor.">".$cont."- </td>";			
							echo "<td class=".det_class($rw1["op_sit"],$rw1["op_prestacion"]).">".$rw1["op_date1"]."</td>";
							echo "<td class=".det_class($rw1["op_sit"],$rw1["op_prestacion"]).">"
									."<a href=".$_SERVER["PHP_SELF"]."?event=det_enf_lst&e_mat=".$rw1["e_mat"]
																						//."&date=".$date."&zona_desc=".urlencode($row["zona_desc"])
																					."&date=".$date."&zona_desc=CUIDAD"
																					."&ubic=det_enf_lst class=link>"
																					."<font size=3 face=Arial>".strtoupper($rw1["enf_apellido"]).",".$rw1["enf_nombre"]."(".$rw1["e_mat"].")</font></a>";
							echo "</td>";

							echo "<td class=".det_class($rw1["op_sit"],$rw1["op_prestacion"])."><font size=3>".$rw1["pac_domicilio"]." ".$rw1["pac_dpto"]."</font><font size=2> (".$rw1["op_id"].")</font></td>";
							echo "<td class=".det_class($rw1["op_sit"],$rw1["op_prestacion"])."><font size=4>".$rw1["cant_horas"]."</font></td>";
							echo "<td class=".det_class($rw1["op_sit"],$rw1["op_prestacion"])."><font size=4>".$rw1["enf_owner"]."</font></td>";
							if($rw1["op_prestacion"]!="AUDITORIA"){
								echo "<td class=".det_class($rw1["op_sit"],$rw1["op_prestacion"]).">"
									."<a href=".$_SERVER["PHP_SELF"]."?event=upd_opsit"
																	."&op_sit=".$rw1["op_sit"]
																	."&op_id=".$rw1["op_id"]
																	."&table=".$table
																	."&date=".$date."&zona_desc=CUIDAD"
																	."&ubic=schedule class=link>"
																	."<font size=3 face=Arial><b>".($rw1["op_sit"]==0?"QTH":($rw1["op_sit"]==1?"QRU":"OK"))
																	."</b></font></a></td>";
							}else{
								echo "<td class=".det_class($rw1["op_sit"],$rw1["op_prestacion"])."><font size=3 face=Arial><b>-</b></font></a></td>";
							}
						echo "</tr>";
						echo "<tr><td colspan=7><hr></td></tr>";
					//}
					$pid_ant=$rw1["pac_id"];
					$opid_ant=$rw1["op_id"];						
					$bgcolor="";

				}
				
				$pid_ant=$opid_ant=0;
				$bgcolor="";
				$cont=0;
				echo "<tr><td class=subtitulo-coop colspan=7>TURNO TARDE</td></tr>";

				while($rw2=mysqli_fetch_array($query2,MYSQLI_ASSOC)){
			
					//iF($pid_ant==$rw2["pac_id"] && $opid_ant==$rw2["op_id"] && $_SESSION["user"]=="root"){
					iF($pid_ant==$rw2["pac_id"]){
						//$conn=newConnect(); 
						//$qr=mysqli_query($conn,"DELETE FROM op2018cuidados where op_id='".$rw2["op_id"]."'")or die(mysqli_error($conn));
						$bgcolor="red";
					}
					//else{
						$cont++;			
						echo "<tr>";
							echo "<td class=".det_class($rw2["op_sit"],$rw2["op_prestacion"])."><font color=".$bgcolor.">".$cont."- </td>";			
							echo "<td class=".det_class($rw2["op_sit"],$rw2["op_prestacion"]).">".$rw2["op_date1"]."</td>";
							echo "<td class=".det_class($rw2["op_sit"],$rw2["op_prestacion"]).">"
									."<a href=".$_SERVER["PHP_SELF"]."?event=det_enf_lst&e_mat=".$rw2["e_mat"]
																						//."&date=".$date."&zona_desc=".urlencode($row["zona_desc"])
																					."&date=".$date."&zona_desc=CUIDAD"
																					."&ubic=det_enf_lst class=link>"
																					."<font size=3 face=Arial>".strtoupper($rw2["enf_apellido"]).",".$rw2["enf_nombre"]."(".$rw2["e_mat"].")</font></a>";
							echo "</td>";
							echo "<td class=".det_class($rw2["op_sit"],$rw2["op_prestacion"]).">".$rw2["pac_domicilio"]." ".$rw2["pac_dpto"]."<font size=2> (".$rw2["op_id"].")</font></td>";
							echo "<td class=".det_class($rw2["op_sit"],$rw2["op_prestacion"])."><font size=4>".$rw2["cant_horas"]."</font></td>";
							echo "<td class=".det_class($rw2["op_sit"],$rw2["op_prestacion"])."><font size=4>".$rw2["enf_owner"]."</font></td>";
							if($rw2["op_prestacion"]!="AUDITORIA"){
								echo "<td class=".det_class($rw2["op_sit"],$rw2["op_prestacion"]).">"
									."<a href=".$_SERVER["PHP_SELF"]."?event=upd_opsit"
																	."&op_sit=".$rw2["op_sit"]
																	."&op_id=".$rw2["op_id"]
																	."&table=".$table
																	."&date=".$date."&zona_desc=CUIDAD"
																	."&ubic=schedule class=link>"
																	."<font size=3 face=Arial><b>".($rw2["op_sit"]==0?"QTH":($rw2["op_sit"]==1?"QRU":"OK"))
																	."</b></font></a></td>";
							}else{
								echo "<td class=".det_class($rw2["op_sit"],$rw2["op_prestacion"])."><font size=3 face=Arial><b>-</b></font></a></td>";
							}						echo "<tr><td colspan=7><hr></td></tr>";
					//}
					$pid_ant=$rw2["pac_id"];
					$opid_ant=$rw2["op_id"];						
					$bgcolor="";
					
				}
			echo "</table>";
		echo "</td>";

		echo "<td width=50%>";*/
			echo "<table class=myTable-gray width=100%>";
				echo "<tr><td class=titulo-soe colspan=7>ZEROBO</td></tr>";
				echo "<tr><td class=subtitulo-soe colspan=7>TURNO MAÑANA</td></tr>";	
				
				$pid_ant=$opid_ant=0;
				$bgcolor="";
				$cont=0;

				while($rw3=mysqli_fetch_array($query3,MYSQLI_ASSOC)){
					//iF($pid_ant==$rw3["pac_id"]&& $opid_ant==$rw3["op_id"] && $_SESSION["user"]=="root"){ 
					iF($pid_ant==$rw3["pac_id"]){ 
						//$conn=newConnect(); 
						//$qr=mysqli_query($conn,"DELETE FROM op2018cuidados where op_id='".$rw3["op_id"]."'")or die(mysqli_error($conn));
						$bgcolor="red";
					}
					//else{
						$cont++;			
						echo "<tr>";
							echo "<td class=".det_class($rw3["op_sit"],$rw3["op_prestacion"])."><font color=".$bgcolor.">".$cont."- </td>";			
							echo "<td class=".det_class($rw3["op_sit"],$rw3["op_prestacion"]).">".$rw3["op_date1"]."</td>";
							echo "<td class=".det_class($rw3["op_sit"],$rw3["op_prestacion"]).">"
									."<a href=".$_SERVER["PHP_SELF"]."?event=det_enf_lst&e_mat=".$rw3["e_mat"]
																						//."&date=".$date."&zona_desc=".urlencode($row["zona_desc"])
																					."&date=".$date."&zona_desc=CUIDAD"
																					."&ubic=det_enf_lst class=link>"
																					."<font size=3 face=Arial>".strtoupper($rw3["enf_apellido"]).",".$rw3["enf_nombre"]."(".$rw3["e_mat"].")</font></a>";
							echo "</td>";

							echo "<td class=".det_class($rw3["op_sit"],$rw3["op_prestacion"]).">".$rw3["pac_domicilio"]." ".$rw3["pac_dpto"]."<font size=2> (".$rw3["op_id"].")</font></td>";
							echo "<td class=".det_class($rw3["op_sit"],$rw3["op_prestacion"])."><font size=4>".$rw3["cant_horas"]."</font></td>";
							echo "<td class=".det_class($rw3["op_sit"],$rw3["op_prestacion"])."><font size=4>".($rw3["enf_owner"]=="SOE"?"ZER":$rw3["enf_owner"])."</font></td>";

							if($rw3["op_prestacion"]!="AUDITORIA"){
								echo "<td class=".det_class($rw3["op_sit"],$rw3["op_prestacion"]).">"
									."<a href=".$_SERVER["PHP_SELF"]."?event=upd_opsit"
																	."&op_sit=".$rw3["op_sit"]
																	."&op_id=".$rw3["op_id"]
																	."&table=".$table
																	."&date=".$date."&zona_desc=CUIDAD"
																	."&ubic=schedule class=link>"
																	."<font size=3 face=Arial><b>".($rw3["op_sit"]==0?"QTH":($rw3["op_sit"]==1?"QRU":"OK"))
																	."</b></font></a></td>";
							}else{
								echo "<td class=".det_class($rw3["op_sit"],$rw3["op_prestacion"])."><font size=3 face=Arial><b>-</b></font></a></td>";
							}						echo "</tr>";
						echo "<tr><td colspan=7><hr></td></tr>";
					//}
					$pid_ant=$rw3["pac_id"];
					$opid_ant=$rw3["op_id"];						
					$bgcolor="";
				}

				$pid_ant=$opid_ant=0;
				$bgcolor="";
				$cont=0;
				echo "<tr><td class=subtitulo-soe colspan=7>TURNO TARDE</td></tr>";

				while($rw4=mysqli_fetch_array($query4,MYSQLI_ASSOC)){
					
					//iF($pid_ant==$rw4["pac_id"]&& $opid_ant==$rw4["op_id"] && $_SESSION["user"]=="root"){
					iF($pid_ant==$rw4["pac_id"]){
						//$conn=newConnect();
						//$qr=mysqli_query($conn,"DELETE FROM op2018cuidados where op_id='".$rw4["op_id"]."'")or die(mysqli_error($conn));
						$bgcolor="red";
					}
					//else{
						$cont++;			
						echo "<tr>";
							echo "<td class=".det_class($rw4["op_sit"],$rw4["op_prestacion"])."><font color=".$bgcolor.">".$cont."- </td>";			
							echo "<td class=".det_class($rw4["op_sit"],$rw4["op_prestacion"]).">".$rw4["op_date1"]."</td>";

							echo "<td class=".det_class($rw4["op_sit"],$rw4["op_prestacion"]).">"
									."<a href=".$_SERVER["PHP_SELF"]."?event=det_enf_lst&e_mat=".$rw4["e_mat"]
																						//."&date=".$date."&zona_desc=".urlencode($row["zona_desc"])
																					."&date=".$date."&zona_desc=CUIDAD"
																					."&ubic=det_enf_lst class=link>"
																					."<font size=3 face=Arial>".strtoupper($rw4["enf_apellido"]).",".$rw4["enf_nombre"]."(".$rw4["e_mat"].")</font></a>";
							echo "</td>";

							echo "<td class=".det_class($rw4["op_sit"],$rw4["op_prestacion"]).">".$rw4["pac_domicilio"]." ".$rw4["pac_dpto"]."<font size=2> (".$rw4["op_id"].")</font></td>";
							echo "<td class=".det_class($rw4["op_sit"],$rw4["op_prestacion"])."><font size=4>".$rw4["cant_horas"]."</font></td>";
							echo "<td class=".det_class($rw4["op_sit"],$rw4["op_prestacion"])."><font size=4>".$rw4["enf_owner"]."</font></td>";

							if($rw4["op_prestacion"]!="AUDITORIA"){
								echo "<td class=".det_class($rw4["op_sit"],$rw4["op_prestacion"]).">"
									."<a href=".$_SERVER["PHP_SELF"]."?event=upd_opsit"
																	."&op_sit=".$rw4["op_sit"]
																	."&op_id=".$rw4["op_id"]
																	."&table=".$table
																	."&date=".$date."&zona_desc=CUIDAD"
																	."&ubic=schedule class=link>"
																	."<font size=3 face=Arial><b>".($rw4["op_sit"]==0?"QTH":($rw4["op_sit"]==1?"QRU":"OK"))
																	."</b></font></a></td>";
							}else{
								echo "<td class=".det_class($rw4["op_sit"],$rw4["op_prestacion"])."><font size=3 face=Arial><b>-</b></font></a></td>";
							}						echo "</tr>";
						echo "<tr><td colspan=7><hr></td></tr>";
					//}
					$pid_ant=$rw4["pac_id"];
					$opid_ant=$rw4["op_id"];						
					$bgcolor="";
				}
			echo "</table>";
		echo "</td>";


	echo "</tr>";
echo "</table>";
?>
