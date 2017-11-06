import React from 'react';
import FormInterface from '../../../general/FormInterface.jsx';
import NotificacoesForm from './NotificacoesForm.jsx';

class NotificacoesCreate extends FormInterface {
	
	constructor(props){
		super(props);

		this.state = {
			ativar_email : 0,
			email_assunto : "",
			email_corpo : "",
			nome : "",
			status : 1,
			evento : "none",
			nivel : "danger",
			titulo : "",
			mensagem : ""
		}

		this.route = _ROUTES_.notificacoes.store;	
		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Notifiação criada com successo !</h2>
								</div>;

		this.onSuccess = () => {
			window.location = "#/notificacoes";
		}
	}

	render(){
		let modal = "";
		if(this.hasErrors() && super.shouldShowModal())
			modal = this.getErrorsModal();
		else if(this.hasSucceeded() && super.shouldShowModal())
			modal = this.getSuccessModal();

		return (<div className="panel panel-default">
					<div className="panel-heading">
						Criar Notificação
						<a href="#" className="btn btn-success pull-right" onClick={this.handleFormSubmit}> <i className="fa fa-check"></i> Finalizar </a>
			    		<a href="#/notificacoes" className="btn btn-warning pull-right mr-2"> <i className="fa fa-arrow-left"></i> Voltar </a>
					</div>
					<div className="panel-body">
						<NotificacoesForm valuesGetter={this.getValueOf} onInputChange={this.handleInputChange}/>
					</div>
					{modal}
				</div>);
	}
}

module.exports = NotificacoesCreate;