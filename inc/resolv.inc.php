 <?php

$_SESSION["op_reg"]=type_user($_SESSION["user"]);

if(isset($_GET["event"])){
	if(substr($_GET["event"],0,3)!="nh_"){	
		include("inc/header.php");
		if($_GET["event"]!="viewdetxos")include("inc/proheader.php");			
	}
																					  
	$_SESSION["pos"]=$_GET["event"];
	$_SESSION["op_reg"]="1";	//1 soe 0 coop	

	//GET-->
	switch($_GET["event"]){

	//GRAL. Functions
		case "menu_user":	
			if($_SESSION["user"]!="luis"){	
				include("inc/menu_user-act.php");
			}				
			//if($_SESSION["user"]=='root') 
			
			break;

		case "logout": 	log_write($_SESSION["user"],$_SESSION["user"].":(".date("Y-m-d h:i:s").")","ingreso","DESLOGEO DEL SISTEMA");
						if(session_id()){
							session_unset();
							session_destroy();
						}
						
						include("inc/login_form.php");
						break;

		case "add_auditoria":
			include("inc/schedule/add_auditoria.php");
			break;

		case "upd_auditoria":
			include("inc/schedule/upd_auditoria.php");
			break;

		case "nh_show_auditoria":
			include("inc/schedule/show_auditoria.php");
			break;

		case "tomar_auditoria":
			include("inc/schedule/tomar_auditoria.php");
			break;

		case "programar_auditoria":
			include("inc/schedule/programar_auditoria.php");
			break;

		case "nh_show_fin_auditoria":
			include("inc/schedule/show_fin_auditoria.php");
			break;

		case "nh_chg_session":

					$usr_old=$_SESSION["user"];
					$pswd_old=$_SESSION["usr_pswd"];
					$sys=type_user($_SESSION["user"]);

					if(session_id()){
							session_unset();
							session_destroy();
					}

					if($sys==0){
						$_POST["usr"]=substr($usr_old,0,strlen($usr_old)-4);
						$_POST["passwd"]=$pswd_old;
					}else{
						$_POST["usr"]=$usr_old."coop";
						$_POST["passwd"]=$pswd_old;
					}
					session_start();
					session_set_cookie_params(0);
					login_valid();
					break;


		case "hrs_direct":	$date=explode("-",$_GET["date"]);

							$_SESSION["day_tmp"]=$date[2];
							$_SESSION["month_tmp"]=$date[1];
							$_SESSION["year_tmp"]=$date[0];

							$_SESSION["type_busq"]="horario";
							$_SESSION["pos"]="hrs";

							if(!isset($_GET["opts"])) $_GET["opts"]="pendiente";

							include("inc/schedule/schedule.php"); 
							break;
	
		case "hrs_cfg":			include("inc/schedule/sch_cfg.php");		break;
		case "del_day":			include("inc/schedule/frm_delday.php");		break;
		case "cpy_day":			include("inc/schedule/frm_cpyday.php");		break;
		case "cpy_day_avanz":	include("inc/schedule/cpyday_avanz.php");	break;
		case "review_day":		include("inc/schedule/review_day.php");		break;
		case "sel_prestacion":	include("inc/schedule/sel_prestacion.php");	break;
		case "upd_enf_cfg": 	include("inc/detail/ch_mat.php");   		break;

		case "chck_sch":	include("inc/schedule/check_schedule.php");
							break;

		case "sel_enf":		$_SESSION["opt_busq"]="e_mat";
							$_SESSION["dato_busq"]=$_GET["e_mat"];
							include("inc/enf/ver_enf.php");             break;

		case "menu_enf":
			include("inc/enf/legajo/menu_legajo.php");
			break;

		case "det_lst_sh_hc":
			
			$_SESSION["opt_busq"]="pac_id";
			$_SESSION["fec1"]=$_GET["fec_beg"]." 00:00:00";
			$_SESSION["fec2"]=$_GET["fec_fin"]." 23:59:59";
			$_SESSION["sel_var"]=0;
			$_SESSION["dato_busq"]=$_GET["pac_id"];

			include("inc/patient/ch_patient.php");
			break;

		case "list_enf":	$_SESSION["pos"]="enf";
							include("inc/enf/lista_enfermeros.php");	break;


		case "sel_enfermero":
		case "sel_paciente":	
				
			$_SESSION["opt_busq"]="pac_id";
			$_SESSION["dato_busq"]=$_GET["pac_id"];
			
			switch($_GET["ubic"]){
				case "chck_sch":		include("inc/schedule/check_schedule.php");
										break;

				case "add_sch":			include("inc/schedule/sel_prestacion.php");
										break;

				case "menu_prev_pat":	include("inc/patient/menu_prev.php");
										break;

				case "horario":			include("inc/schedule/add_schedule.php");
										break;

				case "det":				include("inc/patient/chd_patient.php");
										break;

				case "addr_cfg":		include("inc/detail/det_addr_cfg.php");
										break;
				
				case "det_lst_sh_hc":   include("inc/patient/ch_patient.php");
										break;	
			}

			break;

		case "schedule":  	$_SESSION["type_busq"]="horario";                   
					  		include("inc/schedule/schedule.php");           break;

		case "ls_os_cfg":
							$_SESSION["pos"]="det";
							$_SESSION["estad_opt"]="ls_os";
							include("inc/detail/det_cfg.php");
							break;
							
		case "lista_os_cfg":
							$_SESSION["pos"]="det";
							$_SESSION["estad_opt"]="lista_os";
							include("inc/detail/det_cfg.php");
							break;
	
		case "ls_os_cfg_res":
							$_SESSION["pos"]="det";
							$_SESSION["estad_opt"]="ls_os_res";
							include("inc/detail/det_cfg.php");
							break;

		case "contrato_cfg":	include("inc/enf/contrato_cfg.php");		break;

		case "nh_show_contrato":$_SESSION["pos"]="det";
								include("inc/enf/contrato.php");
								break;

		case "upd_opsit":
			$table="upd_opsit";
			include("inc/schedule/sql.php");

			$date=explode("-",$_GET["date"]);

			$_SESSION["day_tmp"]=$date[2];
			$_SESSION["month_tmp"]=$date[1];
			$_SESSION["year_tmp"]=$date[0];

			$_SESSION["type_busq"]="horario";
			$_SESSION["pos"]="hrs";

			if(!isset($_GET["opts"])) $_GET["opts"]="pendiente";

			include("inc/schedule/schedule.php"); 
			break;
		
		case "sel_pac_chg_state":
			
			$_SESSION["opt_busq"]="pac_id";
			$_SESSION["dato_busq"]=$_GET["pac_id"];
			
			include("inc/patient/chg_st_cfg.php");
			break;


		case "add_legajo":

			include("inc/enf/legajo/add_legajo.php");
			break;

		case "show_legajo":

			include("inc/enf/legajo/show_legajo.php");
			break;


		case "sel_pac_chg_os":
			
			$_SESSION["opt_busq"]="pac_id";
			$_SESSION["dato_busq"]=$_GET["pac_id"];
			
			include("inc/patient/chg_os_cfg.php");
			break;

		case "sel_pac_chg_dom":
			
			include("inc/patient/frm_chg_dom.php");
			break;

		case "cal_sueldos":	
			include("inc/enf/cal_sueldos_cfg.php");	
			break;

		case "viewdetxos":
			$_SESSION["type_busq"]	="det_eaddr";
			$_SESSION["opt_busq"]	="pac_id";
			$_SESSION["dato_busq"]	=$_GET["pac_id"];
			$_SESSION["sel_var"]		=1;
						
			$_SESSION["fec1"]		=$_GET["fec_beg"];
			$_SESSION["fec2"]		=$_GET["fec_fin"];
			//$_SESSION["pac_os"]	=$_GET["pac_os"];

			$_SESSION["shneg"]="1";
			$_SESSION["posneg"]="0";
			$_SESSION["m_col"]="0";
			$_SESSION["sh_mat"]="1";
			include("inc/patient/chd_patient.php");
			break;

		case "viewdomxos":
			$_SESSION["opt_busq"]="pac_id";
			$_SESSION["dato_busq"]=$_GET["pac_id"];
			$_SESSION["sel_var"]=1;
						
			$_SESSION["fec1"]=$_GET["fec_beg"];
			$_SESSION["fec2"]=$_GET["fec_fin"];

			$_SESSION["shneg"]="1";
			$_SESSION["posneg"]="0";
			$_SESSION["m_col"]="0";
			$_SESSION["sh_mat"]="1";
			include("inc/detail/det_addr_cfg1.php");
			break;

		case "det_enf_lst":

			$date=explode("-",$_GET["date"]);
			
			//	echo $date[0];

			$_SESSION["year_tmp"]=$date[0];
			$_SESSION["month_tmp"]=$date[1];
			$_SESSION["day_tmp"]=$date[2];
			$_SESSION["pos"]="det_enf_lst";

			$_SESSION["fec1"]=$_GET["date"]." 00:00:00";
			$_SESSION["fec2"]=$_GET["date"]." 23:59:00";
			$_POST["e_mat"]=$_GET["e_mat"];

			$_SESSION["type_busq"]="enf_det";
			$_POST["order"]="coseg";
	
			$_POST["e_mat"]=$_GET["e_mat"];
				
			include("inc/enf/list_day_enf.php");
			break;

		case "nh_not_corresp":
			
			$prest=urldecode($_GET["op_prestacion"]);

			if($prest=='NO CORRESPONDE')
				$prest='CUIDADOS';
			else
				$prest='NO CORRESPONDE';
			
			$conn=newConnect();
			$query="update ".$_GET["table"]." set op_prestacion='".$prest."' where op_id='".$_GET["op_id"]."'";
			mysqli_query($conn,$query) or die(mysqli_error($conn));
			log_write($_SESSION["usr_mat"],"CAMBIO NOT CORRESP","update",$query);
			//echo $query;
			header("Location:".$_SERVER["PHP_SELF"]."?event=viewdetxos"
																."&pac_id=".$_GET["pac_id"]
																."&fec_beg=".$_SESSION["fec1"]
																."&fec_fin=".$_SESSION["fec2"]
																."&pac_os=".$_GET["pac_os"]);
			include("inc/patient/chd_patient.php");
			break;

		case "det_ls_os_enf":	$_SESSION["estad_opt"]="os_enf";
								include("inc/detail/det_cfg.php");    
								break;

		case "buscar_dato":	//$_SESSION["type_busq"]="horario";                       
									$_SESSION["ins_hora"]=  $_GET["fec_hora"];
									include("inc/buscar_datos.php");                break;
		
		case "list_all_enf":

							if(isset($_GET["day"])){
								$_SESSION["day_tmp"]=	$_GET["day"];
								$_SESSION["month_tmp"]=	$_GET["month"];
								$_SESSION["year_tmp"]=	$_GET["year"];
							}elseif(isset($_GET["date"])){
								$date=explode("-",$_GET["date"]);
								$_SESSION["day_tmp"]=	$date[2];
								$_SESSION["month_tmp"]=	$date[1];
								$_SESSION["year_tmp"]=	$date[0];
							}						

							$_SESSION["fec1"]=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"];
							$_SESSION["fec2"]=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"];


							include("inc/enf/list_day_enf.php");
							break;

		case "ing_datos":
					$_SESSION["type_busq"]="insertar";
						
						$row["pac_nombre"]=$row["pac_apellido"]=$row["pac_dni"]="";
						$row["pac_os"]=$row["pac_osalt"]=$row["pac_domicilio"]=$row["pac_dpto"]="";
						$row["pac_afil"]=$row["pac_estado"]=$row["pac_fecnac"]="";
						$row["date_ingr"]="";
						$row["ubc_lat"]=$row["ubc_lon"]="";
						$row["med_id"]="";	
						$row["pac_telefono"]="";
						
						//tab_gral_st("60%","3","#66CC33","blue","iconos/background/image11_green.jpg");
						include("inc/patient/add_datos_personales.php");
						//tab_gral_end();
						break;

		case "ing_enf":		
							$_SESSION["pos"]="enf";
							$_SESSION["type_busq"]="enfermero";
							
							$row["enf_os"]=$row["enf_domicilio"]=$row["enf_dpto"]=$row["enf_cp"]="";
							$row["enf_fecnac"]=$row["e_mat"]=$row["enf_dni"]=$row["enf_cuil"]="";
							$row["enf_nombre"]=$row["enf_apellido"]=$row["enf_sexo"]=$row["enf_owner"]="";
							$row["enf_telefono"]=$row["enf_estado"]=$row["enf_role"]="";
							$row["enf_contador"]=$row["enf_movil"]=$row["enf_contrato"]="";


							$row["usr_role"]=$row["usr_name"]=$row["usr_pswd"]="";
							$row["usr_level"]=$row["turno_desc"]=$row["enf_turno"]="";
							$row["enf_fact"]=$row["enf_auditor"]=$row["enf_auditor2"]="";
							$row["vto_year"]=date("Y");
							$row["vto_month"]=date("M");
							$row["zona1"]=$row["zona2"]=$row["zona3"]=$row["zona4"]="-";
							$date[0]=date("Y");
							$date[1]=date("m");
							
							include("inc/enf/add_enf.php");
							break;
		case "del_sch_cfg": 
							include("inc/schedule/del_sch_cfg.php");
							break;

		case "planif_sch":	include("inc/schedule/planif_schedule.php");    
							break;

		case "del_sch":		$_POST["op_id"]=$_GET["op_id"];
							$_POST["table"]=$_GET["table"];

							$table="op_del";
							include("inc/schedule/sql.php");

							$table=$_GET["table"];	
							$_POST["e_mat"]=$_GET["e_mat"];
							$_SESSION["ins_hpra"]=6;

							if(isset($_GET["ubic"]) && $_GET	["ubic"]=="det_enf_lst"){
								$_POST["order"]="coseg";
								$_SESSION["pos"]="det_enf_lst";
								include("inc/enf/list_day_enf.php");
							}elseif(isset($_GET["ubic"]) && $_GET["ubic"]=="rts"){
								$_SESSION["pos"]="show_rts";
								include("inc/enf/list_day_enf.php");
							}else	win_return($_SESSION["pos"]);
							
							break;

		case "nh_cal_sueldos_detallado_enf":	include("inc/enf/sueldos_detallado_enf.php");	break;


	}if(substr($_GET["event"],0,3)!="nh_")include("inc/footer.php");



//POST-->
}elseif(isset($_POST["event"])){
	
	if($_POST["event"]<>"VerDHC" && $_POST["event"]<>"Materiales_OS" && $_POST["event"]<>"Resumen Domicilio")include("inc/header.php");

	switch($_POST["event"]){
	
		case "Cancelar":    
			win_return($_SESSION["pos"]);
			break;

		case "Consultar":
			$_SESSION["day_tmp"]=$_POST["fec_day"];
			$_SESSION["month_tmp"]=$_POST["fec_month"];
			$_SESSION["year_tmp"]=$_POST["fec_year"];
			$_GET["order1"]="op_date";
			$_GET["order11"]="ASC";
			$_GET["order2"]="op_date";
			$_GET["order21"]="ASC";
			

			$_SESSION["type_busq"]="horario";
			$_SESSION["pos"]="hrs";

			include("inc/schedule/schedule.php"); 
			break;
		
		case "Buscar": 
			
			switch($_POST["busqueda"]){
				case "Apellido":			$_SESSION["opt_busq"]=(($_SESSION["pos"]=="enf")?"enf":"pac")."_apellido";		break;
				case "Matricula":			$_SESSION["opt_busq"]="e_mat";													break;  
				case "Nombre":				$_SESSION["opt_busq"]=(($_SESSION["pos"]=="enf")?"enf":"pac")."_nombre";		break;
				case "Telefono":			$_SESSION["opt_busq"]=(($_SESSION["pos"]=="enf")?"enf":"pac")."_telefono";		break;
				case "Obra Social":			$_SESSION["opt_busq"]=(($_SESSION["pos"]=="enf")?"enf":"pac")."_os";			break;
				case "Domicilio":			$_SESSION["opt_busq"]=(($_SESSION["pos"]=="enf")?"enf":"pac")."_domicilio";		break;
				case "Departamento":		$_SESSION["opt_busq"]=(($_SESSION["pos"]=="enf")?"enf":"pac")."_dpto";			break;
				default:					$_SESSION["opt_busq"]=(($_SESSION["pos"]=="enf")?"enf":"pac")."_telefono";		break;
			}

			$_SESSION["sel_var"]=0;
			$_SESSION["dato_busq"]=$_POST["dato"];
			if(isset($_POST["prestacion"])) $_SESSION["prestacion"]=$_POST["prestacion"];

			switch($_POST["ubic"]){
				case "schedule":		header("Location:".$_SERVER["PHP_SELF"]."?event=chck_sch");			break;
				case "paciente":		header("Location:".$_SERVER["PHP_SELF"]."?event=menu_prev_pat");	break;
				case "change_state":	header("Location:".$_SERVER["PHP_SELF"]."?event=chg_st_cfg");		break;
				case "change_dom":		header("Location:".$_SERVER["PHP_SELF"]."?event=chg_dom_cfg");		break;
			}
			if($_SESSION["type_busq"]=="hc")			header("Location:".$_SERVER["PHP_SELF"]."?event=show_ch");
			if($_SESSION["type_busq"]=="enfermero")		header("Location:".$_SERVER["PHP_SELF"]."?event=ver_enf");

		  	break;

		case "Aceptar":

			if($_POST["ubic"]=="delday"){
				$table="delday";
				include("inc/schedule/sql.php");
				win_return($_SESSION["pos"]);
			}
			break;

		case "Busqueda_Rapida": include("inc/busq_avanz.php");
								break;

		case "Sueldos": 	include("inc/enf/sueldos.php");
							break;

		case "Seleccionar Prestaciones":
			include("inc/schedule/add_schedule.php");
			break;

		case "Asignar": $_POST["ubic"]="schedule";
				include("inc/schedule/pre_assign_qt.php");
				//echo $_POST["e_mat"];
				break;

		case "Copiar Dia":
			$table_src="op".substr($_POST["op_date"],0,4)."cuidados";
			$table_dest="op".$_POST["fec_year"]."cuidados";
			$date=$_POST["fec_year"]."-".$_POST["fec_month"]."-".$_POST["fec_day"];
			$_SESSION["ins_hora"]=6;
				
			include("inc/schedule/cpyday.php");

			break;

		case "Copiar":
			$table_src="op".substr($_POST["op_date"],0,4)."cuidados";
			$table_dest="op".$_POST["fec_year"]."cuidados";
			$date=$_POST["fec_year"]."-".$_POST["fec_month"]."-".$_POST["fec_day"];
			$_SESSION["ins_hora"]=6;
				
			$table="cpyday";
			include("inc/schedule/sql.php");

			include("inc/schedule/finish_cpyday.php");
			break;


		case "Agregar Prestacion":
							
			$table="op_ins";
			include("inc/schedule/sql.php");
			header("Location:".$_SERVER["PHP_SELF"]."?event=list_all_enf"
																			."&day=".$_SESSION["day_tmp"]
																			."&month=".$_SESSION["month_tmp"]
																			."&year=".$_SESSION["year_tmp"]
																			."&zona_desc=".$_POST["zona_desc"]);
			break;

		case "Update Addr":
			$_POST["op_date"]=$_POST["sel_year"]."-".$_POST["sel_month"]."-".$_POST["sel_day"]." ".$_POST["sel_hrs"].":".$_POST["sel_min"].":00";

			$data=explode(" - ",$_POST["e_mat"]);
			$_GET["e_mat"]=$_POST["e_mat"]=$data[1];
			$_POST["enf_owner"]=$data[2];
			$_GET["zona_desc"]=$_POST["zona_desc"];

			//echo $_POST["e_mat"];

			$table="upd_addr";
			include("inc/schedule/sql.php");

			$_GET["ubic"]=$_POST["ubic"];
			$_GET["pac_id"]=$_POST["pac_id"];


			//echo $_POST["ubic"];
			
			if(isset($_POST["ubic"]) && $_POST["ubic"]=="rts"){
				$_SESSION["pos"]="show_rts";
				include("inc/enf/list_day_enf.php");
			
			}elseif(isset($_POST["ubic"]) && $_POST["ubic"]=="viewdetxos"){

				header("Location:".$_SERVER["PHP_SELF"]."?event=viewdetxos"
															."&pac_id=".$_GET["pac_id"]
															."&fec_beg=".$_SESSION["fec1"]
															."&fec_fin=".$_SESSION["fec2"]
															."&pac_os=".$_GET["pac_os"]);

			}elseif(isset($_POST["ubic"]) && $_POST["ubic"]=="add_pro")			header("Location:".$_SERVER["PHP_SELF"]."?event=load_pro_cfg");

			elseif(isset($_POST["ubic"]) && $_POST["ubic"]=="det_enf_lst")	{
				$_POST["order"]="coseg";
				$_SESSION["pos"]="det_enf_lst";
				include("inc/enf/list_day_enf.php");
			}
			else	win_return($_SESSION["pos"]);
			break;

		case "Borrar Prestacion":	
			$table="op_del_planif";
			include("inc/schedule/sql.php");
			
			$emat=$_POST["e_mat"];
			$date=$_POST["date1"];
			$_SESSION["ins_hpra"]=6;

			$_GET["zona_desc"]=$_POST["zona_desc"];
			$_GET["ubic"]=$_POST["ubic"];
			$_GET["e_mat"]=$_POST["e_mat"];

			header("Location:".$_SERVER["PHP_SELF"]."?event=det_enf_lst"
												 ."&e_mat=".$_POST["e_mat"]
												 ."&date=".$date
												 ."&zona_desc=".$_POST["zona_desc"]
												 ."&ubic=det_enf_lst");
			break;

		case "Mover":
			
			$table="qts_moves";
			include("inc/schedule/sql.php");

			win_return($_SESSION["pos"]);
			break;	

		case "Copia Avanzada":
		
			$table="copia_avanz";
			include("inc/schedule/sql.php");
			win_return($_SESSION["pos"]);
			break;

		case "Planificar":
			include("inc/schedule/planification.php");
			win_return($_SESSION["pos"]);
			break;

		case "Insertar":	
			$table="ins";
			include("inc/patient/sql.php");
			header("Location:".$_SERVER["PHP_SELF"]."?event=menu_user");
			break;

		case "Lista_OS_Enc":
			$fec1=$_POST["fec_year1"]."-".$_POST["fec_month1"]."-".$_POST["fec_day1"]." 00:00:00";
			$fec2=$_POST["fec_year2"]."-".$_POST["fec_month2"]."-".$_POST["fec_day2"]." 23:59:00";

			include("inc/detail/encabezado.php");
			include("inc/detail/det_ls_os.php");
			break;			

		case "Lista_OS":
			$fec1=$_POST["fec_year1"]."-".$_POST["fec_month1"]."-".$_POST["fec_day1"]." 00:00:00";
			$fec2=$_POST["fec_year2"]."-".$_POST["fec_month2"]."-".$_POST["fec_day2"]." 23:59:00";

			include("inc/detail/det_ls_os.php");
			break;

		case "RESUMEN_OS":
			$fec1=$_POST["fec_year1"]."-".$_POST["fec_month1"]."-".$_POST["fec_day1"]." 00:00:00";
			$fec2=$_POST["fec_year2"]."-".$_POST["fec_month2"]."-".$_POST["fec_day2"]." 23:59:00";

			include("inc/detail/det_ls_os_res.php");
			break;

		case "OS_Enf":
			$fec1=$_POST["fec_year1"]."-".$_POST["fec_month1"]."-".$_POST["fec_day1"]." 00:00:00";
			$fec2=$_POST["fec_year2"]."-".$_POST["fec_month2"]."-".$_POST["fec_day2"]." 23:50:00";
				
			include("inc/detail/det_ls_os_enf.php");
			break;

		case "Cambiar Estado":
			$table="upd_state";
			include("inc/patient/sql.php");
			
			$parc_date=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"];

			header("Location:".$_SERVER["PHP_SELF"]."?event=det_lst_sh_hc&pac_id=".$_POST["pac_id"]."&fec_beg=".$parc_date."-01&fec_fin=".$parc_date."-31&zona_desc=".$_POST["zona_desc"]	);
			break;

		case "Cambiar OS":
			$table="upd_os";
			include("inc/patient/sql.php");
			
			header("Location:".$_SERVER["PHP_SELF"]."?event=det_lst_sh_hc&pac_id=".$_POST["pac_id"]."&fec_beg=".$parc_date."-01&fec_fin=".$parc_date."-31&zona_desc=".$_POST["zona_desc"]	);
			break;

		case "Cambiar Domicilio":
			$table="upd_dom";
			include("inc/patient/sql.php");
			
			header("Location:".$_SERVER["PHP_SELF"]."?event=det_lst_sh_hc&pac_id=".$_POST["pac_id"]."&fec_beg=".$parc_date."-01&fec_fin=".$parc_date."-31&zona_desc=".$_POST["zona_desc"]	);
			break;
		
		case "Ingresar":	
					$conn=newConnect();
					$qr_tmp=mysqli_query($conn,"SELECT usr_mat FROM usuario where usr_mat='".$_POST["e_mat"]."'") or die(mysqli_error($conn));	
					
					if(mysqli_num_rows($qr_tmp)==0){
						$table="ins";
						include("inc/enf/sql.php");
						win_return($_SESSION["pos"]);
					}else{
						echo "IMPOSIBLE CARGAR ENFERMERO MATRICULA REPETIDA.";
					}
					
					break;
		
		case "Guardar Datos":   
			$table="upd";
			 include("inc/enf/sql.php");
			
			 header("Location:".$_SERVER["PHP_SELF"]."?event=list_enf");
			 break;

		case "Agregar AUDITORIA":

			$table="add_auditoria";
			include("inc/schedule/sql.php");

			header("Location:".$_SERVER["PHP_SELF"]."?event=menu_user");
			break;

		case "Guardar AUDITORIA":   
			$table="upd_auditoria";
			include("inc/schedule/sql.php");
			
			header("Location:".$_SERVER["PHP_SELF"]."?event=menu_user");
			 break;

		case "Cargar PLANIFICACION":   
			$table="add_planif";
			include("inc/schedule/sql.php");
			
			header("Location:".$_SERVER["PHP_SELF"]."?event=menu_user");
			 break;

		case "PROGRAMAR DOMICILIO":   
			$table="prog_auditoria";
			include("inc/schedule/sql.php");
			
			header("Location:".$_SERVER["PHP_SELF"]."?event=menu_user");
			 break;

		case "Imprimir Contrato":
			header("Location:".$_SERVER["PHP_SELF"]."?event=nh_show_contrato&e_mat=".$_POST["e_mat"]);		
			break;

		case "Agregar al Legajo":
			$table="leg_ins";
			include("inc/enf/legajo/sql.php");
			header("Location:".$_SERVER["PHP_SELF"]."?event=menu_user");
			break;


	}	
	if(substr($_POST["event"],0,3)!="nh_")include("inc/footer.php");
}
?>