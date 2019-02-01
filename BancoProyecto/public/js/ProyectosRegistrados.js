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

    var collectionForms = new FormsCollections();

    //Se crea un objeto que hereda de Backbone
    var proyectos = Backbone.View.extend({

      el: '#myTable',

      tmps : {
        row: _.template($('#tmp-proyectosRegistrados').html())
      },

      render : function () {
        console.log('render');
        this.listenTo( this.collection, 'add', this.addElementsProyectos );
        this.listenTo( this.collection, 'remove', this.removeElementsProyectos );

        this.$el.on('click', '.eliminarProyecto', this.deleteProject.bind(this) );

        this.collection.url = '/BancoProyecto/private/controller/controllerBusqueda.php?action=getProyectos';
        
        this.$el.html('');
        var contexto = this;
        this.collection.fetch();        
      },

      addElementsProyectos: function(model){
        this.cargarProyectos(model);
      },

      cargarProyectos : function(model){
        this.$el.append( this.tmps.row({
          id: model.attributes.id,
          titulo: model.attributes.titulo
        }) );
      },

      deleteProject: function(event){
        var contexto = this;

        if( confirm('¿Desea eliminar el proyecto?') ){
          $.post( "/BancoProyecto/private/controller/controllerBusqueda.php", { action: "eliminarProyecto", id: event.target.id }, function( data ) {
            if( data == '1'){
              contexto.collection.remove(event.target.id);
            }
            
          });
        }
      },

      removeElementsProyectos : function(model){
        $('#proyecto-'+model.id).remove();
      }

    });

    $(document).ready(function(){
      var ViewProyectos = new proyectos ({ collection: collectionForms, });
      ViewProyectos.render();
    });

  })();
  


  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });