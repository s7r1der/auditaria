<link rel="StyleSheet" href="css/acceso.css" type="text/css">

	<nav>
		<ul class="menu">
			<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=menu_user"?>" class=link>MENU</a></li>
			<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=hrs_direct&date=".date("Y-m-d")
					."&order1=op_date&order11=ASC"
					."&order2=op_date&order21=ASC";?>" class=link>DIARIO</a>
				<ul>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=hrs_cfg"?>" class=link>Diario</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=show_nov_cfg"?>" class=link>Novedades</a></li>
					<?php 
						//echo "<li><a href=".$_SERVER["PHP_SELF"]."?event=nh_show_ubic class=link>Ver Ubicaciones</a></li>";
						//echo "<li><a href=".$_SERVER["PHP_SELF"]."?event=unique_id class=link>Unificar</a></li>";

					if($_SESSION["usr_level"]>4){
						echo "<li><a href=".$_SERVER["PHP_SELF"]."?event=load_opdel class=link>Ver Borrados</a></li>";
						echo "<li><a href=".$_SERVER["PHP_SELF"]."?event=load_opnc class=link>Ver NO CORRESPONDE</a></li>";
					}
					?>
				</ul>
			</li>

			<li><a href="#" class=link>PACIENTES</a>
				<ul>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=ing_datos"?>" class=link>Agregar Paciente</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=busq_paciente"?>" class=link>Buscar Paciente</a></li>
				</ul>
			</li>

			<li><a href="#" class=link>CUIDADORES</a>
				<ul>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=ing_enf"?>" class=link>Agregar Cuidador</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=busq_enf&ubic=enf"?>" class=link>Buscar Cuidador</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=list_enf"?>" class=link>Ver todos los Cuidadores</a></li>
					
					<?php 
					if($_SESSION["usr_level"]>2){
						echo "<li><a href=".$_SERVER["PHP_SELF"]."?event=vis_enf_cfg class=link>Ver Detalle x Cuidador</a></li>";
						//echo "<li><a href=".$_SERVER["PHP_SELF"]."?event=res_enf_cfg class=link>Resumen Enf x dia</a></li>";
						//echo "<li><a href=".$_SERVER["PHP_SELF"]."?event=res_enf_betw class=link>Resumen Enf entre fechas</a></li>";
						//echo "<li><a href=".$_SERVER["PHP_SELF"]."?event=contrato_cfg class=link>Contrato</a></li>";
						echo "<li><a href=".$_SERVER["PHP_SELF"]."?event=contrato_cfg class=link>Contrato</a></li>";
					}
					if($_SESSION["usr_level"]>4){
						echo "<li><a href=".$_SERVER["PHP_SELF"]."?event=cal_sueldos class=link>Sueldos</a></li>";
						echo "<li><a href=".$_SERVER["PHP_SELF"]."?event=cal_sueldos_detallado class=link>Sueldos detallado</a></li>";
					}
					?>
				</ul>
			</li>

			<li><a href="#" class=link>DETALLE</a>
				<ul>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=ls_os_cfg"?>" class=link>DETALLE x OBRA SOCIAL</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=ls_os_cfg_res"?>" class=link>DETALLE x OBRA SOCIAL RESUMIDO</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=lista_os_cfg"?>" class=link>DETALLE x OBRA SOCIAL c/ENC.</a></li>
					<!--<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=mat_os_cfg"?>" class=link>MATERIALES x OBRA SOCIAL</a></li>-->
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=det_ls_os_enf"?>" class=link>NOTAS</a></li>
					<!--<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=det_cur"?>" class=link>CURACIONES</a></li>-->
					<!--<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=det_cfg_compl"?>" class=link>AVANZADA</a></li>-->
				</ul>
			</li>
			
			<?php if($_SESSION["usr_level"]>=3){ ?>
			<!--
			<li><a href="#" class=link>ESTADISTICAS</a>
				<ul>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=dpto_std_cfg"?>" class=link>Estadisticas x Departamento</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=enf_std_cfg"?>" class=link>Estadisticas x Enfermero</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=os_std_cfg"?>" class=link>Estadisticas x Obra Social</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=prest_std_cfg"?>" class=link>Estadisticas x Prestacion</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=std_cfg_compl"?>" class=link>Estadisticas Avanzada</a></li>
				</ul>
			</li>

			<li><a href="#" class=link>INGRESOS/EGRESOS</a>
				<ul>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=menu_user"?>" class=link>GASTOS - Agregar Operacion</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=menu_user"?>" class=link>GASTOS - Ver x usuario</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=menu_user"?>" class=link>GASTOS - Ver x tipo de gasto</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=menu_user"?>" class=link>Ver total</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=menu_user"?>" class=link>Avanzada</a></li>
				</ul>
			</li>

			<li><a href="#" class=link>FACTURACION</a>
				<ul>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=ing_opago"?>" class=link>ORDEN DE PAGO - GENERAR</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=det_opago_cfg"?>" class=link>ORDEN DE PAGO - DETALLE</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=menu_user"?>" class=link><HR></a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=ing_factura"?>" class=link>FACTURA - GENERAR</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=det_factura_cfg"?>" class=link>FACTURA - DETALLE</a></li>
				</ul>
			</li>


			<li><a href="#" class=link>MATERIALES</a>
				<ul>
						<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=menu_user"?>" class=link>Ver Pedidos</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=menu_user"?>" class=link>Avanzada</a></li>
				</ul>
			</li>-->	
			<?php }?>
			
			<li><a href="#" class=link>OPCIONES</a>
				<ul>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=menu_user"?>" class=link>Ver mis datos</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=nh_chg_session"?>" class=link>Cambiar Sesion</a></li>
					<!--<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=add_os"?>" class=link>Agregar OBRA SOCIAL</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=updpass"?>" class=link>Cambiar CONTRASEÑA</a></li>-->
				</ul>
			</li>

			<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=logout"?>" class=link>SALIR</a></li>

		</ul>
		<div class="clearfix"></div>
	</nav>
