<?php
$var = '0';
if($var== 1){
    require 'header.php';
}
else{
    require 'headerlog.php';
}

?>

       
        <form id="frmAcceso">
  <div class="form-group">
    <label >Email address</label>
    <input type="email" class="form-control" id="emails" name="emails" placeholder="email">
   
  </div>
  <div class="form-group">
    <label >Password</label>
    <input type="password" class="form-control" id="passwords" name="passwords" placeholder="Password">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    
  <script type="text/javascript" src="scripts/login.js"></script>

<?php
require 'footer.php';
?>


