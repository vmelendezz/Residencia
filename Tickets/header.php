<?php
session_start();
if (!isset($_SESSION['usuario'])) 
{
    header("Location: index.php");
}
/* TODO
    *terminar estilos
    *revisar en formato PDO
    *Asociar con cada usuario las notificaciones
*/
?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Sistema de tickets</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
            <link rel="stylesheet" href="css/bootstrap.css">
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="css/estilos.css">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="js/notificaciones.js"></script>
        </head>

        <header>
            <br>
            <br>
            <div class="container-fluid">
                <nav class="navbar navbar-default navbar-fixed-top">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">Administrador</a>
                        </div>
                        <!-- botón de notificaciones -->
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown" >
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="notifi"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span></a>
                                <ul class="dropdown-menu scrollable-menu" id="notif"></ul>
                            </li>
                        </ul>

                        <!-- barra para generar notificaciones -->
                        <ul class="nav navbar-nav navbar-left">
                            <li class="nav-item active">
                                <a class="nav-link" href="cerrar.php" style="color:white;background:black;">Cerrar Sesión <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="dropdown" id="barra">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Notificaciones</b> <span class="caret"></span></a>
                                <ul id="login-dp" class="dropdown-menu">
                                    <li>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-md-12">
                                                Nuevo ticket
                                                <form method="post" id="comment_form">
                                                    <div class="form-group">
                                                        <label>Título</label>
                                                        <input type="text" name="subject" id="subject" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Descripción</label>
                                                        <textarea name="comment" id="comment" class="form-control" rows="5" style="resize:  vertical;"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" name="post" id="post" class="btn btn-info btn-block" value="Publicar" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                    </div>
                </nav>
                <br />
                <h2 align="center">Sistema de notificaciones</h2>
                <br />
                        <!-- formulario en el cuerpo, no en la barra -->
                        <!-- <form method="post" id="comment_form">
                        <div class="form-group">
                        <label>Enter Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control">
                        </div>
                        <div class="form-group">
                        <label>Enter Comment</label>
                        <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                        <input type="submit" name="post" id="post" class="btn btn-info" value="Post" />
                        </div>
                        </form> -->
                        
            </div>
        </header>