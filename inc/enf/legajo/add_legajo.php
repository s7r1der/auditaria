<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php
$conn=newConnect();

$res=mysqli_query($conn,"SELECT e_mat,CONCAT(enf_nombre,' ',enf_apellido) as enfer FROM enfermero where e_mat='".$_GET["e_mat"]."'") or die(mysql_error($conn));

while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){

	echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

		echo "<input type=hidden name=e_mat value=".$row["e_mat"].">";

		echo "<table class=menu-gray align=center>";

			echo "<tr><td class=titulo colspan=2>AGREGAR AL LEGAJO</td></tr>";

			echo "<tr><td align=left><b>PERSONAL:</b></td><td align=left><FONT SIZE=6>".$row["enfer"]."</font></td></tr>";
			echo "<tr><td align=left><b>MATRICULA:</b></td><td align=left><FONT SIZE=6>".$row["e_mat"]."</font></td></tr>";

			echo "<tr><td class=subtitulo colspan=2>DESCRIPCION</td></tr>";
			echo "<tr><td colspan=2><textarea rows=15 cols=105 name=leg_desc></textarea></td></tr>";
			echo "<tr><td colspan=2 class=subtitulo></td></tr>";
			echo "<tr><td colspan=2><input type=submit name=event value=\"Agregar al Legajo\" class=boton></td></tr>";

		echo	"</table>";
	echo "</form>";

}
	
?>
