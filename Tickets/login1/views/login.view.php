<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Inicio de sesion</title> 
</head>
<body>
    <div class="contenedor">
        <h1 class="titulo">Iniciar Sesión</h1>        
        <hr class="border">         
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
        class="formulario" name ="login"> 
        <!-- textbox para usuario -->
        <div class="form-group">
            <i class="icono izquierda fa fa-user"></i><input type="text" name="usuario" placeholder="Usuario" class="usuario">
        </div>           
        <!-- textbox para contraseña -->
        <div class="form-group">
            <i class="icono izquierda fa fa-lock"></i><input type="password" id="pw2"name="password" placeholder="Contraseña" class="password_btn">
            <i class="submit-btn fa fa-arrow-right" onclick="login.submit()"></i>
        </div>  
         <?php if (!empty($errores)) : ?>
        <div class="error">
            <ul>
                <?php echo $errores ?>
            </ul>
        </div>
        <?php endif ?>

        </form>
        <p class="texto-registrate">¿Aún no tienes una cuenta?
        <a href="registro.php">Regístrate</a>
        </p>
    </div>    
</body>
</html>