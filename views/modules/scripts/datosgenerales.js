var tabla;

//Función que se ejecuta al inicio
function init() {

    mostrar()




    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });



}



//Función mostrar formulario



//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", false);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../../ajax/DatosGenerales.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            alert(datos);
            mostrarform(true);
            tabla.ajax.reload();
        }

    });

}

function mostrar() {
    $.post("../../ajax/DatosGenerales.php?op=mostrar", function(data, status) {
        data = JSON.parse(data);
        $("#datos").val(data.dato);
        $("#sexo").val(data.sexo);
        $("#fecha").val(data.fechaNacimientos);

    });
}





init();