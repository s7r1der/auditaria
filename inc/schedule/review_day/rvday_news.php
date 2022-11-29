<?php	

$cont=1;
$conn=newConnect();
$res=mysqli_query($conn,"SELECT pac_id,CONCAT(pac_apellido,' ',pac_nombre) as paciente, CONCAT(pac_domicilio,' ',pac_dpto) as domicilio,pac_telefono,pac_os"
				." FROM paciente WHERE pac_fecingr between '".$date." 00:00:00' and '".$date." 23:59:59'") or die(mysqli_error($conn));

echo "<table class=myTable-gray width=100%>";
	 
	echo "<tr><td colspan=6 class=titulo>PACIENTES NUEVOS</td></tr>";

	echo "<tr>";
		echo "<td class=subtitulo>NRO</td>";
		echo "<td class=subtitulo>PACIENTE</td>";
		echo "<td class=subtitulo>DOMICILIO</td>";
		echo "<td class=subtitulo>ID</td>";
		echo "<td class=subtitulo>TELEFONO</td>";
		echo "<td class=subtitulo>OS</td>";
	echo "</tr>";

	while($qr=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		echo "<tr>";
			echo "<td>".$cont."</td>";
			echo "<td>".$qr["paciente"]."</td>";
			echo "<td>".$qr["domicilio"]."</td>";
			echo "<td>".$qr["pac_id"]."</td>";
			echo "<td>".$qr["pac_telefono"]."</td>";
			echo "<td>".$qr["pac_os"]."</td>";
		echo "</tr>";
		$cont++;
	}
echo "</table>";
?>
