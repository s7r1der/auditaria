<link rel="StyleSheet" href="css/schedule.css" type="text/css">

<?php

$prestacion="Paciente Obito";
$total=0;

$zona3=str_replace('"','',urldecode($_GET["zona_desc"]));

if(isset($_GET["op_prestacion"]))	$prestacion=$_GET["op_prestacion"];


$date=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"];


$conn=newConnect();
//consulta y separa todos las prestaciones segun la prestacion
$qry=mysqli_query($conn,"SELECT op_prestacion,count(op_prestacion) as cant,op_reg"
						." FROM op".$_SESSION["year_tmp"]."cuidados"
						." WHERE op_date between '".$date." 00:00:00' and '".$date." 23:59:59' AND op_reg='".type_user($_SESSION["user"])."'"
						." GROUP BY op_prestacion") or die(mysqli_error($conn));

$qry2=mysqli_query($conn,"SELECT CONCAT(pac.pac_nombre,' ',pac.pac_apellido) as paciente,op.op_date,pac.pac_dpto,"
						."op.op_prestacion,CONCAT(pac.pac_domicilio,' ',pac.pac_dpto) as domicilio,op.e_mat,op.op_reg"
						." FROM op".$_SESSION["year_tmp"]."cuidados op left join paciente pac on op.pac_id=pac.pac_id"
						." WHERE op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59' AND op.op_reg='".type_user($_SESSION["user"])."'"
						." and op.op_prestacion='".$prestacion."'");


echo "<table align=center class=encabezado width=100%><tr valign=top><td>";
	
	echo "<tr>"; 
		echo "<td class=titulo><u>PRESTACIONES.</u></td>";
		echo "<td class=titulo><u>".strtoupper($prestacion)."</u></td>";
	echo "</tr>";


	echo "<tr valign=top>";
		echo "<td>";
			echo "<table>";
			
				while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){

				echo "<tr>";
					echo "<td>";
						echo "<a href=\"".$_SERVER["PHP_SELF"]."?event=list_all_enf"	."&day=".($_SESSION{"day_tmp"})
																						."&month="	.($_SESSION{"month_tmp"})
																						."&year="	.($_SESSION{"year_tmp"})
																						."&op_prestacion=".$row["op_prestacion"]
																						."&zona_desc=".urlencode($zona3)."\" class=link>"
																						."<font size=3 face=Arial><b>".$row["op_prestacion"]."</b></font></a>";
					echo "</td>";
		//	echo "<tr><td>".$row["op_prestacion"]."</td>";
					echo "<td>".$row["cant"]."</td>";
				echo "</tr>";
				
				$total=$total+$row["cant"];
				}

				echo "<tr><td colspan=2 class=subtitulo>".$total."</td></tr>";
			echo "</table>"; 
		echo "</td>";

		echo "<td>";
			echo "<table>";

				$cont=1;
				while($row1=mysqli_fetch_array($qry2,MYSQLI_ASSOC)){
					echo "<tr valign=center>";
						echo "<td>".$cont." - ".$row1["domicilio"];
							echo "<a href=\"".$_SERVER["PHP_SELF"]."?event=det_enf_lst"	."&e_mat=".$row1["e_mat"]
																						."&date=".$date."&ubic=det_enf_lst"
																						."&zona_desc=".urlencode(det_zona($row1["pac_dpto"]))."\" class=link>"
																						."<font size=1><b>(".$row1["e_mat"].")</b></a></td>	";
						echo "<td>";
							echo "<a href=".$_SERVER["PHP_SELF"]."?event=det_enf_lst_evol&e_mat=".$row1["e_mat"]
																			."&date=".$fec."&zona_desc=".urlencode(det_zona($row1["pac_dpto"]))."\" class=link>"
																			."<font size=1>EVOL</a></td>";


						echo "</td>"; 
					echo "</tr>";											
					$cont++;
				}
			
			echo "</table>";
		echo "</td>";
	echo "</tr>";
echo "</table>";

?>