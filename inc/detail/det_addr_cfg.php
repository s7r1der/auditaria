<?php  	

	//MUESTRA LA HISTORIA CLINICA.

	if($_SESSION["dato_busq"]!=""){

		if(isset($_SESSION["sel_var"]) && $_SESSION["sel_var"]==1){
			$res=mysqli_query($conn, "SELECT * FROM paciente WHERE ".$_SESSION["opt_busq"]. "='".$_SESSION["dato_busq"]."' GROUP BY pac_id")or die(mysqli_error($conn));
		}else{
			$res=mysqli_query($conn,"SELECT * FROM paciente WHERE ".$_SESSION["opt_busq"]. " like '%".$_SESSION["dato_busq"]."%' GROUP BY pac_id")or die(mysqli_error($conn));	
			$_SESSION["sel_var"]=0;
		}
	}else{
		$res=mysqli_query($conn,"SELECT * FROM paciente WHERE ".$_SESSION["opt_busq"]. " like '%".$_SESSION["dato_busq"]."%' GROUP BYpac_id")or die(mysqli_error($conn));
		$_SESSION["sel_var"]=0;
	}

	//tab_gral_st();

	if(mysqli_num_rows($res)==1){						//Solo hay un registro con la informacion.
		
		$_SESSION["find"]=1;
		
		while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
			include("inc/detail/det_addr.php");
		}
	}elseif(mysqli_num_rows($res)==0){					//No existe nadie con ese tipo de informacion

		sys_msg(0,4);
		
	}else{												//Existen mas de un registro. Goto Seleccionar el paciente.
		$_SESSION["find"]=1;
		$_SESSION["pos"]="addr_cfg";
		include("inc/datos_select.php");
	}
	//tab_gral_end();
?>
