<?php 
	
	//Incluyo el archivo para establecer la conexion
	require("conexion_bd.php");
	
	//Compruebo si tengo algun dato por post
	if (empty($_POST)) { //Si esta vacia muestro el formulario de envio (prueba de script)
		?>
		<h1>Debug buscador</h1>
		<form action="busca_enlaces.php" method="post">
  			Buscar
  			<input type="text" name="filtro" value="" />
  			<br/>
  			Primer resultado
  			<input type="text" name="inicio" value="" />
  			<br/>
  			Numero resultados
  			<input type="text" name="numResultados" value="" />
  			<br/>
  			<input type="submit" value="Buscar" />
		</form>
        <?php
	}
	
	else { //Si tiene datos tendre que validarlos

		//Recupero el texto a bucar
		$texto = $_POST['filtro'];

		//Recupero el numero de resultados que quiere recuperar y el indice a partir del cual los quiere
		$inicio = $_POST['inicio'];
		$numResultados = $_POST['numResultados'];

		//Genero el query
		$query = "SELECT * FROM enlaces WHERE titulo LIKE :filtro";
		$query_params = array(
					  ':filtro' => '%'.$texto.'%');
			
		//Intento enviar la solicitud
		try {
			$tmp = $db->prepare($query);
			$result = $tmp->execute($query_params);
		} catch (PDOException $ex) {
			//Si se produce algun error finalizamos enviando el aviso
			$respuesta["resultado"] = 0;
			$respuesta["mensaje"] = "Error al obtener los resultados de la base de datos: " .$ex->getMessage();
			$respuesta["datos"] = array();
			die(json_encode($respuesta));
		}
		
		//Si llega aqui la solicitud se habra realizado correctamente. Proceso el resultado
		$rows = $tmp->fetchAll();
		if ($rows) {
			
			$respuesta["resultado"] = 1;
			$respuesta["mensaje"] = "Respuesta obtenida correctamente ";
			$respuesta["datos"] = array();   //Inicio un array vacio en el que ire introduciendo los datos
			$contador = 0;
			
			foreach ($rows as $row) {

				$contador++;
				
				if ($contador < $inicio) continue;
				if ($contador - $inicio > $numResultados) break;


				$datosResultado = array(
						'titulo' => $row['titulo'],
						'descripcion' => $row['descripcion'],
						'direccion' => $row['direccion'],
				);

				array_push($respuesta["datos"],$datosResultado);

			}
			
			die(json_encode($respuesta));
			
		}
		
		else {

			$respuesta["resultado"] = 0;
			$respuesta["mensaje"] = "No se encontro ningun resultado";
			$respuesta["datos"] = array();
			die(json_encode($respuesta));
		}
				
	}