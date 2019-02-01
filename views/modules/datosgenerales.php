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
                          <input type="hidden" name="datos" id="datos">

                                <div class="form-group col-md-4">
                                    <label >RFC</label>
                                   <input type="text" class="form-control" name="rfc" id="rfc" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label >Sexo</label>
                                    <select id="sexo" name="sexo" class="form-control" required>
                                    <option value='Mujer'>Mujer</option>
                                    <option value='Hombre '>Hombre</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label >Fecha nacimiento</label>
                                    <input type="date" class="form-control" name="fecha" id="fecha">
                                </div>
                          </div>
                          <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label >Pais de nacimiento</label>
                                   <input type="text" class="form-control" name ="pais" id="pais">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label >nacionalidad</label>
                                    <input type="text" class="form-control" name="nacionalidad" id="nacionalidad">
                                </div>
                                <div class="form-group col-md-3">
                                    <label >Entidad federativa</label>
                                   <input type="text" class="form-control" name="entidad" id="entidad">
                                </div>
                          </div>
                          <div class="form-row">
                               
                                <div class="form-group col-md-4">
                                    <label >numero conacyt</label>
                                    <input type="text" class="form-control" name="conacyt" id="conacyt">
                                </div>
                                <div class="form-group col-md-4">
                                    <label >numero promep</label>
                                    <input type="text" class="form-control" name="promep" id="promep">
                                </div>
                                <div class="form-group col-md-4">
                                    <label >numero tecmm</label>
                                    <input type="text" class="form-control" name="tecmm" id="tecmm">
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

    <script type="text/javascript" src="scripts/datosgenerales.js"></script>

<?php
require 'footer.php';
?>