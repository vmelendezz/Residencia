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
                        <h1 class="box-title">otros
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
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                

                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <th>Opciones</th>
                                <th>nombre</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                

                            </tfoot>
                        </table>
                    </div>


                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                            <div class="form-row">
                                 <div class="form-group col-md-4">
                                    <input type="hidden" name="idioma" id="idioma">
                                    <label>institucion que otorga certificado</label>
                                    <input type="text" class="form-control" name="institucion" id="institucion" maxlength="60" placeholder="">

                                </div>
                                <div class="form-group col-md-4">
                                    <label>idioma</label>
                                    <select name="nombreidioma" id="nombreidioma" class="form-control">
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>GradoDominio </label>
                                    <input type="text" class="form-control" name="grado" id="grado" maxlength="60" placeholder="">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label>nivelConversacion </label>
                                    <input type="text" class="form-control" name="nivel" id="nivel" maxlength="60" placeholder="">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label>nivelLectura </label>
                                    <input type="text" class="form-control" name="lectura" id="lectura" maxlength="60" placeholder="">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label>nivelEscritura </label>
                                    <input type="text" class="form-control" name="escritura" id="escritura" maxlength="60" placeholder="">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Certificacion </label>
                                    <input type="text" class="form-control" name="certificacion" id="certificacion" maxlength="60" placeholder="">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label>fechaEvaluacion </label>
                                    <input type="date" class="form-control" name="evaluacion" id="evaluacion" maxlength="60" placeholder="">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label>documento </label>
                                    <input type="text" class="form-control" name="documento" id="documento" maxlength="60" placeholder="">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label>fecha de Vigencia Inicio </label>
                                    <input type="date" class="form-control" name="vigenciainicio" id="vigenciainicio" maxlength="60" placeholder="">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label>fecha de Vigencia Fin </label>
                                    <input type="date" class="form-control" name="vigenciafin" id="vigenciafin" maxlength="60" placeholder="">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Puntos </label>
                                    <input type="text" class="form-control" name="puntos" id="puntos" maxlength="60" placeholder="">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Nivel Conferido </label>
                                    <input type="text" class="form-control" name="conferido" id="conferido" maxlength="60" placeholder="">
                                    
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

<script type="text/javascript" src="scripts/idiomas.js"></script>
<?php
ob_end_flush();
require 'footer.php';
?>