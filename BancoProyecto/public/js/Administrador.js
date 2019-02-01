(function(){

	var modelForm = Backbone.Model.extend({
	    //1-7 recibe cada una de las filas de los datos recibidos del servidor (modelos por separado)
	    //se agrega cada modelo a la colección y desencadena en evento (((((((((add))))))))
	    parse: function(response){
	        return response;
	    },
	});


	var FormsCollections = Backbone.Collection.extend({
	    model: modelForm,
	    parse: function(response){
	        return response.values;
	    }
	});

	var CollProgramas = new FormsCollections();
	var CollLineas = new FormsCollections();

	var Programas = Backbone.View.extend({
		el: '#tableAddProgramasBody',
		template: _.template( $('#tmp-programas').html() ),
		tipoModalidad: '',

		render : function () {

			this.$el.on('click', '.eliminar', this.eliminarPrograma.bind(this));
			this.$el.on('click', '.editar', this.modificarPrograma.bind(this));
			this.$el.on('click', '.lineas', this.lienas.bind(this));
			$('#btnAddPrograma').click(this.addPrograma.bind(this));

			this.listenTo( this.collection, 'add', this.addElements );

		},

		init: function(tipo){
			this.tipoModalidad = tipo;

			this.collection.url = '/BancoProyecto/private/controller/controllerProgramas.php?action=getProgramas&tipoModalidad='+this.tipoModalidad ;

			this.$el.html('');

			this.collection.reset();
			this.collection.fetch();
		},

		addElements: function(model){
			this.printPrograma(model);
		},

		addPrograma: function(event){
			var nombre = prompt("Nombre", "");
			if( nombre != null){
				var post = 'action=addPrograma&tipoModalidad='+this.tipoModalidad+'&nombre=' + nombre;
				var contexto = this;
				$.ajax({
					data: post,
					type: "POST",
					dataType:"text",
					url: "/BancoProyecto/private/controller/controllerProgramas.php",
					success: function(response){
						response = JSON.parse(response);
						if( response.rengolesAfectados != undefined ){
							contexto.collection.reset();
							contexto.$el.html('');
							contexto.collection.fetch();
							console.log(contexto.collection);
						}else{
							alert(response);
						}
					},

					error: function(jqxhr, textStatus, errorMessage){
						console.log(["error", [jqxhr, textStatus, errorMessage]]);
					}
				});
			}
		},

		printPrograma : function(model){
			this.$el.append( this.template({
				id: model.attributes.id,
				nombre: model.attributes.nombre
			}) );
		},

		eliminarPrograma: function(event){
			console.log(event.target);
			var contexto = this;
			//mandar ajax
			if( confirm('Eliminar programa') ){
				var post = 'action=eliminarPrograma&tipoModalidad='+this.tipoModalidad+'&id=' + event.target.id;
				$.ajax({
					data: post,
					type: "POST",
					dataType:"text",
					url: "/BancoProyecto/private/controller/controllerProgramas.php",
					success: function(response){
						response = JSON.parse(response);
						if( response.rengolesAfectados != undefined ){
							contexto.collection.reset();
							contexto.$el.html('');
							contexto.collection.fetch();
							console.log(contexto.collection);
							console.log(response);
							if( response.rengolesAfectados == 0 ){
								alert('No es posible eliminar porque hay proyectos asignados');
							}
						}else{
							alert(response);
						}
					},

					error: function(jqxhr, textStatus, errorMessage){
						console.log(["error", [jqxhr, textStatus, errorMessage]]);
					}
				});
			}
			
		},

		modificarPrograma: function(event){
			var nombre = prompt("Nuevo nombre", "");

			if( nombre != null){
				var post = 'action=modificarPrograma&tipoModalidad='+this.tipoModalidad+'&id=' + event.target.id + '&nombre='+nombre;
			
				var contexto = this; 
				$.ajax({
					data: post,
					type: "POST",
					dataType:"text",
					url: "/BancoProyecto/private/controller/controllerProgramas.php",
					success: function(response){
						response = JSON.parse(response);
						if( response.rengolesAfectados != undefined ){
							contexto.collection.reset();
							contexto.$el.html('');
							contexto.collection.fetch();
							console.log(contexto.collection);
						}else{
							alert(response);
						}
					},

					error: function(jqxhr, textStatus, errorMessage){
						console.log(["error", [jqxhr, textStatus, errorMessage]]);
					}
				});
			}
		},

		lienas: function(event){
			objLineas.init(this.tipoModalidad, event.target.id);
		}
	})

	var Lineas = Backbone.View.extend({
		el: '#tableAddLineasBody',
		template: _.template( $('#tmp-lineas').html() ),
		tipoModalidad: '',
		idPrograma: '',

		render(){

			this.$el.on('click', '.eliminarLinea', this.eliminarLinea.bind(this));
			this.$el.on('click', '.editarLinea', this.modificarLinea.bind(this));
			$('#btnAddProgramaLinea').click(this.addPrograma.bind(this));

			this.listenTo( this.collection, 'add', this.addElementsLines );
			
		},

		init : function (tipo, id) {
			this.tipoModalidad = tipo;
			this.idPrograma = id;

			//this.$el.on('click', '.eliminar', this.eliminarLineas.bind(this));
			//this.$el.on('click', '.editar', this.modificarLineas.bind(this));


			this.collection.url = '/BancoProyecto/private/controller/controllerProgramas.php?action=getLineas&id='+id+'&tipoModalidad='+this.tipoModalidad;

			this.$el.html('');

			this.collection.reset();
			this.collection.fetch();

			console.log(this.collection);
		},


		addElementsLines: function(model){
			this.printLineas(model);
		},

		addPrograma: function(event){
			var nombre = prompt("Nombre", "");
			if( nombre != null){
				var post = 'action=addLinea&tipoModalidad='+this.tipoModalidad+'&nombre=' + nombre+'&programa='+this.idPrograma;
				var contexto = this;
				$.ajax({
					data: post,
					type: "POST",
					dataType:"text",
					url: "/BancoProyecto/private/controller/controllerProgramas.php",
					success: function(response){
						response = JSON.parse(response);
						if( response.rengolesAfectados != undefined ){
							contexto.collection.reset();
							contexto.$el.html('');
							contexto.collection.fetch();
							console.log(contexto.collection);
						}else{
							alert(response);
						}
					},

					error: function(jqxhr, textStatus, errorMessage){
						console.log(["error", [jqxhr, textStatus, errorMessage]]);
					}
				});
			}
		},

		printLineas : function(model){
			this.$el.append( this.template({
				id: model.attributes.id,
				nombre: model.attributes.nombre
			}) );
		},

		eliminarLinea: function(event){
			console.log(event.target);
			var contexto = this;
			//mandar ajax
			if( confirm('Eliminar programa') ){
				var post = 'action=eliminarLinea&tipoModalidad='+this.tipoModalidad+'&id=' + event.target.id;
				$.ajax({
					data: post,
					type: "POST",
					dataType:"text",
					url: "/BancoProyecto/private/controller/controllerProgramas.php",
					success: function(response){
						response = JSON.parse(response);
						if( response.rengolesAfectados != undefined ){
							contexto.collection.reset();
							contexto.$el.html('');
							contexto.collection.fetch();
							console.log(contexto.collection);
						}else{
							alert(response);
						}
					},

					error: function(jqxhr, textStatus, errorMessage){
						console.log(["error", [jqxhr, textStatus, errorMessage]]);
					}
				});
			}
			
		},

		modificarLinea: function(event){
			var nombre = prompt("Nuevo nombre", "");

			if( nombre != null){
				var post = 'action=modificarLinea&tipoModalidad='+this.tipoModalidad+'&id=' + event.target.id + '&nombre='+nombre;
				
				var contexto = this; 
				$.ajax({
					data: post,
					type: "POST",
					dataType:"text",
					url: "/BancoProyecto/private/controller/controllerProgramas.php",
					success: function(response){
						response = JSON.parse(response);
						if( response.rengolesAfectados != undefined ){
							contexto.collection.reset();
							contexto.$el.html('');
							contexto.collection.fetch();
							console.log(contexto.collection);
						}else{
							alert(response);
						}
					},

					error: function(jqxhr, textStatus, errorMessage){
						console.log(["error", [jqxhr, textStatus, errorMessage]]);
					}
				});
			}
		},

	})

	var objLineas;

	$(document).ready(function(){

		var objProgramas = new Programas ({ collection: CollProgramas });
		objProgramas.render();

		objProgramas.init('lineaInvestigacion');
		$( "#tipoInvestigacion" ).change(function(event) {
			objProgramas.init(event.target.value);
		});

		objLineas = new Lineas ({ collection: CollLineas });
		objLineas.render();
	});
})();