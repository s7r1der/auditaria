<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

$conn=newConnect();
$query1=mysqli_query($conn,"SELECT e_mat,CONCAT(enf_apellido,' ',enf_nombre) as enfermero FROM enfermero WHERE enf_estado='ACTIVO' order by enf_apellido") or die(mysqli_error($conn));
	
echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

echo "<table class=myTable-gray align=center>";

	echo "<tr>";
		echo "<td class=titulo>IMPRESION DE CONTRATO</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td align=left><B>MAT: </B>";
			echo "<select name=e_mat>"; 	

			while($r=mysqli_fetch_array($query1,MYSQLI_ASSOC)){	
				echo "<option name=opt>".$r["enfermero"]." - ".$r["e_mat"];
			}
			echo "</select>";
		echo "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td align=center>";
			echo "<input type=submit class=myButton name=event value=\"Imprimir Contrato\">";
		echo "</td>";
	echo "</tr>";

echo "</table>";

echo "</form>";
?>
