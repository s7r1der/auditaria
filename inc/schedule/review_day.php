<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

$date = $_GET["year"] . "-" . $_GET["month"] . "-" . $_GET["day"];
$cont = 1;

include("inc/schedule/review_day/enc_menu_reviewday.php");

switch ($_GET["opt"]) {
	case "news":
		include("inc/schedule/review_day/rvday_news.php");
		break;

	case "internado":
		include("inc/schedule/review_day/rvday_int.php");
		break;

	case "fallecido":
		include("inc/schedule/review_day/rvday_qrt.php");
		break;

	case "8horas_dom":
		include("inc/schedule/review_day/rvday_+8horas_dom.php");
		break;

	case "8horas_cuid":
		include("inc/schedule/review_day/rvday_+8horas_cuid.php");
		break;

	case "sinqth":
		include("inc/schedule/review_day/rvday_sinqth.php");
		break;

	case "sinqru":
		include("inc/schedule/review_day/rvday_sinqru.php");
		break;
}

/*$res=mysql_query("SELECT CONCAT(op.pac_apellido,' ',op.pac_nombre) as paciente, CONCAT(op.pac_domicilio,' ',op.pac_dpto) as domicilio,op.pac_id,op.pac_os"
				.",evol.evol_desc,evol.op_id,op.op_prestacion"
				." FROM op".$_GET["year"]." op left join evolution evol on evol.op_id=op.op_id"
				." WHERE evol_desc like '%interna%' and op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59'") or die(mysql_error());

echo "<table class=myTable-gray width=100%>";
	
	echo "<tr><td colspan=7 class=titulo>REVISION DEL DIA:</td></tr>";
 
	echo "<tr><td colspan=7	 class=titulo>PACIENTES INTERNADOS</td></tr>";

	echo "<tr>";
		echo "<td class=subtitulo>NRO</td>";
		echo "<td class=subtitulo>PACIENTE</td>";
		echo "<td class=subtitulo>DOMICILIO</td>";
		echo "<td class=subtitulo>PRESTACION</td>";
		echo "<td class=subtitulo>TELEFONO</td>";
		echo "<td class=subtitulo>OS</td>";
		echo "<td class=subtitulo>EVOLUCION</td>";
	echo "</tr>";



	while($qr=mysql_fetch_array($res,MYSQL_ASSOC)){
		echo "<tr>";
			echo "<td>".$cont."</td>";
			echo "<td>".$qr["paciente"]."</td>";
			echo "<td>".$qr["domicilio"]."</td>";
			echo "<td>".$qr["op_prestacion"]."</td>";
			echo "<td>".$qr["pac_id"]."</td>";
			echo "<td>".$qr["pac_os"]."</td>";
			echo "<td>".$qr["evol_desc"]."</td>";
		echo "</tr>";
		$cont++;
	}
echo "</table>";*/

/*$res=mysql_query("SELECT CONCAT(op.pac_apellido,' ',op.pac_nombre) as paciente, CONCAT(op.pac_domicilio,' ',op.pac_dpto) as domicilio,op.pac_id,op.pac_os"
				.",evol.evol_desc,evol.op_id,op.op_prestacion"
				." FROM op".$_GET["year"]." op left join evolution evol on evol.op_id=op.op_id"
				." WHERE evol_desc like '%no se enc%' and op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59'") or die(mysql_error());

echo "<table class=myTable-gray width=100%>";
	
	echo "<tr><td colspan=7 class=titulo>REVISION DEL DIA:</td></tr>";
 
	echo "<tr><td colspan=7 class=titulo>PACIENTES AUSENTE</td></tr>";

	echo "<tr>";
		echo "<td class=subtitulo>NRO</td>";
		echo "<td class=subtitulo>PACIENTE</td>";
		echo "<td class=subtitulo>DOMICILIO</td>";
		echo "<td class=subtitulo>PRESTACION</td>";
		echo "<td class=subtitulo>ID</td>";
		echo "<td class=subtitulo>OS</td>";
		echo "<td class=subtitulo>EVOLUCION</td>";
	echo "</tr>";



	while($qr=mysql_fetch_array($res,MYSQL_ASSOC)){
		echo "<tr>";
			echo "<td>".$cont."</td>";
			echo "<td>".$qr["paciente"]."</td>";
			echo "<td>".$qr["domicilio"]."</td>";
			echo "<td>".$qr["op_prestacion"]."</td>";
			echo "<td>".$qr["pac_id"]."</td>";
			echo "<td>".$qr["pac_os"]."</td>";
			echo "<td>".$qr["evol_desc"]."</td>";
		echo "</tr>";
		$cont++;
	}
echo "</table>";*/

/*$res=mysql_query("SELECT CONCAT(op.pac_apellido,' ',op.pac_nombre) as paciente, CONCAT(op.pac_domicilio,' ',op.pac_dpto) as domicilio,op.pac_id,op.pac_os"
				.",evol.evol_desc,evol.op_id,op.op_prestacion"
				." FROM op".$_GET["year"]." op left join evolution evol on evol.op_id=op.op_id"
				." WHERE (evol_desc like '%obit%' or evol_desc like '%falleci%') and op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59'") or die(mysql_error());

echo "<table class=myTable-gray width=100%>";
	
	echo "<tr><td colspan=7 class=titulo>REVISION DEL DIA:</td></tr>";
 
	echo "<tr><td colspan=7 class=titulo>PACIENTES FALLECIDO</td></tr>";

	echo "<tr>";
		echo "<td class=subtitulo>NRO</td>";
		echo "<td class=subtitulo>PACIENTE</td>";
		echo "<td class=subtitulo>DOMICILIO</td>";
		echo "<td class=subtitulo>PRESTACION</td>";
		echo "<td class=subtitulo>ID</td>";
		echo "<td class=subtitulo>OS</td>";
		echo "<td class=subtitulo>EVOLUCION</td>";
	echo "</tr>";



	while($qr=mysql_fetch_array($res,MYSQL_ASSOC)){
		echo "<tr>";
			echo "<td>".$cont."</td>";
			echo "<td>".$qr["paciente"]."</td>";
			echo "<td>".$qr["domicilio"]."</td>";
			echo "<td>".$qr["op_prestacion"]."</td>";
			echo "<td>".$qr["pac_id"]."</td>";
			echo "<td>".$qr["pac_os"]."</td>";
			echo "<td>".$qr["evol_desc"]."</td>";
		echo "</tr>";
		$cont++;
	}
echo "</table>";*/

/*$res=mysql_query("SELECT CONCAT(op.pac_apellido,' ',op.pac_nombre) as paciente, CONCAT(op.pac_domicilio,' ',op.pac_dpto) as domicilio,op.pac_id,op.pac_os"
				.",evol.evol_desc,evol.op_id,op.op_prestacion"
				." FROM op".$_GET["year"]." op left join evolution evol on evol.op_id=op.op_id"
				." WHERE evol_desc like '%sonda%' and op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59'") or die(mysql_error());

echo "<table class=myTable-gray width=100%>";
	
	echo "<tr><td colspan=7 class=titulo>REVISION DEL DIA:</td></tr>";
 
	echo "<tr><td colspan=7 class=titulo>PACIENTES FALLECIDO</td></tr>";

	echo "<tr>";
		echo "<td class=subtitulo>NRO</td>";
		echo "<td class=subtitulo>PACIENTE</td>";
		echo "<td class=subtitulo>DOMICILIO</td>";
		echo "<td class=subtitulo>PRESTACION</td>";
		echo "<td class=subtitulo>ID</td>";
		echo "<td class=subtitulo>OS</td>";
		echo "<td class=subtitulo>EVOLUCION</td>";
	echo "</tr>";



	while($qr=mysql_fetch_array($res,MYSQL_ASSOC)){
		echo "<tr>";
			echo "<td>".$cont."</td>";
			echo "<td>".$qr["paciente"]."</td>";
			echo "<td>".$qr["domicilio"]."</td>";
			echo "<td>".$qr["op_prestacion"]."</td>";
			echo "<td>".$qr["pac_id"]."</td>";
			echo "<td>".$qr["pac_os"]."</td>";
			echo "<td>".$qr["evol_desc"]."</td>";
		echo "</tr>";
		$cont++;
	}
echo "</table>";*/

/*$res=mysql_query("SELECT CONCAT(op.pac_apellido,' ',op.pac_nombre) as paciente, CONCAT(op.pac_domicilio,' ',op.pac_dpto) as domicilio,op.pac_id,op.pac_os"
				.",evol.evol_desc,evol.op_id,op.op_prestacion"
				." FROM op".$_GET["year"]." op left join evolution evol on evol.op_id=op.op_id"
				." WHERE (evol_desc like '% control de signos vitales TA:/, T:, fc:, fr:, sat%') and op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59'") or die(mysql_error());

echo "<table class=myTable-gray width=100%>";
	
	echo "<tr><td colspan=7 class=titulo>REVISION DEL DIA:</td></tr>";
 
	echo "<tr><td colspan=7 class=titulo>PACIENTES SIN SIGNOS VITALES</td></tr>";

	echo "<tr>";
		echo "<td class=subtitulo>NRO</td>";
		echo "<td class=subtitulo>PACIENTE</td>";
		echo "<td class=subtitulo>DOMICILIO</td>";
		echo "<td class=subtitulo>PRESTACION</td>";
		echo "<td class=subtitulo>ID</td>";
		echo "<td class=subtitulo>OS</td>";
		echo "<td class=subtitulo>EVOLUCION</td>";
	echo "</tr>";



	while($qr=mysql_fetch_array($res,MYSQL_ASSOC)){
		echo "<tr>";
			echo "<td>".$cont."</td>";
			echo "<td>".$qr["paciente"]."</td>";
			echo "<td>".$qr["domicilio"]."</td>";
			echo "<td>".$qr["op_prestacion"]."</td>";
			echo "<td>".$qr["pac_id"]."</td>";
			echo "<td>".$qr["pac_os"]."</td>";
			echo "<td>".$qr["evol_desc"]."</td>";
		echo "</tr>";
		$cont++;
	}
echo "</table>";*/
/*
$res=mysql_query("SELECT CONCAT(op.pac_apellido,' ',op.pac_nombre) as paciente, CONCAT(op.pac_domicilio,' ',op.pac_dpto) as domicilio,op.pac_id,op.pac_os"
				.",evol.evol_desc,evol.op_id,op.op_prestacion"
				." FROM op".$_GET["year"]." op left join evolution evol on evol.op_id=op.op_id"
				." WHERE (evol_desc like '% de domicilio%') and op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59'") or die(mysql_error());

echo "<table class=myTable-gray width=100%>";
	
	echo "<tr><td colspan=7 class=titulo>REVISION DEL DIA:</td></tr>";
 
	echo "<tr><td colspan=7 class=titulo>CAMBIO DE DOMICILIO</td></tr>";

	echo "<tr>";
		echo "<td class=subtitulo>NRO</td>";
		echo "<td class=subtitulo>PACIENTE</td>";
		echo "<td class=subtitulo>DOMICILIO</td>";
		echo "<td class=subtitulo>PRESTACION</td>";
		echo "<td class=subtitulo>ID</td>";
		echo "<td class=subtitulo>OS</td>";
		echo "<td class=subtitulo>EVOLUCION</td>";
	echo "</tr>";



	while($qr=mysql_fetch_array($res,MYSQL_ASSOC)){
		echo "<tr>";
			echo "<td>".$cont."</td>";
			echo "<td>".$qr["paciente"]."</td>";
			echo "<td>".$qr["domicilio"]."</td>";
			echo "<td>".$qr["op_prestacion"]."</td>";
			echo "<td>".$qr["pac_id"]."</td>";
			echo "<td>".$qr["pac_os"]."</td>";
			echo "<td>".$qr["evol_desc"]."</td>";
		echo "</tr>";
		$cont++;
	}
echo "</table>";
*/
/*$res=mysql_query("SELECT CONCAT(op.pac_apellido,' ',op.pac_nombre) as paciente, CONCAT(op.pac_domicilio,' ',op.pac_dpto) as domicilio,op.pac_id,op.pac_os"
				.",evol.evol_desc,evol.op_id,op.op_prestacion"
				." FROM op".$_GET["year"]." op left join evolution evol on evol.op_id=op.op_id"
				." WHERE op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59'"
				." AND op.op_prestacion='ASPIRACION'") or die(mysql_error());

echo "<table class=myTable-gray width=100%>";
	
	echo "<tr><td colspan=7 class=titulo>REVISION DEL DIA:</td></tr>";
 
	echo "<tr><td colspan=7 class=titulo>ASPIRACIONES</td></tr>";

	echo "<tr>";
		echo "<td class=subtitulo>NRO</td>";
		echo "<td class=subtitulo>PACIENTE</td>";
		echo "<td class=subtitulo>DOMICILIO</td>";
		echo "<td class=subtitulo>PRESTACION</td>";
		echo "<td class=subtitulo>ID</td>";
		echo "<td class=subtitulo>OS</td>";
		echo "<td class=subtitulo>EVOLUCION</td>";
	echo "</tr>";



	while($qr=mysql_fetch_array($res,MYSQL_ASSOC)){
		echo "<tr>";
			echo "<td>".$cont."</td>";
			echo "<td>".$qr["paciente"]."</td>";
			echo "<td>".$qr["domicilio"]."</td>";
			echo "<td>".$qr["op_prestacion"]."</td>";
			echo "<td>".$qr["pac_id"]."</td>";
			echo "<td>".$qr["pac_os"]."</td>";
			echo "<td>".$qr["evol_desc"]."</td>";
		echo "</tr>";
		$cont++;
	}
echo "</table>";*/



/*$res=mysql_query("SELECT CONCAT(op.pac_apellido,' ',op.pac_nombre) as paciente, CONCAT(op.pac_domicilio,' ',op.pac_dpto) as domicilio,op.pac_id,op.pac_os"
				.",evol.evol_desc,evol.op_id,op.op_prestacion"
				." FROM op".$_GET["year"]." op left join evolution evol on op.op_id=evol.op_id"
				." WHERE op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59'"
				." AND op.op_prestacion='CURACIONES'") or die(mysql_error());

echo "<table class=myTable-gray width=100%>";
	
	echo "<tr><td colspan=7 class=titulo>REVISION DEL DIA:</td></tr>";
 
	echo "<tr><td colspan=7 class=titulo>CURACIONES</td></tr>";

	echo "<tr>";
		echo "<td class=subtitulo>NRO</td>";
		echo "<td class=subtitulo>PACIENTE</td>";
		echo "<td class=subtitulo>DOMICILIO</td>";
		echo "<td class=subtitulo>PRESTACION</td>";
		echo "<td class=subtitulo>ID</td>";
		echo "<td class=subtitulo>OS</td>";
		echo "<td class=subtitulo>EVOLUCION</td>";
	echo "</tr>";



	while($qr=mysql_fetch_array($res,MYSQL_ASSOC)){
		echo "<tr>";
			echo "<td>".$cont."</td>";
			echo "<td>".$qr["paciente"]."</td>";
			echo "<td>".$qr["domicilio"]."</td>";
			echo "<td>".$qr["op_prestacion"]."</td>";
			echo "<td>".$qr["pac_id"]."</td>";
			echo "<td>".$qr["pac_os"]."</td>";
			echo "<td>".$qr["evol_desc"]."</td>";
		echo "</tr>";
		$cont++;
	}
echo "</table>";*/

/*$res=mysql_query("SELECT CONCAT(op.pac_apellido,' ',op.pac_nombre) as paciente, CONCAT(op.pac_domicilio,' ',op.pac_dpto) as domicilio,op.pac_id,op.pac_os"
				.",evol.evol_desc,evol.op_id,op.op_prestacion"
				." FROM op".$_GET["year"]." op left join evolution evol on op.op_id=evol.op_id"
				." WHERE op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59'"
				." AND op.op_prestacion='CURACIONES MULTIPLES'") or die(mysql_error());

echo "<table class=myTable-gray width=100%>";
	
	echo "<tr><td colspan=7 class=titulo>REVISION DEL DIA:</td></tr>";
 
	echo "<tr><td colspan=7 class=titulo>CURACIONES</td></tr>";

	echo "<tr>";
		echo "<td class=subtitulo>NRO</td>";
		echo "<td class=subtitulo>PACIENTE</td>";
		echo "<td class=subtitulo>DOMICILIO</td>";
		echo "<td class=subtitulo>PRESTACION</td>";
		echo "<td class=subtitulo>ID</td>";
		echo "<td class=subtitulo>OS</td>";
		echo "<td class=subtitulo>EVOLUCION</td>";
	echo "</tr>";



	while($qr=mysql_fetch_array($res,MYSQL_ASSOC)){
		echo "<tr>";
			echo "<td>".$cont."</td>";
			echo "<td>".$qr["paciente"]."</td>";
			echo "<td>".$qr["domicilio"]."</td>";
			echo "<td>".$qr["op_prestacion"]."</td>";
			echo "<td>".$qr["pac_id"]."</td>";
			echo "<td>".$qr["pac_os"]."</td>";
			echo "<td>".$qr["evol_desc"]."</td>";
		echo "</tr>";
		$cont++;
	}
echo "</table>";*/

/*$res=mysql_query("SELECT CONCAT(op.pac_apellido,' ',op.pac_nombre) as paciente, CONCAT(op.pac_domicilio,' ',op.pac_dpto) as domicilio,op.pac_id,op.pac_os"
				.",evol.evol_desc,evol.op_id,op.op_prestacion"
				." FROM op".$_GET["year"]." op left join evolution evol on op.op_id=evol.op_id"
				." WHERE op.op_date between '".$date." 00:00:00' and '".$date." 23:59:59'"
				." AND op.op_prestacion='ANTIBIOTICOTERAPIA'") or die(mysql_error());

echo "<table class=myTable-gray width=100%>";
	
	echo "<tr><td colspan=7 class=titulo>REVISION DEL DIA:</td></tr>";
 
	echo "<tr><td colspan=7 class=titulo>CURACIONES</td></tr>";

	echo "<tr>";
		echo "<td class=subtitulo>NRO</td>";
		echo "<td class=subtitulo>PACIENTE</td>";
		echo "<td class=subtitulo>DOMICILIO</td>";
		echo "<td class=subtitulo>PRESTACION</td>";
		echo "<td class=subtitulo>ID</td>";
		echo "<td class=subtitulo>OS</td>";
		echo "<td class=subtitulo>EVOLUCION</td>";
	echo "</tr>";



	while($qr=mysql_fetch_array($res,MYSQL_ASSOC)){
		echo "<tr>";
			echo "<td>".$cont."</td>";
			echo "<td>".$qr["paciente"]."</td>";
			echo "<td>".$qr["domicilio"]."</td>";
			echo "<td>".$qr["op_prestacion"]."</td>";
			echo "<td>".$qr["pac_id"]."</td>";
			echo "<td>".$qr["pac_os"]."</td>";
			echo "<td>".$qr["evol_desc"]."</td>";
		echo "</tr>";
		$cont++;
	}
echo "</table>";*/

?>