<?php

if($table=="leg_ins"){

	$conn=newConnect();
	mysqli_query($conn,"insert into legajo (e_mat,leg_desc,leg_fecha,last_modif)"
				." values("
					."'".$_POST["e_mat"]."',"
					."'".$_POST["leg_desc"]."',"
					."'".date("Y-m-d H:i:s")."',"
					."'".$_SESSION["usr_mat"]."')")or die(mysqli_error($conn));

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
		case 'RECLAMO TERMINADO':
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
	}


}
?>