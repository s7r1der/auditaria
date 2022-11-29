<?php	
$cont=1;

$conn=newConnect();
$res=mysqli_query($conn,"SELECT op.e_mat,op.pac_id,op.op_date,cant_horas,SUM(op.cant_horas) as suma1,CONCAT(enf.enf_nombre,' ',enf.enf_apellido) as enfermero"
				." FROM op".$_GET["year"]."cuidados op left join enfermero enf on op.e_mat=enf.e_mat"
				." WHERE op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59' group by op.e_mat") or die(mysqli_error($conn));

echo "<table class=myTable-gray width=100%>";
	
	echo "<tr><td colspan=6 class=titulo>REVISION DEL DIA:</td></tr>";
 
	echo "<tr><td colspan=6 class=titulo>CUIDADOR CON MAS DE 8 HORAS</td></tr>";

	echo "<tr valign=top>";
		echo "<td class=subtitulo align=center>NRO</td>";
		echo "<td class=subtitulo align=center>CUIDADORES</td>";
		echo "<td class=subtitulo align=center>MATRICULA</td>";
		echo "<td class=subtitulo align=center>CANT HORAS</td>";
	echo "</tr>";

	while($qr=mysqli_fetch_array($res,MYSQLI_ASSOC)){

		if($qr["suma1"]>8){
		
			echo "<tr>";
				echo "<td>".$cont."</td>";
				echo "<td><a href=".$_SERVER["PHP_SELF"]."?event=det_enf_lst&e_mat=".$qr["e_mat"]
																			//."&date=".$date."&zona_desc=".urlencode($row["zona_desc"])
																		."&date=".$date."&zona_desc=CUIDAD"
																		."&ubic=det_enf_lst class=link>"
																		."<font size=3 face=Arial>".$qr["enfermero"]."(".$qr["e_mat"].")</font></a></td>";
				//echo "<td><font size=2>".$qr["enfermero"]."</font><br>";
				echo "<td align=center>".$qr["e_mat"]."</td>";
				echo "<td>".$qr["suma1"]."</td>";
			echo "</tr>";
			echo "<tr><td colspan=6><hr></td></tr>";
			$cont++;
		}

	}
echo "</table>";

?>
