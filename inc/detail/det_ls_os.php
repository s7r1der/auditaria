 	<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php 

$index=0;	//esta variable si se pone en 1 genera el indice de la lista de pacientes.

$dat_color="#330099";
$cont=0;
$_SESSION["pac_os"]=$_POST["os"];

$table_in=substr($fec1,0,4);
$table_stop=substr($fec2,0,4);
	
	echo "<center><table class=myTable-gray width=95%>";
		echo"<tr>";
			echo "<td colspan=11 class=titulo>".$_POST["os"]." - ".month_toString(substr($fec2,5,2),1,1)."</td>";
		echo "</tr>";

		echo"<tr>";
			echo "<td class=subtitulo><b>NRO</b></td>";
			if(isset($_POST["cuidador"])) echo "<td class=subtitulo><b>CUIDADOR</b></td>";			
			echo "<td class=subtitulo><b>DOMICILIO</b></td>";
			echo "<td class=subtitulo><b>HORAS</b></td>";
			echo "<td class=subtitulo><b>PACIENTE</b></td>"; 
			echo "<td class=subtitulo><b>ID.</b></td>";
			if($_POST["os"]=="SEMA") echo "<td class=subtitulo><b>MODULO</b></td>";			
			echo "<td class=subtitulo><b>NRO AFIL</b0></td>";			
			echo "<td class=subtitulo><b>TELEFONO</b></td>";
			echo "<td class=subtitulo><b>ESTADO</b></td>";
			if($_SESSION["usr_role"]=="admin" && $_SESSION["usr_level"]>3)	echo "<td class=subtitulo width=08%><b>TOTAL</b></td>";
			//echo "<td class=subtitulo><b>MATRICULA</b></td>";
			//echo "<td class=subtitulo><b>REVISION</b></td>";
		echo "</tr>";

	$annex="";

	echo strstr($_POST["os"],"GER.");
	for($i=$table_in;$i<=$table_stop;$i++){

		if($_POST["os"]=="SEMA")
			$annex=" AND (pac.pac_os='MODULO 1' or pac.pac_os='MODULO 2' or pac.pac_os='MODULO 3' "
						."or pac.pac_os='MODULO 4' or pac.pac_os='SUBMODULO' or pac.pac_os='OSPRERA' or pac.pac_os='OSEP')";
						//."or pac.pac_os='MODULO 4' or pac.pac_os='SUBMODULO')";
		
		else $annex=" AND pac.pac_os='".$_POST["os"]."'";
		
		
		if($_POST["owner"]=="SOE")	$cond=" AND op_reg='1'";
		elseif($_POST["owner"]=="COOP")	$cond=" AND op_reg='0'";
		else $cond="";
		

		if($_POST["cant_horas"]!="*") $annex=$annex." AND op.cant_horas='".$_POST["cant_horas"]."'";

		if($_POST["pac_dpto"]!="*") $annex=$annex." AND pac.pac_dpto like '".$_POST["pac_dpto"]."%'";

		//if($_SESSION["usr_level"]<=5)
		$annex=$annex." AND op_prestacion!='Visita s/coseg' AND op_prestacion!='AUDITORIA ENFERMERIA'"
				." AND op_prestacion!='NC x cambio modulo' AND op_prestacion!='FALTA SIN AVISO' AND op_prestacion!='NO CORRESPONDE'";						
		$annex=$annex.$cond;

		if(isset($_POST["cuidador"])){
			$annex=$annex." GROUP BY op.pac_id,enf.e_mat ORDER BY enf.enf_apellido";
		}else{
			$annex=$annex." GROUP BY op.pac_id ORDER BY pac.pac_apellido,pac.pac_nombre";			
		}

		$qr="SELECT op.pac_id, op.op_date,op.op_coseg,pac.pac_os, pac.pac_domicilio,pac.pac_dpto,pac.pac_telefono"
					.",sum( op.cant_horas) as cont,op.cant_horas,pac.pac_apellido,CONCAT(pac.pac_apellido,' ',pac.pac_nombre) as nombre"
					.",COUNT(op.pac_id) as cont2, CONCAT(enf.enf_apellido,' ',enf.enf_nombre) as cuidador,"
				.	"op.e_mat, op.op_prestacion,pac.pac_afil,pac.pac_estado"
				." FROM op".$i."cuidados op left join paciente pac on op.pac_id=pac.pac_id"
				." left join enfermero enf on op.e_mat=enf.e_mat"
				." WHERE op.op_date BETWEEN '".$fec1."' AND '".$fec2."'"
				//." AND op.cant_horas='8'"
				//." AND (op_prestacion!='NO CORRESPONDE' AND op_prestacion!='FALTA SIN AVISO' AND op_prestacion!='SUSPENDIDO DE MOMENTO' AND op_prestacion!='Visita s/coseg')"
				//." AND !(pac.pac_dpto like '%lavalle%') AND !(pac.pac_dpto like '%san rafael%') AND !(pac.pac_dpto like '%alvear%')"
				//." AND pac.pac_dpto like '%san martin%' "	
				.$annex;

		//echo $qr."<br><br><br><br>";

		$conn=newConnect();
		//$conn1=newConnect();

		$res=mysqli_query($conn,$qr)or die(mysqli_error($conn));	

		$cant=0;
		$tot=0;

		while($row1=mysqli_fetch_array($res,MYSQLI_ASSOC)){


			if(($_POST["cant_horas"]==4 && $row1["cont"]<101) || $_POST["cant_horas"]!="4"){

			$cont++;		

			echo "<tr valign=top>";
				$dt1=split_date($fec1);
				$dt2=split_date($fec2);

				echo "<td><a href=".$_SERVER["PHP_SELF"]."?event=viewdetxos"."&pac_id=".$row1["pac_id"]
																		."&fec_beg=".$dt1["year"]."-".$dt1["month"]."-".$dt1["day"]
																		."&fec_fin=".$dt2["year"]."-".$dt2["month"]."-".$dt2["day"]
																		."&pac_os=".$_POST["os"]
																		." title=\"Ver Detalle x paciente\">".$cont."</a></td>";

				if(isset($_POST["cuidador"]))	echo "<td align=left><b>".strtoupper($row1["cuidador"])."</b></td>";


				echo "<td align=left class=bold><a href=".$_SERVER["PHP_SELF"]."?event=det_lst_sh_hc"."&pac_id=".$row1["pac_id"]
																."&fec_beg=".$dt1["year"]."-".$dt1["month"]."-".$dt1["day"]
																."&fec_fin=".$dt2["year"]."-".$dt2["month"]."-".$dt2["day"]
																." title=\"Ver Historia Clinica\" "
																."class=".(isset($_POST["cuidador"])?"":"bold").">"
																."<font color=black>".strtoupper($row1["nombre"])."</font></a></td>";

				/*$rw1=mysqli_query($conn1,"select CONCAT(enf_apellido,' ',enf_nombre) as enfer from enfermero where e_mat='".$row1["e_mat"]."'") or die(mysqli_error($conn1));

				while($tmp=mysqli_fetch_array($rw1,MYSQL_ASSOC)){
					echo "<td align=center><b>".$tmp["enfer"]."</b></td>";
				}*/

				echo "<td align=center><b>".$row1["cont"]."</b></td>";

				echo "<td align=left>".$row1["pac_domicilio"]." - ".$row1["pac_dpto"]."</td>";
				echo "<td class=head2>".$row1["pac_id"]."</td>";

				if($_POST["os"]=="SEMA") echo "<td><b>".$row1["pac_os"]."</b></td>";								

				echo "<td>".($row1["pac_afil"]==""?"<font color=red><b>COMPLETAR</b></font>":$row1["pac_afil"])."</td>";
			
				echo "<td class=head2>".$row1["pac_telefono"]."</td>";

				echo "<td align=left>".$row1["pac_estado"]."</td>";

				//echo "<td align=left>".$row1["ubc_lat"].",".$row1["ubc_lon"]."</td>";
         	
				//$limit=($row1["pac_os"]=="SEMA MODULO A"?30:($row1["pac_os"]=="SEMA"?60:($row1["pac_os"]=="SEMA MODULO C"?90:100)));
				//	echo "<td><FONT COLOR=".($row1["cont"]>$limit?"#ED2135fa":"black").">".$row1["cont"]."</FONT></td>"; 
				//echo "<td align=center><b>".$row1["cont"]."</b></td>";

				//if($row1["cant_horas"]==4){				
					if($_SESSION["usr_role"]=="admin" && $_SESSION["usr_level"]>3 && $_SESSION["usr_level"]<5){	
						echo "<td align=center><b>".($row1["cont"]*54)."</b></td>";
					}	
					elseif($_SESSION["usr_role"]=="admin" && $_SESSION["usr_level"]>=5){	
						echo "<td align=center><b>".($row1["cont"]*280	)."</b></td>";
					}
				//}

				//ONLY_FULL_GROUP_BY,

				/*echo "<td>".$row1["e_mat"]."</td>";

				$res22=mysql_query("SELECT oprev_val from oprevcuidados where "
								." e_mat='".$row1["e_mat"]."' AND pac_id='".$row1["pac_id"]."'"
								." AND oprev_date='".$dt1["year"]."-".$dt1["month"]."-".$dt1["day"]."'") or die(mysql_error());

				if(mysql_num_rows($res22)){
					$val=1;
					$txt="REVISADO";
				}else{
					$val=0;
					$txt="NO";
				}

				echo "<td align=center><a href=".$_SERVER["PHP_SELF"]."?event=set_oprev"."&pac_id=".$row1["pac_id"]
																		."&e_mat=".$row1["e_mat"]
																		."&oprev_date=".$dt1["year"]."-".$dt1["month"]."-".$dt1["day"]
																		."&oprev_val=".$val.">".$txt."</a></td>";
				
// 				t_data("<font color=white>".$row1["e_mat"]."</font>", $dat_color);*/

				$cant=$cant+$row1["cont"];
	
				//if($row1["cant_horas"]==4){				
	
					if($_SESSION["usr_role"]=="admin" && $_SESSION["usr_level"]>=5)	
						$tot=$tot+($row1["cont"]*280);
					else
						$tot=$tot+($row1["cont"]*54);
				//}

			echo "</tr>";
			}
		}
	}

	echo "<td colspan=7 class=subtitulo>TOTALES</td>";
	echo "<td colspan=2 class=subtitulo>".$cant."</td>";


	if($_SESSION["usr_role"]=="admin" && $_SESSION["usr_level"]>3){	
		echo "<td colspan=1 class=subtitulo>".$tot."</td>";
	}
	echo "</table>";

?>