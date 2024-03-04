//Función para recuperar la ubicación en base al edificio que se seleccione
$(document).ready(function(){
	$("#edificio_lev").change(function () {

		$('#ubicacion_lev').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

		$("#edificio_lev option:selected").each(function () {
			id = $(this).val();
			$.post("../../../config/functions/search/buscar_ubicacion.php", { id: id }, function(data){
				$("#ubicacion_lev").html(data);
			});            
		});
	})
});