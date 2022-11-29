<?php  
	//tab_gral_st();
	echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";
	
	if($_SESSION["dato_busq"]!=""){
		if(isset($_SESSION["sel_var"]) && $_SESSION["sel_var"]==1){
			$res=mysqli_query($conn,"select enf.*,usr.*"
									." FROM enfermero enf left join usuario usr"
									." ON usr.usr_mat=enf.e_mat"
									." WHERE enf.".$_SESSION["opt_busq"]."='".$_SESSION["dato_busq"]."'");
		}else{
			$res=mysqli_query($conn,"select enf.*,usr.*"
									." FROM enfermero enf left join usuario usr"
									." ON usr.usr_mat=enf.e_mat"
									." WHERE enf.".$_SESSION["opt_busq"]."='".$_SESSION["dato_busq"]."'");
			$_SESSION["sel_var"]=0;
		}
	}else{
			$res=mysqli_query($conn,"select enf.*,usr.*"
									." FROM enfermero enf left join usuario usr"
									." ON usr.usr_mat=enf.e_mat"
									." WHERE enf.".$_SESSION["opt_busq"]."='".$_SESSION["dato_busq"]."'");
			$_SESSION["sel_var"]=0;
	}

	echo "<table align=center class=myTable-gray>";

	if(mysqli_num_rows($res)>=1){
		if($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){

			echo "<tr><td colspan=3 class=titulo>FORMULARIO DATOS DE ENFERMEROS</FONT></td></tr>";
			
			if(isset($row["enf_vto_mat"])){
				$date=explode("-",$row["enf_vto_mat"]);
			}

			echo "<tr valign=top>";
				$_SESSION["type_busq"]="enfer1";
				echo "<td>";
					include("inc/enf/personal_data.php");
				echo "</td>";
					
				//para determinar las zonas
				$nqr1=mysqli_query($conn,"select zona_desc from zonaenf where e_mat='".$row["e_mat"]."'");
				$i=0;

				while($nrw1=mysqli_fetch_array($nqr1,MYSQLI_ASSOC)){
					$i++;
					$row["zona".$i]=$nrw1["zona_desc"];
				}
				
				for($j=($i+1);$j<5;$j++){
					$row["zona".$j]="-";
				}

				echo "<td>";
					include("inc/enf/laboral_data.php");
				echo "</td><td>";
					include("inc/enf/access_data.php");
				echo "</td>";
			echo "</tr>";	
			
			echo "<tr><td colspan=3 class=head align=right>";
			if($_SESSION["type_busq"]=="enfer1"){
				$_SESSION["p_id_ant"]=$row["enf_id"];
				$_SESSION["usr_id_ant"]=$row["usr_id"];

				echo "<input type=submit name=event class=myButton value=\"Guardar Datos\">";
				if($_SESSION["usr_role"]>5) echo "<input type=submit name=event class=myButton value=\"Eliminar Enfermero\">";
			}else{
				echo "<input type=submit name=event class=myButton value=\"Ingresar\">";
			}
		}

	}else{
		$_SESSION["type_busq"]="enfer1";
		include("inc/enf/datos_select.php");
	}
	//tab_gral_end();
	echo "</table>";
?>