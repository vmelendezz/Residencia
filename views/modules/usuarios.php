<?php


ob_start();
session_start();

if(!isset($_SESSION['nombreusuario'])){
  header("location:login.php");
}

else{
    require 'header.php';
    require 'barracvu.php';
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
                          <h1 class="box-title">Registro usuarios <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>email</th>
                            <th>nombre</th>
                            <th>paterno</th>
                            <th>materno</th>
                            <th>curp</th>
                            <th>estatus</th>
                            <th>estado civil</th>
                           
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>email</th>
                            <th>nombre</th>
                            <th>paterno</th>
                            <th>materno</th>
                            <th>curp</th>
                            <th>estatus</th>
                            <th>estado civil</th>
                            
                          </tfoot>
                        </table>
                    </div>

 
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                        
                          
                          <div class="form-row">
                             <div class="col-md-6 mb-3">
                                <input type="hidden" name="usuarionew" id="usuarionew">
        	                      <label >Emeil:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="" >
                              </div>
                              <div class="col-md-6 mb-3">
        	                      <label >password:</label>
                                <input type="password" class="form-control" name="password" id="password"  maxlength="64" placeholder="" >
                              </div>
                          </div> 

                          <div class="form-row">
                            <div class="col-md-4 mb-3">
                              <label>Nombre:</label>
                             
                              <input type="text" class="form-control" name="nombre" id="nombre" maxlength="30" placeholder="nombre"  >
                            </div>
                            <div class="col-md-4 mb-3">
                              <label >Apellido Paterno:</label>
                              <input type="text" class="form-control" name="paterno"  id="paterno" maxlength="60" placeholder="paterno"  >
                            </div>
                            <div class="col-md-4 mb-3">
                              <label >Apellido Materno:</label>
                              <input type="text" class="form-control" name="materno" id="materno" maxlength="20"placeholder="materno"  >
                            </div>
                          </div>
                            
                          <div class="form-row">
                             <div class="col-md-6 mb-3">
        	                      <label >Curp:</label>
                                <input type="text" class="form-control" name="Curp" id="Curp" placeholder="" >
                              </div>
                              <div class="form-group col-md-4">
                                <label >estado civil</label>
                                <select id="id_estadocivil" name="id_estadocivil"class="form-control" >
                                </select>
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
  <script type="text/javascript" src="scripts/usuarios.js"></script>
<?php
require 'footer.php';
?>
