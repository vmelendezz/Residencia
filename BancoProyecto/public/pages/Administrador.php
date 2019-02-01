<style>
	@media print{
		img.logo{
			width: 100%;
		}
	}
</style>
<div class="container">
	<h1 style="text-align: center;">Administrador</h1>
	<h3 class="col-12 col-sm-12 col-md-12" style="margin-top: 30px;" align="center">Programas y líneas de investigación</h3>
		<div>Tipo de programas: 
			<span>
				<select id="tipoInvestigacion">
					<option value="lineaInvestigacion">Programas de investigación</option>
					<option value="lineaCuerpoAcademico">Programas de cuerpo académico</option>
					<option value="procesoConsolidacion">Programas de proceso de consolidación</option>
				</select>
			</span>
		</div>
		<table id="tableAddProgramas" class="table table-bordered">
			<thead class="thead-dark">
				<tr>
					<th></th>
					<th></th>
					<th scope="col">Nombre del programa</th>
					<th scope="col">Líneas</th>
				</tr>
			</thead>
			<tbody id="tableAddProgramasBody">

			</tbody>
			<tfoot>
				<tr>
					<td colspan="9">
						<div id="btnAddPrograma" class="btn btn-default">
							Añadir
						</div>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="tableAddProgramas" class="table table-bordered">
			<thead class="thead-dark">
				<tr>
					<th></th>
					<th></th>
					<th scope="col">Nombre del la linea</th>
				</tr>
			</thead>
			<tbody id="tableAddLineasBody">

			</tbody>
			<tfoot>
				<tr>
					<td colspan="9">
						<div id="btnAddProgramaLinea" class="btn btn-default">
							Añadir
						</div>
					</td>
				</tr>
			</tfoot>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script id="tmp-programas" type="text/template">
	<tr id="<%= id %>">
		<td>
			<div  id="<%= id %>" class="btn btn-default delete-row editar">Editar</div>
		</td>
		<td>
			<div  id="<%= id %>" class="btn btn-default delete-row eliminar">Eliminar</div>
		</td>
		<td><%= nombre %></td>
		<td><div id="<%= id %>" class="btn btn-default delete-row lineas" data-toggle="modal" data-target="#exampleModal">Lineas</div></td>
	</tr>
</script>

<script id="tmp-lineas" type="text/template">
	<tr id="<%= id %>">
		<td>
			<div  id="<%= id %>" class="btn btn-default delete-row editarLinea">Editar</div>
		</td>
		<td>
			<div  id="<%= id %>" class="btn btn-default delete-row eliminarLinea">Eliminar</div>
		</td>
		<td><%= nombre %></td>
	</tr>
</script>