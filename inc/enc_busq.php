<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php
//$_SESSION["year"]="20".$_SESSION["year"];
//$desc_month=($_SESSION["day"]>14?0:1);			
//$day1=($_SESSION["day"]>14?1:15);
//$day2=($_SESSION["day"]>14?15:31);

$month=0;
$dia=date("d");

if(($dia>0 && $dia<=4)){
	$month=date("m")-1;
	$day1="16";
	$day2="31";

}elseif(($dia>4 && $dia<=22)){
	$month=date("m");
	$day1="01";
	$day2="15";

}elseif(($dia>22 && $dia<=31)){
	$month=date("m");
	$day1="16";
	$day2="31";
}

$day1="01";
$day2="31";


echo "<center>"; 
//tab_gral_st();

echo "<table class=myTable-gray align=center>";

	echo "<tr>";
		echo "<td class=subtitulo><font color=white>Datos</font></td>";
		echo "<td class=subtitulo><font color=white>Dia / Mes / A�o - Hora</font></td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td class=bold>Primera Fecha</td>";
	
		echo "<td align=right>";	
			sel_date("fec_day1",1,31,$day1,1);
			//sel_date("fec_month1",1,12,($_SESSION["month"]-$desc_month),1);
			//sel_date("fec_year1",2015,2018,($_SESSION["year"]-0),1);
			sel_date("fec_month1",1,12,$month,1);
			sel_date("fec_year1",2018,2023,date("Y"),1);
			sel_date("hr1",1,23,0);	
		echo "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td class=bold>Segunda Fecha</td>";

		echo "<td align=right>";	
			sel_date("fec_day2",1,31,$day2,1);
			//sel_date("fec_month2",1,12,($_SESSION["month"]-$desc_month),1);
			//sel_date("fec_year2",2015,2018,($_SESSION["year"]-0),1);
			sel_date("fec_month2",1,12,$month,1);
			sel_date("fec_year2",2018,2023,date("Y"),1);
			sel_date("hr2",1,23,23);
		echo "</td>";
	echo "</tr>";