<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php 

$orden=(date("%H")>14?"asc":"desc");

$dat_color="#330099";

$fec1=$_SESSION["fec1"];
$fec2=$_SESSION["fec2"];

$table_in=substr($fec1,0,4)."cuidados";
$table_stop=substr($fec2,0,4)."cuidados";

$_GET["year"]=$table_in;

$id=$sum=$i=0;

switch(type_user($_SESSION["user"])){
	case "0":
	case "1":
		$cond=" AND op.op_reg='".type_user($_SESSION["user"])."'";	break;
	case "2":
		$cond="";	break;
}


$conn=newConnect();
$query=mysqli_query($conn,"select pac.pac_id,op.op_id,op.op_formato,op.cant_horas,op.op_reg,"
				."op.op_id,op.pac_id,op.op_prestacion,op.op_sit,op.op_date,op.e_mat,"
				."pac.pac_os,pac.pac_telefono,date_format(op.op_date, \"%d/%m/%y\") as op_date1,"
				."date_format(op.op_date,\"%T\") as op_time,"
				."CONCAT(enf.enf_nombre,' ',enf.enf_apellido) as enfermero,enf.enf_role,enf_owner,"
				."CONCAT(pac.pac_domicilio,' ',pac.pac_dpto) as domicilio,CONCAT(pac.pac_apellido,' ',pac.pac_nombre) as paciente "
						." FROM op".$table_in." op join paciente pac on op.pac_id=pac.pac_id join enfermero enf ON op.e_mat=enf.e_mat"
						." WHERE op.e_mat='".$_POST["e_mat"]."'"
						." AND op.op_date between '".$fec1."' and '".$fec2."'"
						.$cond
						." ORDER By op.op_date") or die(mysqli_error($conn));
	
while($row5=mysqli_fetch_array($query,MYSQLI_ASSOC)){
	$enf_owner=$row5["enf_owner"];

	if($id==0){

		$fecha=explode(" ",$fec1);

		echo "<table class=myTable-gray width=100%>";


			echo "<tr><td class=titulo-".$row5["enf_owner"]." colspan=11>";
						echo "<a href=\"javascript:void(0)\" "
							."onclick=\"window.open('".$_SERVER["PHP_SELF"]."?event=nh_show_res_enf&e_mat=".$_POST["e_mat"]."'"
							.",'','width=450,height=300,noresize')\"><b><font size=6 color=white>".$row5["enfermero"]
																//."<font size=3> (".$qts[$_POST["e_mat"]].", ".$real[$_POST["e_mat"]].") - ".$row5["e_mat"]." -</font></b></td></tr>";
																."<font size=5> - (".$row5["e_mat"].")</font></b>"
																."<a href=".$_SERVER["PHP_SELF"]."?event=add_legajo"."&e_mat=".$_POST["e_mat"]
																			."&ubic=det_enf_lst"
																			." class=Button><font size=2 color=white> Agregar al Legajo</font></a>";
			echo "</td></tr>";
		
			echo	"<tr><td colspan=11 class=titulo-".$row5["enf_owner"]."><b><FONT SIZE=\"4\">PRESTACIONES REALIZADAS</FONT></b><br></CENTER>";

			echo"<tr>";
				echo "<td class=subtitulo-".$row5["enf_owner"]."><b>N°</b></td>";
				echo "<td class=subtitulo-".$row5["enf_owner"]."><b>HORA</b></td>";
				echo "<td class=subtitulo-".$row5["enf_owner"]."><b>DOMICILIO</b></td>";
				echo "<td class=subtitulo-".$row5["enf_owner"]."><b>PRESTACION</b></td>";						
				echo "<td class=subtitulo-".$row5["enf_owner"]."><b>HORAS</b></td>";						
				echo "<td class=subtitulo-".$row5["enf_owner"]."><b>FORMATO</b></td>";						
				//echo "<td class=subhead><b>Vis</b></td>";	
				echo "<td class=subtitulo-".$row5["enf_owner"]."><b>OSOCIAL</b></td>";
				//echo "<td class=head-blu-c><b>COSEG</b></td>";
				echo "<td class=subtitulo-".$row5["enf_owner"]."><b>TEL.</b></td>";
				echo "<td colspan=4 class=subtitulo-".$row5["enf_owner"].">";
					/*echo "<a href=".$_SERVER["PHP_SELF"]."?event=set_falta_all"."&e_mat=".$_POST["e_mat"]
																		."&table=op".(substr($fec1,0,4))."cuidados"
													

																		."&op_date=".$fecha[0]
																		."&zona_desc=".urlencode($_GET["zona_desc"])
																		."&ubic=det_enf_lst"
																		."&e_mat=".$_POST["e_mat"]." class=CirButton><font size=2>Falta s/aviso</font></a>";*/
				echo "</td>";
			echo "</tr>";
	}
	
	$id=$id+1;
	$classd=($row5["op_reg"]==0?"COOP":"SOE");
	
	echo "<tr>";				
		echo "<td class=subtitulo-".$classd." align=center>"
				."<a href=".$_SERVER["PHP_SELF"]."?event=upd_enf_cfg"	."&op_id=".$row5["op_id"]
																		."&table=op".(substr($row5["op_date"],0,4))."cuidados"
																		."&zona_desc=".urlencode($_GET["zona_desc"])
																		."&ubic=det_enf_lst"
																		."&e_mat=".$_POST["e_mat"]." class=link><font size=2>".$id."</font></a>";
		echo "</td>";

		echo "<td class=".$classd."><font size=4 face=Arial>".$row5["op_time"]."</font></td>";
		//echo "<td class=".$classd."><font size=2 face=Arial>".$row5["op_date1"]."<br>".$row5["op_time"]."</font></td>";


		echo "<td class=".$classd."><p align=left>"
					."<font size=2 face=Arial><b>".$row5["domicilio"]."</b></font></a>"
					."<br>"
					
				."<a href=".$_SERVER["PHP_SELF"]."?event=det_lst_sh_hc"."&pac_id=".$row5["pac_id"]
																		."&fec_beg=".date("Y")."-".(date("m"))."-01"
																		."&fec_fin=".date("Y")."-".date("m")."-31"
																		."&zona_desc=".urlencode($_GET["zona_desc"])
																		." title=\"Ver Historia Clinica\" class=greenLink>"								
																		."<font size=2 face=Arial>".$row5["paciente"]." - (".$row5["pac_id"].")</font></a>";
		echo "</td>";
		
		echo "<td class=".$classd.">";
			echo "<p align=left><font face=Arial>".$row5["op_prestacion"]."</font>"
					."<br><font size=1 face=Arial>(".$row5["op_id"].")</font></p>";
		echo "</td>";

		echo "<td class=".$classd."><p align=center><font face=Arial><b>".$row5["cant_horas"]."</b></font></p></td>";
		echo "<td class=".$classd."><p align=center><font face=Arial><b>".strtoupper($row5["op_formato"])."</b></font></p></td>";
		
		$color_repeat="black";

		/*echo "<td class=".$classd.">";
			echo "<a href=\"javascript:void(0)\" "
				."onclick=\"window.open('".$_SERVER["PHP_SELF"]."?event=nh_visitas&pac_id=".$row5["pac_id"]."&op_date=".substr($row5["op_date"],0,10)."'"
				.",'','width=450,height=250,noresize')\">"
				."<font size=2 color=".$color_repeat." face=Arial><b>".$_SESSION["visita"][$row5["pac_id"]]."</b></font></a></td>";*/
							
		echo "<td class=".$classd."><p align=left><font size=2 face=Arial>"
			.($row5["pac_os"]=="SEMA MODULO A"?"SEMA <B>A</B>":($row5["pac_os"]=="SEMA"?"SEMA <B>B</B>":($row5["pac_os"]=="SEMA MODULO C"?"SEMA <B>C</B>":$row5["pac_os"])))."</font></p></td>";
		
		//echo "<td class=".$classd." align=center><font size=3 face=Arial>".$row5["op_coseg"]."</font></td>";
		echo "<td class=".$classd.">".$row5["pac_telefono"]."</td>";

		if($_SESSION["usr_role"]=="admin" && $_SESSION["usr_level"]>=2){

			/*echo "<td>	<a href=".$_SERVER["PHP_SELF"]."?event=set_sch"
																	."&op_id=".$row5["op_id"]
																	."&e_mat=".$row5["e_mat"]
																	."&pac_id=".$row5["pac_id"]
																	."&table=op".(substr($row5["op_date"],0,4))."cuidados"
																	."&zona_desc=".urlencode($_GET["zona_desc"])
																	."&ubic=det_enf_lst class=CirButton title=Reiniciar><font size=2><b>R</b></font></a></td>";*/

			echo "<td align=center>	<a href=".$_SERVER["PHP_SELF"]."?event=del_sch_cfg"
																	."&op_id=".$row5["op_id"]
																	."&e_mat=".$row5["e_mat"]
																	."&pac_id=".$row5["pac_id"]
																	."&table=op".(substr($row5["op_date"],0,4))."cuidados"
																	."&zona_desc=".urlencode($_GET["zona_desc"])
																	."&ubic=det_enf_lst class=CirButton title=Borrar><font size=2><b>Borrar</b></font></a></td>";

			echo "<td align=center>	<a href=".$_SERVER["PHP_SELF"]."?event=planif_sch"
																	."&op_id=".$row5["op_id"]
																	."&e_mat=".$row5["e_mat"]
																	."&pac_id=".$row5["pac_id"]
																	."&table=op".(substr($row5["op_date"],0,4))."cuidados"
																	."&zona_desc=".urlencode($_GET["zona_desc"])
																	."&ubic=det_enf_lst class=CirButton title=Planificar><font size=2><b>Planif</b></font></a></td>";

			/*echo "<td>	<a href=".$_SERVER["PHP_SELF"]."?event=add_annex"
																	."&op_id=".$row5["op_id"]
																	."&e_mat=".$row5["e_mat"]
																	."&pac_id=".$row5["pac_id"]
																	."&table=op".(substr($row5["op_date"],0,4))."cuidados"
																	."&zona_desc=".urlencode($_GET["zona_desc"])
																	."&ubic=det_enf_lst class=CirButton title=Agregar Nota><font size=2><b>N</b></font></a></td>";*/


		}
			

	$sum=$sum+$row5["cant_horas"];
	echo "</tr>";
	
}

echo "<tr>"
			."<td class=titulo-".$enf_owner."><FONT SIZE=\"4\"><b>".$id."</b></font></td>"
			."<td colspan=10 class=titulo-".$enf_owner.">".$sum." HS.</b></font></td></tr>";
				//number_format(abs(($sum[$i]/10)),1)."</b></font></td></tr>";

echo "</table>";
