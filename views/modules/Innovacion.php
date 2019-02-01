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
                        <h1 class="box-title">Innovacion
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
                                <div class="form-group col-md-4">
                                    <input type="hidden" name="innovacion" id="innovacion">
                                    <label> Tipo de innovacion OSLO</label>
                                    <select name="tipoInovacionOslo" id="tipoInovacionOslo" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label> Tipo de innovacion OSLO</label>
                                    <select name="tipoInovacion" id="tipoInovacion" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label> Aplicacion de innovacion OSLO</label>
                                    <select name="continua" id="continua" class="form-control">
                                    </select>
                                </div>
                    
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label> Potencial de cobertura</label>
                                    <select name="continua" id="continua" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Mecanismo de proteccion de propiedad intelectual</label>
                                    <select name="continua" id="continua" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Recibio apoyo de Conacyt?</label>
                                    <select name="continua" id="continua" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <label for="">sector Industrial SCIAN</label>

                           <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>sector</label>
                                    <select id="sector" name="sector" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>subsector</label>
                                    <select id="subsector" name="subsector" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>rama</label>
                                    <select id="rama" name="rama" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>subrama</label>
                                    <select id="subrama" name="subrama" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>clase</label>
                                    <select id="clase" name="clase" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <label for="">sector Industrial OCDE</label>
                           <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>sector</label>
                                    <select id="sectorOCDE" name="sectorOCDE" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>divicion</label>
                                    <select id="divicionOCDE" name="divicionOCDE" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>grupo</label>
                                    <select id="grupoOCDE" name="grupoOCDE" class="form-control">
                                    </select>
                                </div>
                               
                                <div class="form-group col-md-4">
                                    <label>clase</label>
                                    <select id="claseOCDE" name="claseOCDE" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <label for="">Area de conocimento</label>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>area</label>
                                    <select id="area" name="area" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>campo</label>
                                    <select id="campo" name="campo" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>diciplina</label>
                                    <select id="diciplina" name="diciplina" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>subdiciplina</label>
                                    <select id="subdiciplina" name="subdiciplina" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <label for="">Cantidad Anual</label>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Montos de Venta </label>
                                   <input type="text" id="campo" name="campo" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Valumen de producion</label>
                                    <input type="text" id="campo" name="campo" class="form-control">

                                </div>
                                <div class="form-group col-md-4">
                                    <label>No. empleos directos </label>
                                    <input type="text" id="campo" name="campo" class="form-control">

                                </div>
                                <div class="form-group col-md-4">
                                    <label>No. empleos indirectos</label>
                                    <input type="text" id="campo" name="campo" class="form-control">

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

<script type="text/javascript" src="scripts/otros.js"></script>
<?php
ob_end_flush();
require 'footer.php';
?>