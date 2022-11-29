<link rel="StyleSheet" href="css/schedule.css" type="text/css">

<?php

$date=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"];

$conn=newConnect();
$res=mysqli_query($conn,"SELECT nov.pac_id,nov.nov_desc,nov.usr_id,pac.pac_id,pac.pac_os,CONCAT(pac_domicilio,' ',pac_dpto) as domicilio"
							.",CONCAT(pac.pac_nombre,' ',pac.pac_apellido) as nombre"
							." FROM novedad nov left join paciente pac on nov.pac_id=pac.pac_id"
							." WHERE op_date between '".$date." 00:00:00' and '".$date." 23:59:59'"
							.($_SESSION["usr_role"]=="sema"?" and (pac.pac_os='SEMA' or pac.pac_os='SEMA MODULO C')":"")
							." ORDER BY op_date desc") or die(mysqli_error($conn));
 
echo "<table class=encabezado align=right width=100%>";

	echo "<tr><td class=titulo><u>NOVEDADES</u></td></tr>";
	echo "<tr><td class=head1>";

	echo "<marquee scrollamount=4 behavior=\"scroll\" direction=\"up\" height=255 onmouseout=this.start() onmouseover=this.stop()>";

		while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){

			echo "<br>-------------------------------------";
			echo "<br><font color=red face=Arial>Novedad de: ".$row["usr_id"]."</font>";
			echo "<br>".$row["domicilio"]." ( ".$row["nombre"]." ) ";
			echo "<br><font color=blue face=Arial><b>".$row["nov_desc"]."</b></font>";
			echo "<br>-------------------------------------";
//				echo "<u><font color=red>".$row["domicilio"]."(".$row["usr_id"].")</font></u>: <font color=blue>".$row["nov_desc"]." **** --</font> ";
		}

	echo "</marquee></td></tr>";
echo "</table>";