var tabla;



//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();


    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    $.post("../../ajax/vistasglobanes.php?op=tipoEstancia", function(r) {
        $("#tipo").html(r);

    });
   

    // codico del area de conocimiendo
    $.post("../../ajax/vistasglobanes.php?op=area", function(r) {
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

    // fin del codico del area de conocimiendo







}





//Función limpiar
function limpiar() {


    $("#estancia").val("");
    $("#nombre").val("");
    $("#institucion").val("");
    $("#fechainicio").val("");
    $("#fechafin").val("");
    $("#tipo").val("");
    $("#logro").val("");
    

    $("#campo").val("");
    $("#area").val("");
    $("#disciplina").val("");
    $("#subdisciplina").val("");

}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();


    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}


//Función Listar
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla

        "ajax": {
            url: '../../ajax/estanciaInvestigacion.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5, //Paginación
        "order": [
                [0, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
}
//Función para guardar o editar

letras = /^([aA-zZÁÉÍÓÚñáéíóú]+[\s]*)+$/i;
letrasSimbolos = /^[1-9a-zA-Z]{1,4}-\w{4}-\w{4}/;


function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);



    
    nombre=$("#nombre").val();
    institucion=$("#institucion").val();
    inicio=$("#fechainicio").val();
    fin=$("#fechafin").val();
    tipo=$("#tipo").val();
    logro=$("#logro").val();

    campo = $("#campo").val();
    area = $("#area").val();
    disciplina = $("#disciplina").val();
    sub = $("#subdisciplina").val();

    

    if (letras.test(nombre) && nombre != null && letras.test(institucion) && institucion != null
         && tipo != null && tipo >0  ) {

        if (area != null & campo != null && disciplina != null && sub != null) {

           $.ajax({
                url: "../../ajax/estanciaInvestigacion.php?op=guardaryeditar",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function(datos) {
                    alert(datos);
                    mostrarform(false);
                    tabla.ajax.reload();
                }

            });
            limpiar(); 
           
        } else {
            $("#btnGuardar").prop("disabled", false);

            alertify.error("No estan selecionados todos los campo de area de conocimiendo" +sub);
        }

    } else {
        $("#btnGuardar").prop("disabled", false);

        alertify.error("Favor de llenar todos los campos");
    }

}

function mostrar(estancia) {
    $.post("../../ajax/estanciaInvestigacion.php?op=mostrar", { estancia: estancia }, function(data, status) {
        data = JSON.parse(data);
        
        mostrarform(true);



        $("#estancia").val(data.id);
        $("#nombre").val(data.nombre);
        $("#institucion").val(data.institucion);
        $("#fechainicio").val(data.fechaInnicio);
        $("#fechafin").val(data.FechaFin);
        $("#tipo").val(data.tipo);
        $("#logro").val(data.logro);
       

        $("#area").val(data.area);
        $("#campo").val(data.campo);
        $("#disciplina").val(data.disciplina);
        $("#subdisciplina").val(data.subdisciplina);




    });
}


function borrar(estancia) {

    bootbox.confirm('¿Está Seguro que desea borrar este registro?', function(result) {
        if (result) {
            $.post("../../ajax/estanciaInvestigacion.php?op=borrar", { estancia: estancia },
                function(e) {
                    alertify.alert(e);
                    tabla.ajax.reload();
                }
            );
        }
    });
}





init();