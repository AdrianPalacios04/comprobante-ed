<!DOCTYPE html>
 <html>
 <head>
 <meta charset="utf-8" />
 <title></title>
 </head>
 <body>
<?php

$currentDateTime = date('Y-m-d H:i:s');


if (file_exists("1.txt")) 
{
	
    $mysqli = new mysqli("industriasdq.com", "industri_prueba", "LnO0D2Urxdff", "industri_comprobante_prueba");
	if ($mysqli->connect_errno) 
	{
		echo "Falló la conexión con MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	// $mysqli->query("INSERT INTO sif_act_estado (fechainicio, estado) values (NOW(),'A');");
	// $resultado = $mysqli->query("SELECT id FROM sif_act_estado ORDER BY id DESC LIMIT 1");
	// $resultadoid = 0;
	
	// for ($num_fila = $resultado->num_rows - 1; $num_fila >= 0; $num_fila--) 
	// {
	// 	$resultado->data_seek($num_fila);
	// 	$fila = $resultado->fetch_assoc();
	// 	$resultadoid = $fila['id'];
	// }

    // $estado = 0;
	
	$fp = fopen("1.txt", "r");
	while (!feof($fp))
	{
		$linea = fgets($fp);
		if ($linea <> "") 
		{  
			if (!$mysqli->query($linea)) 
			{   echo "Error el ejecutar sentencia: (" . $linea . ")";
				break; 
			}else{
			}
		}
	}
	// rename ("1.txt", (string)date('YmdHis') . ".txt");
	fclose($fp);
				
	// 	$linea  = "UPDATE sif_act_estado set fechafin = NOW(), estado = 'T' where id = " . (string)$resultadoid;
	// 	if (!$mysqli->query($linea)) 
	// 	{
			
	// 	}



	// rename ("1.txt", (string)date('YmdHis') . ".txt");

	// $currentDateTime2 = date('Y-m-d H:i:s');				

	// echo "<br>";
	// echo $currentDateTime;
	// echo "<br>";


	// 	echo "Listo";

	// echo "<br>";
	// echo $currentDateTime2;

} 
else 
{
	// echo $currentDateTime;
	// echo "<br>";
    echo "El fichero no existe";
}

?>
 
</body>
 
</html>