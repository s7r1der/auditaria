<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

if(isset($_GET["event"]) && $_GET["event"]=="menu_user" && $_SESSION["usr_role"]=="admin"){

	echo "<table cellpadding=0 cellspacing=0 width=100%><tr><td align=center>";

	if($_SESSION["usr_role"]=="admin"){
		include("inc/apps.php");
	}
	
	echo "</td></tr>";
	echo "</table>";
}


$conn=newConnect();

$enf_query=mysqli_query($conn,"SELECT e_mat,CONCAT(enf_apellido,' ',enf_nombre) as enfermero from enfermero where enf_estado='ACTIVO' order by enf_apellido");

if(isset($_SESSION["usr_role"]) && $_SESSION["usr_role"]=="admin"){
	
	echo "<table width=100% class=myTable-gray>";
		echo "<tr valign=top><td>";
			if($_SESSION["usr_level"]>3)
				include ("inc/accesos.php");
			else
				include ("inc/accesos1.php");

		$color=(type_user($_SESSION["user"])==2?"blue":"green");		
		echo "</td><td align=center><font color=".$color." size=5><b>".(type_user($_SESSION["user"])==2?"ZER":"COOPE")."</b></font>"
									."<br><font color=".$color.">@".$_SESSION["user"]."</font>";
		echo "</td></tr>";

		if(isset($_GET["event"]) && $_GET["event"]=="menu_user" && $_SESSION["usr_role"]=="admin"){
	
			echo "<FORM ACTION=".$_SERVER["PHP_SELF"]." method=POST>";

				echo "<tr><td class=subtitulo colspan=2>";
						echo "<table align=center class=myTable-gray>";
						echo "<tr>"
							."<td><input type=text size=15 name=dato></td>"
							."<td><input type=submit name=event value=Busqueda_Rapida></td>";
							/*."<td>";
								echo "<select name=e_mat style=\"width: 70px;\">";
									while($row_enf=mysql_fetch_array($enf_query,MYSQL_ASSOC))	echo "<option>".$row_enf["e_mat"]." - ".$row_enf["enfermero"];
								echo "</select></td>"
							."<td><input type=submit name=event value=Enfermero_Rapida></td>";*/
						echo "</tr>";
					echo "</table>";
				echo "</td></tr>";
			
			echo "</FORM>";
		}
	echo "</table>";

}

?>