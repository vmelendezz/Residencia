(function(){

	var consultar = {

		tmps :{
			ver : ''
		},

		elements:{
			modal: $('.abrirModal')
		},
		init : function (){
			this.tmps.ver = _.template( $('#tmp-modal-ver').html());

			$('.abrirModal').click(this.chargeModal);
		},

		chargeModal: function(event){
			if( event.target.name == 'verConvocatoria' ){
				console.log($(event.target).attr('project'));
			}
		}
	}
	consultar.init();

})();