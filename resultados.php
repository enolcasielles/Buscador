<!DOCTYPE html>
<html>
 
<head>
	<title>Title of the document</title>
	<script type="text/javascript">
    	var filtro = "<?php echo $_POST['filtro']; ?>";
	</script>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/index.js"> </script>
</head>

<body>


<?php

session_start();

if (isset($_SESSION['usuario'])) {
	?>
	  <div class="buscadorSuperior">
		<form action="resultados.php" method="post">
  			Buscar
  			<input class="anchoMedio" type="text" name="filtro" value="" />
  			<input class="botonDerecha" type="submit" value="Buscar" />
		</form>
	  </div>

	  <div id="resultados">
	  	
	  </div>

	  <div class="paginas">
        <ul>
           <li><a id="izquierdaPag" onclick="getEnlaces(1,2)">1</a></li>
           <li><a id="medioPag" onclick="getEnlaces(4,2)">2</a></li>
           <li><a id="derechaPag" onclick="getEnlaces(7,2)">3</a></li>
           <li><a id="derechaPag" onclick="getEnlaces(10,2)">4</a></li>
           <li><a id="derechaPag" onclick="getEnlaces(13,2)">5</a></li>
        </ul>
      </div>
	<?php
}

else {
	?>
	<p> ACCESO RESTRINGIDO </p>
	<a href="login.php"/>
	<?php
}


?>


</body>

</html>