var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

    

}

//Función limpiar
function limpiar() {
    $("#participacion").val("");
    $("#nombre").val("");
    $("#gradoIntervencion").val("");
    $("#fechaImplementacion").val("");
    $("#archivo").val("");



}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);

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
            url: '../../ajax/participacionactualizacionprogeducativo.php?op=listar',
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

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../../ajax/participacionactualizacionprogeducativo.php?op=guardaryeditar",
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
}

function borrar(participacion) {
    bootbox.confirm("¿Está Seguro de borrar?", function(result) {
        if (result) {
            $.post("../../ajax/participacionactualizacionprogeducativo.php?op=borrar", { participacion: participacion }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function mostrar(participacion) {
    $.post("../../ajax/participacionactualizacionprogeducativo.php?op=mostrar", { participacion: participacion }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        

        $("#participacion").val(data.idParticipacionActualizacionEducativo);
        $("#nombre").val(data.nombre);
        $("#gradoIntervencion").val(data.gradoIntervencion);
        $("#fechaImplementacion").val(data.fechaImplementacion);
        $("#archivo").val(data.archivo);



    })
}






init();