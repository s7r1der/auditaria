<style type="text/css">
	H1.SaltoDePagina{ PAGE-BREAK-AFTER: always}
</style>

<?php
/*function cuil($dni,$sexo){

	$suma=$temp=$ultimo=0;

	$mult="5432765432";
	
	$pre=($sexo=="F"?"27":"20");
	$dni1=$pre.$dni;
	$suma=$temp=0;	

	for($i=0;$i<10;$i++){
		$temp=$dni1[$i]*$mult[$i];
		$suma=$suma+$temp;
	}
	
	$resto=($suma % 11);
	
	$ultimo=($resto==0?"0":($resto==1?"1":(11-$resto)));

	return $pre."-".$dni."-".$ultimo;

}*/
//$_POST["e_mat"]="4465";

$emat=explode(" - ",$_GET["e_mat"]);

$conn=newConnect();
$query=mysqli_query($conn,"SELECT CONCAT(enf_nombre,' ',enf_apellido) as enfermero,enf_dni,enf_cuil,enf_domicilio,enf_dpto,enf_sexo,enf_role"
			." FROM enfermero where e_mat='".$emat[1]."'") or die(mysqli_error($conn));

while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
	$nombre=$row["enfermero"];
	$dni=$row["enf_dni"];
	$domicilio=$row["enf_domicilio"];
	$dpto=$row["enf_dpto"];
	$sexo=$row["enf_sexo"];
	$categ=$row["enf_role"];
	$cuil=$row["enf_cuil"];
}

?>


<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<style type="text/css">

p {
text-align:justify;
 font-family:Arial;
 font-color:blue;
}

</style>

<body>
	<center><font size=4 face="Arial"><b><u>CONTRATO DE LOCACIÓN DE SERVICIOS CUIDADO DE PERSONAS </u></b></center>
	<br>



<p>
Entre el Sr. <b><?php echo strtoupper($nombre);?></b> DNI <b><?php echo $dni;?></b>, domiciliado en <b><?php echo strtoupper($domicilio); ?> DEPARTAMENTO DE <?php echo strtoupper($dpto);?> PROVINCIA DE MENDOZA</b> CUIT <?php echo $cuil;?>, por una parte, en adelante, EL LOCADOR y <b>ZEROBO S.A</b>  CUIT 30-71182557-2 con domicilio en calle: Joaquín V. González 185 Godoy Cruz  Mendoza , representada en este acto por su presidente, Sr Cristian Rodolfo Dengra D.N.I 30.385.646 en calidad de presidente, por la otra, en adelante, EL LOCATARIO, convienen en celebrar el presente contrato de locación de servicios de acuerdo a lo establecido en el art 1251 y 1252  1º párrafo del Código Civil y Comercial de la Nación y sujeto a las siguientes cláusulas: 
</p>
<p><b><u>PRIMERA:</u> Objeto.</b>EL LOCATARIO encomienda a EL LOCADOR los siguientes servicios profesionales de PRESTACION DE SERVICIO CUIDADO DE PERSONAS, de la persona……………………………………………………………………………………………..AFIL………………………………………………………………………………………………………………..Domicilio………………………………………………………………………………………………………. Las labores  se desarrollarán en forma personal indelegable y de acuerdo a las normas establecidas, siendo con suma diligencia, cuidado, puntualidad, eficacia  y limpieza. ---------------------------------</p>

<p><b><u>SEGUNDA:</u> Precio.</b>EL LOCATARIO se compromete a abonar una suma mínima pesos sesenta ($60) por hora de prestación que realice el locador contra factura. Asimismo se establece que el locador y locatario podrán pactar una suma mayor de acuerdo a la complejidad de la prestación a realizar. Todo pago se realizara a los 10 días de presentada la factura  al LOCATARIO. Los importes serán acreditados en la cuenta que denuncie el locador  en el plazo arriba señalado---------</p>

<p><b><u>TERCERA:</u> Vigencia.</b> Vigencia. Este contrato tendrá una vigencia de  tres (3) MESES, contados a partir de la fecha de celebración o hasta que cese la necesidad de cuidado de persona por recuperación, muerte u otra causal que no requiera mas los servicios de cuidado de persona. Este plazo podrá ser prorrogado por las partes, mediante comunicación en forma fehaciente por otro termino igual. Caso contrario, el contrato quedará automáticamente anulado----------------------------------------------------
</p>

<p><b><u>CUARTA:</u> DESARROLLO DE LA TAREA ENCOMENDADA:</b> la tarea de prestación de servicios será realizada única y exclusivamente  por el locador. El locador deberá prestar los servicios en los días y horarios estipulados, realizando todas las tareas necesarias para el cuidado de la persona encomendada por el tiempo contratado, la tarea  consistirá: en  aseo de la persona que cuida, hacer y suministrar alimentos a la persona que cuida,  controlar que tome la medicación debidamente recetada por profesionales tratantes, acompañamiento dentro y fuera del Hogar  de la persona que se cuida, realizar las llamadas correspondientes a familiares y emergencias en caso de descompensación de la persona a su cuidado, no realizara tareas para ningún miembro de la familia de la persona que cuida, deberá  higienizar los elementos usados por la persona a cargo del cuidado. El locatario pactará con el CUIDADOR, persona a cuidar,   día y cantidad de  horas que va a cumplir en la tarea de cuidado. ------------------------------------------------------------El locador  deberá  aportar los elementos necesarios para cumplir con la tarea y   para el caso de que no tuviese los elementos necesarios para realizar la prestación deberá comunicar al locatario la imposibilidad de cumplir con la tarea quedando a cargo de este  proveer los elementos ------------------------------------</p>

<p><b><u>QUINTA:</u></b> Teniendo en cuenta la tarea a realizar  por el cuidador, la mismas debe ser hecha con absoluta diligencia, y eficacia, limpieza y precisión. Siendo indispensable el cumplimiento de los días y horarios asignados -----------------------------------------------------------------------------------------</p>

<p><b><u>SEXTA:</u></b> el Locador deberá al momento de  presentar la factura acompañar el pago de monotributo y/o el comprobante al día según su situación o calificación tributaria.  Acompañará además el pago de cuota de seguro de accidente personales  que deberá contratar bajo su exclusiva responsabilidad--	</p>
	
<p><b><u>SEPTIMA:</u> : Rescisión. Cualquiera de las partes podrá rescindir este contrato por cualquier motivo, debiendo notificar su decisión a la otra parte en forma fehaciente y con una anticipación no menor de 30 días corridos.------------------------------------------------------------------------------------------------</p>

<p><b><u>OCTAVA:</u> Cesión. </b>EL LOCADOR realizará personalmente la tarea de cuidado, quedando prohibida la cesión de este contrato a terceras personas.------------------------------------------------------</p>

<p><b><u> NOVENA:</u></b>El presente contrato es de naturaleza civil, por lo tanto queda establecido que locador no queda  sujeto a relación de dependencia frente al Locatario en tal sentido aquél tiene plena libertad en el ejercicio de sus servicios y la realización de su tarea comprometida, procurando obtener el mejor resultado. ---------------------------------------------------------------------------------------</p>

<p><b><u>DECIMA:</u></b> Queda a cargo del locador su inscripción en todo lo que es referente a impuestos, ya sea nacionales, provinciales y /o municipales que le correspondan por el desarrollo de la actividad a prestar.---------------------------------------------------------------------------------------------------------------</p>

<p><b><u>DECIMA PRIMERA:</u> Lealtad Comercial.</b>Las partes acuerdan que por ninguna razón los locadores de servicios  manifestaran u ofrecerán sus servicios en forma particular  servicios de enfermería y/o cualquier otra prestación a aquellas personas e instituciones  donde  hubiere prestado servicios encomendados por el locatario por el lapso de vigencia de contrato y con una posterioridad de 18 meses posteriores a su vencimiento y no renovación --------------------------------------------------
Para el caso de que se transgreda esta cláusula de lealtad comercial  el locatario podrá rescindir el contrato de locación sin indemnización alguna si estuviera en vigencia, para el caso de que no haya trascurrido el lapso de dieciocho meses desde su vencimiento, el locatario podrá exigir del locador  una suma equivalente a  treinta prestaciones básicas de servicio de enfermería.  Todo ello conforme a lo dispuesto por el art 957, 958, 959, 961, 992, 1084, 1086 y ss del código Civil y Comercial de la Nación.

</p>

<p><b><u>DECIMA SEGUNDA:</u> Domicilios. Jurisdicción.</b> Ambas partes constituyen domicilios en los mencionados al comienzo, donde se tendrán por validas todas las notificaciones derivadas de la interpretación y ejecución del presente contrato. Para el supuesto de divergencias, acuerdan concurrir con carácter previo al proceso de mediación, y en caso de resultado negativo, deciden someterse a la jurisdicción de la Justicia Ordinaria Civil de la Ciudad de Mendoza, renunciando a todo otro fuero o jurisdicción que pudiera corresponderles.--------------------------------------------------</p>

<p>En prueba de conformidad se firman dos ejemplares de un mismo tenor y a un solo efecto, en la Ciudad de Mendoza a los....... día del mes de............................. De 20..........------------------------------------------------</p>
<br><br><br>
<table align=center width=70%> 
	<tr valign=bottom><td align=left><img src="iconos/firma.jpg" width=60%>
	</td><td align=center>.............................................</td></tr>
	<tr><td align=center></td><td align=center>LOCADOR</td></tr>
</table>

<br><br><br>
<table align=center> 

<h1>
<!--<tr><td>
	<p align=center><b><u> ANEXO CLAUSULA DE LEALTAD COMERCIAL:</u></b></p>
</td></tr>
</table>

<br><br>
<p>Las partes acuerdan que por ninguna razón los locadores de servicios manifestarán u ofrecerán sus servicios en forma partircular servicios de enfermería y/o cualquier otra prestación a aquellas personas e instituciones donde hubiere prestado servicios encomendados por el locatario por el lapso de vigencia de contrato y con una posterioridad de 18 meses posteriores a su vencimiento y no renovación. <br><br>
Para el caso de que se transgreda esta cláusula de lealtad comercial el locatario podra rescindir el contrato de locación sin indemnización alguna si estuviera en vigencia, para el caso de que no haya transcurrido el lapso de dieciocho meses desde su vencimiento, el locatario podrá exigir del locador una suma equivalente a treinta prestaciones básicas de servicios de Enfermería. Todo ello conforme a lo dispuesto por el art 957,958,959,961,992,1084,1086 y ss del codigo Civil y Comercial de la Nacion.---------------------------------------------------------------------</p>

<br><br><br>
<table align=center width=70%> 
	<tr><td align=center>...........................................</td><td align=center>................................................</td></tr>
	<tr><td align=center>LOCATARIO</td><td align=center>LOCADOR</td></tr>
</table>
</h1>

<hl>
<tr><td>
	<p align=center><b><u> PRORROGA DE CONTRATO DE LOCACION DE SERVICIOS:</u></b></p>
</td></tr>
</table>

<br><br>
<p>EN EL DIA DE………………………..DEL MES DE…………………………AÑO………… ZEROBO SA CUIT 30-71182557-2 CON DOMICILIO EN CALLE JOAQUIN V GONZALEZ  185 DE GODOY CRUZ MENDOZA  EN SU CARÁCTER DE LOCATARIO Y EL SR /SRA  <b><?php echo strtoupper($nombre);?></b> DNI <b><?php echo $dni;?></b>, domiciliado en <b><?php echo strtoupper($domicilio); ?> DEPARTAMENTO DE <?php echo strtoupper($dpto);?> PROVINCIA DE MENDOZA</b> CUIT <?php echo $cuil;?>EN SU CARÁCTER DE LOCADOR DE SERVICIO DE ENFERMERIA HAN DECIDIDO CELEBRAR EL SIGUIENTE CONTRATO</p>

<p><b><u>PRIMERO: </u></b> LAS PARTES DECIDEN PRORROGAR EL CONTRATO DE LOCACION FIRMADO EL DIA………………..DEL AÑO……………….EL CUAL TIENE UNA VIGENCIA DE UN AÑO.  ASIMISMO Y DE ACUERDO A LAS ESTIPULACIONES DE DICHO CONTRATO LAS PARTES HAN DECIDIDO EN FORMA FEHACIENTE  EXTENDER LA PRORROGA DEL MISMO POR UN PERIODO IGUAL AL ANTERIOR (UN  AÑO)</u> .-------------------------------------------------------------------------------------</p>

<p><b><u>SEGUNDO: </u></b> PARA ESTA PRORROGA CONTRACTUAL LAS PARTES HAN PACTADO UNA SUMA DE DINERO POR PRESTACION  QUE SE DETALLA A CONTINUACION.<br>
CSV PESOS TREINTA ($ 30); CURACIONES Y PRACTICAS INVASIVAS PESOS CUARENTA ($40); CURACIONES MULTIPLES PESOS SESENTA ($60); ANTIBIOTICOTERAPIA PESOS OCHENTA ($80) <br>
LA QUE SERA ABONADA EN LAS MISMAS CONDICIONES Y FORMAS ANTES PACTADA.</p>

<p><b><u>TERCERO: </u></b>EL LOCATARIO SE RESERVA EL DERECHO DE INICIAR ACCIONES LEGALES Y PENALES HABIENDOSE DETECTADO FEHACIENTEMENTE EN LAS AUDITORIAS LA ADULTERACION Y/O FALSIFICACION DE FIRMAS EN LAS PLANILLAS CONSIDERANDOSE ESTO COMO ESTAFA QUEDANDO EN LA FACULTAD DE RESCINDIR EL PRESENTE CONTRATO AUTOMATICAMENTE.</p> 

<p><b><u>TERCERO: </u></b>QUE LAS PARTES DECLARAN DE PLENA VALIDEZ LAS CLAUSULAS Y CONTENIDOS DEL CONTRATO DE SERVICIO ORIGINAL COMO ASI LOS ANEXOS QUE EL MISMO TUVIERA (CLAUSULA DE LEALTAD COMERCIAL) MANIFESTADO QUE HAN ACEPTADO Y ACEPTAN LIBREMENTE LO ANTES ESTIPULADO.  EN CUANTO A OBJETO,  PRECIO, VIGENCIA, DESARROLLO DE TAREAS RESPONSABILIDAD RESCICION. CESION, NATURALEZA DE CONTRATO Y DOMICILIOS ALLI DENUNCIADOS </p>

<p><b><u>CUARTO: </u></b> QUE LAS PARTES DECLARAN DE PLENA VALIDEZ LAS CLAUSULAS Y CONTENIDOS DEL CONTRATO DE SERVICIO ORIGINAL COMO ASI LOS ANEXOS QUE EL MISMO TUVIERA (CLAUSULA DE LEALTAD COMERCIAL) MANIFESTADO QUE HAN ACEPTADO Y ACEPTAN LIBREMENTE LO ANTES ESTIPULADO.  EN CUANTO A OBJETO,  PRECIO, VIGENCIA, DESARROLLO DE TAREAS RESPONSABILIDAD RESCICION. CESION, NATURALEZA DE CONTRATO Y DOMICILIOS ALLI DENUNCIADOS </p>

<br><br><br>
<table align=center width=70%> 
	<tr><td align=center>...........................................</td><td align=center>................................................</td></tr>
	<tr><td align=center>LOCATARIO</td><td align=center>LOCADOR</td></tr>
</table>
</h1>-->

