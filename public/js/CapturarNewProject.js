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

			for (var i =0; i <= errores.length; i++) {
				
			}

			html.errores.html('errores');

			setTimeout(function(){
				html.contentErrors.hide();
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
	});

})();