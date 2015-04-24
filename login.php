<!DOCTYPE html>
<html>
 
<head>
	<title>Buscador</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>


<?php

	//Compruebo si tengo algun dato por post
	if (empty($_POST)) { //Si esta vacia muestro el formulario de envio
		mostrar_formulario();
	}
	
	else {   //Comprobamos que los datos sean correctos
		
		//Compruebo que el user y password contengan datos
		if (empty($_POST['usuario']) || empty($_POST['contrasena'])) {  //Indico que los datos estan incompletos y vuelvo a mostrar el formulario
			echo "<p> Formulario incompleto </p>";
			mostrar_formulario();
		}
		
		else {
			if ($_POST['usuario'] == "estudiante-mam" && $_POST['contrasena'] == "testsesionesphp") {   //Datos correctos
				?>
				<p>Login correcto</p>
				<a href="principal.php"> Acceder </a>
				<?php
				session_start();
				$_SESSION['usuario'] = $_POST['usuario'];
				header("Location: principal.php");
			}
			else {
				echo "<p> Datos incorrectos </p>";
				mostrar_formulario();
			}
		}
	
	}



function mostrar_formulario() {
		?>
		<div id="login" class="centrar">
         <form action="login.php" method="post">
            Login:<br />
            <input type="text" name="usuario" />
            <br /><br />
            Password:<br />
            <input type="password" name="contrasena"  />
            <br /><br />
            <input class="botonDerecha" type="submit" value="Entrar" />
         </form>
    	 </div>
        <?php
}

?>




</body>

</html>