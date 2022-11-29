<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

$role_ant='';

echo "<table class=myTable-gray align=center>";
	
	$contad=$categ=0;
	$conn=newConnect();


	$cond="";
	$ty_usr=type_user($_SESSION["user"]);
	if($ty_usr==0 || $ty_usr==1)	$cond=" AND enf_owner='".($ty_usr==0?"COOP":"SOE")."'";

	$res=mysqli_query($conn,"SELECT * FROM enfermero WHERE enf_role='CUID' and enf_estado='ACTIVO'".$cond." order by enf_owner,enf_apellido");
	
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){

		//$op_reg=($row["enf_owner"]=="SOE"?"1":"0");
		//$query="UPDATE op2018cuidados set op_reg='".$op_reg."' where e_mat='".$row["e_mat"]."'";
		//echo $query."<br>";
		//mysqli_query($conn,$query) or die(mysqli_error($conn));
		/*switch ($row["enf_owner"]){
			case "ENF3":	$categ="SOE";		break;
			case "ENFP":	$categ="PEDIATRICO";	break;
			case "EST":
			case "ESTA":	$categ="ESTUDIANTE";	break;
			case "PAS":		$categ="PASANTE";		break;
			case "CUID":	$categ="CUIDADORE";	break;

		}*/

		if($role_ant!=$row["enf_owner"]){
			
			$contad=0;
			$role_ant=$row["enf_owner"];
			echo "<tr><td colspan=12 class=titulo><font size=5>".$row["enf_owner"]."</font></td></tr>";
	
			echo "<tr>";
				echo "<td class=subtitulo>NRO</td>";
				echo "<td class=subtitulo>DNI</td>";
				echo "<td class=subtitulo>APELLIDO Y NOMBRE</td>";
				echo "<td class=subtitulo>FECHA NAC</td>";
				echo "<td class=subtitulo>CUIT</td>";
				echo "<td class=subtitulo>DIRECCION</td>";
				echo "<td class=subtitulo>LOCALIDAD</td>";
				echo "<td class=subtitulo>CP</td>";
				echo "<td class=subtitulo>TELEFONO</td>";
				echo "<td class=subtitulo>ESTADO</td>";
				echo "<td class=subtitulo>PERT</td>";
				//echo "<td class=subtitulo>AUDITOR</td>";
			echo "</tr>";

			/*echo "<tr>";
				echo "<td class=subtitulo>APELLIDO Y NOMBRE</td>";
				echo "<td class=subtitulo>MATRICULA</td>";
				echo "<td class=subtitulo>DOMICILIO</td>";
				echo "<td class=subtitulo>TELEFONO</td>";
				echo "<td class=subtitulo>CUIL</td>";
				echo "<td class=subtitulo>FECHA NAC</td>";
				echo "<td class=subtitulo>ESTADO</td>";
				echo "<td class=subtitulo>PERTENECE</td>";
				//echo "<td class=subtitulo>AUDITOR</td>";
			echo "</tr>";*/

			
		}

		$contad=$contad+1;

		$fec1=date("Y-m-d");
		$vto_mat=($fec1<$row["enf_vto_mat"]?"<font color='#638cb5'>".$row["enf_vto_mat"]."</font>":"<font color='#FF0066'>".$row["enf_vto_mat"]."</font>");

		echo "<tr>";
			if($_SESSION["usr_role"]=="admin" && $_SESSION["usr_level"]>3){
				echo "<td align=center><a href=".$_SERVER["PHP_SELF"]."?event=menu_enf&e_mat=".$row["e_mat"].">".$contad."</a></td>";
			}else
				echo "<td align=center><font color=blue>".$contad."</font></td>";	
			echo "<td align=center>".$row["enf_dni"]."</td>";
			echo "<td align=left><b>".strtoupper($row["enf_apellido"])."</b>, ".$row["enf_nombre"]."</td>";
			echo "<td align=center>".$row["enf_fecnac"]."</td>";
			echo "<td align=center>".$row["enf_cuil"]."</td>";
			echo "<td align=left>".$row["enf_domicilio"]."</td>";
			echo "<td align=left>".$row["enf_dpto"]."</td>";
			echo "<td align=center>".$row["enf_cp"]."</td>";
			echo "<td align=center>".$row["enf_telefono"]."</td>";
			echo "<td align=center><b><font color=".($row["enf_estado"]=="ACTIVO"?"#00FF00":"#000000").">".$row["enf_estado"]."</b></b></td>";
			echo "<td align=left><b><font size=2>".$row["enf_owner"]."</font></b></b></td>";
		echo "</tr>";

		/*echo "<tr>";
			echo "<td align=left><b>".$contad."-".strtoupper($row["enf_apellido"])."</b>, ".$row["enf_nombre"]."</td>";
	//		echo "<td align=center><a href=".$_SERVER["PHP_SELF"]."?event=sel_enf&e_mat=".$row["e_mat"].">".$row["e_mat"]."</a>";
			if($_SESSION["usr_role"]=="admin" && $_SESSION["usr_level"]>3){
				echo "<td align=center><a href=".$_SERVER["PHP_SELF"]."?event=menu_enf&e_mat=".$row["e_mat"].">".$row["e_mat"]."</a></td>";
			}else
				echo "<td align=center><font color=blue>".$row["e_mat"]."</font></td>";

//			echo "<td>".$row["e_mat"]."</td>";
			echo "<td align=left>".$row["enf_domicilio"]." ".$row["enf_dpto"]."</td>";
			echo "<td align=center>".$row["enf_telefono"]."</td>";
			echo "<td align=center>".$row["enf_cuil"]."</td>";
			echo "<td align=center>".$row["enf_fecnac"]."</td>";
			//echo "<td align=center>".($row["enf_contrato"]==1?"SI":"NO")."</td>";
			echo "<td align=center><b><font color=".($row["enf_estado"]=="ACTIVO"?"#00FF00":"#000000").">".$row["enf_estado"]."</b></b></td>";
			echo "<td align=left><b><font size=2>".$row["enf_owner"]."</font></b></b></td>";

			//echo "<td align=center>".$row["enf_auditor"].($row["enf_auditor2"]!=0?"-".$row["enf_auditor2"]:"")."</td>";
		echo "</tr>";*/
	}
echo "</table>";

$role_ant='';

echo "<br><br>";

echo "<table class=myTable-gray align=center>";
	echo "<tr><td colspan=11 class=titulo>PASIVO</td></tr>";
	echo "<tr><td colspan=11 class=titulo>SISTEMA</td></tr>";
	echo "<tr>";
		echo "<td class=subtitulo>APELLIDO Y NOMBRE</td>";
		echo "<td class=subtitulo>MATRICULA</td>";
		echo "<td class=subtitulo>DOMICILIO</td>";
		echo "<td class=subtitulo>TELEFONO</td>";
		echo "<td class=subtitulo>CUIL</td>";
		echo "<td class=subtitulo>FEC NAC</td>";
		echo "<td class=subtitulo>ESTADO</td>";
		echo "<td class=subtitulo>PERTENECE</td>";
	echo "</tr>";

	$contad=$categ=0;
	$conn=newConnect();


	$cond="";
	$ty_usr=type_user($_SESSION["user"]);
	if($ty_usr==0 || $ty_usr==1)	$cond=" AND enf_owner='".($ty_usr==0?"COOP":"SOE")."'";

	$res=mysqli_query($conn,"SELECT * FROM enfermero WHERE enf_role='CUID' and enf_estado='PASIVO'".$cond." order by enf_owner,enf_apellido");
	
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){

		//$op_reg=($row["enf_owner"]=="SOE"?"1":"0");
		//$query="UPDATE op2018cuidados set op_reg='".$op_reg."' where e_mat='".$row["e_mat"]."'";
		//echo $query."<br>";
		//mysqli_query($conn,$query) or die(mysqli_error($conn));
		/*switch ($row["enf_owner"]){
			case "ENF3":	$categ="SOE";		break;
			case "ENFP":	$categ="PEDIATRICO";	break;
			case "EST":
			case "ESTA":	$categ="ESTUDIANTE";	break;
			case "PAS":		$categ="PASANTE";		break;
			case "CUID":	$categ="CUIDADORE";	break;

		}*/

		if($role_ant!=$row["enf_owner"]){
			
			$contad=0;
			$role_ant=$row["enf_owner"];
			echo "<tr><td colspan=11 class=titulo><font size=5>".$row["enf_owner"]."</font></td></tr>";
	
			echo "<tr>";
				echo "<td class=subtitulo>APELLIDO Y NOMBRE</td>";
				echo "<td class=subtitulo>MATRICULA</td>";
				echo "<td class=subtitulo>DOMICILIO</td>";
				echo "<td class=subtitulo>TELEFONO</td>";
				echo "<td class=subtitulo>CUIL</td>";
				echo "<td class=subtitulo>FEC NAC</td>";
				echo "<td class=subtitulo>ESTADO</td>";
				echo "<td class=subtitulo>PERTENECE</td>";
				//echo "<td class=subtitulo>AUDITOR</td>";
			echo "</tr>";

			
		}

		$contad=$contad+1;

		$fec1=date("Y-m-d");
		$vto_mat=($fec1<$row["enf_vto_mat"]?"<font color='#638cb5'>".$row["enf_vto_mat"]."</font>":"<font color='#FF0066'>".$row["enf_vto_mat"]."</font>");

		echo "<tr>";
			echo "<td align=left><b>".$contad."-".strtoupper($row["enf_apellido"])."</b>, ".$row["enf_nombre"]."</td>";
	//		echo "<td align=center><a href=".$_SERVER["PHP_SELF"]."?event=sel_enf&e_mat=".$row["e_mat"].">".$row["e_mat"]."</a>";
			if($_SESSION["usr_role"]=="admin" && $_SESSION["usr_level"]>3){
				echo "<td align=center><a href=".$_SERVER["PHP_SELF"]."?event=menu_enf&e_mat=".$row["e_mat"].">".$row["e_mat"]."</a></td>";
			}else
				echo "<td align=center><font color=blue>".$row["e_mat"]."</font></td>";

//			echo "<td>".$row["e_mat"]."</td>";
			echo "<td align=left>".$row["enf_domicilio"]." ".$row["enf_dpto"]."</td>";
			echo "<td align=center>".$row["enf_telefono"]."</td>";
			echo "<td align=center>".$row["enf_cuil"]."</td>";
			echo "<td align=center>".$row["enf_fecnac"]."</td>";
			echo "<td align=center>".($row["enf_contrato"]==1?"SI":"NO")."</td>";
			echo "<td align=center><b><font color=".($row["enf_estado"]=="ACTIVO"?"#00FF00":"#000000").">".$row["enf_estado"]."</b></b></td>";
			echo "<td align=left><b><font size=2>".$row["enf_owner"]."</font></b></b></td>";

			//echo "<td align=center>".$row["enf_auditor"].($row["enf_auditor2"]!=0?"-".$row["enf_auditor2"]:"")."</td>";
		echo "</tr>";
	}
echo "</table>";


?>