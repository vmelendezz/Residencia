var tabla;

//Función que se ejecuta al inicio
function init() {
  mostrarform(false);
  listar();

  $("#formulario").on("submit", function(e) {
    guardaryeditar(e);
  });

  $.post("../../ajax/vistasglobanes.php?op=gradotesis", function(r) {
    $("#grado").html(r);
  });

  $.post("../../ajax/vistasglobanes.php?op=estadotesis", function(r) {
    $("#estado").html(r);
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
  $("#tesis").val("");
  $("#nombre").val("");
  $("#fechaInicio").val("");
  $("#fechaFin").val("");
  $("#institucion").val("");
  $("#estado").val("");
  $("#programa").val("");
  $("#aprobacion").val("");
  $("#obtencion").val("");
  $("#academico").val("");
  $("#grado").val("");

 

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
        url: "../../ajax/tesis.php?op=listar",
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

  nombre = $("#nombre").val();
  institucion = $("#institucion").val();
  programa = $("#programa").val();
  fondo = $("#fondo").val();
  grado = $("#grado").val();

  fechaInicio = $("#fechaInicio").val();
  fechaFin = $("#fechaFin").val();

  direccion = $("#direccion").val();
  academico = $("#academico").val();


 
  estado=$("#estado").val();
  aprobacion=$("#aprobacion").val("");
  obtencion=$("#obtencion").val("");
  
  area = $("#area").val();
  campo = $("#campo").val();
  disciplina = $("#disciplina").val();
  sub = $("#subdisciplina").val();

  letras = /^([aA-zZÁÉÍÓÚñáéíóú]+[\s]*)+$/i;
  letrasSimbolos = /^[1-9a-zA-Z]{1,4}-\w{4}-\w{4}/;
  numeros = /^([0-9])+$/i;

  if (
    letras.test(institucion) &&
    institucion != null &&
    letras.test(nombre) &&
    nombre != null &&
    letras.test(programa) &&
    programa != null &&
    grado != null &&
    grado > 0 && estado != null && estado >0 &&
    fondo != null &&
    numeros.test(fondo)
  ) {
    if ((area != null) & (campo != null) && disciplina != null && sub != null) {
      $.ajax({
        url: "../../ajax/tesis.php?op=guardaryeditar",
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

        alertify.error("No estan selecionados todos los campo de area de conocimiendo");
    }
  }else {
    $("#btnGuardar").prop("disabled", false);

    alertify.error("Favor de llenar todos los campos" + area+ " "+campo+" "+disciplina+" "+sub);
}
}

function borrar(tesis) {
  bootbox.confirm("¿Está Seguro de borrar?", function(result) {
    if (result) {
      $.post("../../ajax/tesis.php?op=borrar", { tesis: tesis }, function(e) {
        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  });
}

function mostrar(tesis) {
  $.post("../../ajax/tesis.php?op=mostrar", { tesis: tesis }, function(
    data,
    status
  ) {
    data = JSON.parse(data);
    mostrarform(true);

    $("#tesis").val(data.id);
    $("#nombre").val(data.nombreTesis);
    $("#fechaInicio").val(data.fechaInicio);
    $("#fechaFin").val(data.fechaFin);
    $("#institucion").val(data.institucion);
    
    $("#programa").val(data.nombrePrograma);
    $("#academico").val(data.CuerpoAcademico);
    $("#grado").val(data.grado);
    $("#estado").val(data.estadoDireccion);
    
    $("#aprobacion").val(data.fechaAprobacion);
    $ ("#obtencion").val(data.fechaObtencionGrado);

   

    $("#area").val(data.area);
    $("#campo").val(data.campo);
    $("#disciplina").val(data.disciplina);
    $("#subdisciplina").val(data.subdisciplina);
  });
}

init();
