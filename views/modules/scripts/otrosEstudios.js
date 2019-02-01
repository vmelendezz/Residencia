var tabla;



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

	$("#area").change(function() {
        $("#area option:selected").each(function(r) {
            area = $(this).val();
            $.post("../../ajax/vistasglobanes.php?op=campo", { area: area }, function(data) {
                $("#campo").html(data);

                $("#campo option:selected").each(function(r) {
                    campos = $(this).val();
                    $.post("../../ajax/vistasglobanes.php?op=disciplina", { campos: campos }, function(data) {
                        $("#disciplina").html(data);

                        $("#disciplina option:selected").each(function(r) {
                            disciplina = $(this).val();
                            $.post("../../ajax/vistasglobanes.php?op=subdisciplina", { disciplina: disciplina }, function(data) {
                                $("#subdisciplina").html(data);
                            });
                        });
                    });
                });



            });
        });
    })
	
	

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
					url: '../../ajax/otrosEstudios.php?op=listar',
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
		url: "../../ajax/otrosEstudios.php?op=guardaryeditar",
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

function mostrar(Formacion)
{
	$.post("../../ajax/otrosEstudios.php?op=mostrar",{Formacion : Formacion}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

       
			
		$("#Formacion").val(data.otroestudio);
    	$("#continua").val(data.formacion);
		$("#nombre").val(data.nombre);
		$("#institucion").val(data.instituto);
    	$("#year").val(data.year);
    	$("#horas").val(data.horas);
		$("#area").val(data.area);
    	$("#campo").val(data.campo);
    	$("#disciplina").val(data.disciplina);
    	$("#subdisciplina").val(data.subdisciplina);
	 
      
        

 	});
}

function borrar(Formacion) {

    bootbox.confirm('¿Está Seguro que desea borrar este registro?', function(result) {
        if (result) {
            $.post("../../ajax/otrosEstudios.php?op=borrar", { Formacion: Formacion },
                function(e) {
                    alertify.alert(e);
                    tabla.ajax.reload();
                }
            );
        }
    });
}



init();




