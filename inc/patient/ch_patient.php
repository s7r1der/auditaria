<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php  

if(($_SESSION["dato_busq"]!="" && isset($_SESSION["sel_var"]) && $_SESSION["sel_var"]==1) || $_SESSION["dato_busq"]==""){
	$_SESSION["sel_var"]=0;
}
	
$res=mysqli_query($conn,"SELECT * FROM paciente WHERE ".$_SESSION["opt_busq"]." = '".$_SESSION["dato_busq"]."' order by pac_id") or die(mysql_error($conn));

if(mysqli_num_rows($res)==1){
	
	$_SESSION["find"]=1;
	
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){

		echo "<TABLE width=100% bord=er=1>";

				echo "<TR><TD align=center>";
					if($_SESSION["usr_role"]=="sema" || $_SESSION["usr_role"]=="semasm") include ("inc/enc_menu_useradm.php");
					include("inc/patient/enc_hc.php"); 
				echo "</td></tr>";

				echo "<TR><TD align=center>";
					include("inc/patient/menu_hc.php");
				echo "</td></tr>";

	$dt1=split_date($_SESSION["fec1"]);
	$dt2=split_date($_SESSION["fec2"]);

	//MENU MATERIALES
	if($_SESSION["usr_role"]!="sema"){
	echo "<tr><td>";

		echo "<table width=100% class=myTable-gray><tr>";

		echo "<td align=center colspan=2 width=50% class=titulo><a href=".$_SERVER["PHP_SELF"]."?event=viewdetxos"."&pac_id=".$row["pac_id"]
																			."&fec_beg=".$dt1["year"]."-".$dt1["month"]."-".$dt1["day"]
																			."&fec_fin=".$dt2["year"]."-".$dt2["month"]."-".$dt2["day"]
																			." title=\"Ver Detalle x paciente\">"

							."<font color=white>".$row["pac_domicilio"]."</a>"
							."<a href=".$_SERVER["PHP_SELF"]."?event=viewdomxos"."&pac_id=".$row["pac_id"]
																			."&fec_beg=".$dt1["year"]."-".$dt1["month"]."-".$dt1["day"]
																			."&fec_fin=".$dt2["year"]."-".$dt2["month"]."-".$dt2["day"]
																			." title=\"Ver Detalle x domicilio\">"
							."<font color=white> - ".$row["pac_dpto"]."</a></td>";

		/*echo "<td align=center width=50% class=titulo><table width=100%><tr><td align=center>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=mat_hc_cfg&dato=".$row["pac_id"]." title=\"Modificar pacientes\">"
								."<font color=white size=4><b>Material utilizado</b></a></td>";

			$qy=mysql_select("Gasa,Apos,Vend","mat_paciente","pac_id='".$row["pac_id"]."'");
		
			if($rw=mysql_fetch_array($qy,MYSQL_ASSOC)){
				echo 	"<td><font color=white>GASAS: "	.$rw["Gasa"]	."</font></td>"
						."<td><font color=white>APOS: "	.$rw["Apos"]	."</font></td>"
						."<td><font color=white>VENDAS:".$rw["Vend"]	."</font></td>";
			}*/
			echo "</tr></table>";
		echo "</td></tr></table></td>"; 
	echo"</td></tr>";
	}elseif($_SESSION["usr_role"]=="sema" ||$_SESSION["usr_role"]=="semasm"){
	echo "<tr><td><table width=100%><tr>";

		echo "<td align=center width=50% class=subhead><a href=".$_SERVER["PHP_SELF"]."?event=viewdetxos"."&pac_id=".$row["pac_id"]
																			."&fec_beg=".$dt1["year"]."-".$dt1["month"]."-".$dt1["day"]
																			."&fec_fin=".$dt2["year"]."-".$dt2["month"]."-".$dt2["day"]
																			." title=\"Ver Detalle x paciente\">"

							."<font color=white>".$row["pac_domicilio"]." ".$row["pac_dpto"]."</a></td>";
							/*."<a href=".$_SERVER["PHP_SELF"]."?event=viewdomxos"."&pac_id=".$row["pac_id"]
																			."&fec_beg=".$dt1["year"]."-".$dt1["month"]."-".$dt1["day"]
																			."&fec_fin=".$dt2["year"]."-".$dt2["month"]."-".$dt2["day"]
																			." title=\"Ver Detalle x domicilio\">"
							."<font color=black> - ".$row["pac_dpto"]."</a></td>"; */

		echo "<td><table width=100% class=menu><tr><td>Material utilizado</a></td>";

			$qy=mysql_select("Gasa,Apos,Vend","mat_paciente","pac_id='".$row["pac_id"]."'");
		
			if($rw=mysql_fetch_array($qy,MYSQL_ASSOC)){
				echo 	"<td>GASAS: "	.$rw["Gasa"]	."</td>"
						."<td>APOS: "	.$rw["Apos"]	."</td>"
						."<td>VENDAS:"	.$rw["Vend"]	."</td>";
			}
			echo "</tr></table>";
		echo "</td></tr></table></td>"; 
	echo"</td></tr>";
	}
		
	switch($_SESSION["pos"]){
		case "hc_atention":		//echo "<TR><TD>	";	include("inc/patient/enc_table_hc.php");		echo"</TD></TR>";
								echo "<TR><TD>";	include("inc/patient/ch_atention_data.php");	echo"</TD></TR>";
								break;

		case "sond_hc_pac":		echo "<TR><TD>";	include("inc/patient/sond_hc_pac.php");		echo"</TD></TR>";
								break;

		case "nov_hc_pac":		echo "<TR><TD>";	include("inc/patient/nov_hc_pac.php");			echo"</TD></TR>";
								break;

		case "evol_hc_pac":		echo "<TR><TD>";	include("inc/patient/evol_hc_pac.php");		echo"</TD></TR>";
								break;

		case "evolmen_hc_pac":	echo "<TR><TD>";	include("inc/patient/evol.men_hc_pac.php");	echo"</TD></TR>";
								break;

		case "mat_hc":			echo "<TR><TD>";	include("inc/patient/datos_prestacion.php");	echo"</TD></TR>";
								break;

		case "ubc_hc_pac":		echo "<TR><TD align=center>"; include("inc/patient/show_ubic.php");	echo"</TD></TR>";
								break;

		case "evolmen_hc_pac_detsum":	echo "<TR><TD>";	include("inc/detail/det_summary.php");	echo"</TD></TR>";
										break;

		}	//switch
	echo	"</table>";
	}	//while

}elseif(mysqli_num_rows($res)==0){

		$_SESSION["find"]=0;
		$row["pac_nombre"]=$row["pac_apellido"]="";
		$row["pac_domicilio"]=$row["pac_dpto"]=$row["pac_os"]="";
		$row["pac_telefono"]="";
		$row["fecha_nac"]=$row["med"]=$row["antec"]=$row["op_prestacion"]="";
		$row["op_desp"]=$row["op_coseg"]=$row["e_mat"]="";
		$row["pac_id"]="";
		$row["pac_os"]="-";
		
		include("inc/patient/ch_personal_data.php");
		include("inc/patient/ch_atention_data.php");	
		echo	"</td></tr></table>";
	}else{
		$_SESSION["find"]=1;
		include("inc/datos_select.php");
	}
?>
