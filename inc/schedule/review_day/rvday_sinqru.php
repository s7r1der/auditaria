<?php	
$cont=1;

$conn=newConnect();
$res=mysqli_query($conn,"SELECT op.e_mat,op.pac_id,op.op_date,op.cant_horas,"
				."CONCAT(pac.pac_domicilio,' ',pac.pac_dpto) as domicilio,op.e_mat,"
				."CONCAT(pac.pac_apellido,' ',pac.pac_nombre) as paciente,op.op_sit"
				." FROM op".$_GET["year"]."cuidados op left join paciente pac on op.pac_id=pac.pac_id"
				." WHERE op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59' and op.op_sit='1' ORDER BY pac.pac_apellido") or die(mysqli_error($conn));

echo "<table class=myTable-gray width=100%>";
	 
	echo "<tr><td colspan=6 class=titulo>CUIDADOR SIN MARCAR QRU</td></tr>";

	echo "<tr valign=top>";
		echo "<td class=subtitulo align=center>NRO</td>";
		echo "<td class=subtitulo align=center>PACIENTE</td>";
		echo "<td class=subtitulo align=center>DOMICILIO</td>";
		echo "<td class=subtitulo align=center>CANT HORAS</td>";
		echo "<td class=subtitulo align=center>MATRICULA</td>";
	echo "</tr>";

	while($qr=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		
		echo "<tr>";
			echo "<td>".$cont."</td>";
			echo "<td align=center>".$qr["paciente"]."</td>";
			echo "<td align=center>".$qr["domicilio"]."</td>";
			echo "<td align=center>".$qr["cant_horas"]."</td>";
			echo "<td><a href=".$_SERVER["PHP_SELF"]."?event=det_enf_lst&e_mat=".$qr["e_mat"]
																		//."&date=".$date."&zona_desc=".urlencode($row["zona_desc"])
																	."&date=".$date."&zona_desc=CUIDAD"
																	."&ubic=det_enf_lst class=link>"
																	."<font size=3 face=Arial>".$qr["e_mat"]."</font></a></td>";
		echo "</tr>";
		echo "<tr><td colspan=6><hr></td></tr>";
		$cont++;

	}
echo "</table>";

?>