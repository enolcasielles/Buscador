<?php 


	//Incluimos el script con la conexion al servidor
	require("conexion_bd.php");

	if (empty($_POST)) {  //No se han enviado datos, muestro el formulario de registro (pruebas)
		?>
		<h1> Insertar enlace </h1>
		<form action="anade_enlace.php" method="post">
		  Direccion <input type="text" name="direccion" /> <br/>
		  Descripcion <input type="text" name="descripcion" /> <br/>
		  Titulo <input type="text" name="titulo" /> <br/>
		  <input type="submit" value="Insertar enlace" />
		</form>
		<?php	
	}
	
	else {
		
		//Compruebo que se hayan enviado los datos
		if (empty($_POST['titulo']) || empty($_POST['direccion']) || empty($_POST['descripcion']) ) {
			$respuesta["resultado"] = 0;
			$respuesta["mensaje"] = "Error. Faltan datos";
			die(json_encode($respuesta));
		}
		
		else {
			//Preparo la solucitud
			$query = "INSERT INTO enlaces ( titulo, direccion, descripcion ) VALUES ( :titulo, :direccion, :descripcion)";
			//Establezco los parametros
			$query_params = array(
				':titulo' => $_POST['titulo'],
				':direccion' => $_POST['direccion'],
				':descripcion' => $_POST['descripcion']
			);
			
			//Intentamos el envio de la solicitud
			try {
				$stmp = $db->prepare($query);
				$result = $stmp->execute($query_params);
			}
			catch (PDOException $ex) {
				//Informo del posible error
				$respuesta["resultado"] = 0;
				$respuesta["mensaje"] = "Error. Problema enviando datos";
				die(json_encode($respuesta));
			}
			
			//Si llega aqui se habra efectuado correctamente.
			$respuesta["resultado"] = 1;
			$respuesta["mensaje"] = "Enlace insertado correctamente";
			die(json_encode($respuesta));
		}
		
	}
	
?>