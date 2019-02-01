	
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

	var collectionFormsDesProyecto = new FormsCollections();
	var collectionFormsObjProyecto = new FormsCollections();
	var collectionFormsDatosEmpresa = new FormsCollections();
	var collectionFormsLugarInfra = new FormsCollections();

	var collectionValuesForms = new FormsCollections();

	var html;


	/* 
	- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	|                                       View                                       |
	- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
	*/

//Se crea un objeto que hereda de Backbone
	var DesProyecto = Backbone.View.extend({
		//atributos del objeto InfoGeneral

		//objeto principal de la clase actual del DOM guardado en cache para que no gaste recursos
		//1-3.1 
		el: '#DesProyecto', //donde
		//1-3.2 que va a imprimir '#tmp-infoGenaral' en donde en '#info-general'
		template: _.template($('#tmp-DescProyecto').html()), //que (el template lo esta imprimiendo en info general)
		validada: false,
		next: false,
		events: {
			'submit #frmDescProyecto': 'nextform',
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
			this.collection.url = '/BancoProyecto/private/controller/controllerProtocolo.php?action=getInitDescProyecto';
			//2. pide los datos en base a la url
			//1-5

			var contexto = this;

			this.collection.fetch().done(function(){

				var estructura = {};
				
				if( action == 'modificar'){
					$.post( "/BancoProyecto/private/controller/controllerProtocolo.php?action=ModificarProtocolo&id="+id, function( data ) {
					 	data = JSON.parse(data);
					 	console.log(id);
					 	estructura['dataDescProyecto'] = {};
					 	estructura['dataDescProyecto']['nombre'] = 'validarDescProyecto';
					 	estructura['dataDescProyecto']['campos'] = [];
					 	estructura['dataDescProyecto']['campos'].push({
																      "nombre": "cmbxCampus",
																      "value": data.DescripcionProyecto[1].idCampus
																    });
					 	estructura['dataDescProyecto']['campos'].push({
																      "nombre": "titulo",
																      "value": data.DescripcionProyecto[0].titulo
																    });
					 	estructura['dataDescProyecto']['campos'].push({
																      "nombre": "textAreaResumen",
																      "value": data.DescripcionProyecto[1].resumen
																    });
					 	estructura['dataDescProyecto']['campos'].push({
																      "nombre": "textAreaIntroduccion",
																      "value": data.DescripcionProyecto[1].introduccion
																    });
					 	estructura['dataDescProyecto']['campos'].push({
																      "nombre": "textAreaAntecedentes",
																      "value": data.DescripcionProyecto[1].antecedentes
																    });
					 	estructura['dataDescProyecto']['campos'].push({
																      "nombre": "textAreaMteorico",
																      "value": data.DescripcionProyecto[1].marcoTeorico
																    });

						localStorage.setItem('dataDescProyecto', JSON.stringify( estructura['dataDescProyecto'] ));
						contexto.cargarDatos( estructura['dataDescProyecto'] );

					});
				}else{
					var data = localStorage.getItem('dataDescProyecto');
					if( data != null){
						data = JSON.parse(data);
						contexto.cargarDatos( data );
					}else{
						console.log('no cargar');
					}
				}
				
			});

			this.$form = this.$('#frmDescProyecto');
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
			if( model.attributes.nombre == 'cmbxCampus'){
				this.chargeSelect(model);
			}
		},

		sendData : function (post){
			var contexto = this;
			console.log(post);
			$.ajax({
				data: post,
				type: "POST",
				dataType:"json",
				url: "/BancoProyecto/private/controller/controllerProtocolo.php",
				success: function(response){
					console.log(response);
					if (response.validado == 1) {
						//guardar información y pasar al siguiente formulario
						var dataDescProyecto = {"nombre" : response.data.action}
						dataDescProyecto['campos'] = [];
						for (var campo in response.data){
							if( campo != 'action'){
								dataDescProyecto['campos'].push({
									"nombre" : campo,
									"value" : response.data[campo]
								});
							}
						}
						//En esta linea se guardan los datos
						//dataDescProyecto es un arreglo,con JSON.stringify lo conviertes en cadena y lo guarda en:
						//localStorage posicion 'dataDescProyecto'
						localStorage.setItem('dataDescProyecto', JSON.stringify( dataDescProyecto ));
						//en esta linea los leo
						//con  JSON.parse reversas el cambio a como estaba, es ddecir de strin a array y lo imprimes
						console.log( JSON.parse( localStorage.getItem('dataDescProyecto') ) );

						$('.nav-link ').removeClass('active');
						$('#tabObjetivos').addClass('active');

						contexto.$el.removeClass('active show');
						$('#ObjProyecto').addClass('active show');
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
			console.log(model);
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
				}else{

					var campo = this.$form.find( 'textarea[name="'+data.campos[i].nombre+'"]' );

					if( campo.length == 1 ){
						campo.val(data.campos[i].value);
					}else{
						this.$form.find( 'select[name="'+data.campos[i].nombre+'"]' ).val(data.campos[i].value);
					}

					
				}
				
			}
		}
		
	});
	
	var ObjProyecto = Backbone.View.extend({
		//atributos del objeto InfoGeneral

		//objeto principal de la clase actual del DOM guardado en cache para que no gaste recursos
		//1-3.1 
		el: '#ObjProyecto', //donde
		//1-3.2 que va a imprimir '#tmp-infoGenaral' en donde en '#info-general'
		template: _.template($('#tmp-ObjProyecto').html()), //que (el template lo esta imprimiendo en info general)
		validada: false,
		next: false,
		events: {
			'submit #frmObjProyecto': 'nextform',
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
			this.collection.url = '/BancoProyecto/private/controller/controllerProtocolo.php?action=getInitDescProyecto';
			//2. pide los datos en base a la url
			//1-5
			var contexto = this;
			this.collection.fetch().done(function(){

				var estructura = {};

				if( action == 'modificar'){
					$.post( "/BancoProyecto/private/controller/controllerProtocolo.php?action=ModificarProtocolo&id="+id, function( data ) {
					 	data = JSON.parse(data);
					 	estructura['dataObjProyecto'] = {};
					 	estructura['dataObjProyecto']['nombre'] = 'validarObjProyecto';
					 	estructura['dataObjProyecto']['campos'] = [];
					 	estructura['dataObjProyecto']['campos'].push({
																      "nombre": "textAreaObjetivos",
																      "value": data.objetivosDelProyecto[0].objetivoGeneral
																    });
					 	estructura['dataObjProyecto']['campos'].push({
																      "nombre": "textAreaObjetivosEspecificos",
																      "value": data.objetivosDelProyecto[1].objetivosEspecificos
																    });
					 	estructura['dataObjProyecto']['campos'].push({
																      "nombre": "textAreaMeta",
																      "value": data.objetivosDelProyecto[2].metas
																    });
					 	estructura['dataObjProyecto']['campos'].push({
																      "nombre": "textAreaImpacto",
																      "value": data.objetivosDelProyecto[2].impactoBeneficio
																    });
					 	estructura['dataObjProyecto']['campos'].push({
																      "nombre": "textAreaMetodologia",
																      "value": data.objetivosDelProyecto[2].metodologia
																    });
					 	estructura['dataObjProyecto']['campos'].push({
																      "nombre": "textAreaProductos",
																      "value": data.objetivosDelProyecto[2].productosEntregables
																    });
					 	
					 	localStorage.setItem('dataObjProyecto', JSON.stringify( estructura['dataObjProyecto'] ));
						contexto.cargarDatos( estructura['dataObjProyecto'] );

					});
				}else{
					var data = localStorage.getItem('dataObjProyecto');
					if( data != null){
						data = JSON.parse(data);
						contexto.cargarDatos( data );
					}else{
						console.log('no cargar');
					}
				}
				
			}); 

			this.$form = this.$('#frmObjProyecto');
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

		sendData : function (post){
			var contexto = this;
			console.log(post);
			$.ajax({
				data: post,
				type: "POST",
				dataType:"json",
				url: "/BancoProyecto/private/controller/controllerProtocolo.php",
				success: function(response){
					console.log(response);
					if (response.validado == 1) {
						//guardar información y pasar al siguiente formulario
						var dataObjProyecto= {"nombre" : response.data.action}
						dataObjProyecto['campos'] = [];
						for (var campo in response.data){
							if( campo != 'action'){
								dataObjProyecto['campos'].push({
									"nombre" : campo,
									"value" : response.data[campo]
								});
							}
						}
						//En esta linea se guardan los datos
						//dataObjProyecto es un arreglo,con JSON.stringify lo conviertes en cadena y lo guarda en:
						//localStorage posicion 'dataObjProyecto'
						localStorage.setItem('dataObjProyecto', JSON.stringify( dataObjProyecto ));
						//en esta linea los leo
						//con  JSON.parse reversas el cambio a como estaba, es ddecir de strin a array y lo imprimes
						console.log( JSON.parse( localStorage.getItem('dataObjProyecto') ) );

						$('.nav-link ').removeClass('active');
						$('#tabDatosEmpresa').addClass('active');

						contexto.$el.removeClass('active show');
						$('#DatosEmpresa').addClass('active show');
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

		cargarDatos: function(data){
			for (var i = 0; i < data.campos.length; i++) {
				var campo = this.$form.find( 'input[name="'+data.campos[i].nombre+'"]' );

				if( campo.length == 1 ){
					campo.val(data.campos[i].value);
				}else{

					var campo = this.$form.find( 'textarea[name="'+data.campos[i].nombre+'"]' );

					if( campo.length == 1 ){
						campo.val(data.campos[i].value);
					}else{
						this.$form.find( 'select[name="'+data.campos[i].nombre+'"]' ).val(data.campos[i].value);
					}

					
				}
				
			}
		}	
	});

	var DatosEmpresa = Backbone.View.extend({
		//atributos del objeto InfoGeneral

		//objeto principal de la clase actual del DOM guardado en cache para que no gaste recursos
		//1-3.1 
		el: '#DatosEmpresa', //donde
		//1-3.2 que va a imprimir '#tmp-infoGenaral' en donde en '#info-general'
		template: _.template($('#tmp-DatosEmpresa').html()), //que (el template lo esta imprimiendo en info general)
		validada: false,
		next: false,
		events: {
			'submit #frmDatosEmpresa': 'nextform',
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
			this.collection.url = '/BancoProyecto/private/controller/controllerProtocolo.php?action=getInitDescProyecto';
			//2. pide los datos en base a la url
			

			$("#CARTACOMPROMISO").change(function() {
		        for (var i = 0; i < this.files.length; i++) {
		        	 var file = this.files[i];
		        	var imagefile = file.type;
			        var match= ["application/pdf","application/PDF"];
			        if(!((imagefile==match[0]) || (imagefile==match[1]) )){
			            alert('El formato de todos los archivo debe ser (PDF).');
			            $("#CARTACOMPROMISO").val('');
			            return false;
			        }
		        }
		        
		    });


			//1-5
			var contexto = this;
			this.collection.fetch().done(function(){

				var estructura = {};

				if( action == 'modificar'){
					$.post( "/BancoProyecto/private/controller/controllerProtocolo.php?action=ModificarProtocolo&id="+id, function( data ) {
					 	data = JSON.parse(data);

					 	estructura['dataDatEmpresa'] = {};
					 	estructura['dataDatEmpresa']['nombre'] = 'validarDatosEmpresa';
					 	estructura['dataDatEmpresa']['campos'] = [];
					 	estructura['dataDatEmpresa']['campos'].push({
																      "nombre": "txtnomempresa",
																      "value": data.DatosDeLaEmpresa[0].nombreEmpresa
																    });
					 	estructura['dataDatEmpresa']['campos'].push({
																      "nombre": "textAreaTipoCooperacion",
																      "value": data.DatosDeLaEmpresa[0].tipoCooperacion
																    });
					 	estructura['dataDatEmpresa']['campos'].push({
																      "nombre": "textAreaResponsabilidad",
																      "value": data.DatosDeLaEmpresa[0].responsabilidad
																    });
					 	estructura['dataDatEmpresa']['campos'].push({
																      "nombre": "textAreaUsuariosPotenciales",
																      "value": data.DatosDeLaEmpresa[0].usuariosPotenciables
																    });
					 	estructura['dataDatEmpresa']['campos'].push({
																      "nombre": "referencias",
																      "value": data.DatosDeLaEmpresa[1].referencia
																    });
					 	estructura['dataDatEmpresa']['campos'].push({
																      "nombre": "campoarte",
																      "value": data.DatosDeLaEmpresa[1].estadoCampoArte
																    });
					 	estructura['dataDatEmpresa']['campos'].push({
																      "nombre": "plateamiento",
																      "value": data.DatosDeLaEmpresa[1].planteamiento
																    });
					 	estructura['dataDatEmpresa']['campos'].push({
																      "nombre": "desarrollo",
																      "value": data.DatosDeLaEmpresa[1].desarrolloProyecto
																    });
					 	var documentos = [];

					 	for (var i = 0; i < data.DatosDeLaEmpresa.Documentos.length; i++) {
					 		documentos.push({
					 			"nombre": data.DatosDeLaEmpresa.Documentos[i].nombre,
					 			"id": data.DatosDeLaEmpresa.Documentos[i].ruta
					 		});
					 	}

					 	estructura['dataDatEmpresa']['campos'].push({
					 												  "nombre": "file",
					 												  "value": documentos 
					 												});

					 	localStorage.setItem('dataDatEmpresaFiles', JSON.stringify( documentos ));

					 	localStorage.setItem('dataDatEmpresa', JSON.stringify( estructura['dataDatEmpresa'] ));
						contexto.cargarDatos( estructura['dataDatEmpresa'] );

					});
				}else{
					var data = localStorage.getItem('dataDatEmpresa');
					if( data != null){
						data = JSON.parse(data);
						contexto.cargarDatos( data );
					}else{
						console.log('no cargar');
					}
				}
			});

			this.$form = this.$('#frmDatosEmpresa');
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
			var data = new FormData();
			for (var i = 0; i < event.target.length; i++) {

				if( event.target[i].type == 'radio'){
					if ( event.target[i].checked ) {
						data.append(event.target[i].name, $(event.target[i]).attr('value'));
					}
				}else{
					data.append(event.target[i].name, event.target[i].value);
				}
			}

			
			jQuery.each(jQuery('#CARTACOMPROMISO')[0].files, function(i, file) {
			    data.append('file-'+i, file);
			});

			return data;
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
		sendData : function (post){
			var contexto = this;
			$.ajax({
				data: post,
				type: "POST",
				dataType:"json",
				cache: false,
			    contentType: false,
			    processData: false,
				url: "/BancoProyecto/private/controller/controllerProtocolo.php",
				success: function(response){
					console.log(response);
					if (response.validado == 1) {
						//guardar información y pasar al siguiente formulario
						var dataDatEmpresa= {"nombre" : response.data.action}
						dataDatEmpresa['campos'] = [];
						for (var campo in response.data){
							if( campo != 'action'){
								dataDatEmpresa['campos'].push({
									"nombre" : campo,
									"value" : response.data[campo]
								});
							}
						}
						//En esta linea se guardan los datos
						//dataDatEmpresa es un arreglo,con JSON.stringify lo conviertes en cadena y lo guarda en:
						//localStorage posicion 'dataDatEmpresa'
						localStorage.setItem('dataDatEmpresa', JSON.stringify( dataDatEmpresa ));


						var files = localStorage.getItem('dataDatEmpresaFiles');
						if( files != null || files != ''){
							files = JSON.parse(files);
							jQuery.each(dataDatEmpresa['campos'], function(i, file) {
							    if( dataDatEmpresa['campos'][i]['nombre'] == 'file' ){
							    	localStorage.setItem('dataDatEmpresaFiles', JSON.stringify( dataDatEmpresa['campos'][i]['value'].concat(files) ));
							    }
							});
						}
						//en esta linea los leo
						//con  JSON.parse reversas el cambio a como estaba, es ddecir de strin a array y lo imprimes
						console.log( JSON.parse( localStorage.getItem('dataDatEmpresa') ) );

						$('.nav-link ').removeClass('active');
						$('#tabLugarInfra').addClass('active');

						contexto.$el.removeClass('active show');
						$('#LugarInfra').addClass('active show');
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

		cargarDatos: function(data){
			for (var i = 0; i < data.campos.length; i++) {
				var campo = this.$form.find( 'input[name="'+data.campos[i].nombre+'"]' );

				if( campo.length == 1 ){

					if( !Array.isArray(data.campos[i].value) ){
						campo.val(data.campos[i].value);
					}else{
						var files = localStorage.getItem('dataDatEmpresaFiles');
						console.log(files)
						if( files != null || files != ''){
							files = JSON.parse(files);
							$('#FilesSave').html('<h3>Archivos guardados<h3>');
							for (var j = 0; j < files.length; j++) {
								if( files[j] != null){
									$('#FilesSave').append(files[j].nombre+'<br>');
								}
							}
						}
					}
				}else{
					if( Array.isArray(data.campos[i].value) ){
						var files = localStorage.getItem('dataDatEmpresaFiles');
						
						if( files != null || files != ''){
							files = JSON.parse(files);
							$('#FilesSave').html('<h3>Archivos guardados<h3>');
							for (var j = 0; j < files.length; j++) {
								if( files[j] != null){
									$('#FilesSave').append(files[j].nombre+'<br>');
								}
							}
						}

					}else{
						var campo = this.$form.find( 'textarea[name="'+data.campos[i].nombre+'"]' );

						if( campo.length == 1 ){
							campo.val(data.campos[i].value);
						}else{
							this.$form.find( 'select[name="'+data.campos[i].nombre+'"]' ).val(data.campos[i].value);
						}
					}
					
					
				}
				
			}
		}
	});

	var LugarInfra = Backbone.View.extend({
		//atributos del objeto InfoGeneral

		//objeto principal de la clase actual del DOM guardado en cache para que no gaste recursos
		//1-3.1 
		el: '#LugarInfra', //donde
		//1-3.2 que va a imprimir '#tmp-infoGenaral' en donde en '#info-general'
		template: _.template($('#tmp-LugarInfra').html()), //que (el template lo esta imprimiendo en info general)
		validada: false,
		next: false,
		events: {
			'submit #frmLugarInfra': 'nextform',
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
			this.collection.url = '/BancoProyecto/private/controller/controllerProtocolo.php?action=getInitDescProyecto';
			//2. pide los datos en base a la url
			//1-5
			var contexto = this;
			this.collection.fetch().done(function(){

				var estructura = {};

				if( action == 'modificar'){
					$.post( "/BancoProyecto/private/controller/controllerProtocolo.php?action=ModificarProtocolo&id="+id, function( data ) {
					 	data = JSON.parse(data);
					 	estructura['dataLugarInfra'] = {};
					 	estructura['dataLugarInfra']['nombre'] = 'validarLugarInfra';
					 	estructura['dataLugarInfra']['campos'] = [];
					 	estructura['dataLugarInfra']['campos'].push({
																      "nombre": "txtnombrelugtrab",
																      "value": data.LugarEInfraestructura[0].nombreSeccion
																    });
					 	estructura['dataLugarInfra']['campos'].push({
																      "nombre": "txtdireccionlugtrab",
																      "value": data.LugarEInfraestructura[0].diereccionExacta
																    });
					 	estructura['dataLugarInfra']['campos'].push({
																      "nombre": "pruebas",
																      "value": data.LugarEInfraestructura[0].requierePruebasCampo
																    });
					 	estructura['dataLugarInfra']['campos'].push({
																      "nombre": "txtEstado",
																      "value": data.LugarEInfraestructura[0].estado
																    });
					 	estructura['dataLugarInfra']['campos'].push({
																      "nombre": "txtregion",
																      "value": data.LugarEInfraestructura[0].region
																    });
					 	estructura['dataLugarInfra']['campos'].push({
																      "nombre": "txtzona",
																      "value": data.LugarEInfraestructura[0].zona
																    });
					 	estructura['dataLugarInfra']['campos'].push({
																      "nombre": "txtmunicipio",
																      "value": data.LugarEInfraestructura[0].municipio
																    });
					 	estructura['dataLugarInfra']['campos'].push({
																      "nombre": "txtdistanciakm",
																      "value": data.LugarEInfraestructura[0].distanciaKM
																    });
					 	estructura['dataLugarInfra']['campos'].push({
																      "nombre": "infraestructura",
																      "value": data.LugarEInfraestructura[1].infraestructura
																    });
					 	
					 	localStorage.setItem('dataLugarInfra', JSON.stringify( estructura['dataLugarInfra'] ));
						contexto.cargarDatos( estructura['dataLugarInfra'] );

					});
				}else{
					var data = localStorage.getItem('dataLugarInfra');
					if( data != null){
						data = JSON.parse(data);
						contexto.cargarDatos( data );
					}else{
						console.log('no cargar');
					}
				}
				
			}); 

			this.$form = this.$('#frmLugarInfra');
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
		sendData : function (post){
			var contexto = this;
			$.ajax({
				data: post,
				type: "POST",
				dataType:"json",
				url: "/BancoProyecto/private/controller/controllerProtocolo.php",
				success: function(response){
					console.log(response);
					if (response.validado == 1) {
						//guardar información y pasar al siguiente formulario
						var dataLugarInfra= {"nombre" : response.data.action}
						dataLugarInfra['campos'] = [];
						for (var campo in response.data){
							if( campo != 'action'){
								dataLugarInfra['campos'].push({
									"nombre" : campo,
									"value" : response.data[campo]
								});
							}
						}
						//En esta linea se guardan los datos
						//dataLugarInfra es un arreglo,con JSON.stringify lo conviertes en cadena y lo guarda en:
						//localStorage posicion 'dataLugarInfra'
						localStorage.setItem('dataLugarInfra', JSON.stringify( dataLugarInfra ));
						//en esta linea los leo
						//con  JSON.parse reversas el cambio a como estaba, es ddecir de strin a array y lo imprimes
						console.log( JSON.parse( localStorage.getItem('dataLugarInfra') ) );

						if( localStorage.getItem( 'dataDescProyecto' ) != null &&
							localStorage.getItem( 'dataDescProyecto' )  != '' &&
							
							localStorage.getItem( 'dataObjProyecto' ) != null &&
							localStorage.getItem( 'dataObjProyecto' )  != '' &&
							
							localStorage.getItem( 'dataDatEmpresa' ) != null &&
							localStorage.getItem( 'dataDatEmpresa' )  != '' &&
							
							localStorage.getItem( 'dataLugarInfra' ) != null &&
							localStorage.getItem( 'dataLugarInfra' )  != '' ){

							if( confirm("Enviar Protocolo de Investigacion") ){
								var post = '';
								for (var i = 0; i < localStorage.length; i++) {
									post += localStorage.key(i)+'='+localStorage.getItem( localStorage.key(i) )+'&';
								}
								post += 'action=saveAllProtocolo&id='+id;
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
					console.log(["error", [jqxhr, textStatus, errorMessage]]);
				}
			});
		},
		sendAllData : function( post){
			$.ajax({
				data: post,
				type: "POST",
				dataType:"text",
				url: "/BancoProyecto/private/controller/controllerProtocolo.php",
				success: function(response){
					if( response == '1'){
						localStorage.removeItem('dataDatEmpresa');
						localStorage.removeItem('dataDatEmpresaFiles');
						localStorage.removeItem('dataDescProyecto');
						localStorage.removeItem('dataLugarInfra');
						localStorage.removeItem('dataObjProyecto');
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
					var campo = this.$form.find( 'textarea[name="'+data.campos[i].nombre+'"]' );

					if( campo.length == 1 ){
						campo.val(data.campos[i].value);
					}else{
						this.$form.find( 'select[name="'+data.campos[i].nombre+'"]' ).val(data.campos[i].value);
					}
				}
				
			}
		}
	});		


	//metodo jQuery que se ejecuta cuando se carga por completo el documento
	//main
	$(document).ready(function(){

		html = {
			contentErrors: $('.alert-danger'),
			errores : $('#erroresForm')
		};

		//se crea una instancia(copia) del objeto infoGeneral
		//1-1.- en el momento que se ejecuta la instancia, despues ejecuta el metodo inicialize

		var objDesProyecto = new DesProyecto ({ collection: collectionFormsDesProyecto , });
		objDesProyecto.render(action, id);

		var objObjetivoProyecto = new ObjProyecto ({ collection: collectionFormsObjProyecto, });
		objObjetivoProyecto.render(action, id);

		var objDatosEmpresa = new DatosEmpresa({ collection: collectionFormsDatosEmpresa});
		objDatosEmpresa.render(action, id);

		var objLugarInfra = new LugarInfra ({ collection: collectionFormsLugarInfra});
		objLugarInfra.render(action, id);

		$('#cleanForm').click(function(){
			if( confirm("Se eliminará toda la información del formulario ¿Desea continuar?")){
				localStorage.removeItem('dataDatEmpresa');
				localStorage.removeItem('dataDatEmpresaFiles');
				localStorage.removeItem('dataDescProyecto');
				localStorage.removeItem('dataLugarInfra');
				localStorage.removeItem('dataObjProyecto');
				window.location.reload();
			}
		});
	});
})();