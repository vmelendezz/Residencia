
(function(){

	var aggregator = _.extend({}, Backbone.Events);

	var modelForm = Backbone.Model.extend({
	    //1-7 recibe cada una de las filas de los datos recibidos del servidor (modelos por separado)
	    //se agrega cada modelo a la colección y desencadena en evento (((((((((add))))))))
	    parse: function(response){
	    	console.log(response);
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
	    url: '/controller/controllerSolicitudApoyo.php',
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
		render : function () {
			//1-8. escucha por medio de add y ejecuta la función addElements cada vez que se agrega un modelo a la colección
			this.listenTo( this.collection, 'add', this.addElements );
			//paso 1
			this.collection.url = '/private/controller/controllerSolicitudApoyo.php?action=getInitInfoGeneral';
			//2. pide los datos en base a la url
			//1-5
			this.collection.fetch();

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
			html.errores.append('Errores <br>');
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
				url: "/private/controller/controllerSolicitudApoyo.php",
				success: function(response){
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
					console.log(["error", errorMessage]);
				}
			});
		},
		//1-10. funcion que se encarga de recorrer los options y los concatena 
		chargeSelect : function(model){
			var options = '<option value="0">Selecciona una opción</option>';
			for (var i = 0; i < model.attributes.values.length ; i++) {
				options += '<option value="'+model.attributes.values[i]['idInstitucion']+'">'+model.attributes.values[i]['nombre']+'</option>'
			}
			$(this.$form[0][0]).html(options);
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
		},
		post: '',

		//metodo de la clase que equivale al constructor
		initialize : function() {
			//1-2.- se ejecuta showForm
			this.showForm ();
		},

		//guarda en cache el formulario de la clase actual
		//1-4. se ejecuta render
		render : function () {
			//1-8. escucha por medio de add y ejecuta la función addElements cada vez que se agrega un modelo a la colección
			this.listenTo( this.collection, 'add', this.addElements );
			//paso 1
			this.collection.url = '/private/controller/controllerSolicitudApoyo.php?action=getInitModProject';
			//2. pide los datos en base a la url
			//1-5
			this.collection.fetch();

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
			html.errores.append('Errores <br>');
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
				url: "/private/controller/controllerSolicitudApoyo.php",
				success: function(response){
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
				options += '<option value="'+model.attributes.values[i]['idInstitucion']+'">'+model.attributes.values[i]['nombre']+'</option>'
			}
			$(this.$form[0][0]).html(options)
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
		},
		post: '',

		//metodo de la clase que equivale al constructor
		initialize : function() {
			//1-2.- se ejecuta showForm
			this.showForm ();
		},

		//guarda en cache el formulario de la clase actual
		//1-4. se ejecuta render
		render : function () {
			//1-8. escucha por medio de add y ejecuta la función addElements cada vez que se agrega un modelo a la colección
			this.listenTo( this.collection, 'add', this.addElements );
			//paso 1
			this.collection.url = '/private/controller/controllerSolicitudApoyo.php?action=getInitColaboradores';
			//2. pide los datos en base a la url
			//1-5
			this.collection.fetch();

			this.$form = this.$('#frmColaboradoresP');
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
			html.errores.append('Errores <br>');
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
				url: "/private/controller/controllerSolicitudApoyo.php",
				success: function(response){
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
		},
		post: '',

		//metodo de la clase que equivale al constructor
		initialize : function() {
			//1-2.- se ejecuta showForm
			this.showForm ();
		},

		//guarda en cache el formulario de la clase actual
		//1-4. se ejecuta render
		render : function () {
			//1-8. escucha por medio de add y ejecuta la función addElements cada vez que se agrega un modelo a la colección
			this.listenTo( this.collection, 'add', this.addElements );
			//paso 1
			this.collection.url = '/private/controller/controllerSolicitudApoyo.php?action=getInitProgramaActivity';
			//2. pide los datos en base a la url
			//1-5
			this.collection.fetch();

			this.$form = this.$('#formProgramaActividades');
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
			html.errores.append('Errores <br>');
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
				url: "/private/controller/controllerSolicitudApoyo.php",
				success: function(response){
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
		},
		post: '',

		//metodo de la clase que equivale al constructor
		initialize : function() {
			//1-2.- se ejecuta showForm
			this.showForm ();
		},

		//guarda en cache el formulario de la clase actual
		//1-4. se ejecuta render
		render : function () {
			//1-8. escucha por medio de add y ejecuta la función addElements cada vez que se agrega un modelo a la colección
			this.listenTo( this.collection, 'add', this.addElements );
			//paso 1
			this.collection.url = '/private/controller/controllerSolicitudApoyo.php?action=getInitPlanDeTrab';
			//2. pide los datos en base a la url
			//1-5
			this.collection.fetch();

			this.$form = this.$('#formPlanDeTrabajo');
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
			html.errores.append('Errores <br>');
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
				url: "/private/controller/controllerSolicitudApoyo.php",
				success: function(response){
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
		objInfoGeneral.render();

		var objModProject = new modProject({ collection: collectionFormsModPoject, });
		objModProject.render();

		var objColaboradores = new colaboradores({ collection: collectionFormsProfeColab});
		objColaboradores.render();

		var objProgActividades = new programaActividades({ collection: collectionFormsProgramAct});
		objProgActividades.render();

		var objPlanDeTrabajo = new planDeTrabajo({  collection: collectionFormsPlanTrab});
		objPlanDeTrabajo.render();
	});
})();