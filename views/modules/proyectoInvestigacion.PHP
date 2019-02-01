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
                        <h1 class="box-title">proyecto Investigacion
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

                                <div class="form-group col-md-10">
                                    <input type="hidden" name="investigacion" id="investigacion">
                                    <label>nombre del proyecto</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="60" placeholder="" required>
                                </div>
                                


                            </div>

                            <div class="form-row">

                                 <div class="form-group col-md-3">
                                    <label>tipo de proyecto</label>
                                    <select id="proyecto" name="proyecto" class="form-control">
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>fecha de inicio</label>
                                    <input type="date" class="form-control" name="inicio" id="inicio" maxlength="60" placeholder="" required>

                                </div>

                                <div class="form-group col-md-3">
                                    <label>fecha de fin </label>
                                    <input type="date" class="form-control" name="fin" id="fin" maxlength="60" placeholder="" required>
                                </div>


                            </div>



                            <div class="form-row">

                                 <div class="form-group col-md-3">
                                    <label>tipo de patrocinador</label>
                                    <select id="patrocinador" name="patrocinador" class="form-control">
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>nombre del patrocinados</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="60" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>monto</label>
                                    <input type="text" class="form-control" name="monto" id="monto" maxlength="60" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Resultados</label>
                                    <select id="Resultados" name="Resultados" class="form-control">
                                    </select>
                                </div>

                                

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-10">
                                    <label>institucion</label>
                                    <input type="text" class="form-control" name="institucion" id="institucion" maxlength="60" placeholder="" required>

                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label>actividades realizadas</label>
                                    <input type="text" class="form-control" name="actividades" id="actividades" maxlength="60" placeholder="" required>

                                </div>
                                <div class="form-group col-md-3">
                                    <label>Redumen pdf</label>
                                    <input type="text" class="form-control" name="" id="" maxlength="60" placeholder="" required>

                                </div>
                                <div class="form-group col-md-4">
                                    <label>considerar para curriculum de CA</label>
                                    <select id="Resultados" name="Resultados" class="form-control">
                                    </select>
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
<script type="text/javascript" src="scripts/proyectoInvestigacion.js"></script>


<?php
require 'footer.php';
?>