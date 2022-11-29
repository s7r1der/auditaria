<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

	echo "<input type=hidden name=ubic value=\"delday\">";
	echo "<input type=hidden name=table value=op".$_GET["year"]."cuidados>";
	echo "<input type=hidden name=op_date value=".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"].">";


	echo "<table class=menu-gray align=center>";

	echo "<tr><td class=titulo><font color=white><b>COPIA AVANZADA</font></td></tr>";
	echo "<TR><td colspan=2 align=center class=titulo>"
							."<font size=5><b>".$_GET["day"]."/".$_GET["month"]."/".$_GET["year"]."</b></font>"
						."</td>";
	echo "</TR>";

	echo "<TR>";
		echo "<TD align=right>	<B>Pasar los domicilios del enfermero: </B>";

			$conn=newConnect();						
			$qry1=mysqli_query($conn,"SELECT e_mat,CONCAT(enf_apellido,' ',enf_nombre) as enfermero FROM enfermero WHERE enf_estado='ACTIVO' order by enf_apellido");
			echo "<select name=e_mat1>";
			while($row1=mysqli_fetch_array($qry1,MYSQLI_ASSOC))
				echo "<option>".$row1["e_mat"]." - ".$row1["enfermero"];
			echo "<option selected>4444 - PENDIENTES";

		echo "</td></tr>";

	echo "<TR>";
		echo "<TD align=right>	<B>desde: </B>";
			sel_date("hr1",0,23,"00");		
			sel_date("min1",0,59,"00");
		echo "</td></tr>";

	echo "<TR>";
		echo "<TD align=right>	<B>hasta: </B>";
			sel_date("hr2",0,23,23);	
			sel_date("min2",0,59,"59");	
		echo "</td></tr>";
	
	echo "<tr>";
		echo "<TD align=right>	<B>Al dia: </B>";
			sel_date("day",1,31,date("d"));
			sel_date("month",1,12,date("m"));
			sel_date("year",2015,2020,date("Y"));
		echo "</td>";
	echo "</tr>";
	

	echo "<TR>";
		echo "<TD align=right>	<B>Al enfermero: </B>";

						$qry2=mysqli_query($conn,"SELECT e_mat,CONCAT(enf_apellido,' ',enf_nombre) as enfermero FROM enfermero WHERE enf_estado='ACTIVO' order by enf_apellido");
						echo "<select name=e_mat2>";
						while($row2=mysqli_fetch_array($qry2,MYSQLI_ASSOC))
							echo "<option>".$row2["e_mat"]." - ".$row2["enfermero"];
						echo "<option selected>2999 - Ricardo";
	
		echo "</td></tr>";

	echo "<TR>";
		echo "<TD align=right>	<B>Copiar : </B>";

						echo "<select name=copiar>";
							echo "<option>SIN EVOLUCION";
							echo "<option>EVOLUCIONADOS";
							echo "<option selected>Todos";
						echo "</select>";
		echo "</td></tr>";

	echo "<TR><TD align=right>"	."<input type=submit name=event class=myButton value=\"Mover\">"
								."<input type=submit name=event class=myButton value=\"Copia Avanzada\">"
								."<input type=submit name=event class=myButton value=Cancelar></TD>";
	echo "</TR>";
	

echo "</TABLE>";

echo "</FORM>";

?>	
