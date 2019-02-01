var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

    $.post("../../ajax/vistasglobanes.php?op=selectcvu", function(r) {
        $("#cvu").html(r);

    });

}

//Función limpiar
function limpiar() {
    $("#redes").val("");
    $("#nombre").val("");
    $("#creacion").val("");
    $("#ingreso").val("");
    $("#nombreResponsable").val("");
    $("#asignacion").val("");
    $("#primero").val("");
    $("#segundo").val("");
    $("#institucion").val("");
    $("#total").val("");
    $("#area").val("");
    $("#campo").val("");
    $("#diciplina").val("");
    $("#subdiciplina").val("");
    


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
            url: '../../ajax/redesinvestigacion.php?op=listar',
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
        url: "../../ajax/redesinvestigacion.php?op=guardaryeditar",
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

function borrar(redes) {
    bootbox.confirm("¿Está Seguro de borrar?", function(result) {
        if (result) {
            $.post("../../ajax/redesinvestigacion.php?op=borrar", { redes: redes }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function mostrar(redes) {
    $.post("../../ajax/redesinvestigacion.php?op=mostrar", { redes: redes }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        

        $("#redes").val(data.id);
        $("#nombre").val(data.nombre);
        $("#creacion").val(data.FechaCreacion);
        $("#ingreso").val(data.fecheInicio);
        $("#asignacion").val(data.fehcaAsignacion);
        $("#nombreResponsable").val(data.responsable);
        $("#primero").val(data.aperllidoPaterno);
        $("#segundo").val(data.apellidoMaterno);
        $("#institucion").val(data.institucion);
        $("#total").val(data.total);
        $("#area").val(data.area);
        $("#campo").val(data.campo);
        $("#disciplina").val(data.disciplina);
        $("#subdisciplina").val(data.subdisciplina);
        



    })
}






init();