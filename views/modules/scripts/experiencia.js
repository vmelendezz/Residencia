var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();


    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })


    $.post("../../ajax/vistasglobanes.php?op=tiponivel", function(r) {
        $("#nivel").html(r);

    });


}

//Función limpiar
function limpiar() {

    $("#experiencia").val("");
    $("#nivel").val("");
    $("#periodo").val("");
    $("#institucion").val("");
    $("#nombre").val("");





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
            url: '../../ajax/experiencia.php?op=listar',
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

    
letras = /^([aA-zZÁÉÍÓÚñáéíóú]+[\s]*)+$/i;
letrasSimbolos = /^[1-9a-zA-Z]{1,4}-\w{4}-\w{4}/;


    
    nivel=$("#nivel").val();
    periodo=$("#periodo").val();
    institucion=$("#institucion").val();
    nombre=$("#nombre").val();

    if(nivel != null && nivel >0 && letras.test(institucion)  
                && letras.test(nombre) && nombre != null && periodo !=null){

                   
        $.ajax({
            url: "../../ajax/experiencia.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos) {
            alertify.success(datos);
            mostrarform(false);
            tabla.ajax.reload();
            }
        });
        limpiar(); 
    }else {
        $("#btnGuardar").prop("disabled", false);
        alertify.error("Datos no validos");
    }
}

function mostrar(experiencia) {
    $.post("../../ajax/experiencia.php?op=mostrar", { experiencia: experiencia }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#experiencia").val(data.experiencia);
        $("#nivel").val(data.idTipoNivel);
        $("#periodo").val(data.periodo);
        $("#institucion").val(data.experienciaInstitucion);
        $("#nombre").val(data.nombreCurso);



    })
}

function borrar(experiencia) {

    bootbox.confirm('¿Está Seguro que desea borrar este registro?', function(result) {
        if (result) {
            $.post("../../ajax/experiencia.php?op=borrar", { experiencia: experiencia },
                function(e) {
                    alertify.alert(e);
                    tabla.ajax.reload();
                }
            );
        }
    });
}






init();