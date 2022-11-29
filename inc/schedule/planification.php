<?php
include ("inc/schedule/schedule_func.php");
	
$conn=newConnect();

$per=$fr=0;
$bis="NO";
$sem=0;

$table=$_POST["table"];

if($_SESSION["year_tmp"]%4==0) $bis="SI";

$dia=$_SESSION["day_tmp"];
$mes=$_SESSION["month_tmp"];
$year=$_SESSION["year_tmp"];

($_SESSION["ins_hora"]==0)?	$hora_c="00"	:$hora_c=$_SESSION["ins_hora"];
($_SESSION["ins_min"]==0)?	$min="00"	:$min=$_SESSION["ins_min"];

$fr=$_POST["frecuencia"];
$per=$_POST["periodo"];
$hora=$hora_c;

$date=$year."-".$mes."-".$dia." ".$hora.":".$min.":00";

$qr=mysqli_query($conn,"SELECT * FROM ".$table." WHERE op_id='".$_POST["op_id"]."'") or die(mysqli_error($conn));
	
while($row2=mysqli_fetch_array($qr,MYSQLI_ASSOC)){	
	while($per!=0 or $hora!=$hora_c){
		
		$hora=$hora+$fr;
		
		if($hora>23 && $fr!=48){
			$dia++;
			$per--;
			$hora%=24;
		}elseif($hora>23 && $fr=48){
			if($sem<2){
				$dia=$dia+2;
				$sem=$sem+1;
				$per=$per-2;
				$hora%=24;
			}elseif($sem==2){
				$dia=$dia+3;
				$sem=0;
				$per=$per-2;
				$hora%=24;
			}
		}
		
		switch($mes){
			case '1':	$cant_dias=31;			break;
			case '2':	
				if($bis=="NO") $cant_dias=28;
				if($bis=="SI") $cant_dias=29;	break;
			case '3':	$cant_dias=31;			break;
			case '4':	$cant_dias=30;			break;
			case '5':	$cant_dias=31;			break;
			case '6':	$cant_dias=30;			break;
			case '7':	$cant_dias=31;			break;
			case '8':	$cant_dias=31;			break;
			case '9':	$cant_dias=30;			break;
			case '10':	$cant_dias=31;			break;
			case '11':	$cant_dias=30;			break;
			case '12':	$cant_dias=31;			break;
		}
		
		if($dia>$cant_dias){
			$dia=1;
			$mes++;
		}
		
		if($mes>12){
			$mes=1;
			$year++;
			$table="op".($_POST["year"]+1);
			echo $table;	
			if($year%4==0)$bis="SI";
		}
		$min_tmp=$min;
		$hora_tmp=$hora;

		$date_tmp=$year."-".$mes."-".$dia." ".$hora_tmp.":".$min_tmp.":00";

		if(day_week($dia,$mes,$year,$mes)!='Domingo'|| (!(isset($_POST["sunday_planif"])) && day_week($dia,$mes,$year,$mes)=='Domingo')) {
			
			$query_ins="INSERT INTO ".$table
					." (pac_id,op_date,op_prestacion,op_coseg,op_formato,cant_horas,e_mat,op_reg,usr_mat)"
					.	" VALUES('".$row2["pac_id"]."',"
						."'".$date_tmp."',"
						."'".$row2["op_prestacion"]."',"
						."'".$row2["op_coseg"]."',"
						."'".$row2["op_formato"]."',"
						."'".$row2["cant_horas"]."',"
						."'".$row2["e_mat"]."',"
						."'".$row2["op_reg"]."',"
						."'".$row2["usr_mat"]."')";
			mysqli_query($conn,$query_ins) or die(mysqli_error($conn));
			
			log_write_gral($_SESSION["user"],"planificacion x ".$_POST["periodo"]." dias, cada ".$_POST["frecuencia"]." hs.",$query_ins);	
		}
	}
}		
?>
