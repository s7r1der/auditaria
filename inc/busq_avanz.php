<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

echo "<FORM ACTION=".$_SERVER["PHP_SELF"]." method=POST>";
	
	echo "<table width=100% class=myTable-gray>";
		echo "<tr><td>";
			if($_SESSION["usr_role"]=="sema" || $_SESSION["usr_role"]=="semasm") include ("inc/enc_menu.php");
		echo "</td></tr>";

		echo "<tr><td class=titulo>";
				echo "<input class=text1 type=text size=25 name=dato>";
				echo "<input type=submit name=event value=Busqueda_Rapida>";

		echo "</td></tr>";
	echo "</table>";

echo "</FORM>";

$data=explode(" ",$_POST["dato"]);
//echo $data[0].(isset($data[1])?"/".$data[1]:"");
if(isset($data[1])){
  $cond=" WHERE ((pac_apellido like '%".$data[0]."%' AND pac_nombre like '%".$data[1]."%')"
				." OR (pac_apellido like '%".$data[1]."%' AND pac_nombre like '%".$data[0]."%')"
				." OR pac_id like '%".$_POST["dato"]."%'"
				." OR pac_afil like '%".$_POST["dato"]."%'"
				." OR pac_domicilio like '%".$_POST["dato"]."%')";
}else{
	$cond=" WHERE (pac_apellido like '%".$_POST["dato"]."%'"
				." OR pac_nombre like '%".$_POST["dato"]."%'"
				." OR pac_id like '%".$_POST["dato"]."%'"
				." OR pac_afil like '%".$_POST["dato"]."%'"
				." OR pac_domicilio like '%".$_POST["dato"]."%')";
}


$fec=$_SESSION["year_tmp"]."-".$_SESSION["month_tmp"]."-".$_SESSION["day_tmp"];

echo "<CENTER><font size=6 color=white><STRONG>BUSQUEDA RAPIDA DE PACIENTES."."</STRONG></font><br></CENTER>";

$conn=newConnect();
$res33=mysqli_query($conn,"select pac_id,CONCAT(pac_apellido,' ',pac_nombre) as paciente, CONCAT(pac_domicilio,' ',pac_dpto) as domicilio"
						.",pac_os,pac_telefono, pac_estado,pac_afil"
						." FROM paciente"
						.$cond
						." ORDER BY pac_id desc") or die(mysqli_error($conn));

echo "<p align=center><font color=white size=5>PACIENTES ENCONTRADOS:".mysqli_num_rows($res33)."</font>";
echo "<br><font color=white size=4>\"".$_POST["dato"]."\"</font></p>";

while($row=mysqli_fetch_array($res33,MYSQLI_ASSOC)){
	echo "<table class=myTable-gray width=600 align=center>";
		echo "<tr><td colspan=2 class=subtitulo>DATOS DEL PACIENTE</td></tr>";
		echo "<tr><td class=bold>DOMICILIO:</td><td align=left>".$row["domicilio"]."</td></tr>";
		echo "<tr><td class=bold>PACIENTE:</td><td align=left>".$row["paciente"]."</td></tr>";
		echo "<tr><td class=bold>OBRA SOCIAL:</td><td align=left>".$row["pac_os"]."</td></tr>";
		echo "<tr><td class=bold>AFIL:</td><td align=left>".$row["pac_afil"]."</td></tr>";
		echo "<tr><td class=bold>ID:</td><td align=left>".$row["pac_id"]."</td></tr>";
		echo "<tr><td class=bold>ESTADO:</td><td bgcolor=".($row["pac_estado"]=='ACTIVO'?'#00CC66':'#FF0000').">".$row["pac_estado"]."</td></tr>";

		echo "<tr><td colspan=2 class=titulo><a href=".$_SERVER["PHP_SELF"]."?event=add_reclamo"
													."&pac_id=".$row["pac_id"]
													."&paciente=".urlencode((strtoupper($row["paciente"])))
													." title=\"Reclamo\">"
													."<font color=white size=4>+Crear Tarea</font></a></td></tr>";

		/*$query=mysqli_query($conn,"SELECT evol_desc,date_format(evol_date,\"%d-%m-%Y %h:%i\") as opdate "
							." FROM evolution"
							." WHERE pac_id='".$row["pac_id"]."' order by evol_date desc limit 5");

		echo "<tr><td colspan=2 class=subtitulo>Ultimas evoluciones: </td></tr>";

		while($rw=mysqli_fetch_array($query,MYSQLI_ASSOC)){
			echo "<tr><td colspan=2 align=left>".$rw["opdate"].": ".$rw["evol_desc"]."</td></tr>"; 
		}*/

			echo "<tr><td colspan=2 class=subtitulo><a href=".$_SERVER["PHP_SELF"]."?event=det_lst_sh_hc"."&pac_id=".$row["pac_id"]
														."&fec_beg=".date("Y")."-".(date("m")-1)."-01"
														."&fec_fin=".date("Y")."-".(date("m")-1)."-31"
														." title=\"Ver Historia Clinica\">"
														."<font color=white size=5>VER HISTORIA CLINICA</font></a></td></tr>";


	echo "</table>";
	echo "<br>";
}
?>