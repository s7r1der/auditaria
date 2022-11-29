<link rel="StyleSheet" href="css/schedule.css" type="text/css">
<?php


function leer_contenido_completo($url){
   //abrimos el fichero, puede ser de texto o una URL
   $fichero_url = fopen ($url, "r");
   $texto = "";
   //bucle para ir recibiendo todo el contenido del fichero en bloques de 1024 bytes
   while ($trozo = fgets($fichero_url,filesize($url))){
     // $texto .= $trozo."<br>";
     if(strpos($trozo, "op=INSERT INTO op2018cuidados")==true){
     	$trozo1=substr($trozo,6);
		$texto .= $trozo1.";<br>";      		
     }

   }
   return $texto;
} 

echo leer_contenido_completo("logs/ruben-05-log.php");

?>
