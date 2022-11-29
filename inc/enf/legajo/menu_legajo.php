<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

//$limit=(mysqli_num_rows($qrpend)>1000?mysqli_num_rows($qrpend):1000);


$res=mysqli_query($conn,"SELECT e_mat,CONCAT(enf_apellido,' ',enf_nombre) as enfermero1 from enfermero where e_mat='".$_GET["e_mat"]."'") or die(mysqli_error($conn));


while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
	
	echo "<table class=myTable-gray align=center>";
		echo "<tr><td class=titulo>LEGAJO PERSONAL</td></tr>";
		echo "<tr><td align=center><Font size=5><B>".$row["enfermero1"]."</B></font></td></tr>";
		//echo "<tr><td align=center><b>".$row["e_mat"]."</b></td></tr>";
		echo "<tr><td class=subtitulo>OPERACIONES</td></tr>";
		
		echo "<tr><td><a href=".$_SERVER["PHP_SELF"]."?event=sel_enf&e_mat=".$row["e_mat"]."><B> MODIFICAR INFORMACION PERSONAL</B></a></td></tr>";
		echo "<tr><td><a href=".$_SERVER["PHP_SELF"]."?event=add_legajo&e_mat=".$row["e_mat"]."><B> AGREGAR AL LEGAJO</B></a></td></tr>";
		echo "<tr><td><a href=".$_SERVER["PHP_SELF"]."?event=show_legajo&e_mat=".$row["e_mat"]."><B> VER DETALLE DEL LEGAJO</B></a></td></tr>";
	echo "</table>";

}

?>