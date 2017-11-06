import React from 'react';
import ConfiguracoesForm from './ConfiguracoesForm.jsx';
import FormInterface from '../../../general/FormInterface.jsx';
import {Link, HashRouter as Router } from 'react-router-dom';
import Axios from 'axios';

class ConfiguracoesIndex extends FormInterface {
	
	constructor(props){
		super(props);

		this.state = {
			prefx_aplicacoes : "",
			atalho_siga_me : "",
			atalho_cadeado : "",
			voice_mail_remetente_padrao : "",
			voice_mail_assunto_padrao : "",
			voice_mail_mensagem_padrao : "",
		}

		this.route = _ROUTES_.configuracoes.update;	
		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Configurações atualizadas com successo !</h2>
							   </div>;

		this.onSuccess = () => {
			window.location = "#/configuracoes";
		}
	}


	componentDidMount(){
		Axios({
			
			method: "GET",
			url: _ROUTES_.configuracoes.get

		}).then(function(response){
			let config = response.data.configuracoes;
			
			this.setState({
				prefx_aplicacoes : config.prefx_aplicacoes,
				atalho_siga_me : config.atalho_siga_me,
				atalho_cadeado : config.atalho_cadeado,
				voice_mail_remetente_padrao : config.voice_mail_remetente_padrao,
				voice_mail_assunto_padrao : config.voice_mail_assunto_padrao,
				voice_mail_mensagem_padrao : config.voice_mail_mensagem_padrao
			});

		}.bind(this)).catch(function(error){
			
			console.log(error);
		
		}.bind(this));
	}

	render(){
		let modal = "";
		if(this.hasErrors() && super.shouldShowModal())
			modal = this.getErrorsModal();
		else if(this.hasSucceeded() && super.shouldShowModal())
			modal = this.getSuccessModal();

		return (<div className="panel panel-default">
					<div className="panel-heading">
						Configurações
						<a href="#" onClick={this.handleFormSubmit} className="btn btn-success pull-right"><em className="fa fa-check"></em> Finalizar </a>
					</div>
					<div className="panel-body">
						<ConfiguracoesForm onInputChange={this.handleInputChange} valuesGetter={this.getValueOf}/>
					</div>
					{modal}
				</div>);
	}
}

module.exports = ConfiguracoesIndex;