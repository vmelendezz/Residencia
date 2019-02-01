var tabla;



//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();


    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

   
    $.post("../../ajax/vistasglobanes.php?op=tipocertificacion", function(r) {
        $("#tipo").html(r);

    });
    $.post("../../ajax/vistasglobanes.php?op=tipoespecialidad", function(r) {
        $("#especialidad").html(r);

    });

    // codico del area de conocimiendo
    

  

    // din del codico del area de conocimiendo







}





//Función limpiar
function limpiar() {


    $("#medico").val("");
    $("#folio").val("");
    $("#vigenciade").val("");
    $("#vigenciaa").val("");
    $("#especialidad").val("");
    $("#tipo").val("");
    $("#instituto").val("");
    


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
            url: '../../ajax/certificadosmedicos.php?op=listar',
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
numeros= /^([0-9])+$/;


function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    folio=$("#folio").val();
    inicio=$("#vigenciade").val();
    fin=$("#vigenciaa").val();
    select1=$("#especialidad").val();
    select2= $("#tipo").val();
    instituto =$("#instituto").val();
    

    if (letras.test(instituto) && select2 != null && select1 != null
           && numeros.test(folio) ) {


            $.ajax({
                url: "../../ajax/certificadosmedicos.php?op=guardaryeditar",
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

        alertify.error("Favor de llenar todos los campos" );
    }

}

function mostrar(medico) {
    
    $.post("../../ajax/certificadosmedicos.php?op=mostrar", {medico : medico }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#medico").val(data.idMedico);
         $("#folio").val(data.numeroFolio);
        $("#vigenciade").val(data.fechaVigenciaDe);
        $("#vigenciaa").val(data.fechaVigenciaA);
        $("#especialidad").val(data.especialidad);
        $("#tipo").val(data.tipo);
        $("#instituto").val(data.otorga); 
    




    });
}


function borrar(medico) {

    bootbox.confirm('¿Está Seguro que desea borrar este registro? ', function(result) {
          
        if (result) {
            $.post("../../ajax/certificadosmedicos.php?op=borrar", { medico: medico },
                function(e) {
                    alertify.alert(e);
                    tabla.ajax.reload();
                }
            );
        }
    });
}





init();