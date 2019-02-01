var tabla;


/* $(document).ready(function(){

	$("#area").change(function(){
		area_id=$(this).val();
		alert (area_id);

			$.post("../../ajax/vistasglobanes.php?op=campo",{area_id:area}, function(e){
				$("#area").html(r);
		
			});
	});

}); */

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();


	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	
	$.post("../../ajax/vistasglobanes.php?op=idiomas", function(r){
		$("#nombreidioma").html(r);

	});

	
	

}

//Función limpiar
function limpiar()
{
	
	
    $("#idioma").val("");
    $("#nombreidioma").val("");
    $("#grado").val("");
	$("#nivel").val("");
	$("#lectura").val("");
    $("#escritura").val("");
    $("#certificacion").val("");
    $("#evaluacion").val("");
    $("#documento").val("");
    $("#vigenciainicio").val("");
    $("#grado").val("");


    $("#vigenciafin").val("");
    $("#puntos").val("");
    $("#conferido").val("");
    $("#institucion").val("");


    

    

}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
	
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}


//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	
		"ajax":
				{
					url: '../../ajax/idiomas.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../../ajax/idiomas.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idioma)
{
	$.post("../../ajax/idiomas.php?op=mostrar",{idioma : idioma}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

       
			
			
        $("#idioma").val(data.idiomas);
        $("#nombre").val(data.nombre);
        $("#grado").val(data.GradoDominio);
        $("#nivel").val(data.nivelConversacion);
        $("#lectura").val(data.nivelLectura);
        $("#escritura").val(data.nivelEscritura);
        $("#certificacion").val(data.Certificacion);
        $("#evaluacion").val(data.fechaEvaluacion);
        $("#documento").val(data.documento);
        $("#vigenciainicio").val(data.VigenciaInicio);
        $("#vigenciafin").val(data.VigenciaInicio);
        $("#puntos").val(data.Puntos);
        $("#conferido").val(data.nivelConferido);

        $("#institucion").val(data.institucion);

	
      
        

 	});
}





init();




