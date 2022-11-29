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

if(isset($_GET["usr"])){
	$_POST["usr"]=$_GET["usr"];
	$_POST["passwd"]=encryptar(urldecode($_GET["ps"]),2);
	$_POST["event"]="Acceder";
}

session_start();
session_set_cookie_params(0);

$_SESSION["day"]=date("d");
$_SESSION["month"]=date("m");
$_SESSION["year"]=date("Y");

if(!isset($_SESSION["usr_role"])){
	if(isset($_POST["event"])){
				 if($_POST["event"]=="Acceder")
					login_valid();
	}else{
		include("inc/header.php");
		login_form();
	}		
}else{
	connect($_SESSION["user"],"");
	resolv();
}
?>
