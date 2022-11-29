<?php  	

	//MUESTRA LA HISTORIA CLINICA.
		
//	echo "<CENTER><font size=6 color=white><STRONG>HISTORIA CLINICA</STRONG></font><br><br></CENTER>";

if($_SESSION["dato_busq"]!=""){

		$conn=newConnect();
		if(isset($_SESSION["sel_var"]) && $_SESSION["sel_var"]==1){
			$res=mysqli_query($conn,"select * from paciente where ".$_SESSION["opt_busq"]. "='"
			.$_SESSION["dato_busq"]."' order by pac_id")or die(mysqli_error($conn));
		}else{
			$res=mysqli_query($conn,"select * from paciente where ".$_SESSION["opt_busq"]. " like '%"
				.$_SESSION["dato_busq"]."%' order by pac_id")or die(mysqli_error($conn));
			$_SESSION["sel_var"]=0;
		}
	}else{
		$res=mysqli_query($conn,"select * from paciente where ".$_SESSION["opt_busq"]. " like '%"
			.$_SESSION["dato_busq"]."%' order by pac_id")or die(mysqli_error($conn));
		$_SESSION["sel_var"]=0;
	}

//	echo "<center>";tab_gral_st("100%","");

	if(mysqli_num_rows($res)==1){						//Solo hay un registro con la informacion.
		
		$_SESSION["find"]=1;
				
		while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){

			include("inc/patient/ch_personal_data.php");
			include("inc/patient/chd_atention_data.php");
			echo	"</td></tr></table>";
		}
	}elseif(mysqli_num_rows($res)==0){					//No existe nadie con ese tipo de informacion

		$_SESSION["find"]=0;
		sys_msg(0,4,"white");

	}else{												//Existen mas de un registro. Goto Seleccionar el paciente.
		$_SESSION["find"]=1;
		$_SESSION["pos"]="det";
		include("inc/datos_select.php");
	}
?>
