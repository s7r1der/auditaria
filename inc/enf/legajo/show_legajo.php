<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

$conn=newConnect();
$res=mysqli_query($conn,"SELECT e_mat,CONCAT(enf_nombre,' ',enf_apellido) as enfer FROM enfermero where e_mat='".$_GET["e_mat"]."'") or die(mysqli_error($conn));

while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){

	echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

		echo "<input type=hidden name=e_mat value=".$row["e_mat"].">";

		echo "<table class=menu-gray align=center>";

			echo "<tr><td class=titulo colspan=2>DETALLE DEL  LEGAJO</td></tr>";

			echo "<tr><td align=left><b>PERSONAL:</b></td><td align=left><FONT SIZE=6>".$row["enfer"]."</font></td></tr>";
			echo "<tr><td align=left><b>MATRICULA:</b></td><td align=left><FONT SIZE=6>".$row["e_mat"]."</font></td></tr>";


			echo "<tr><td class=subtitulo colspan=2>DETALLE</td></tr>";


			echo "<tr>";
				echo "<td width=100% colspan=2>";
					echo "<table width=100%>";
						
						echo "<tr>";
							echo "<td class=subtitulo>CONT</td>";
							echo "<td class=subtitulo>FECHA</td>";
							echo "<td class=subtitulo>DESCRIPCION</td>";
						echo "</tr>";

						$conn1=newConnect();
						$res1=mysqli_query($conn1,"SELECT e_mat,leg_desc,DATE_FORMAT(leg_fecha, \"%d / %m / %Y\") as fec FROM legajo where e_mat='".$row["e_mat"]."'");

						$cont=1;
						while($row1=mysqli_fetch_array($res1,MYSQLI_ASSOC)){
							echo "<tr>";
								echo "<td align=center>".$cont."</td>";
								echo "<td>".$row1["fec"]."</td>";
								echo "<td>".$row1["leg_desc"]."</td>";
							echo "</tr>";
							echo "<tr><td colspan=3><hr></td></tr>";						
							$cont++;		
						}

					echo "</table>";

				echo "</td>";
			echo "</tr>";
			
		echo	"</table>";
	echo "</form>";

}
	