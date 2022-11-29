<?php
	style();

	echo "<CENTER>".font_color("ENFERMEROS","Neuropol","white",5)."</CENTER>";

//	tab_gral_st();

	echo "<table align=center class=menu>";
		
		echo "<tr><td class=head2 align=left valign=bottom><img src=\"iconos/icons/arrow_menu.ico\" border=0>"
										."<a href=".$_SERVER["PHP_SELF"]."?event=ing_enf><b>Ingresar Enfermero</b></a></td></tr>";
		
		echo "<tr><td class=data1 align=left valign=bottom><img src=\"iconos/icons/arrow_menu.ico\" border=0>"
										."<a href=".$_SERVER["PHP_SELF"]."?event=busq_enf><b>Buscar Enfermero</b></a></td></tr>";

		echo "<tr><td class=data1 align=left valign=bottom><img src=\"iconos/icons/arrow_menu.ico\" border=0>"
									."<a href=".$_SERVER["PHP_SELF"]."?event=list_enf><b>Ver lista de Enfermeros</b></a></td></tr>";

		//echo "<tr><td class=data1 align=left valign=bottom><img src=\"iconos/icons/arrow_menu.ico\" border=0>"
			//			."<a href=".$_SERVER["PHP_SELF"]."?event=hrs_cfg><b>Detalle x dia enfermero</b></a></td></tr>";
		
	echo "</table>";

	//tab_gral_end();

?>