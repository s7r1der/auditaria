<link rel="StyleSheet" href="css/tarea.css" type="text/css">

<?php

$conn=newConnect();
$qrpend=mysqli_query($conn,"SELECT * FROM reclamo where recl_estado='PENDIENTE'") or die(mysqli_error($conn));

$limit=(mysqli_num_rows($qrpend)>50?mysqli_num_rows($qrpend):50);

//$qr=mysql_query("SELECT * FROM reclamo where recl_date>date_add(NOW(), INTERVAL -5	 DAY) order by recl_estado") or die(mysql_error());
$qr=mysqli_query($conn,"SELECT * FROM reclamo where recl_assign='CUIDADOS' order by recl_estado limit ".$limit) or die(mysqli_error($conn));

echo "<table width=100%>";
	echo "<tr>";
		echo "<td align=center class=subtitulo><b>NRO</td>";
		echo "<td align=center class=subtitulo><b>FECHA</td>";
		echo "<td align=center class=subtitulo><b>PACIENTE</td>";
		echo "<td align=center class=subtitulo><b>CUIDADOR DESIGNADO</td>";
		echo "<td align=center class=subtitulo><b>CUIDADOR REEEMPLAZANTE/FRANQUERO</td>";
		echo "<td class=subtitulo colspan=2><font size=2>T MAÑANA</font></b></td>";
		echo "<td class=subtitulo colspan=2><font size=2>T TARDE</font></b></td>";
		echo "<td class=subtitulo colspan=2><font size=2>FORMATO</font></b></td>";
	echo "</tr>";

	$cont=0;
	while($rw1=mysqli_fetch_array($qr,MYSQLI_ASSOC)){
		$cont++;
		echo "<tr>";
			echo "<td align=center><font size=2>".$cont."</font></td>";
			echo "<td align=left><font size=2>".$rw1["recl_assign"]."</font><font size=1> (".$rw1["recl_id"].")</font></td>";
			echo "<td align=left><b>".$rw1["recl_titulo"]."</b></td>";
			echo "<td align=center><b><font size=2>".($rw1["recl_estado"]!="TERMINADO"?"<font color=red>":"<font color=black>").$rw1["recl_estado"]."</font></B></td>";

			echo "<td align=center>";

			switch ($rw1["recl_assign"]) {
				case 'ADMINISTRACION':
					if(($_SESSION["usr_role"]=='admin' && $_SESSION["usr_level"]>3 && $rw1["recl_estado"]!="TERMINADO"))
						echo "<a href=".$_SERVER["PHP_SELF"]."?event=tomar_reclamo_frm"
														."&recl_id=".$rw1["recl_id"]." class=boton>Tomar</a> . ";
					//else
						echo "    <a href=".$_SERVER["PHP_SELF"]."?event=ver_reclamo"
								."&recl_id=".$rw1["recl_id"]." class=boton> Ver</a>";

					break;
				case 'DESPACHO':
					if(($_SESSION["usr_role"]=='admin' && $_SESSION["usr_level"]!=4 && $rw1["recl_estado"]!="TERMINADO"))
						echo "<a href=".$_SERVER["PHP_SELF"]."?event=tomar_reclamo_frm"
														."&recl_id=".$rw1["recl_id"]." class=boton>Tomar</a> . ";
					//else
						echo "    <a href=".$_SERVER["PHP_SELF"]."?event=ver_reclamo"
								."&recl_id=".$rw1["recl_id"]." class=boton>Ver</a>";
					break;
				case 'AUDITORIA':
					if($_SESSION["usr_role"]=='aud' or ($_SESSION["usr_role"]=='admin' && $_SESSION["usr_level"]>3 && $rw1["recl_estado"]!="TERMINADO"))
						echo "<a href=".$_SERVER["PHP_SELF"]."?event=tomar_reclamo_frm"
														."&recl_id=".$rw1["recl_id"]." class=boton>Tomar</a> . ";
					//else
						echo "    <a href=".$_SERVER["PHP_SELF"]."?event=ver_reclamo"
								."&recl_id=".$rw1["recl_id"]." class=boton>Ver</a>";
					break;
				case 'FARMACIA':
					if($_SESSION["usr_role"]=='farmacia' or ($_SESSION["usr_role"]=='admin' && $_SESSION["usr_level"]>4 && $rw1["recl_estado"]!="TERMINADO"))
						echo "<a href=".$_SERVER["PHP_SELF"]."?event=tomar_reclamo_frm"
														."&recl_id=".$rw1["recl_id"]." class=boton>Tomar</a> . ";
					//else
						echo "    <a href=".$_SERVER["PHP_SELF"]."?event=ver_reclamo"
								."&recl_id=".$rw1["recl_id"]." class=boton>Ver</a>";
					break;
					
				case 'CUIDADOS':
					if($_SESSION["usr_role"]=='cuidadmin' or ($_SESSION["usr_role"]=='admin' && $_SESSION["usr_level"]>4 && $rw1["recl_estado"]!="TERMINADO"))
						echo "<a href=".$_SERVER["PHP_SELF"]."?event=tomar_reclamo_frm"
														."&recl_id=".$rw1["recl_id"]." class=boton>Tomar</a> . ";
					//else
						echo "<a href=".$_SERVER["PHP_SELF"]."?event=ver_reclamo"."&recl_id=".$rw1["recl_id"]." class=boton>Ver</a>";
					break;
			}
			echo "</td>";
		echo "</tr>";
	}
echo "</table>";


?>