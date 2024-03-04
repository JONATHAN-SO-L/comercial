//Función para recuperar el edificio en base a la empresa que se seleccione
$(document).ready(function(){
	$("#empresa_lev").change(function () {

		$('#edificio_lev').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

		$("#empresa_lev option:selected").each(function () {
			id = $(this).val();
			$.post("../../../config/functions/search/buscar_edificio.php", { id: id }, function(data){
				$("#edificio_lev").html(data);
			});            
		});
	})
});