var tabla;

//Función que se ejecuta al inicio
function init() {
  mostrarform(false);
  listar();

  $("#formulario").on("submit", function(e) {
    guardaryeditar(e);
  });

  // codico del area de conocimiendo
  $.post("../../ajax/vistasglobanes.php?op=area", function(r) {
    $("#area").html(r);
  });

  $("#area").change(function() {
    $("#area option:selected").each(function(r) {
      area = $(this).val();
      $.post("../../ajax/vistasglobanes.php?op=campo", { area: area }, function(
        data
      ) {
        $("#campo").html(data);

        $("#campo option:selected").each(function(r) {
          campos = $(this).val();
          $.post(
            "../../ajax/vistasglobanes.php?op=disciplina",
            { campos: campos },
            function(data) {
              $("#disciplina").html(data);

              $("#disciplina option:selected").each(function(r) {
                disciplina = $(this).val();
                $.post(
                  "../../ajax/vistasglobanes.php?op=subdisciplina",
                  { disciplina: disciplina },
                  function(data) {
                    $("#sub").html(data);
                  }
                );
              });
            }
          );
        });
      });
    });
  });

  // din del codico del area de conocimiendo
}

//Función limpiar
function limpiar() {
  $("#curso").val("");
  $("#institucion").val("");
  $("#nombre").val("");
  $("#programa").val("");
  $("#horas").val("");
  $("#year").val("");
  $("#fechainicio").val("");
  $("#fechafin").val("");
  $("#campo").val("");
  $("#area").val("");
  $("#disciplina").val("");
  $("#sub").val("");
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
        url: "../../ajax/cursoimpartidos.php?op=listar",
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

letras = /^([aA-zZÁÉÍÓÚñáéíóú]+[\s]*)+$/i;
letrasSimbolos = /^[1-9a-zA-Z]{1,4}-\w{4}-\w{4}/;
numeros = /^([0-9])+$/i;

function guardaryeditar(e) {
  e.preventDefault(); //No se activará la acción predeterminada del evento
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);

  institucion = $("#institucion").val();
  nombre = $("#nombre").val();
  programa = $("#programa").val();
  horas = $("#horas").val();
  year = $("#year").val();
  fechainicio = $("#fechainicio").val();
  fechafin = $("#fechafin").val();

  campo = $("#campo").val();
  area = $("#area").val();
  disciplina = $("#disciplina").val();
  subb = $("#sub").val();

  if (
    letras.test(institucion) &&
    institucion != null &&
    letras.test(nombre) &&
    nombre != null &&
    letras.test(programa) &&
    programa != null &&
    numeros.test(horas) &&
    horas != null
  ) {
    if (
      (area != null) & (campo != null) &&
      disciplina != null 
    ) {
      $.ajax({
        url: "../../ajax/cursoimpartidos.php?op=guardaryeditar",
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

      alertify.error(
        "No estan selecionados todos los campo de area de conocimiendo"
      );
    }
  } else {
    $("#btnGuardar").prop("disabled", false);

    alertify.error("Favor de llenar todos los campos");
  }
}

function mostrar(curso) {
  $.post(
    "../../ajax/cursoimpartidos.php?op=mostrar",
    { curso: curso },
    function(data, status) {
      data = JSON.parse(data);

      mostrarform(true);

      $("#curso").val(data.id);
      $("#institucion").val(data.institucion);
      $("#nombre").val(data.nombre);
      $("#programa").val(data.programa);
      $("#horas").val(data.horas);
      $("#year").val(data.year);
      $("#fechainicio").val(data.fechaInicio);
      $("#fechafin").val(data.fechafin);
      $("#campo").val(data.campo);
      $("#area").val(data.area);
      $("#disciplina").val(data.disciplina);
      $("#sub").val(data.subdisciplina);
    }
  );
}

function borrar(curso) {
  bootbox.confirm("¿Está Seguro que desea borrar este registro?", function(
    result
  ) {
    if (result) {
      $.post(
        "../../ajax/cursoimpartidos.php?op=borrar",
        { curso: curso },
        function(e) {
          alertify.alert(e);
          tabla.ajax.reload();
        }
      );
    }
  });
}

init();
