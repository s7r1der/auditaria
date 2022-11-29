<link rel="StyleSheet" href="css/forms.css" type="text/css">
	
<?php	

	echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

	echo "<table class=menu-gray align=center>";
	echo "<tr><td class=titulo>MODIFICACION</td></tr>";

	$conn=newConnect();
	$qr=mysqli_query($conn,"SELECT * FROM ".$_GET["table"]." op left join paciente pac on pac.pac_id=op.pac_id WHERE op.op_id='".$_GET["op_id"]."'")or die(mysqli_error($conn));

	//$qr=mysql_query("select * from ".$_GET["op_table"]." where op_id=".$_GET["op_id"]);

	while($rw=mysqli_fetch_array($qr,MYSQLI_ASSOC)){

		echo "<input type=hidden name=op_id value="		.$_GET["op_id"].">";
		echo "<input type=hidden name=table value="		.$_GET["table"].">";
		echo "<input type=hidden name=op_reg value="	.$rw["op_reg"].">";

		echo "<input type=hidden name=pac_id value="	.$rw["pac_id"].">";
		echo "<input type=hidden name=zona_desc value=\"".$_GET["zona_desc"]."\">";
		if(isset($_GET["ubic"]))		echo "<input type=hidden name=ubic value=".$_GET["ubic"].">";

		$date=split_date($rw["op_date"]);

		if(isset($_GET["e_mat"])) echo "<input type=hidden name=matr value=".$_GET["e_mat"].">";

			echo "<tr><td align=center><b>".$rw["pac_domicilio"]."</b></td></tr>";
			echo "<tr><td class=subtitulo></td></tr>";

			echo "<tr><td align=right>";

				echo "<table>";
					echo "<tr>";
						echo "<td>".sel_date("sel_day",1,31,$date["day"])."</td>";
						echo "<td>".sel_date("sel_month",1,12,$date["month"])."</td>";
						echo "<td>".sel_date("sel_year",2006,2014,$date["year"])."</td>";
					echo "</tr>";

				echo "</table>";

			echo "</td></tr>";

			echo "<td align=right>";

				echo "<table>";
					echo "<tr>";
						echo "<td>".sel_date("sel_hrs",0,23,"".$date["hr"])."</td>";
						echo "<td>".sel_date("sel_min",0,59,"".$date["min"])."</td></tr>";
					echo "</tr>";
				echo "</table>";
			echo "</td></tr>";

			//echo "<tr><td class=\"data\" valign=center>con horario<input type=checkbox name=withprog ".(($rw["op_prog"]==1)?"checked":"")."></td><tr>";		

			echo "<tr><td class=subtitulo></td></tr>";

			echo "<tr><td valign=top align=right>";
				echo "<select name=prestacion>";

					$res1=mysqli_query($conn,"SELECT prest_nombre FROM prestacion WHERE 1 order by prest_nombre") or die(mysqli_error($conn));
					while($row1=mysqli_fetch_array($res1,MYSQLI_ASSOC))	echo "<option name=opt>".$row1["prest_nombre"];

					echo "<option name=opt selected>".$rw["op_prestacion"];
					echo "</select>";
	
					echo "<br><input type=text name=coseg value=".$rw["op_coseg"].">";
					
					echo "<br><select name=e_mat>";

						$res21=mysqli_query($conn,"SELECT enf_owner,e_mat, CONCAT(enf_apellido,' ',enf_nombre) as enfermero"
										." FROM enfermero WHERE enf_estado='ACTIVO' and enf_role='CUID' order by enf_apellido") or die(mysqli_error());
						
						while($row21=mysqli_fetch_array($res21,MYSQLI_ASSOC))	
							echo "<option name=opt>".$row21["enfermero"]." - ".$row21["e_mat"]." - ".$row21["enf_owner"];

						$res22=mysqli_query($conn,"SELECT enf_owner,e_mat, CONCAT(enf_apellido,' ',enf_nombre) as enfermero"
										." FROM enfermero WHERE e_mat='".$rw["e_mat"]."'") or die(mysqli_error());
						
						while($row22=mysqli_fetch_array($res22,MYSQLI_ASSOC))	
							echo "<option name=opt selected>".$row22["enfermero"]." - ".$row22["e_mat"]." - ".$row22["enf_owner"];

					echo "</select></td></tr>";

			echo "<tr><td class=subtitulo></td></tr>";

			echo "<tr><td valign=top align=right>";
				echo "<b>CANT. HORAS:</b> <select name=cant_horas>";
					for($i=1;$i<13;$i++){
						echo "<option>".$i."</option>";
						echo "<option>".$i.".5</option>";
					}
					echo "<option selected>".$rw["cant_horas"];
				echo "</select>";
			echo "</td></tr>";
			echo "<tr><td valign=top align=right>";
				echo "<b>FORMATO:</b> <select name=op_formato>";
						echo "<option>Corrido</option>";
						echo "<option>Fraccion</option>";
					echo "<option selected>".$rw["op_formato"];
				echo "</select>";
			echo "</td></tr>";

			echo "<tr><td class=subtitulo></td></tr>";

			echo "<tr><td class=head4><input type=\"submit\" class=myButton align=right name=\"event\" value=\"Update Addr\">";
			echo "</td><tr>";
	}

	echo "</table></form></center>";
?>