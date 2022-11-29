<?php

function det_class($opsit,$prest){

	if($prest!="NO CORRESPONDE" && $prest!="FALTA SIN AVISO"){
		$class=($opsit==1?"begin":($opsit==0?"":"finish"));
	}else{
		$class="novalid";
	}

	return $class;
}


function posibles_cuidadores($departamento,$prestaciones,$turno,$pendiente=0,$auditores=0){

	$turno=($turno=="MANANA"?"enf_turno='AM'":($turno=="TARDE"?"enf_turno='PM'":""));

	$categ="enf_role='CUID'";
	$enf_categ=1;
		
	$cond=$categ;

	$query="SELECT e_mat,CONCAT(enf_apellido,' ',enf_nombre) as enfermero ,enf_owner,enf_estado,enf_role"
						." FROM enfermero"
						." WHERE ".$cond." AND enf_estado='ACTIVO' order by enf_owner,enf_apellido";

	//echo $query;
	$conn=newConnect();
	$res=mysqli_query($conn,$query) or die(mysql_error($conn));
	
	$index=0;
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		//echo $row["enfermero"]." ".$row["enf_role"]." ".$row["enf_turno"]."<br>";
		$enf[$index]=$row["enfermero"]."-".$row["e_mat"]."-".$row["enf_owner"];
		$index++;
	}

	if($pendiente==1){
		$index=$index+1;
		$enf[$index]="PENDIENTES-4444-SOE";
		for($i=9991;$i<10000;$i++){
			$index++;
			$enf[$index]="ALT-".$i."-SOE";
		}
	}

	if($auditores==1){
		$enf[$index+1]="Hijarrubia Fernando-2327-SOE";
		$enf[$index+2]="Zapata Cristina-3111-SOE";
	}


	return $enf;
}

function det_dia($day,$month,$year,$salto){

	$dia=($day+$salto);
	$mes=$month;
	$year=$year;

	$bis=(($month%4==0)?"SI":"NO");

	$cant_dias=month_countDays($month,$year);

	if($dia<0)	{	if(($mes-1)==0){
						$mes=12;
						$year--;	
					}elseif(($mes-1)>0) $mes=$mes-1;
					
					$cant_dias=month_countDays(($mes),$year);
					$dia=$cant_dias+$dia;
	}
	if($dia==0)	{	if(($mes-1)==0){
						$mes=12;
						$year--;
					}elseif(($mes-1)>0) $mes=$mes-1;
		
					$cant_dias=month_countDays(($mes),$year);
					$dia=$cant_dias;	
	}

	if($dia>$cant_dias){
		$dia=$dia-$cant_dias;
			$mes++;
	}

	if($mes>12){
		$mes=1;
		$year++;
		//$year="0".$year;
		if($year%4==0)$bis="SI";
	}

	$fecha=$year."-".$mes."-".$dia;
	return $fecha;
}

function addMinDate($FechaStr, $MinASumar) {

$FechaStr = str_replace("-", " ", $FechaStr);
$FechaStr = str_replace(":", " ", $FechaStr);

$FechaOrigen = explode(" ", $FechaStr);

$Dia = $FechaOrigen[2];
$Mes = $FechaOrigen[1];
$Ano = $FechaOrigen[0];

$Horas = $FechaOrigen[3];
$Minutos = $FechaOrigen[4];
$Segundos = $FechaOrigen[5];

// Sumo los minutos
$Minutos = ((int)$Minutos) + ((int)$MinASumar);

// Asigno la fecha modificada a una nueva variable
$FechaNueva = date("Y-m-d H:i:s",mktime($Horas,$Minutos,$Segundos,$Mes,$Dia,$Ano));

return $FechaNueva;
}

?> 