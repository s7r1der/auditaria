<link rel="StyleSheet" href="css/forms.css" type="text/css">


<?php	

$class=0;
$conn=newConnect();

$conn1=newConnect();


$rs=mysqli_query($conn1,"SELECT pac_id,CONCAT(pac_nombre,' ',pac_apellido) as nombre,pac_apellido,pac_domicilio,pac_dpto,pac_telefono,pac_dni"
					." from paciente where pac_id='".$_GET["pac_id"]."'")
					 	 or die(mysqli_error($conn1));


while($row1=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
	echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

		echo "<input type=hidden name=pac_id value=".$row1["pac_id"].">";
		echo "<input type=hidden name=dom_ant value='".$row1["pac_domicilio"]."'>";
		echo "<input type=hidden name=dpto_ant value='".$row1["pac_dpto"]."'>";
		
		echo "<table class=myTable-gray align=center>";

			echo "<tr><td class=titulo>CAMBIAR DOMICILIO DEL PACIENTE</td></tr>";
			echo "<tr><td align=center><b>".$row1["pac_domicilio"]." ".$row1["pac_dpto"]."</b></td></tr>";
			echo "<tr><td align=center>(".$row1["nombre"].")<hr></td></tr>";


	//		echo "<tr><td align=center><hr></td></tr>";

			echo "<tr><td align=center class=subtitulo><b>NUEVO DOMICILIO</b></td></tr>";
			echo "<tr><td align=center class=data><b>"; 
				
				echo "<input type=text name=new_domicilio size=35 value='".$row1["pac_domicilio"]."'>";
				$conn2=newConnect();
				$res2=mysqli_query($conn2,"SELECT * FROM departamento WHERE 1 ORDER BY dpto_nombre") or die(mysqli_error($conn2));

				echo "<select name=new_dpto>";
				while($rw2=mysqli_fetch_array($res2,MYSQL_ASSOC))
					echo "<option>".$rw2["dpto_nombre"];
				echo "<option selected>".$row1["pac_dpto"];
				echo "</select>";
			
			echo "</td></tr>";
			
			echo "<tr><td align=center class=subtitulo><b>NUEVOS TELEFONOS</b></td></tr>";
			echo "<tr><td align=center class=data><b>";
				echo "<input type=text name=new_telefono1 size=35 value='".$row1["pac_telefono"]."'>";
				echo "<input type=text name=new_telefono2 size=35 value='".$row1["pac_dni"]."'>";
			echo "</b><HR></td></tr>";
	//		echo "<tr><td align=center><hr></td></tr>";
	/*		echo "<tr><td align=center class=head-blu-c><b>DOMICILIOS ANTERIORES</b></td></tr>";
			
				$res=mysqli_query($conn,"SELECT dom_id,dom_ant,dpto_ant"
									." FROM domicilio"
									." WHERE pac_id='".$row["pac_id"]."' order by dom_date desc")  or die(mysqli_error($conn));

				while($rw=mysqli_fetch_array($res,MYSQLI_ASSOC)){
							echo "<tr><td align=left><font size=2>".$rw["dom_ant"]." ".$rw["dpto_ant"]."</font>"
								."<a href=".$_SERVER["PHP_SELF"]."?event=rest_dom&dom_id=".$rw["dom_id"]."&pac_id=".$row["pac_id"].">"
	//									."<img src=\"iconos/icons/information-balloon32.png\" border=0 title=\"NOVEDAD\"></a></td>";
										." restaurar</a></td>";
							echo "</td></tr>"; 
				}*/

			echo "<tr><td class=head>FECHA CAMBIO DOMICILIO</td></tr>";
			echo "<tr><td align=center>";
			
				echo "<table>";
					echo "<tr>";
						echo "<td>".sel_date("day",1,31,date("d"))."</td>";
						echo "<td>".sel_date("month",1,12,date("m"))."</td>";
						echo "<td>".sel_date("year",2006,2012,date("Y"))."</td>";
					echo "</tr>";
				echo "</table>";
			
			echo "</td></tr>";
	//		echo "<tr><td colspan=1 align=center><b><textarea name=desc cols=33 rows=5></textarea></b></td></tr>";
			echo "<tr><td align=center><hr>";

			echo "<input type=submit name=event value=\"Cambiar Domicilio\"></td></tr>";

		echo "</table>";
	echo "</form>";
}
?>