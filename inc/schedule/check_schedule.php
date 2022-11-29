<link rel="StyleSheet" href="css/check_schedule.css" type="text/css">

<?php

$fec=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"];

if($_SESSION["dato_busq"]!="" && $_SESSION["opt_busq"]!="pac_id"){

		$res=mysqli_query($conn,"SELECT * FROM paciente WHERE ".$_SESSION["opt_busq"]. " like '%".$_SESSION["dato_busq"]."%'")or die(mysqli_error($conn));
}else{
		$res=mysqli_query($conn,"SELECT * FROM paciente WHERE ".$_SESSION["opt_busq"]. "='".$_SESSION["dato_busq"]."'") or die(mysqli_error($conn));
}

if(mysqli_num_rows($res)==1){
	if($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		
		$state="INCORRECTO";
		$flag=0;
		if($row["pac_estado"]=='ACTIVO'){
			$state="OK";
			$flag++;
		}

		echo "<center>";
			echo "<table align=center class=myTable>";
				echo "<tr>";
					echo "<td class=titulo colspan=2>";
						echo "<font size=5><b>VERIFICACION DE DATOS.("
							.$_SESSION["day_tmp"]."/".$_SESSION["month_tmp"]."/".$_SESSION["year_tmp"].")</b></font>";
					echo "</td>";
				echo "</tr>";

				echo "<tr><td class=subhead colspan=2><font size=5>".$row["pac_domicilio"]." ".$row["pac_dpto"]."</font></td></tr>";
				echo "<tr><td align=left><b>PACIENTE:</b></td><td> ".$row["pac_apellido"]." ".$row["pac_nombre"]."</td></tr>";
				echo "<tr><td align=left><b>OBRA SOCIAL :</b></td><td>".$row["pac_os"]."</td></tr>";
				echo "<tr><td align=left><b>ESTADO:</b></td><td>".$row["pac_estado"]."</td></tr>";
				echo "<tr><td align=left colspan=2 bgcolor=".($state=="OK"?'#CAFFBF':'#FF0066').">Comprobando estado de paciente: ".$state."</td></tr>";

				$query=mysqli_query($conn,"SELECT op_prestacion, count(op_prestacion) as cant"
								." FROM op".$_SESSION["year_tmp"]."cuidados"
								." WHERE op_date between '".$fec." 00:00:00' and '".$fec." 23:59:59'"
								." AND op_prestacion='CUIDADOS' and pac_id='".$row["pac_id"]."' GROUP BY op_prestacion");

				echo "<tr><td align=left colspan=2 class=titulo></td></tr>";
				echo "<tr><td align=left  colspan=2><u>Prestaciones diarias:</u><b>  ".mysqli_num_rows($query)."</b></td></tr>";
				
				while($rw=mysqli_fetch_array($query,MYSQLI_ASSOC)){
					echo "<tr><td align=left colspan=2>".$rw["op_prestacion"].": ".$rw["cant"]."</td></tr>"; 
				}

				if($flag==1){
					echo "<tr><td align=right colspan=2><a href=".$_SERVER["PHP_SELF"]."?event=sel_prestacion&pac_id='".$row["pac_id"]."' class=myButton>"
						."Ingresar Paciente</a></td></tr>";
				}
	}
	echo "</table>";
echo "</center>";

}elseif(mysqli_num_rows($res)==0){

	echo "<table class=myTable align=center>";
			echo "<tr><td class=titulo>PACIENTE NUEVO</td></tr>";
			echo "<tr><td align=center><font size=5><b><u>AGREGUE EL PACIENTE</u></b><Br> ANTES DE CARGAR LAS PRESTACIONES</td></tr>";
	echo "</table>";

/*	$_SESSION["find"]=0;
	$row["pac_nombre"]=$row["pac_apellido"]="";
	$row["pac_domicilio"]=$row["pac_dpto"]=$row["pac_os"]="";
	$row["pac_telefono"]=$row["pac_afil"]=$row["pac_dni"]="";
	$row["pac_fecnac"]=$row["pac_fecingr"]="";
	$row["ubc_lat"]=$row["ubc_lon"]="";
	$row["med_id"]=$row["pac_estado"]="";
	$row["op_prestacion"]="";
	$row["op_coseg"]=$row["e_mat"]="";
	$row["min"]="00";
	//$row["op_desp"]=$desp;
	$row["op_anexo"]=$row["op_tips"]="";
	$operation="add";

	include("inc/schedule/add_personal_data.php");*/
	
}else{
	$_SESSION["find"]=1;
	$row["op_desp"]="";
	include("inc/datos_select.php");
}
?>