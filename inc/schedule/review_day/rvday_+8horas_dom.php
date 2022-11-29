<?php	
$cont=1;

$conn=newConnect();
$res=mysqli_query($conn,"SELECT CONCAT(pac.pac_apellido,' ',pac.pac_nombre) as paciente, CONCAT(pac.pac_domicilio,' ',pac.pac_dpto) as domicilio,op.pac_id,pac.pac_os"
				.",op.e_mat,op.pac_id,op.op_date,cant_horas,SUM(op.cant_horas) as suma1"
				." FROM op".$_GET["year"]."cuidados op left join paciente pac on op.pac_id=pac.pac_id"
				." WHERE op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59' group by op.pac_id") or die(mysqli_error($conn));

echo "<table class=myTable-gray width=100%>";
	
	echo "<tr><td colspan=6 class=titulo>REVISION DEL DIA:</td></tr>";
 
	echo "<tr><td colspan=6 class=titulo>PACIENTES CON MAS DE 8 HORAS ASIGNADAS</td></tr>";

	echo "<tr valign=top>";
		echo "<td class=subtitulo align=center>NRO</td>";
		echo "<td class=subtitulo align=center>PACIENTE</td>";
		echo "<td class=subtitulo align=center>ID</td>";
		echo "<td class=subtitulo align=center>MATRICULA</td>";
		echo "<td class=subtitulo align=center>CANT HORAS</td>";
	echo "</tr>";

	while($qr=mysqli_fetch_array($res,MYSQLI_ASSOC)){

		if($qr["suma1"]>8){
		
			echo "<tr>";
				echo "<td>".$cont."</td>";
				
				echo "<td><font size=2>".$qr["domicilio"]."</font><br>";
				echo "<font size=2>"
					."<a href=".$_SERVER["PHP_SELF"]."?event=det_lst_sh_hc"."&pac_id=".$qr["pac_id"]
																		."&fec_beg=".date("Y")."-".(date("m"))."-01"
																		."&fec_fin=".date("Y")."-".date("m")."-31"
																		."&zona_desc='ZONA CIUDAD'"
																		." title=\"Ver Historia Clinica\" class=greenLink>"								
																		."<font size=2 face=Arial><b>".$qr["paciente"]." - (".$qr["pac_id"].")</b></font></a>";
				echo "<font size=2> - ".$qr["pac_os"]."</font></td>";
				echo "<td>".$qr["pac_id"]."</td>";
				echo "<td align=center>".$qr["e_mat"]."</td>";
				echo "<td >".$qr["suma1"]."</td>";
			echo "</tr>";
			echo "<tr><td colspan=6><hr></td></tr>";
			$cont++;
		}

	}
echo "</table>";

?>
