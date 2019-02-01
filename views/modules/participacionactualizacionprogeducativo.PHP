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
              <h1 class="box-title">participacion actualizacion progeducativo
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
                  <th>grado de Intervencion</th>
                  <th>fecha de Implementacion</th>
                  

                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <th>Opciones</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  

                </tfoot>
              </table>
            </div>


            <div class="panel-body" style="height: 400px;" id="formularioregistros">
              <form name="formulario" id="formulario" method="POST">



                <div class="form-row">

                  <div class="form-group col-md-3">
                    <input type="hidden" name="participacion" id="participacion">
                    <label>nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="60" placeholder="" required>
                  </div>
                  
                  <div class="form-group col-md-3">
                    <label>gradoIntervencion</label>
                    <input type="text" class="form-control" name="gradoIntervencion" id="gradoIntervencion" maxlength="60" placeholder="" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label>fechaImplementacion</label>
                    <input type="date" class="form-control" name="fechaImplementacion" id="fechaImplementacion" maxlength="60" placeholder="" required>
                  </div>
                
                </div>

                  <div class="form-row">
                    
                    <div class="form-group col-md-3">
                      <label>archivo pdf </label>
                      <input type="text" class="form-control" name="archivo" id="archivo" maxlength="60" placeholder="" >
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
  <script type="text/javascript" src="scripts/participacionactualizacionprogeducativo.js"></script>
  <?php
require 'footer.php';
?>
    