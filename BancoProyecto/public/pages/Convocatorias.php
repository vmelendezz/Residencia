<div class="container">
	<h1 class="title-1" style="margin-top: 30px;" align="center">Banco de Proyectos</h1>
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
				    <h5 class="card-title">Titulo de la convocatoria</h5>
				    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus fugiat atque omnis, id, excepturi optio! Labore natus quaerat, aperiam sequi aut vitae quidem maxime, fugiat delectus fuga minima, aliquam corrupti.</p>
				    <button  type="button" class="btn btn-primary abrirModal" name="verConvocatoria" data-toggle="modal" data-target="#exampleModalLong" project="24"> Ver convocatoria </button>
				    <div class="row">
				    	<div class="col-6 col-md-6 col-sm-6">
							<button  type="button" class="btn btn-primary abrirModal" name="archivosAdjuntos" data-toggle="modal" data-target="#exampleModalLong" project="24">Archivos adjuntos </button>
						</div>
						<div class="col-6 col-md-6 col-sm-6">
							<button  type="button" class="btn btn-primary abrirModal" name="addPrject" data-toggle="modal" data-target="#exampleModalLong" project="24">Agregar proyecto </button>
						</div>
				    </div>
				  </div>
			</div>
		  
		</div>

	</div>
	
	<!-- Modal -->
	<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    
	  </div>
	</div>

	<script id="tmp-modal-ver" type="text/template">
		<div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	</script>
</div>