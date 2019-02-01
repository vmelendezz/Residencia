var tabla;

//Función que se ejecuta al inicio
function init() {
  mostrarform(false);
  listar();

  $("#formulario").on("submit", function(e) {
    guardaryeditar(e);
  });

  $.post("../../ajax/vistasglobanes.php?op=actual", function(r) {
    $("#actual").html(r);
  });
  $.post("../../ajax/vistasglobanes.php?op=puesto", function(r) {
    $("#puesto").html(r);
  });
}

//Función limpiar
function limpiar() {
  $("#profesional").val("");
  $("#actual").val("");
  $("#puesto").val("");
  $("#institucion").val("");
  $("#nombrepuesto").val("");
  $("#periodo").val("");
  $("#funcion").val("");
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
        url: "../../ajax/Experienciaprofesional.php?op=listar",
        type: "get",
        dataType: "json",
        error: function(e) {
          console.log(e.responseText);
        }
      },
      bDestroy: true,
      iDisplayLength: 5, //Paginación
      order: [[0, "desc"]] //Ordenar (columna,orden)
    })
    .DataTable();
}
//Función para guardar o editar

function guardaryeditar(e) {
  e.preventDefault(); //No se activará la acción predeterminada del evento
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);

  actual = $("#actual").val("");
  puesto = $("#puesto").val("");
  institucion = $("#institucion").val("");
  $("#nombrepuesto").val("");
  periodo = $("#periodo").val("");
  funcion = $("#funcion").val("");

  if (
    actual != null &&
    actual > 0 &&
    letras.test(institucion) &&
    periodo != null &&
    puesto != null &&
    puesto > 0
  ) {
    $.ajax({
      url: "../../ajax/Experienciaprofesional.php?op=guardaryeditar",
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
    alertify.error("Datos no validos");
  }
}

function mostrar(profesional) {
  $.post(
    "../../ajax/Experienciaprofesional.php?op=mostrar",
    { profesional: profesional },
    function(data, status) {
      alert(data);
      data = JSON.parse(data);
      mostrarform(true);

      $("#profesional").val(data.id);
      $("#actual").val(data.actual);
      $("#puesto").val(data.puesto);
      $("#institucion").val(data.institucion);
      $("#nombrepuesto").val();
      $("#periodo").val(data.periodo);
      $("#funcion").val(data.funcion);
    }
  );
}

init();
