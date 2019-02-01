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
                        <h1 class="box-title">grupo investigacion
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

                                <div class="form-group col-md-6">
                                    <input type="hidden" name="investigacion" id="investigacion">
                                    <label>nombre del grupo</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="60" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>fecha de creacion</label>
                                    <input type="date" class="form-control" name="creacion" id="creacion" maxlength="60" placeholder="" required>

                                </div>

                                <div class="form-group col-md-3">
                                    <label>fecha de ingreso </label>
                                    <input type="text" class="form-control" name="ingreso" id="ingreso" maxlength="60" placeholder="" required>
                                </div>


                            </div>


                            <div class="form-row">
                                <label>Responsable o lider del grupo</label>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <label>nombre</label>
                                    <input type="text" class="form-control" name="nombreResponsable" id="asignacion" maxlength="60" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>primer apellido </label>
                                    <input type="text" class="form-control" name="primer" id="primer" maxlength="60" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>segundo apellido</label>
                                    <input type="text" class="form-control" name="segundo" id="segundo" maxlength="60" placeholder="" required>
                                </div>

                            </div>


                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label>institucion</label>
                                    <input type="text" class="form-control" name="institucion" id="institucion" maxlength="60" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total de investigadores</label>
                                    <input type="text" class="form-control" name="total" id="total" maxlength="60" placeholder="" required>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-8">
                                    <label>impacto</label>
                                    <textarea class="form-control" name="impacto" id="impacto" cols="30" rows="5"></textarea>
                                </div>

                                <div class="form-group col-md-8">
                                    <label>colaboracion</label>
                                    <textarea class="form-control" name="colaboracion" id="colaboracion" cols="30" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <label>area</label>
                                    <select id="area" name="area" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>campo</label>
                                    <select id="campo" name="campo" class="form-control">
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>diciplina</label>
                                    <select id="diciplina" name="diciplina" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>subdiciplina</label>
                                    <select id="subdiciplina" name="subdiciplina" class="form-control">
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
<script type="text/javascript" src="scripts/grupoinvestigacion.js"></script>


<?php
require 'footer.php';
?>