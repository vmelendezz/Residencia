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
              <h1 class="box-title">Estancia de investigacion
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
                  <th>titulo</th>
                  <th>fecha Inicio</th>
                  <th>fecha Fin</th>
                  <th>Tipo de estancia</th>
                  
                  

                </thead>
                <tbody>
                </tbody>
             
              </table>
            </div>


            <div class="panel-body" style="height: 400px;" id="formularioregistros">
              <form name="formulario" id="formulario" method="POST" >

                <div class="form-row">
                  <div class="form-group col-md-12">
                 
                  
                  <input type="hidden" name="estancia" id="estancia">
                    <label>institucion</label>
                    <input type="text" class="form-control" name="institucion" id="institucion">
                  </div>
                  <div class="form-group col-md-12">
                    <label>Nombre de la estancia  </label>
                    <input type="text" class="form-control" name="nombre" id="nombre">

                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>fecha inicio</label>
                    <input type="date" class="form-control" name="fechainicio" id="fechainicio" maxlength="60" placeholder="" >
                  </div>
                  <div class="form-group col-md-4">
                    <label>fecha fin</label>
                    <input type="date" class="form-control" name="fechafin" id="fechafin" maxlength="60" placeholder="" >
                  </div>
                  <div class="form-group col-md-4">
                    <label>Tipo de estancia </label>
                    <select id="tipo" name="tipo" class="form-control" >
                    </select>
                  </div>
                </div>
               


                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label>logro profecional</label>
                    <textarea name="logro" id="logro" class="form-control" cols="30" rows="3"></textarea>
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

         



            <br>
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
  <script type="text/javascript" src="scripts/estanciaInvestigacion.js"></script>




<?php
ob_end_flush();
require 'footer.php';
?>
