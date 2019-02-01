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
              <h1 class="box-title">evaluaciones No Conacyt
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
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>

                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <th>Opciones</th>
                  <th></th>
                  <th></th>
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

                  <div class="form-group col-md-3">
                    <input type="hidden" name="noConacyt" id="noConacyt">
                    <label>institucion</label>
                    <input type="text" class="form-control" name="institucion" id="institucion" maxlength="60" placeholder="" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label>fechaInicio</label>
                    <input type="date" class="form-control" name="fechaInicio" id="fechaInicio" maxlength="60" placeholder="" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label>fechaFin</label>
                    <input type="date" class="form-control" name="fechaFin" id="fechaFin" maxlength="60" placeholder="" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label>cargo</label>
                    <input type="text" class="form-control" name="cargo" id="cargo" maxlength="60" placeholder="" required>
                  </div>
                
                </div>

            

                <div class="form-row">
                    
                    <div class="form-group col-md-3">
                      
                      <label>TipoEvaluacion</label>
                      <select id="evaluacion" name="evaluacion"class="form-control" >
                    </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label>producto Evaluado</label>
                      <select id="producto" name="producto"class="form-control" >
                    </select>
                    </div>
                    
                    <div class="form-group col-md-3">
                      <label>Dictamen Conacyt</label>
                      <select id="dictamen" name="dictamen"class="form-control" >
                    </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label>nombre del producto evaluado</label>
                      <input type="text"class="form-control" id="nombre" name="nombre" >
                    </div>
                    <div class="form-group ">
                      <label>Descripcion Conacyt</label>
                      <textarea name="descripcion"class="form-control" id="descripcion" cols="100" rows="5"></textarea>
                    </div>
                  
                  </div>
                
                

                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <button class="btn btn-primary" type="submit" id="btnGuardar">
                    <i class="fa fa-save"></i> Guardar</button>
                  <button class="btn btn-danger" onclick="cancelarform()" type="button">
                    <i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                    <select style="visibility:hidden"  name="cvu" id="cvu"class="form-control" >
                                 </select>
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
  <script type="text/javascript" src="scripts/evaluacionesNoConacyt.js"></script>
  <?php
require 'footer.php';
?>
    