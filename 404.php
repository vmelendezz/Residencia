<?php

ob_start();
session_start();

if(!isset($_SESSION['nombreusuario'])){
  require 'views/modules/headerlog.php';
}
else{
    require 'views/modules/header.php';
}
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
          <h1>404</h1>
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->


<?php

ob_end_flush();
require 'views/modules/footer.php';
?>