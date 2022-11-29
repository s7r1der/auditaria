<?php
//phpinfo();

// include function prototypes.
function login_valid()	{	include("inc/login_valid.php");		}
function login_form()	{	include("inc/login_form.php");		}
function resolv()			{	include("inc/resolv.inc.php");		}
function menu_record()	{	include("inc/menu_record.php");		}
function menu_states()	{	include("inc/menu_states.php");		}
function menu_evol()		{	include("inc/menu_evolutions.php");	}
function menu_innov()	{	include("inc/menu_innovations.php");}
function menu_logbook()	{	include("inc/menu_logbook.php");		}
function style()			{	include("inc/style.css");				}
function connect($user, $passwd){
	include("inc/connect.inc.php");
}

include("inc/syntax.inc.php");

/*session_start();
session_set_cookie_params(0);*/

/*$_SESSION["day"]=date("d");
$_SESSION["month"]=date("m");
$_SESSION["year"]=date("Y");*/
//$_SESSION["usr_role"]=$_GET["usr_role"];

$_POST["usr"]=$_GET["usr"];
$_POST["passwd"]=encryptar(urldecode($_GET["ps"]),2);

//echo $_SESSION["usr_role"];

if(!isset($_SESSION["usr_role"])){
	echo $_SERVER["PHP_SELF"];
	//echo $_POST["passwd"];

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
	
		$_SESSION["day_tmp"]=date("d");
		$_SESSION["month_tmp"]=date("m");
		$_SESSION["year_tmp"]=date("Y");
		
		echo "ESTAMOS";
		if($_SESSION["user"]=="romeo" || $_SESSION["user"]=="mariela" || $_SESSION["user"]=="root"|| $_SESSION["user"]=="ariel"){
			include("inc/header.php");
			if($_GET["event"]!="viewdetxos")include("inc/proheader.php");		
			include("inc/menu_user-act.php");
			//header("Location:http://167.99.80.17/auditaria/index.php?event=menu_user");	//Redirect to Ppal Menu.
		}else{
			header("Location:http://167.99.80.17/auditaria/index.php?event=logout");		//Redirect to Login for invalid login.
				//echo "FUERA DE HORARIO";
		}
	}
}
?>
