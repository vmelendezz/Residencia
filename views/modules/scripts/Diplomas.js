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
  // codico del area de conocimiendo

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
                    $("#subdisciplina").html(data);
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
  $("#diploma").val("");
  $("#institucion").val("");
  $("#nombre").val("");
  $("#nombreCurso").val("");
  $("#year").val("");
  $("#horasTotal").val("");
  $("#area").val("");
  $("#campo").val("");
  $("#disciplina").val("");
  $("#subdisciplina").val("");
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
  tabla = $("#tbllistado")
    .dataTable({
      aProcessing: true, //Activamos el procesamiento del datatables
      aServerSide: true, //Paginación y filtrado realizados por el servidor
      dom: "Bfrtip", //Definimos los elementos del control de tabla

      ajax: {
        url: "../../ajax/Diploma.php?op=listar",
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

  institucion = $("#institucion").val();
  nombre = $("#nombre").val();
  curso = $("#nombreCurso").val();
  year = $("#year").val();
  horas = $("#horasTotal").val();
  area = $("#area").val();
  campo = $("#campo").val();
  disciplina = $("#disciplina").val();
  subdisciplina = $("#subdisciplina").val();

  letras = /^([aA-zZÁÉÍÓÚñáéíóú]+[\s]*)+$/i;
  letrasSimbolos = /^[1-9a-zA-Z]{1,4}-\w{4}-\w{4}/;
  numeros = /^([0-9])+$/i;

  if (letras.test(nombre) && nombre != null && letras.test(curso) &&
    curso != null && numeros.test(horas) && horas != null &&
    letras.test(institucion) && institucion != null && numeros.test(year)
    && year != null) 
    {
        $.ajax({
            url: "../../ajax/Diploma.php?op=guardaryeditar",
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
  }else {
        $("#btnGuardar").prop("disabled", false);

        alertify.error("Favor de llenar todos los campos");
    }
}

function borrar(diploma) {
  bootbox.confirm("¿Está Seguro de borrar?", function(result) {
    if (result) {
      $.post("../../ajax/Diploma.php?op=borrar", { diploma: diploma }, function(
        e
      ) {
        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  });
}

function mostrar(diploma) {
  $.post("../../ajax/Diploma.php?op=mostrar", { diploma: diploma }, function(
    data,
    status
  ) {
    data = JSON.parse(data);
    mostrarform(true);

    $("#diploma").val(data.id);
    $("#institucion").val(data.institucion);
    $("#nombre").val(data.nombre);
    $("#nombreCurso").val(data.nombreCursoAsig);
    $("#year").val(data.year);
    $("#horasTotal").val(data.horasTotal);
    $("#area").val(data.area);
    $("#campo").val(data.campo);
    $("#disciplina").val(data.diciplina);
    $("#subdisciplina").val(data.subdisciplina);
  });
}

init();
