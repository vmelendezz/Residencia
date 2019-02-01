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
                          <h1 class="box-title">Registro experiencia Profesional <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Actual Anterior </th>
                            <th> Funcion </th>
                            <th>institucion</th>
                            
                            
                           
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>Actual Anterior </th>
                            <th> Funcion </th>
                            <th>institucion</th>
                            
                          </tfoot>
                        </table>
                    </div>

 
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                        <input type="hidden" name="profesional" id="profesional">

                        
                          <div class="form-row">

                            <div class=" form-group  col-md-4 col-mb-3">
        	                      <label >Es empleo actual o anterior?</label>
                                  <select name="actual" id="actual"class="form-control" ></select>
                              </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
        	                      <label >Su puesto de considera como? </label>
                                  <select name="puesto" id="puesto"class="form-control" ></select>
                             </div>
                        </div>

                             <div class="form-row">
                              <div class=" form-group  col-md-10 col-mb-3">
        	                      <label >Funciones</label>
                                <input type="text" class="form-control" name="funcion" id="funcion"  maxlength="64" placeholder="" required>
                              </div>

                              <div class=" form-group  col-md-10 col-mb-3">
        	                      <label >nombre de la institucion</label>
                                <input type="text" class="form-control" name="institucion" id="institucion"  maxlength="64" placeholder="" required>
                              </div>

                              <div class="col-md-4 mb-3">
        	                      <label >periodo </label>
                                  <input type="text" class="form-control" name="periodo" id="periodo"  maxlength="30" placeholder="" required>
                              </div>

                              <div class="col-md-4 mb-3">
        	                      <label >Puesto </label>
                                  <input type="text" class="form-control" name="nombrepuesto" id="nombrepuesto"  maxlength="30" placeholder="" required>
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

<script type="text/javascript" src="scripts/Experienciaprofesional.js"></script>
<?php
require 'footer.php';
?>

