<?php

function day_week($dia, $mes, $ano) {
	$dias = array('Domingo', 'Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes', 'S�bado');
	return $dias[date("w", mktime(0, 0, 0, $mes, $dia, $ano))];
}

function month_toString($mes_nro,$mayus=0,$year=0){
	
	switch (intval($mes_nro)) {
		case 1: $mes= ($mayus==0?'Enero':'ENERO');				break;
		case 2: $mes= ($mayus==0?'Febrero':'FEBRERO');			break;
		case 3: $mes= ($mayus==0?'Marzo':'MARZO');				break;
		case 4: $mes= ($mayus==0?'Abril':'ABRIL');				break;
		case 5: $mes= ($mayus==0?'Mayo':'MAYO');					break;
		case 6: $mes= ($mayus==0?'Junio':'JUNIO');				break;
		case 7: $mes= ($mayus==0?'Julio':'JULIO');				break;
		case 8: $mes= ($mayus==0?'Agosto':'AGOSTO');				break;
		case 9: $mes= ($mayus==0?'Septiembre':'SEPTIEMBRE');	break;
		case 10:$mes= ($mayus==0?'Octubre':'OCTUBRE');			break;
		case 11:$mes= ($mayus==0?'Noviembre':'NOVIEMBRE');		break;
		case 12:$mes= ($mayus==0?'Diciembre':'DICIEMBRE');		break;
	}
	return ($year==1?$mes." ".(date("Y")):$mes);
}

function month_countDays($mes,$year){
	$bis="NO";
	$count_days=0;

	if($year%4==0) $bis="SI";

	switch($mes){
		case '01':	$count_days=31;			break;
		case '02':	
			if($bis=="NO") $count_days=28;
			if($bis=="SI") $count_days=29;	break;
		case '03':	$count_days=31;			break;
		case '04':	$count_days=30;			break;
		case '05':	$count_days=31;			break;
		case '06':	$count_days=30;			break;
		case '07':	$count_days=31;			break;
		case '08':	$count_days=31;			break;
		case '09':	$count_days=30;			break;
		case '10':	$count_days=31;			break;
		case '11':	$count_days=30;			break;
		case '12':	$count_days=31;			break;
	}

	return $count_days;
}

function sys_msg($code,$size=0,$color="white"){

	echo "<table>"
			."<tr><td align=center>	<font color=".$color." face=arial size=".$size."><b>";

	switch($code){
		//No existe paciente.
		case 0:	echo "No existe registro con ese parametro de busqueda.";						break;
		//No hay prestaciones en dichas fechas
		case 1:	echo "No existen prestaciones en rango de fechas seleccionado.";				break;
		//No existen prestaciones negativas
		case 2:	echo "No existen prestaciones negativas en rango de fechas seleccionado.";	break;
		//No existen prestaciones positivas
		case 3:	echo "No existen prestaciones positivas en rango de fechas seleccionado.";	break;
		//No 
		case 4:  echo "No quedan prestaciones pendientes a su cargo. Quedamos QAP.";			break;
	}

	if($code!=4)
		echo "<br>Intentelo nuevamente o comuniquese con el administrador del programa.</b></font></td></tr></table>";
}


function newConnect(){
	$conn=mysqli_connect("localhost","root","5032cuidados","cuida");
	return $conn;
}

function type_user($user){
	switch($user){
		case "root":
		case "franky":
		case "cristina":
		case "mariela":
		case "silvana":
			return 2;

		case "luis":
			return 0;

		case "lucho":
			return 1;
	}
}

function sel_date($name,$str=1, $end=31,$opt_sel,$step=1){

	echo "<select name=".$name.">";
	for($i=$str;$i<=$end;){
		echo "<option opt>".(strlen($i)<2?"0".$i:$i);
		$i=$i+$step;
	}
	echo "<option selected>".$opt_sel;
	echo "</select>";
}

function dia_semana($sem,$ext=0,$col=0){
	$dia="";
	switch($sem){
		case "Mon":	$dia="<font color=".($col==1?"blue":"black").">".($ext==1?"Lunes":"Lun")."</font>"; break;
		case "Tue":	$dia="<font color=".($col==1?"blue":"black").">".($ext==1?"Martes":"Mar")."</font>"; break;
		case "Wed":	$dia="<font color=".($col==1?"blue":"black").">".($ext==1?"Miercoles":"Mie")."</font>"; break;
		case "Thu":	$dia="<font color=".($col==1?"blue":"black").">".($ext==1?"Jueves":"Jue")."</font>"; break;
		case "Fri":	$dia="<font color=".($col==1?"blue":"black").">".($ext==1?"Viernes":"Vie")."</font>"; break;
		case "Sat":	$dia="<font color=".($col==1?"brown":"black").">".($ext==1?"Sabado":"Sab")."</font>"; break;
		case "Sun":	$dia="<font color=".($col==1?"red":"black").">".($ext==1?"Domingo":"Dom")."</font>"	; break;
	}
	return $dia;
}

function split_date($date){
	$datetime[]="";
	
	list($datetime["year"],$datetime["month"],$rest)=	explode("-",$date);
	if(strlen($rest)>2){	
		list($datetime["day"],$rest)=explode(" ",$rest);
		list($datetime["hr"],$datetime["min"],$datetime["sec"])=explode(":",trim($rest));
	}else{
		$datetime["day"]=$rest;
		list($datetime["hr"],$datetime["min"],$datetime["sec"])=0;
	}

	return $datetime;
}

function log_write($usr,$op,$ty_op,$desc){

	$user=$usr;
	$oper=$op;
	$descrip=$desc;
	$type_op=$ty_op;

	$date=date("Y-m-d H:i:s");

	$fp = fopen($_SERVER["DOCUMENT_ROOT"]."/auditoria/logs/".$type_op."-".date("m")."-log.php","a");

	 //$op1=encrypt($op);
	 fwrite($fp, "-- date=".$date.PHP_EOL."-- user=".$user.PHP_EOL."-- op=".$oper.PHP_EOL."-- desc=".$descrip.PHP_EOL."-- ----------------------------".PHP_EOL);
	 
	 //$op2=decrypt($op1);
	// fwrite($fp, $date.PHP_EOL.$usr.PHP_EOL.$op2.PHP_EOL."----------------------------". PHP_EOL);
	 fclose($fp);  		

}

function log_write_gral($usr,$op,$ty_op,$desc){

	$user=$usr;
	$oper=$op;
	$descrip=$desc;
	$type_op=$ty_op;

	$date=date("Y-m-d H:i:s");

	$fp = fopen($_SERVER["DOCUMENT_ROOT"]."/auditoria/logs/".$type_op."-".date("m")."-log.php","a");

	 //$op1=encrypt($op);
	 fwrite($fp, "-- date=".$date.PHP_EOL."-- user=".$user.PHP_EOL."-- op=".$oper.PHP_EOL."-- desc=".$descrip.PHP_EOL."-- ----------------------------".PHP_EOL);
	 
	 //$op2=decrypt($op1);
	// fwrite($fp, $date.PHP_EOL.$usr.PHP_EOL.$op2.PHP_EOL."----------------------------". PHP_EOL);
	 fclose($fp);  		

}

function encryptar($valor,$tipo=1) {
	$clave  = 'Una cadena, muy, muy larga para mejorar la encriptacion';
	$method = 'aes-256-cbc';
	$iv = base64_decode("C9fBxl1EWtYTL1/M8jfstw==");

	if($tipo==1){
		return openssl_encrypt ($valor, $method, $clave, false, $iv);
	}else{
		$encrypted_data = base64_decode($valor);
		return openssl_decrypt($valor, $method, $clave, false, $iv);
	
	}
}

function encrypt($cadena, $clave = "una clave secreta"){
	$cifrado = MCRYPT_RIJNDAEL_256;
	$modo = MCRYPT_MODE_ECB;
	return mcrypt_encrypt($cifrado, $clave, $cadena, $modo,mcrypt_create_iv(mcrypt_get_iv_size($cifrado, $modo), MCRYPT_RAND));
}

function decrypt($cadena, $clave = "una clave secreta"){
  $cifrado = MCRYPT_RIJNDAEL_256;
  $modo = MCRYPT_MODE_ECB;

  return mcrypt_decrypt($cifrado, $clave, $cadena, $modo,mcrypt_create_iv(mcrypt_get_iv_size($cifrado, $modo), MCRYPT_RAND));
}


function datediff($d1,$d2){

	list($date1,$time1)=explode(" ",$d1);
	list($date2,$time2)=explode(" ",$d2);

	list($year1,$month1,$day1)=explode("-",$date1);
	list($year2,$month2,$day2)=explode("-",$date2);

	//calculo timestam de las dos fechas
	$timestamp1 = mktime(0,0,0,$month1,$day1,$year1);
	$timestamp2 = mktime(4,12,0,$month2,$day2,$year2);

	//resto a una fecha la otra
	$segundos_diferencia = $timestamp1 - $timestamp2;
	//echo $segundos_diferencia;

	//convierto segundos en d�as
	$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

	//obtengo el valor absoulto de los d�as (quito el posible signo negativo)
	$dias_diferencia = abs($dias_diferencia);

	//quito los decimales a los d�as de diferencia
	$diff = floor($dias_diferencia);

	return $diff;

}

function det_zona($dpto){

	$tmp=explode(" - ",$dpto);
	$dpto=$tmp[0];

	switch($dpto){
		case "LUJAN DE CUYO":
			$dpto="LUJAN";
			break;
		case "RIVADAVIA":
		case "SAN MARTIN":
		case "JUNIN":
		case "PALMIRA":
			$dpto="ESTE";
			break;
		default:
			//$tmp=explode(" - ",$dpto);
			//$dpto=$tmp[0];
			break;

	}

	return "ZONA ".$dpto;

}

function create_menu($title, $subt,$event,$sub){
	$i=0;
	?>

	<a href="javascript:void(0)" class="headings" onClick="displaySubs('<?php echo $sub;?>')" onFocus="if(this.blur)this.blur()";>
	<strong><font color="#345b80" size=4 face=""><?php echo  $title." ...";?></font></strong></a>

	<div class="para"  id="<?php echo $sub;?>" style="display:none">

	<table align=center width=100%>

	<?php foreach($subt as $sub_title){ ?>
		
		<tr><td>   <a href="<?php echo $_SERVER["PHP_SELF"]."?event=".$event[$i];?>">
					<img src="iconos/icons/arrow_menu.png" border=0>    <font
					color=#345b80><b><?php echo $sub_title; ?></b></font></a></td></tr>
	<?php
		$i++;
		}
	   echo "<tr><td></td></tr>";
	 echo "</table>";
	echo "</div>";

}

function win_return($pos){
		
		switch($_SESSION["pos"]){
			case "schedule":	
			case "hrs":			
			case "del_pen":
			case "ant_sgte":
			case "upd_sch":
			case "planif_sch":
			case "show_data":
			case "upd_sch_cfg":
			case "del_sch":
			case "del_day":
			case "cpy_day":
			case "add_tips":
			case "upd_tips":
			case "set_day":			
			case "cpy_day_avanz":
			case "assign_qt":		header("Location:".$_SERVER["PHP_SELF"]."?event=schedule");	break;

			case "chg_st_cfg":	
			case "chg_dom_cfg":	
			case "show_patient":	header("Location:".$_SERVER["PHP_SELF"]."?event=patients");	break;

			case "det_enf_lst":	header("Location:".$_SERVER["PHP_SELF"]."?event=det_enf_lst&e_mat=".$emat."&date=".$date);	break;
			case "show_dat_pac":
			case "show_dat_pac_sema":
										$dt1=split_date($_SESSION["fec1"]);
										$dt2=split_date($_SESSION["fec2"]);
									
										header("Location:".$_SERVER["PHP_SELF"]."?event=det_lst_sh_hc"
																								."&pac_id=".$_POST["pac_id"]
																							."&fec_beg=".$dt1["year"]."-".$dt1["month"]."-".$dt1["day"]
																							."&fec_fin=".$dt2["year"]."-".$dt2["month"]."-".$dt2["day"]);
										break;

			case "enf":				header("Location:".$_SERVER["PHP_SELF"]."?event=enfermeros");	break;

			case "upd_enf_cfg":	header("Location:".$_SERVER["PHP_SELF"]."?event=viewdomxos"
									."&pac_id=".$_POST["pac_id"]."&fec_beg=".$_SESSION["fec1"]."&fec_fin=".$_SESSION["fec2"]);
								break;

			case "detxos":	header("Location:".$_SERVER["PHP_SELF"]."?event=viewdetxos"
									."&pac_id=".$_POST["pac_id"]."&fec_beg=".$_SESSION["fec1"]."&fec_fin=".$_SESSION["fec2"]);
							break;
			case "menu_user":	header("Location:".$_SERVER["PHP_SELF"]."?event=menu_user");	break;
		}
}


function dateDifference($date1, $date2)
{	
	$minFix=$hourFix=$secFix=0;

	$date1=strtotime($date1);
	$date2=strtotime($date2);
	$diff = abs($date1 - $date2);
	$day = $diff/(60*60*24); // in day
	$dayFix = floor($day);
	$dayPen = $day - $dayFix;
	if($dayPen > 0)
	{
	$hour = $dayPen*(24); // in hour (1 day = 24 hour)
	$hourFix = floor($hour);
	$hourPen = $hour - $hourFix;
	if($hourPen > 0)
	{
	$min = $hourPen*(60); // in hour (1 hour = 60 min)
	$minFix = floor($min);
	$minPen = $min - $minFix;
	if($minPen > 0)
	{
	$sec = $minPen*(60); // in sec (1 min = 60 sec)
	$secFix = floor($sec);
	}
	}
	}
	$str = "";
	if($dayFix > 0)
	$str.= $dayFix." day ";
	if($hourFix > 0)
	$str.= $hourFix." hour ";
	if($minFix > 0)
	$str.= $minFix." min ";
	if($secFix > 0)
	$str.= $secFix." sec ";
	return $str;
	}
 
?>