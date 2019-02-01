var tabla;

$(document).ready(function() {

    $("#Campus").change(function() {


        $("#Campus").each(function() {
            elegido = $(this).val();
            $.post("../../ajax/vistasglobanes.php?op=departamento", { elegido: elegido }, function(data) {
                $("#departamento").html(data);
            });
        });
    })
});

//Función que se ejecuta al inicio
function init() {

    mostrar(true)




    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });


    $.post("../../ajax/vistasglobanes.php?op=campus", function(r) {
        $("#Campus").html(r);

    });
}



//Función mostrar formulario



//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", false);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../../ajax/infobasic.php?op=guardaryeditar",
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

function mostrar() {
    $.post("../../ajax/infobasic.php?op=mostrar", function(data, status) {
        //alert(data);
        data = JSON.parse(data);
        $("#cvu").val(data.cvu);
        $("#Campus").val(data.idCampus);
        $("#departamento").val(data.idDepartamento);

    });
}





init();