<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php  
	echo "<CENTER><B><font color=white size=4>Resultado de la busqueda</font></B><br><br>";	

	echo "<table class=myTable-gray width=80%>";
		echo"<tr>"
			."<td class=head>N°</td>"
			."<td class=head>Nombre y Apellido</td>"
			."<td class=head>Domicilio</td>"
			."<td class=head>Telefono</td>"
			."<td class=head>OBRA SOCIAL</b></td>"
			."<td class=head>ESTADO</b></td>"
			."<td class=head></td>";
		echo"</tr>";

	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		echo"<tr>"
		."<td><font color=\"black\">".$row[(($_SESSION["pos"]=="enf")?"enf":"pac")."_id"]."</td>"
		."<td align=left><font color=\"black\">".$row[(($_SESSION["pos"]=="enf")?"enf":"pac")."_apellido"]." ".$row[(($_SESSION["pos"]=="enf")?"enf":"pac")."_nombre"]."</td>"
		."<td align=left><font color=\"black\">".$row[(($_SESSION["pos"]=="enf")?"enf":"pac")."_domicilio"]." - ".$row[(($_SESSION["pos"]=="enf")?"enf":"pac")."_dpto"]."</td>"
		."<td align=left><font color=\"black\">".$row[(($_SESSION["pos"]=="enf")?"enf":"pac")."_telefono"]."</td>"
		."<td align=left><font color=\"black\">".$row[(($_SESSION["pos"]=="enf")?"enf":"pac")."_os"]."</td>"
		."<td align=left><font color=\"black\"><b>"	.$row[(($_SESSION["pos"]=="enf")?"enf":"pac")."_estado"]."</td>";
		
		if($row[(($_SESSION["pos"]=="enf")?"enf":"pac")."_estado"]=='ACTIVO'){
		echo "<th	 align=right><a href=".$_SERVER["PHP_SELF"]."?event=sel_paciente&pac_id=".$row[(($_SESSION["pos"]=="enf")?"enf":"pac")."_id"]
			."&ubic=".$_SESSION["pos"].">Seleccionar</a></th>";
		}
		echo "</tr>";
	}
	echo"<tr><td colspan=7 class=head></td></tr>";
	$_SESSION["sel_var"]=1;
	echo "</table></CENTER>";
?>

<!--Goto sel_paciente ->