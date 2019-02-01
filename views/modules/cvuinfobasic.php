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
                   
                    <!-- /.box-header -->
                    <!-- centro -->
 
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                        
                          <div class="form-row">
                                 <input type="hidden" name="cvu" id="cvu">
                                <div class="form-group col-md-4">
                                  <label >Campus</label>
                                 <select id="Campus" name="Campus"class="form-control" required>
                                
                                </select>
                              </div>
                              <div class="form-group col-md-4">
                                <label >departamento</label>
                                <select id="departamento" name="departamento"class="form-control" required>
                                
                                </select>
                              </div>
                          </div> 
                         
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
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

<script type="text/javascript" src="scripts/cvuinfobasic.js"></script>

<?php
require 'footer.php';
?>

