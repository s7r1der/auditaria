<link rel="StyleSheet" href="css/schedule.css" type="text/css">

<?php

include("inc/schedule/schedule_func.php");

//FORWARD O REWARD FOR A DAY.
echo "<table class=encabezado width=100% align=center>";
	
	//echo "<tr><td class=head colspan=8><hr></td></tr>";	
	
	echo "<tr>";
		
		//PARA IR A LA SEMANA ANTERIOR.
		echo "<td>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=hrs_direct"	
												."&date=".det_dia($_SESSION["day_tmp"],$_SESSION["month_tmp"],$_SESSION["year_tmp"],-7)
												."&order1=".$_GET["order1"]."&order11=".$_GET["order11"]
												."&order2=".$_GET["order2"]."&order21=".$_GET["order21"].">";
				echo "<img src=\"iconos/icons/flecha7.gif\" align=right border=0 title=\"Semana Anterior\"></a>";
		echo "</td>";

		//PARA IR AL DIA ANTERIOR.
		echo "<td>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=hrs_direct"
												."&date=".det_dia($_SESSION["day_tmp"],$_SESSION["month_tmp"],$_SESSION["year_tmp"],-1)
												."&order1=".$_GET["order1"]."&order11=".$_GET["order11"]
												."&order2=".$_GET["order2"]."&order21=".$_GET["order21"].">";
				echo "<img src=\"iconos/icons/flecha3.gif\" border=0 title=\"Dia Anterior\"></a>";
		echo "</td>";

		//OPCIONES I.
		echo "<td>";

			echo "<table width=100%>";
				
				echo "<tr>";
					
					echo "<td class=headfb>"; 
						echo "<table align=center>";

							echo "<tr>";
								//ALINEAR DIA.
								echo "<td>";
									//echo "<a href=".$_SERVER["PHP_SELF"]."?event=set_day"	."&day="	.($_SESSION["day_tmp"])
									//														."&month="	.($_SESSION["month_tmp"])
									//														."&year="	.($_SESSION["year_tmp"])." class=encabezado-blue>Alinear Dia</a>";
									echo "<b>Alinear Dia</b>";
								echo "</td>";

								//REVISAR DIA.
								echo "<td>";
									echo "<a href=".$_SERVER["PHP_SELF"]."?event=review_day"."&day="	.($_SESSION["day_tmp"])
																							."&month="	.($_SESSION["month_tmp"])
																							."&year="	.($_SESSION["year_tmp"])
																							."&opt=news class=encabezado-blue>Revisar Dia</a>";
									//echo "<b>Revisar Dia</b>";
								echo "</td>";

							echo "</tr>";

							echo "<tr>";
								//COPIAR DIA.
								echo "<td>";
									echo "<a href=".$_SERVER["PHP_SELF"]."?event=cpy_day"	."&day="	.($_SESSION["day_tmp"])
																							."&month="	.($_SESSION["month_tmp"])
																							."&year="	.($_SESSION["year_tmp"])." class=encabezado-blue>Copiar Dia</a>";
								echo "</td>";

								//COPIA DIA AVANZADA.
								echo "<td>";
									echo "<a href=".$_SERVER["PHP_SELF"]."?event=cpy_day_avanz"."&day="		.($_SESSION["day_tmp"])
																							."&month="	.($_SESSION["month_tmp"])
																							."&year="	.($_SESSION["year_tmp"])." class=encabezado-blue>Copia Avanzada</a>";
									//echo "<b>Copia Avanzada</b>";
								echo "</td>";
							echo "</tr>";	
						echo "</table>";

					echo "</td>";
					
					//OPCIONES II - DIA DE LA SEMANA.
					echo "<td class=data colspan=1 align=center>"
						."<a href=".$_SERVER["PHP_SELF"]."?event=list_all_enf"	."&day=".($_SESSION["day_tmp"])
																				."&month=".($_SESSION["month_tmp"])
																				."&year=".($_SESSION["year_tmp"])
																				."&year=".($_SESSION["year_tmp"])
																				."&zona_desc=".urlencode("ZONA CIUDAD")
																				."&ubic=list_all_enf class=encabezado-green>"
									."<FONT SIZE=\"6\" face=\"Impact\"><b>"
									.day_week($_SESSION["day_tmp"],$_SESSION["month_tmp"],$_SESSION["year_tmp"])." - "
												.$_SESSION["day_tmp"]."/".$_SESSION["month_tmp"]."/".$_SESSION["year_tmp"]."</font></b></a>";
					
					echo "</td>";
	

					echo "<td>"; 
						echo "<table align=center>";

							//BORRAR DIA.
							echo "<tr>";
								echo "<td>";
									echo "<a href=".$_SERVER["PHP_SELF"]."?event=del_day"."&day="	.($_SESSION["day_tmp"])
																									."&month="	.($_SESSION["month_tmp"])
																									."&year="	.($_SESSION["year_tmp"])
																									." class=encabezado-blue> Borrar Dia</a>";
								echo "</td>";
							echo "</tr>";

							//BORRADO AVANZADO.
							echo "<tr>";
								echo "<td>";
									echo "<b>Borrado Avanzado</b>";
								echo "</td>";
							echo "</tr>";	
						echo "</table>";
					echo "</td>";
				echo "</tr>";

			echo "</table>";

		echo "</td>";
			
		//SIGUIENTE DIA.
		echo "<td>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=hrs_direct"
												."&date=".det_dia($_SESSION["day_tmp"],$_SESSION["month_tmp"],$_SESSION["year_tmp"],1)
												."&order1=".$_GET["order1"]."&order11=".$_GET["order11"]
												."&order2=".$_GET["order2"]."&order21=".$_GET["order21"].">";
				echo "<img src=\"iconos/icons/flecha4.gif\" border=0 title=\"Dia Siguiente\"></a>";
		echo "</td>";

		//SEMANA SIGUIENTE.
		echo "<td>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=hrs_direct"
												."&date=".det_dia($_SESSION["day_tmp"],$_SESSION["month_tmp"],$_SESSION["year_tmp"],7)
												."&order1=".$_GET["order1"]."&order11=".$_GET["order11"]
												."&order2=".$_GET["order2"]."&order21=".$_GET["order21"].">";
				echo "<img src=\"iconos/icons/flecha1.gif\" border=0 align=left title=\"Semana Posterior\"></a>";
		echo "</td>";
	echo "</tr>";

	
	echo "<tr>";
		echo "<td class=titulo colspan=8>";
			echo "<a href=".$_SERVER["PHP_SELF"]."?event=buscar_dato"	."&ubic=schedule"
																	."&fec_hora=".date("H")."##hora".date("H")." class=myButton>"
																	."Nuevo Registro</a>";
		echo "</td>";
	echo "</tr>";

echo "</table>";

?>
