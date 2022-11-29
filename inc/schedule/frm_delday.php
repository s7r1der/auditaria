<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

	echo "<input type=hidden name=ubic value=\"delday\">";
	echo "<input type=hidden name=table value=op".$_GET["year"]."cuidados>";
	echo "<input type=hidden name=op_date value=".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"].">";


	echo "<table class=menu-gray align=center>";

		echo "<tr><td class=titulo>ELIMINACION DATOS</td></tr>";
		
		echo "<tr><td class=subtitulo>".$_GET["day"]."/".$_GET["month"]."/".$_GET["year"]."</td></tr>";
	
		echo "<tr><td>	¿Está Seguro que desea eliminar datos?</td></tr>";

		echo "<tr><td align=center>";
			echo "<input type=submit class=myButton name=event value=".((isset($_GET["ubic"]) && $_GET["ubic"]=="del_all_opdel")?"BorrarTodos":"Aceptar")."> - ";
			echo "<input type=submit class=myButton name=event value=Cancelar></TD>";
		echo "</TR>";
	
	echo "</table>";

echo "</FORM>";
?>	
