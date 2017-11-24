import React from 'react';
import FormInterface from '../../../general/FormInterface.jsx';
import NotificacoesForm from './NotificacoesForm.jsx';
import Axios from 'axios';

class NotificacoesEdit extends FormInterface {
	
	constructor(props){
		super(props);

		this.state = {
			ativar_email : 0,
			email_assunto : "",
			email_corpo : "",
			nome : "",
			status : 1,
			escutar_evento : "none",
			nivel : "danger",
			titulo : "",
			mensagem : ""
		}

		this.route = _ROUTES_.notificacoes.update;	
		
		try{
			this.params = {"n": this.props.location.params.notificacao};
		} catch (e){
			window.location = "#/notificacoes";
		}

		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Notifiação atualizada com successo !</h2>
								</div>;

		this.onSuccess = () => {
			window.location = "#/notificacoes";
		}


	}

	componentDidMount(){
		Axios({
			
			method: "GET",
			url: _ROUTES_.notificacoes.get,
			params: {n : this.params.n}

		}).then(function(response){
			let data = response.data.notif;
			console.log(data);
			this.setState({
				ativar_email : data.ativar_email,
				email_assunto : data.email_assunto,
				email_corpo : data.email_corpo,
				nome : data.nome,
				status : data.status,
				escutar_evento : data.escutar_evento,
				nivel : data.nivel,
				titulo : data.titulo,
				mensagem : data.mensagem
			});

		}.bind(this)).catch(function(error){
				
			console.log(error);

		}.bind(this));
	}

	render(){

		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Editar Notificação</h2>
						</div>
					</div>
					<div className="panel panel-default">
						<div className="panel-heading">
							<a href="#" className="btn btn-success pull-right" onClick={this.handleFormSubmit}> <i className="fa fa-check"></i> Finalizar </a>
				    		<a href="#/notificacoes" className="btn btn-warning pull-right mr-2"> <i className="fa fa-arrow-left"></i> Voltar </a>
						</div>
						<div className="panel-body">
							<NotificacoesForm valuesGetter={this.getValueOf} onInputChange={this.handleInputChange}/>
						</div>
						{this.getModalToShow()}
					</div>
				</div>);
	}
}

module.exports = NotificacoesEdit;