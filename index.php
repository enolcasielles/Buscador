<!DOCTYPE html>
<html>
 
<head>
	<title>Buscador</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/index.js"> </script>
</head>


<body onLoad="anadirEnlace(false)">

<?php


session_start();

if (isset($_SESSION['usuario'])) {
	?>
	<div id="bienvenida">
		Bienvenido <?php echo $_SESSION['usuario']; ?> . Tienes <?php $enlaces = get_num_enlaces(); echo $enlaces; ?> enlaces guardados hasta ahora
		<button id="anadirEnlace" class="botonDerecha fondoVerde" onclick="anadirEnlace(true)">Añadir enlace</button>
	</div>

	<div id="buscadorCentrado" class="centrar">
		<form action="resultados.php" method="post">
  			Buscar
  			<input type="text" name="filtro" value="" />
  			<br/>
  			<br/>
  			<input class = "botonDerecha" type="submit" value="Buscar" />
		</form>
	</div>

	<div id="anadirEnlaceForm" class="centrar">
			<h3> Añadir enlace </h3>
  			Direccion
  			<input id="direccionForm" type="text" name="direccion" value="" />
  			<br/>
  			<br/>
  			Titulo
  			<input id="tituloForm" type="text" name="titulo" value="" />
  			<br/>
  			<br/>
  			Descripcion
  			<input id="descripcionForm" type="text" name="titulo" value="" />
  			<br/>
  			<br/>
  			<button id="confirmar" class="botonIzquierda fondoVerde" onclick="enviaPeticionAnadeEnlace()">Añadir enlace</button>
  			<button id="cancelar" class="botonIzquierda" onclick="anadirEnlace(false)">Cancelar</button>
	</div>
	<?php
}

else {
	header("Location: login.php");
}



function get_num_enlaces() {

	//Conecto a la base de datos
	require("conexion_bd.php");
	
	//Preparo la solicitud
	$query = "SELECT * FROM enlaces";
	
	//Intento el envio
	try {
		$stmp = $db->prepare($query);
		$result = $stmp->execute();
	}
	catch(PDOException $ex) {
		return -1;
	}
	
	//Proceso el resultado
	$rows = $stmp->fetchAll();
	if ($rows) { //Preparo el array con la respuesta

		$numResultados = count($rows);
		return $numResultados;
		
	}
	
	else {  //No hay resutados
		return -2;
	}

}

?>


</body>

</html>