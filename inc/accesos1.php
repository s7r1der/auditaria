<link rel="StyleSheet" href="css/acceso.css" type="text/css">

	<nav>
		<ul class="menu">
			<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=menu_user"?>" class=link>MENU</a></li>

			<li><a href="#" class=link>PACIENTES</a>
				<ul>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=busq_paciente"?>" class=link>Buscar Paciente</a></li>
				</ul>
			</li>

			<li><a href="#" class=link>CUIDADORES</a>
				<ul>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=list_enf"?>" class=link>Ver todos los Cuidadores</a></li>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=cal_sueldos"?>" class=link>Sueldos</a></li>
				</ul>
			</li>

			<li><a href="#" class=link>DETALLE</a>
				<ul>
					<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=ls_os_cfg"?>" class=link>DETALLE x OBRA SOCIAL</a></li>
					<!--<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=ls_os_cfg_res"?>" class=link>DETALLE x OBRA SOCIAL RESUMIDO</a></li>-->
					<!--<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=mat_os_cfg"?>" class=link>MATERIALES x OBRA SOCIAL</a></li>-->
					<!--<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=det_ls_os_enf"?>" class=link>NOTAS</a></li>-->
					<!--<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=det_cur"?>" class=link>CURACIONES</a></li>-->
					<!--<li><a href="<?php echo $_SERVER["PHP_SELF"]."?event=det_cfg_compl"?>" class=link>AVANZADA</a></li>-->
				</ul>
			</li>
			
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
