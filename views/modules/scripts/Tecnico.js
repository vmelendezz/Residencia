var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
    });
    
    $.post("../../ajax/vistasglobanes.php?op=selectcvu", function(r){
		$("#cvu").html(r);

	});
	
}

//Función limpiar
function limpiar()
{	$("#nombre").val("");
    $("#tecnico").val("");
    $("#institucion").val("");
    $("#fechaEntrega").val("");
    $("#fechaPublicacion").val("");
    $("#paginas").val("");
    $("#descripcion").val("");
    $("#objetivos").val("");
    $("#palabraclave1").val("");
    $("#palabraclave2").val("");
    $("#palabraclave3").val("");
    $("#Origen").val("");
    $("#apoyoConacyt").val("");
    $("#fondo").val("");
    

	
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
					url: '../../ajax/Tecnico.php?op=listar',
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
		url: "../../ajax/Tecnico.php?op=guardaryeditar",
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

function borrar(tecnico)
{
	bootbox.confirm("¿Está Seguro de borrar?", function(result){
		if(result)
        {
        	$.post("../../ajax/Tecnico.php?op=borrar", {tecnico : tecnico}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function mostrar(tecnico)
{
	$.post("../../ajax/Tecnico.php?op=mostrar",{tecnico : tecnico}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		
        
		$("#tecnico").val(data.tecnico);
		$("#nombre").val(data.nombre);
        $("#institucion").val("");
        $("#fechaEntrega").val("");
        $("#fechaPublicacion").val("");
        $("#paginas").val("");
        $("#descripcion").val("");
        $("#objetivos").val("");
        $("#palabraclave1").val("");
        $("#palabraclave2").val("");
        $("#palabraclave3").val("");
        $("#Origen").val("");
        $("#apoyoConacyt").val("");
        $("#fondo").val("");



 	})
}






init();