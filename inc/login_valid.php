<?php

//$conn=connect($_POST["usr"], "");

//echo $_POST["passwd"];
//echo $_POST["usr"];
//break;
//echo "HOLA";

$conn=newConnect();

$res=mysqli_query($conn,"select * from usuario"
					." WHERE usr_pswd = '".$_POST["passwd"]."'"
					." AND usr_name ='".$_POST["usr"]."'");

if($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){

	$_SESSION["user"]=$_POST["usr"];				//Asign user name or logname.
	$_SESSION["usr_pswd"]=$_POST["passwd"];			//Asign passwd.

	$_SESSION["usr_role"]=	$row["usr_role"];	//Determine role and level, and mat  for operations and permissions.
	$_SESSION["usr_level"]=	$row["usr_level"];
	$_SESSION["usr_mat"]=	$row["usr_mat"];

	$_SESSION["apps"]=$row["apps"];

	$_SESSION["day_tmp"]=date("d");
	$_SESSION["month_tmp"]=date("m");
	$_SESSION["year_tmp"]=date("Y");

	if($_SESSION["user"]=="franky" || $_SESSION["user"]=="mariela" || $_SESSION["user"]=="root"|| $_SESSION["user"]=="ariel"){
		header("Location:".$_SERVER["PHP_SELF"]."?event=menu_user");	//Redirect to Ppal Menu.
	}else{
		//echo date("H");
		if(date("H")<=15){
			header("Location:".$_SERVER["PHP_SELF"]."?event=menu_user");	//Redirect to Ppal Menu.
		}else{
			header("Location:".$_SERVER["PHP_SELF"]."?event=logout");		//Redirect to Login for invalid login.
			//echo "FUERA DE HORARIO";
		}
	}

	//log_write($_SESSION["user"],$_SESSION["user"].":(".date("Y-m-d h:i:s").")","ingreso","INGRESO AL SISTEMA");

}else{
	header("Location:".$_SERVER["PHP_SELF"]."?event=logout");		//Redirect to Login for invalid login.
}
?>
