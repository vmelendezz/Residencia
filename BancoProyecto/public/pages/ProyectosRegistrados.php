<div class="container">
  <h2 style="text-align: center">Historial de proyectos Registrados</h2> 
  <input class="form-control" id="myInput" type="text" placeholder="Buscar proyecto">
  <br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nombre del proyecto</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>      
      </tr>
    </thead>
    <tbody id="myTable">
    </tbody>
  </table>
</div>

<script id="tmp-proyectosRegistrados" type="text/template">
  <tr id="proyecto-<%= id %>" >
    <td><%= titulo %></td>
    <td><a href="/BancoProyecto/SolicitudApoyo?id=<%= id %>"><button id="<%= id %>" type="button" class="btn btn-primary">Editar Solicitud de Apoyo</button></a></td>
    <td><a href="/BancoProyecto/Protocolo?id=<%= id %>"><button id="<%= id %>" type="button" class="btn btn-primary">Editar Protocolo</button></a></td>
    <td><a href="/BancoProyecto/printSolicitudApoyo/<%= id %>"><button id="<%= id %>" type="button" class="btn btn-primary">Imprimir Solicitud de Apoyo</button></a></td>
    <td><a href="/BancoProyecto/printProtocolo/33"><button id="<%= id %>" type="button" class="btn btn-primary">Imprimir Protocolo</button></a></td>
    <td><button id="<%= id %>" type="button" class="btn btn-primary eliminarProyecto">Eliminar</button></td>
  <tr>
</script>