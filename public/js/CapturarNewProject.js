<<<<<<< HEAD
(function(){

	var aggregator = _.extend({}, Backbone.Events);

	var modelForm = Backbone.Model.extend({
	    defaults: {
	        'title': '',
	        'inputs': {},
	    },
	    //2. recibe cada una de las filas de los datos recibidos del servidor (modelos por separado)
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
	*///1. coleccion de modelos: recibe la respuesta del servidor, retorna un arreglo que contiene
	//los modelos que se agregaran en el siguiente paso
	var FormsCollections = Backbone.Collection.extend({
	    model: modelForm,
	    url: '/controller/controllerSolicitudApoyo.php',
	    parse: function(response){
	        if(response.validado == 1){
	            return response.usuarios;
	        } else {
	            console.log("No se encontro información del formulario");
	        }
	    }
	});

	var collectionForms = new FormsCollections();

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
		el: '#info-general', //donde
		template: _.template($('#tmp-infoGenaral').html()), //que
		validada: false,
		next: false,
		events: {
			'submit #frmInfoGeneral': 'nextform',
		},
		post: '',

		//metodo de la clase que equivale al constructor
		initialize : function() {
			this.showForm ();
		},

		//guarda en cache el formulario de la clase actual
		render : function () {
			//3. escucha por medio de add y ejecuta la función addElements cada vez que se agrega un modelo a la colección
			this.listenTo( this.collection, 'add', this.addElements );

			this.collection.fetch();

			this.$form = this.$('#frmInfoGeneral');
			return this;
		},

		showForm : function() {
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
			console.log(errores);
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
		//4. recibe cada uno de los modelos guardados en la colección
		addElements : function( model ){
			console.log(collectionForms);
		},

		sendData : function (post){
			var contexto = this;
			$.ajax({
				data: post,
				type: "POST",
				dataType:"json",
				url: "/controller/controllerSolicitudApoyo.php",
				success: function(response){
					console.log(response);
					if (response.validado == 1) {
						//guardar información y pasar al siguiente formulario
					}else{
						//mandar mensajes de error
						contexto.mensajesError(response.respuesta);
					}
				},

				error: function(jqxhr, textStatus, errorMessage){
					console.log(["error", errorMessage]);
				}
			});
		}
		
	})
	var modProject = Backbone.View.extend({

		el: '#Modalidad-del-proyecto',
		template: _.template($('#tmp-modProject').html()),
		validada: false,
		next: false,
		events: {
			'submit #frmModProject': 'nextform',
		},
		post: '',
		initialize : function() {
			this.showForm ();
		},

		render : function () {
			this.$form = this.$('#frmModProject');
		},
		showForm : function() {
			this.$el.html(this.template() );
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
		sendData : function (post){
			console.log(post);
			$.ajax({
				data: post,
				type: "POST",
				dataType:"text",
				url: "/controller/controllerSolicitudApoyo.php",
				success: function(response){
					console.log(response.data);
				},
				error: function(jqxhr, textStatus, errorMessage){
					console.log(["error", errorMessage]);
				}
			});
		}	

	})

	var colaboradores = Backbone.View.extend({

		el: '#ColaboradoresP',
		template: _.template($('#tmp-Colaboradores').html()),
		validada: false,
		next: false,
		events: {
			'submit #frmColaboradoresP': 'nextform',
		},
		post: '',

		initialize : function(){
			this.showForm();
		},

		render : function () {
			this.$form = this.$('#frmColaboradoresP');
		},

		showForm : function () {
			this.$el.html(this.template());
		},
		nextform : function (event) {
			event.preventDefault();
			this.post = this.validarForm(event);
			this.sendData( this.post );
		},
	})

	var programaActividades = Backbone.View.extend({

		el: '#Concentrado',
		template: _.template($('#tmp-programaActividades').html()),
		validada: false,
		next: false,
		events: {
			'submit #formProgramaActividades': 'nextform',
		},
		post: '',

		initialize : function(){
			this.showForm();
		},

		render : function () {
			this.$form = this.$('#formProgramaActividades');
		},

		showForm : function () {
			this.$el.html(this.template());
		},
		nextform : function (event) {
			event.preventDefault();
			this.post = this.validarForm(event);
			this.sendData( this.post );
		},
	})

	var planDeTrabajo = Backbone.View.extend({

		el: '#PlanDeTrabajo',
		template: _.template($('#tmp-planDeTrabajo').html()),
		validada: false,
		next: false,
		events: {
			'submit #formPlanDeTrabajo': 'nextform',
		},
		post: '',

		initialize : function(){
			this.showForm();
		},

		render : function () {
			this.$form = this.$('#formPlanDeTrabajo');
		},

		showForm : function () {
			this.$el.html(this.template());
		},
		nextform : function (event) {
			event.preventDefault();
			this.post = this.validarForm(event);
			this.sendData( this.post );
		},
	})

	
	//metodo jQuery que se ejecuta cuando se carga por completo el documento
	$(document).ready(function(){

		html = {
			contentErrors: $('.alert-danger'),
			errores : $('#erroresForm')
		};

		//se crea una instancia(copia) del objeto infoGeneral
		var objInfoGeneral = new InfoGeneral ({ collection: collectionForms, });
		objInfoGeneral.eventos = aggregator;
		objInfoGeneral.render();

		var objModProject = new modProject();
		objModProject.render();

		var objColaboradores = new colaboradores();
		objColaboradores.render();

		var objProgActividades = new programaActividades();
		objProgActividades.render();

		var objPlanDeTrabajo = new planDeTrabajo();
		objPlanDeTrabajo.render();
	});

=======
(function(){

	var html;

//Se crea un objeto que hereda de Backbone
	var InfoGeneral = Backbone.View.extend({
		//atributos del objeto InfoGeneral

		//objeto principal de la clase actual del DOM guardado en cache para que no gaste recursos
		el: '#info-general', //donde
		template: _.template($('#tmp-infoGenaral').html()), //que
		validada: false,
		next: false,
		events: {
			'submit #frmInfoGeneral': 'nextform',
		},
		post: '',

		//metodo de la clase que equivale al constructor
		initialize : function() {
			this.showForm ();
		},

		//guarda en cache el formulario de la clase actual
		render : function () {
			this.$form = this.$('#frmInfoGeneral');
		},

		showForm : function() {
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
			console.log(errores);
			html.contentErrors.show();

			html.errores.append('Errores <br>');
			for (var i =0; i <= errores.length; i++) {
				for(var key in errores[i]) {
					if( errores[i][key] == false ){
						if( key== 'correo' )
							html.errores.append('- Correo <br>');
						if(  key == 'SNI' )
							html.errores.append('- SNI <br>');
						if(  key == 'tipoInvestigacion' )
							html.errores.append('- Tipo de investigación <br>');
					}
				}
			}

			setTimeout(function(){
				html.contentErrors.hide();
				html.errores.html('');
			},
			10000);
		},

		sendData : function (post){
			var contexto = this;
			$.ajax({
				data: post,
				type: "POST",
				dataType:"json",
				url: "/controller/controllerSolicitudApoyo.php",
				success: function(response){
					console.log(response);
					if (response.validado == 1) {
						//guardar información y pasar al siguiente formulario
					}else{
						//mandar mensajes de error
						contexto.mensajesError(response.respuesta);
					}
				},

				error: function(jqxhr, textStatus, errorMessage){
					console.log(["error", errorMessage]);
				}
			});
		}
		
	})

	var modProject = Backbone.View.extend({

		el: '#Modalidad-del-proyecto',
		template: _.template($('#tmp-modProject').html()),
		validada: false,
		next: false,
		events: {
			'submit #frmModProject': 'nextform',
		},
		post: '',
		initialize : function() {
			this.showForm ();
		},

		render : function () {
			this.$form = this.$('#frmModProject');
		},
		showForm : function() {
			this.$el.html(this.template() );
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
		sendData : function (post){
			console.log(post);
			$.ajax({
				data: post,
				type: "POST",
				dataType:"text",
				url: "/controller/controllerSolicitudApoyo.php",
				success: function(response){
					console.log(response.data);
				},
				error: function(jqxhr, textStatus, errorMessage){
					console.log(["error", errorMessage]);
				}
			});
		}	

	})

	var colaboradores = Backbone.View.extend({

		el: '#ColaboradoresP',
		template: _.template($('#tmp-Colaboradores').html()),
		validada: false,
		next: false,
		events: {
			'submit #frmColaboradoresP': 'nextform',
		},
		post: '',

		initialize : function(){
			this.showForm();
		},

		render : function () {
			this.$form = this.$('#frmColaboradoresP');
		},

		showForm : function () {
			this.$el.html(this.template());
		},
		nextform : function (event) {
			event.preventDefault();
			this.post = this.validarForm(event);
			this.sendData( this.post );
		},
	})

	var programaActividades = Backbone.View.extend({

		el: '#Concentrado',
		template: _.template($('#tmp-programaActividades').html()),
		validada: false,
		next: false,
		events: {
			'submit #formProgramaActividades': 'nextform',
		},
		post: '',

		initialize : function(){
			this.showForm();
		},

		render : function () {
			this.$form = this.$('#formProgramaActividades');
		},

		showForm : function () {
			this.$el.html(this.template());
		},
		nextform : function (event) {
			event.preventDefault();
			this.post = this.validarForm(event);
			this.sendData( this.post );
		},
	})

	var planDeTrabajo = Backbone.View.extend({

		el: '#PlanDeTrabajo',
		template: _.template($('#tmp-planDeTrabajo').html()),
		validada: false,
		next: false,
		events: {
			'submit #formPlanDeTrabajo': 'nextform',
		},
		post: '',

		initialize : function(){
			this.showForm();
		},

		render : function () {
			this.$form = this.$('#formPlanDeTrabajo');
		},

		showForm : function () {
			this.$el.html(this.template());
		},
		nextform : function (event) {
			event.preventDefault();
			this.post = this.validarForm(event);
			this.sendData( this.post );
		},
	})

	
	//metodo jQuery que se ejecuta cuando se carga por completo el documento
	$(document).ready(function(){

		html = {
			contentErrors: $('.alert-danger'),
			errores : $('#erroresForm')
		};

		//se crea una instancia(copia) del objeto infoGeneral
		var objInfoGeneral = new InfoGeneral ();
		objInfoGeneral.render();

		var objModProject = new modProject();
		objModProject.render();

		var objColaboradores = new colaboradores();
		objColaboradores.render();

		var objProgActividades = new programaActividades();
		objProgActividades.render();

		var objPlanDeTrabajo = new planDeTrabajo();
		objPlanDeTrabajo.render();
	});

>>>>>>> bfd732d8726367ba230f2f2e329e41b8b77222a1
})();