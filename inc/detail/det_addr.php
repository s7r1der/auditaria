<link rel="StyleSheet" href="css/hc.css" type="text/css">

<?php  	

//MUESTRA DETALLE POR DOMICILIO.
$table_in=	(integer)substr($_SESSION["fec1"],0,4);			//tabla de comienzo.(Segun año)
$table_end=	(integer)substr($_SESSION["fec2"],0,4);		//tabla de finalizacion.
$pid=0;

echo "<table class=myTable-gray align=center>";
	
	echo "<tr><td class=titulo width=100%><font size=5>DATOS PERSONALES</font></td></tr>";

	echo "<tr><td align=center>";//"<hr>";
		echo "<table width=100%>";
			echo "<tr><td class=subtitulo>Apellido y Nombre:</td>"
					."<td class=subtitulo>Domicilio:</td>"
					."<td class=subtitulo>Departamento:</td>"
					."<td class=subtitulo>Nro AFIL:</td>"
					."<td class=subtitulo>Obra Social:</td>"
					."<td class=subtitulo>Telefono:</td>";
			echo "</tr>";	
			
			echo "<tr><td class=data>"	.$row["pac_apellido"]." ".$row["pac_nombre"]."</td>"
				."<td class=data>"		.$row["pac_domicilio"]."</td>"
				."<td class=data>"		.$row["pac_dpto"]."</td>"
				."<td class=data>"		.$row["pac_afil"]."</td>"
				."<td class=data>"		.$row["pac_os"]."</td>"
				."<td class=data>"		.$row["pac_telefono"]."</td>";
			echo "</tr>";
		echo "</table>";

	echo "</td></tr>";

	echo "<tr><td class=titulo></td></tr>";

	echo "<tr><td align=center>";

echo "<table width=100%>";

//$cont=1;						//contador de prestaciones
$pid=$row["pac_id"];

$cont=1;
$sum=0;

for($i=$table_in;$i<=$table_end;$i++){
	$rs=mysqli_query($conn,"SELECT * FROM op".$i."cuidados WHERE pac_id='".$pid."'"
						." AND op_date between '".$_SESSION["fec1"]." 00:00:00' and '".$_SESSION["fec2"]." 23:50:00'"
						." ORDER BY op_date") or die(mysqli_error($conn));

	echo "<tr><td colspan=6 align=center class=titulo>"
				."<b><u><font>DETALLE PRESTACIONES</u></b></font></td></tr>";

	if(mysqli_num_rows($rs)>0){	//tabla de prestaciones si encuentra alguna prestacion

		echo "<tr><td align=center class=subtitulo><b><font color=white>Nº</font></td>"	
			."<td align=center class=subtitulo><b><font color=white>FECHA</font></td>"
			."<td align=center class=subtitulo><b><font color=white>PRESTACION</font></td>"
			//."<td align=center class=subtitulo><b><font color=white>COSEG</font></td>"
			."<td align=center class=subtitulo><b><font color=white>MATRICULA</font></td>"
			."<td align=center class=subtitulo><b><font color=white>OPC</font></td>";
		echo "</tr>";

	}else{	echo "<tr><td colspan=6><font color=black>";
			sys_msg(1,4,"#004444");
			echo "</td></tr>"; }		//sino encuentra ninguna prestacion entonces tira un mensaje.

	while($row=mysqli_fetch_array($rs,MYSQLI_ASSOC)){

		$color=($row["op_rev"]==0?"black":"#CB0101");
		$bgcol=($row["op_rev"]==1?"#BBBBBB":"white");
		$collink=($row["op_rev"]==1?"blue":"#00CC33");

		$date=split_date($row["op_date"]);

		$fecha=$date["day"]."/".$date["month"]."/".$date["year"]." ".$date["hr"].":".$date["min"];

		echo "<tr>";		//numero, fecha, prestacion, coseg.
			echo "<td align=center bgcolor=".$bgcol."><font color=".$color."><b>".$cont."</b></td>";
			echo "<td align=center bgcolor=".$bgcol."><font color=".$color."><B>".$fecha.":00</b></td>";
			echo "<td align=center bgcolor=".$bgcol."><font color=".$color."><b>".$row["op_prestacion"]."</b></td>";
			//echo "<td align=center bgcolor=".$bgcol."><font color=".$color."><b>".$row["op_coseg"]."</b></td>";
			echo "<td align=center bgcolor=".$bgcol.">";
				
				echo "<a href=".$_SERVER["PHP_SELF"]."?event=upd_enf_cfg"	."&op_id=".$row["op_id"]
																			."&zona_desc=".urlencode(det_zona($row["pac_dpto"]))
																			."&table=op".$i."cuidados class=link><b>".$row["e_mat"]."</b></a></td>";

			if($_SESSION["usr_role"]=="admin" && $_SESSION["usr_level"]>=2){

				echo "<td align=center>";
					echo "<a href=".$_SERVER["PHP_SELF"]."?event=del_addr&op_id=".$row["op_id"]
														."&pac_id=".$row["pac_id"]
														."&table=op".$date["year"]."cuidados class=CirButton><b>B</b></a></td>";
			}
		echo "</tr>";				
			$cont++;
			$sum=$sum+$row["op_coseg"];
	}
	echo "<tr><td colspan=6 align=center class=titulo>"
				."<b><font size=4>TOTAL PRESTACIONES: ".($cont-1)."</b></font></td></tr>";
	echo "<tr><td colspan=6 align=center><hr></td></tr>";
}

?>