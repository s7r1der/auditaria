<link rel="StyleSheet" href="css/forms.css" type="text/css">
<meta name=viewport content="width=device-width, initial-scale=1">
	
<?php 

$table_in=substr($fec1,0,4);
$table_stop=substr($fec2,0,4);

for($i=$table_in;$i<=$table_stop;$i++){

	if($_POST["os"]=="SEMA")
		$annex=" AND (pac.pac_os='MODULO 1' or pac.pac_os='MODULO 2' or pac.pac_os='MODULO 3' or pac.pac_os='MODULO 4' or pac.pac_os='SUBMODULO')";
	
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
		$cant=$cant+$row1["cont"];
	}
	
	$tot=$cant*128.5;
}
$_GET["periodo"]=month_toString(substr($fec2,5,2),1,1);

echo "<H1 class=SaltodePagina>";

echo "<bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR>";

echo "<table align=center>";
	echo "<tr><td align=center><FONT SIZE=30><b><u>SEMA</u></b></FONT></td></tr>";
	echo "<tr><td><br><br></td></tr>";
	echo "<tr><td align=center><FONT SIZE=20>".$_GET["periodo"]."</font></td></tr>";
	echo "<tr><td><br><br></td></tr>";
	echo "<tr><td align=center><FONT SIZE=20><b>CUIDADOS</b></font></td></tr>";
	echo "<tr><td><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR></td></tr>";
	echo "<tr><td align=left><img src=\"images/zerobo.png\" border=0 width=300></td></tr>";
	echo "<tr><td align=left><FONT SIZE=20></font></td></tr>";
echo "</table>";

echo "<H1 class=SaltodePagina>";

echo "<table align=center width=90%>";
	echo "<tr valign=top><td align=right>";
		echo "<FONT SIZE=4><b><u>TEL</u> 0-800-333-4321 - email: directorio@zerobo.com.ar - </b></FONT>";
		echo "<img src=\"images/zerobo.png\" border=0 width=80>";
	echo "</td></tr>";

	echo "<tr><td><hr></td></tr>";

	echo "<tr><td><br><br></td></tr>";
	echo "<tr><td align=right><FONT SIZE=4>GODOY CRUZ, MENDOZA A LOS ".date("d")." DEL MES DE ".strtoupper(month_toString(date("m")))." DE ".date("Y")."</font></td></tr>";
	echo "<tr><td><br><br></td></tr>";
	echo "<tr><td align=left><FONT SIZE=5>Por intermedio de la presente, ZEROBO S.A deja constancia de la presentacion de la carpeta de prestaciones<br>"
			." correspondientes al mes de <b>".$_GET["periodo"]."</b> de todos los pacientes de SEMA - CUIDADOS</font></td></tr>";

	echo "<tr><td><br><br></td></tr>";
	echo "<tr><td align=left><FONT SIZE=5>Dicha presentacion <u><b>INCLUYE:</b></u></font></td></tr>";
	echo "<tr><td><br><br></td></tr>";

	echo "<tr><td align=left><FONT SIZE=10>*</font><FONT SIZE=5>Detalle de todas las prestaciones realizadas en el mes.</td></tr>";
	echo "<tr><td align=left><FONT SIZE=10>*</font><FONT SIZE=5>Evoluciones de las prestaciones mensuales.</td></tr>";
	echo "<tr><td align=left><FONT SIZE=10>*</font><FONT SIZE=5>Detalle de facturacion mensual.</td></tr>";


	echo "<tr><td><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR></td></tr>";

	echo "<tr><td align=center><img src=\"images/firmas/firma_ricardo.png\" border=0 width=300></td></tr>";
	echo "<tr><td align=center><b>DIRECTOR OPERATIVO ZEROBO S.A.</b></td></tr>";
echo "</table>";
	

echo "<H1 class=SaltodePagina>";

echo "<table align=center width=90%>";
	echo "<tr valign=top><td align=right>";
		echo "<FONT SIZE=4><b><u>TEL</u> 0-800-333-4321 - email: directorio@zerobo.com.ar - </b></FONT>";
		echo "<img src=\"images/zerobo.png\" border=0 width=80>";
	echo "</td></tr>";

	echo "<tr><td><hr></td></tr>";

	echo "<tr><td><br><br></td></tr>";	
	echo "<tr><td align=right><FONT SIZE=4>GODOY CRUZ, MENDOZA A LOS ".date("d")." DEL MES DE ".strtoupper(month_toString(date("m")))." DE ".date("Y")."</font></td></tr>";
	echo "<tr><td><br><br><br><br></td></tr>";
	echo "<tr><td align=center><FONT SIZE=5><u><b>TOTAL DEL SERVICIOS PRESTACIONAL EN EL MES DE ".$_GET["periodo"]."</b></u></font></td></tr>";

	echo "<tr><td><br><br><br><br><br><br></td></tr>";
	echo "<tr><td align=left>";
		echo "<table width=60% align=center>";
			echo "<tr>";
				echo "<td><FONT SIZE=10>*</font></td>";
				echo "<td align=center><FONT SIZE=5><u>PRESTACIONES</u></font></td>";
				echo "<td align=center><FONT SIZE=5>".$cant."</font></td>";
				echo "<td align=center><FONT SIZE=5>$".number_format($tot,2,",",".")."</font></td>";
			echo "</tr>";

			echo "<tr><td colspan=4><br><br><br></td></tr>";
			
			echo "<tr>";
				echo "<td colspan=3></td>";
				echo "<td><hr></td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td colspan=3 align=right><FONT SIZE=6><b>TOTAL</b></font></td>";
				echo "<td align=center><FONT SIZE=6><b>$".number_format($tot,2,",",".")."</b></font></td>";
			echo "</tr>";

		echo "</table>";
	echo "</td></tr>";	

	echo "<tr><td><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR><bR></td></tr>";

	echo "<tr><td align=center><img src=\"images/firmas/firma_ricardo.png\" border=0 width=300></td></tr>";
	echo "<tr><td align=center><b>DIRECTOR OPERATIVO ZEROBO S.A.</b></td></tr>";
	echo "<tr><td align=left><FONT SIZE=20></font></td></tr>";
echo "</table>";

echo "<H1 class=SaltodePagina>";


//echo "</hl>";
?>