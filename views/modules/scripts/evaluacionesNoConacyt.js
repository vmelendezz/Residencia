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
    $.post("../../ajax/vistasglobanes.php?op=seletproductoevaluado", function(r) {
        $("#producto").html(r);

    });
    $.post("../../ajax/vistasglobanes.php?op=selecttipoevaluacion", function(r) {
        $("#evaluacion").html(r);

    });
    $.post("../../ajax/vistasglobanes.php?op=selectdictamenconacyt", function(r) {
        $("#dictamen").html(r);

    });


}

//Función limpiar
function limpiar() {

    $("#noConacyt").val("");
    $("#institucion").val("");
    $("#fechaInicio").val("");
    $("#fechaFin").val("");
    $("#cargo").val("");
    $("#evaluacion").val("");
    $("#producto").val("");
    $("#dictamen").val("");
    $("#nombre").val("");
    $("#descripcion").val("");


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
            url: '../../ajax/evaluacionesNoConacyt.php?op=listar',
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
        url: "../../ajax/evaluacionesNoConacyt.php?op=guardaryeditar",
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

function borrar(tecnico) {
    bootbox.confirm("¿Está Seguro de borrar?", function(result) {
        if (result) {
            $.post("../../ajax/evaluacionesNoConacyt.php?op=borrar", { noConacyt: noConacyt }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function mostrar(noConacyt) {
    $.post("../../ajax/evaluacionesNoConacyt.php?op=mostrar", { noConacyt: noConacyt }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        

        $("#noConacyt").val(data.noConacyt);
        $("#institucion").val(data.institucion);
        $("#fechaInicio").val(data.fechaInicio);
        $("#fechaFin").val(data.fechaFin);
        $("#cargo").val(data.cargo);
        $("#evaluacion").val(data.evaluacion);
        $("#producto").val(data.producto);
        $("#dictamen").val(data.dictamen);
        $("#nombre").val(data.nombre);
        $("#descripcion").val(data.descripcion);



    })
}






init();