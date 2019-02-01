<?php
/* TODO
    *terminar estilos
    *revisar en formato PDO
    *Asociar con cada usuario las notificaciones
    modal para notificaciones nuevas
    cards paa perfiles
    crear querys para busquedas
    crear barra de filtros (lateral)
    seccion para administrar los tickets

*/
// require ('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->

    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/animate.css">
    <script src="js/notificaciones.js"></script>
    <title>Administrador</title>
</head>

<!-- para activar el modal el botón de mostrar tiene un atributo -->
<body><!-- Modal -->

<div class="modal fade" id="modal_nuevo_ticket" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="LabelModal">Crear nuevo Ticket</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
        <label>Fecha de finalización</label>
        <br>
            <input type="text" name="date" id="date" class="form-control">
        </div>
        <div class="form-group">
        <label>Link de la convocatoria</label>
        <br>
            <input type="link" id="link_conv" class="form-control">
        </div>
     </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="cancelar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" name="post" id="publicar_ticket"class="btn btn-primary" data-dismiss="modal" >Publicar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_detalles" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="LabelModal"><strong> Título del ticket</strong></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h4 class="text-center"><strong>Contenido:</strong></h4>
      <div id="card-content">
        <p class="text-justify">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam labore distinctio iure placeat corrupti accusamus odit facilis repudiandae. Asperiores eos dolorum consequuntur dolor dicta voluptates iure rem praesentium, cum sapiente.
        </p>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="cancelar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" >Aceptar</button>
      </div>
    </div>
  </div>
</div>


<header>

            <br>
            <br> 
            <div class="container-fluid">
                <nav class="navbar navbar-default navbar-fixed-top">

                    <div class="nav-main">
                        <nav class="navbar navbar-inverse">
                          <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="/">
                                Inicio
                              </a>
                            </div>
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9"> 
                                <ul class="nav navbar-nav"> 
                                    <li class="nav-item">
                                        <a class="nav-link" href="cvuinfobasic.php">CVU</a>
                                    </li>
                                     <li class="nav-item">
                                        <a class="nav-link" href="/BancoProyecto">Banco de proyectos</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="/Tickets">Tickets</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Imprimit</a>
                                    </li>
                                    <li class="nav-item nav-right dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Datos
                                          </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item" href="#">Perfil</a>
                                            <a class="dropdown-item" href="../../ajax/usuarios.php?op=salir"> Salir</a>
                                        </div>
                                    </li>
                                </ul> 
                            </div>
                          </div>
                        </nav>
                    </div>

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
                            
                            <li class="nav-item active"    style="margin: 10px;">                            
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_nuevo_ticket">
                                Crear Ticket                                
                                </button>                                
                                <button type="button" id="btn_reporte"class="btn btn-primary">
                                Generar Reporte                                
                                </button>
                            </li>     
                                       
                            <!-- <li class="dropdown" id="barra">
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
                                </li>                                     -->
                                <li class="barra_buscar">
                                <form class="form-inline my-2 my-lg-0">
                                <input id="buscar_ticket" class="form-control mr-sm-2" type="search" placeholder="Búsqueda" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                                </form>
                                </li>
                                </ul>
                    </div>
                </nav>
                <br />
                <h2 align="center">Sistema de notificaciones</h2>
                <br />                                    
            </div>
</header>
    <div class="container-fluid">
        <div class="row">
            <div class="card-deck" id="tickets">
            </div>        
	    </div> <!--end row-->
    </div><!--  end container -->
</body>
</html>