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
              <h1 class="box-title">Registro Estudio Realizados
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
                  <th>Estatus</th>
                  
                  

                </thead>
                <tbody>
                </tbody>
             
              </table>
            </div>


            <div class="panel-body" style="height: 400px;" id="formularioregistros">
              <form name="formulario" id="formulario" method="POST" >

                <div class="form-row">
                  <div class="form-group col-md-4">
                 
                  
                  <input type="hidden" name="estudiosRealizado" id="estudiosRealizado">
                    <label>nivel de estudio</label>
                    <select  name="nivel" id="nivel"class="form-control" >
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>tipo de  institución </label>
                    <select id="tipoinstituto" name="tipoinstituto" class="form-control" >
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-8">
                    <label>nombre  institución</label>
                    <input type="text" class="form-control" name="instituto" id="instituto" maxlength="60" placeholder="" >
                  </div>
                  <div class="form-group col-md-8">
                    <label>nombre del titulo</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" maxlength="60" placeholder="" >
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Estatus</label>
                    <select id="estatus" name="estatus" class="form-control" >
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label>opciones de Titulacion</label>
                    <select id="opciones" name="opciones" class="form-control" >
                </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label>Pais</label>
                    <input type="text" class="form-control" name="pais" id="pais" maxlength="60" placeholder="" >
                  </div>
                </div>


                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>numero de Cédula</label>
                    <input type="text" class="form-control" name="nocedula" id="nocedula" maxlength="60" placeholder="" >
                  </div>
                  
                  <div class="form-group col-md-4">
                    <label>siglas del estudios</label>
                    <input type="text" class="form-control" name="siglasestudios" id="siglasestudios" maxlength="60" placeholder="" >
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>fecha inicio</label>
                    <input type="date" class="form-control" name="fechainicio" id="fechainicio" maxlength="60" placeholder="" >
                  </div>
                  <div class="form-group col-md-3">
                    <label>fecha fin</label>
                    <input type="date" class="form-control" name="fechafin" id="fechafin" maxlength="60" placeholder="" >
                  </div>
                  <div class="form-group col-md-3">
                    <label>fecha obtencion</label>
                    <input type="date" class="form-control" name="fechaobtencion" id="fechaobtencion" maxlength="60" placeholder="" >
                  </div>
                  <div class="form-group col-md-3">
                    <label>periodo</label>
                    <input type="text" class="form-control" name="periodo" id="periodo" maxlength="60" placeholder="" >
                  </div>
                </div>


             <div class="form-row">
                <div class="form-group col-md-2">
                  <label>area</label>
                  <select id="area" name="area" class="form-control" >
                  </select>
                </div>
              <div class="form-group col-md-2">
                  <label>campo</label>
                  <select id="campo" name="campo" class="form-control" >
                  </select>
              </div>
              <div class="form-group col-md-2">
                <label>diciplina</label>
                <select id="disciplina" name="disciplina" class="form-control" >
                </select>
              </div>
              <div class="form-group col-md-2">
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
  <script type="text/javascript" src="scripts/EstudioRealizados.js"></script>




<?php
ob_end_flush();
require 'footer.php';
?>
