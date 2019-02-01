var tabla;



//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();


    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    $.post("../../ajax/vistasglobanes.php?op=selectNivelEstudios", function(r) {
        $("#nivel").html(r);

    });
    $.post("../../ajax/vistasglobanes.php?op=selectipoinsti", function(r) {
        $("#tipoinstituto").html(r);

    });
    $.post("../../ajax/vistasglobanes.php?op=EstatusEstudios", function(r) {
        $("#estatus").html(r);

    });
    $.post("../../ajax/vistasglobanes.php?op=titulacion", function(r) {
        $("#opciones").html(r);

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

    // din del codico del area de conocimiendo







}





//Función limpiar
function limpiar() {


    $("#estudiosRealizado").val("");
    $("#nivel").val("");
    $("#tipoinstituto").val("");
    $("#institucion").val("");
    $("#titulo").val("");
    $("#estatus").val("");
    $("#opciones").val("");
    $("#pais").val("");
    $("#nocedula").val("");
    $("#siglasestudios").val("");

    $("#fechainicio").val("");
    $("#fechafin").val("");
    $("#fechaobtencion").val("");
    $("#periodo").val("");

    $("#campo").val("");
    $("#area").val("");
    $("#disciplina").val("");
    $("#subdiciplina").val("");

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
            url: '../../ajax/EstudioRealizados.php?op=listar',
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



    nivel = $("#nivel").val();
    tipo = $("#tipoinstituto").val();
    insti = $("#instituto").val();
    estatus = $("#estatus").val();
    opcion = $("#opciones").val();
    cedula = $("#nocedula").val();
    siglas = $("#siglasestudios").val();
    titulo = $("#titulo").val();
    pais = $("#pais").val();

    inicio = $("#fechainicio").val();
    fin = $("#fechafin").val();
    obtencion = $("#fechaobtencion").val();
    periodo = $("#periodo").val();

    campo = $("#campo").val();
    area = $("#area").val();
    disciplina = $("#disciplina").val();
    sub = $("#subdisciplina").val();

    var fechaincio = new Date(inicio);
    var fechafin = new Date(fin);
    var actual = new Date();

    fechaactual = actual.getTime();
    inicios = fechaincio.getTime();
    inciofecha = fechaincio.getFullYear();
    finfecha = fechafin.getFullYear();

    resultado = finfecha - inciofecha;

    if (letras.test(insti) && nivel != null && tipo != null && estatus != null && opcion != null && letrasSimbolos.test(cedula) &&
        letras.test(siglas) && letras.test(titulo) && letras.test(pais)) {

        if (area != null & campo != null && disciplina != null && sub != null) {

            $.ajax({
                url: "../../ajax/EstudioRealizados.php?op=guardaryeditar",
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

            alertify.error("No estan selecionados todos los campo de area de conocimiendo");
        }




    } else {
        $("#btnGuardar").prop("disabled", false);

        alertify.error("Favor de llenar todos los campos" + area+ " "+campo+" "+disciplina+" "+sub);
    }

}

function mostrar(estudiosRealizado) {
    $.post("../../ajax/EstudioRealizados.php?op=mostrar", { estudiosRealizado: estudiosRealizado }, function(data, status) {
        data = JSON.parse(data);
        
        mostrarform(true);



        $("#estudiosRealizado").val(data.new);
        $("#nivel").val(data.nivel);
        $("#tipoinstituto").val(data.institucion);

        $("#instituto").val(data.instituto);
        $("#titulo").val(data.titulo);

        $("#estatus").val(data.estatus);
        $("#opciones").val(data.opcion);
        $("#pais").val(data.pais);
        $("#nocedula").val(data.noCedula);
        $("#siglasestudios").val(data.siglasEstudios);

        $("#fechainicio").val(data.fechaInicio);
        $("#fechafin").val(data.fechaFin);
        $("#fechaobtencion").val(data.fechaObtencion);
        $("#periodo").val(data.periodo);

        $("#area").val(data.area);
        $("#campo").val(data.campo);
        $("#disciplina").val(data.disciplina);
        $("#subdisciplina").val(data.subdisciplina);




    });
}


function borrar(estudiosRealizado) {

    bootbox.confirm('¿Está Seguro que desea borrar este registro?', function(result) {
        if (result) {
            $.post("../../ajax/EstudioRealizados.php?op=borrar", { estudiosRealizado: estudiosRealizado },
                function(e) {
                    alertify.alert(e);
                    tabla.ajax.reload();
                }
            );
        }
    });
}





init();