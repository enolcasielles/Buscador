

$(document).ready(function() {

	//Cuando la pagina se haya cargado recuperamos los 3 primeros resultados
	getEnlaces(1,2);

  //En rpincipio la ventana de mostrar enlaces estara oculta
  anadirEnlace(false);


})



function getEnlaces(inicio, numResultados) {

	//Recuperamos por ajax los resultados
	$.post( "busca_enlaces.php", { filtro: filtro , inicio : inicio , numResultados : numResultados }, function( data ) {

  		var datos = data.datos;  //Almaceno los datos localmente

      $("#resultados").text("");
      //Recorro todo el array añadiendolos al contenedor
      numeroPaginas = datos.length;
  		for (var i=0 ; i<datos.length ; i++) {
  			var titulo = datos[i].titulo;
  			var descripcion = datos[i].descripcion;
  			var direccion = datos[i].direccion;
  			console.log("titulo: " + titulo + " Descripcion: " + descripcion + " Direccion: " + direccion);
  			$("#resultados").append("<div> <h4>" + titulo + "</h4>" + descripcion + "<br/> <br/> <a>" +  direccion + "</a> </div>");
        $("#resultados div a").last().attr("href",direccion);
  		}

	}, "json");

}



function anadirEnlace(mostrar) {

  if (mostrar) {
      $("#anadirEnlaceForm").show();
      $("#buscadorCentrado").hide();
      $("body").css("background-color", "#0B4C5F");
  }
  else {
      $("#anadirEnlaceForm").hide();
      $("#buscadorCentrado").show();
      $("body").css("background-color", "#A9D0F5");
  }

}



function enviaPeticionAnadeEnlace() {

  //Recuperamos los datos del formulario
  var titulo = $("#tituloForm").val();
  var direccion = $("#direccionForm").val();
  var descripcion = $("#descripcionForm").val();
  $.post( "anade_enlace.php", { titulo: titulo , direccion : direccion , descripcion : descripcion }, function( data ) {

      console.log(data.mensaje);
      if (data.resultado == "1") {  //Se ha insertado correctamente
        anadirEnlace(false);
      }

  }, "json");

}

