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


<script type="text/javascript" src="scripts/1.js"></script>


<?php
require 'footer.php';
?>