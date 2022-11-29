<link rel="StyleSheet" href="css/schedule.css" type="text/css">

<?php
//inicializacion de variables
global $dat_col;
global $tab_color;

if(!isset($_GET["opts"])) $_GET["opts"]="pendiente";

$fec1=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"]." 00:00:00";
$fec2=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"]." 23:59:59";

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

//echo $cond;

echo "<table width=100% align=center>";
	echo "<tr valign=top>";
		echo "<td width=50%>";
			echo "<table class=myTable-gray width=100%>";
				echo "<tr><td class=titulo-coop colspan=6>COOP</td></tr>";
				echo "<tr><td class=subtitulo-coop colspan=6>TURNO MAÑANA</td></tr>";

				$query1=mysqli_query($conn,"select op.pac_id,op.op_id,op.e_mat,op.pac_id,op.op_date,pac.pac_apellido,pac.pac_nombre,pac.pac_domicilio,pac.pac_os,"
									."op.cant_horas,pac.pac_dpto,op.op_prestacion,date_format(op.op_date,\"%H:%i\") as op_date1,date_format(op.op_date,\"%H\") as op_hour,"
									."enf.enf_apellido,enf.enf_nombre,enf.enf_owner"
									." FROM ".$table." op join paciente pac on op.pac_id=pac.pac_id join enfermero enf on op.e_mat=enf.e_mat"
									." WHERE op.op_date between '".$fec1."' and '".$fec2."'".$cond
									." ORDER BY enf.enf_owner,op.op_date,enf.enf_apellido") or die(mysqli_error($conn));
				
				$cont=$cambio=0;

				$titulo="COOP";

				while($rw1=mysqli_fetch_array($query1,MYSQLI_ASSOC)){

					if($titulo!=$rw1["enf_owner"]){
						$titulo=$rw1["enf_owner"];
						$cambio=0;
						echo "</table>";
							echo "</td><td>";
								echo "<td>";
									echo "<table class=myTable-gray width=100%>";
										echo "<tr valign=top><td class=titulo-soe colspan=6>".$titulo."</td></tr>";
										echo "<tr><td class=subtitulo-".$rw1["enf_owner"]." colspan=6>TURNO MAÑANA</td></tr>";
		

						$cont=0;
					}

					$cont++;

					if($rw1["op_hour"]>"12" && $cambio==0){
						$cambio=1;
						echo "<tr><td class=subtitulo-".$rw1["enf_owner"]." colspan=6>TURNO TARDE</td></tr>";
					}
			
					echo "<tr>";
						echo "<td>".$cont."- </td>";
						echo "<td>".$rw1["op_date1"]."</td>";
						echo "<td align=center>".$rw1["pac_domicilio"]." ".$rw1["pac_dpto"]."</td>";
						echo "<td><font size=4>".$rw1["cant_horas"]."</font></td>";
						echo "<td align=center>"
								."<a href=".$_SERVER["PHP_SELF"]."?event=det_enf_lst&e_mat=".$rw1["e_mat"]
																					//."&date=".$date."&zona_desc=".urlencode($row["zona_desc"])
																				."&date=".$date."&zona_desc=CUIDAD"
																				."&ubic=det_enf_lst class=link>"
																				."<font size=3 face=Arial>".$rw1["enf_apellido"].",".$rw1["enf_nombre"]."(".$rw1["e_mat"].")</font></a>";
						echo "</td>";
						echo "<td><font size=4>".$rw1["enf_owner"]."</font></td>";
					echo "</tr>";
					echo "<tr><td colspan=6><hr></td></tr>";
				}
		echo "</td>";
	echo "</tr>";
echo "</table>";
?>
