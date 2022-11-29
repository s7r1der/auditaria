 <html>
<!--<META HTTP-EQUIV="Pragma" CONTENT="no-cache"> -->
<head>
	<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
 	<script type="text/javascript">

		jQuery(function($){
			$.datepicker.regional['es'] = {
				closeText: 'Cerrar',
				prevText: '&#x3c;Ant',
				nextText: 'Sig&#x3e;',
				currentText: 'Hoy',
				monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
				'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
				monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
				'Jul','Ago','Sep','Oct','Nov','Dic'],
				dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
				dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
				dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
				weekHeader: 'Sm',
				dateFormat: 'dd/mm/yy',
				firstDay: 1,
				isRTL: false,
				showMonthAfterYear: false,
				yearSuffix: ''};
			$.datepicker.setDefaults($.datepicker.regional['es']);
		});    

		        $(document).ready(function() {
		           $("#datepicker").datepicker();
		        });
    </script>

	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>	
	<title>SISTEMA 2.0</title>
	
</head>

<body bgcolor="gray">

<!--<script type="text/javascript">

var subs_array = new Array("sub1","sub2","sub3");

function displaySubs(the_sub){
	if (document.getElementById(the_sub).style.display==""){
	document.getElementById(the_sub).style.display = "none";return
  }
  for (i=0;i<subs_array.length;i++){
	var my_sub = document.getElementById(subs_array[i]);
	my_sub.style.display = "none";
	}
  document.getElementById(the_sub).style.display = "";
  }

//if(history.forward(1)){
//	history.replace(history.forward(1));
//}

</script>-->

