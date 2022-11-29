<?php

if($table=="ins"){

	$conn=newConnect();
	
	$query="INSERT INTO paciente"
				." (pac_nombre,pac_apellido,pac_domicilio,pac_dpto,pac_telefono,pac_dni,pac_os,pac_afil,"
				."pac_fecnac,pac_fecingr,ubc_lat,ubc_lon,pac_estado,usr_id) VALUES ("
				."'".$_POST["pac_nombre"]."','"
				.$_POST	["pac_apellido"]."','"
				.$_POST["pac_domicilio"]."','"
				.$_POST["pac_dpto"]."','"
				.$_POST["pac_telefono"]."','"
				.$_POST["pac_dni"]."','"
				.$_POST["pac_os"]."','"
				.$_POST["pac_afil"]."','"
				.$_POST["yearnac"]."-".$_POST["monthnac"]."-".$_POST["daynac"]."','"
				.date("Y-m-d")."','"
				.$_POST["ubc_lat"]."','"
				.$_POST["ubc_lon"]."','"
				."ACTIVO','"
				.$_SESSION["usr_mat"]."')";	

	mysqli_query($conn,$query) or die(mysqli_error($conn));
	log_write($_SESSION["user"],"INGRESO DATOS DEL PACIENTE","insert",$query);

}elseif($table=="upd"){

	$med_id="";

	if($_POST["medico"]!="" && $_POST["medico"]!="-"){
		$med=explode(" ",$_POST["medico"]);
		$rs=mysql_query("select med_id from medico where med_nombre='".$med[0]."' and med_apellido='".$med[1]."'") or die(mysql_error());
		if($rw=mysql_fetch_array($rs,MYSQL_ASSOC))	$med_id=$rw["med_id"];
	}
	
	//echo $_POST["ubc_lon"];
	if(isset($_POST["ubc_lon"])){
		$ubic[0]=$_POST["ubc_lat"];
		$ubic[1]=$_POST["ubc_lon"];
	}else
		$ubic=explode(",",$_POST["ubc_lat"]);
	
	//echo $ubic[1];
	

	$query="update paciente set "
		."pac_nombre='"	.$_POST["pac_nombre"]."', "
		."pac_apellido='"	.$_POST["pac_apellido"]."', "
		."pac_domicilio='".$_POST["pac_domicilio"]."', "
		."pac_dpto='"		.$_POST["pac_dpto"]."', "
		."pac_telefono='"	.$_POST["pac_telefono"]."', "
		."pac_os='"			.$_POST["pac_os"]."', "
		."pac_afil='"		.$_POST["pac_afil"]."', "
		."pac_dni='"		.$_POST["pac_dni"]."', "
		."pac_fecnac='"	.$_POST["yearnac"]."-".$_POST["monthnac"]."-".$_POST["daynac"]."', "
		."pac_osalt='"		.$_POST["pac_osalt"]."', "
		."ubc_lat='"		.$ubic[0]."', "
		."ubc_lon='"		.$ubic[1]."', "
		."pac_estado='"	.$_POST["pac_estado"]."', "
		."med_id='"			.$med_id."'"
		." WHERE pac_id='".$_POST["pac_id"]."'";

	$rs=mysql_query($query)	or die(mysql_error());
	log_write($_SESSION["user"],"ACTUALIZACION DATOS DEL PACIENTE","update",$query);

}elseif($table=="upd_state"){
	$pref=0;

	echo $_POST["pac_estado"];
	echo $_POST["pac_id"];

	switch($_POST["pac_estado"]){
		case "ALTA":		$pref="alta";	break;
		case "ALTA ENF":	$pref="alta";	break;
		case "INTERNADO":	$pref="int";	break;
		case "FALLECIDO":	$pref="qrt";	break;
	}

	$conn=newConnect();
	
	$query1="UPDATE paciente set pac_estado='".$_POST["pac_estado"]."' WHERE pac_id='".$_POST["pac_id"]."'";

	mysqli_query($conn,$query1) or die(mysqli_error($conn));
	log_write($_SESSION["user"],$query1,"update","ACTUALIZACION DEL ESTADO DEL PACIENTE EN TABLA PACIENTE");

	$query2="INSERT into estado "
				."(pac_id,est_ant,est_act,usr_mat,est_date,est_sys,est_desc ) values ("
				."'".$_POST["pac_id"]."'," 
				."'".$_POST["est_ant"]."'," 
				."'".$_POST["pac_estado"]."'," 
				."'".$_SESSION["usr_mat"]."'," 
				."'".$_POST["year"]."-".$_POST["month"]."-".$_POST["day"]." ".date("h:i:s")."',"
				."'".date("Y-m-d h-i-s")."',"
				."'".$_POST["desc"]."')";

	mysqli_query($conn,$query2) or die(mysqli_error($conn));
	log_write($_SESSION["user"],$query2,"insert","INSERTA EN LA TABLA ESTADO EL CAMBIO DE ESTADO DEL PACIENTE");

	/*$rs=mysqli_query($conn,"SELECT CONCAT(pac_nombre,' ',pac_apellido) as nombre, CONCAT(pac_domicilio,' ',pac_dpto) as domicilio"
							." FROM paciente"
							." WHERE pac_id='".$_POST["pac_id"]."'");

	if($rw=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
		mysqli_query($conn," INSERT into news"
								." (new_date,new_type,pac_nombre,pac_domicilio,new_desc,new_sys) VALUES ("
								."'".$_POST["year"]."-".$_POST["month"]."-".$_POST["day"]." ".date("h:i:s")."',"
								."'".$_POST["pac_estado"]."'," 
								."'".$rw["nombre"]."',"
								."'".$rw["domicilio"]."',"
								."'".$_POST["desc"]."',"
								."'".date("Y-m-d h:i:s")."')") or die(mysqli_error($conn));
	}*/	

}elseif($table=="upd_dom"){ 

	$conn=newConnect();
	mysqli_query($conn,"UPDATE paciente SET "
							."pac_domicilio='".$_POST["new_domicilio"]."',"
							."pac_dpto='".$_POST["new_dpto"]."',"
							."pac_telefono='".$_POST["new_telefono1"]."',"
							."pac_dni='".$_POST["new_telefono2"]."'"
						." WHERE pac_id='".$_POST["pac_id"]."'") or die(mysqli_error($conn));

	mysqli_query($conn,"INSERT into domicilio"
						." (pac_id,dom_ant,dpto_ant,dom_act,dpto_act,usr_mat,dom_date,dom_sys)"
						." VALUES ("
							."'".$_POST["pac_id"]."'," 
							."'".$_POST["dom_ant"]."'," 
							."'".$_POST["dpto_ant"]."',"
							."'".$_POST["new_domicilio"]."'," 
							."'".$_POST["new_dpto"]."',"
							."'".$_SESSION["usr_mat"]."'," 
							."'".$_POST["year"]."-".$_POST["month"]."-".$_POST["day"]." ".date("H:i:s")."',"
							."'".date("Y-m-d H-i-s")."')") or die(mysqli_error($conn));

}
?>
