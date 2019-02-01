<?php


ob_start();
session_start();

if(!isset($_SESSION['nombreusuario'])){
  header("location:login.php");
}

else{
    require 'header.php';
    require 'cvubarrauser.php';
}
?>



<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">diplomas
              <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)">
                <i class="fa fa-plus-circle"></i> Agregar</button>
            </h1>
            <div class="box-tools pull-right">
            </div>
          </div>
          <!-- /.box-header -->
          <!-- centro -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Opciones</th>
                <th>nombre</th>
                <th>institucion</th>
                <th>year</th>
                <th>horastotal</th>
                

              </thead>
              <tbody>
              </tbody>
             
            </table>
          </div>


          <div class="panel-body" style="height: 400px;" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">



              <div class="form-row">

                <div class="form-group col-md-12">
                  <input type="hidden" name="diploma" id="diploma">
                  <label>institucion</label>
                  <input type="text" class="form-control" name="institucion" id="institucion" maxlength="60" placeholder="" required>
                </div>
                
                <div class="form-group col-md-8">
                  <label>nombre del Diplomado</label>
                  <input type="text" class="form-control" name="nombre" id="nombre" maxlength="60" placeholder="" required>
                </div>
               

              </div>

              <div class="form-row">

                <div class="form-group col-md-8">
                  <label>Nombre del curso o asignatura </label>
                  <input type="text" class="form-control" name="nombreCurso" id="nombreCurso" maxlength="60" placeholder="" required>
                </div>
                <div class="form-group col-md-2">
                  <label>Año</label>
                  <input type="text" class="form-control" name="year" id="year" maxlength="60" placeholder="" required>
                </div>
                <div class="form-group col-md-2">
                  <label>horas Totales</label>
                  <input type="text" class="form-control" name="horasTotal" id="horasTotal" maxlength="60" placeholder="" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>area</label>
                  <select id="area" name="area" class="form-control" >
                  </select>
                </div>
              <div class="form-group col-md-3">
                  <label>campo</label>
                  <select id="campo" name="campo" class="form-control" >
                  </select>
              </div>
              <div class="form-group col-md-3">
                <label>diciplina</label>
                <select id="disciplina" name="disciplina" class="form-control" >
                </select>
              </div>
              <div class="form-group col-md-3">
                <label>subdiciplina</label>
                <select id="subdisciplina" name="subdisciplina" class="form-control" >
                </select>
              </div>
            </div>



              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-primary" type="submit" id="btnGuardar">
                  <i class="fa fa-save"></i> Guardar</button>
                <button class="btn btn-danger" onclick="cancelarform()" type="button">
                  <i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                  
              </div>
            </form>
          </div>
          <!--Fin centro -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->
<!--Fin-Contenido-->
<script type="text/javascript" src="scripts/Diplomas.js"></script>

<?php
require 'footer.php';
?>