<?php
	if($table=="ins"){
		
		$query_ins="INSERT INTO enfermero"
							."(enf_nombre,enf_telefono,enf_apellido,enf_domicilio,enf_dpto,enf_cp,enf_dni,enf_cuil,enf_fact,enf_fecnac,enf_estado,"
							."e_mat,enf_vto_mat,enf_role,enf_turno,enf_owner,enf_auditor,enf_auditor2,enf_sexo,enf_contador,enf_movil,enf_contrato)"
							." VALUES ("
							."'".$_POST["enf_nombre"]."','"
								.$_POST["enf_telefono"]."','"
								.$_POST["enf_apellido"]."','"
								.$_POST["enf_domicilio"]."','"
								.$_POST["enf_dpto"]."','"
								.$_POST["enf_cp"]."','"
								.$_POST["enf_dni"]."','"
								.$_POST["enf_cuil"]."','"
								.$_POST["fact_state"]."','"
								.$_POST["enf_fecnac"]."','"
								."ACTIVO','"
								.$_POST["e_mat"]."','"
								.$_POST["vto_year"]."-".$_POST["vto_month"]."-01','"
								.$_POST["enf_role"]."','"
								.($_POST["turno_desc"]=="AMBOS"?"AP":$_POST["turno_desc"])."','"
								.$_POST["enf_owner"]."','"
								.$_POST["enf_auditor"]."','"
								.($_POST["enf_auditor2"]!="-"?$_POST["enf_auditor2"]:"")."','"
								.$_POST["enf_sexo"]."','"
								.$_POST["enf_contador"]."','"
								.$_POST["enf_movil"]."','"
								.($_POST["enf_contrato"]=="SI"?1:0)."')";
		
		$conn=newConnect();
		mysqli_query($conn,$query_ins) or die(mysqli_error($conn));
		log_write($_SESSION["usr_mat"],"INGRESO ENFERMERO","insert",$query_ins);	

		$query_ins1="INSERT into usuario"
						."(usr_name,usr_pswd,usr_mat,usr_role,usr_level)"
						." VALUES ("
						."'".$_POST["usr_name"]."','"
							.$_POST["usr_pswd"]."','"
							.$_POST["e_mat"]."','"
							.$_POST["usr_role"]."','"
							.$_POST["usr_level"]."')";

		mysql_query($query_ins1) or die(mysql_error());
		log_write($_SESSION["usr_mat"],"INGRESO DATOS USUARIO","insert",$query_ins1);		
		
		
		for($i=1;$i<5;$i++){
			if($_POST["zona".$i]!="-"){
				$query_zona="INSERT INTO zonaenf (zona_desc,e_mat) VALUES ('".$_POST["zona".$i]."','".$_POST["e_mat"]."')";
				mysqli_query($conn,$query_zona) or die(mysqli_error($conn));
				log_write($_SESSION["usr_mat"],"INGRESO ZONAS ENFERMERO","insert",$query_zona);
			}
		}

			
	}elseif($table=="upd"){

		$conn=newConnect();
		$query_upd="UPDATE enfermero SET "
								."enf_nombre='".$_POST["enf_nombre"]."', "
									."enf_apellido='".$_POST["enf_apellido"]."', "
									."enf_telefono='".$_POST["enf_telefono"]."', "
									."enf_domicilio='".$_POST["enf_domicilio"]."', "
									."e_mat='".$_POST["e_mat"]."', "
									."enf_vto_mat='".$_POST["vto_year"]."-".$_POST["vto_month"]."-01',"
									."enf_fecnac='".$_POST["enf_fecnac"]."', "
									."enf_dni='".$_POST["enf_dni"]."', "
									."enf_cuil='".$_POST["enf_cuil"]."', "
									."enf_fact='".$_POST["fact_state"]."', "
									."enf_estado='".$_POST["enf_estado"]."', "
									."enf_dpto='".$_POST["enf_dpto"]."', "
									."enf_zona='".substr($_POST["zona1"],5)."', "
									."enf_cp='".$_POST["enf_cp"]."', "
									."enf_turno='".($_POST["turno_desc"]=="AMBOS"?"AP":$_POST["turno_desc"])."', "
									."enf_role='".$_POST["enf_role"]."',"
									."enf_auditor='".$_POST["enf_auditor"]."',"
									."enf_auditor2='".($_POST["enf_auditor2"]!="-"?$_POST["enf_auditor2"]:"")."',"
									."enf_owner='".$_POST["enf_owner"]."',"
									."enf_sexo='".$_POST["enf_sexo"]."',"
									."enf_contador='".$_POST["enf_contador"]."',"
									."enf_cta='".$_POST["enf_cta"]."',"
									."enf_movil='".$_POST["enf_movil"]."',"
									."enf_contrato	='".($_POST["enf_contrato"]=="SI"?1:0)."'"
								." WHERE enf_id='".$_SESSION["p_id_ant"]."'";

		mysqli_query($conn,$query_upd) or die(mysqli_error($conn));
		log_write($_SESSION["usr_mat"],"ACTUALIZACION DATOS ENFERMERO","update",$query_upd);	

		$consulta=mysqli_query($conn,"SELECT * FROM usuario where usr_id='".$_SESSION["usr_id_ant"]."'") or die(mysql_error());

		if(mysqli_num_rows($consulta)){

			$query_upd1="UPDATE usuario SET "
								."usr_name='".$_POST["usr_name"]."', "
								."usr_pswd='".$_POST["usr_pswd"]."', "
								."usr_mat='".$_POST["e_mat"]."', "
								."usr_role='".$_POST["usr_role"]."', "
								."usr_level='".$_POST["usr_level"]."'"
							." WHERE usr_id='".$_SESSION["usr_id_ant"]."'";
		}else{
			
			$query_upd1="INSERT into usuario"
						."(usr_name,usr_pswd,usr_mat,usr_role,usr_level)"
						." VALUES ("
						."'".$_POST["usr_name"]."','"
							.$_POST["usr_pswd"]."','"
							.$_POST["e_mat"]."','"
							.$_POST["usr_role"]."','"
							.$_POST["usr_level"]."')";
		}

		mysqli_query($conn,$query_upd1) or die(mysql_error($conn));
		log_write($_SESSION["usr_mat"],"update","ACTUALIZACION DATOS USUARIO",$query_upd1);	

		$query_del="DELETE FROM zonaenf WHERE e_mat='".$_POST["e_mat"]."'";
		mysqli_query($conn,$query_del) or die(mysqli_error($conn));
		log_write($_SESSION["usr_mat"],"BORRADO DATOS ZONAENF","delete",$query_del);			

		for($i=1;$i<5;$i++){
			if($_POST["zona".$i]!="-"){
				$query_ins="INSERT INTO zonaenf (zona_desc,e_mat) values('".$_POST["zona".$i]."','".$_POST["e_mat"]."')";
				mysqli_query($conn,$query_ins) or die(mysqli_error($conn));
				log_write($_SESSION["usr_mat"],"INGRESO DATOS ZONAENF","insert",$query_ins);			
			}
		}
		
	}elseif($table=="sel"){
		
		$res=mysql_query("select * from enfermero where "
			."e_mat='".$_POST["matricula"]."'")
		or die(mysql_error());
	}elseif($table=="del"){
		$res=mysql_query("select * from enfermero where "
			."e_mat='" .$_POST["matricula"]."'")
		or die(mysql_error());
		
		while($row1=mysql_fetch_array($res,MYSQL_ASSOC)){
			mysql_query("insert into desc_enfermero values('','"
				.$row1["p_nombre"]."','"
				.$row1["p_telefono"]."','"
				.$row1["p_apellido"]."','"
				.$row1["p_domicilio"]."','"
				.$row1["p_departamento"]."','"
				.$row1["p_fecha_nac"]."','"
				.$row1["p_os"]."','"
				.$row1["e_mat"]."')")
			or die(mysql_error());
		}
		


	}elseif($table=="del_det_enf"){
			mysql_delete($_GET["table"],"op_id='".$_GET["op_id"]."'","delete a operation - inc/resolv.inc.php - del_det_enf");	
	
	}elseif($table=="check_enf"){
			mysql_update($_GET["table"]
							,"op_rev='1'"
							,"e_mat='".$_GET["e_mat"]."' and op_date between '".$_GET["op_date"]." 00:00:00' and '".$_GET["op_date"]." 23:59:59'"
							,"Chequear los domicilios del enfermero - inc/resolv.inc.php - check_enf");	
	
	}elseif($table=="uncheck_all_enf"){
			mysql_update($_GET["table"]
							,"op_rev='0'"
							,"op_date between '".$_GET["op_date"]." 00:00:00' and '".$_GET["op_date"]." 23:59:59'"
							,"Chequear los domicilios de todos los enfermeros - inc/resolv.inc.php - check_enf");	
	}
	elseif($table=="check_all_enf"){
			mysql_update($_GET["table"]
							,"op_rev='1'"
							,"(e_mat!='2999' and e_mat!='4444') and op_date between '".$_GET["op_date"]." 00:00:00' and '".$_GET["op_date"]." 23:59:59'"
							,"Chequear los domicilios de todos los enfermeros - inc/resolv.inc.php - check_enf");	
	}
	


?>