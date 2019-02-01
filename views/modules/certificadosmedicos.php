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
              <h1 class="box-title">Certificados Medicos
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
                  <th>Folio</th>
                  <th>Vigencia de </th>
                  <th>Vigencia a</th>
                  <th>Tipo de Certificacion</th>
                  
                  

                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <th>Opciones</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  

                </tfoot>
              </table>
            </div>


            <div class="panel-body" style="height: 400px;" id="formularioregistros">
              <form name="formulario" id="formulario" method="POST">

                <div class="form-row">
                  <div class="form-group col-md-4">
                 
                  <input type="hidden" name="medico" id="medico">

                    <label>numero de folio </label>
                    <input type="text" class="form-control" id="folio" name="folio">
                  
                  </div>
                  <div class="form-group col-md-4">
                    <label>Vigencia de   </label>
                    <input type="date" name="vigenciade" id="vigenciade" class="form-control">

                  </div>
                  <div class="form-group col-md-4">
                    <label>Vigencia a</label>
                    <input type="date" name="vigenciaa" id="vigenciaa" class="form-control">
                  </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Especialidad</label>
                        <select name="especialidad" id="especialidad" class="form-control"></select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tipo de Certificacion</label>
                        <select name="tipo" id="tipo" class="form-control"></select>
                    </div>
                    <div class="form-group col-md-8">
                    <label>Intituto que otorga</label>
                    <input type="text" name="instituto" id="instituto" class="form-control">
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
  <script type="text/javascript" src="scripts/certificadosmedicos.js"></script>
<?php
ob_end_flush();
require 'footer.php';
?>
