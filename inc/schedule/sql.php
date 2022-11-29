<?php

if($table=="op_ins"){

	$table_bd="op".$_SESSION["year_tmp"]."cuidados";
	$date=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"];
	$sys=$_SESSION["year"].$_SESSION["month"].$_SESSION["day"].date("His");	

	$hrs=($_POST["hrs"]+$i+((!isset($_POST["planif_direct"]) &&$i>3)?4:0)).":".$_POST["min"].":00";
	
	if($_POST["enf_owner"]=="ZER")
		$val=1;
	else
		$val=0;
//	echo $_POST["enf_owner"];
//	echo $val;

	$query="INSERT INTO ".$table_bd
			." (pac_id, op_date,op_prestacion,op_coseg,e_mat,op_sit, cant_horas,op_formato,usr_mat,op_lastmodif,op_reg)"
			." VALUES("
				."'".$_POST["pac_id"]."',"
				."'".$date." ".$hrs."',"
				."'".$_POST["op_prestacion"]."',"
				."'-70',"
				."'".$_POST["e_mat"]."',"
				."'0',"
				."'".$_POST["cant_horas"]."',"
				."'".$_POST["op_formato"]."',"
				."'".$_SESSION["usr_mat"]."',"
				."'".date("Ymd").date("His")."',"
				."'".($_POST["enf_owner"]=="ZER"?1:0)."')";

			$conn=newConnect();
			mysqli_query($conn,$query) or die(mysqli_error($conn));
			log_write($_SESSION["user"],$query,"insert","agregar prestacion");

}elseif($table=="delday"){

	$query="DELETE from ".$_POST["table"]
			." where op_date between '".$_POST["op_date"]." 00:00:00'"." AND '".$_POST["op_date"]." 23:59:59'";

	$conn=newConnect();
	mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	log_write_gral($_SESSION["user"],$query,"delete","BORRADO DEL DIA COMPLETO:".$_POST["op_date"]);

}elseif($table=="cpyday"){		
	
	$conn=newConnect();
	$sys=$date.' '.date("h:i:s");

	//delete all register to day to copy.
	if($_POST["deldatos"]==1){

		$query="DELETE FROM ".$table_dest." WHERE op_date between '".$date." 00:00:00' AND '".$date." 23:59:59'";

		
		mysqli_query($conn,$query) or die(mysqli_error($conn));
		log_write_gral($_SESSION["user"],"BORRADO DEL DIA COMPLETO PARA COPIAR EL DIA PORQUE SE ELIGIO BORRAR","delete",$query);
	}


	$res=mysqli_query($conn,"SELECT * FROM ".$table_src
						." WHERE op_date between '".$_POST["op_date"]. " 00:00:00' and '".$_POST["op_date"]." 23:50:00'"
						//." AND op_reg='".type_user($_SESSION["user"])."'"
						." ORDER BY op_date") or die(mysqli_error($conn));

	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){

		$hrs=explode(" ",$row["op_date"]);
		
		$query1="INSERT INTO ".$table_dest
					." (pac_id, op_date,op_prestacion,op_coseg,e_mat,cant_horas,op_formato,op_sit,usr_mat,op_lastmodif,op_reg)"
					." VALUES('".$row["pac_id"]."',"
						."'".$date." ".$hrs[1]."',"
						."'".$row["op_prestacion"]."',"
						."'".$row["op_coseg"]."',"
						."'".$row["e_mat"]."',"
						."'".$row["cant_horas"]."',"
						."'".$row["op_formato"]."',"
						."'0',"
						."'".$_SESSION["usr_mat"]."',"
						."'".date("Ymd").date("His")."',"
						."'".$row["op_reg"]."')";

		mysqli_query($conn,$query1) or die(mysqli_error($conn));
		log_write_gral($_SESSION["user"],"COPIADO DEL DIA","insert",$query1);

	}



}elseif($table=="upd_addr"){

	$owner=($_POST["op_reg"]==1?"ZER":"COOP");
	$cond="";

	if($owner!=$_POST["enf_owner"]){
		$cond="op_reg='".($_POST["enf_owner"]=="ZER"?1:0)."',";
	}

	$query="UPDATE ".$_POST["table"]	
				." SET op_date='".$_POST["op_date"]."',"
					."op_prestacion='".$_POST["prestacion"]."',"
					."op_coseg='".$_POST["coseg"]."',"
					."cant_horas='".$_POST["cant_horas"]."',"
					."op_formato='".$_POST["op_formato"]."',"
					.$cond
					."e_mat='".$_POST["e_mat"]."'"
				." WHERE op_id='".$_POST["op_id"]."'";

	//echo $query;
	$conn=newConnect();
	mysqli_query($conn,$query) or die(mysqli_error($conn));
	//log_write($_SESSION["user"],"actualizacion datos en el dia(nro)","update",$query);

}elseif($table=="op_del"){

	$conn=newConnect();
	//delete planification
	if(isset($_POST["dplan"]) && $_POST["dplan"]=="on"){

		$qr=mysqli_query("SELECT op_date, pac_id, op_complex FROM ".$_POST["table"]." WHERE op_id='".$_POST["op_id"]."'")or die(mysqli_error($conn));

		if($rw=mysqli_fetch_array($qr,MYSQLI_ASSOC)){
				mysqli_query("DELETE FROM "	.$_POST["table"]." WHERE pac_id='".$rw["pac_id"]."'"
											." AND op_date>='".$rw["op_date"]."'"
											//." AND op_reg='".type_user($_SESSION["user"])."'"
											);
		}
	//delete only schedule
	}else{
		
		$queryins="INSERT INTO opdel SELECT * FROM ".$_POST["table"]." WHERE op_id='".$_POST["op_id"]."'";
		mysqli_query($conn,$queryins) or die(mysqli_error($conn));
		log_write($_SESSION["user"],"INSERCION EN OPDEL","delete",$queryins);
		
		$query="DELETE FROM ".$_POST["table"]." WHERE op_id='".$_POST["op_id"]."'";
		mysqli_query($conn,$query) or die(mysqli_error($conn));
		log_write($_SESSION["user"],"borrar prestacion","delete",$query);
	}

}elseif($table=="copia_avanz"){

	$emat1=explode(" - ",$_POST["e_mat1"]);
	$emat2=explode(" - ",$_POST["e_mat2"]);

	$opt=($_POST["copiar"]=="Todos"?"":($_POST["copiar"]=="SIN EVOLUCION"?" AND op_sit<3":" AND op_sit>2"));

	$conn=newConnect();
	$res=mysqli_query($conn,"SELECT *, date_format(op_date,\"%H:%i:%s\") as hour from ".$_POST["table"]
							." WHERE op_date between '".$_POST["op_date"]." ".$_POST["hr1"].":".$_POST["min1"].":00'"
							." AND '".$_POST["op_date"]." ".$_POST["hr2"].":".$_POST["min2"].":59'"
							//." AND op_reg='".type_user($_SESSION["user"])."'"
							.$opt
							." AND e_mat='".$emat1[0]."'") or die(mysqli_error($conn));

	$_POST["table1"]="op".$_POST["year"]."cuidados";


	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		
		$query= "insert into ".$_POST["table1"]." (pac_id,op_date,"
						."op_prestacion,op_coseg,e_mat,cant_horas,op_formato,op_sit,usr_mat,op_lastmodif,op_reg) VALUES("
						."'".$row["pac_id"]."',"
						."'".$_POST["year"]."-".$_POST["month"]."-".$_POST["day"]." ".$row["hour"]."',"
						."'".$row["op_prestacion"]."',"
						."'".$row["op_coseg"]."',"
						."'".$emat2[0]."',"
						."'".$row["cant_horas"]."',"
						."'".$row["op_formato"]."',"
						."'0',"
						."'".$_SESSION["usr_mat"]."',"
						."'".date("Ymdhis")."',"
						."'".$row["op_reg"]."')";
		
		mysqli_query($conn,$query) or die(mysqli_error($conn));
		log_write_gral($_SESSION["user"],"SE COPIAN(AVANZADA) QTS DE ".$emat1[0]." a ".$emat2[0]." - opt=".$opt,"insert",$query);	
	}


}elseif($table=="qts_moves"){

	$emat1=explode(" - ",$_POST["e_mat1"]);
	$emat2=explode(" - ",$_POST["e_mat2"]);

	$opt=($_POST["copiar"]=="Todos"?"":($_POST["copiar"]=="SIN EVOLUCION"?" AND op_sit<3":" AND op_sit>2"));

	$conn=newConnect();
	$res=mysqli_query($conn,"SELECT op_id, date_format(op_date,\"%H:%i:%s\") as hour from ".$_POST["table"]
							." WHERE op_date between '".$_POST["op_date"]." ".$_POST["hr1"].":".$_POST["min1"].":00'"
							." AND '".$_POST["op_date"]." ".$_POST["hr2"].":".$_POST["min2"].":59'"
							.$opt
							." AND e_mat='".$emat1[0]."'") or die(mysqli_error($conn));
	
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		$query="UPDATE ".$_POST["table"]
					." SET e_mat='".$emat2[0]."', op_date='".$_POST["year"]."-".$_POST["month"]."-".$_POST["day"]." ".$row["hour"]."'"
					." WHERE op_id='".$row["op_id"]."'";

		mysqli_query($conn,$query) or die(mysqli_error($conn));
		log_write_gral($_SESSION["user"],"SE MUEVEN QTS DE ".$emat1[0]." a ".$emat2[0]." - opt=".$opt,"insert",$query);
	}

}elseif($table=="op_del_planif"){

	$conn=newConnect();
	//echo "ESTAMOS POR ACA";
	//delete planification
	if(isset($_POST["delplanifdiaria"]) || isset($_POST["delplanif"]) || isset($_POST["delmatric"]) || isset($_POST["delprestacion"])){
		
		//echo $_POST["op_date"];
		$cond="";
		
		if(isset($_POST["delplanif"])){
			$cond=" AND op_date>='".$_POST["op_date"]."'";
			//echo "BORRAMOS TODO";
		}

		if(isset($_POST["delplanifdiaria"])){
			$date=explode(" ",$_POST["op_date"]);
			$cond=" AND op_date between '".$_POST["op_date"]."' and '".$date[0]." 23:59:59'";
			//echo "BORRAMOS TODO";
		}

		if((isset($_POST["delplanif"]) || isset($_POST["delplanifdiaria"])) && isset($_POST["delprestacion"])){
			$cond=$cond." AND op_prestacion='".$_POST["op_prestacion"]."'";
			//echo "LOS QUE TENGAN IGUAL PRESTACION";
		}

		if((isset($_POST["delplanif"]) || isset($_POST["delplanifdiaria"])) && isset($_POST["delmatric"])){
			$cond=$cond." AND e_mat='".$_POST["e_mat"]."'";
			//echo "LOS QUE TENGAN IGUAL MATRICULA";
		}

		//echo $cond;

		if($cond!=""){

			//$queryins="INSERT INTO opdel SELECT * FROM ".$_POST["table"]." WHERE pac_id='".$_POST["pac_id"]."'".$cond;
			
			//mysqli_query($conn,$queryins) or die(mysqli_error($conn));
			//log_write($_SESSION["user"],"AGREGA PRESTACION ANTES DE SER BORRADA EN LA TABLA OPDEL",$queryins);
						
			$query="DELETE FROM ".$_POST["table"]." WHERE pac_id='".$_POST["pac_id"]."'".$cond;
			mysqli_query($conn,$query) or die(mysqli_error($conn));
			log_write($_SESSION["user"],"SE BORRA PRESTACION/ES EN det_enf","delete",$query);
		}
		
	//delete only schedule
	}else{
		
		//$queryins="INSERT INTO opdel SELECT * FROM ".$_POST["table"]." WHERE op_id='".$_POST["op_id"]."'";
		//mysqli_query($conn,$queryins) or die(mysqli_error($conn));
		//log_write($_SESSION["user"],"INSERCION EN OPDEL",$queryins);
		
		$query="DELETE FROM ".$_POST["table"]." WHERE op_id='".$_POST["op_id"]."'";
		mysqli_query($conn,$query) or die(mysqli_error($conn));
		log_write($_SESSION["user"],"borrar prestacion sin planificacion","delete",$query);
	}

}elseif($table=="upd_opsit"){

	$val=(($_GET["op_sit"]+1)%3);

	$conn=newConnect();
	$query="UPDATE ".$_GET["table"]." SET op_sit='".$val."' WHERE op_id='".$_GET["op_id"]."'";
	mysqli_query($conn,$query) or die(mysqli_error($conn));
	log_write($_SESSION["user"],"CAMBIA el op_sit de la operacion ".$_GET["op_id"],"update",$query);


}elseif($table=="add_auditoria"){

	$conn=newConnect();
	$query="INSERT INTO auditoria (op_id,pac_id,aud_tipo,aud_forma,aud_date,aud_movilidad,"
					."aud_conciencia,aud_esfinteres,aud_ingesta,aud_heridas,aud_contencion,aud_zonaroja,"
					."cant_horas,aud_formato,aud_regimen,aud_evol)"
					." VALUES ("
						."'".$_POST["op_id"]."',"
						."'".$_POST["pac_id"]."',"
						."'".$_POST["tipo"]."',"
						."'".$_POST["forma"]."',"						
						."'".$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"]." ".date("H:i:s")."',"
						."'".$_POST["movilidad"]."',"
						."'".$_POST["conciencia"]."',"
						."'".$_POST["esfinteres"]."',"
						."'".$_POST["ingesta"]."',"
						."'".$_POST["heridas"]."',"
						."'".$_POST["contencion"]."',"
						."'".$_POST["zonaroja"]."',"
						."'".$_POST["cant_horas"]."',"
						."'".$_POST["formato"]."',"
						."'".$_POST["regimen"]."',"
						."'".$_POST["evol"]."')";

		$conn=newConnect();
		mysqli_query($conn,$query) or die(mysqli_error($conn));
		log_write($_SESSION["user"],$query,"insert","se agrega auditoria. sch.2950");


	if($_POST["tipo"]=="ingreso"){
		$query="UPDATE ".$_POST["table"]." SET op_sit='1' where op_id='".$_POST["op_id"]."'";

		$conn=newConnect();
		mysqli_query($conn,$query) or die(mysqli_error($conn));
		log_write($_SESSION["user"],$query,"insert","se actualiza estado a 1. sch.3030");
	
	}elseif($_POST["tipo"]=="control"){
		$query="UPDATE ".$_POST["table"]." SET op_sit='3' where op_id='".$_POST["op_id"]."'";

		$conn=newConnect();
		mysqli_query($conn,$query) or die(mysqli_error($conn));
		log_write($_SESSION["user"],$query,"update","se actualiza estado a 3. sch.3100");
	}

}elseif($table=="upd_auditoria"){

	$query="UPDATE auditoria SET "
				."aud_movilidad='".$_POST["movilidad"]."',"
				."aud_tipo='".$_POST["tipo"]."',"
				."aud_forma='".$_POST["forma"]."',"
				."aud_conciencia='".$_POST["conciencia"]."',"
				."aud_esfinteres='".$_POST["esfinteres"]."',"
				."aud_ingesta='".$_POST["ingesta"]."',"
				."aud_heridas='".$_POST["heridas"]."',"
				."aud_contencion='".$_POST["contencion"]."',"
				."aud_zonaroja='".$_POST["zonaroja"]."',"
				."cant_horas='".$_POST["cant_horas"]."',"
				."aud_formato='".$_POST["formato"]."',"
				."aud_regimen='".$_POST["regimen"]."',"
				."aud_evol='".$_POST["evol"]."'"
				." WHERE aud_id='".$_POST["aud_id"]."'";

	$conn=newConnect();
	mysqli_query($conn,$query) or die(mysqli_error($conn));
	log_write($_SESSION["user"],$query,"update","se actualiza auditoria. sch.3330");


}elseif($table=="add_planif"){

	$emat=explode(" - ",$_POST["e_mat"]);
	if(isset($_POST["e_mat1"])) $emat1=explode(" - ",$_POST["e_mat1"]);

	$fec=explode("/",$_POST["fecha"]);

	$fecha=$fec[2]."-".$fec[1]."-".$fec[0]." ".$_POST["hora"].":".$_POST["min"].":00";

	$conn=newConnect();
	mysqli_query($conn,"UPDATE auditoria SET "
								."e_mat='".$emat[1]."',"
								.(isset($_POST["e_mat1"])?"e_mat1='".$emat1[1]."',":"")
								."date_beg='".$fecha."'"
								." WHERE aud_id='".$_POST["aud_id"]."'") or die(mysqli_error($conn));


	mysqli_query($conn,"UPDATE ".$_POST["table"]." SET op_sit='2' where op_id='".$_POST["op_id"]."'") or die(mysqli_error($conn));

}elseif($table=="prog_auditoria"){

	if($_POST["op_formato"]=="Fraccion" && $_POST["cant_horas"]>7){
		$cant_horas=$_POST["cant_horas"]/2;
	}else
		$cant_horas=$_POST["cant_horas"];


	$query="INSERT INTO ".$_POST["table"]
		." (pac_id, op_date,op_prestacion,op_coseg,e_mat,op_sit, cant_horas,op_formato,usr_mat,op_lastmodif,op_reg)"
		." VALUES("
			."'".$_POST["pac_id"]."',"
			."'".$_POST["fecha"]." ".$_POST["hora"].":00',"
			."'CUIDADOS',"
			."'-70',"
			."'".$_POST["e_mat"]."',"
			."'0',"
			."'".$cant_horas."',"
			."'".$_POST["op_formato"]."',"
			."'".$_SESSION["usr_mat"]."',"
			."'".date("Ymd").date("His")."',"
			."'".$_POST["op_reg"]."')";

		//echo $query;
		$conn=newConnect();
		mysqli_query($conn,$query) or die(mysqli_error($conn));
		log_write($_SESSION["user"],$query,"insert","agregar prestacion programada x auditoria");

		mysqli_query($conn,"UPDATE ".$_POST["table"]." SET op_sit='3' where op_id='".$_POST["op_id"]."'") or die(mysqli_error($conn));


		if(isset($_POST["e_mat1"]) && ($_POST["e_mat1"]!="" && $_POST["e_mat1"]!="-" && $_POST["e_mat1"]!=0)){

			$query="INSERT INTO ".$_POST["table"]
				." (pac_id, op_date,op_prestacion,op_coseg,e_mat,op_sit, cant_horas,op_formato,usr_mat,op_lastmodif,op_reg)"
				." VALUES("
					."'".$_POST["pac_id"]."',"
					."'".$_POST["fecha"]." 16:00:00',"
					."'CUIDADOS',"
					."'-70',"
					."'".$_POST["e_mat1"]."',"
					."'0',"
					."'".$cant_horas."',"
					."'".$_POST["op_formato"]."',"
					."'".$_SESSION["usr_mat"]."',"
					."'".date("Ymd").date("His")."',"
					."'".$_POST["op_reg1"]."')";

				$conn=newConnect();
				mysqli_query($conn,$query) or die(mysqli_error($conn));
				log_write($_SESSION["user"],$query,"insert","agregar prestacion programada x auditoria");

		}

}

?>
