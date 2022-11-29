<?php	

echo "<form action=".$_SERVER["PHP_SELF"]." method=POST>";

	
include("inc/enc_busq.php");

//DETALLES LISTA POR OBRA SOCIAL.
if($_SESSION["estad_opt"]=="ls_os"){				

	echo "<tr><td class=bold>Obra Social:</td>";
	echo "<td align=right><select name=os>";
		echo "<option name=opt>OSEP";
		echo "<option name=opt selected>SEMA";
		echo "<option name=opt>MODULO 1";
		echo "<option name=opt>MODULO 2";
		echo "<option name=opt>MODULO 3";
		echo "<option name=opt>MODULO 4";
		echo "<option name=opt>OSPAT";
		echo "<option name=opt>SOE";
	echo "</select></td></tr>";

	switch(type_user($_SESSION["user"])){
		case "0":
		case "1":
		echo "<tr><td class=bold>GRUPO:</td>";
				echo "<td align=right><select name=owner>";
					echo "<option name=opt selected>".(type_user($_SESSION["user"])==0?"COOP":"SOE");
			echo "</select></td></tr>";
			break;
		case "2":
			echo "<tr><td class=bold>GRUPO:</td>";
				echo "<td align=right><select name=owner>";
					echo "<option name=opt selected>*";
					echo "<option name=opt>SOE";
					echo "<option name=opt>COOP";
			echo "</select></td></tr>";
			break;
	}

	echo "<tr><td><b>HORAS:</b></td>";
	echo "<td align=right><select name=cant_horas>";
		echo "<option name=opt>4";
		echo "<option name=opt>8";
		echo "<option name=opt>12";		
	echo "<option name=opt selected=opt>*";
	
	echo "</select></td></tr>";

	echo "<tr><td><b>Departamento:</b></td>";
	echo "<td align=right><select name=pac_dpto>";

	$conn1=newConnect();
	$res1=mysqli_query($conn1,"select dpto_nombre from departamento where 1 order by dpto_nombre asc")or die(mysqli_error($conn1));
	$dpto_ant="";

	while($row1=mysqli_fetch_array($res1,MYSQLI_ASSOC)){

		$dpto_new=strpos($row1["dpto_nombre"],"-");
		if(!$dpto_new) echo "<option name=opt>".$row1["dpto_nombre"];
		
	}echo "<option name=opt selected=opt>*";
	
	echo "</select></td></tr>";

	echo "<tr><td colspan=2><input type=checkbox name=cuidador>Mostrar por cuidador</td></tr>";

	echo "<tr><td colspan=2 align=right><input type=\"submit\" name=\"event\" class=MyButton value=\"Lista_OS\"></td></tr>";

}elseif($_SESSION["estad_opt"]=="lista_os"){				

		echo "<tr><td class=bold>Obra Social:</td>";
		echo "<td align=right><select name=os>";
			echo "<option name=opt>OSEP";
			echo "<option name=opt selected>SEMA";
			echo "<option name=opt>MODULO 1";
			echo "<option name=opt>MODULO 2";
			echo "<option name=opt>MODULO 3";
			echo "<option name=opt>MODULO 4";
			echo "<option name=opt>OSPAT";
			echo "<option name=opt>SOE";
		echo "</select></td></tr>";
	
		switch(type_user($_SESSION["user"])){
			case "0":
			case "1":
			echo "<tr><td class=bold>GRUPO:</td>";
					echo "<td align=right><select name=owner>";
						echo "<option name=opt selected>".(type_user($_SESSION["user"])==0?"COOP":"SOE");
				echo "</select></td></tr>";
				break;
			case "2":
				echo "<tr><td class=bold>GRUPO:</td>";
					echo "<td align=right><select name=owner>";
						echo "<option name=opt selected>*";
						echo "<option name=opt>SOE";
						echo "<option name=opt>COOP";
				echo "</select></td></tr>";
				break;
		}
	
		echo "<tr><td><b>HORAS:</b></td>";
		echo "<td align=right><select name=cant_horas>";
			echo "<option name=opt>4";
			echo "<option name=opt>8";
			echo "<option name=opt>12";		
		echo "<option name=opt selected=opt>*";
		
		echo "</select></td></tr>";
	
		echo "<tr><td><b>Departamento:</b></td>";
		echo "<td align=right><select name=pac_dpto>";
	
		$conn1=newConnect();
		$res1=mysqli_query($conn1,"select dpto_nombre from departamento where 1 order by dpto_nombre asc")or die(mysqli_error($conn1));
		$dpto_ant="";
	
		while($row1=mysqli_fetch_array($res1,MYSQLI_ASSOC)){
	
			$dpto_new=strpos($row1["dpto_nombre"],"-");
			if(!$dpto_new) echo "<option name=opt>".$row1["dpto_nombre"];
			
		}echo "<option name=opt selected=opt>*";
		
		echo "</select></td></tr>";
	
		echo "<tr><td colspan=2><input type=checkbox name=cuidador>Mostrar por cuidador</td></tr>";
	
		echo "<tr><td colspan=2 align=right><input type=\"submit\" name=\"event\" class=MyButton value=\"Lista_OS_Enc\"></td></tr>";
}elseif($_SESSION["estad_opt"]=="ls_os_res"){				

	echo "<tr><td class=bold>Obra Social:</td>";
	echo "<td align=right><select name=os>";
		echo "<option name=opt>OSEP";
		echo "<option name=opt selected>SEMA";
		echo "<option name=opt>MODULO 1";
		echo "<option name=opt>MODULO 2";
		echo "<option name=opt>MODULO 3";
		echo "<option name=opt>MODULO 4";
		echo "<option name=opt>OSPAT";
		echo "<option name=opt>SOE";
	echo "</select></td></tr>";

	switch(type_user($_SESSION["user"])){
		case "0":
		case "1":
		echo "<tr><td class=bold>GRUPO:</td>";
				echo "<td align=right><select name=owner>";
					echo "<option name=opt selected>".(type_user($_SESSION["user"])==0?"COOP":"SOE");
			echo "</select></td></tr>";
			break;
		case "2":
			echo "<tr><td class=bold>GRUPO:</td>";
				echo "<td align=right><select name=owner>";
					echo "<option name=opt selected>*";
					echo "<option name=opt>SOE";
					echo "<option name=opt>COOP";
			echo "</select></td></tr>";
			break;
	}

	echo "<tr><td colspan=2 align=right><input type=\"submit\" name=\"event\" class=MyButton value=\"RESUMEN_OS\"></td></tr>";

//DETALLES MATERIALES POR OBRA SOCIAL
}else if($_SESSION["estad_opt"]=="os_enf"){

	$cond="";
	
	if(type_user($_SESSION["user"])==0 ||type_user($_SESSION["user"])==1){
			$cond=" AND enf_owner='".(type_user($_SESSION["user"])==0?"COOP":"SOE")."'";
	}
	
	echo "<tr><td>Matricula:</td>";
	echo "<td align=right><select name=e_mat>";
	$conn=newConnect();
	$res=mysqli_query($conn,"select e_mat,CONCAT(enf_apellido,' ',enf_nombre) as enfermero from enfermero where enf_role='CUID'".$cond." order by enf_apellido asc")
			or die(mysqli_error($conn));

	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
			echo "<option name=opt selected=opt>".$row["enfermero"]." - ".$row["e_mat"];
	}echo "<option name=opt selected=opt>TODOS - *";
	echo "</select></td></tr>";
	echo "<tr><td colspan=2 align=right><input type=\"submit\" name=\"event\" class=myButton value=\"OS_Enf\"></td></tr>";

}
echo "</form>";
?>
