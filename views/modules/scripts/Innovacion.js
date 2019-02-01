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
	
	$.post("../../ajax/vistasglobanes.php?op=formacion", function(r){
		$("#continua").html(r);

	});

	$.post("../../ajax/vistasglobanes.php?op=area", function(r){
		$("#area").html(r);

	});
	
	

}

//Función limpiar
function limpiar()
{
	
	
    $("#Formacion").val("");
    $("#continua").val("");
	$("#nombre").val("");
	$("#institucion").val("");
    $("#year").val("");
    $("#horas").val("");
    

    $("#campo").val("");
    $("#area").val("");
    $("#diciplina").val("");
    $("#subdiciplina").val("");

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
					url: '../../ajax/otros.php?op=listar',
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
		url: "../../ajax/otros.php?op=guardaryeditar",
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

function mostrar(estudioRealizados)
{
	$.post("../../ajax/otros.php?op=mostrar",{estudioRealizados : estudioRealizados}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

       
			
		$("#estudiosRealizado").val(data.estudioRealizados);
        $("#Formacion").val("");
        $("#continua").val("");
        $("#nombre").val("");
        $("#institucion").val("");
        $("#year").val("");
        $("#horas").val("");
        
    
        $("#campo").val("");
        $("#area").val("");
        $("#diciplina").val("");
        $("#subdiciplina").val("");
	
      
        

 	});
}





init();




