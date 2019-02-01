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
                        <h1 class="box-title">tesis
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
                                <th>Nombre de la tesis</th>
                                <th>fecha de inicio</th>
                                <th>fecha de fin</th>
                                <th>Estado de la tesis</th>
                                

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
                                <div class="form-group col-md-6">
                                    <input type="hidden" name="tesis" id="tesis">
                                    <label>nombre de la tesis</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="60" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>fecha de inicio</label>
                                    <input type="date" class="form-control" name="fechaInicio" id="fechaInicio" maxlength="60" placeholder="" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>fecha de fin </label>
                                    <input type="date" class="form-control" name="fechaFin" id="fechaFin" maxlength="60" placeholder="" required>
                                </div>

                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label>institucion</label>
                                    <input type="text" class="form-control" name="institucion" id="institucion" maxlength="60" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Estado de la tesis</label>
                                    <select class="form-control" name="estado" id="estado" required></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Programa</label>
                                    <input type="text" class="form-control" name="programa" id="programa" maxlength="60" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Fecha de aprobacion</label>
                                    <input type="date" class="form-control" name="aprobacion" id="aprobacion" maxlength="60" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Fecha obtención del grado</label>
                                    <input type="date" class="form-control" name="obtencion" id="obtencion" maxlength="60" placeholder="" required>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Cuerpo Academico</label>
                                    <select name="academico" id="academico" class="form-control">
                                    <option value="No">no</option>
                                    <option value="Si">si</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Grado Tesis</label>
                                    <select class="form-control" name="grado" id="grado" required></select>
                                </div>
                                
                            </div>

                            

                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <label>area</label>
                                    <select id="area" name="area" class="form-control"></select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>campo</label>
                                    <select id="campo" name="campo" class="form-control">  </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>diciplina</label>
                                    <select id="disciplina" name="disciplina" class="form-control"></select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>subdiciplina</label>
                                    <select id="subdisciplina" name="subdisciplina" class="form-control"></select>
                                </div>
                            </div>


                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar">
                                <i class="fa fa-save"></i> Guardar</button>
                                <button class="btn btn-danger" onclick="cancelarform()" type="button">
                                <i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                                <select style="visibility:hidden" name="cvu" id="cvu" class="form-control"></select>
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
<script type="text/javascript" src="scripts/tesis.js"></script>

<?php
require 'footer.php';
?>