<link rel="StyleSheet" href="css/forms.css" type="text/css">

	<table class=myTable-gray align=center>
		<tr><td colspan=6 class=titulo>DATOS LABORALES:</td></tr>

	<?php
		echo "<tr><td class=datal><B>Turno:</B></td><td class=datal><select name=turno_desc>";
					echo "<option name=opt>AM";
					echo "<option name=opt>PM";
					echo "<option name=opt>AMBOS";

				if($row["enf_turno"]!="")	 echo "<option selected>".($row["enf_turno"]=="AP"?"AMBOS":$row["enf_turno"]);
				else	 echo "<option selected>-";
		echo "</select></td></tr>";

		echo "<tr><td class=datal><B>Zona:</B></td><td>";


			for($i=1;$i<5;$i++){
				echo "<br><select name=zona".$i.">";
					echo "<option name=opt>-";
					$qr=mysqli_query($conn,"select zona_desc from zona");
					while($rw=mysqli_fetch_array($qr,MYSQLI_ASSOC)){
						echo "<option name=opt>".$rw["zona_desc"];
					}echo "<option name=opt selected>".$row["zona".$i];
				echo "</select>";
			}
		echo "</td></tr>";

		echo "<tr><td class=datal><B>CUENTA:</B></td><td class=datal>";
					echo "<input type=text name=enf_cta value=".$row["enf_cta"].">";
		echo "</select></td></tr>";

		echo "<tr><td class=datal><B>Perteneciente:</B></td><td class=datal><select name=enf_owner>";
					echo "<option>COOP";
					echo "<option>ZER";
					echo "<option>ZERN";
					echo "<option>AMBOS";
					echo "<option selected>".$row["enf_owner"];
		echo "</select></td></tr>";

		echo "<tr><td class=datal><B>Facturacion:</B></td><td class=datal><select name=fact_state>";
					for($i=0;$i<12;$i++){
						echo "<option name=opt>".$i;
					}
					echo "<option name=opt selected>".$row["enf_fact"];
		echo "</select></td></tr>";

		echo "<tr><td class=datal><B>Auditor:</B></td><td class=datal>";
			echo "<select name=enf_auditor>";
					echo "<option name=opt>1770";
					echo "<option name=opt>3111";
					echo "<option name=opt>3305";
					echo "<option name=opt>4181";
					echo "<option selected>".$row["enf_auditor"];
			echo "</select>";

			echo "<select name=enf_auditor2>";
					echo "<option name=opt>1770";
					echo "<option name=opt>3111";
					echo "<option name=opt>3305";
					echo "<option name=opt>4181";
					echo "<option name=opt>-";
					echo "<option selected>".$row["enf_auditor2"];
			echo "</select>";
		
		echo "</td></tr>";

		echo "<tr><td class=datal><B>SEGURO:</B></td><td class=datal>";
			echo "<select name=enf_contador>";
					echo "<option name=opt>SI";
					echo "<option name=opt>NO";
					echo "<option selected>".($row["enf_contador"]!=""?$row["enf_contador"]:"NO");
			echo "</select>";
		
		echo "</td></tr>";

		echo "<tr><td class=datal><B>Movilidad:</B></td><td class=datal>";
			echo "<select name=enf_movil>";
					echo "<option name=opt>AUTO";
					echo "<option name=opt>MOTO";
					echo "<option name=opt>BICICLETA";
					echo "<option name=opt>CAMINANDO";
					echo "<option selected>".($row["enf_movil"]!=""?$row["enf_movil"]:"NO");
			echo "</select>";
		
		echo "</td></tr>";

		echo "<tr><td class=datal><B>Contrato:</B></td><td class=datal>";
			echo "<select name=enf_contrato>";
					echo "<option name=opt>SI";
					echo "<option name=opt>NO";
					echo "<option selected>".($row["enf_contrato"]!=""?($row["enf_contrato"]==1?"SI":"NO"):"NO");
			echo "</select>";
		
		echo "</td></tr>";



	echo "</table>";
?>
