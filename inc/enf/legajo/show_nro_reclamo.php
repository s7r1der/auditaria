<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

//echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";echo "</form>";
$res=mysql_query("select rec.recl_id,rec.recl_titulo,rec.pac_id,rec.recl_responsable,rec.recl_resp_nombre,rec.recl_resp_telefono"
				.",rec.recl_categ,rec.recl_assign,rec.recl_date,"
				."CONCAT(pac.pac_apellido,' ',pac.pac_nombre) as paciente,CONCAT(pac.pac_domicilio,' ',pac.pac_dpto) as domicilio,pac.pac_os,pac.pac_telefono"
				." FROM reclamo rec left join paciente pac on rec.pac_id=pac.pac_id where 1 order by recl_id desc limit 1") or die(mysql_error());

while($row=mysql_fetch_array($res,MYSQL_ASSOC)){
	echo "<table class=myTable-gray align=center>";

		echo "<tr>";
			echo "<td class=titulo colspan=2>RECLAMO NUMERO</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td colspan=2 align=center><font size=5>".$row["recl_id"]."</font></td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td class=subtitulo colspan=2>DATOS PACIENTE</td>";
		echo "</tr>";
		
		echo "<tr><td align=left><b>NOMBRE:</b></td><td>".$row["paciente"]."</td></tr>";
		echo "<tr><td align=left><b>DOMICILIO:</b></td><td>".$row["domicilio"]."</td></tr>";
		echo "<tr><td align=left><b>TELEFONO:</b></td><td>".$row["pac_telefono"]."</td></tr>";
		echo "<tr><td align=left><b>OBRA SOCIAL:</b></td><td>".$row["pac_os"]."</td></tr>";

		echo "<tr>";
			echo "<td class=subtitulo colspan=2>DATOS RECLAMO</td>";
		echo "</tr>";
		
		echo "<tr><td align=left><b>TITULO:</b></td><td>".$row["recl_titulo"]."</td></tr>";
		echo "<tr><td align=left><b>CATEGORIA:</b></td><td>".$row["recl_categ"]."</td></tr>";
		echo "<tr><td align=left><b>ASIGNADO:</b></td><td>".$row["recl_assign"]."</td></tr>";
		echo "<tr><td align=left><b>RESPONSABLE:</b></td><td>".$row["recl_responsable"]."</td></tr>";
		echo "<tr><td align=left><b>NOMBRE:</b></td><td>".$row["recl_resp_nombre"]."</td></tr>";
		echo "<tr><td align=left><b>TELEFONO:</b></td><td>".$row["recl_resp_telefono"]."</td></tr>";



}
?>
