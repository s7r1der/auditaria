<link rel="StyleSheet" href="css/forms.css" type="text/css">

	<table class=myTable-gray align=center>
		<tr><td colspan=6 class=titulo>DATOS ACCESO:</td></tr>
		<tr>	<td class=datal><b>Usuario:</b></td>
				<td class=datal><input type=text name=usr_name value="<?php echo $row["usr_name"];?>"></td></tr>
		<tr>	<td class=datal><B>Contraseña:</B></td>
				<td class=datal><input type=text name=usr_pswd value="<?php echo $row["usr_pswd"];?>"></td></tr>
	<?php
		echo "<td class=datal><B>Rol:</B></td><td class=datal><select name=usr_role>";
				echo "<option name=opt>CUID";
				if($row["usr_role"]!="")	 echo "<option selected>".$row["usr_role"];
				else	 echo "<option selected>cuid";

				echo "</select></td></tr>";

		echo "<td class=datal><B>Jerarquia:</B></td><td class=datal><select name=usr_level>";
					echo "<option name=opt>0";
					echo "<option name=opt>1";
					echo "<option name=opt>2";
					echo "<option name=opt>3";
					echo "<option name=opt>4";
					echo "<option name=opt>5";

					if($row["usr_level"]!="")	 echo "<option selected>".$row["usr_level"];
					else	 echo "<option selected>0";

				echo "</select></td></tr>";
	echo "</table>";