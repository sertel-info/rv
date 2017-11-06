import React from 'react';
import FormInterface from '../../../general/FormInterface.jsx';
import NotificacoesBasicoFormFields from './formfields/NotificacoesBasicoFormFields.jsx';
import NotificacoesEmailFormFields from './formfields/NotificacoesEmailFormFields.jsx';
import MultiForm from '../../../general/MultiForm.jsx';

class NotificacoesCreate extends FormInterface {
	
	constructor(props){
		super(props);
		
		this.state = {
			mensagem : "",
			titulo : "",
			nivel : "danger",
			email_assunto : "",
			email_corpo : "",
			ativar_email : 0,
			show_success_modal : false,
			show_error_modal: false
		}

		this.valuesGetter = this.valuesGetter.bind(this);

		try{
			this.state['a'] = this.props.location.params.assinante;
		} catch (e){
			window.location = "#/assinantes";
		}

		this.route = _ROUTES_.notificacoes_flash.store;	
		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Notificação criada com successo !</h2>
								</div>;

		this.onSuccess = () => {
			window.location = "#/assinantes";
		}
	}

	valuesGetter(attribute){
		return this.state[attribute];
	}

	render(){
		let modal = "";
		if(this.hasErrors() && super.shouldShowModal())
			modal = this.getErrorsModal();
		else if(this.hasSucceeded() && super.shouldShowModal())
			modal = this.getSuccessModal();

		return <div className="panel panel-default">
				    <div className="panel-heading">
				    	Criar Notificação
				    	<a href="#" className="btn btn-success pull-right" onClick={this.handleFormSubmit}> <i className="fa fa-check"></i> Finalizar </a>
				    	<a href="#/assinantes" className="btn btn-warning pull-right mr-2"> <i className="fa fa-arrow-left"></i> Voltar </a>
					</div>
					<div className="panel-body">
						<MultiForm stages={[{title:"Básico", content:<NotificacoesBasicoFormFields valuesGetter={this.getValueOf} onChange={this.handleInputChange}/>},
											{title:"Email", content:<NotificacoesEmailFormFields valuesGetter={this.getValueOf} onChange={this.handleInputChange}/>}]} />
					</div>
					{modal}
			   </div>
	}
}

module.exports = NotificacoesCreate;