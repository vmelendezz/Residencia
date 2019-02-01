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
              <h1 class="box-title">Curso impartidos
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
                  <th>nombre curso</th>
                  <th>nombre programa  </th>
                  <th>fecha de inicio </th>
                  <th>fecha de fin </th>
                  
                  

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
                  <div class="form-group col-md-12">
                 
                  <input type="hidden" name="curso" id="curso">

                    <label>institucion </label>
                    <input type="text" class="form-control" id="institucion" name="institucion">
                  
                  </div>
                  <div class="form-group col-md-12">
                    <label>nombre del curso    </label>
                    <input type="text" name="nombre" id="nombre" class="form-control">

                  </div>
                  <div class="form-group col-md-8">
                    <label>Nombre del programa </label>
                    <input type="text" name="programa" id="programa" class="form-control">
                  </div>

                  <div class="form-group col-md-4">
                    <label>Horas totales del curso </label>
                    <input type="text" name="horas" id="horas" class="form-control">
                  </div>

                  
                  <div class="form-group col-md-4">
                    <label>año</label>
                    <input type="text" name="year" id="year" class="form-control">
                  </div>
                  <div class="form-group col-md-4">
                    <label>fecha de inicio</label>
                    <input type="date" name="fechainicio" id="fechainicio" class="form-control">
                  </div>
                  <div class="form-group col-md-4">
                    <label>fecha de fin</label>
                    <input type="date" name="fechafin" id="fechafin" class="form-control">
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
                        <select id="sub" name="sub" class="form-control" >
                            <option> select</option>
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
  <script type="text/javascript" src="scripts/cursoimpartidos.js"></script>
<?php
ob_end_flush();
require 'footer.php';
?>
