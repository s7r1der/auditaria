<link rel="StyleSheet" href="css/forms.css" type="text/css">

<table class=myTable-gray width=100%>
	<tr valign=center>
		<td align=center>
			<a href="<?php echo $_SERVER["PHP_SELF"]."?event=menu_user"?>" class=link>MENU</a>
		</td>
		
		<td align=center>
			<a href="<?php echo $_SERVER["PHP_SELF"]."?event=hrs_direct&date=".date("Y-m-d");?>" class=link>DIARIO</a>
		</td>			

		<td align=center>
			<a href="<?php echo $_SERVER["PHP_SELF"]."?event=show_nov_cfg";?>" class=link>DETALLE</a>
		</td>

		<td align=center>
			<a href="<?php echo $_SERVER["PHP_SELF"]."?event=show_int_pac";?>" class=link>ENFERMERO</a>
		</td>

		<td align=center>
			<a href="<?php echo $_SERVER["PHP_SELF"]."?event=show_qrt_pac";?>" class=link>ESTADISTICAS</a></td>
		</td>

		<td align=center>
			<a href="<?php echo $_SERVER["PHP_SELF"]."?event=chatbase";?>" class=link>AVANZADA</a>
		</td>

		<td align=center>
			<a href="<?php echo $_SERVER["PHP_SELF"]."?event=chatbase";?>" class=link>MENSAJES</a>
		</td>

		<td align=center>
			<a href="<?php echo $_SERVER["PHP_SELF"]."?event=logout";?>" class=link>EXIT</a></td>
		</td>
	</tr>		
</table>