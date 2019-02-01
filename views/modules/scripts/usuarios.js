var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });
    //Cargamos los items al select estado civil
    $.post("../../ajax/usuarios.php?op=selectEstado", function(r) {
        $("#id_estadocivil").html(r);
    });
}

//Función limpiar
function limpiar() {
    $("#usuarionew").val("");
    $("#email").val("");
    $("#nombre").val("");
    $("#password").val("");
    $("#paterno").val("");
    $("#materno").val("");
    $("#Curp").val("");
    $("#id_estadocivil").val("");
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
    tabla = $("#tbllistado")
        .dataTable({
            aProcessing: true, //Activamos el procesamiento del datatables
            aServerSide: true, //Paginación y filtrado realizados por el servidor
            dom: "Bfrtip", //Definimos los elementos del control de tabla

            ajax: {
                url: "../../ajax/usuarios.php?op=listar",
                type: "get",
                dataType: "json",
                error: function(e) {
                    console.log(e.responseText);
                }
            },
            bDestroy: true,
            iDisplayLength: 5, //Paginación
            order: [
                    [0, "desc"]
                ] //Ordenar (columna,orden)
        })
        .DataTable();
}
//Función para guardar o editar

correo = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
curpv = /^[0-9a-zA-Z]+$/i;
nombres = /^([aA-zZÁÉÍÓÚñáéíóú]+[\s]*)+$/;
apellidoPaterno = /^[a-zA-Z]+$/i;
apellidoMaterno = /^[a-zA-Z]+$/i;
ps = /^[0-9a-zA-Z]+$/i;




function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    email = $("#email").val();
    nombre = $("#nombre").val();
    password = $("#password").val();
    paterno = $("#paterno").val();
    materno = $("#materno").val();
    curp = $("#Curp").val();
    civil = $("#id_estadocivil").val();


    if (correo.test(email)) {
        if (curpv.test(curp)) {
            if (nombres.test(nombre)) {
                if (apellidoPaterno.test(paterno)) {
                    if (apellidoMaterno.test(materno)) {
                        if (civil != null) {

                            $.ajax({
                                url: "../../ajax/usuarios.php?op=guardaryeditar",
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

                        } else {
                            $("#btnGuardar").prop("disabled", false);
                            alertify.error("Estado civil no valido");
                        }

                    } else {
                        $("#btnGuardar").prop("disabled", false);
                        alertify.error("Apellido Materno no valido");
                    }

                } else {
                    $("#btnGuardar").prop("disabled", false);
                    alertify.error("Apellido Paterno no valido");
                }

            } else {
                $("#btnGuardar").prop("disabled", false);
                alertify.error("nombre no valido");
            }
        } else {
            $("#btnGuardar").prop("disabled", false);
            alertify.error("curp no valido");
        }
    } else {
        $("#btnGuardar").prop("disabled", false);
        alertify.error("correo no valido");
    }

}

function mostrar(usuarionew) {
    $.post(
        "../../ajax/usuarios.php?op=mostrar", { usuarionew: usuarionew },
        function(data, status) {
            data = JSON.parse(data);
            mostrarform(true);

            $("#usuarionew").val(data.idUsuarios);
            $("#email").val(data.correo);
            $("#password").val(data.password);
            $("#nombre").val(data.nombre);
            $("#paterno").val(data.apellidoPaterno);
            $("#materno").val(data.apellidoMaterno);
            $("#Curp").val(data.curp);
            $("#id_estadocivil").val(data.idEstadoCivil);
        }
    );
}

//Función para desactivar registros


function desactivar(usuarionew) {

    bootbox.confirm('¿Está Seguro de desactivar el Usuario?', function(result) {
        if (result) {
            $.post("../../ajax/usuarios.php?op=desactivar", { usuarionew: usuarionew },
                function(e) {
                    alertify.alert(e);
                    tabla.ajax.reload();
                }
            );
        }
    });
}

//Función para activar registros
function activar(usuarionew) {
    bootbox.confirm("¿Está Seguro de activar el Usuario?", function(result) {
        if (result) {
            $.post(
                "../../ajax/usuarios.php?op=activar", { usuarionew: usuarionew },
                function(e) {
                    alert(e);
                    tabla.ajax.reload();
                }
            );
        }
    });
}

init();