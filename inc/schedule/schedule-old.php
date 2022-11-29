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

/*
//Calcula la cantidad de domicilios realizados y el total de domicilio que tiene cada enfermero
$qr1=mysql_select("op.e_mat,op.op_sit,sum(IF(op.op_sit>=5,1,0)) as comp,"
							." count(op.op_id) as cont,CONCAT(enf.enf_nombre,' ',enf.enf_apellido) as enfermero,"
							."enf.enf_turno,enf.enf_apellido"
							,$table." op left join enfermero enf on op.e_mat=enf.e_mat"
							,"op_date between '".
							$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"]." 00:00:00' and '".
							$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"]." 23:59:00'"
							." GROUP BY e_mat order by enf.enf_apellido");	

while($rw2=mysql_fetch_array($qr1,MYSQL_ASSOC)){
	$qts[$rw2["e_mat"]]=$rw2["cont"];
	$real[$rw2["e_mat"]]=$rw2["comp"];

} 

//Calcula la cantidad de visitas diarias por paciente  
$querytmp=mysql_query("SELECT pac_id,count(op_id) as cant"
						." FROM op".$_SESSION["year_tmp"]
						."	WHERE op_date between '".$fec1."' and '".$fec2."'"
						//." AND op_coseg<=0"
						." GROUP BY pac_id");

while($tmp=mysql_fetch_array($querytmp,MYSQL_ASSOC)){
	$_SESSION["visita"][$tmp["pac_id"]]=$tmp["cant"];
} */

//carga enzcabezado menu

$conn=newConnect();

include("inc/schedule/menu_schedule.php");

//calcula enfermeros por turno y por zonas
$query=mysqli_query($conn,"select zona.zona_desc,zona.e_mat,enf.enf_estado,enf.enf_turno,CONCAT(enf.enf_apellido,' ',enf.enf_nombre) as enfermero "
							." FROM zonaenf zona left join enfermero enf on enf.e_mat=zona.e_mat "
							." WHERE enf_estado='ACTIVO' order by zona.zona_desc,enf.enf_turno,enf.enf_apellido");
$zonant="";
$turant="";

$opt=$title="";

if($_GET["opts"]=="pendiente"){
	$opt=" AND (op.e_mat=4444 or op.e_mat=9993)";
	$title="PENDIENTES";
}elseif($_GET["opts"]=="papelera"){
	$opt=" AND op.e_mat='9991'";
	$title="PAPELERA";
}

echo "<table>";

	echo "<tr valign=top>";
		//Primera columna muestra los domicilios pendientes de distribucion.
		echo "<td align=left>";
			echo "<table class=myTable-gray>";
				echo "<tr>"; 
					echo"<td class=titulo colspan=2>";
						echo "<a href=".$_SERVER["PHP_SELF"]."?event=hrs_direct"
																			."&opts=".($title=="PENDIENTES"?"papelera":"pendiente")
																			."&date=".$date
																			."&ubic=det_enf_lst class=encabezado-head>"
																			."<font size=4><b>".$title."  </b></font></a>";
						if($_GET["opts"]=="papelera"){
							echo "<a href=".$_SERVER["PHP_SELF"]."?event=vaciar_papelera"
											."&opts=papelera"
											."&table=".$table
											."&date=".$date
											."&ubic=det_enf_lst class=CirButton title=Borrar><font size=2><b>V</b></font></a></td>";
						}
					echo "</td>";

				echo "</tr>";

				$query1=mysqli_query($conn,"select op.pac_id,op.op_id,op.e_mat,op.pac_id,op.op_date,pac.pac_apellido,pac.pac_nombre,pac.pac_domicilio,"
									."pac.pac_os,pac.pac_dpto,op.op_prestacion,date_format(op.op_date,\"%H:%i\") as op_date1"
									." FROM ".$table." op left join paciente pac on op.pac_id=pac.pac_id"
									." WHERE op.op_date between '".$fec1."' and '".$fec2."'"
									.$opt
									." ORDER BY pac.pac_dpto") or die(mysqli_error($conn));
				
				$cont=0;
				while($rw1=mysqli_fetch_array($query1,MYSQLI_ASSOC)){
					$cont++;
					echo "<tr><td align=left><font size=2>".$rw1["op_date1"]." - ".$rw1["pac_domicilio"]." ".$rw1["pac_dpto"]."</td></tr>";
					echo "<tr><td>"
						."<a href=".$_SERVER["PHP_SELF"]."?event=det_lst_sh_hc"."&pac_id=".$rw1["pac_id"]
																."&fec_beg=".date("Y")."-".date("m")."-01"
																."&fec_fin=".date("Y")."-".date("m")."-31"
																."&zona_desc=".urlencode(det_zona($rw1["pac_dpto"]))
																." title=\"Ver Historia Clinica\" class=pendiente>"								
																."<font size=2 face=Arial>".$rw1["pac_apellido"].", ".$rw1["pac_nombre"]." - (".$rw1["pac_id"].")</font></a>";
					echo "</td></tr>";


					echo "<tr><td align=left><font size=2 color=green><b>".$cont." - ".$rw1["pac_os"]."</b></td></tr>";
					//http://200.51.41.203/pruebasoe/index.php?event=upd_sch&op_id=1180277&ubic=det_enf_lst&table=op2016##hora2
					echo "<tr><td align=left>"
								."<font size=2><a href=".$_SERVER["PHP_SELF"]."?event=assign_qt_pend&op_id=".$rw1["op_id"]
																	."&table=".$table."&zona_desc=".urlencode(det_zona($rw1["pac_dpto"]))
																	."&ubic=det_enf_lst class=pendiente>"	.$rw1["op_prestacion"]
																											." (".$rw1["e_mat"].")  </a>";													
												if($_GET["opts"]=="papelera"){
													echo "<a href=".$_SERVER["PHP_SELF"]."?event=del_sch_dir"
																								."&op_id=".$rw1["op_id"]
																								."&opts=papelera"
																								."&table=op".(substr($rw1["op_date"],0,4))
																	."&ubic=det_enf_lst class=CirButton title=Borrar><font size=2><b>B</b></font></a></td>";
												}
					echo "</td></tr>";
					echo "<tr><td><hr></td></tr>";
				}
			echo "</table>";
		
		echo "</td><td>";
		//Detalla los enfermeros por zonas en distintas tablas.
		while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
			
			if($zonant!=$row["zona_desc"]){
				
				if($zonant!="") echo "</table></td>";
				$zonant=$row["zona_desc"];
		
				echo "<td>"
					."<table class=myTable-gray>";
						echo "<tr><td class=titulo colspan=3>"
							."<font size=4><b>".($row["zona_desc"]=="ZONA GODOY CRUZ"?"ZONA G CRUZ":($row["zona_desc"]=="ZONA GUAYMALLEN"?"ZONA GLLEN":$row["zona_desc"]))."</b></font>";
						echo "</td></tr>";
			}
		
			if($turant!=$row["enf_turno"]){
	 			$turant=$row["enf_turno"];

					echo "<tr><td colspan=3 class=subtitulo>".($row["enf_turno"]=="AM"?"TURNO MANANA":($row["enf_turno"]=="AP"?"AMBOS TURNOS":"TURNO TARDE"))."</td></tr>";
			}	

			if(isset($qts[$row["e_mat"]])){
				$diff=$qts[$row["e_mat"]]-$real[$row["e_mat"]];
				$class=($diff==0?"finish":(($diff<3 && $diff>0)?"warning":"begin"));

				echo "<tr>";
					echo "<td class=".$class." align=left>"
					//echo "<td align=left class=".$class.">"
						."<a href=".$_SERVER["PHP_SELF"]."?event=det_enf_lst&e_mat=".$row["e_mat"]
																			."&date=".$date."&zona_desc=".urlencode($row["zona_desc"])
																			."&ubic=det_enf_lst class=link>"
																			.$row["enfermero"]."</a></td>";
					
					echo "<td class=".$class.">"
						."<a href=".$_SERVER["PHP_SELF"]."?event=show_rts&e_mat=".$row["e_mat"]
																		."&date=".$date."&zona_desc=".urlencode($row["zona_desc"])
																		."&ubic=rts class=link>"
																		."<font size=1>".$row["e_mat"]."</font></a></td>";

					echo "<td class=".$class.">"
						."<a href=".$_SERVER["PHP_SELF"]."?event=det_enf_lst_evol&e_mat=".$row["e_mat"]
																			."&date=".$date."&zona_desc=".urlencode($row["zona_desc"])
																			."&ubic=det_enf_lst class=link>"
																			."<font size=1>(".$qts[$row["e_mat"]].",".$real[$row["e_mat"]].")</a></td>";
				echo "</tr>";
				//echo "<tr><td colspan=2><hr></td></tr>";
			}
		}

	echo "</td></tr>";
echo "</table>";
?>
