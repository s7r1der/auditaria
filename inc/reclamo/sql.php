<?php

if($table=="recl_ins"){

	mysql_query("insert into reclamo (recl_titulo,pac_id,recl_responsable,recl_resp_nombre,recl_resp_telefono,"
				."recl_categ,recl_assign,recl_ingreso,recl_desc,recl_date,recl_estado,usr_mat)"
				." values("
					."'".$_POST["recl_titulo"]."',"
					."'".$_POST["pac_id"]."',"
					."'".$_POST["recl_responsable"]."',"				
					."'".$_POST["recl_resp_nombre"]."',"				
					."'".$_POST["recl_resp_telefono"]."',"				
					."'".$_POST["recl_categ"]."',"				
					."'".$_POST["recl_assign"]."',"				
					."'".$_POST["recl_ingreso"]."',"
					."'".$_POST["recl_desc"]."',"
					."'".date("Y-m-d H:i:s")."',"
					."'PENDIENTE',"
					."'".$_SESSION["usr_mat"]."')")or die(mysql_error());

}elseif($table=="recl_add"){

	mysql_query("insert into reclamo_evol (recl_id,recl_evol_desc,recl_evol_resp,recl_evol_resol,recl_evol_date,usr_mat)"
				." values("
					."'".$_POST["recl_id"]."',"
					."'".$_POST["recl_evol_desc"]."',"
					."'".$_POST["recl_assign"]."',"				
					."'".$_POST["recl_evol_resol"]."',"				
					."'".date("Y-m-d H:i:s")."',"
					."'".$_SESSION["usr_mat"]."')")or die(mysql_error());

	//echo "<option selected>RECLAMO TERMINADO";
	//echo "<option>SIN RESOLUCION";
	//echo "<option>PASA A DESPACHO";
	//echo "<option>PASA A ADMINISTRACION";
	//echo "<option>PASA A AUDITORIA 1770";
	//echo "<option>PASA A AUDITORIA 2327";
	//echo "<option>PASA A AUDITORIA 2333";
	//echo "<option>PASA A AUDITORIA 4181";


	switch ($_POST["recl_evol_resol"]) {
		case 'TAREA TERMINADA':
			mysql_query("UPDATE reclamo SET recl_estado='TERMINADO' where recl_id='".$_POST["recl_id"]."'") or die(mysql_error());			
			break;
		case 'SIN RESOLUCION':
			break;

		case 'PASA A DESPACHO':
			mysql_query("UPDATE reclamo SET recl_assign='DESPACHO' where recl_id='".$_POST["recl_id"]."'") or die(mysql_error());						
			break;

		case 'PASA A ADMINISTRACION':
			mysql_query("UPDATE reclamo SET recl_assign='ADMINISTRACION' where recl_id='".$_POST["recl_id"]."'") or die(mysql_error());									
			break;

		case 'PASA A FARMACIA':
			mysql_query("UPDATE reclamo SET recl_assign='FARMACIA' where recl_id='".$_POST["recl_id"]."'") or die(mysql_error());									
			break;

		case 'PASA A AUDITORIA 1770':
			mysql_query("UPDATE reclamo SET recl_assign='AUDITORIA' where recl_id='".$_POST["recl_id"]."'") or die(mysql_error());									
			break;

		case 'PASA A AUDITORIA 2327':
			mysql_query("UPDATE reclamo SET recl_assign='AUDITORIA' where recl_id='".$_POST["recl_id"]."'") or die(mysql_error());						
			break;

		case 'PASA A AUDITORIA 2333':
			mysql_query("UPDATE reclamo SET recl_assign='AUDITORIA' where recl_id='".$_POST["recl_id"]."'") or die(mysql_error());					
			break;

		case 'PASA A AUDITORIA 4181':
			mysql_query("UPDATE reclamo SET recl_assign='AUDITORIA' where recl_id='".$_POST["recl_id"]."'") or die(mysql_error());						
			break;

		case 'PASA A CUIDADOS 3111':
			mysql_query("UPDATE reclamo SET recl_assign='CUIDADOS' where recl_id='".$_POST["recl_id"]."'") or die(mysql_error());						
			break;

		case 'PASA A CUIDADOS 2327':
			mysql_query("UPDATE reclamo SET recl_assign='CUIDADOS' where recl_id='".$_POST["recl_id"]."'") or die(mysql_error());						
			break;

		case 'PASA A CUIDADOS 4181':
			mysql_query("UPDATE reclamo SET recl_assign='CUIDADOS' where recl_id='".$_POST["recl_id"]."'") or die(mysql_error());						
			break;


	}


}
?>