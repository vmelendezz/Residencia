var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();


	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	

	$.post("../../ajax/vistasglobanes.php?op=instancia", function(r){
		$("#instancia").html(r);

	});

	

}

//Función limpiar
function limpiar()
{
	
    $("#estancia").val("");
    
	$("#nombre").val("");
    $("#inicio").val("");
    $("#fin").val("");

	$("#logros").val("");
    $("#instancia").val("");
    

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
					url: '../../ajax/EstudioRealizados.php?op=listar',
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
		url: "../../ajax/Estanciasprofesionales.php?op=guardaryeditar",
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

function mostrar(id_usuario)
{
	$.post("../../ajax/EstudioRealizados.php?op=mostrar",{id_Estudio_Realizados : id_Estudio_Realizados}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#id_usuario").val(data.id_usuario);
       
        $("#id_Estudio_Realizados").val(data.id_Estudio_Realizados);
        $("#nivel").val(data.id_nivel_de_estudio);
        $("#tipoinstituto").val(data.id_tipo_instituto);
        $("#instituto").val(data.nombreinstituto);
        $("#no_cedula").val(data.no_cedula);
        $("#siglas_del_estudios").val(data.siglas_del_estudios);
        $("#fecha_inicio").val(data.fecha_inicio);
        $("#fecha_fin").val(data.fecha_fin);
        $("#fecha_obtencion").val(data.fecha_obtencion);
        $("#periodo").val(data.periodo);
        $("#campo").val(data.campo);
        $("#area").val(data.area);
        $("#diciplina").val(data.diciplina);
        $("#subdiciplina").val(data.subdiciplina);
        

 	})
}






init();