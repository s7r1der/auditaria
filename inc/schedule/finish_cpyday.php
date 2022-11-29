<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php
$conn=newConnect();
$res1=mysqli_query($conn,"SELECT * FROM ".$table_dest
					." WHERE op_date between '".$date. " 00:00:00' and '".$date." 23:50:00'") or die(mysqli_error($conn));

echo "<table class=menu-gray align=center>";
	
	echo "<tr><td class=titulo>COPIA EXITOSA</td></tr>";
	echo "<tr><td class=subtitulo>SE COPIARON</td></tr>";
	echo "<tr><td>".mysqli_num_rows($res)." REGISTROS<br></td></tr>";
	echo "<tr><td class=subtitulo>DE EL DIA </td></tr>";
	echo "<tr><td>".$_POST["op_date"]."</td></tr>";
	echo "<tr><td class=subtitulo>A EL DIA</td></tr>";
	echo "<tr><td>".$date."</td></tr>";
	echo "<tr><td class=subtitulo></td></tr>";
	echo "<tr><td class=subtitulo><a href=".$_SERVER["PHP_SELF"]."?event=schedule class=myButton>IR AL DIA</td></tr>";
	echo "<tr><td class=subtitulo></td></tr>";
			
echo "</table>";
?>	
