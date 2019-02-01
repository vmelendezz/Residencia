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
                          <h1 class="box-title">Registro experiencia docente <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nivel </th>
                            <th> nombre curso </th>
                            <th>institucion</th>
                            <th>periodo </th>
                            
                           
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>Nivel </th>
                            <th>nombre curso </th>
                            <th>institucion</th>
                            <th>periodo </th>
                          </tfoot>
                        </table>
                    </div>

 
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                        
                          <div class="form-row">
                            <input type="hidden" name="experiencia" id="experiencia">
                            <div class=" form-group  col-md-10 col-mb-3">
        	                      <label >nombre de la institucion</label>
                                <input type="text" class="form-control" name="institucion" id="institucion"  maxlength="64" placeholder="" >

                              </div>
                             <div class="form-group col-md-10 col-mb-4">
        	                      <label >nombre de la asignadura</label>
                                <input type="text" class="form-control" name="nombre" id="nombre">
                              </div>
                             <div class="col-md-3 mb-3">
        	                      <label >nivel </label>
                                <select class="form-control" name="nivel" id="nivel"></select>
                              </div>

                              <div class="col-md-3 mb-3">
        	                      <label >periodo </label>
                                <input class="form-control"  type="text" name="periodo" id="periodo">
                              </div>
                              
                              
                          </div> 


                          



                            
                         
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                         
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

<script type="text/javascript" src="scripts/experiencia.js"></script>
<?php
require 'footer.php';
?>

