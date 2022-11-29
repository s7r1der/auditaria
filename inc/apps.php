<link rel="StyleSheet" href="css/forms.css" type="text/css">

<?php

$pass_tmp=explode("-",$_SESSION["apps"]);

echo "<table class=myTable-gray>";
	echo "<tr>";
		echo "<td>-</td>";

		echo "<td align=right>";
			if($pass_tmp[0])	
				echo "<a href=http://138.68.29.91/enfermeria/index.php?event=menu_user"
				."&usr=".$_SESSION["user"]
				."&ps=".urlencode(encryptar($_SESSION["usr_pswd"],1))." class=linkg>"
				."<font size=3><b>GRAL</b></a>";
			else
				echo "<font size=3 color=white><b>GRAL</b>";
		
		echo "</td>";
		echo "<td>-</td>";

		echo "<td align=right>";
			if($pass_tmp[1])	
				echo "<a href=http://138.68.29.91/eci/index.php?event=menu_user"
						."&usr=".$_SESSION["user"]
						."&ps=".urlencode(encryptar($_SESSION["usr_pswd"],1))." class=linkg>"
						."<font size=3><b>ECI</b></a>";
			else
				echo "<font size=3 color=white><b>ECI</b>";
		
		echo "</td>";
		echo "<td>-</td>";

		echo "<td align=right>";
			if($pass_tmp[2])	
				echo "<a href=http://138.68.29.91/socios/index.php?event=menu_user"
				."&os=SEMA"
				."&usr=".$_SESSION["user"]
				."&ps=".urlencode(encryptar($_SESSION["usr_pswd"],1))." class=linkg>"
				."<font size=3><b>SEMA</b></a>";
			else 
				echo "<font size=3 color=white><b>SEMA</b>";

		echo "</td>";
		echo "<td>-</td>";
		
		echo "<td align=right>";
			if($pass_tmp[3])	
				echo "<a href=http://138.68.29.91/socios/index.php?event=menu_user"
				."&os=ECI"
				."&usr=".$_SESSION["user"]
				."&ps=".urlencode(encryptar($_SESSION["usr_pswd"],1))." class=linkg>"
				."<font size=3><b>ECI1</b></a>";
			else 
				echo "<font size=3 color=white><b>ECI1</b>";
		
		echo "</td>";
		echo "<td>-</td>";

		echo "<td align=right>";
			if($pass_tmp[4])	
				echo "<a href=http://138.68.29.91/socios/index.php?event=menu_user"
				."&os=FOMZA"
				."&usr=".$_SESSION["user"]
				."&ps=".urlencode(encryptar($_SESSION["usr_pswd"],1))." class=linkg>"
				."<font size=3><b>FOMZA</b></a>";
			else 
				echo "<font size=3 color=white><b>FOMZA</b>";
		
		echo "</td>";
		echo "<td>-</td>";

		echo "<td align=right>";
			if($pass_tmp[5])	
				echo "<a href=http://138.68.29.91/socios/index.php?event=menu_user"
				."&os=SOE"
				."&usr=".$_SESSION["user"]
				."&ps=".urlencode(encryptar($_SESSION["usr_pswd"],1))." class=linkg>"
				."<font size=3><b>SOE</b></a>";
			else 
				echo "<font size=3 color=white><b>SOE</b>";
		
		echo "</td>";
		echo "<td>-</td>";

		echo "<td align=right>";
			if($pass_tmp[6])	
				echo "<a href=http://138.68.29.91/socios/index.php?event=menu_user"
				."&os=CHESTER"
				."&usr=".$_SESSION["user"]
				."&ps=".urlencode(encryptar($_SESSION["usr_pswd"],1))." class=linkg>"
				."<font size=3><b>CHESTER</b></a>";
			else 
				echo "<font size=3 color=white><b>CHESTER</b>";
		
		echo "</td>";
		echo "<td>-</td>";
		
		echo "<td align=right>";
			if($pass_tmp[7])	
				echo "<a href=http://138.68.29.91/farmacia/index.php?event=menu_user"
				."&usr=".$_SESSION["user"]
				."&ps=".urlencode(encryptar($_SESSION["usr_pswd"],1))." class=linkg>"
				."<font size=3><b>FARM</b></a>";
			else 
				echo "<font size=3 color=white><b>FARM</b>";
		
		echo "</td>";
		echo "<td>-</td>";

		echo "<td align=right>";
			if($pass_tmp[8])	
				echo "<a href=http://167.99.80.17/auditaria/index.php?event=menu_user"
						."&usr=".$_SESSION["user"]
						."&ps=".urlencode(encryptar($_SESSION["usr_pswd"],1))." class=linkg>"
					."<font size=3><b>TARIA</b></a>";
			else 
				echo "<font size=3 color=white><b>TARIA</b>";

		echo "</td>";
		echo "<td>-</td>";

		echo "<td align=right>";
			if($pass_tmp[9])	
				echo "<a href=http://167.99.80.17/auditoria/index.php?event=menu_user"
						."&usr=".$_SESSION["user"]
						."&ps=".urlencode(encryptar($_SESSION["usr_pswd"],1))." class=linkg>"
					."<font size=3><b>TORIA</b></a>";
			else 
				echo "<font size=3 color=white><b>TORIA</b>";		
		
		echo "</td>";
		echo "<td>-</td>";

		echo "<td align=right>";
			if($pass_tmp[10])	
				echo "<a href=http://167.99.80.17/laboratorio/index.php?event=menu_user"
					."&usr=".$_SESSION["user"]
					."&ps=".urlencode(encryptar($_SESSION["usr_pswd"],1))." class=linkg>"
					."<font size=3><b>LAB.</b></a>";
			else 
				echo "<font size=3 color=white><b>LAB.</b>";

		echo "</td>";
		echo "<td>-</td>";

		echo "<td align=right>";
			if($pass_tmp[11])	
				echo "<a href=http://167.99.80.17/losandes/index.php?event=menu_user"
					."&usr=".$_SESSION["user"]
					."&ps=".urlencode(encryptar($_SESSION["usr_pswd"],1))." class=linkg>"
					."<font size=3><b>DROG.</b></a>";
			else 
				echo "<font size=3 color=white><b>DROG.</b>";

		echo "</td>";
		echo "<td>-</td>";

		echo "</tr>";
echo "</table>";
					
?>