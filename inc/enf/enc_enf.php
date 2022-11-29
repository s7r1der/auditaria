<link rel="StyleSheet" href="css/schedule.css" type="text/css">

<?php  

include("inc/schedule/schedule_func.php");

if(!isset($_GET["table"]))	$table="op".$_SESSION["year_tmp"]."cuidados";

switch($_SESSION["pos"]){
	case "list_all_enf":
		$event="list_all_enf";
		$emat="&ubic=list_all_enf&zona_desc=".urlencode("ZONA CIUDAD");
		break;
	case "show_rts":
		$event="show_rts";
		$emat="&e_mat=".$_GET["e_mat"]."&ubic=rts&zona_desc=".urlencode("ZONA CIUDAD");
		break;
	case "det_enf_lst":															
		$event="det_enf_lst";
		$emat="&e_mat=".$_GET["e_mat"]."&ubic=det_enf_lst&zona_desc=".urlencode("ZONA CIUDAD");
		break;
	case "det_enf_lst_evol":
		$event="det_enf_lst_evol";
		$emat="&e_mat=".$_GET["e_mat"]."&ubic=det_enf_lst&zona_desc=".urlencode("ZONA CIUDAD");
		break;
	default:
		$event="list_all_enf";
		$emat="&ubic=list_all_enf&zona_desc=".urlencode("ZONA CIUDAD");
		break;
}


echo "<table align=center class=menu-gray width=100%>";
	echo "<tr>";
		echo "<td class=titulo>"
			."<a href=".$_SERVER["PHP_SELF"]."?event=".$event
							."&date=".det_dia($_SESSION["day_tmp"],$_SESSION["month_tmp"],$_SESSION["year_tmp"],-1).$emat." class=encabezado-head>"
								."<img src=\"iconos/icons/flecha8.gif\" border=0 width=24 title=\"Dia Anterior\"></a>";
		echo "</td>";
								
		echo "<td class=titulo>"
				."<a href=".$_SERVER["PHP_SELF"]."?event=schedule"	."&day=".($_SESSION["day_tmp"])
																	."&month=".($_SESSION["month_tmp"])
																	."&year=".($_SESSION["year_tmp"])
																	."&zona_desc=".urlencode("ZONA CIUDAD")
																	."&ubic=list_all_enf class=encabezado-head>"
					."<font size=5><b>".$_SESSION["day_tmp"]."/".$_SESSION["month_tmp"]."/".$_SESSION["year_tmp"]."</b></font></a>";
		echo "</td>";

		echo "<td class=titulo>"
				."<a href=".$_SERVER["PHP_SELF"]."?event=list_all_enf"	."&day=".($_SESSION["day_tmp"])
																		."&month=".($_SESSION["month_tmp"])
																		."&year=".($_SESSION["year_tmp"])
																		."&zona_desc=".urlencode("ZONA CIUDAD")
																		."&ubic=list_all_enf class=encabezado-head>"
					."<font size=1><b>RESUMEN"."</b></font></a>";
		echo "</td>";

		echo "<td class=titulo>"
				."<a href=".$_SERVER["PHP_SELF"]."?event=".$event
								."&date=".det_dia($_SESSION["day_tmp"],$_SESSION["month_tmp"],$_SESSION["year_tmp"],1)
								.$emat."><img src=\"iconos/icons/flecha2.gif\" border=0 width=24 title=\"Siguiente Dia\"></a>";
		echo "</td>";

	
	/*$qrm=$qrt=$evom=$evot=0;

	$conn=newConnect()
	$qr1=mysqli_query($conn,"SELECT op.e_mat,op.op_sit,sum(IF(op.op_sit>=5,1,0)) as comp, count(op.op_id) as cont"
					.",CONCAT(enf.enf_nombre,' ',enf.enf_apellido) as enfermero,enf.enf_turno,enf.enf_apellido FROM ".$table." op left join enfermero enf on op.e_mat=enf.e_mat"
					." WHERE op_date between '"
							.$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"]." 00:00:00' and '"
							.$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"]." 23:59:00'"
							." GROUP BY e_mat order by enf.enf_apellido");	

	//Show did prestation quantity for each nurses.
	while($rw2=mysqli_fetch_array($qr1,MYSQLI_ASSOC)){
		$qts[$rw2["e_mat"]]=$rw2["cont"];
		$real[$rw2["e_mat"]]=$rw2["comp"];

		//$qr3="";

		$nombre[$rw2["e_mat"]]=$rw2["enfermero"];

		if($rw2["enf_turno"]=="AM"){
			$enfam[$i]=$rw2["e_mat"];
			$i++;
		}elseif($rw2["enf_turno"]=="PM"){
			$enfpm[$j]=$rw2["e_mat"];
			$j++;
		}elseif($rw2["enf_turno"]=="AP"){
			$enfam[$i]=$rw2["e_mat"];
			$enfpm[$j]=$rw2["e_mat"];
			$j++;	
			$i++;
		}
	} 
	*/
	echo "<td class=titulo>";
		echo "<a href=".$_SERVER["PHP_SELF"]."?event=buscar_dato"	."&ubic=schedule"
																	."&fec_hora=".date("H")."##hora".date("H")." class=myButton-dark>"
																	."Nuevo Registro</a>";
	echo "</td></tr>";
echo "</table>";
?>