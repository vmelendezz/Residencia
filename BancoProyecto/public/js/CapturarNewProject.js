(function(){

	function getUrlVars() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		vars[key] = value;
		});
		return vars;
	}

	var first = getUrlVars()["id"];
	var id = 0;
	var action = '';

	if( first !=  undefined ){
		id = first;
		action = 'modificar';
	}

	var aggregator = _.extend({}, Backbone.Events);

	var modelForm = Backbone.Model.extend({
	    //1-7 recibe cada una de las filas de los datos recibidos del servidor (modelos por separado)
	    //se agrega cada modelo a la colección y desencadena en evento (((((((((add))))))))
	    parse: function(response){
	        return response;
	    },
	});

	/* 
	- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	|                                       COLLECTIONS                                       |
	- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
	*/

	/*
	* Collection of tables definitions
	*///coleccion de modelos: recibe la respuesta del servidor, retorna un arreglo que contiene
	//los modelos que se agregaran en el siguiente paso
	//1-6 en este paso la lista de instituciones es la colección
	var FormsCollections = Backbone.Collection.extend({
	    model: modelForm,
	    parse: function(response){
	        return response;
	    }
	});

	var collectionFormsInfoGeneral = new FormsCollections();
	var collectionFormsModPoject = new FormsCollections();
	var collectionFormsProfeColab = new FormsCollections();
	var collectionFormsProgramAct = new FormsCollections();
	var collectionFormsPlanTrab = new FormsCollections();

	var collectionValuesForms = new FormsCollections();

	var html;


	/* 
	- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	|                                       View                                       |
	- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
	*/

//Se crea un objeto que hereda de Backbone
	var InfoGeneral = Backbone.View.extend({
		//atributos del objeto InfoGeneral

		//objeto principal de la clase actual del DOM guardado en cache para que no gaste recursos
		//1-3.1 
		el: '#info-general', //donde
		//1-3.2 que va a imprimir '#tmp-infoGenaral' en donde en '#info-general'
		template: _.template($('#tmp-infoGeneral').html()), //que (el template lo esta imprimiendo en info general)
		validada: false,
		next: false,
		events: {
			'submit #frmInfoGeneral': 'nextform',
		},
		post: '',

		//metodo de la clase que equivale al constructor
		initialize : function() {
			//1-2.- se ejecuta showForm
			this.showForm ();
		},

		//guarda en cache el formulario de la clase actual
		//1-4. se ejecuta render
		render : function (action, id) {
			//1-8. escucha por medio de add y ejecuta la función addElements cada vez que se agrega un modelo a la colección
			this.listenTo( this.collection, 'add', this.addElements );
			//paso 1
			this.collection.url = '/BancoProyecto/private/controller/controllerSolicitudApoyo.php?action=getInitInfoGeneral';
			//2. pide los datos en base a la url
			//1-5
			var contexto = this;
			this.collection.fetch().done(function(){

				var estructura = {};

				if( action == 'modificar'){
					$.post( "/BancoProyecto/private/controller/controllerSolicitudApoyo.php?action=ModificarSolicitud&id="+id, function( data ) {
					 	data = JSON.parse(data);

					 	estructura['dataInfoGeneral'] = {};
					 	estructura['dataInfoGeneral']['nombre'] = 'validarInfoGeneral';
					 	estructura['dataInfoGeneral']['campos'] = [];
					 	estructura['dataInfoGeneral']['campos'].push({
																      "nombre": "cmbxInstitucion",
																      "value": data.InformacionGeneral[0].idInstitucion
																    });
					 	estructura['dataInfoGeneral']['campos'].push({
																      "nombre": "txtTituloProject",
																      "value": data.InformacionGeneral[0].titulo
																    });
					 	estructura['dataInfoGeneral']['campos'].push({
																      "nombre": "txtResponsable",
																      "value": data.InformacionGeneral[0].responsable
																    });
					 	estructura['dataInfoGeneral']['campos'].push({
																      "nombre": "txtCorreo",
																      "value": data.InformacionGeneral[0].correo
																    });
					 	estructura['dataInfoGeneral']['campos'].push({
																      "nombre": "rbnSNI",
																      "value": data.InformacionGeneral[0].SNI
																    });
					 	estructura['dataInfoGeneral']['campos'].push({
																      "nombre": "txtNumero",
																      "value": data.InformacionGeneral[0].noSNI
																    });
					 	estructura['dataInfoGeneral']['campos'].push({
																      "nombre": "rbnTipoInvest",
																      "value": data.InformacionGeneral[0].tipoInvestigacion
																    });
						
					 	localStorage.setItem('dataInfoGeneral', JSON.stringify(  estructura['dataInfoGeneral']  ));
						contexto.cargarDatos( estructura['dataInfoGeneral'] );

					});
				}else{
					var data = localStorage.getItem('dataInfoGeneral');
					if( data != null){
						data = JSON.parse(data);
						contexto.cargarDatos( data );
					}else{
						console.log('no cargar');
					}
				}

				
			});

			this.$form = this.$('#frmInfoGeneral');

			return this;
		},

		showForm : function() {
			//1-3. me voy a $el que contiene el lugar donde se va a imprimir el template
			this.$el.html( this.template() );
		},

		nextform : function (event) {
			event.preventDefault();
			this.post = this.validarForm(event);
			this.sendData( this.post );
		},

		//recorre formulario, guarda los datos y los manda al servidor para validarlos
		validarForm : function (event){
			post = '';
			for (var i = 0; i < event.target.length; i++) {

				if( event.target[i].type == 'radio'){
					if ( event.target[i].checked ) {
						post += event.target[i].name + '=' + $(event.target[i]).attr('value') + '&';
					}
				}else{
					post += event.target[i].name + '=' + event.target[i].value + '&';
				}
			}
			return post;
		}, 
		mensajesError : function(errores){
			html.contentErrors.show();
			html.errores.html('Errores <br>');
			for (var i = 0; i < errores.length; i++) {
				if( errores[i].validado == false ){
					html.errores.append('- '+errores[i].error+' <br>');
				}
			}
			setTimeout(function(){
				html.contentErrors.hide();
				html.errores.html('');
			},
			10000);
		},
		//1-9. recibe cada uno de los modelos guardados en la colección
		addElements : function( model ){
			if( model.attributes.nombre == 'cmbxInstitucion'){
				this.chargeSelect(model);
			}
		},

		sendData : function (post){
			var contexto = this;
			$.ajax({
				data: post,
				type: "POST",
				dataType:"json",
				url: "/BancoProyecto/private/controller/controllerSolicitudApoyo.php",
				success: function(response){
					console.log(response);
					if (response.validado == 1) {
						//guardar información y pasar al siguiente formulario
						var dataInfoGeneral = {"nombre" : response.data.action}
						dataInfoGeneral['campos'] = [];
						for (var campo in response.data){
							if( campo != 'action'){
								dataInfoGeneral['campos'].push({
									"nombre" : campo,
									"value" : response.data[campo]
								});
							}
						}
						//En esta linea se guardan los datos
						//dataInfoGeneral es un arreglo,con JSON.stringify lo conviertes en cadena y lo guarda en:
						//localStorage posicion 'dataInfoGeneral'
						localStorage.setItem('dataInfoGeneral', JSON.stringify( dataInfoGeneral ));
						//en esta linea los leo
						//con  JSON.parse reversas el cambio a como estaba, es ddecir de strin a array y lo imprimes
						console.log( JSON.parse( localStorage.getItem('dataInfoGeneral') ) );

						$('.nav-link ').removeClass('active');
						$('#tabModProyecto').addClass('active');

						contexto.$el.removeClass('active show');
						$('#Modalidad-del-proyecto').addClass('active show');
					}else{
						//mandar mensajes de error
						contexto.mensajesError(response.respuesta);
					}
				},

				error: function(jqxhr, textStatus, errorMessage){
					console.log(["error", [jqxhr, textStatus, errorMessage]]);
				}
			});
		},
		//1-10. funcion que se encarga de recorrer los options y los concatena 
		chargeSelect : function(model){
			var options = '<option value="-1">Selecciona una opción</option>';
			for (var i = 0; i < model.attributes.values.length ; i++) {
				options += '<option value="'+model.attributes.values[i]['id']+'">'+model.attributes.values[i]['nombre']+'</option>'
			}
			this.$form.find( 'select[name="'+model.attributes.nombre+'"]' ).html(options);
		},

		cargarDatos: function(data){
			for (var i = 0; i < data.campos.length; i++) {
				var campo = this.$form.find( 'input[name="'+data.campos[i].nombre+'"]' );

				if( campo.length == 1 ){
					campo.val(data.campos[i].value);
				}else if( campo.length > 1 ){
					if( $(campo[0]).attr('type') == 'radio' ){
						for (var j = 0; j < campo.length; j++) {
							if( data.campos[i].nombre == campo[j].name && data.campos[i].value == campo[j].value ){
								campo[j].checked = true;
							}
						}
					}
				}else{
					this.$form.find( 'select[name="'+data.campos[i].nombre+'"]' ).val(data.campos[i].value);
				}
				
			}
		}
		
	})

	var modProject = Backbone.View.extend({
		//atributos del objeto InfoGeneral

		//objeto principal de la clase actual del DOM guardado en cache para que no gaste recursos
		//1-3.1 
		el: '#Modalidad-del-proyecto', //donde
		//1-3.2 que va a imprimir '#tmp-infoGenaral' en donde en '#info-general'
		template: _.template($('#tmp-modProject').html()), //que (el template lo esta imprimiendo en info general)
		validada: false,
		next: false,
		events: {
			'submit #frmModProject': 'nextform',
			'change #porLineaNomProgram': 'changeLinea',
			'change #porInvesNomProgram': 'changeLinea',
			'change #porCuerpAcadNomProgram': 'changeLinea',
		},
		post: '',

		//metodo de la clase que equivale al constructor
		initialize : function() {
			//1-2.- se ejecuta showForm
			this.showForm ();
		},

		//guarda en cache el formulario de la clase actual
		//1-4. se ejecuta render
		render : function (action, id) {
			//1-8. escucha por medio de add y ejecuta la función addElements cada vez que se agrega un modelo a la colección
			this.listenTo( this.collection, 'add', this.addElements );
			//paso 1
			this.collection.url = '/BancoProyecto/private/controller/controllerSolicitudApoyo.php?action=getInitModProject';
			//2. pide los datos en base a la url
			//1-5
			this.collection.fetch();
			this.collection;

			var contexto = this;
			this.collection.fetch().done(function(){

				var estructura = {};

				if( action == 'modificar'){
					$.post( "/BancoProyecto/private/controller/controllerSolicitudApoyo.php?action=ModificarSolicitud&id="+id, function( data ) {
					 	data = JSON.parse(data);

					 	estructura['modalidadProyecto'] = {};
					 	estructura['modalidadProyecto']['nombre'] = 'validarModProject';
					 	estructura['modalidadProyecto']['campos'] = [];
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "rbnLicPos",
																      "value": data.ModalidadProyecto[0].orientacion
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "rbnHabPNPC",
																      "value": data.ModalidadProyecto[0].subOrientacion
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "cmbxProgramEdu",
																      "value": data.ModalidadProyecto[0].ProgramaPorLinea
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "cmbxLineInvest",
																      "value": data.ModalidadProyecto[0].LineaPorLinea
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "txtNumsni",
																      "value": data.ModalidadProyecto[0].SNIPorInv
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "cmbxNameProgramEdu",
																      "value": data.ModalidadProyecto[0].programaPorInv
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "cmbxLineInvestOrTrab",
																      "value": data.ModalidadProyecto[0].lineaPorInv
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "txtNumprodep",
																      "value": data.ModalidadProyecto[0].promepPorInv
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "txtVigNombramiento",
																      "value": data.ModalidadProyecto[0].vigencia
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "rbnCuerpo",
																      "value": data.ModalidadProyecto[0].tipoCuerpo
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "cmbxNameCuerpoAc",
																      "value": data.ModalidadProyecto[0].cuerpoAcademico
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "cmbxProgramEducativo",
																      "value": data.ModalidadProyecto[0].programaPorCuerpo
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "cmbxLineInvestCuerpo",
																      "value": data.ModalidadProyecto[0].lineaPorCuerpo
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "datefechaModProject",
																      "value": data.ModalidadProyecto[0].fecha
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "txtNumber",
																      "value": data.ModalidadProyecto[0].duracion
																    });
					 	estructura['modalidadProyecto']['campos'].push({
																      "nombre": "txtHorasDes",
																      "value": data.ModalidadProyecto[0].horasRequeridas
																    });
						estructura['modalidadProyecto']['campos'].push({
																      "nombre": "txtVigNombramiento",
																      "value": data.ModalidadProyecto[0].vigencia
																    });
						estructura['modalidadProyecto']['campos'].push({
																      "nombre": "rbnCuerpo",
																      "value": data.ModalidadProyecto[0].orientacionCuerpo
																    });	


					 	localStorage.setItem('modalidadProyecto', JSON.stringify(  estructura['modalidadProyecto']  ));
						contexto.cargarDatos( estructura['modalidadProyecto'] );

					});
				}else{
					var data = localStorage.getItem('modalidadProyecto');
					if( data != null){
						data = JSON.parse(data);
						contexto.cargarDatos( data );
					}else{
						console.log('no cargar');
					}
				}
			});

			this.$form = this.$('#frmModProject');
			return this;
		},

		showForm : function() {
			//1-3. me voy a $el que contiene el lugar donde se va a imprimir el template
			this.$el.html( this.template() );
		},

		nextform : function (event) {
			event.preventDefault();
			this.post = this.validarForm(event);
			this.sendData( this.post );
		},

		//recorre formulario, guarda los datos y los manda al servidor para validarlos
		validarForm : function (event){
			post = '';
			for (var i = 0; i < event.target.length; i++) {

				if( event.target[i].type == 'radio'){
					if ( event.target[i].checked ) {
						post += event.target[i].name + '=' + $(event.target[i]).attr('value') + '&';
					}
				}else{
					post += event.target[i].name + '=' + event.target[i].value + '&';
				}
			}
			return post;
		}, 
		mensajesError : function(errores){
			html.contentErrors.show();
			html.errores.html('Errores <br>');
			for (var i = 0; i < errores.length; i++) {
				if( errores[i].validado == false ){
					html.errores.append('- '+errores[i].error+' <br>');
				}
			}
			setTimeout(function(){
				html.contentErrors.hide();
				html.errores.html('');
			},
			10000);
		},
		//1-9. recibe cada uno de los modelos guardados en la colección
		addElements : function( model ){
			this.chargeSelect(model);
		},

		sendData : function (post){
			var contexto = this;
			$.ajax({
				data: post,
				type: "POST",
				dataType:"json",
				url: "/BancoProyecto/private/controller/controllerSolicitudApoyo.php",
				success: function(response){
					if (response.validado == 1) {
						//guardar información y pasar al siguiente formulario
						var modalidadProyecto = {"nombre" : response.data.action}
						modalidadProyecto['campos'] = [];

						for (var campo in response.data){
							if( campo != 'action'){
								modalidadProyecto['campos'].push({
									"nombre" : campo,
									"value" : response.data[campo]
								});
							}
						}
						//En esta linea se guardan los datos
						//modalidadProyecto es un arreglo,con JSON.stringify lo conviertes en cadena y lo guarda en:
						//localStorage posicion 'modalidadProyecto'
						localStorage.setItem('modalidadProyecto', JSON.stringify( modalidadProyecto ));
						//en esta linea los leo
						//con  JSON.parse reversas el cambio a como estaba, es ddecir de strin a array y lo imprimes
						console.log( JSON.parse( localStorage.getItem('modalidadProyecto') ) );

						$('.nav-link ').removeClass('active');
						$('#tabPofCol').addClass('active');

						contexto.$el.removeClass('active show');
						$('#ColaboradoresP').addClass('active show');
					}else{
						//mandar mensajes de error
						contexto.mensajesError(response.respuesta);
					}
				},

				error: function(jqxhr, textStatus, errorMessage){
					console.log(["error", errorMessage]);
				}
			});
		},
		//1-10. funcion que se encarga de recorrer los options y los concatena 
		chargeSelect : function(model){
			var options = '<option value="-1">Selecciona una opción</option>';
			for (var i = 0; i < model.attributes.values.length ; i++) {
				options += '<option value="'+model.attributes.values[i]['id']+'">'+model.attributes.values[i]['nombre']+'</option>'
			}
			this.$form.find( 'select[name="'+model.attributes.nombre+'"]' ).html(options);
		},

		changeLinea : function(event){
			this.getLinea(event.target.id, event.target.value);
		},

		getLinea: function(lineId, value, callback){
			var contextoGeneral = this;
			$.get("/BancoProyecto/private/controller/controllerSolicitudApoyo.php?action=get"+lineId+'&id='+value, function(data){
					contextoGeneral.collection.create(JSON.parse(data),
					{
						wait: true,
						success: function(model, response){
							if(callback){
								callback(data);
							};
							//console.log(response);	
						},
						error: function(model, response){
							//console.log(response);
						}
					});
				});
		},

		cargarDatos: function(data){
			for (var i = 0; i < data.campos.length; i++) {
				var campo = this.$form.find( 'input[name="'+data.campos[i].nombre+'"]' );

				if( campo.length == 1 ){
					campo.val(data.campos[i].value);
				}else if( campo.length > 1 ){
					if( $(campo[0]).attr('type') == 'radio' ){
						for (var j = 0; j < campo.length; j++) {
							if( data.campos[i].nombre == campo[j].name && data.campos[i].value == campo[j].value ){
								campo[j].checked = true;
							}
						}
					}
				}else{
					var contextoGeneral = this;
					var campo = this.$form.find( 'select[name="'+data.campos[i].nombre+'"]' );
					campo.val(data.campos[i].value);
					if(data.campos[i].nombre == 'cmbxProgramEdu'){
						this.getLinea(campo[0].id, data.campos[i].value, function(respuesta){
							var idSelect = _.findWhere(data.campos, {nombre: "cmbxLineInvest"});
							var campo = contextoGeneral.$form.find( 'select[name="cmbxLineInvest"]' );
							campo.val(idSelect.value);
						});
					}else if(data.campos[i].nombre == 'cmbxNameProgramEdu'){
						this.getLinea(campo[0].id, data.campos[i].value, function(respuesta){
							var idSelect = _.findWhere(data.campos, {nombre: "cmbxLineInvestOrTrab"});
							var campo = contextoGeneral.$form.find( 'select[name="cmbxLineInvestOrTrab"]' );
							campo.val(idSelect.value);
						});
					}else if(data.campos[i].nombre == 'cmbxProgramEducativo'){
						this.getLinea(campo[0].id, data.campos[i].value, function(respuesta){
							var idSelect = _.findWhere(data.campos, {nombre: "cmbxLineInvestCuerpo"});
							var campo = contextoGeneral.$form.find( 'select[name="cmbxLineInvestCuerpo"]' );
							campo.val(idSelect.value);
						});
					}
	
				}
				
			}
		}
		
	})

	var colaboradores = Backbone.View.extend({
		//atributos del objeto InfoGeneral

		//objeto principal de la clase actual del DOM guardado en cache para que no gaste recursos
		//1-3.1 
		el: '#ColaboradoresP', //donde
		//1-3.2 que va a imprimir '#tmp-infoGenaral' en donde en '#info-general'
		template: _.template($('#tmp-Colaboradores').html()), //que (el template lo esta imprimiendo en info general)
		validada: false,
		next: false,
		events: {
			'submit #frmColaboradoresP': 'nextform',
			'click #button-add-colaborador': 'addColaborador',
			'click #button-addAlumno': 'addAlumno',
			'click #button-addResidente': 'addResidente',
		},
		post: '',

		tablesInfoProfesores: [],
		incorporarAlumnos: [],
		alumnosResidentes: [],

		//metodo de la clase que equivale al constructor
		initialize : function() {
			//1-2.- se ejecuta showForm
			this.showForm ();
		},

		//guarda en cache el formulario de la clase actual
		//1-4. se ejecuta render
		render : function (action, id) {
			//1-8. escucha por medio de add y ejecuta la función addElements cada vez que se agrega un modelo a la colección
			this.listenTo( this.collection, 'add', this.addElements );
			//paso 1
			this.collection.url = '/BancoProyecto/private/controller/controllerSolicitudApoyo.php?action=getInitColaboradores';
			//2. pide los datos en base a la url
			//1-5
			this.collection.fetch();
			this.$form = this.$('#frmColaboradoresP');
			this.$tableColaboradores = this.$('#table-colaboradores');
			this.$tmpColaborador =  _.template($('#tmp-Colaborador').html());
			this.$tableColaboradores.on('click', '.delete-row', function(event){
				console.log($(event.target).parent().parent().remove());
			});

			this.$tableAlumnos = this.$('#table-alumnos');
			this.$tmpAlumno =  _.template($('#tmp-Alumnos').html());
			this.$tableAlumnos.on('click', '.delete-row', function(event){
				console.log($(event.target).parent().parent().remove());
			});

			this.$tableResidentes = this.$('#table-residentes');
			this.$tmpResidente =  _.template($('#tmp-Residente').html());
			this.$tableResidentes.on('click', '.delete-row', function(event){
				console.log($(event.target).parent().parent().remove());
			});

			var contexto = this;

			var estructura = {};

			if( action == 'modificar'){
				$.post( "/BancoProyecto/private/controller/controllerSolicitudApoyo.php?action=ModificarSolicitud&id="+id, function( data ) {
				 	data = JSON.parse(data);
				 	console.log(data);

				 	estructura['colaboradores'] = {};
				 	estructura['colaboradores']['nombre'] = 'validarColaboradoresP';
				 	estructura['colaboradores']['campos'] = [];
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "textAreaObjetivos",
															      "value": data.ProfesoresColaboradores[0].objetivoGeneral
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "textAreaObjetivosEspecificos",
															      "value": data.ProfesoresColaboradores[1].objetivosEspecificos
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "txtLicProdEntreg",
															      "value": data.ProfesoresColaboradores.entregables.contribucion[0].licenciatura
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "txtMaestProdEntreg",
															      "value": data.ProfesoresColaboradores.entregables.contribucion[0].maestria
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "txtDocProdEntreg",
															      "value": data.ProfesoresColaboradores.entregables.contribucion[0].doctorado
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "articulosDivulgacionEnviados",
															      "value": data.ProfesoresColaboradores.entregables.prodacademica[0].artDivulgacion
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "articulosMemoriasEnviados",
															      "value": data.ProfesoresColaboradores.entregables.prodacademica[0].artMemoria
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "articulosArbitradas",
															      "value": data.ProfesoresColaboradores.entregables.prodacademica[0].artRevistArbitrada
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "articulosIndizadas",
															      "value": data.ProfesoresColaboradores.entregables.prodacademica[0].artRevistaIndizadas
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "capitulosEnviados",
															      "value": data.ProfesoresColaboradores.entregables.prodacademica[0].capLibroRevision
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "librosEditadosPublicados",
															      "value": data.ProfesoresColaboradores.entregables.prodacademica[0].libroPublicado
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "librosEnviados",
															      "value": data.ProfesoresColaboradores.entregables.prodacademica[0].libroRevision
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "memoriasCongreso",
															      "value": data.ProfesoresColaboradores.entregables.prodacademica[0].memoriaCongreso
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "otrosEspecificar",
															      "value": data.ProfesoresColaboradores.entregables.prodacademica[0].otros
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "patentesEnviados",
															      "value": data.ProfesoresColaboradores.entregables.prodacademica[0].patenteRegistro	
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "paquetesEnviados",
															      "value": data.ProfesoresColaboradores.entregables.prodacademica[0].pqtRegistro
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "prototipoEnviados",
															      "value": data.ProfesoresColaboradores.entregables.prodacademica[0].prototipoRegistro
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "rbnFinanciamiento",
															      "value": data.ProfesoresColaboradores[2].requiereFinanciamiento
															    });
				 	estructura['colaboradores']['campos'].push({
															      "nombre": "financiamiento",
															      "value": data.ProfesoresColaboradores[2].fuenteFinanciamiento
															    });

				 	var colaboradores = [];

				 	for (var i = 0; i <  data.ProfesoresColaboradores.colaboradores.length ; i++) {
				 		colaboradores.push({ 
				 			"txtNombreProfCol": data.ProfesoresColaboradores.colaboradores[i].nombre ,
						    "rbnProfesorTC-1": data.ProfesoresColaboradores.colaboradores[i].tiempoCompleto ,
						    "txtCorreoProfCol": data.ProfesoresColaboradores.colaboradores[i].correo ,
						    "rbnPerfilPromep-1": data.ProfesoresColaboradores.colaboradores[i].perfilPromep ,
						    "txtNivelSNI": data.ProfesoresColaboradores.colaboradores[i].nivelSNI
				 		});
				 	} 

				 	estructura['colaboradores']['campos'].push({
															      "nombre": "tablesInfoProfesores",
															      "value": JSON.stringify(colaboradores)
															    });

				 	var alumnosLicenciatura = [];

				 	for (var i = 0; i <  data.ProfesoresColaboradores.entregables.contribucion.incorporarAlumnos.length ; i++) {
				 		alumnosLicenciatura.push({ 
				 			"txtAlumProyectoProdEntreg": data.ProfesoresColaboradores.entregables.contribucion.incorporarAlumnos[i].alumno
				 		});
				 	} 

				 	estructura['colaboradores']['campos'].push({
															      "nombre": "incorporarAlumnos",
															      "value": JSON.stringify(alumnosLicenciatura)
															    });

				 	var alumnos = [];

				 	for (var i = 0; i <  data.ProfesoresColaboradores.entregables.contribucion.alumnosresidentes.length ; i++) {
				 		alumnos.push({ 
				 			"txtAlumProyectoProdEntreg": data.ProfesoresColaboradores.entregables.contribucion.alumnosresidentes[i].alumno
				 		});
				 	} 

				 	estructura['colaboradores']['campos'].push({
															      "nombre": "alumnosResidentes",
															      "value": JSON.stringify(alumnos)
															    });


				 	localStorage.setItem('colaboradores', JSON.stringify(  estructura['colaboradores']  ));
						contexto.cargarDatos( estructura['colaboradores'] );

				});
			}else{
				var data = localStorage.getItem('colaboradores');
				if( data != null){
					data = JSON.parse(data);
					contexto.cargarDatos( data );
				}else{
					console.log('no cargar');
				}
			}
			
			return this;
		},

		showForm : function() {
			//1-3. me voy a $el que contiene el lugar donde se va a imprimir el template
			this.$el.html( this.template() );
		},

		nextform : function (event) {
			event.preventDefault();
			this.post = this.validarForm(event);
			this.sendData( this.post );
		},

		readTables: function( Tbody, arrayTable ){
			var columnsTable1 = {};

			//Recorrer cada uno de los TR de la tabla
			for (var i = 0; i < Tbody[0].children.length ; i++) {
				// De cada TR obtiene los inputs
				var row = $(Tbody[0].children[i]).find('input');
				var columnsTable1 = {};
				//Recorre cada uno de los inputs
				for( var j = 0; j < row.length; j++ ){

					if( row[j].type == 'radio'){
						if ( row[j].checked ) {
							columnsTable1[ row[j].name ] =  $(row[j]).attr('value');
						}
					}else{
						columnsTable1[ row[j].name ] = row[j].value;
					}
				}
				arrayTable.push( columnsTable1 );
			}
		},

		fnTbInfoProfesores: function(){
			this.tablesInfoProfesores = [];
			this.readTables( $('#table-colaboradores tbody'), this.tablesInfoProfesores );
		},

		fnTbIncorporarAlumnos: function(){
			this.incorporarAlumnos = [];
			this.readTables( $('#table-alumnos tbody'), this.incorporarAlumnos );
		},

		fnTbAlumnosResidentes: function(){
			this.alumnosResidentes = [];
			this.readTables( $('#table-residentes tbody'), this.alumnosResidentes );
		},

		//recorre formulario, guarda los datos y los manda al servidor para validarlos
		validarForm : function (event){
			post = '';

			this.fnTbInfoProfesores();
			this.fnTbIncorporarAlumnos();
			this.fnTbAlumnosResidentes();
			
			for (var i = 0; i < $('.independiente').length; i++) {

				if( $('.independiente')[i].type == 'radio'){
					if ( $('.independiente')[i].checked ) {
						post += $('.independiente')[i].name + '=' + $($('.independiente')[i]).attr('value') + '&';
					}
				}else{
					post += $('.independiente')[i].name + '=' + $('.independiente')[i].value + '&';
				}
			}
			return post+
					'tablesInfoProfesores='+JSON.stringify(this.tablesInfoProfesores)+
					'&incorporarAlumnos='+JSON.stringify(this.incorporarAlumnos)+
					'&alumnosResidentes='+JSON.stringify(this.alumnosResidentes);
		}, 
		mensajesError : function(errores){
			html.contentErrors.show();
			html.errores.html('Errores <br>');
			for (var i = 0; i < errores.length; i++) {
				if( errores[i].validado == false ){
					html.errores.append('- '+errores[i].error+' <br>');
				}
			}
			setTimeout(function(){
				html.contentErrors.hide();
				html.errores.html('');
			},
			10000);
		},
		//1-9. recibe cada uno de los modelos guardados en la colección
		addElements : function( model ){
			if( model.attributes.nombre == 'Raul'){
				//
				this.chargeSelect(model);
			}
		},

		sendData : function (post){
			var contexto = this;
			$.ajax({
				data: post,
				type: "POST",
				dataType:"json",
				url: "/BancoProyecto/private/controller/controllerSolicitudApoyo.php",
				success: function(response){
					console.log(response);
					if (response.validado == 1) {
						//guardar información y pasar al siguiente formulario
						var colaboradores = {"nombre" : response.data.action}
						colaboradores['campos'] = [];

						for (var campo in response.data){
							if( campo != 'action'){
								colaboradores['campos'].push({
									"nombre" : campo,
									"value" : response.data[campo]
								});
							}
						}
						//En esta linea se guardan los datos
						//colaboradores es un arreglo,con JSON.stringify lo conviertes en cadena y lo guarda en:
						//localStorage posicion 'colaboradores'
						localStorage.setItem('colaboradores', JSON.stringify( colaboradores ));
						//en esta linea los leo
						//con  JSON.parse reversas el cambio a como estaba, es ddecir de strin a array y lo imprimes
						console.log( JSON.parse( localStorage.getItem('colaboradores') ) );

						$('.nav-link ').removeClass('active');
						$('#tabPrograma').addClass('active');

						contexto.$el.removeClass('active show');
						$('#Concentrado').addClass('active show');
					}else{
						//mandar mensajes de error
						contexto.mensajesError(response.respuesta);
					}
				},

				error: function(jqxhr, textStatus, errorMessage){
					console.log(["error", errorMessage]);
				}
			});
		},
		//1-10. funcion que se encarga de recorrer los options y los concatena 
		chargeSelect : function(model){
			var options = '<option value="0">Selecciona una opción</option>';
			for (var i = 0; i < model.attributes.values.length ; i++) {
				options += '<option value="'+model.attributes.values[i]['Raul']+'">'+model.attributes.values[i]['nombre']+'</option>'
			}
			$(this.$form[0][0]).html(options)
		},

		addColaborador : function(event){
			$(this.$tableColaboradores).find('tbody').append( this.$tmpColaborador( {
				num: $(this.$tableColaboradores).find('tbody')[0].children.length + 1
			} ) );
		},

		addAlumno : function(event){
			$(this.$tableAlumnos).find('tbody').append( this.$tmpAlumno( {
				num: $(this.$tableAlumnos).find('tbody')[0].children.length + 1
			} ) );
		},

		addResidente : function(event){
			$(this.$tableResidentes).find('tbody').append( this.$tmpAlumno( {
				num: $(this.$tableResidentes).find('tbody')[0].children.length + 1
			} ) );
		},

		cargarDatos: function(data){
			for (var i = 0; i < data.campos.length; i++) {
				var campo = this.$form.find( 'input[name="'+data.campos[i].nombre+'"]' );
				
				if( campo.length == 1 ){
					campo.val(data.campos[i].value);
				}else if( campo.length > 1 ){
					if( $(campo[0]).attr('type') == 'radio' ){
						for (var j = 0; j < campo.length; j++) {
							if( data.campos[i].nombre == campo[j].name && data.campos[i].value == campo[j].value ){
								campo[j].checked = true;
							}
						}
					}
				}else {
					var campo = this.$form.find( 'textarea[name="'+data.campos[i].nombre+'"]' );
					if( campo.length == 1 ){
						campo.val(data.campos[i].value);
					}else{
						var appendTable = ( data.campos[i].nombre == 'tablesInfoProfesores')?
							[this.$tableColaboradores, this.$tmpColaborador] : 
								( data.campos[i].nombre == 'incorporarAlumnos')?
									[this.$tableAlumnos, this.$tmpAlumno] :
										( data.campos[i].nombre == 'alumnosResidentes')? 
											[this.$tableResidentes, this.$tmpAlumno] : null;

											console.log(data);

						var table = JSON.parse( data.campos[i].value );

						$(appendTable[0]).find('tbody').html('');

						for (var j = 0; j < table.length; j++) {
							var obj = {};
							_.each(table[j], function(value, key){
								var label = key.split('-');
								if( label.length > 1 ){
									obj[label[0]] = value;
								}else{
									obj[key] = value;
								}
							});
							$(appendTable[0]).find('tbody').append( appendTable[1]( {
								num: $(appendTable[0]).find('tbody')[0].children.length + 1,
								obj: obj
							} ) );
						}
					}
				}
			}
		}
		
	})

	var programaActividades  = Backbone.View.extend({
		//atributos del objeto InfoGeneral

		//objeto principal de la clase actual del DOM guardado en cache para que no gaste recursos
		//1-3.1 
		el:  '#Concentrado', //donde
		//1-3.2 que va a imprimir '#tmp-infoGenaral' en donde en '#info-general'
		template: _.template($('#tmp-programaActividades').html()), //que (el template lo esta imprimiendo en info general)
		validada: false,
		next: false,
		events: {
			'submit #formProgramaActividades': 'nextform',
			'click #buttonAddActividad': 'addActividad',
		},
		post: '',
		tblProgramAct: [],
		tblPresupSolicitado: [],

		contRows:1,

		//metodo de la clase que equivale al constructor
		initialize : function() {
			//1-2.- se ejecuta showForm
			this.showForm ();
		},

		//guarda en cache el formulario de la clase actual
		//1-4. se ejecuta render
		render : function (action, id) {
			//1-8. escucha por medio de add y ejecuta la función addElements cada vez que se agrega un modelo a la colección
			this.listenTo( this.collection, 'add', this.addElements );
			//paso 1
			this.collection.url = '/BancoProyecto/private/controller/controllerSolicitudApoyo.php?action=getInitProgramaActivity';
			//2. pide los datos en base a la url
			//1-5
			this.collection.fetch();

			this.$form = this.$('#formProgramaActividades');

			this.$tableProgAct = this.$('#tableProgramActividades');
			this.$tmpProgActividades =  _.template($('#tmpProgramAct').html());
			this.$tableProgAct.on('click', '.delete-row', function(event){
				$(event.target).parent().parent().remove();
				var trs = $('.count');
				for (var i = 1; i <= trs.length; i++) {
					$(trs[i-1]).html(i);
				}
			});

			var contexto = this;
			var estructura = {};

			if( action == 'modificar'){
				$.post( "/BancoProyecto/private/controller/controllerSolicitudApoyo.php?action=ModificarSolicitud&id="+id, function( data ) {
				 	data = JSON.parse(data);
				 	console.log(data);

				 	var prograAct = [];

				 	for (var i = 0; i <  data.ProgramaDeActividades.actividades.length ; i++) {
				 		prograAct.push({ 
				 			"txtNomResponAct": data.ProgramaDeActividades.actividades[i].nombreResponsable,
				 			"txtActividad": data.ProgramaDeActividades.actividades[i].actividad,
				 			"txtPeriodoActiv": data.ProgramaDeActividades.actividades[i].periodo,
				 			"txtResultEntregables": data.ProgramaDeActividades.actividades[i].resultados,
				 			"txtPartidasSol": data.ProgramaDeActividades.actividades[i].partidaSolicitadas,
				 			"txtMontoSolicitadoActiv": data.ProgramaDeActividades.actividades[i].montoSolicitado,
				 			"txtDesBienes": data.ProgramaDeActividades.actividades[i].descripcionBienes,
				 		});
				 	}

				 	estructura['programaActividades'] = {}
				 	estructura['programaActividades']['campos'] = [];
				 	estructura['programaActividades']['nombre'] = 'validarProgramaActividades'
				 	estructura['programaActividades']['campos'].push({
															      "nombre": "tblProgramAct",
															      "value": JSON.stringify(prograAct)
															    });

				 	var actividad = [];

			 		actividad.push({ 
			 			"txtMaterialesMontOtrasInst": data.ProgramaDeActividades[0].montoOtorgadoInstitucionesMateriales ,
						"txtMaterialesMontOtorgarTec": data.ProgramaDeActividades[0].montoOtorgadoTecMateriales ,
						"txtMaterialesMontoDgest": data.ProgramaDeActividades[0].montoSolicitadoMateriales,
						"txtMaterialesTotal": data.ProgramaDeActividades[0].totalMateriales,
			 		});

			 		actividad.push({ 
			 			"txtServiciosMontOtrasInst": data.ProgramaDeActividades[0].montoOtorgadoInstitucionesServicios ,
						"txtServiciosMontOtorgarTec": data.ProgramaDeActividades[0].montoOtorgadoTecServicios ,
						"txtServiciosMontoDgest": data.ProgramaDeActividades[0].montoSolicitadoServicios,
						"txtServiciosTotal": data.ProgramaDeActividades[0].totalServicios
			 		});

			 		actividad.push({ 
			 			"txtTotalMontOtrasInst": data.ProgramaDeActividades[0].totalMontoOtorgadoInstituciones,
						"txtTotalMontOtorgarTec": data.ProgramaDeActividades[0].totalMontoOtorgadoTec,
						"txtTotalMontoDgest": data.ProgramaDeActividades[0].totalMontoSolicitado,
						"txtTotalDeTotales": data.ProgramaDeActividades[0].total,
			 		});

				 	estructura['programaActividades']['campos'].push({
															      "nombre": "tblPresupSolicitado",
															      "value": JSON.stringify(actividad)
															    });	

				 	localStorage.setItem('programaActividades', JSON.stringify(  estructura['programaActividades']  ));
						contexto.cargarDatos( estructura['programaActividades'] );	 
				});
			}else{
				var data = localStorage.getItem('programaActividades');
				if( data != null){
					data = JSON.parse(data);
					contexto.cargarDatos( data );
				}else{
					console.log('no cargar');
				}
			}

			return this;
		},

		showForm : function() {
			//1-3. me voy a $el que contiene el lugar donde se va a imprimir el template
			this.$el.html( this.template() );
		},

		nextform : function (event) {
			event.preventDefault();
			this.post = this.validarForm(event);
			this.sendData( this.post );
		},

		readTables: function( Tbody, arrayTable ){
			var columnsTable1 = {};

			//Recorrer cada uno de los TR de la tabla
			for (var i = 0; i < Tbody[0].children.length ; i++) {
				// De cada TR obtiene los inputs
				var row = $(Tbody[0].children[i]).find('input');
				var columnsTable1 = {};
				//Recorre cada uno de los inputs
				for( var j = 0; j < row.length; j++ ){

					if( row[j].type == 'radio'){
						if ( row[j].checked ) {
							columnsTable1[ row[j].name ] =  $(row[j]).attr('value');
						}
					}else{
						columnsTable1[ row[j].name ] = row[j].value;
					}
				}
				arrayTable.push( columnsTable1 );
			}
			return 
		},

		fntableProgramAct: function(){
			this.tblProgramAct = [];
			this.readTables( $('#tableProgramActividades tbody'), this.tblProgramAct );
		},

		fntablePresupSolicitado: function(){
			this.tblPresupSolicitado = [];
			this.readTables($('#tablePresupSolicitado tbody'), this.tblPresupSolicitado);
		},

		//recorre formulario, guarda los datos y los manda al servidor para validarlos
		validarForm : function (event){
			post = '';

			this.fntableProgramAct();
			this.fntablePresupSolicitado();

			for (var i = 0; i < $('.independienteCol').length; i++) {

				if( $('.independienteCol')[i].type == 'radio'){
					if ( $('.independienteCol')[i].checked ) {
						post += $('.independienteCol')[i].name + '=' + $($('.independienteCol')[i]).attr('value') + '&';
					}
				}else{
					post += $('.independienteCol')[i].name + '=' + $('.independienteCol')[i].value + '&';
				}
			}

			return 	post+
					'tblProgramAct='+JSON.stringify(this.tblProgramAct)+
					'&tblPresupSolicitado='+JSON.stringify(this.tblPresupSolicitado);
		}, 
		mensajesError : function(errores){
			html.contentErrors.show();
			html.errores.html('Errores <br>');
			for (var i = 0; i < errores.length; i++) {
				if( errores[i].validado == false ){
					html.errores.append('- '+errores[i].error+' <br>');
				}
			}
			setTimeout(function(){
				html.contentErrors.hide();
				html.errores.html('');
			},
			10000);
		},
		//1-9. recibe cada uno de los modelos guardados en la colección
		addElements : function( model ){
			if( model.attributes.nombre == 'Raul'){
				//
				this.chargeSelect(model);
			}
		},

		sendData : function (post){
			var contexto = this;
			console.log( post );
			$.ajax({
				data: post,
				type: "POST",
				dataType:"json",
				url: "/BancoProyecto/private/controller/controllerSolicitudApoyo.php",
				success: function(response){
					if (response.validado == 1) {
						//guardar información y pasar al siguiente formulario
						var programaActividades = {"nombre" : response.data.action}
						programaActividades['campos'] = [];

						for (var campo in response.data){
							if( campo != 'action'){
								programaActividades['campos'].push({
									"nombre" : campo,
									"value" : response.data[campo]
								});
							}
						}
						//En esta linea se guardan los datos
						//programaActividades es un arreglo,con JSON.stringify lo conviertes en cadena y lo guarda en:
						//localStorage posicion 'programaActividades'
						localStorage.setItem('programaActividades', JSON.stringify( programaActividades ));
						//en esta linea los leo
						//con  JSON.parse reversas el cambio a como estaba, es ddecir de strin a array y lo imprimes
						console.log( JSON.parse( localStorage.getItem('programaActividades') ) );

						$('.nav-link ').removeClass('active');
						$('#tabPlanTrabajo').addClass('active');

						contexto.$el.removeClass('active show');
						$('#PlanDeTrabajo').addClass('active show');
					}else{
						//mandar mensajes de error
						contexto.mensajesError(response.respuesta);
					}
				},

				error: function(jqxhr, textStatus, errorMessage){
					console.log(["error", errorMessage]);
				}
			});
		},
		//1-10. funcion que se encarga de recorrer los options y los concatena 
		chargeSelect : function(model){
			var options = '<option value="0">Selecciona una opción</option>';
			for (var i = 0; i < model.attributes.values.length ; i++) {
				options += '<option value="'+model.attributes.values[i]['Raul']+'">'+model.attributes.values[i]['nombre']+'</option>'
			}
			$(this.$form[0][0]).html(options)
		},

		addActividad : function(event){
			console.log(event);
			this.contRows++;
			$(this.$tableProgAct ).find('tbody').append( this.$tmpProgActividades( {
				num: this.contRows
			} ) );

			var trs = $('.count');
			for (var i = 1; i <= trs.length; i++) {
				$(trs[i-1]).html(i);
			}
		},

		cargarDatos: function(data){
			var contextoGeneral = this;
			for (var i = 0; i < data.campos.length; i++) {

				var appendTable = ( data.campos[i].nombre == 'tblProgramAct')?
					[this.$tableProgAct, this.$tmpProgActividades] : null;

				var table = JSON.parse( data.campos[i].value );

				if( table.length == 3){
					for (var j = 0; j < table.length; j++) {
						var obj = {};
						_.each(table[j], function(value, key){
							var campo = contextoGeneral.$form.find( 'input[name="'+key+'"]' );
							if( campo.length == 1 ){
								campo.val(value);
							}
						});
					}
				}else{
					if( appendTable != null){

						$(appendTable[0]).find('tbody').html('');

						for (var j = 0; j < table.length; j++) {
							var obj = {};
							_.each(table[j], function(value, key){
								var label = key.split('-');
								if( label.length > 1 ){
									obj[label[0]] = value;
								}else{
									obj[key] = value;
								}
							});

							$(appendTable[0]).find('tbody').append( appendTable[1]( {
								num: $(appendTable[0]).find('tbody')[0].children.length + 1,
								obj: obj
							} ) );
						}
					}
				}
			}
		}
	})

	var planDeTrabajo= Backbone.View.extend({
		//atributos del objeto InfoGeneral

		//objeto principal de la clase actual del DOM guardado en cache para que no gaste recursos
		//1-3.1 
		el: '#PlanDeTrabajo', //donde
		//1-3.2 que va a imprimir '#tmp-infoGenaral' en donde en '#info-general'
		template: _.template($('#tmp-planDeTrabajo').html()), //que (el template lo esta imprimiendo en info general)
		validada: false,
		next: false,
		events: {
			'submit #formPlanDeTrabajo': 'nextform',
			'click #buttonAddDocencia': 'AddActDocenciaPT',
			'click #buttonAddTutoria': 'AddActTutoriaPT',
			'click #buttonAddDirTesis': 'AddDirTesis',
			'click #buttonAddInvest': 'AddActInvest',
			'click #buttonAddGestAcadem': 'AddActGestAcadem',			
		},
		post: '',
		tblActDocencia: [],
		tblActTutoria: [],
		tblActDireTesis: [],
		tblActInvest: [],
		tblActGestAcadem: [],

		//metodo de la clase que equivale al constructor
		initialize : function() {
			//1-2.- se ejecuta showForm
			this.showForm ();
		},

		//guarda en cache el formulario de la clase actual
		//1-4. se ejecuta render
		render : function (action, id) {
			//1-8. escucha por medio de add y ejecuta la función addElements cada vez que se agrega un modelo a la colección
			this.listenTo( this.collection, 'add', this.addElements );
			//paso 1
			this.collection.url = '/BancoProyecto/private/controller/controllerSolicitudApoyo.php?action=getInitPlanDeTrab';
			//2. pide los datos en base a la url
			//1-5
			this.collection.fetch();

			this.$form = this.$('#formPlanDeTrabajo');

			this.$tableAddDocencia = this.$('#tblAddDocencia');
			this.$tmpDocencia =  _.template($('#tmp-Docencia').html());
			this.$tableAddDocencia.on('click', '.delete-row', function(event){
				console.log($(event.target).parent().parent().remove());
			});

			this.$tableAddTutoria = this.$('#tblAddTutoria');
			this.$tmpTutoria =  _.template($('#tmp-Tuto').html());
			this.$tableAddTutoria.on('click', '.delete-row', function(event){
				console.log($(event.target).parent().parent().remove());
			});

			this.$tableAddDirTesis = this.$('#tblAddDirTesis');
			this.$tmpDirTesis=  _.template($('#tmp-DirecTesis').html());
			this.$tableAddDirTesis.on('click', '.delete-row', function(event){
				console.log($(event.target).parent().parent().remove());
			});

			this.$tableAddActInvest = this.$('#tblAddActInvest');
			this.$tmpActInvest =  _.template($('#tmp-ActInvest').html());
			this.$tableAddActInvest.on('click', '.delete-row', function(event){
				console.log($(event.target).parent().parent().remove());
			});

			this.$tableAddActGestAcadem = this.$('#tblAddGestAcadem');
			this.$tmpActGestAcadem =  _.template($('#tmp-ActGestAcadem').html());
			this.$tableAddActGestAcadem.on('click', '.delete-row', function(event){
				console.log($(event.target).parent().parent().remove());
			});

			var contexto = this;
			var estructura = {};

			if( action == 'modificar'){
				$.post( "/BancoProyecto/private/controller/controllerSolicitudApoyo.php?action=ModificarSolicitud&id="+id, function( data ) {
				 	data = JSON.parse(data);
				 	console.log(data);

				 	estructura['planTrabajo'] = {}
				 	estructura['planTrabajo']['campos'] = [];
				 	estructura['planTrabajo']['nombre'] = 'validarPlanTrabajo'

				 	var planTrab = [];

				 	for (var i = 0; i <  data.PlanDeTrabajo.actividadesDocencia.length; i++) {
				 		planTrab.push({ 
				 			"txtPTNomAsig": data.PlanDeTrabajo.actividadesDocencia[i].nombreAsigantura,
				 			"numberPTNoEstudi": data.PlanDeTrabajo.actividadesDocencia[i].noEstudiantes,
				 			"nivelDocente": (data.PlanDeTrabajo.actividadesDocencia[i].nivelMaestria != null)?
				 								data.PlanDeTrabajo.actividadesDocencia[i].nivelMaestria :
			 									data.PlanDeTrabajo.actividadesDocencia[i].nivelLicenciatura,
				 			"numberPTTeorica": data.PlanDeTrabajo.actividadesDocencia[i].horasTeorica,
				 			"numberPTTeoPrac": data.PlanDeTrabajo.actividadesDocencia[i].horasTeoricaPractica,
				 			"numberPTPractica": data.PlanDeTrabajo.actividadesDocencia[i].horasPractica,
				 			"txtPTTotal": data.PlanDeTrabajo.actividadesDocencia[i].totalHorasSemana,
				 		});
				 	}

				 	estructura['planTrabajo']['campos'].push({
															      "nombre": "tblActDocencia",
															      "value": JSON.stringify(planTrab)
															    });

				 	var actTutorias = [];

				 	for (var i = 0; i <  data.PlanDeTrabajo.actividadesTutoria.length; i++) {
				 		actTutorias.push({ 
				 			"txtPTNomAsig": data.PlanDeTrabajo.actividadesTutoria[i].nombreEstudiante,
				 			"numberPTNoEstudi": data.PlanDeTrabajo.actividadesTutoria[i].tipoTutoria,
				 			"nivelTutorias-1": (data.PlanDeTrabajo.actividadesTutoria[i].nivelMaestria != null)?
				 								data.PlanDeTrabajo.actividadesTutoria[i].nivelMaestria :
			 									data.PlanDeTrabajo.actividadesTutoria[i].nivelLicenciatura,
				 			"numberPTTeorica": data.PlanDeTrabajo.actividadesTutoria[i].horasTeorica,
				 			"numberPTTeoPrac": data.PlanDeTrabajo.actividadesTutoria[i].horasTeoricaPractica,
				 			"numberPTPractica": data.PlanDeTrabajo.actividadesTutoria[i].horasPractica,
				 			"txtPTTotal": data.PlanDeTrabajo.actividadesTutoria[i].totalHorasSemana,
				 		});
				 	}

				 	estructura['planTrabajo']['campos'].push({
															      "nombre": "tblActTutoria",
															      "value": JSON.stringify(actTutorias)
															    });

				 	var actDirTes = [];

				 	for (var i = 0; i <  data.PlanDeTrabajo.actividadesDireccionTesis.length; i++) {
				 		actDirTes.push({ 
				 			"txtPTNomAsig": data.PlanDeTrabajo.actividadesDireccionTesis[i].nombreEstudiante,
				 			"numberPTNoEstudi": data.PlanDeTrabajo.actividadesDireccionTesis[i].nombreTesis,
				 			"nivelTesis": (data.PlanDeTrabajo.actividadesDireccionTesis[i].nivelMaestria != null)?
				 								data.PlanDeTrabajo.actividadesDireccionTesis[i].nivelMaestria :
			 									data.PlanDeTrabajo.actividadesDireccionTesis[i].nivelLicenciatura,
				 			"datePTFechaTerm": data.PlanDeTrabajo.actividadesDireccionTesis[i].fechaTermino,
				 			"textPTTotalHrs": data.PlanDeTrabajo.actividadesDireccionTesis[i].totalHorasSemana,
				 		});
				 	}

				 	estructura['planTrabajo']['campos'].push({
															      "nombre": "tblActDireTesis",
															      "value": JSON.stringify(actDirTes)
															    });

				 	var actInvest = [];

				 	for (var i = 0; i <  data.PlanDeTrabajo.actividadesInvestigacion.length; i++) {
				 		actInvest.push({ 
				 			"textPTNomProject": data.PlanDeTrabajo.actividadesInvestigacion[i].nombreProyecto,
				 			"textPTFuncProject": data.PlanDeTrabajo.actividadesInvestigacion[i].funcionEnProyecto,
				 			"textPTPoductProject": data.PlanDeTrabajo.actividadesInvestigacion[i].productosEsperados,
				 			"textPTTotalHrs": data.PlanDeTrabajo.actividadesInvestigacion[i].totalHorasSemana,
				 		});
				 	}

				 	estructura['planTrabajo']['campos'].push({
															      "nombre": "tblActInvest",
															      "value": JSON.stringify(actInvest)
															    });

				 	var actGestAca = [];

				 	for (var i = 0; i <  data.PlanDeTrabajo.actividadesGestionAcademica.length; i++) {
				 		actGestAca.push({ 
				 			"textPTNomProject": data.PlanDeTrabajo.actividadesGestionAcademica[i].funcion,
				 			"textPTFuncProject": data.PlanDeTrabajo.actividadesGestionAcademica[i].descripcion,
				 			"textPTPoductProject": data.PlanDeTrabajo.actividadesGestionAcademica[i].productoEsperado,
				 			"textPTTotalHrs": data.PlanDeTrabajo.actividadesGestionAcademica[i].totalHorasSemana,
				 		});
				 	}

				 	estructura['planTrabajo']['campos'].push({
															      "nombre": "tblActGestAcadem",
															      "value": JSON.stringify(actGestAca)
															    });

				 	localStorage.setItem('planTrabajo', JSON.stringify(  estructura['planTrabajo']  ));
						contexto.cargarDatos( estructura['planTrabajo'] );		 
				});
			}else{
				var data = localStorage.getItem('planTrabajo');
				if( data != null){
					data = JSON.parse(data);
					contexto.cargarDatos( data );
				}else{
					console.log('no cargar');
				}
			}

			return this;
		},
	
		showForm : function() {
			//1-3. me voy a $el que contiene el lugar donde se va a imprimir el template
			this.$el.html( this.template() );
		},

		nextform : function (event) {
			event.preventDefault();
			this.post = this.validarForm(event);
			this.sendData( this.post );
		},

		readTables: function( Tbody, arrayTable ){
			var columnsTable1 = {};

			//Recorrer cada uno de los TR de la tabla
			for (var i = 0; i < Tbody[0].children.length ; i++) {
				// De cada TR obtiene los inputs
				var row = $(Tbody[0].children[i]).find('input');
				var columnsTable1 = {};
				//Recorre cada uno de los inputs
				for( var j = 0; j < row.length; j++ ){

					if( row[j].type == 'radio'){
						if ( row[j].checked ) {
							columnsTable1[ row[j].name ] =  $(row[j]).attr('value');
						}
					}else{
						columnsTable1[ row[j].name ] = row[j].value;
					}
				}
				arrayTable.push( columnsTable1 );
			}
		},

		fnActDocencia: function(){
			this.tblActDocencia = [];
			this.readTables( $('#tblAddDocencia tbody'), this.tblActDocencia );
		},
		fnActTutoria: function(){
			this.tblActTutoria = [];
			this.readTables( $('#tblAddTutoria tbody'), this.tblActTutoria );
		},
		fnActDireTesis: function(){
			this.tblActDireTesis = [];
			this.readTables( $('#tblAddDirTesis tbody'), this.tblActDireTesis );
		},
		fnActInvest: function(){
			this.tblActInvest = [];
			this.readTables( $('#tblAddActInvest tbody'), this.tblActInvest );
		},
		fnActGestAcadem: function(){
			this.tblActGestAcadem = [];
			this.readTables( $('#tblAddGestAcadem tbody'), this.tblActGestAcadem );
		},

		//recorre formulario, guarda los datos y los manda al servidor para validarlos
		validarForm : function (event){
			post = '';
			this.fnActDocencia();
			this.fnActTutoria();
			this.fnActDireTesis();
			this.fnActInvest();
			this.fnActGestAcadem();

			return 	'tblActDocencia='+JSON.stringify(this.tblActDocencia)+
					'&tblActTutoria='+JSON.stringify(this.tblActTutoria)+
					'&tblActDireTesis='+JSON.stringify(this.tblActDireTesis)+
					'&tblActInvest='+JSON.stringify(this.tblActInvest)+
					'&tblActGestAcadem='+JSON.stringify(this.tblActGestAcadem)+'&action=validarPlanTrabajo';
		}, 
		mensajesError : function(errores){
			html.contentErrors.show();
			html.errores.html('Errores <br>');
			for (var i = 0; i < errores.length; i++) {
				if( errores[i].validado == false ){
					html.errores.append('- '+errores[i].error+' <br>');
				}
			}
			setTimeout(function(){
				html.contentErrors.hide();
				html.errores.html('');
			},
			10000);
		},
		//1-9. recibe cada uno de los modelos guardados en la colección
		addElements : function( model ){
			if( model.attributes.nombre == 'Raul'){
				//
				this.chargeSelect(model);
			}
		},

		sendData : function (post){
			var contexto = this;
			$.ajax({
				data: post,
				type: "POST",
				dataType:"json",
				url: "/BancoProyecto/private/controller/controllerSolicitudApoyo.php",
				success: function(response){					

					if (response.validado == 1) {
						//guardar información y pasar al siguiente formulario
						var planTrabajo = {"nombre" : response.data.action}
						planTrabajo['campos'] = [];

						for (var campo in response.data){
							if( campo != 'action'){
								planTrabajo['campos'].push({
									"nombre" : campo,
									"value" : response.data[campo]
								});
							}
						}
						//En esta linea se guardan los datos
						//planTrabajo es un arreglo,con JSON.stringify lo conviertes en cadena y lo guarda en:
						//localStorage posicion 'planTrabajo'
						localStorage.setItem('planTrabajo', JSON.stringify( planTrabajo ));
						//en esta linea los leo
						//con  JSON.parse reversas el cambio a como estaba, es ddecir de strin a array y lo imprimes
						console.log( JSON.parse( localStorage.getItem('planTrabajo') ) );


						if( localStorage.getItem( 'dataInfoGeneral' ) != null &&
							localStorage.getItem( 'dataInfoGeneral' )  != '' &&
							
							localStorage.getItem( 'modalidadProyecto' ) != null &&
							localStorage.getItem( 'modalidadProyecto' )  != '' &&
							
							localStorage.getItem( 'colaboradores' ) != null &&
							localStorage.getItem( 'colaboradores' )  != '' &&
							
							localStorage.getItem( 'programaActividades' ) != null &&
							localStorage.getItem( 'programaActividades' )  != '' &&
							
							localStorage.getItem( 'planTrabajo' ) != null &&
							localStorage.getItem( 'planTrabajo' )  != '' ){

							if( confirm("Enviar solicitud de apoyo") ){
								var post = '';
								for (var i = 0; i < localStorage.length; i++) {
									post += localStorage.key(i)+'='+localStorage.getItem( localStorage.key(i) )+'&';
								}
								post += 'action=saveAllSolicitudApoyo&id='+id;
								contexto.sendAllData(post);
							}

						}else{
							alert('Formularios no han sido guardados');
						}

					}else{
						//mandar mensajes de error
						contexto.mensajesError(response.respuesta);
					}
				},

				error: function(jqxhr, textStatus, errorMessage){
					console.log(["error", errorMessage]);
				}
			});
		},
		//1-10. funcion que se encarga de recorrer los options y los concatena 
		chargeSelect : function(model){
			var options = '<option value="0">Selecciona una opción</option>';
			for (var i = 0; i < model.attributes.values.length ; i++) {
				options += '<option value="'+model.attributes.values[i]['Raul']+'">'+model.attributes.values[i]['nombre']+'</option>'
			}
			$(this.$form[0][0]).html(options)
		},

		AddActDocenciaPT : function(model){
			$(this.$tableAddDocencia).find('tbody').append( this.$tmpDocencia( {
				num: $(this.$tableAddDocencia).find('tbody')[0].children.length + 1
			} ) );
		},

		AddActTutoriaPT : function (model){
			$(this.$tableAddTutoria).find('tbody').append( this.$tmpTutoria( {
				num: $(this.$tableAddTutoria).find('tbody')[0].children.length + 1
			} ) );
		},
		
		AddDirTesis : function(model){
			$(this.$tableAddDirTesis).find('tbody').append( this.$tmpDirTesis( {
				num: $(this.$tableAddDirTesis).find('tbody')[0].children.length + 1
			} ) );
		},

		AddActInvest : function(model){
			console.log(model);
			$(this.$tableAddActInvest).find('tbody').append( this.$tmpActInvest( {
				num: $(this.$tableAddActInvest).find('tbody')[0].children.length + 1
			} ) );
		},

		AddActGestAcadem : function(model){
			$(this.$tableAddActGestAcadem).find('tbody').append( this.$tmpActGestAcadem( {
				num: $(this.$tableAddActGestAcadem).find('tbody')[0].children.length + 1
			} ) );
		},

		sendAllData : function( post){
			$.ajax({
				data: post,
				type: "POST",
				dataType:"text",
				url: "/BancoProyecto/private/controller/controllerSolicitudApoyo.php",
				success: function(response){
					if( response == '1'){
						localStorage.removeItem('colaboradores');
						localStorage.removeItem('dataInfoGeneral');
						localStorage.removeItem('modalidadProyecto');
						localStorage.removeItem('planTrabajo');
						localStorage.removeItem('programaActividades');
						alert('Formulario guardado');
						window.location.reload();
						$( "html, body" ).scrollTop(0);
					}else{
						alert('Error, cargar de nuevo los datos');
					}
				},

				error: function(jqxhr, textStatus, errorMessage){
					console.log(["error", errorMessage]);
				}
			});
		},

		cargarDatos: function(data){
			var contextoGeneral = this;

			for (var i = 0; i < data.campos.length; i++) {

				var appendTable = ( data.campos[i].nombre == 'tblActDocencia')?
					[this.$tableAddDocencia, this.$tmpDocencia] : 
						( data.campos[i].nombre == 'tblActTutoria')? 
							[this.$tableAddTutoria, this.$tmpTutoria] : 
								( data.campos[i].nombre == 'tblActDireTesis')?
									[this.$tableAddDirTesis, this.$tmpDirTesis] :
										( data.campos[i].nombre == 'tblActInvest')?
											[this.$tableAddActInvest, this.$tmpActInvest] :
												( data.campos[i].nombre == 'tblActGestAcadem')?
													[this.$tableAddActGestAcadem, this.$tmpActGestAcadem] :
														null;

				var table = JSON.parse( data.campos[i].value );
				console.log(table);
				if( table.length == 3){
					for (var j = 0; j < table.length; j++) {
						var obj = {};
						_.each(table[j], function(value, key){
							var campo = contextoGeneral.$form.find( 'input[name="'+key+'"]' );
							if( campo.length == 1 ){
								campo.val(value);
							}
						});
					}
				}else{
					if( appendTable != null){

						$(appendTable[0]).find('tbody').html('');
						for (var j = 0; j < table.length; j++) {
							var obj = {};
							_.each(table[j], function(value, key){
								var label = key.split('-');
								if( label.length > 1 ){
									obj[label[0]] = value;
								}else{
									obj[key] = value;
								}
							});

							$(appendTable[0]).find('tbody').append( appendTable[1]( {
								num: $(appendTable[0]).find('tbody')[0].children.length + 1,
								obj: obj
							} ) );
						}
					}
				}
			}
		}
	})

	//metodo jQuery que se ejecuta cuando se carga por completo el documento
	//main
	$(document).ready(function(){

		html = {
			contentErrors: $('.alert-danger'),
			errores : $('#erroresForm')
		};

		//se crea una instancia(copia) del objeto infoGeneral
		//1-1.- en el momento que se ejecuta la instancia, despues ejecuta el metodo inicialize

		var objInfoGeneral = new InfoGeneral ({ collection: collectionFormsInfoGeneral, });
		objInfoGeneral.render( action, id);

		var objModProject = new modProject({ collection: collectionFormsModPoject, });
		objModProject.render(action, id);

		var objColaboradores = new colaboradores({ collection: collectionFormsProfeColab});
		objColaboradores.render(action, id);

		var objProgActividades = new programaActividades({ collection: collectionFormsProgramAct});
		objProgActividades.render(action, id);

		var objPlanDeTrabajo = new planDeTrabajo({  collection: collectionFormsPlanTrab});
		objPlanDeTrabajo.render(action, id);

		$('#cleanForm').click(function(){
			if( confirm("Se eliminará toda la información del formulario ¿Desea continuar?")){
				localStorage.removeItem('colaboradores');
				localStorage.removeItem('dataInfoGeneral');
				localStorage.removeItem('modalidadProyecto');
				localStorage.removeItem('planTrabajo');
				localStorage.removeItem('programaActividades');
				window.location.reload();
			}
		});
	});
})();