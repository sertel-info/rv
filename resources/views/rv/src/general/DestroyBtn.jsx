import React from 'react';
import Axios from 'axios';

class DestroyBtn extends React.Component {
	
	constructor(props){
		super(props);
		this.props = props;

		this.showModal = this.showModal.bind(this);
		this.createModal = this.createModal.bind(this);
	}

	createModal(){
		let $modal = $('<div id="destroy-modal" class="modal fade" tabindex="-1" role="dialog">\
						  <div class="modal-dialog" role="document">\
						    <div class="modal-content">\
						      <div class="modal-header dark-overlay">\
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
						        <h4 class="modal-title"> Atenção </h4>\
						      </div>\
						      <div class="modal-body">\
						        <h3> Tem certeza que deseja excluir este item ? </h3>\
						      </div>\
						      <div class="modal-footer">\
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>\
						        <a href='+this.props.href+' id="go" type="button" class="btn btn-primary">Continuar</a>\
						      </div>\
						    </div>\
						  </div>\
						</div>');

		$modal.find("#go").on("click", function(ev){
			ev.preventDefault();
			let $mbody = $modal.find(".modal-body");
			$mbody.html('<div class="text-center"><img class="loading" src="/img/sertel-loading.gif" /></div>');
			let onDelete = this.props.onDelete;
			Axios({
			
				method: "DELETE",
				url: this.props.href,
				data: {id:this.props.data_id}
			
			}).then(function(response){
				
				$modal.find("#go").hide();
				$mbody.html('<h3 class="text-success"><i class="fa fa-check"></i> Item excluído com sucesso !</h3>');
				onDelete();

			}).catch(function(error){
				
				if(error.response.status == 401)
					window.location = "/login";

				$modal.find("#go").hide();
				$mbody.html('<h4 class="text-danger"><i class="fa fa-exclamation-circle"></i> Um erro inesperado ocorreu. Por favor, tente novamente !</h4>');

				console.log(error);

			}.bind(this));

		}.bind(this));

		$('body').append($modal);
	}

	modalExists(){
		return $("#destroy-modal").length >= 1;
	}

	removeModal(){
		$("#destroy-modal").remove();
	}

	showModal(event){
		event.preventDefault();

		if(this.modalExists())
			this.removeModal();

		this.createModal();

		$("#destroy-modal").modal().show();
	}

	render(){
		return (<a onClick={this.showModal} href="#" className="btn btn-xs btn-danger">
				  <em className="fa fa-remove fa-2x" aria-hidden="true"/> Excluir 
				</a>);
	}
}

module.exports = DestroyBtn;