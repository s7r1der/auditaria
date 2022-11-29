<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

//mail("dcristian01@gmail.com,dcristian01@gmail.com","asuntillo","Este es el cuerpo del mensaje");

$cont=0;
$titulo="+ Crear Tarea.";

$table=(strlen($_SESSION["year_tmp"])==4?"op".$_SESSION["year_tmp"]:"op20".$_SESSION["year_tmp"]);

$conn=newConnect();
$res=mysqli_query($conn,"SELECT pac.pac_id,op.op_id,pac.pac_domicilio,pac.pac_apellido,pac.pac_nombre,pac.pac_dpto,pac.pac_telefono,"
			."op.op_sit,op.op_prestacion,op.cant_horas,op.op_formato"
			." FROM ".$table."cuidados op left join paciente pac on op.pac_id=pac.pac_id"
			." where op.op_prestacion='AUDITORIA' AND op.op_sit='0'"
			//." AND op.e_mat='".$_SESSION["usr_mat"]."'"
			) or die(mysqli_error($conn));

$res1=mysqli_query($conn,"SELECT pac.pac_id,op.op_id,pac.pac_domicilio,pac.pac_apellido,pac.pac_nombre,pac.pac_dpto,pac.pac_telefono,"
			."op.op_sit,op.op_prestacion,op.cant_horas,op.op_formato"
			." FROM ".$table."cuidados op left join paciente pac on op.pac_id=pac.pac_id"
			." where op.op_prestacion='AUDITORIA' AND op.op_sit!='0'"
			." ORDER BY op_sit"
			//." AND op.e_mat='".$_SESSION["usr_mat"]."'"
			) or die(mysqli_error($conn));



echo "<table width=100%>";
	echo "<tr><td class=titulo>PACIENTES PARA AUDITAR</td><td class=titulo> PACIENTES AUDITADOS</td></tr>";

	echo "<tr valign=top>";
		echo "<td>";
		while($rw=mysqli_fetch_array($res,MYSQLI_ASSOC)){
			echo "<table class=myTable-gray width=95%>";
				echo "<tr><td class=subtitulo>".$rw["op_prestacion"]."</td></tr>";
				echo "<tr><td><b>".strtoupper($rw["pac_domicilio"]." ".$rw["pac_dpto"])."</b></td></tr>";
				echo "<tr><td>".$rw["pac_apellido"]." ".$rw["pac_nombre"]."</td></tr>";
				echo "<tr><td>".$rw["pac_telefono"]."</td></tr>";
				echo "<tr><td><hr></td></tr>";
				echo "<tr><td><b>HORAS: </b>".$rw["cant_horas"]." HS.</td></tr>";
				echo "<tr><td><b>FORMA: </b>".$rw["op_formato"]."</td></tr>";

				//echo "<tr><td>".$rw["op_sit"]."</td></tr>";
				echo "<tr><td class=subtitulo>"
					."<a href=".$_SERVER["PHP_SELF"]."?event=add_auditoria"
									."&op_id=".$rw["op_id"]
									."&pac_id=".$rw["pac_id"]
									."&cant_horas=".$rw["cant_horas"]
									."&op_formato=".$rw["op_formato"]
									." class=link>"
							."<font size=3 color=white face=Arial>CARGAR AUDITORIA</font></a>";
				echo "</td></tr>";
			echo "</table>";
		}

		echo "</td>";
		
		echo "<td width=50%>";

			$aud_tipo="";
			
			echo "<table class=myTable-gray width=100%>";
				echo "<tr>";
					echo "<td class=subtitulo><font size=2>TIPO</font></td>";
					echo "<td class=subtitulo><font size=2>ESTADO</font></td>";
					echo "<td class=subtitulo><font size=3>PACIENTE</font></td>";
					echo "<td class=subtitulo><font size=2>NUMERO</font></td>";
					echo "<td class=subtitulo><font size=3>HORAS</font></td>";
					echo "<td class=subtitulo colspan=5><font size=3>ESTADO</font></td>";

				echo "</tr>";

			while($rw=mysqli_fetch_array($res1,MYSQLI_ASSOC)){

				$conn1=newConnect();
				$rs1=mysqli_query($conn1,"SELECT aud_tipo from auditoria where op_id='".$rw["op_id"]."'") or die(mysqli_error($conn1));
				if($row=mysqli_fetch_array($rs1,MYSQLI_ASSOC)){
					$aud_tipo=$row["aud_tipo"];
				}

				$bgcolor=($aud_tipo=="ingreso"?"green":"blue");

				$class=($rw["op_sit"]=="1"?"begin":($rw["op_sit"]=="2"?"warning":"evol"));
				$estado=($rw["op_sit"]=="1"?"auditado":($rw["op_sit"]=="2"?"planificado":"finalizado"));

					echo "<tr>";
						echo "<td align=center bgcolor=".$bgcolor."><font size=1 color=white>".$aud_tipo."</font></td>";
						echo "<td align=center class=".$class."><font size=1>".$estado."</font></td>";

						echo "<td align=left><b>".strtoupper($rw["pac_apellido"]).", ".$rw["pac_nombre"]."</b></td>";

						echo "<td align=center><font size=2>".$rw["op_id"]."</font></td>";

						echo "<td align=center><b>".$rw["cant_horas"]." HS.</b></td>";

						//echo "<td align=center><b>".$rw["op_formato"]."</b></td>";
						if($aud_tipo=="control" && $rw["op_sit"]>0){

							echo "<td align=center><font size=3 color=black face=Arial>M</font></a>";
							echo "</td>";

							echo "<td align=center  bgcolor=".$bgcolor.">"
								."<a href=".$_SERVER["PHP_SELF"]."?event=nh_show_auditoria&op_id=".$rw["op_id"]."&pac_id=".$rw["pac_id"]." class=link>"
										."<font size=3 color=white face=Arial>V</font></a>";
							echo "</td>";

							echo "<td align=center><font size=3 color=black face=Arial>A</font></a>";
							echo "</td>";

						}elseif($aud_tipo=="ingreso" && $rw["op_sit"]!=3){
							
							echo "<td align=center bgcolor=".$bgcolor.">"
								."<a href=".$_SERVER["PHP_SELF"]."?event=upd_auditoria&op_id=".$rw["op_id"]."&pac_id=".$rw["pac_id"]." class=link>"
										."<font size=3 color=white face=Arial>M</font></a></td>";				
							
							echo "<td align=center  bgcolor=".$bgcolor.">"
								."<a href=".$_SERVER["PHP_SELF"]."?event=nh_show_auditoria&op_id=".$rw["op_id"]."&pac_id=".$rw["pac_id"]." class=link>"
										."<font size=3 color=white face=Arial>V</font></a>";
							echo "</td>";

							echo "<td align=center bgcolor=".$bgcolor.">"
								."<a href=".$_SERVER["PHP_SELF"]."?event=tomar_auditoria&op_id=".$rw["op_id"]."&pac_id=".$rw["pac_id"]." class=link>"
										."<font size=3 color=white face=Arial>A</font></a>";
							echo "</td>";

						}else{

							echo "<td align=center><font size=3 color=black face=Arial>M</font></a>";
							echo "</td>";
							echo "<td align=center><font size=3 color=black face=Arial>V</font></a>";
							echo "</td>";
							echo "<td align=center><font size=3 color=black face=Arial>A</font></a>";
							echo "</td>";

						}

						if($aud_tipo=="ingreso" && $rw["op_sit"]==2){

							echo "<td align=center bgcolor=".$bgcolor.">"
								."<a href=".$_SERVER["PHP_SELF"]."?event=programar_auditoria&op_id=".$rw["op_id"]."&pac_id=".$rw["pac_id"]." class=link>"
										."<font size=3 color=white face=Arial>P</font></a>";
							echo "</td>";
						}else{
							echo "<td align=center><font size=3 color=black face=Arial>P</font></a>";
							echo "</td>";
						}

						if($aud_tipo=="ingreso" && $rw["op_sit"]==3){
							echo "<td align=center bgcolor=".$bgcolor.">"
								."<a href=".$_SERVER["PHP_SELF"]."?event=nh_show_fin_auditoria&op_id=".$rw["op_id"]."&pac_id=".$rw["pac_id"]." class=link>"
										."<font size=3 color=white face=Arial>F</font></a>";
							echo "</td>";
						
						}else{
							echo "<td align=center><font size=3 color=black face=Arial>F</font></a>";
							echo "</td>";
						}



					echo "</tr>";
			
			}

			echo "</table>";

		echo "</td>";
	
	echo "</tr>";

echo "</table>";
