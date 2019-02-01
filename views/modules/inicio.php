<?php

ob_start();
session_start();

if(!isset($_SESSION['nombreusuario'])){
  require 'headerlog.php';
}
else{
    require 'header.php';
}

?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
          <h1>Inicio</h1>
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->


<?php

ob_end_flush();
require 'footer.php';
?>