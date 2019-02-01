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
              <h1 class="box-title">documentos de trabajo
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
                    <input type="hidden" name="trabajo" id="trabajo">
                    <label>titulo</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" maxlength="60" placeholder="" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label>nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="60" placeholder="" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label>PrimerApellido</label>
                    <input type="text" class="form-control" name="paterno" id="paterno" maxlength="60" placeholder="" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label>segundoApellido</label>
                    <input type="text" class="form-control" name="materno" id="materno" maxlength="60" placeholder="" required>
                  </div>
                
                </div>

                  <div class="form-row">
                    
                    <div class="form-group col-md-3">
                      <input type="hidden" name="trabajo" id="trabajo">
                      <label>titulo Publicacion</label>
                      <input type="text" class="form-control" name="Publicacion" id="Publicacion" maxlength="60" placeholder="" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label>pgInicio</label>
                      <input type="text" class="form-control" name="inicio" id="inicio" maxlength="60" placeholder="" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label>pg fin</label>
                      <input type="text" class="form-control" name="fin" id="fin" maxlength="60" placeholder="" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label>yearPublicacion</label>
                      <input type="text" class="form-control" name="year" id="year" maxlength="60" placeholder="" required>
                    </div>
                  
                  </div>

                  <div class="form-row">
                    
                    <div class="form-group col-md-3">
                      <input type="hidden" name="trabajo" id="trabajo">
                      <label>pais</label>
                      <input type="text" class="form-control" name="pais" id="pais" maxlength="60" placeholder="" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label>palabraClave1</label>
                      <input type="text" class="form-control" name="palabraClave1" id="palabraClave1" maxlength="60" placeholder="" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label> palabraClave2</label>
                      <input type="text" class="form-control" name="palabraClave2" id="palabraClave2" maxlength="60" placeholder="" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label>palabraClave3</label>
                      <input type="text" class="form-control" name="palabraClave3" id="palabraClave3" maxlength="60" placeholder="" required>
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
  <script type="text/javascript" src="scripts/estancia.js"></script>

  <?php
require 'footer.php';
?>
