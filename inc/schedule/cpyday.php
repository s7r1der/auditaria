<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

	echo "<input type=hidden name=ubic value=\"cpyday\">";
	echo "<input type=hidden name=op_date value=".$_POST["op_date"].">";
	echo "<input type=hidden name=fec_day value=".$_POST["fec_day"].">";
	echo "<input type=hidden name=fec_year value=".$_POST["fec_year"].">";
	echo "<input type=hidden name=fec_month value=".$_POST["fec_month"].">";
	echo "<input type=hidden name=fec_year value=".$_POST["fec_year"].">";
	echo "<input type=hidden name=deldatos value=".(isset($_POST["deldatos"])?1:0).">";
	echo "<input type=hidden name=state value=".(isset($_POST["state"])?1:0).">";

	echo "<table align=center class=menu-gray>";

		echo "<tr><td class=titulo>COPIA DEL DIA COMPLETO</td></tr>";

		$conn=newConnect();
		$res=mysqli_query($conn,"SELECT date_format(op_date,\"'%d/%i/%Y'\") as op_date1 FROM ".$table_src
							." WHERE op_date between '".$_POST["op_date"]. " 00:00:00' and '"
							.$_POST["op_date"]." 23:50:00' order by op_date");
	
		echo "<tr><td class=subtitulo>SE COPIARAN</td></tr>";
		echo "<tr><td>".mysqli_num_rows($res)." REGISTROS<br></td></tr>";
		echo "<tr><td class=subtitulo>DE LA TABLA</td></tr>";
		echo "<tr><td>".$table_src."<br></td></tr>";
		echo "<tr><td class=subtitulo>DE EL DIA </td></tr>";
		echo "<tr><td>".$_POST["op_date1"]."</td></tr>";
		echo "<tr><td class=subtitulo>A EL DIA</td></tr>";
		echo "<tr><td>".$_POST["fec_day"]." / ".$_POST["fec_month"]." / ".$_POST["fec_year"]."</td></tr>";
		echo "<tr><td class=subtitulo>A LA TABLA</td></tr>";
		echo "<tr><td>".$table_dest."<br></td></tr>";
		echo "<tr><td class=subtitulo></td></tr>";
		echo "<tr><td><font color=".(isset($_POST["deldatos"])?"red><b>SE BORRARAN LOS DATOS</b>":"green><b>NO SE BORRARAN LOS DATOS</b>")."</font></td></tr>";
		echo "<tr><td class=subtitulo></td></tr>";
		
		echo "<tr><td>";
			echo "<input type=submit name=event class=myButton value=\"Copiar\">";
			echo "<input class=myButton type=submit name=event value=Cancelar>";
		echo "</td></tr>";

	echo "</table>";

echo "</FORM>";

?>	
