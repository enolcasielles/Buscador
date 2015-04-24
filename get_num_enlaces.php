<?php 

	//Conecto a la base de datos
	require("conexion_bd.php"); 
	
	//Preparo la solicitud
	$query = "SELECT * FROM enlaces";
	
	//Intento el envio
	try {
		$stmp = $db->prepare($query);
		$result = $stmp->execute($query_params);
	}
	catch(PDOException $ex) {
		$respuesta["resultado"] = 0;
		$respuesta["mensaje"] = "Error al obtener el numero de enlaces";
		die(json_encode($respuesta));
	}
	
	//Proceso el resultado
	$rows = $stmp->fetchAll();
	if ($rows) { //Preparo el array con la respuesta

		$numResultados = count($rows);
		$respuesta['resultado'] = 1;
		$respuesta['mensaje'] = $numResultados;
		die(json_encode($respuesta));
		
	}
	
	else {  //No hay resutados
		$respuesta["resultado"] = 0;
		$respuesta["mensaje"] = "0";
		die(json_encode($respuesta));
	}

	
?>